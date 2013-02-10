<?php $this->extend('base'); ?>

<?php $this->start('pagination'); ?>
	<h2 style="margin:0px; line-height:31.5px;">No. <?php echo $user['User']['id']; ?></h2>
<?php $this->end(); ?>

<?php $this->start('actions'); ?>
	<!--<?php echo $this->Html->link(
		'<i class="icon-arrow-left"></i>',
		$referer,
		array(
			'class' => 'btn',
			'rel' => 'tooltip',
			'title' => 'Back',
			'style' => 'width:40px; margin-right:40px;',
			'escape' => false
		)
	); ?>-->
	<div class="btn-group">
		<?php if ($show_edit) echo $this->Html->link(
			'<i class="icon-pencil"></i>',
			array('action' => 'edit', $user['User']['id']),
			array(
				'class' => 'btn',
				'rel' => 'tooltip',
				'title' => 'Edit',
				'style' => 'width:40px;',
				'escape' => false
			)
		); ?>
		<?php if ($show_delete) echo $this->Html->link(
			'<i class="icon-trash"></i>',
			array('action' => 'delete', $user['User']['id']),
			array(
				'class' => 'btn',
				'rel' => 'tooltip',
				'title' => 'Delete',
				'style' => 'width:40px;',
				'escape' => false
			),
			'Are you sure you want to delete this absence?'
		); ?>
	</div>
<?php $this->end(); ?>

<h1>
	<?php echo "{$user['User']['first_name']} {$user['User']['middle_initial']} {$user['User']['last_name']}"; ?>
	<small><?php echo $user['User']['username']; ?></small>
</h1>
<span class="label"><?php echo $roles[$user['User']['role']]; ?></span>

<hr>

<?php
	$element_items = array(
		array(
			'key' => 'Contact',
			'value' => array(
				array(
					'header' => '',
					'content' => $this->Text->autoLinkEmails($user['User']['email_address']),
				),
				array(
					'header' => '',
					'content' => $user['User']['primary_phone'],
				),
			)
		),
	);
	
	if ($user['User']['role'] === 'substitute') {
		$element_items[] = array(
			'key' => 'Sub Info',
			'value' => array(
				array(
					'header' => 'Education',
					'content' => $user['EducationLevel']['name'],
				),
				array(
					'header' => 'Certification Date',
					'content' => $user['User']['certification'],
				),
			)
		);
		if ($show_rating) {
			$element_items[] = array(
				'key' => 'Rating',
				'value' => array(
					array(
						'header' => '',
						'content' => '<strong>' .
							(($user['User']['reviewer_count'] == 0) ? '--' : sprintf('%.1f', $user['User']['average_rating'])) .
							'</strong>/5',
					),
					array(
						'header' => '',
						'content' => ($user['User']['reviewer_count'] == 0) ? 'Not yet rated' : " by {$user['User']['reviewer_count']} teachers",
					),
				)
			);
		}
	} else {
		$element_items[] = array(
			'key' => 'Where',
			'value' => array(
				array(
					'header' => '',
					'content' => $user['School']['name'],
				),
				array(
					'header' => '',
					'content' => nl2br($user['School']['street_address']),
				),
			)
		);
	}
	
	echo $this->element('keyvalue', array('items' => $element_items));
?>
