<?php $this->extend('base'); ?>

<?php $this->start('pagination'); ?>
	<h2 style="margin:0px; line-height:31.5px;">No. <?php echo $absence['Absence']['id']; ?></h2>
<?php $this->end(); ?>

<?php $this->start('actions'); ?>
	<?php echo $this->Html->link(
		'<i class="icon-arrow-left"></i>',
		$referer,
		array(
			'class' => 'btn',
			'rel' => 'tooltip',
			'title' => 'Back',
			'style' => 'width:40px; margin-right:40px;',
			'escape' => false
		)
	); ?>
	<div class="btn-group">
		<?php if ($show_edit) echo $this->Html->link(
			'<i class="icon-pencil"></i>',
			array('action' => 'edit', $absence['Absence']['id']),
			array(
				'class' => 'btn',
				'rel' => 'tooltip',
				'title' => 'Edit',
				'style' => 'width:40px;',
				'escape' => false
			)
		); ?>
		<?php if ($show_delete) echo $this->Html->link(
			'<i class="icon-trash"></i>',
			array('action' => 'delete', $absence['Absence']['id']),
			array(
				'class' => 'btn',
				'rel' => 'tooltip',
				'title' => 'Delete',
				'style' => 'width:40px;',
				'escape' => false
			),
			'Are you sure you want to delete this absence?'
		); ?>
	</div>
	<?php if ($show_apply) echo $this->Html->link(
		'<i class="icon-plus-sign"></i>',
		array('action' => 'apply', $absence['Absence']['id']),
		array(
			'class' => 'btn',
			'rel' => 'tooltip',
			'title' => 'Apply',
			'style' => 'width:40px;',
			'escape' => false
		)
	); ?>
	<?php if ($show_retract) echo $this->Html->link(
		'<i class="icon-remove-sign"></i>',
		array('action' => 'retract', $absence['Absence']['id']),
		array(
			'class' => 'btn',
			'rel' => 'tooltip',
			'title' => 'Retract Application',
			'style' => 'width:40px;',
			'escape' => false
		)
	); ?>
	<?php if ($show_renege) echo $this->Html->link(
		'<i class="icon-remove"></i>',
		array('action' => 'renege', $absence['Absence']['id']),
		array(
			'class' => 'btn btn-danger',
			'rel' => 'tooltip',
			'title' => 'Renege',
			'style' => 'width:40px;',
			'escape' => false
		)
	); ?>
	<div class="btn-group">
		<?php if ($show_approve) echo $this->Html->link(
			'<i class="icon-thumbs-up"></i>',
			array('action' => 'approval', $absence['Absence']['id']),
			array(
				'class' => 'btn',
				'rel' => 'tooltip',
				'title' => 'Approve',
				'style' => 'width:40px;',
				'escape' => false
			)
		); ?>
		<?php if ($show_deny) echo $this->Html->link(
			'<i class="icon-thumbs-down"></i>',
			array('action' => 'denial', $absence['Absence']['id']),
			array(
				'class' => 'btn',
				'rel' => 'tooltip',
				'title' => 'Deny',
				'style' => 'width:40px;',
				'escape' => false
			),
			'Are you sure you want to deny this absence?'
		); ?>
	</div>
<?php $this->end(); ?>

<p><?php 
	if (isset($approver)) {
		if ($absence['Approval']['approved'] == 1)
			echo '<span class="label label-success">Approved</span>';
		else
			echo '<span class="label label-important">Denied</span>';
		echo " by {$approver['Approver']['username']} on ";
		echo date('M j, Y', strtotime($absence['Approval']['modified']));
	} else {
		echo '<span class="label">Unreviewed</span>';
	}
?></p>

<?php
	// generate view data for stuff shown every time
	$element_items = array(
		array(
			'key' => 'Who',
			'value' => array(
				array(
					'header' => 'Absentee',
					'content' => $this->Html->link(
							$absence['Absentee']['first_name'].' '.$absence['Absentee']['last_name'],
							array('controller' => 'users', 'action' => 'view', $absence['Absentee']['id'])
						).
						'<br>'.
						$this->Text->autoLinkEmails($absence['Absentee']['email_address']),
				),
				array(
					'header' => 'Fulfiller',
					'content' => empty($absence['Fulfiller']['id']) ?
						'No one... yet!'
						:
						$this->Html->link(
								$absence['Fulfiller']['first_name'].' '.$absence['Fulfiller']['last_name'],
								array('controller' => 'users', 'action' => 'view', $absence['Fulfiller']['id'])
							).
							'<br>'.
							$this->Text->autoLinkEmails($absence['Fulfiller']['email_address']),
				),
			)
		),
		array(
			'key' => 'When',
			'value' => array(
				array(
					'header' => 'Start',
					'content' => $this->Time->nice($absence['Absence']['start']),
				),
				array(
					'header' => 'End',
					'content' => $this->Time->nice($absence['Absence']['end']),
				),
			)
		),
		array(
			'key' => 'Where',
			'value' => array(
				array(
					'header' => 'School',
					'content' => $absence['School']['name'],
				),
				array(
					'header' => 'Room',
					'content' => $absence['Absence']['room'],
				),
			)
		),
		array(
			'key' => 'Comments',
			'value' => array(
				array(
					'content' => nl2br(h($absence['Absence']['comment'])),
				),
			)
		),
	);
	
	// tack on applicants row if requested
	if ($show_applicants) {
		if (empty($applications)) {
				$applicant_content = '<p>There are no applicants for this absence at this time</p>';
		} else {
			$applicant_content = <<<EOD
			<table class="table">
				<tbody>
EOD;
					foreach ($applications as $application) {
						$applicant_content .= <<<EOD
						<tr>
							<td>{$this->Html->link("<strong>{$application['User']['first_name']} {$application['User']['last_name']}</strong><br>{$application['User']['username']}", array('controller' => 'users', 'action' => 'view', $application['User']['id']), array('escape' => false))}</td>
							<td>Some rating?</td>
							<td>
								<div class="pull-right">
									{$this->Html->link('<i class="icon-ok"></i>', array('controller' => 'applications', 'action' => 'accept', $application['Application']['id']), array('class' => 'btn btn-success', 'rel' => 'tooltip', 'title' => 'Accept', 'escape' => false))}
									{$this->Html->link('<i class="icon-remove"></i>', array('controller' => 'applications', 'action' => 'reject', $application['Application']['id']), array('class' => 'btn btn-danger', 'rel' => 'tooltip', 'title' => 'Reject', 'escape' => false))}
								</div>
							</td>
						</tr>
EOD;
					}
					$applicant_content .= <<<EOD
				</tbody>
			</table>
EOD;
		}
		$element_items[] = array(
			'key' => 'Applicants',
			'value' => array(
				array(
					'content' => $applicant_content,
				),
			)
		);
	}
	
	echo $this->element('keyvalue', array('items' => $element_items));
?>
