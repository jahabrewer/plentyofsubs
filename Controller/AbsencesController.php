<?php
App::uses('AppController', 'Controller');
App::uses('Sanitize', 'Utility');

/**
 * Absences Controller
 *
 * @property Absence $Absence
 */
class AbsencesController extends AppController {

/**
 * Executed before any controller method is called
 */
	public function beforeFilter() {
		parent::beforeFilter();
		// this defaults the layout to show absences as the current tab
		$this->set('layout_current', array('absences' => true));
	}
	
/**
 * Determines whether users are authorized for actions
 *
 * @param array $user Contains information about the logged in user
 * @return boolean Whether the user is authorized for an action
 */
	public function isAuthorized($user) {
		if (parent::isAuthorized($user)) {
			return true;
		}

		if ($this->action === 'dashboard') return true;

		if (isset($user['role'])) {
			$absence_id =& $this->request->params['pass'][0];
			if ($user['role'] === 'teacher') {
				// teachers may always create
				if (in_array($this->action, array('add', 'my'))) return true;

				// check for ownership for RUD
				if (in_array($this->action, array('view', 'edit', 'delete'))) return $this->Absence->isOwnedBy($absence_id, $user['id']);
			} elseif ($user['role'] === 'substitute') {
				if (in_array($this->action, array('my', 'view', 'index', 'apply', 'retract'))) return true;

				// check fulfiller ownership for renege
				if ($this->action == 'renege') return $this->Absence->isFulfilledBy($absence_id, $user['id']);
			}
		}

		$this->Session->setFlash('You are not authorized for that action', 'error');
		return false;
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		// include absences helper for formatting date ranges
		$this->helpers[] = 'Absence';

		// only show absences in the future
		$conditions = array('Absence.start > NOW()');
		if ($this->request->is('post')) {
			// build conditions from filter
			$data = $this->request->data['filter'];

			// sanitize date
			$data['date'] = Sanitize::clean($data['date']);
			if ($data['date_select'] == 'before') {
				$conditions['Absence.start <'] = $data['date'];
			} else if ($data['date_select'] == 'after') {
				$conditions['Absence.start >'] = $data['date'];
			}

			if (isset($data['schools']) && !empty($data['schools'])) {
				$conditions['Absence.school_id'] = $data['schools'];
			}

			if (isset($data['teachers']) && !empty($data['teachers'])) {
				$conditions['Absence.absentee_id'] = $data['teachers'];
			}
		}

		$this->paginate = array(
			'conditions' => $conditions
		);

		$this->Absence->recursive = 0;
		$this->set('absences', $this->paginate());
		$schools = $this->Absence->School->find('list');
		$teachers = $this->Absence->Absentee->find('list', array('conditions' => array('Absentee.role' => 'teacher')));
		$show_filters = true;
		$page_legend = 'Search Absences';
		$this->set(compact('schools', 'teachers', 'show_filters', 'filter', 'page_legend'));
	}

/**
 * Shows absences yet to be approved under the jurisdiction of the admin using
 * the index view
 */
	public function pending() {
		// include absences helper for formatting date ranges
		$this->helpers[] = 'Absence';

		// verify that the admin belongs to a school
		$school_id = $this->Auth->user('school_id');
		if (empty($school_id)) {
			$this->Session->setFlash('You belong to no school', 'error');
		}

		$this->paginate = array(
			'conditions' => array(
				'Absence.school_id' => $school_id,
				'Absence.approval_id' => null
			)
		);
		$absences = $this->paginate();

		$page_legend = 'Absences pending approval';
		$show_filters = false;
		$this->set(compact('absences', 'page_legend', 'show_filters'));
		$this->set(compact('school_id'));
		$this->render('index');
	}

/**
 * Shows absences belonging to the user (as either a sub or absentee) using
 * the index view
 */
	public function my() {
		// include absences helper for formatting date ranges
		$this->helpers[] = 'Absence';

		$user_is_teacher = $this->Auth->user('role') === 'teacher';
		$user_is_sub = $this->Auth->user('role') === 'substitute';

		if ($user_is_teacher) {
			$conditions = array(
				'Absence.absentee_id' => $this->Auth->user('id'),
			);
		} elseif ($user_is_sub) {
			$conditions = array(
				'Absence.fulfiller_id' => $this->Auth->user('id'),
			);
		}

		$this->paginate = array(
			'conditions' => $conditions,
			'order' => 'Absence.start DESC'
		);
		$this->set('absences', $this->paginate());
		$this->set('show_filters', false);
		$this->set('page_legend', 'My Absences');
		$this->render('index');
	}

/**
 * Creates an application for an absence from the logged in user
 *
 * @param string id Absence to apply for
 * @return void
 */
	public function apply($id = null) {
		$this->Absence->id = $id;
		if (!$this->Absence->exists()) {
			throw new NotFoundException(__('Invalid absence'));
		}

		$data = array(
			'user_id' => $this->Auth->user('id'),
			'absence_id' => $id
		);
		$this->Absence->Application->create();
		if ($this->Absence->Application->save($data)) {
			$this->Session->setFlash(__('Your application was successful'), 'success');

			// create notification
			$absentee_id = $this->Absence->field('absentee_id');
			$this->_create_notification('application_created', $id, $absentee_id, $this->Auth->user('id'));
		} else {
			$this->Session->setFlash(__('Your application failed'), 'error');
		}
		$this->redirect($this->referer());
	}

/**
 * Deletes an application for an absence from the logged in user
 *
 * @param string id Absence from which to delete application
 * @return void
 */
	public function retract($id = null) {
		$this->Absence->id = $id;
		if (!$this->Absence->exists()) {
			throw new NotFoundException(__('Invalid absence'));
		}

		$conditions = array(
			'Application.user_id' => $this->Auth->user('id'),
			'Application.absence_id' => $id
		);

		if ($this->Absence->Application->deleteAll($conditions)) {
			$this->Session->setFlash('Application retracted', 'success');

			// create notification
			$absentee_id = $this->Absence->field('absentee_id');
			$this->_create_notification('application_retracted', $id, $absentee_id, $this->Auth->user('id'));
		} else {
			$this->Session->setFlash('Application could not be retracted', 'error');
		}
		$this->redirect($this->referer());
	}

/**
 * Removes the logged in user as the fulfilled of an absence
 *
 * @param string id Absence from which to remove fulfiller
 * @return void
 */
	public function renege($id = null) {
		// auth module ensures that logged in user is fulfiller
		$this->Absence->id = $id;
		if (!$this->Absence->exists()) {
			throw new NotFoundException(__('Invalid absence'));
		}

		if ($this->Absence->saveField('fulfiller_id', null)) {
			$this->Session->setFlash('You successfully reneged on the absence', 'success');

			// create notification
			$absentee_id = $this->Absence->field('absentee_id');
			$this->_create_notification('fulfiller_reneged', $id, $absentee_id, $this->Auth->user('id'));
		} else {
			$this->Session->setFlash('You could not renege on this absence', 'error');
		}

		$this->redirect($this->referer());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Absence->id = $id;
		if (!$this->Absence->exists()) {
			throw new NotFoundException(__('Invalid absence'));
		}
		$absence = $this->Absence->read(null, $id);
		$viewer_id = $this->Auth->user('id');

		// include the absence helper for date formatting
		$this->helpers[] = 'Absence';

		// figure out which elements to show
		$show_apply = false;
		$show_retract = false;
		$show_renege = false;
		$show_approve = false;
		$show_deny = false;
		$show_edit = false;
		$show_delete = false;
		$show_applicants = false;
		$show_reject = false;

		// show buttons only if the absence is in the future
		if (strtotime($absence['Absence']['start']) > strtotime('now')) {
			switch ($this->Auth->user('role')) {
			case 'substitute':
				// if the sub has applied, show retract
				// otherwise, show apply if the absence has no
				// fulfiller
				if ($this->Absence->hasApplicationFrom($id, $viewer_id)) $show_retract = true;
				else if (empty($absence['Absence']['fulfiller_id'])) $show_apply = true;

				if ($absence['Absence']['fulfiller_id'] === $viewer_id) $show_renege = true;
				break;
			case 'admin':
				// if the absence is approved, allow deny and
				// vice versa
				if (isset($absence['Approval']['approved']) && $absence['Approval']['approved'] == 0) $show_approve = true;
				else $show_deny = true;
				// if there is no approval record, allow both
				if (empty($absence['Approval']['id'])) $show_approve = $show_deny = true;
				$show_edit = true;
				$show_delete = true;
				$show_applicants = empty($absence['Absence']['fulfiller_id']);
				break;
			case 'teacher':
				$show_edit = true;
				$show_delete = true;
				$show_applicants = $show_reject = $this->Absence->isOwnedBy($id, $viewer_id) && empty($absence['Absence']['fulfiller_id']);
				break;
			}
		}

		// get approval info
		if (!empty($absence['Approval']['id'])) {
			// find the approver
			$this->set('approver', $this->Absence->Approval->Approver->findById($absence['Approval']['approver_id'], array('Approver.username', 'Approver.id')));
		}

		// get list of applicants
		$applications = $this->Absence->Application->findAllByAbsenceId($id, array('Application.id', 'User.id', 'User.username', 'User.email_address', 'User.primary_phone', 'User.first_name', 'User.last_name'));

		$this->set(compact('absence', 'show_apply', 'show_retract', 'show_approve', 'show_deny', 'show_edit', 'show_delete', 'approval_status', 'applications', 'show_applicants', 'show_reject', 'show_renege'));
	}

/**
 * add method
 *
 * @return void
 */
public function add() {
		if ($this->request->is('post')) {
			$this->Absence->create();
			if ($this->Absence->save($this->request->data)) {
				$this->Session->setFlash(__('The absence has been saved'), 'success');
				$absence_id = $this->Absence->getLastInsertId();
				$this->redirect(array('action' => 'view', $absence_id));
			} else {
				$this->Session->setFlash(__('The absence could not be saved. Please, try again.'), 'error');
			}
		}
		$absentees = $this->Absence->Absentee->find(
			'list',
			array(
				'conditions' => array('Absentee.role' => 'teacher')
			)
		);
		$fulfillers = $this->Absence->Fulfiller->find(
			'list',
			array(
				'conditions' => array('Fulfiller.role' => 'substitute')
			)
		);
		$schools = $this->Absence->School->find('list');
		
		// set defaults for the form
		$default_absentee_id = $this->Auth->user('id');
		$default_school_id = $this->Auth->user('school_id');
		
		$this->set(compact('absentees', 'fulfillers', 'schools', 'default_absentee_id', 'default_school_id'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Absence->id = $id;
		if (!$this->Absence->exists()) {
			throw new NotFoundException(__('Invalid absence'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Absence->save($this->request->data)) {
				$this->Session->setFlash(__('The absence has been saved'), 'success');
				$this->redirect(array('action' => 'view', $id));
			} else {
				$this->Session->setFlash(__('The absence could not be saved. Please, try again.'), 'error');
			}
		} else {
			$this->request->data = $this->Absence->read(null, $id);
		}
		$absentees = $this->Absence->Absentee->find('list');
		$fulfillers = $this->Absence->Fulfiller->find('list', array('conditions' => array('Fulfiller.role' => 'substitute')));
		$schools = $this->Absence->School->find('list');
		$this->set(compact('absentees', 'fulfillers', 'schools'));
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Absence->id = $id;
		if (!$this->Absence->exists()) {
			throw new NotFoundException(__('Invalid absence'));
		}
		if ($this->Absence->delete()) {
			$this->Session->setFlash(__('Absence deleted'), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Absence was not deleted'), 'error');
		$this->redirect(array('action' => 'index'));
	}

/**
 * Wraps _update_or_create_approval
 *
 * @param string $id
 * @return void
 */
	public function approval($id = null) {
		$this->_update_or_create_approval($id, true);
	}

/**
 * Wraps _update_or_create_approval
 *
 * @param string $id
 * @return void
 */
	public function denial($id = null) {
		$this->_update_or_create_approval($id, false);
	}

/**
 * Marks an absence as approved or denied by an admin
 * 
 * If there's already an approval and it contradicts the requested status
 * (approved or denied), change it and update the approver. If there is no
 * approval, create it. (A negative approval means an admin has reviewed
 * the absence and denied it, so it isn't really approved, but an approval
 * record is created that notes that it was negative)
 *
 * @param string $id The absence to approve or deny
 * @param boolean $approve Whether to approve or deny the absence
 * @return void
 */
	private function _update_or_create_approval($id, $approve) {
		$this->Absence->id = $id;
		if (!$this->Absence->exists()) {
			throw new NotFoundException(__('Invalid absence'));
		}

		// is there already an approval?
		$approval_exists = false;
		$absence = $this->Absence->read();
		$approval_exists = isset($absence['Approval']) && !empty($absence['Approval']['id']);

		$this->set(compact('approval_exists'));
		$this->set('test', !empty($absence['Approval']['id']));

		if ($approval_exists) {
			// if there is an existing approval, update it
			$this->Absence->Approval->id = $absence['Approval']['id'];
		} else {
			// if there is no approval, make one
			$this->Absence->Approval->create();
		}

		// figure out whether to send an update based on the logic
		// given in the big method comments
		$approval_positive = $absence['Approval']['approved'];
		$update_approval =
		($approval_exists && $approve && !$approval_positive) ||
		($approval_exists && !$approve && $approval_positive) ||
		(!$approval_exists);

		if ($update_approval) {
			$data = array(
				'approver_id' => $this->Auth->user('id'),
				'approved' => $approve ? '1' : '0'
			);

			if ($this->Absence->Approval->save($data)) {
				$this->Session->setFlash(__('Your ' . ($approve ? 'approval' : 'denial') . ' of this absence was successful'), 'success');

				// update the absence with a reference if the
				// approval is new
				if (!$approval_exists) $this->Absence->saveField('approval_id', $this->Absence->Approval->getLastInsertId());

				// create notification
				$absentee_id = $this->Absence->field('absentee_id');
				$this->_create_notification($approve ? 'absence_approved' : 'absence_denied', $id, $absentee_id, $this->Auth->user('id'));
			} else {
				$this->Session->setFlash(__('Your approval failed'), 'error');
			}
		} else {
			$this->Session->setFlash(__('No change was made to the existing approval of this absence'), 'warning');
		}

		$this->redirect(array('action' => 'view', $id));
	}

/**
 * Prepares information for display on the dashboard
 */
	public function dashboard() {
		$this->set('title_for_layout', 'Dashboard');
		$this->set('layout_current', array('dashboard' => true));
		$this->helpers[] = 'Notification';

		$user_id = $this->Auth->user('id');
		$user_role = $this->Auth->user('role');

		// count upcoming absences (conditions depend on role)
		if ($user_role != 'admin') $this->set('num_upcoming_absences', $this->Absence->find('count', array('conditions' => array(
			'Absence.' . ($user_role=='teacher' ? 'absentee_id' : 'fulfiller_id') => $user_id,
			'start > NOW()'
		))));

		// get a short list of upcoming absences
		if ($user_role != 'admin') {
			$absences = $this->Absence->find('all', array(
				'conditions' => array(
					'Absence.' . ($user_role=='teacher' ? 'absentee_id' : 'fulfiller_id') => $user_id,
					'start > NOW()'
				),
				'fields' => array('Absence.id', 'Absence.start', 'Absence.room', 'School.abbreviation', 'Approval.id'),
				'limit' => 5,
				'order' => 'Absence.start ASC'
			));
			$this->set('absences', $absences);
		}

		// organize a list of applicants from the absence data if
		// user is a teacher
		if ($user_role == 'teacher') {
			$applicants = $this->Absence->Application->find('all', array(
				'conditions' => array(
					'Absence.absentee_id' => $user_id
				),
				'fields' => array('User.id', 'User.average_rating', 'User.reviewer_count', 'User.first_name', 'User.last_name', 'Absence.start'),
				'group' => 'User.username',
				'limit' => 5,
				'order' => 'Application.id DESC'
			));
			$this->set('applicants', $applicants);
		}

		// retrieve notifications
		$notifications = $this->Absence->Notification->find('all', array(
			'conditions' => array('Notification.user_id' => $user_id),
			'fields' => array('Other.first_name', 'Other.last_name', 'Notification.notification_type', 'Notification.created', 'Absence.start', 'Absence.id'),
			'limit' => 5,
			'order' => 'Notification.created DESC'
		));

		// get today's absences for admins and count pending absences
		if ($user_role === 'admin') {
			$user_school_id = $this->Auth->user('school_id');
			$this->set('absences_today', $this->Absence->find('all', array(
				'conditions' => array(
					'Absence.school_id' => $user_school_id,
					'Absence.start >=' => date('Y-m-d'),
					'Absence.start <' => date('Y-m-d', strtotime('+1 day'))
				)
			)));
			$this->set('num_pending_absences', $this->Absence->find('count', array(
				'conditions' => array(
					'Absence.approval_id' => null,
					'Absence.start >= NOW()',
					'Absence.school_id' => $user_school_id
				),
				'recursive' => -1
			)));
		}
		$this->set(compact('notifications'));
	}
	
	/*public function ajaxTest($id = null) {
		if ($this->request->is('ajax'))
		{
			CakeLog::debug('is ajax');
			$this->Absence->id = $id;
			if (!$this->Absence->exists()) {
				throw new NotFoundException(__('Invalid absence'));
			}
			$this->set('absence', $this->Absence->read(null, $id));
			$this->render('view', 'ajax');
		}
		
	}*/
}
