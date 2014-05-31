<?php

	if($mode == 'update' || $mode == 'add'){
		if(!empty($_REQUEST['product_data']['product'])){
			fn_redirect("vendor.php?dispatch=billibuys.place_bid&request_id=".$_POST['request_id']);
		}
	}
?>