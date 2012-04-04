<?php echo $this->element('SideMenu'); ?>
<h1>Create Absence</h1>
<div id="fullContent">
	<div class="absences form">
	<p>Please use the following form to create an absence. For more information, please see help. Blah blah, more instructional text to come later.</p>
	<?php echo $this->Form->create('Absence');?>
		<fieldset>
			<legend><?php echo __('Add Absence'); ?></legend>
		<?php
			echo $this->Form->hidden('absentee_id', array('default' => $default_absentee_id));
			echo $this->Form->input('fulfiller_id', array('empty' => 'Unspecified'));
			echo $this->Form->input('school_id', array('default' => $default_school_id));
			echo $this->Form->input('room');
			echo $this->Form->input('start', array('interval' => 15));
			echo $this->Form->input('end', array('interval' => 15));
			echo $this->Form->input('comment');
		?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit'));?>
	</div>
</div>
