<?php if (isset($header)) { echo $header; } ?>

<?php $count = 0; ?>
<?php foreach ($items as $item): ?>
	<?php if (isset($item['header'])) { echo $item['header']; } ?>
	<div class="row <?php if (isset($item['class'])) echo $item['class']; ?>"<?php if ($count++ % 2 === 1) { echo ' style="background-color:#eee;"'; } ?>>
		<div class="span3 muted" style="text-align:right">
			<h1><?php echo $item['key']; ?></h1>
		</div>
		<?php $span = count($item['value']) === 1 ? '7' : '3'; ?>
		<?php foreach ($item['value'] as $column): ?>
			<div class="span<?php echo $span; ?>">
				<?php //if (isset($column['header'])) {echo "<h4>${column['header']}</h4>"; } ?>
				<?php //echo "<p>${column['content']}</p>"; ?>
				<?php
					if (isset($column['header'])) {
						if (!isset($column['suppress_tags']) || !$column['suppress_tags']) echo "<h4>${column['header']}</h4>";
						else echo $column['header'];
					}
					if (!isset($column['suppress_tags']) || !$column['suppress_tags']) echo "<p>${column['content']}</p>";
					else echo $column['content'];
				?>
			</div>
		<?php endforeach; ?>
	</div>
	<?php if (isset($item['footer'])) { echo $item['footer']; } ?>
<?php endforeach; ?>

<?php if (isset($footer)) { echo $footer; } ?>
