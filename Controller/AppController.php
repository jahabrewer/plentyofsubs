<?php
class AppController extends Controller {
	var $components = array('Auth', 'Session', 'RequestHandler');

	var $user;

	function beforeFilter(){
		global $menus;
		$this->Auth->authenticate = array('Idbroker.Ldap'=>array('userModel'=>'Idbroker.LdapAuth'));
		//If you want to do your authorization from the isAuthorized Controller use the following
		$this->Auth->authorize = array('Controller');
	}

	/*
	 * This just says aslong as this is a valid user let them in, you can also modify this to restrict to a group
	 */
	public function isAuthorized(){
		$user = $this->Auth->user();
		if($user) return true;
		return false;
	}
}
