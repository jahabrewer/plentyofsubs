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
				<dt><?php echo __('Date'); ?></dt>
				<dd>
					<?php echo $this->Absence->formatDateRange($absence['Absence']['start'], $absence['Absence']['end']); ?>
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
					<?php 
						if (isset($approver)) {
							if ($absence['Approval']['approved'] == 1)
								echo 'Approved';
							else
								echo 'Denied';
							echo " by {$approver['Approver']['username']} on ";
							echo date('M j, Y', strtotime($absence['Approval']['modified']));
						} else {
							echo 'Unreviewed';
						}
					?>
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
			<?php echo nl2br(h($absence['Absence']['comment'])); ?>
		</dd>
	</dl>

	<?php if ($show_applicants): ?>
		<hr />
		<div class="applicantsList">
			<h4>Applicants</h4>
			<?php if (empty($applications)): ?>
				<p>There are no applicants for this absence at this time.</p>
			<?php else: ?>
				<!-- Use div class="table" instead of table tags -->
				<div class="table">
					<!-- Use div class="row" instead of tr -->
					<div class="row">
						<!-- Use span class="cell" instead of td or th -->
						<span class="cell">Fulfiller</span>
						<span class="cell">Phone</span>
						<span class="cell">Email</span>
						<span class="cell">&nbsp;</span>
						<span class="cell">&nbsp;</span>
						<?php if ($show_reject): ?><span class="cell">&nbsp;</span><?php endif; ?>
					</div>
					<?php foreach ($applications as $application): ?>
						<div class="rowLink">
							<span class="cell"><?php echo "{$application['User']['first_name']} {$application['User']['last_name']} ({$application['User']['username']})"; ?></span>
							<span class="cell"><?php echo $application['User']['primary_phone']; ?></span>
							<span class="cell"><?php echo $application['User']['email_address']; ?></span>
							<span class="cell"><?php echo $this->Html->link('View Sub Details', array('controller' => 'users', 'action' => 'view', $application['User']['id'])); ?></span>
							<span class="cell"><?php echo $this->Html->link('Accept Application', array('controller' => 'applications', 'action' => 'accept', $application['Application']['id'])); ?></span>
							<?php if ($show_reject): ?><span class="cell"><?php echo $this->Html->link('Reject Application', array('controller' => 'applications', 'action' => 'reject', $application['Application']['id'])); ?></span><?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	<?php endif; ?>
</div>
<div id="sidePanel">
	<p>actions</p>
	<ul id="sideNav">
		<?php
			if ($show_apply) echo $this->Html->link('<li>'.$this->Html->image('icons/apply_absence.png').'Apply</li>', array('controller' => 'absences', 'action' => 'apply', $absence['Absence']['id']), array('escape' => false));
			if ($show_retract) echo $this->Html->link('<li>'.$this->Html->image('icons/retract_application.png').'Retract Application</li>', array('controller' => 'absences', 'action' => 'retract', $absence['Absence']['id']), array('escape' => false));
			if ($show_renege) echo $this->Html->link('<li>'.$this->Html->image('icons/help.png').'Renege</li>', array('controller' => 'absences', 'action' => 'renege', $absence['Absence']['id']), array('escape' => false));
			if ($show_approve) echo $this->Html->link('<li>'.$this->Html->image('icons/approve.png').'Approve</li>', array('controller' => 'absences', 'action' => 'approval', $absence['Absence']['id']), array('escape' => false));
			if ($show_deny) echo $this->Html->link('<li>'.$this->Html->image('icons/deny.png').'Deny</li>', array('controller' => 'absences', 'action' => 'denial', $absence['Absence']['id']), array('escape' => false));
			if ($show_edit) echo $this->Html->link('<li>'.$this->Html->image('icons/edit.png').'Edit</li>', array('controller' => 'absences', 'action' => 'edit', $absence['Absence']['id']), array('escape' => false));
			if ($show_delete) echo $this->Html->link('<li>'.$this->Html->image('icons/delete.png').'Delete</li>', array('controller' => 'absences', 'action' => 'delete', $absence['Absence']['id']), array('escape' => false), 'Are you sure you want to delete this absence?');
		?>
	</ul>
</div>
