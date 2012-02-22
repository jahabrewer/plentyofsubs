<?php
App::uses('AppModel', 'Model');
/**
 * EducationLevel Model
 *
 * @property User $User
 */
class EducationLevel extends AppModel {
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
			'foreignKey' => 'education_level_id',
			'dependent' => false,
		)
	);

}
