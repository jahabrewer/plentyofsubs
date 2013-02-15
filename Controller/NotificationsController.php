<?php
App::uses('AppController', 'Controller');
/**
 * Notifications Controller
 *
 * @property Notification $Notification
 */
class NotificationsController extends AppController {

	public function isAuthorized($user) {
		return true;
	}
	
	public $components = array('RequestHandler');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Notification->recursive = 0;
		$this->set('notifications', $this->paginate());
	}
	
	public function popover() {
		if ($this->request->is('ajax')) {
			// TODO FIXME DEBUG remove this sleep!!! it's only in for simulating lag
			sleep(1);
			Configure::write('debug', 0);
			$this->layout = 'ajax';
			$notifications = $this->Notification->find('all', array(
				'conditions' => array(
					'Notification.user_id' => $this->Auth->user('id'),
				),
				'order' => array('Notification.new DESC', 'Notification.id DESC'),
			));
			$this->set(compact('notifications'));
			
			// mark notifications as not new
			if (count($notifications) > 0) {
				$this->Notification->updateAll(
					array('Notification.new' => '0'),
					array('Notification.user_id' => $this->Auth->user('id'))
				);
			}
		}
	}
	
	public function countnew() {
		if ($this->request->is('ajax')) {
			// TODO FIXME DEBUG remove this sleep!!! it's only in for simulating lag
			sleep(1);
			$this->autoRender = false;
			Configure::write('debug', 0);
			$this->layout = 'ajax';
			$count = $this->Notification->find('count', array(
				'conditions' => array(
					'Notification.user_id' => $this->Auth->user('id'),
					'Notification.new' => '1',
				)
			));
			if ($count > 0) { echo $count; }
		}
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Notification->exists($id)) {
			throw new NotFoundException(__('Invalid notification'));
		}
		$options = array('conditions' => array('Notification.' . $this->Notification->primaryKey => $id));
		$this->set('notification', $this->Notification->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Notification->create();
			if ($this->Notification->save($this->request->data)) {
				$this->flash(__('Notification saved.'), array('action' => 'index'));
			} else {
			}
		}
		$users = $this->Notification->User->find('list');
		$absences = $this->Notification->Absence->find('list');
		$others = $this->Notification->Other->find('list');
		$this->set(compact('users', 'absences', 'others'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Notification->exists($id)) {
			throw new NotFoundException(__('Invalid notification'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Notification->save($this->request->data)) {
				$this->flash(__('The notification has been saved.'), array('action' => 'index'));
			} else {
			}
		} else {
			$options = array('conditions' => array('Notification.' . $this->Notification->primaryKey => $id));
			$this->request->data = $this->Notification->find('first', $options);
		}
		$users = $this->Notification->User->find('list');
		$absences = $this->Notification->Absence->find('list');
		$others = $this->Notification->Other->find('list');
		$this->set(compact('users', 'absences', 'others'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Notification->id = $id;
		if (!$this->Notification->exists()) {
			throw new NotFoundException(__('Invalid notification'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Notification->delete()) {
			$this->flash(__('Notification deleted'), array('action' => 'index'));
		}
		$this->flash(__('Notification was not deleted'), array('action' => 'index'));
		$this->redirect(array('action' => 'index'));
	}
}
