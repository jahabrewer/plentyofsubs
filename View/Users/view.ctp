<div class="users view">
<h2><?php  echo __('User');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($user['User']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($user['User']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Role'); ?></dt>
		<dd>
			<?php echo h($user['User']['role']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('First Name'); ?></dt>
		<dd>
			<?php echo h($user['User']['first_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Middle Initial'); ?></dt>
		<dd>
			<?php echo h($user['User']['middle_initial']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Name'); ?></dt>
		<dd>
			<?php echo h($user['User']['last_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Primary Phone'); ?></dt>
		<dd>
			<?php echo h($user['User']['primary_phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Secondary Phone'); ?></dt>
		<dd>
			<?php echo h($user['User']['secondary_phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email Address'); ?></dt>
		<dd>
			<?php echo h($user['User']['email_address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Education Level'); ?></dt>
		<dd>
			<?php echo $this->Html->link($user['EducationLevel']['name'], array('controller' => 'education_levels', 'action' => 'view', $user['EducationLevel']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Certification'); ?></dt>
		<dd>
			<?php echo h($user['User']['certification']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('School'); ?></dt>
		<dd>
			<?php echo $this->Html->link($user['School']['name'], array('controller' => 'schools', 'action' => 'view', $user['School']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($user['User']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($user['User']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Types'), array('controller' => 'user_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Type'), array('controller' => 'user_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Education Levels'), array('controller' => 'education_levels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Education Level'), array('controller' => 'education_levels', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Schools'), array('controller' => 'schools', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New School'), array('controller' => 'schools', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Absences'), array('controller' => 'absences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Absence Made'), array('controller' => 'absences', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Notifications'), array('controller' => 'notifications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Notification'), array('controller' => 'notifications', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Absences');?></h3>
	<?php if (!empty($user['AbsenceMade'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Absentee Id'); ?></th>
		<th><?php echo __('Fulfiller Id'); ?></th>
		<th><?php echo __('School Id'); ?></th>
		<th><?php echo __('Room'); ?></th>
		<th><?php echo __('Start'); ?></th>
		<th><?php echo __('End'); ?></th>
		<th><?php echo __('Comment'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['AbsenceMade'] as $absenceMade): ?>
		<tr>
			<td><?php echo $absenceMade['id'];?></td>
			<td><?php echo $absenceMade['absentee_id'];?></td>
			<td><?php echo $absenceMade['fulfiller_id'];?></td>
			<td><?php echo $absenceMade['school_id'];?></td>
			<td><?php echo $absenceMade['room'];?></td>
			<td><?php echo $absenceMade['start'];?></td>
			<td><?php echo $absenceMade['end'];?></td>
			<td><?php echo $absenceMade['comment'];?></td>
			<td><?php echo $absenceMade['created'];?></td>
			<td><?php echo $absenceMade['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'absences', 'action' => 'view', $absenceMade['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'absences', 'action' => 'edit', $absenceMade['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'absences', 'action' => 'delete', $absenceMade['id']), null, __('Are you sure you want to delete # %s?', $absenceMade['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Absence Made'), array('controller' => 'absences', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Absences');?></h3>
	<?php if (!empty($user['AbsenceFilled'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Absentee Id'); ?></th>
		<th><?php echo __('Fulfiller Id'); ?></th>
		<th><?php echo __('School Id'); ?></th>
		<th><?php echo __('Room'); ?></th>
		<th><?php echo __('Start'); ?></th>
		<th><?php echo __('End'); ?></th>
		<th><?php echo __('Comment'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['AbsenceFilled'] as $absenceFilled): ?>
		<tr>
			<td><?php echo $absenceFilled['id'];?></td>
			<td><?php echo $absenceFilled['absentee_id'];?></td>
			<td><?php echo $absenceFilled['fulfiller_id'];?></td>
			<td><?php echo $absenceFilled['school_id'];?></td>
			<td><?php echo $absenceFilled['room'];?></td>
			<td><?php echo $absenceFilled['start'];?></td>
			<td><?php echo $absenceFilled['end'];?></td>
			<td><?php echo $absenceFilled['comment'];?></td>
			<td><?php echo $absenceFilled['created'];?></td>
			<td><?php echo $absenceFilled['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'absences', 'action' => 'view', $absenceFilled['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'absences', 'action' => 'edit', $absenceFilled['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'absences', 'action' => 'delete', $absenceFilled['id']), null, __('Are you sure you want to delete # %s?', $absenceFilled['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Absence Filled'), array('controller' => 'absences', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Applications');?></h3>
	<?php if (!empty($user['Application'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Absence Id'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Application'] as $application): ?>
		<tr>
			<td><?php echo $application['id'];?></td>
			<td><?php echo $application['user_id'];?></td>
			<td><?php echo $application['absence_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'applications', 'action' => 'view', $application['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'applications', 'action' => 'edit', $application['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'applications', 'action' => 'delete', $application['id']), null, __('Are you sure you want to delete # %s?', $application['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Notifications');?></h3>
	<?php if (!empty($user['Notification'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Notification Type Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Absence Id'); ?></th>
		<th><?php echo __('Other Id'); ?></th>
		<th><?php echo __('New'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Notification'] as $notification): ?>
		<tr>
			<td><?php echo $notification['id'];?></td>
			<td><?php echo $notification['notification_type_id'];?></td>
			<td><?php echo $notification['user_id'];?></td>
			<td><?php echo $notification['absence_id'];?></td>
			<td><?php echo $notification['other_id'];?></td>
			<td><?php echo $notification['new'];?></td>
			<td><?php echo $notification['created'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'notifications', 'action' => 'view', $notification['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'notifications', 'action' => 'edit', $notification['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'notifications', 'action' => 'delete', $notification['id']), null, __('Are you sure you want to delete # %s?', $notification['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Notification'), array('controller' => 'notifications', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Notifications');?></h3>
	<?php if (!empty($user['NotificationReference'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Notification Type Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Absence Id'); ?></th>
		<th><?php echo __('Other Id'); ?></th>
		<th><?php echo __('New'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['NotificationReference'] as $notificationReference): ?>
		<tr>
			<td><?php echo $notificationReference['id'];?></td>
			<td><?php echo $notificationReference['notification_type_id'];?></td>
			<td><?php echo $notificationReference['user_id'];?></td>
			<td><?php echo $notificationReference['absence_id'];?></td>
			<td><?php echo $notificationReference['other_id'];?></td>
			<td><?php echo $notificationReference['new'];?></td>
			<td><?php echo $notificationReference['created'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'notifications', 'action' => 'view', $notificationReference['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'notifications', 'action' => 'edit', $notificationReference['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'notifications', 'action' => 'delete', $notificationReference['id']), null, __('Are you sure you want to delete # %s?', $notificationReference['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Notification Reference'), array('controller' => 'notifications', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Schools');?></h3>
	<?php if (!empty($user['PreferredSchool'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Street Address'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['PreferredSchool'] as $preferredSchool): ?>
		<tr>
			<td><?php echo $preferredSchool['id'];?></td>
			<td><?php echo $preferredSchool['name'];?></td>
			<td><?php echo $preferredSchool['street_address'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'schools', 'action' => 'view', $preferredSchool['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'schools', 'action' => 'edit', $preferredSchool['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'schools', 'action' => 'delete', $preferredSchool['id']), null, __('Are you sure you want to delete # %s?', $preferredSchool['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Preferred School'), array('controller' => 'schools', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
