<?php $this->extend('base'); ?>

<?php $this->start('pagination'); ?>
	<?php echo $this->Paginator->counter(array('format' => '<strong>{:start}</strong>&ndash;<strong>{:end}</strong> of <strong>{:count}</strong>')); ?>
	&nbsp;
	<div class="btn-group">
		<?php echo $this->Paginator->prev('<i class="icon-chevron-left"></i>', array('class' => 'btn', 'tag' => false, 'escape' => false), null, array('class' => 'btn disabled', 'escape' => false)); ?>
		<?php echo $this->Paginator->next('<i class="icon-chevron-right"></i>', array('class' => 'btn', 'tag' => false, 'escape' => false), null, array('class' => 'btn disabled', 'escape' => false)); ?>
	</div>
<?php $this->end(); ?>

<div class="well">
	<?php echo $this->Form->create('filter', array('class' => 'form-inline', 'type' => 'GET', 'style' => 'text-align:center; margin:0px;')); ?>
		<fieldset>
			<?php echo $this->Form->text('school', array('class' => 'input-medium', 'autocomplete' => 'off', 'placeholder' => 'School', 'data-provide' => 'typeahead', 'data-source' => $schools_flat)); ?>
			<?php echo $this->Form->select('role', array('admin' => 'Admin', 'teacher' => 'Teacher', 'substitute' => 'Substitute'), array('class' => 'input-medium', 'empty' => 'Any Role')); ?>
			<?php //button doesn't work if form is pre-filled from request->data echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'btn')); ?>
			<?php echo $this->Form->button('Filter', array('type' => 'submit', 'class' => 'btn btn-primary')); ?>
		</fieldset>
	<?php echo $this->Form->end(); ?>
</div>

<table class="table clickable-rows">
	<thead>
		<tr>
			<?php
				$paginator_params = $this->Paginator->params();
				$headers = array(
					array(
						'paginator_sort' => 'User.username',
						'paginator_label' => 'Username',
					),
					array(
						'paginator_sort' => 'User.last_name',
						'paginator_label' => 'Last Name',
					),
					array(
						'paginator_sort' => 'User.first_name',
						'paginator_label' => 'First Name',
					),
					array(
						'paginator_sort' => 'User.role',
						'paginator_label' => 'Role',
					),
					array(
						'paginator_sort' => 'School.name',
						'paginator_label' => 'School',
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
		<?php foreach ($users as $user): ?>
			<tr data-href="<?php echo $this->Html->url(array('action' => 'view', $user['User']['id'])); ?>">
				<td><?php echo $user['User']['username']; ?></td>
				<td><?php echo $user['User']['last_name']; ?></td>
				<td><?php echo $user['User']['first_name']; ?></td>
				<td><?php echo $roles[$user['User']['role']]; ?></td>
				<td><?php echo $user['School']['name']; ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
