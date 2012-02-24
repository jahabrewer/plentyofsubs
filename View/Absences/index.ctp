<div class="absences index">
	<h2><?php echo __('Absences');?></h2>
	<div>
		<?php echo $this->Form->create('filter');?>
			<fieldset>
			<?php
			echo $this->Form->radio('date_select', array('anytime', 'before', 'after'));
			echo $this->Form->dateTime('date', 'DMY', null, array('empty' => false));
			echo '<br />';
			echo $this->Form->select('schools', $schools, array('empty' => 'All Schools'));
			echo '<br />';
			echo $this->Form->select('teachers', $teachers, array('empty' => 'All Teachers'));
			?>
			</fieldset>
		<?php echo $this->Form->end(__('Apply Filter'));?>
	</div>
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php echo $this->Paginator->sort('id');?></th>
		<th><?php echo $this->Paginator->sort('absentee_id');?></th>
		<th><?php echo $this->Paginator->sort('fulfiller_id');?></th>
		<th><?php echo $this->Paginator->sort('school_id');?></th>
		<th><?php echo $this->Paginator->sort('room');?></th>
		<th><?php echo $this->Paginator->sort('start');?></th>
		<th><?php echo $this->Paginator->sort('end');?></th>
		<th><?php echo $this->Paginator->sort('comment');?></th>
		<th><?php echo $this->Paginator->sort('created');?></th>
		<th><?php echo $this->Paginator->sort('modified');?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($absences as $absence): ?>
	<tr>
		<td><?php echo h($absence['Absence']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($absence['Absentee']['username'], array('controller' => 'users', 'action' => 'view', $absence['Absentee']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($absence['Fulfiller']['username'], array('controller' => 'users', 'action' => 'view', $absence['Fulfiller']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($absence['School']['name'], array('controller' => 'schools', 'action' => 'view', $absence['School']['id'])); ?>
		</td>
		<td><?php echo h($absence['Absence']['room']); ?>&nbsp;</td>
		<td><?php echo h($absence['Absence']['start']); ?>&nbsp;</td>
		<td><?php echo h($absence['Absence']['end']); ?>&nbsp;</td>
		<td><?php echo h($absence['Absence']['comment']); ?>&nbsp;</td>
		<td><?php echo h($absence['Absence']['created']); ?>&nbsp;</td>
		<td><?php echo h($absence['Absence']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $absence['Absence']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $absence['Absence']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $absence['Absence']['id']), null, __('Are you sure you want to delete # %s?', $absence['Absence']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Absence'), array('action' => 'add')); ?></li>
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
