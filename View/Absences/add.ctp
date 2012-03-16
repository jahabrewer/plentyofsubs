<div class="absences form">
<p>Please use the following form to create an absence. For more information, please see help. Blah blah, more instructional text to come later.</p>
<?php echo $this->Form->create('Absence');?>
	<fieldset>
		<legend><?php echo __('Add Absence'); ?></legend>
	<?php
		echo $this->Form->input('absentee_id', array('default' => $default_absentee_id));
		echo $this->Form->input('fulfiller_id', array('empty' => 'Unspecified'));
		echo $this->Form->input('school_id', array('default' => $default_school_id));
		echo $this->Form->input('room');
		echo $this->Form->input('start');
		echo $this->Form->input('end');
		echo $this->Form->input('comment');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Absences'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Absentee'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Schools'), array('controller' => 'schools', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New School'), array('controller' => 'schools', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Notifications'), array('controller' => 'notifications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Notification'), array('controller' => 'notifications', 'action' => 'add')); ?> </li>
	</ul>
</div>
