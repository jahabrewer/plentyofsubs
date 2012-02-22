<?php
App::uses('AppModel', 'Model');
/**
 * UserType Model
 *
 * @property User $User
 */
class UserType extends AppModel {
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
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_type_id',
			'dependent' => false,
		)
	);

}
