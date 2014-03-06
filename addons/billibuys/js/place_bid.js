$(document).ready(function(){
	$('.cm-cancel').click(function(){
		window.location.href = 'index.php?dispatch=billibuys.request&request_id='+$('#request_id').val();
	});
});