<?php
class AppController extends Controller {

	public $components = array(
		'Session',
		'Auth' => array(
			'loginRedirect' => array('controller' => 'absences', 'action' => 'index'),
			'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home')
			)
		);

	public function beforeFilter() {
		$this->Auth->allow('display');
	}
}
