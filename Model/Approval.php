<?php
App::uses('AppModel', 'Model');
/**
 * Approval Model
 *
 * @property Absence $Absence
 * @property Approver $Approver
 */
class Approval extends AppModel {

/**
 * hasOne associations
 *
 * @var array
 */
	public $hasOne = array(
		'Absence' => array(
			'className' => 'Absence',
			'foreignKey' => 'approval_id',
		)
	);

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Approver' => array(
			'className' => 'User',
			'foreignKey' => 'approver_id',
		)
	);
}
