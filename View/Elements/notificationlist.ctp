<h2>Notifications</h2>

<?php if (empty($notifications)): ?>
	<p>You have no notifications</p>
<?php else: ?>
	<table>
		<tbody>
			<?php foreach($notifications as $notification): ?>
				<tr>
					<td><small><?php echo $this->Time->niceShort($notification['Notification']['created']); ?></small></td>
					<td><?php echo $this->Notification->printNotification($notification); ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>
