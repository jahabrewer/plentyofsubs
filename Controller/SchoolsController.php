<?php
App::uses('AppController', 'Controller');
/**
 * Schools Controller
 *
 * @property School $School
 */
class SchoolsController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this->set('layout_current', 'schools');
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->School->recursive = 0;
		$this->paginate = array(
			'limit' => 10,
		);
		$this->set('schools', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->School->exists($id)) {
			throw new NotFoundException(__('Invalid school'));
		}
		$options = array('conditions' => array('School.' . $this->School->primaryKey => $id));
		$this->set('school', $this->School->find('first', $options));
		
		// retrieve stats
		$this->loadModel('User');
		$count = array(
			'teachers' => $this->User->find('count', array(
				'conditions' => array('User.school_id' => $id)
			)),
			'absences' => $this->School->Absence->find('count', array(
				'conditions' => array('Absence.school_id' => $id)
			)),
		);
		
		$this->set('count', $count);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->School->create();
			if ($this->School->save($this->request->data)) {
				$this->Session->setFlash(__('The school has been saved'), 'success');
				$this->redirect(array('action' => 'view', $this->School->getLastInsertId()));
			} else {
				$this->Session->setFlash(__('The school could not be saved. Please, try again.'), 'error');
			}
		}
		$users = $this->School->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	/*public function edit($id = null) {
		if (!$this->School->exists($id)) {
			throw new NotFoundException(__('Invalid school'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->School->save($this->request->data)) {
				$this->Session->setFlash(__('The school has been saved'), 'success');
				$this->redirect(array('action' => 'view', $id));
			} else {
				$this->Session->setFlash(__('The school could not be saved. Please, try again.'), 'error');
			}
		} else {
			$options = array('conditions' => array('School.' . $this->School->primaryKey => $id));
			$this->request->data = $this->School->find('first', $options);
		}
		$users = $this->School->User->find('list');
		$this->set(compact('users'));
	}*/

/**
 * delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	/*public function delete($id = null) {
		$this->School->id = $id;
		if (!$this->School->exists()) {
			throw new NotFoundException(__('Invalid school'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->School->delete()) {
			$this->Session->setFlash(__('School deleted'), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('School was not deleted'), 'error');
		$this->redirect(array('action' => 'index'));
	}*/
}
