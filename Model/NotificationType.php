<?php
App::uses('AppModel', 'Model');
/**
 * NotificationType Model
 *
 * @property Notification $Notification
 */
class NotificationType extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Notification' => array(
			'className' => 'Notification',
			'foreignKey' => 'notification_type_id',
			'dependent' => false,
		)
	);

}
