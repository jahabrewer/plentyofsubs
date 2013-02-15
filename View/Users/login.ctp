<div class="offset4 span4">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User');?>
        <legend>Login</legend>
    <?php
        echo $this->Form->input('username', array('placeholder' => 'Username', 'label' => false, 'div' => false));
        echo $this->Form->input('password', array('placeholder' => 'Password', 'label' => false, 'div' => false));
    ?>
    <div class="form-actions">
    	<?php echo $this->Form->submit('Login'); ?>
    </div>
<?php echo $this->Form->end(); ?>
</div>
