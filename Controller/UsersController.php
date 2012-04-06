<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

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
		
		if ($this->action === 'view') return true;

		$this->Session->setFlash('You are not authorized for that action', 'error');
		return false;
	}

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('logout');
	}

	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash(__('Invalid username or password, try again'), 'error');
			}
		}
	}

	public function logout() {
		$this->redirect($this->Auth->logout());
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$user = $this->User->read(null, $id);
		$role = $this->Auth->user('role');
		// logic for show review could be better, but it would be
		// expensive
		$show_review = $role === 'teacher';
		$show_edit = $show_delete = $role === 'admin';
		$this->set(compact('user', 'show_review', 'show_edit', 'show_delete'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'), 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'error');
			}
		}
		$educationLevels = $this->User->EducationLevel->find('list');
		$schools = $this->User->School->find('list');
		$preferredSchools = $this->User->PreferredSchool->find('list');
		$this->set(compact('educationLevels', 'schools', 'preferredSchools'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'), 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'error');
			}
		} else {
			$this->request->data = $this->User->read(null, $id);
		}
		$roles = array('admin' => 'Administrator', 'teacher' => 'Teacher', 'substitute' => 'Substitute');
		$educationLevels = $this->User->EducationLevel->find('list');
		$schools = $this->User->School->find('list');
		$preferredSchools = $this->User->PreferredSchool->find('list');
		$this->set(compact('roles', 'educationLevels', 'schools', 'preferredSchools'));
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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'), 'error');
		$this->redirect(array('action' => 'index'));
	}
}
