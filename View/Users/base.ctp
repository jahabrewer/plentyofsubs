<?php $this->start('sidebar'); ?>
	<?php echo $this->Html->link('New User', array('action' => 'add'), array('class' => 'btn btn-block btn-success', 'style' => 'margin-bottom:30px;')); ?>
<?php $this->end(); ?>

<?php echo $this->fetch('content'); ?>
