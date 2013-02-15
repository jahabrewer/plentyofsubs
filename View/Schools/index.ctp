<?php $this->extend('base'); ?>

<?php $this->start('pagination'); ?>
	<?php echo $this->Paginator->counter(array('format' => '<strong>{:start}</strong>&ndash;<strong>{:end}</strong> of <strong>{:count}</strong>')); ?>
	&nbsp;
	<div class="btn-group">
		<?php echo $this->Paginator->prev('<i class="icon-chevron-left"></i>', array('class' => 'btn', 'tag' => false, 'escape' => false), null, array('class' => 'btn disabled', 'escape' => false)); ?>
		<?php echo $this->Paginator->next('<i class="icon-chevron-right"></i>', array('class' => 'btn', 'tag' => false, 'escape' => false), null, array('class' => 'btn disabled', 'escape' => false)); ?>
	</div>
<?php $this->end(); ?>

<table class="table clickable-rows">
	<thead>
		<tr>
			<th></th>
			<?php
				$paginator_params = $this->Paginator->params();
				$headers = array(
					array(
						'paginator_sort' => 'School.name',
						'paginator_label' => 'Name',
					),
					array(
						'paginator_sort' => 'School.street_address',
						'paginator_label' => 'Street Address',
					),
				);
			?>
			<?php foreach ($headers as $header): ?>
				<th>
					<?php echo $this->Paginator->sort($header['paginator_sort'], $header['paginator_label']); ?>
					<?php if (isset($paginator_params['options']['sort']) && $paginator_params['options']['sort'] === $header['paginator_sort']): ?>
						<?php if ($paginator_params['options']['direction'] === 'asc'): ?>
							<i class="icon-chevron-up"></i>
						<?php else: ?>
							<i class="icon-chevron-down"></i>
						<?php endif; ?>
					<?php endif; ?>
				</th>
			<?php endforeach; ?>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($schools as $school): ?>
			<tr data-href="<?php echo $this->Html->url(array('action' => 'view', $school['School']['id'])); ?>">
				<td><?php echo $school['School']['abbreviation']; ?></td>
				<td><?php echo $school['School']['name']; ?></td>
				<td><?php echo $school['School']['street_address']; ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
