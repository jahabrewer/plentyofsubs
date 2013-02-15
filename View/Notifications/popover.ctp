<table class="table clickable-rows">
	<tbody>
		<?php foreach($notifications as $notif): ?>
			<tr class="<?php if ($notif['Notification']['new'] == '1') echo 'new'; ?>" data-href="<?php echo $this->Html->url(array('controller' => 'absences', 'action' => 'view', $notif['Absence']['id'])); ?>"><td>
				<?php if ($notif['Notification']['notification_type'] === 'application_created'): ?>
					<?php echo "<strong>{$notif['Other']['username']}</strong> applied for your absence #{$notif['Absence']['id']}"; ?>
				<?php else: ?>
					other
				<?php endif; ?>
			</td></tr>
		<?php endforeach; ?>
	</tbody>
</table>
