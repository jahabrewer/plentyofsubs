<?php
class UsersController extends AppController {
	var $name = 'Users';

	/*
	 * Make sure to define which functions don't require auth to be accessed
	 */
	function beforeFilter(){
		$this->Auth->allow('usernameExists', 'forgotPassword', 'signup','login','logout');
		parent::beforeFilter();
	}

	function login(){
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->Session->setFlash(__('Login successful'));
				//return $this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash(__('Username or password is incorrect'), 'default', array('class'=>'error-message'), 'auth');
			}
		}
	}

	function logout(){
		$this->log("Destroying session",'debug');
		$this->Session->destroy();
		$this->redirect($this->Auth->logout());
	}
}
