<?php $this->start('sidebar'); ?>
	<?php
		$button_class = array(
			'my' => '',
			'available' => '',
			'all' => '',
			'pending' => '',
		);
		if (isset($button_active)) {
			$button_class['my'] = $button_active['my'] ? 'active' : '';
			$button_class['available'] = $button_active['available'] ? 'active' : '';
			$button_class['all'] = $button_active['all'] ? 'active' : '';
			$button_class['pending'] = $button_active['pending'] ? 'active' : '';
		}
	?>
	<?php if ($button_visibility['new']) echo $this->Html->link('New Absence', array('action' => 'add'), array('class' => 'btn btn-block btn-success', 'style' => 'margin-bottom:30px;')); ?>
	<?php if ($button_visibility['my']) echo $this->Html->link('My', array('action' => 'my'), array('class' => "btn btn-block ${button_class['my']}", 'style' => 'text-align:left; padding-left:10px;')); ?>
	<?php if ($button_visibility['available']) echo $this->Html->link('Available', array('action' => 'available'), array('class' => "btn btn-block ${button_class['available']}", 'style' => 'text-align:left; padding-left:10px;')); ?>
	<?php if ($button_visibility['all']) echo $this->Html->link('All', array('action' => 'index'), array('class' => "btn btn-block ${button_class['all']}", 'style' => 'text-align:left; padding-left:10px;')); ?>
	<?php if ($button_visibility['pending']) echo $this->Html->link('Pending', array('action' => 'pending'), array('class' => "btn btn-block ${button_class['pending']}", 'style' => 'text-align:left; padding-left:10px;')); ?>
<?php $this->end(); ?>

<?php echo $this->fetch('content'); ?>
