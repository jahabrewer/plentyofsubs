<h1>Reviewing <?php echo $subject['Subject']['first_name'] . ' ' . $subject['Subject']['last_name']; ?></h1>
<div id="fullContent">
	<div class="reviews form">
	<?php echo $this->Form->create('Review');?>
		<fieldset>
			<legend><?php echo __('Write Review'); ?></legend>
		<?php
			echo $this->Form->hidden('subject_id', array('default' => $subject['Subject']['id']));
			echo $this->Form->input('rating', array('options' => $ratings, 'default' => '3', 'label' => 'How was your overall experience with this sub?'));
			echo '<br />';
			echo $this->Form->input('review', array('label' => 'Comments'));
		?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit'));?>
	</div>
</div>
