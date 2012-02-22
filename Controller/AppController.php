<?php
class AppController extends Controller {

	public $components = array(
		'Session',
		'Auth' => array(
			'loginRedirect' => array('controller' => 'absences', 'action' => 'index'),
			'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home'),
			'authorize' => array('Controller'),
			)
		);

	public function beforeFilter() {
		$this->Auth->allow('display');
	}

	public function isAuthorized($user) {
		// allow admins everywhere
		if (isset($user['role']) && $user['role'] === 'admin') {
			return true;
		}
		return false;
	}
}
