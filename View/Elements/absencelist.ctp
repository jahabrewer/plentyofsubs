<h2>Upcoming Absences</h2>
<?php echo $this->Html->link('View all your absences &raquo;', array('action' => 'my'), array('escape' => false)); ?>
<div id="update"></div>
	
<?php if (empty($absences)): ?>
	<p>You have no upcoming absences</p>
<?php else: ?>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Date</th>
				<th>Time</th>
				<th>Location</th>
				<th>Apps</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($absences as $absence): ?>
				<tr>
					<td><?php echo date('D, M j Y', strtotime($absence['Absence']['start'])); ?></td>
					<td><?php echo date('g:i a', strtotime($absence['Absence']['start'])); ?></td>
					<td><?php echo $absence['School']['abbreviation'] . ' ' . $absence['Absence']['room']; ?></td>
					<td><?php echo count($absence['Application']); ?></td>
					<td><?php echo $this->Html->link('View', array('action' => 'view', $absence['Absence']['id'])); ?></td>
					<!--<td>
						<?php echo $this->Js->link(
							'linky',
							array('action' => 'ajaxTest', $absence['Absence']['id']),
							array(
								'async' => true,
								'before' => $this->Js->get('#jhb')->effect('fadeIn'),
								'complete' => $this->Js->get('#jhb')->effect('fadeOut'),
								'success' => $this->Js->get('#update')->effect('fadeIn'),
								'update' => '#update'
							)); ?>
					</td>-->
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>
