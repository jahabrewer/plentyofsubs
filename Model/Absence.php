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

	public function isOwnedBy($absence_id, $user_id) {
		return $this->field('id', array('id' => $absence_id, 'absentee_id' => $user_id)) === $absence_id;
	}

	public function isFulfilledBy($absence_id, $user_id) {
		return $this->field('id', array('id' => $absence_id, 'fulfiller_id' => $user_id)) === $absence_id;
	}

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
