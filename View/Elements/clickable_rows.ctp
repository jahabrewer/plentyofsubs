<script>
	$(document).ready(function() {
		$('table > tbody > tr').click(function(){
			window.location = $(this).attr('data-href');
		}).mouseover(function() {
			$(this).addClass('hovered');
		}).mouseout(function() {
			$(this).removeClass('hovered');
		});
	});
</script>
<style>
	tbody tr {
		cursor: pointer;
	}
</style>
