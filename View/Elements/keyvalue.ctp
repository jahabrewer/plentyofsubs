<?php if (isset($header)) { echo $header; } ?>

<?php $count = 0; ?>
<?php foreach ($items as $item): ?>
	<div class="row <?php if (isset($item['class'])) echo $item['class']; ?>"<?php if ($count++ % 2 === 1) { echo ' style="background-color:#eee;"'; } ?>>
		<div class="span3 muted" style="text-align:right">
			<h1><?php echo $item['key']; ?></h1>
		</div>
		<?php $span = count($item['value']) === 1 ? '7' : '3'; ?>
		<?php foreach ($item['value'] as $column): ?>
			<div class="span<?php echo $span; ?>">
				<?php if (isset($column['header'])) { echo "<h4>${column['header']}</h4>"; } ?>
				<?php echo "<p>${column['content']}</p>"; ?>
			</div>
		<?php endforeach; ?>
	</div>
<?php endforeach; ?>

<?php if (isset($footer)) { echo $footer; } ?>
