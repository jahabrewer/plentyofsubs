<?php $this->extend('base'); ?>

<?php $this->append('script'); ?>
<script>
	function doPasswordsMatch() {
		return $('#newPassword').val() === $('#confirmPassword').val();
	};
	
	$(document).on('submit', 'form#change-password', function(event) {
		event.preventDefault();
		
		$(this).find('.control-group').removeClass('error');
		$(this).find('.help-inline').hide();
		$(this).find('.response').hide();
		
		if (doPasswordsMatch()) {
			$('#password-spinner').show();
			
			// if the inputs are disabled before form serialization, it won't work
			var formSerialized = $(this).serialize();
			$('form#change-password input').prop("disabled", true);
			
			
			var changePasswordPost = $.post(
				'<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'changepassword')); ?>.json',
				formSerialized
			).done(function(data) {
				// response came back ok
				if (data.success) {
					// password was changed
					$('form#change-password .response.success').show();
					$("input[type='password']").val('');
				} else {
					// password not changed
					if (data.oldPasswordIncorrect) {
						$('#old-password-group').addClass('error');
						$('#old-password-group > .help-inline').show();
					} else {
						$(this).find('.response.other').show();
					}
				}
			}).always(function(data) {
				$('#password-spinner').hide();
				$('form#change-password input').prop("disabled", false);
			}).fail(function(data) {
				$('form#change-password .response.other').show();
			});
		} else {
			$('#new-password-group > .help-inline').show();
			$('#new-password-group').addClass('error');
		}
	});
</script>
<?php $this->end(); ?>

<?php
	$element_items = array(
		array(
			'header' => $this->Form->create(false, array('id' => 'change-password', 'action' => 'changepassword')),
			'key' => 'Password',
			'value' => array(
				array(
					'suppress_tags' => true,
					'content' =>
						'<div id="old-password-group" class="control-group">' .
							$this->Form->password('oldPassword', array('placeholder' => 'Old Password', 'required')) .
							'<span class="help-inline" style="display:none;">Old password incorrect</span>' .
						'</div>' .
						'<div id="new-password-group" class="control-group">' .
							$this->Form->password('newPassword', array('placeholder' => 'New Password', 'required')) .
							$this->Form->password('confirmPassword', array('placeholder' => 'Confirm New Password', 'required')) .
							'<span class="help-inline" style="display:none;">New passwords must match</span>' .
						'</div>',
				),
				array(
					'suppress_tags' => true,
					'content' =>
						$this->Form->submit('Change Password', array('class' => 'btn btn-primary', 'div' => false)) .
						// replace this text with an actual spinner gif
						'<div id="password-spinner" style="display:none;">Working...</div>' .
						'<br>' .
						'<h4 class="response success text-success" style="display:none;">Success!</h4>' .
						'<h4 class="response other text-warning" style="display:none;">Couldn\'t change password, try again later</h4>',
				),
			),
			'footer' => $this->Form->end(),
		),
	);
	
	echo $this->element('keyvalue', array('items' => $element_items));
?>
