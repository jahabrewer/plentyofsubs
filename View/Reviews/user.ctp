<h1><?php  echo "Reviews of {$subject['Subject']['first_name']} {$subject['Subject']['last_name']}";?></h1>
<div id="fullContent">
	<div class="reviews view">
		<dl>
			<?php foreach ($reviews as $review): ?>
				<dt>
					<span style="color:#e14b4b;"><?php echo $review['Review']['rating'].(($review['Review']['rating'] = 1) ? " star" : " stars"); ?></span>
					<!-- <?php for ($i=0; $i<$review['Review']['rating']; $i++) echo '&diams;'; ?> -->
					<?php echo ' on ' . date('F j, Y', strtotime($review['Review']['created'])); ?>
					<?php if ($review['Review']['created'] !== $review['Review']['modified']) echo ' (updated ' . date('F j, Y', strtotime($review['Review']['modified'])) . ')'; ?>
					<br />
					By <?php echo $this->Html->link("{$review['Author']['first_name']} {$review['Author']['last_name']}", array('controller' => 'users', 'action' => 'view', $review['Author']['id'])) . ' &lt;' . $this->Html->link($review['Author']['email_address'], "mailto:{$review['Author']['email_address']}") . '&gt;'; ?>
				</dt>
				<dd>
					<p><?php echo nl2br($review['Review']['review']); ?></p>
					&nbsp;
				</dd>
				<hr />
			<?php endforeach; ?>
		</dl>
	</div>
	<div class="spacer"></div>
	<p>
	<?php
		echo $this->Paginator->counter(array(
			'format' => __('Page {:page} of {:pages}, showing {:current} reviews out of {:count} total')
		));
	?>
	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo '&nbsp;';
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div id="sidePanel">
	<p>stats</p>
	<ul id="sideNav">
		<li>Average Rating: <?php echo sprintf('%.1f', $subject['Subject']['average_rating']); ?></li>
		<li>Total Reviews: <?php echo $subject['Subject']['reviewer_count']; ?></li>
		<?php echo $this->Html->link('<li>'.$this->Html->image('icons/help.png').'Return to full view</li>', array('controller' => 'users', 'action' => 'view', $subject['Subject']['id']), array('escape' => false)); ?>
	</ul>
</div>
