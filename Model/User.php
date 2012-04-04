<?php
App::uses('AppModel', 'Model', 'AuthComponent', 'Controller/Component');
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
	public $validate = array(
		'username' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'A username is required'
			)
		),
		'password' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'A password is required'
			)
		),
		'role' => array(
			'valid' => array(
				'rule' => array('inList', array('admin', 'teacher', 'substitute')),
				'message' => 'Please enter a valid role',
				'allowEmpty' => false
			)
		),
		'middle_initial' => array(
			'rule' => array('maxLength', 1),
			'message' => 'Middle initial must be no more than 1 character'
		),
		'primary_phone' => array(
			'phone' => array(
				'rule' => array('phone', null, 'us'),
				'message' => 'Primary phone number must be a valid US phone number'
			),
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'A primary phone number is required'
			)
		),
		'secondary_phone' => array(
			'rule' => array('phone', null, 'us'),
			'message' => 'Secondary phone number must be a valid US phone number',
			'allowEmpty' => true
		),
		'email_address' => array(
			'email' => array(
				'rule' => 'email',
				'message' => 'This is not a valid email address'
			),
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'An email address is required'
			)
		),
	);

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
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
		'Approval' => array(
			'className' => 'Approval',
			'foreignKey' => 'approver_id',
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

	public function beforeSave() {
		if (isset($this->data[$this->alias]['password'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}
		return true;
	}

}
