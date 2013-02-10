<?php $this->extend('base'); ?>

<?php $this->start('actions'); ?>
	<button type="submit" class="btn btn-success" form="SchoolAddForm" style="width:40px;" rel="tooltip" title="Save">
		<?php // FIXME this button's width doesn't match buttons in absence view ?>
		<i class="icon-ok"></i>
	</button>
	<?php echo $this->Html->link(
		'<i class="icon-remove"></i>',
		array('action' => 'index'),
		array(
			'class' => 'btn btn-danger',
			'rel' => 'tooltip',
			'title' => 'Return without saving',
			'style' => 'width:40px;',
			'escape' => false
		)
	); ?>
<?php $this->end(); ?>

<?php echo $this->Form->create('School');?>

	<fieldset>
	<?php 
		$element_items = array(
			array(
				'key' => 'Identity',
				'value' => array(
					array(
						'header' => 'Name',
						'content' => $this->Form->input('name', array('placeholder' => 'Annie Belle Clark Elementary', 'required', 'label' => false, 'div' => false)),
					),
					array(
						'header' => 'Abbreviation',
						'content' => $this->Form->input('abbreviation', array('placeholder' => 'ABC', 'required', 'label' => false, 'div' => false)),
					),
				)
			),
			array(
				'key' => 'Address',
				'value' => array(
					array(
						'header' => '',
						'content' => $this->Form->textarea('street_address', array('required', 'label' => false, 'div' => false)),
					),
				)
			),
		);
		
		echo $this->element('keyvalue', array('items' => $element_items));
	?>
	
	</fieldset>
<?php echo $this->Form->end();?>
