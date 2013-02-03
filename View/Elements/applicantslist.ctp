<h2>Applicants</h2>

<?php if (empty($applicants)): ?>
	<p>No one has applied for your current absences</p>
<?php else: ?>
	<table class="table">
		<thead>
			<th>Substitute</th>
			<th>Absence</th>
			<th>Rating</th>
		</thead>
		<tbody>
			<?php foreach($applicants as $applicant): ?>
				<tr>
					<td><?php echo $applicant['User']['first_name'] . ' ' . $applicant['User']['last_name']; ?></td>
					<td><?php echo date('M j g:i a', strtotime($applicant['Absence']['start'])); ?></td>
					<td>
						<?php
							if ($applicant['User']['reviewer_count'] <= 0) echo '--';
							else {
								echo sprintf('%.1f', $applicant['User']['average_rating']);
								echo " (by {$applicant['User']['reviewer_count']})";
							}
						?>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>
