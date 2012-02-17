<div id='loginForm'>
<?php
	echo $this->Session->flash('auth');
	echo $this->Form->create('Users', array('action' => 'login'));
	echo $this->Form->input('username');
	echo $this->Form->input('password',array('value'=>''));
	echo $this->Form->input('remember',array('type' => 'checkbox', 'label' => 'Remember me'));
	echo $this->Form->submit('Login');
?>
</div>
