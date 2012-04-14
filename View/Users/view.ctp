<h1><?php  echo __('Profile');?></h1>
<div id="fullContent">
<div class="users view">
	<div id="fullContent">
		<p class="userNameTitle"><?php echo h($user['User']['first_name'])." ".h($user['User']['middle_initial'])." ".h($user['User']['last_name']); ?><br /><span class="userRoleTitle"><?php echo h($user['User']['role']); ?></span></p>
		<br />
	</div>
	<div id="leftContent">
		<ul class="userPage">
			<li><strong>Username: </strong><span><?php echo h($user['User']['username']); ?></span></li>
			<li><strong>Email: </strong><span><?php echo h($user['User']['email_address']); ?></span></li>
			<li><strong>Primary Phone: </strong><span><?php echo h($user['User']['primary_phone']); ?></span></li>
			<li><strong>Secondary Phone: </strong><span><?php echo h($user['User']['secondary_phone']); ?></span></li>
			<li><strong>School: </strong><span><?php echo $this->Html->link($user['School']['name'], array('controller' => 'schools', 'action' => 'view', $user['School']['id'])); ?></span></li>
			<li><strong>Education Level: </strong><span><?php echo $this->Html->link($user['EducationLevel']['name'], array('controller' => 'education_levels', 'action' => 'view', $user['EducationLevel']['id'])); ?></span></li>
			<li><strong>Certification: </strong><span><?php echo h($user['User']['certification']); ?></span></li>
		</ul>
	</div>
	<div id="rightContent">
		<p class="ratingTitle">Average Rating</p>
		<p class="rating"><?php echo sprintf('%.1f', $user['User']['average_rating']); ?><span style="position:relative; top:0.25em; color:#000; font-size:0.5em;">/5</span></p>
		<p class="ratingSubtitle"><?php echo ' by ' . h($user['User']['reviewer_count']) . ' teachers'; ?><br />
		<?php echo $this->Html->link('See reviews', array('controller' => 'reviews', 'action' => 'user', $user['User']['id'])); ?></p>
	</div>
	<div id="spacer"></div>
	<div id="fullContent">
		<br /><br /><br /><hr />
		<h4>User Details</h4>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
				<dd>
					<?php echo h($user['User']['id']); ?>
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
</div>
<div id="sidePanel">
  <p><?php echo 'actions'; ?></p>
  <ul id="sideNav">
    <?php
    if ($show_review) echo $this->Html->link('<li>'.$this->Html->image('icons/help.png').'Review This Sub'.'</li>', array('controller' => 'reviews', 'action' => 'add', $user['User']['id']), array('escape' => false));
    if ($show_edit) echo $this->Html->link('<li>'.$this->Html->image('icons/edit.png').'Edit'.'</li>', array('controller' => 'users', 'action' => 'edit', $user['User']['id']), array('escape' => false));
    if ($show_delete) echo $this->Html->link('<li>'.$this->Html->image('icons/delete.png').'Delete'.'</li>', array('controller' => 'users', 'action' => 'delete', $user['User']['id']), array('escape' => false), 'Are you sure you want to delete this user?');
    ?>
  </ul>
</div>
