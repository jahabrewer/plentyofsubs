<div id="fullContent">
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
		<?php if ($show_rating && $user['User']['role'] === 'substitute'): ?>
			<dt><?php echo __('Average Rating'); ?></dt>
			<dd>
				<?php echo sprintf('%.1f', $user['User']['average_rating']) . ' by ' . h($user['User']['reviewer_count']) . ' teachers'; ?>
				<br />
				<?php echo $this->Html->link('See reviews', array('controller' => 'reviews', 'action' => 'user', $user['User']['id'])); ?>
				&nbsp;
			</dd>
		<?php endif; ?>
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
</div>
<div id="sidePanel">
  <p><?php echo 'actions'; ?></p>
  <ul id="sideNav">
    <?php
    if ($show_review) echo $this->Html->link('<li>'.$this->Html->image('icons/help.png').'Review This Sub'.'</li>', array('controller' => 'reviews', 'action' => 'add', $user['User']['id']), array('escape' => false));
    if ($show_edit) echo $this->Html->link('<li>'.$this->Html->image('icons/help.png').'Edit'.'</li>', array('controller' => 'users', 'action' => 'edit', $user['User']['id']), array('escape' => false));
    if ($show_delete) echo $this->Html->link('<li>'.$this->Html->image('icons/help.png').'Delete'.'</li>', array('controller' => 'users', 'action' => 'delete', $user['User']['id']), array('escape' => false), 'Are you sure you want to delete this user?');
    ?>
  </ul>
</div>
