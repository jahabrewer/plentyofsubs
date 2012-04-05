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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo 'PlentyOfSubs | '; ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		//echo $this->Html->css('cake.generic');
		echo $this->Html->css('layout');
		echo $this->Html->css('pagelayers');
		echo $this->Html->css('formatting');

		echo $this->Html->script('jquery-1.7.1');
		echo $this->Html->script('layout');
		echo $scripts_for_layout;
	?>
</head>
<body>
	<div id="header">
		<div id="logo"><?php echo $this->Html->image('layout/logo.png', array('alt' => 'PlentyOfSubs', 'url' => array('controller' => 'absences', 'action' => 'dashboard'))); ?></div>
		<?php if ($logged_in): ?>
			<div id="welcomeMessage">Welcome back, <span class="userName"><?php echo $logged_in_firstname; ?></span>!</div>
			<ul id="nav">
			<!-- Put class="current" in the <a> tag corresponding to which page this is -->
			  <li><?php echo $this->Html->link('Dashboard', array('controller' => 'absences', 'action' => 'dashboard'), isset($layout_current['dashboard']) ? array('class' => 'current') : null); ?></li>
			  <li><a<?php echo isset($layout_current['absences']) ? ' class="current"' : ''; ?>>Absences</a>
			    <ul>
			      <li><?php echo $this->Html->link('My Absences', array('controller' => 'absences', 'action' => 'my')); ?></li>
			      <li><?php echo $this->Html->link('Search Absences', array('controller' => 'absences', 'action' => 'index')); ?></li>
			      <li><?php echo $this->Html->link('Pending Absences', array('controller' => 'absences', 'action' => 'pending')); ?></li>
			      <li><?php echo $this->Html->link('Create Absence', array('controller' => 'absences', 'action' => 'add')); ?></li>
			    </ul>
			  </li>
			  <li><a href="#">Profile</a>
			    <ul>
			      <li><?php echo $this->Html->link('Edit Profile', array('controller' => 'users', 'action' => 'edit', $logged_in_userid)); ?></li>
			      <li><a href="#">Messages</a></li>
			    </ul>
			  </li>
			  <li><a href="#">Account</a>
			    <ul>
			      <li><a href="#">Account Settings</a></li>
			      <li><a href="#">Privacy Settings</a></li>
			    </ul>
			  </li>
			  <li><a href="#">Help</a>
			    <ul>
			      <li><a href="#">How To Guide</a></li>
			      <li><a href="#">FAQs</a></li>
			    </ul>
			  </li>
			  <li><?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout')); ?></li>
			</ul>
		<?php else: ?>
			<ul id="nav">
			  <li><?php echo $this->Html->link('Login', array('controller' => 'users', 'action' => 'login')); ?></li>
			</ul>
		<?php endif; ?>
	</div>
	<div id="bodyContainer">
		<?php echo $this->Session->flash(); ?>

		<?php echo $content_for_layout; ?>

	</div>

	<div class="spacer"></div>

	<div id="footer">
		<div class="leftAligned">
			<ul>
				<li><a href="#">About</a></li>
				|
				<li><a href="#">Privacy</a></li>
				|
				<li><a href="#">Terms of Use</a></li>
				|
				<li><a href="#">Feedback</a></li>
				|
				<li><a href="#">Contact</a></li>
				|
				<li><a href="#">Help</a></li>
			</ul>
			<p>PlentyOfSubs is free software licensed under the <?php echo $this->Html->link('GNU GPL v3', 'http://www.gnu.org/licenses/gpl.txt'); ?></p>
		</div>
		<div class="rightAligned"> PlentyOfSubs Copyright 2012 Janzen Brewer, Nathaniel Tinkler, Jianzhuo Wu</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
