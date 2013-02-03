<script>
	$(function() {
		$( "#datepicker" ).datepicker();
	});
</script>

<div class="row">
	<div class="span3">
		<?php if ($show_filters): ?>
			<?php echo $this->Form->create('filter', array('class' => '')); ?>
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="filterDateSelect">When</label>
						<div class="controls">
							<?php echo $this->Form->select('date_select', array('before' => 'Before', 'after' => 'After'), array('empty' => 'Anytime')); ?>
							<?php echo $this->Form->text('date', array('id' => 'datepicker', 'placeholder' => 'Date')); ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="filterSchools">Where</label>
						<div class="controls">
							<?php echo $this->Form->select('schools', $schools, array('empty' => 'All Schools')); ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="filterTeachers">Who</label>
						<div class="controls">
							<?php echo $this->Form->select('teachers', $teachers, array('empty' => 'All Teachers')); ?>
						</div>
					</div>
				</fieldset>
			<?php echo $this->Form->end(array('label' => 'Apply Filter', 'class' => 'btn'));?>
			<hr>
		<?php endif; ?>
	</div>
	<div class="span9">
		<h1><?php echo __($page_legend);?></h1>
		
		<table class="table table-striped">
			<thead>
				<tr>
					<th><?php echo $this->Paginator->sort('absentee_id');?></th>
					<th><?php echo $this->Paginator->sort('fulfiller_id');?></th>
					<th><?php echo $this->Paginator->sort('school_id', 'Location');?></th>
					<th><?php echo $this->Paginator->sort('start', 'Date');?></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($absences as $absence): ?>
					<tr>
						<td><?php echo $absence['Absentee']['username']; ?></td>
						<td><?php echo $absence['Fulfiller']['username']; ?></td>
						<td><?php echo "{$absence['School']['abbreviation']} {$absence['Absence']['room']}"; ?></td>
						<td><?php echo $this->Absence->formatDateRange($absence['Absence']['start'], $absence['Absence']['end'], array('short' => true)); ?></td>
						<td><?php echo $this->Html->link('View', array('action' => 'view', $absence['Absence']['id'])); ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<hr>
		<p>
		<?php
		echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} absences out of {:count} total')
		));
		?>	</p>

		<div class="paging">
		<?php
			echo '<div style="display:block; float:right;">';
			echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
			echo '&nbsp;';
			echo $this->Paginator->numbers(array('separator' => ''));
			echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
			echo '</div>';
		?>
		</div>
	</div>
</div>
