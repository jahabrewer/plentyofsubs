<?php
App::uses('AppModel', 'Model');
/**
 * Absence Model
 *
 * @property Absentee $Absentee
 * @property Fulfiller $Fulfiller
 * @property School $School
 * @property Application $Application
 * @property Notification $Notification
 */
class Absence extends AppModel {

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Absentee' => array(
			'className' => 'User',
			'foreignKey' => 'absentee_id',
		),
		'Fulfiller' => array(
			'className' => 'User',
			'foreignKey' => 'fulfiller_id',
		),
		'School' => array(
			'className' => 'School',
			'foreignKey' => 'school_id',
		),
		'Approval' => array(
			'className' => 'Approval',
			'foreignKey' => 'approval_id',
		),
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Application' => array(
			'className' => 'Application',
			'foreignKey' => 'absence_id',
			'dependent' => false,
		),
		'Notification' => array(
			'className' => 'Notification',
			'foreignKey' => 'absence_id',
			'dependent' => false,
		)
	);

/**
 * Validation specifications
 *
 * @var array
 */
	public $validate = array(
		'room' => array(
			'rule' => array('maxLength', 16),
			'message' => 'Room number must be specified and no more than 16 characters',
			'allowEmpty' => false
		),
		'start' => array(
			'rule' => 'dateSanityCheck',
			'message' => 'The start date/time must be before the end date/time',
		)
	);

/**
 * Performs validation on two dates, ensuring that start occurs before end
 *
 * @param array $check Contains the dates to check
 * @return boolean
 */
	public function dateSanityCheck($check) {
		if (isset($check['start']))
			return $check['start'] < $this->data[$this->alias]['end'];
		else
			return $check['end'] > $this->data[$this->alias]['start'];
	}

/**
 * Checks whether an absence is owned by a user
 *
 * @param string $absence_id The absence in question
 * @param string $user_id The user in question
 * @return boolean
 */
	public function isOwnedBy($absence_id, $user_id) {
		return $this->field('id', array('id' => $absence_id, 'absentee_id' => $user_id)) === $absence_id;
	}

/**
 * Checks whether an absence is fulfilled by a user
 *
 * @param string $absence_id The absence in question
 * @param string $user_id The user in question
 * @return boolean
 */
	public function isFulfilledBy($absence_id, $user_id) {
		return $this->field('id', array('id' => $absence_id, 'fulfiller_id' => $user_id)) === $absence_id;
	}

/**
 * Checks whether an absence has received an application from a user
 *
 * @param string $absence_id The absence in question
 * @param string $user_id The user in question
 * @return boolean
 */
	public function hasApplicationFrom($absence_id, $user_id) {
		$application = $this->Application->find('first', array(
			'conditions' => array(
				'Application.user_id' => $user_id,
				'Application.absence_id' => $absence_id
			)
		));
		return !empty($application);
	}

}
