<?php
App::uses('AppHelper', 'View/Helper');

/**
 * Collection of methods useful for displaying notifications
 */
class NotificationHelper extends AppHelper {

/**
 * Returns a nicely formatted string generated from the input notification.
 *
 * @param array $notification The notification from which to draw information
 * @return string String representation of the input notification
 */
	public function printNotification($notification) {
		if (!isset($notification['Other']['first_name']) || !isset($notification['Other']['last_name']) || !isset($notification['Notification']['notification_type']) || !isset($notification['Absence']['start'])) return 'input notification had insufficient information';
		$string = "{$notification['Other']['first_name']} {$notification['Other']['last_name']} ";
		switch ($notification['Notification']['notification_type']) {
		case 'application_created':
			$string .= 'submitted an application to your ';
			break;
		case 'application_accepted':
			$string .= 'accepted your application to their ';
			break;
		case 'application_rejected':
			$string .= 'rejected your application to their ';
			break;
		case 'application_retracted':
			$string .= 'retracted their application from your ';
			break;
		case 'fulfiller_reneged':
			$string .= 'reneged on their intent to fulfill your ';
			break;
		case 'absence_approved':
			$string .= 'approved your ';
			break;
		case 'absence_denied':
			$string .= 'denied your ';
			break;
		default:
			$string .= 'FALLTHROUGH ON NOTIFICATION TYPE';
		}
		$string .= date('M j', strtotime($notification['Absence']['start']));
		$string .= ' absence';
		return $string;
	}
}
