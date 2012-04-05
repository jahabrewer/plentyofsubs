<?php echo $this->element('SideMenu'); ?>
<h1><?php echo __($page_legend);?></h1>
<div id="fullContent">
<div class="absences index">
	<?php if ($show_filters): ?>
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
	<?php endif; ?>
	<div class="table">
		<div class="row">
			<span class="cell"><?php echo $this->Paginator->sort('absentee_id');?></span>
			<span class="cell"><?php echo $this->Paginator->sort('fulfiller_id');?></span>
			<span class="cell"><?php echo $this->Paginator->sort('school_id', 'Location');?></span>
			<span class="cell"><?php echo $this->Paginator->sort('start', 'Date');?></span>
		</div>
		<?php foreach ($absences as $absence): ?>
			<a class="rowLink" href="<?php echo $this->Html->url(array('controller' => 'absences', 'action' => 'view', $absence['Absence']['id'])); ?>">
				<span class="cell">
					<?php echo $absence['Absentee']['username']; ?>
				</span>
				<span class="cell">
					<?php echo $absence['Fulfiller']['username']; ?>&nbsp;
				</span>
				<span class="cell">
					<?php echo "{$absence['School']['name']} {$absence['Absence']['room']}"; ?>
				</span>
				<span class="cell"><?php echo $this->Absence->formatDateRange($absence['Absence']['start'], $absence['Absence']['end'], array('short' => true)); ?>&nbsp;</span>
			</a>
		<?php endforeach; ?>
	</div>
	<hr />
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
