<?php $this->extend('base'); ?>

<?php $this->start('pagination'); ?>
	<h2 style="margin:0px; line-height:31.5px;">No. <?php echo $school['School']['id']; ?></h2>
<?php $this->end(); ?>

<?php $this->start('actions'); ?>
	todo: disable/hide school
<?php $this->end(); ?>

<h1><?php echo $school['School']['name']; ?> <small><?php echo $school['School']['abbreviation']; ?></small></h1>

<hr>

<?php
	$element_items = array(
		array(
			'key' => 'Address',
			'value' => array(
				array(
					'header' => '',
					'content' => nl2br($school['School']['street_address']),
				),
			)
		),
		array(
			'key' => 'Stats',
			'value' => array(
				array(
					'header' => 'Teachers',
					'content' => $count['teachers'],
				),
				array(
					'header' => 'Absences',
					'content' => $count['absences'],
				),
			)
		),
	);
	
	echo $this->element('keyvalue', array('items' => $element_items));
?>
