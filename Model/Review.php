<?php
App::uses('AppModel', 'Model');
/**
 * Review Model
 *
 * @property Author $Author
 * @property Subject $Subject
 */
class Review extends AppModel {

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Author' => array(
			'className' => 'User',
			'foreignKey' => 'author_id',
		),
		'Subject' => array(
			'className' => 'User',
			'foreignKey' => 'subject_id',
		)
	);
}
