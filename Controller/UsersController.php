<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

    public $components = array('RequestHandler');

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
		
		if (in_array($this->action, array('view', 'changepassword'))) return true;
		
		// let users edit themselves
		if ($this->action === 'edit' && $this->request->params['pass'][0] == $this->Auth->user('id')) return true;

		$this->Session->setFlash('You are not authorized for that action', 'error');
		return false;
	}

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('logout');
		$this->Security->unlockedActions = array('changepassword');
		$this->set('layout_current', 'users');
	}

	public function login() {
		$this->layout = 'basic';
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
		
		// build conditions from filters
		$conditions = array();
		$filter =& $this->request->query;
		
		if (isset($filter['school']) && !empty($filter['school'])) {
			$conditions['School.name'] = $this->request->data['filter']['school'] = $filter['school'];
		}
		if (isset($filter['role']) && !empty($filter['role'])) {
			$conditions['User.role'] = $this->request->data['filter']['role'] = $filter['role'];
		}
		
		$this->paginate = array(
			'conditions' => $conditions,
			'limit' => 10,
		);
		$this->set('users', $this->paginate());
		
		$schools = $this->User->School->find('list');
		$schools_flat = '["' . implode('","', array_values($schools)) . '"]';
		
		$this->set(compact('schools_flat'));
		$this->set('roles', array('admin' => 'Administrator', 'teacher' => 'Teacher', 'substitute' => 'Substitute'));
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
		$roles = array('admin' => 'Administrator', 'teacher' => 'Teacher', 'substitute' => 'Substitute');
		
		$show_rating = $role !== 'substitute';
		$show_edit = $show_delete = $role === 'admin';
		$this->set(compact('user', 'show_rating', 'show_edit', 'show_delete', 'roles'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			
			// strip info based on role
			if ($this->request->data['User']['role'] === 'substitute') {
				unset($this->request->data['User']['school_id']);
			} else {
				unset($this->request->data['User']['certification']);
				unset($this->request->data['User']['education_level_id']);
			}
			
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'), 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'error');
			}
		}
		$educationLevels = $this->User->EducationLevel->find('list');
		$schools = $this->User->School->find('list');
		$roles = array('admin' => 'Administrator', 'teacher' => 'Teacher', 'substitute' => 'Substitute');
		$this->set(compact('educationLevels', 'schools', 'roles'));
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
			// strip info based on role
			if ($this->request->data['User']['role'] === 'substitute') {
				unset($this->request->data['User']['school_id']);
			} else {
				unset($this->request->data['User']['certification']);
				unset($this->request->data['User']['education_level_id']);
			}
			
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'), 'success');
				$this->redirect(array('action' => 'view', $id));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'error');
			}
		} else {
			$this->request->data = $this->User->read(null, $id);
		}
		$roles = array('admin' => 'Administrator', 'teacher' => 'Teacher', 'substitute' => 'Substitute');
		$educationLevels = $this->User->EducationLevel->find('list');
		$schools = $this->User->School->find('list');
		//$preferredSchools = $this->User->PreferredSchool->find('list');
		
		// determine which inputs to show
		$input_visibility = array(
			'name' => false,
			'role' => false,
			//'phone' => true,
			//'email' => true,
			//'school' => true,
		);
		if ($this->Auth->user('role') === 'admin') {
			$input_visibility['name'] = true;
			$input_visibility['role'] = true;
		}
		
		$this->set(compact('roles', 'educationLevels', 'schools', 'input_visibility'));
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
	
	public function changepassword() {
		if ($this->request->is('ajax')) {
			$this->RequestHandler->setContent('json');
			Configure::write('debug', 0);
			// TODO FIXME DEBUG DELETE ME
			sleep(1);
		
			$success = false;
			$oldPasswordIncorrect = false;
			$reason = 'unspecified';
		
			$this->User->id = $this->Auth->user('id');
			CakeLog::debug('plaintext from request: ' . $this->request->data['oldPassword']);
			$oldHashed = AuthComponent::password($this->request->data['oldPassword']);
			CakeLog::debug('hashed from request: ' . $oldHashed);
			$user = $this->User->read('password');
			CakeLog::debug('hashed from model: ' . $user['User']['password']);
			if ($oldHashed !== $user['User']['password']) {
				$oldPasswordIncorrect = true;
				$reason = 'Old password incorrect';
			} else {
				if ($this->request->data['newPassword'] !== $this->request->data['confirmPassword']) {
					$reason = 'New passwords did not match';
				} else {
					// commit it
					$this->User->set('password', $this->request->data['newPassword']);
					if ($this->User->save()) {
						$success = true;
					} else {
						$reason = 'Save failed, try again later';
					}
				}
			}
			$this->set(compact('success', 'reason', 'oldPasswordIncorrect'));
			$this->set('_serialize', array('success', 'reason', 'oldPasswordIncorrect'));
		}
	}
}
