<?php
App::uses('AppController', 'Controller');
/**
 * Reviews Controller
 *
 * @property Review $Review
 */
class ReviewsController extends AppController {

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
		
		if (isset($user['role']) && $user['role'] === 'teacher') {
			return true;
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
		$this->Review->recursive = 0;
		$this->set('reviews', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Review->id = $id;
		if (!$this->Review->exists()) {
			throw new NotFoundException(__('Invalid review'));
		}
		$this->set('review', $this->Review->read(null, $id));
	}

/**
 * add method
 *
 * @param string $id The id of the substitute about whom the review is written
 * @return void
 */
	public function add($id = null) {
		$this->loadModel('Absence');
		$this->Review->Subject->id = $id;
		if (!$this->Review->Subject->exists()) {
			throw new NotFoundException(__('Invalid subject'));
		}

		// check that the subject is a substitute and no review exists
		$subject = $this->Review->Subject->findById($id);
		if ($subject['Subject']['role'] !== 'substitute') {
			$this->Session->setFlash('Reviews may only be written for substitutes', 'error');
			$this->redirect($this->referer());
		}
		$review = $this->Review->find('first', array(
			'conditions' => array(
				'Author.id' => $this->Auth->user('id'),
				'Subject.id' => $id
			)
		));
		if (!empty($review)) {
			$this->Session->setFlash('You\'ve already written a review for this substitute. Please edit the original instead.', 'warning');
			$this->redirect(array('action' => 'edit', $review['Review']['id']));
		}

		// check that user has had an absence fulfilled by subject
		$absence = $this->Absence->find('first', array(
			'conditions' => array(
				'Absence.fulfiller_id' => $id,
				'Absence.absentee_id' => $this->Auth->user('id'),
				'Absence.start < NOW()'
			)
		));
		if (empty($absence)) {
			$this->Session->setFlash('You must have had an absence fulfilled by this substitute in order to write a review.', 'error');
			$this->redirect(array('controller' => 'users', 'action' => 'view', $id));
		}

		if ($this->request->is('post')) {
			if ($this->request->data['Review']['subject_id'] !== $id) {
				$this->Session->setFlash('Data validation error, ID mismatch', 'error');
				$this->redirect(array('controller' => 'users', 'action' => 'view', $id));
			}
			// set the author
			$this->request->data['Review']['author_id'] = $this->Auth->user('id');
			$this->Review->create();
			if ($this->Review->save($this->request->data)) {
				$this->Session->setFlash(__('The review has been saved'), 'success');
				$this->redirect(array('controller' => 'users', 'action' => 'view', $id));
			} else {
				$this->Session->setFlash(__('The review could not be saved. Please, try again.'), 'error');
			}
		}

		$this->set('ratings', array('1' => 'Awful', '2' => 'Poor', '3' => 'Adequate', '4' => 'Good', '5' => 'Excellent'));
		$this->set('subject', $subject);
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Review->id = $id;
		if (!$this->Review->exists()) {
			throw new NotFoundException(__('Invalid review'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Review->save($this->request->data)) {
				$this->Session->setFlash(__('The review has been saved'), 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The review could not be saved. Please, try again.'), 'error');
			}
		} else {
			$this->request->data = $this->Review->read(null, $id);
		}
		$authors = $this->Review->Author->find('list');
		$subjects = $this->Review->Subject->find('list');
		$this->set(compact('authors', 'subjects'));
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
		$this->Review->id = $id;
		if (!$this->Review->exists()) {
			throw new NotFoundException(__('Invalid review'));
		}
		if ($this->Review->delete()) {
			$this->Session->setFlash(__('Review deleted'), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Review was not deleted'), 'error');
		$this->redirect(array('action' => 'index'));
	}

	public function user($id = null) {
		// retrieve subject/user only if sub
		$subject = $this->Review->Subject->findById($id);

		if (empty($subject)) {
			$this->Session->setFlash('That user does not exist', 'error');
			$this->redirect($this->referer());

		} elseif (isset($subject['Subject']['role']) && $subject['Subject']['role'] !== 'substitute') {
			$this->Session->setFlash('You may only view reviews for substitutes', 'error');
			$this->redirect(array('controller' => 'users', 'action' => 'view', $id));
		}

		$this->paginate = array(
			'conditions' => array(
				'Subject.id' => $id,
			),
		);
		$reviews = $this->paginate();
		$this->set(compact('reviews', 'subject'));
	}
}
