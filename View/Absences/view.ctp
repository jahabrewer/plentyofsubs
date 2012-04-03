<?php echo $this->element('SideMenu-AbsenceDetail'); ?>
<h1><?php  echo __('Absence Info');?></h1>
<div id="fullContent">
	<div class="absences view">
		<div id="leftContent">
			<h4>Info</h4>
			<dl>
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
			</dl>
		</div>
		<div id="rightContent">
			<h4>Details</h4>
			<dl>
				<dt><?php echo __('Id'); ?></dt>
				<dd>
					<?php echo h($absence['Absence']['id']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Administrative Status'); ?></dt>
				<dd>
					<?php echo $approval_status; ?>
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
			</dl>
		</div>
	</div>
	<div class="spacer"></div>
	<dl>
		<dt><?php echo __('Comment'); ?></dt>
		<dd>
			<?php echo h($absence['Absence']['comment']); ?>
		</dd>
	</dl>
<hr />
	<div class="applicantsList">
		<h4>Applicants</h4>
		<!-- Use div class="table" instead of table tags -->
		<div class="table">
			<!-- Use div class="row" instead of tr -->
			<div class="row">
				<!-- Use span class="cell" instead of td or th -->
				<span class="cell">Fulfiller</span>
				<span class="cell">Phone</span>
				<span class="cell">Email</span>
				<span class="cell">Comments</span>
			</div>
			<!-- Use anchor tags to make entire row a link -->
			<a class="rowLink" href="http://www.youtube.com/">
				<span class="cell">Joe Awesome</span>
				<span class="cell">123-456-7890</span>
				<span class="cell">joeawesome@awesomesauce.net</span>
				<span class="cell">I LOVE PEANUT BUTTER</span>
			</a>
			<a class="row">
				<!-- Cell only links works like this -->
				<span class="cell"><a href="http://www.google.com/">Joe Awesome</a></span>
				<span class="cell">123-456-7890</span>
				<span class="cell">joeawesome@awesomesauce.net</span>
				<span class="cell">I LOVE PEANUT BUTTER</span>
			</div>
			
		</div>
	</div>
</div>

<!-- HIDDEN, POSSIBLY REMOVE LATER, MAY BE USEFUL NOW? -->
<div id="sidePanel" style="display:none;">
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

