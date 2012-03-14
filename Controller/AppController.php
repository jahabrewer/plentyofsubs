<?php
/**
 * Functions that will be available to all other controllers
 */
class AppController extends Controller {

	public $components = array(
		'Session',
		'Security',
		'Auth' => array(
			'loginRedirect' => array('controller' => 'absences', 'action' => 'dashboard'),
			'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home'),
			'authorize' => array('Controller'),
			)
		);

/**
 * Sets up the Auth module for the entire site
 */
	public function beforeFilter() {
		// uncomment the two below lines to turn on SSL
		//$this->Security->blackHoleCallback = 'forceSSL';
		//$this->Security->requireSecure();
		$this->Auth->allow('display');
		$logged_in = $this->Auth->loggedIn();
		if ($logged_in) {
			$this->set('logged_in_firstname', $this->Auth->user('first_name'));
			$this->set('logged_in_userid', $this->Auth->user('id'));
		}
		$this->set(compact('logged_in'));
	}

/**
 * This callback redirects users to the SSL version of the requested page
 *
 * @param string $type Which type of security error triggered the callback
 */
	public function forceSSL($type) {
		if ($type === 'secure') $this->redirect('https://localhost'.$this->here);
	}

/**
 * Determines whether users are authorized for actions
 * This is the globally effective version of this method. All other versions
 * of this function will approve a user if this one does.
 *
 * @param array $user Contains information about the logged in user
 * @return boolean Whether the user is authorized for an action
 */
	public function isAuthorized($user) {
		// allow admins everywhere but sub-specific actions
		if (isset($user['role']) && $user['role'] === 'admin' && !in_array($this->action, array('apply', 'retract'))) {
			return true;
		}
		return false;
	}

/**
 * Creates notification records in the database
 *
 * @param string $notification_type The type of notification to create
 * @param string $absence_id The absence this notification regards
 * @param string $user_id The user to whom this notification is addressed
 * @param string $other_id The user whose action generated this notification
 * @return void
 */
	protected function _create_notification($notification_type, $absence_id, $user_id, $other_id) {
		// models aren't autoloaded by default in the app controller
		$this->loadModel('Notification');

		// create the notification array
		$notification = array(
			'notification_type' => $notification_type,
			'absence_id' => $absence_id,
			'user_id' => $user_id,
			'other_id' => $other_id
		);

		// save it
		$this->Notification->save($notification);
	}
}
