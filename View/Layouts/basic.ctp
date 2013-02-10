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
	<style>
		body {
			padding-top: 60px;
			padding-bottom: 40px;
		}
	</style>
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
		});
	</script>
	<style>
		.hovered {
			background: #eee;
		}
	</style>
</head>
<body>
	<?php echo $this->element('navbar'); ?>
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
