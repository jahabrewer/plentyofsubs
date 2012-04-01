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

/**
 * Provides information for validating fields
 */
 	public $validate = array(
		'rating' => array(
			'rule' => array('inList', array('1', '2', '3', '4', '5')),
			'message' => 'Please enter a number between one and five.'
		)
	);

/**
 * This callback recalculates a user's average rating after a review is
 * modified.
 *
 * @param boolean $created Indicates whether a new record was created or not
 */
	public function afterSave($created) {
		$accumulator = 0;
		$accumulator_count = 0;

		$subject_id = $this->data['Review']['subject_id'];
		$reviews = $this->find('all', array(
			'conditions' => array(
				'Review.subject_id' => $subject_id
			)
		));

		foreach ($reviews as $review) {
			$accumulator += $review['Review']['rating'];
			$accumulator_count += 1;
		}

		$this->Subject->id = $subject_id;
		$this->Subject->saveField('average_rating', $accumulator / $accumulator_count);
		$this->Subject->saveField('reviewer_count', $accumulator_count);
	}
}
