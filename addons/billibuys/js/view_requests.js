$(document).ready(function(){
	$('.view-cta-button').click(function(){
		window.location.href="index.php?dispatch=billibuys.request&request_id="+$(this).attr('id');
	});

	$('.bid-cta-button').click(function(){
		window.location.href="index.php?dispatch=billibuys.request&request_id="+$(this).attr('id');
	});
});