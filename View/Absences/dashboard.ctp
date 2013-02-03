<div class="row">
	<?php if (isset($absences_today)): ?>
	<div class="span7">
		<?php echo $this->element('todaysabsencelist'); ?>
	</div>
	<?php elseif (isset($absences)): ?>
		<div class="span7">
			<?php echo $this->element('absencelist'); ?>
		</div>
	<?php endif; ?>
	
	<div class="offset1 span4">
		<?php if (isset($num_pending_absences)): ?>
			<div class="row">
				There are <strong><?php echo $num_pending_absences; ?></strong>	absences pending approval at your school<br>
				<?php if ($num_pending_absences > 0) { echo $this->Html->link('View them &raquo;', array('action' => 'pending'), array('escape' => false)); } ?>
			</div>
		<?php endif; ?>
		
		<?php if (isset($absences)): ?>
			<div class="row">
				<?php echo $this->element('notificationlist'); ?>
			</div>
		<?php endif; ?>
	
		<?php if (isset($applicants)): ?>
			<hr>
			<div class="row">
				<?php echo $this->element('applicantslist'); ?>
			</div>
		<?php endif; ?>
	</div>
<!--
	<div class="span4">
	
		<h2>Overview</h2>
		<p>Today is <span class="date"><?php echo date('l, F j, Y'); ?></span>.<br />
			<?php if (isset($num_upcoming_absences)): ?>You have <span class="numAbsences"><?php echo $num_upcoming_absences > 0 ? $num_upcoming_absences : 'no'; ?></span> upcoming absence<?php echo $num_upcoming_absences == 1 ? '' : 's'; ?>. <br /><?php endif; ?>
			<?php if (isset($num_pending_absences)): ?>
				There <?php echo $num_pending_absences == 1 ? 'is' : 'are'; ?> <span class="numAbsences"><?php echo $num_pending_absences > 0 ? $num_pending_absences : 'no'; ?></span> absence<?php echo $num_pending_absences == 1 ? '' : 's'; ?> pending your approval.<br />
				<?php if ($num_pending_absences > 0) echo $this->Html->link('See pending absences.', array('controller' => 'absences', 'action' => 'pending')); ?><br />
			<?php endif; ?>
	</div>
	-->
</div>
