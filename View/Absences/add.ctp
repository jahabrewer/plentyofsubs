<div class="row">
	<div class="span2">
	</div>
	<div class="offset1 span9">
		<h1>Create Absence</h1>
		<?php echo $this->Form->create('Absence');?>
			<fieldset>
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
