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
	<?php
		echo $this->Html->css('ui-lightness/jquery-ui-1.10.0.custom');
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('jquery.ui.timepicker');
		

		echo $this->Html->script('jquery-1.9.0.min');
		echo $this->Html->script('jquery-ui-1.10.0.custom.min');
		echo $this->Html->script('jquery.ui.timepicker'); // TODO load this only for relevant pages
		echo $this->Html->script('bootstrap.min');
		echo $this->fetch('script');
	?>
	<!-- put this script and style in appropriate places sometime -->
	<script>
		$(function() {
			$('.datepicker').datepicker({
				dateFormat: 'yy-mm-dd'
			});
			$('.timepicker').timepicker();
			$('.alert').alert();
			// FIXME this ajax request fires when the popover is opened AND closed because it uses a click handler
			$('#notification').popover({
				title: '<strong>Notifications</strong>'+
					'<button type="button" class="btn pull-right" style="margin-top:0px;" onclick="$(&quot;#notification&quot;).popover(&quot;hide&quot;);"><i class="icon-remove"></i></button>',
				placement: 'bottom',
				html: true,
			}).click(function() {
				$('.popover-content').text('Loading...');
				$('.popover-content').load(
					'<?php echo $this->Html->url(array('controller' => 'notifications', 'action' => 'popover')); ?>',
					function(responseText, textStatus, jqXHR) {
						if (textStatus !== 'success') {
							$('.popover-content').text('Couldn\'t load notifications, try again later');
						}
					}
				);
			});
			/*$('#change-password-btn').click(function() {
				$('#dynamic').load(
					'<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'changepassword')); ?>',
					function(responseText, textStatus, jqXHR) {
						if (textStatus === 'success') {
							$('#myModal').modal('show');
						}
					}
				);
			});*/
		});
		$(document).on('click', 'table.clickable-rows > tbody > tr', function() {
			window.location = $(this).attr('data-href');
		}).on('mouseover', 'table.clickable-rows > tbody > tr', function() {
			$(this).addClass('hovered');
		}).on('mouseout', 'table.clickable-rows > tbody > tr', function() {
			$(this).removeClass('hovered');
		});
		$(document).ready(function() {
			$('#notification-count').load('<?php echo $this->Html->url(array('controller' => 'notifications', 'action' => 'countnew')); ?>');
		});
	</script>
	<style>
		body {
			padding-top: 60px;
			padding-bottom: 40px;
		}
		.hovered {
			background: #eee;
		}
		table.clickable-rows tbody tr {
			cursor: pointer;
		}
		div.popover tr.new {
			background: #fdd;
		}
	</style>
<style>
</style>
</head>
<body>
	<div id="dynamic"></div>
	<!-- navbar -->
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
				<?php if ($logged_in): ?>
					<ul class="nav pull-right">
						<li>
							<a id="notification" href="#">
								<i class="icon-envelope"></i>
								<span id="notification-count" class="badge badge-important"></span>
							</a>
						</li>
						<li>
							<?php echo $this->Html->link($logged_in_user['role'], '#'); ?>
						</li>
						<li class="dropdown">
							<?php echo $this->Html->link("${logged_in_user['first_name']} {$logged_in_user['last_name']} <b class=\"caret\"></b>", array('controller' => 'users', 'action' => 'view', $logged_in_user['id']), array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'escape' => false)); ?>
							<ul class="dropdown-menu">
								<li>
									<?php echo $this->Html->link('Change Password', array('controller' => 'users', 'action' => 'changepassword')); ?>
								</li>
								<li>
									<?php echo $this->Html->link('Edit Profile', array('controller' => 'users', 'action' => 'edit', $logged_in_user['id'])); ?>
								</li>
							</ul>
						</li>
						<li>
							<?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout')); ?>
						</li>
					</ul>
				<?php endif; ?>
				<?php if (!$logged_in): ?>
					<?php echo $this->Form->create('User', array('class' => 'navbar-form pull-right', 'url' => array('controller' => 'users', 'action' => 'login'))); ?>
						<?php echo $this->Form->input('username', array('placeholder' => 'Username', 'class' => 'span2', 'label' => false, 'div' => false)); ?>
						<?php echo $this->Form->input('password', array('placeholder' => 'Password', 'class' => 'span2', 'label' => false, 'div' => false)); ?>
						<?php echo $this->Form->submit('Login', array('class' => 'btn btn-primary', 'div' => false)); ?>
					<?php echo $this->Form->end(); ?>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<div class="container">
		<?php echo $this->Session->flash(); ?>
		
		<?php echo $this->fetch('content'); ?>
		
		<?php echo $this->Js->writeBuffer(); ?>
		<hr>
		<footer>
			<?php //echo $this->element('sql_dump'); ?>
			<!--<p>&copy; Copyright 2012-2013 Janzen Brewer, Nathaniel Tinkler, Jianzhuo Wu</p>-->
		</footer>
	</div>
</body>
</html>
