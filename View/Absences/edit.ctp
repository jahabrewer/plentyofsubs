<?php $this->extend('base'); ?>

<?php $this->start('pagination'); ?>
	<h2 style="margin:0px; line-height:31.5px;">No. <?php echo $this->data['Absence']['id']; ?></h2>
<?php $this->end(); ?>

<?php $this->start('actions'); ?>
	<button type="submit" class="btn btn-success" form="AbsenceEditForm" style="width:40px;" rel="tooltip" title="Save">
		<?php // FIXME this button's width doesn't match buttons in absence view ?>
		<i class="icon-ok"></i>
	</button>
	<?php echo $this->Html->link(
		'<i class="icon-remove"></i>',
		array('action' => 'view', $this->request->data['Absence']['id']),
		array(
			'class' => 'btn btn-danger',
			'rel' => 'tooltip',
			'title' => 'Return without saving',
			'style' => 'width:40px;',
			'escape' => false
		)
	); ?>
<?php $this->end(); ?>

<?php // TODO migrate this to keyvalue element? ?>
<?php echo $this->Form->create('Absence');?>
<fieldset>
	<?php echo $this->Form->hidden('absentee_id'); ?>
	<?php echo $this->Form->input('id'); ?>
	<div class="row">
		<div class="span3" style="text-align:right;">
			<h1 class="muted">When</h1>
		</div>
		<div class="span3">
			<h4>Start</h4>
			<div class="control-group <?php if ($this->Form->isFieldError('start')) { /*echo 'error';*/ } ?>">
				<div class="controls">
					<?php echo $this->Form->text('start_date', array('class' => 'datepicker', 'required', 'type' => 'date', 'div' => false, 'placeholder' => 'Start Date')); ?>
					<?php echo $this->Form->text('start_time', array('class' => 'timepicker', 'required', 'type' => 'time', 'div' => false, 'placeholder' => 'Start Time')); ?>
					<span class="help-inline"><?php echo $this->Form->error('start'); ?></span>
				</div>
			</div>
		</div>
		<div class="span3">
			<h4>End</h4>
			<div class="control-group <?php if ($this->Form->isFieldError('end')) { /*echo 'error';*/ } ?>">
				<div class="controls">
					<?php echo $this->Form->text('end_date', array('class' => 'datepicker', 'required', 'type' => 'date', 'div' => false, 'placeholder' => 'End Date')); ?>
					<?php echo $this->Form->text('end_time', array('class' => 'timepicker', 'required', 'type' => 'time', 'div' => false, 'placeholder' => 'End Time')); ?>
					<span class="help-inline"><?php echo $this->Form->error('end'); ?></span>
				</div>
			</div>
		</div>
	</div>

	<div class="row" style="background-color:#eee;">
		<div class="span3" style="text-align:right;">
			<h1 class="muted">Where</h1>
		</div>
		<div class="span3">
			<h4>School</h4>
			<?php echo $this->Form->input('school_id', array('label' => false)); ?><br>
		</div>
		<div class="span3">
			<h4>Room</h4>
			<?php echo $this->Form->input('room', array('label' => false)); ?>
		</div>
	</div>
	
	<div class="row">
		<div class="span3" style="text-align:right;">
			<h1 class="muted">What</h1>
		</div>
		<div class="span6">
			<h4>Comments</h4>
			<div class="well"><?php echo $this->Form->input('comment', array('label' => false)); ?></div>
		</div>
	</div>
</fieldset>
<?php echo $this->Form->end();?>
