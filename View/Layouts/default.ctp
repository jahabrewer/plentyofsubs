<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo 'PlentyOfSubs | '; ?>
		<?php echo $title_for_layout; ?>
	</title>
	<style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
	<?php
		echo $this->Html->css('bootstrap.min');
		

		echo $this->Html->script('jquery-1.9.0.min');
		echo $this->Html->script('bootstrap.min');
		echo $scripts_for_layout;
	?>
</head>
<body>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<?php echo $this->Html->link('PlentyOfSubs', array('controller' => 'pages', 'action' => 'display', 'home'), array('class' => 'brand')); ?>
				<?php if ($logged_in): ?>
					<ul class="nav">
						<li><?php echo $this->Html->link('Dashboard', array('controller' => 'absences', 'action' => 'dashboard')); ?></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Absences <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><?php echo $this->Html->link('My Absences', array('controller' => 'absences', 'action' => 'my'), array ('tabindex' => '-1')); ?></li>
								<li><?php echo $this->Html->link('Search Absences', array('controller' => 'absences', 'action' => 'index'), array ('tabindex' => '-1')); ?></li>
								<li><?php echo $this->Html->link('Pending Absences', array('controller' => 'absences', 'action' => 'pending'), array ('tabindex' => '-1')); ?></li>
								<li><?php echo $this->Html->link('Create Absence', array('controller' => 'absences', 'action' => 'add'), array ('tabindex' => '-1')); ?></li>
							</ul>
						</li>
						<li><?php echo $this->Html->link('Welcome back, ' . $logged_in_firstname, array('controller' => 'users', 'action' => 'edit', $logged_in_userid)); ?></li>
						<li><?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout')); ?></li>
					</ul>
				<?php else: ?>
					<ul class="nav">
						<li><?php echo $this->Html->link('Login', array('controller' => 'users', 'action' => 'login')); ?></li>
					</ul>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="container">
		<?php echo $this->Session->flash(); ?>

		<?php echo $content_for_layout; ?>

		<hr>
		<footer>
			<?php //echo $this->element('sql_dump'); ?>
			<p>&copy; Copyright 2012-2013 Janzen Brewer, Nathaniel Tinkler, Jianzhuo Wu
		</footer>
	</div>
</body>
</html>
