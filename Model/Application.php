<?php
App::uses('AppModel', 'Model');
/**
 * Application Model
 *
 * @property User $User
 * @property Absence $Absence
 */
class Application extends AppModel {

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
		)
	);
}
