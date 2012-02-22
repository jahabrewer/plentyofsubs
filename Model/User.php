<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property UserType $UserType
 * @property EducationLevel $EducationLevel
 * @property School $School
 * @property Application $Application
 * @property Notification $Notification
 * @property School $School
 */
class User extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'username';

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'UserType' => array(
			'className' => 'UserType',
			'foreignKey' => 'user_type_id',
		),
		'EducationLevel' => array(
			'className' => 'EducationLevel',
			'foreignKey' => 'education_level_id',
		),
		'School' => array(
			'className' => 'School',
			'foreignKey' => 'school_id',
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'AbsenceMade' => array(
			'className' => 'Absence',
			'foreignKey' => 'absentee_id',
			'dependent' => false,
		),
		'AbsenceFilled' => array(
			'className' => 'Absence',
			'foreignKey' => 'fulfiller_id',
			'dependent' => false,
		),
		'Application' => array(
			'className' => 'Application',
			'foreignKey' => 'user_id',
			'dependent' => false,
		),
		'Notification' => array(
			'className' => 'Notification',
			'foreignKey' => 'user_id',
			'dependent' => false,
		),
		'NotificationReference' => array(
			'className' => 'Notification',
			'foreignKey' => 'other_id',
			'dependent' => false,
		),
	);


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'PreferredSchool' => array(
			'className' => 'School',
			/*'joinTable' => 'schools_users',
			'foreignKey' => 'user_id',
			'associationForeignKey' => 'school_id',
			'unique' => true,*/
		)
	);

}
