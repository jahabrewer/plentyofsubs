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
	<div class="table">
		<div class="row">
			<span class="cell"><?php echo $this->Paginator->sort('absentee_id');?></span>
			<span class="cell"><?php echo $this->Paginator->sort('fulfiller_id');?></span>
			<span class="cell"><?php echo $this->Paginator->sort('school_id');?></span>
			<span class="cell"><?php echo $this->Paginator->sort('start');?></span>
			<span class="cell"><?php echo $this->Paginator->sort('end');?></span>
		</div>
	<?php foreach ($absences as $absence): ?>
	<!-- Entire row as a link is as below -->
		<a class="rowLink" href="www.google.com">
			<!-- Having a link in a table cell when the row is a link itself doesn't work for some reason
				From what I see online, you can't have a cell as a link when the row is already linking somewhere
				maybe using javascript onlick would work but it's not a real anchor tag link
				Check the test row below -->
			<span class="cell">
				<?php echo $this->Html->link($absence['Absentee']['username'], array('controller' => 'users', 'action' => 'view', $absence['Absentee']['id'])); ?>
			</span>
			<span class="cell">
				<?php echo $this->Html->link($absence['Fulfiller']['username'], array('controller' => 'users', 'action' => 'view', $absence['Fulfiller']['id'])); ?>
			</span>
			<span class="cell">
				<?php echo $this->Html->link($absence['School']['name'], array('controller' => 'schools', 'action' => 'view', $absence['School']['id'])); ?>
			</span>
			<span class="cell"><?php echo date('D, M j Y g:i a', strtotime($absence['Absence']['start'])); ?>&nbsp;</span>
			<span class="cell"><?php echo date('D, M j Y g:i a', strtotime($absence['Absence']['end'])); ?>&nbsp;</span>
		</a>
<?php endforeach; ?>
		<!-- this row works fine and is essentially the same, just without cakephp link 
			We could either have no links inside the row, the user won't be able to click on a name or school for info
			Or we can not use row links and just have a column with view link like before -->
		<a class="rowLink" href="#">
			<span class="cell">Tess</span>
			<span class="cell"></span>
			<span class="cell">John Smith High</span>
			<span class="cell">Mon, Apr 9 2012 3:08 am</span>
			<span class="cell">Mon, Apr 9 2012 3:08 am</span>
		</a>
	</div>
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
