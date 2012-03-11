// PlentyOfSubs Layout jQuery
// Jianzhuo Wu, March 2012

$(document).ready(function(e) {
	
	// Drop Down Menu
	$('#nav li').hover(function () {
		$(this).find('ul').slideToggle('fast');
	});
	
	// Check On Load
	slideSidePanel();
});

$(window).scroll(function() {
	var panelYThres = 120;

	if ($(window).scrollTop() >= panelYThres) {
		$('#sidePanel').animate({top: '35px'}, 'fast');
	}
	else if ($(window).scrollTop() < panelYThres) {
		$('#sidePanel').animate({top : '145px'}, 'fast');
	}
});