<div class="absences form">
<?php echo $this->Form->create('Absence');?>
	<fieldset>
		<legend><?php echo __('Edit Absence'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('absentee_id');
		echo $this->Form->input('fulfiller_id', array('empty' => 'Unspecified'));
		echo $this->Form->input('school_id');
		echo $this->Form->input('room');
		echo $this->Form->input('start');
		echo $this->Form->input('end');
		echo $this->Form->input('comment');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
