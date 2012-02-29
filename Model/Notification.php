<?php
App::uses('AppModel', 'Model');
/**
 * Notification Model
 *
 * @property NotificationType $NotificationType
 * @property User $User
 * @property Absence $Absence
 * @property Other $Other
 */
class Notification extends AppModel {

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
		),
		'Absence' => array(
			'className' => 'Absence',
			'foreignKey' => 'absence_id',
		),
		'Other' => array(
			'className' => 'User',
			'foreignKey' => 'other_id',
		)
	);
}
