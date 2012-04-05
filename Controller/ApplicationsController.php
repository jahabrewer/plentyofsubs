<?php
/**
 * This class holds only some of the application related functions,
 * particularly the ones that are easier to code when addressed with an
 * application ID.
 */
class ApplicationsController extends AppController {

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

		// teachers (and admins) only
		if ($user['role'] === 'teacher') {
			// check for ownership of absence
			$application_id = $this->request->params['pass'][0];
			$this->Application->id = $application_id;
			$absence_id = $this->Application->field('absence_id');
			return $this->Application->Absence->isOwnedBy($absence_id, $user['id']);
		}

		$this->Session->setFlash('You are not authorized for that action', 'error');
		return false;
	}

/**
 * Marks the applicant user as the fulfiller of an absence and deletes
 * any other applications for the same absence
 *
 * @param string $id The accepted application (references a user and absence)
 * @return void
 */
	public function accept($id = null) {
		// auth module ensures ownership, so no need to check here
		$this->Application->id = $id;
		if (!$this->Application->exists()) {
			throw new NotFoundException(__('Invalid application'));
		}

		// give the sub the absence
		$application = $this->Application->findById($id);
		$applicant_id = $application['Application']['user_id'];
		$absence_id = $application['Application']['absence_id'];
		$this->Application->Absence->id = $absence_id;
		$this->Application->Absence->set('fulfiller_id', $applicant_id);
		$this->Application->Absence->save();

		// clear the other applications
		if ($this->Application->deleteAll(array('Application.absence_id' => $absence_id))) {
			$this->Session->setFlash('Application accepted', 'success');

			// generate notification
			$this->_create_notification('application_accepted', $absence_id, $applicant_id, $this->Auth->user('id'));
		} else {
			$this->Session->setFlash('The application could not be accepted', 'error');
		}

		$this->redirect($this->referer());
	}

/**
 * Deletes an application for an absence
 *
 * @param string $id The application to delete
 * @return void
 */
	public function reject($id = null) {
		// auth module ensures ownership, so no need to check here
		$this->Application->id = $id;
		if (!$this->Application->exists()) {
			throw new NotFoundException(__('Invalid application'));
		}

		// get information for the notification
		$application = $this->Application->findById($id);
		$applicant_id = $application['Application']['user_id'];
		$absence_id = $application['Application']['absence_id'];

		if ($this->Application->delete($id)) {
			$this->Session->setFlash('Application rejected', 'success');
			// generate notification
			$this->_create_notification('application_rejected', $absence_id, $applicant_id, $this->Auth->user('id'));
		} else {
			$this->Session->setFlash('The application could not be rejected', 'error');
		}

		$this->redirect($this->referer());
	}
}
