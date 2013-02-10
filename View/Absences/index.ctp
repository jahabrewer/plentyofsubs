<?php $this->extend('base'); ?>

<?php $this->start('pagination'); ?>
	<?php echo $this->Paginator->counter(array('format' => '<strong>{:start}</strong>&ndash;<strong>{:end}</strong> of <strong>{:count}</strong>')); ?>
	&nbsp;
	<div class="btn-group">
		<?php echo $this->Paginator->prev('<i class="icon-chevron-left"></i>', array('class' => 'btn', 'tag' => false, 'escape' => false), null, array('class' => 'btn disabled', 'escape' => false)); ?>
		<?php echo $this->Paginator->next('<i class="icon-chevron-right"></i>', array('class' => 'btn', 'tag' => false, 'escape' => false), null, array('class' => 'btn disabled', 'escape' => false)); ?>
	</div>
<?php $this->end(); ?>

<?php echo $this->element('clickable_rows'); ?>

<?php if (empty($absences)): ?>
	<p style="text-align:center;">No absences to show</p>
<?php else: ?>
	<div class="well">
		<?php echo $this->Form->create('filter', array('class' => 'form-inline', 'type' => 'GET', 'style' => 'text-align:center; margin:0px;')); ?>
			<fieldset>
				<?php echo $this->Form->text('absentee', array('class' => 'input-medium', 'autocomplete' => 'off', 'placeholder' => 'Absentee', 'data-provide' => 'typeahead', 'data-source' => $teachers_flat)); ?>
				<?php echo $this->Form->text('school', array('class' => 'input-medium', 'autocomplete' => 'off', 'placeholder' => 'School', 'data-provide' => 'typeahead', 'data-source' => $schools_flat)); ?>
				<?php echo $this->Form->text('dateStart', array('class' => 'input-small datepicker', 'autocomplete' => 'off', 'placeholder' => 'From')); ?>
				<?php echo $this->Form->text('dateEnd', array('class' => 'input-small datepicker', 'autocomplete' => 'off', 'placeholder' => 'To')); ?>
				<?php //button doesn't work if form is pre-filled from request->data echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'btn')); ?>
				<?php echo $this->Form->button('Filter', array('type' => 'submit', 'class' => 'btn btn-primary')); ?>
			</fieldset>
		<?php echo $this->Form->end(); ?>
	</div>

	<table class="table">
		<thead>
			<tr>
				<?php
					$paginator_params = $this->Paginator->params();
					$headers = array(
						array(
							'column_visibility' => 'absentee',
							'paginator_sort' => 'Absentee.username',
							'paginator_label' => 'Absentee',
						),
						array(
							'column_visibility' => 'fulfiller',
							'paginator_sort' => 'Fulfiller.username',
							'paginator_label' => 'Fulfiller',
						),
						array(
							'column_visibility' => 'location',
							'paginator_sort' => 'School.abbreviation',
							'paginator_label' => 'Location',
						),
						array(
							'column_visibility' => 'date',
							'paginator_sort' => 'start',
							'paginator_label' => 'Date',
						),
					);
				?>
				<?php foreach ($headers as $header): ?>
					<th>
						<?php if ($column_visibility[$header['column_visibility']]): ?>
							<?php echo $this->Paginator->sort($header['paginator_sort'], $header['paginator_label']); ?>
							<?php if (isset($paginator_params['options']['sort']) && $paginator_params['options']['sort'] === $header['paginator_sort']): ?>
								<?php if ($paginator_params['options']['direction'] === 'asc'): ?>
									<i class="icon-chevron-up"></i>
								<?php else: ?>
									<i class="icon-chevron-down"></i>
								<?php endif; ?>
							<?php endif; ?>
						<?php endif; ?>
					</th>
				<?php endforeach; ?>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($absences as $absence): ?>
				<tr data-href="<?php echo $this->Html->url(array('action' => 'view', $absence['Absence']['id'])); ?>">
					<td><?php if ($column_visibility['absentee']) echo $absence['Absentee']['username']; ?></td>
					<td><?php if ($column_visibility['fulfiller']) echo empty($absence['Fulfiller']['username']) ? "<span class=\"muted\">None</span>" : $absence['Fulfiller']['username']; ?></td>
					<td><?php if ($column_visibility['location']) echo "{$absence['School']['abbreviation']} {$absence['Absence']['room']}"; ?></td>
					<td><?php if ($column_visibility['date']) echo $this->Time->niceShort($absence['Absence']['start']); ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>
