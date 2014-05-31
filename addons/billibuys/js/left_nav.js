$(document).ready(function(){
	$('.root-lvl-cat').click(function(){
		if($(this).nextUntil('.root-lvl-cat').length > 0){
			$(this).nextUntil('.root-lvl-cat').toggle('fast');
			$(this).find('.left-side-nav-img').toggleClass('left-side-nav-image-opened');
		}else{
			var cat_id =+ $(this).attr('cat_id');
			window.location.href = "index.php?dispatch=billibuys.view&category_id="+cat_id;
		}
	});

	$('.second-lvl-cat').click(function(){
		var cat_id =+ $(this).attr('cat_id');
		window.location.href = "index.php?dispatch=billibuys.view&category_id="+cat_id;
	});
});