<?php
App::uses('AppController', 'Controller');
/**
 * Absences Controller
 *
 * @property Absence $Absence
 */
class AbsencesController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Absence->recursive = 0;
		$this->set('absences', $this->paginate());
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
		$this->set('absence', $this->Absence->read(null, $id));
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
				$this->Session->setFlash(__('The absence has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The absence could not be saved. Please, try again.'));
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
				$this->Session->setFlash(__('The absence has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The absence could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Absence->read(null, $id);
		}
		$absentees = $this->Absence->Absentee->find('list');
		$fulfillers = $this->Absence->Fulfiller->find('list');
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
			$this->Session->setFlash(__('Absence deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Absence was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
