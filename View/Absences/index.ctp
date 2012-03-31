<?php echo $this->element('SideMenu'); ?>
<h1><?php echo __('Absences');?></h1>
<div id="fullContent">
<div class="absences index">
	<div>
		<?php echo $this->Form->create('filter');?>
			<fieldset>
			<?php
			echo $this->Form->radio('date_select', array('anytime', 'before', 'after'), array('default' => 'anytime'));
			echo '<div style="float:left; width:8em;">Date:</div>';
			echo $this->Form->dateTime('date', 'DMY', null, array('empty' => false));
			echo '<br />';
			echo '<div style="float:left; width:8em;">School:</div>';
			echo $this->Form->select('schools', $schools, array('empty' => 'All Schools'));
			echo '<br />';
			echo '<div style="float:left; width:8em;">Teacher:</div>';
			echo $this->Form->select('teachers', $teachers, array('empty' => 'All Teachers'));
			?>
			</fieldset>
		<?php echo $this->Form->end(__('Apply Filter'));?>
	</div>
	<hr />
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php echo $this->Paginator->sort('absentee_id');?></th>
		<th><?php echo $this->Paginator->sort('fulfiller_id');?></th>
		<th><?php echo $this->Paginator->sort('school_id');?></th>
		<th><?php echo $this->Paginator->sort('start');?></th>
		<th><?php echo $this->Paginator->sort('end');?></th>
	</tr>
	<?php
	foreach ($absences as $absence): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($absence['Absentee']['username'], array('controller' => 'users', 'action' => 'view', $absence['Absentee']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($absence['Fulfiller']['username'], array('controller' => 'users', 'action' => 'view', $absence['Fulfiller']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($absence['School']['name'], array('controller' => 'schools', 'action' => 'view', $absence['School']['id'])); ?>
		</td>
		<td><?php echo date('D, M j Y g:i a', strtotime($absence['Absence']['start'])); ?>&nbsp;</td>
		<td><?php echo date('D, M j Y g:i a', strtotime($absence['Absence']['end'])); ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</table>
	<hr />
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
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
