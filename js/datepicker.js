$(document).ready(function(){
	if($('#bb_expiry_date').length != 0){
		$('#bb_expiry_date').datepicker({
			maxDate: "+2w",
			minDate: 0,
			dateFormat: "dd-mm-yy"
		});
	}else if($('.datepicker').length != 0){
		$('.datepicker').datepicker();
	}
});