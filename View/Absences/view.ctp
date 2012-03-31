<?php //echo $this->element('SideMenu'); ?>
<h1><?php  echo __('Absence');?></h1>
<div id="fullContent">
<div class="absences view">
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($absence['Absence']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Absentee'); ?></dt>
		<dd>
			<?php echo $this->Html->link($absence['Absentee']['username'], array('controller' => 'users', 'action' => 'view', $absence['Absentee']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fulfiller'); ?></dt>
		<dd>
			<?php echo $this->Html->link($absence['Fulfiller']['username'], array('controller' => 'users', 'action' => 'view', $absence['Fulfiller']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Administrative Status'); ?></dt>
		<dd>
			<?php echo $approval_status; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('School'); ?></dt>
		<dd>
			<?php echo $this->Html->link($absence['School']['name'], array('controller' => 'schools', 'action' => 'view', $absence['School']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Room'); ?></dt>
		<dd>
			<?php echo h($absence['Absence']['room']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Start'); ?></dt>
		<dd>
			<?php echo date('D, M j Y g:i a', strtotime($absence['Absence']['start'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('End'); ?></dt>
		<dd>
			<?php echo date('D, M j Y g:i a', strtotime($absence['Absence']['end'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($absence['Absence']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($absence['Absence']['modified']); ?>
			&nbsp;
		</dd>
		<br />
		<dt><?php echo __('Comment'); ?></dt>
		<dd>
			<?php echo h($absence['Absence']['comment']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<hr />
</div>
<div id="sidePanel">
  <p><?php echo 'actions'; ?></p>
  <ul id="sideNav">
    <?php
    if ($show_apply) echo $this->Html->link('<li>'.$this->Html->image('icons/help.png').'Apply'.'</li>', array('controller' => 'absences', 'action' => 'apply', $absence['Absence']['id']), array('escape' => false));
    if ($show_retract) echo $this->Html->link('<li>'.$this->Html->image('icons/help.png').'Retract Application'.'</li>', array('controller' => 'absences', 'action' => 'retract', $absence['Absence']['id']), array('escape' => false));
    if ($show_approve) echo $this->Html->link('<li>'.$this->Html->image('icons/help.png').'Approve'.'</li>', array('controller' => 'absences', 'action' => 'approval', $absence['Absence']['id']), array('escape' => false));
    if ($show_deny) echo $this->Html->link('<li>'.$this->Html->image('icons/help.png').'Deny'.'</li>', array('controller' => 'absences', 'action' => 'denial', $absence['Absence']['id']), array('escape' => false));
    if ($show_edit) echo $this->Html->link('<li>'.$this->Html->image('icons/help.png').'Edit'.'</li>', array('controller' => 'absences', 'action' => 'edit', $absence['Absence']['id']), array('escape' => false));
    if ($show_delete) echo $this->Html->link('<li>'.$this->Html->image('icons/help.png').'Delete'.'</li>', array('controller' => 'absences', 'action' => 'delete', $absence['Absence']['id']), array('escape' => false), 'Are you sure you want to delete this absence?');
    ?>
  </ul>
</div>
