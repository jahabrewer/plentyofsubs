<?php $this->extend('base'); ?>

<?php $this->start('actions'); ?>
	<button type="submit" class="btn btn-success" form="UserEditForm" style="width:40px;" rel="tooltip" title="Save">
		<?php // FIXME this button's width doesn't match buttons in absence view ?>
		<i class="icon-ok"></i>
	</button>
	<?php echo $this->Html->link(
		'<i class="icon-remove"></i>',
		array('action' => 'view', $this->request->data['User']['id']),
		array(
			'class' => 'btn btn-danger',
			'rel' => 'tooltip',
			'title' => 'Return without saving',
			'style' => 'width:40px;',
			'escape' => false
		)
	); ?>
<?php $this->end(); ?>

<?php echo $this->Form->create('User');?>

	<fieldset>
	<?php echo $this->Form->hidden('id'); ?>
	<?php echo $this->Form->hidden('username'); ?>
	<?php 
		$element_items = array(
			array(
				'key' => 'Name',
				'value' => array(
					array(
						'header' => '',
						'content' => $this->Form->input('first_name', array('class' => 'input-small', 'required', 'label' => false, 'div' => false, 'style' => 'margin-right:10px;')) .
							$this->Form->input('middle_initial', array('class' => 'input-mini', 'label' => false, 'div' => false, 'style' => 'margin-right:10px;')) .
							$this->Form->input('last_name', array('class' => 'input-small', 'required', 'label' => false, 'div' => false)),
					),
				)
			),
			array(
				'key' => 'Role',
				'value' => array(
					array(
						'header' => '',
						'content' => $this->Form->input('role', array('label' => false, 'div' => false)),
					),
				)
			),
			array(
				'key' => 'Phone',
				'value' => array(
					array(
						'header' => 'Primary',
						'content' => $this->Form->input('primary_phone', array('type' => 'tel', 'required', 'label' => false, 'div' => false)),
					),
					array(
						'header' => 'Secondary',
						'content' => $this->Form->input('secondary_phone', array('type' => 'tel', 'label' => false, 'div' => false)),
					),
				)
			),
			array(
				'key' => 'Email',
				'value' => array(
					array(
						'header' => '',
						'content' => $this->Form->input('email_address', array('type' => 'email', 'required', 'label' => false, 'div' => false)),
					),
				)
			),
		);
		
		if ($show_sub_fields) {
			$element_items[] = array(
				'key' => 'Sub Info',
				'value' => array(
					array(
						'header' => 'Education',
						'content' => $this->Form->input('education_level_id', array('label' => false, 'div' => false)),
					),
					array(
						'header' => 'Certification Date',
						'content' => $this->Form->text('certification', array('type' => 'date', 'class' => 'datepicker', 'label' => false, 'div' => false)),
					),
				)
			);
		} else {
			$element_items[] = array(
				'key' => 'School',
				'value' => array(
					array(
						'header' => '',
						'content' => $this->Form->input('school_id', array('label' => false, 'div' => false)),
					),
				)
			);
		}
		
		echo $this->element('keyvalue', array('items' => $element_items));
	?>
	
	</fieldset>
<?php echo $this->Form->end();?>
