<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<?php echo $this->Html->link('PlentyOfSubs', array('controller' => 'pages', 'action' => 'display', 'home'), array('class' => 'brand')); ?>
			<?php //echo $this->Form->create(false, array('action' => 'search', 'class' => 'navbar-search pull-left')); ?>
				<?php
					//$search_placeholder = 'Search ';
				?>
				<?php //echo $this->Form->text('query', array('class' => 'search-query', 'placeholder' => $search_placeholder)); ?>
			<?php //echo $this->Form->end(); ?>
			<ul class="nav pull-right">
				<?php if ($logged_in): ?>
					<li>
						<?php echo $this->Html->link($logged_in_user['role'], '#'); ?>
					</li>
					<li>
						<?php echo $this->Html->link("${logged_in_user['first_name']} ${logged_in_user['last_name']}", array('controller' => 'users', 'action' => 'view', $logged_in_user['id'])); ?>
					</li>
					<li>
						<?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout')); ?>
					</li>
				<?php else: ?>
					<li>
						<?php echo $this->Html->link('Login', array('controller' => 'users', 'action' => 'login')); ?>
					</li>
				<?php endif; ?>
			</ul>
		</div>
	</div>
</div>
