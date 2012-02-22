<?php
class AppController extends Controller {

	public $components = array(
		'Session',
		'Auth' => array(
			'loginRedirect' => array('controller' => 'users', 'action' => 'add'),
			'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home')
			)
		);

	public function beforeFilter() {
		$this->Auth->allow('index', 'view');
	}
}
