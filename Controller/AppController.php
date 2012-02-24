<?php
class AppController extends Controller {

	public $components = array(
		'Session',
		'Auth' => array(
			'loginRedirect' => array('controller' => 'pages', 'action' => 'display', 'home'),
			'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home'),
			'authorize' => array('Controller'),
			)
		);

	public function beforeFilter() {
		$this->Auth->allow('display');
		$logged_in = $this->Auth->loggedIn();
		if ($logged_in) {
			$this->set('logged_in_username', $this->Auth->user('username'));
			$this->set('logged_in_role', $this->Auth->user('role'));
		}
		$this->set(compact('logged_in'));
	}

	public function isAuthorized($user) {
		// allow admins everywhere
		if (isset($user['role']) && $user['role'] === 'admin') {
			return true;
		}
		return false;
	}
}
