<?php
App::uses('AppModel', 'Model');
/**
 * School Model
 *
 * @property Absence $Absence
 * @property User $User
 * @property User $User
 */
class School extends AppModel {
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
		'Absence' => array(
			'className' => 'Absence',
			'foreignKey' => 'school_id',
			'dependent' => false,
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'school_id',
			'dependent' => false,
		)
	);
	
	
	public $validate = array(
		'name' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Required'
			)
		),
		'abbreviation' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Required'
			)
		),
		'street_address' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Required'
			)
		),
	);


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'User' => array(
			'className' => 'User',
			/*'joinTable' => 'schools_users',
			'foreignKey' => 'school_id',
			'associationForeignKey' => 'user_id',
			'unique' => true,*/
		)
	);

}
