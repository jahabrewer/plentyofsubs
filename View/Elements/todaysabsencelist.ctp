<h2>Today's Absences</h2>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Absentee</th>
			<th>Fulfiller</th>
			<th>Location</th>
			<th>Time</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($absences_today as $absence): ?>
			<tr>
				<td><?php echo "{$absence['Absentee']['first_name']} {$absence['Absentee']['last_name']}"; ?></td>
				<td><?php echo "{$absence['Fulfiller']['first_name']} {$absence['Fulfiller']['last_name']}"; ?></td>
				<td><?php echo "{$absence['School']['abbreviation']} {$absence['Absence']['room']}"; ?></td>
				<td><?php echo date('g:i a', strtotime($absence['Absence']['start'])) . ' - ' . date('g:i a', strtotime($absence['Absence']['end'])); ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
