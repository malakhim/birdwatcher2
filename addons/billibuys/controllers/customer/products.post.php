<?php

if (!defined('AREA')) { die('Access denied'); }

if ($mode == 'view'){
	if(!empty($_REQUEST['product_id']) && isset($_REQUEST['request_id']) && is_numeric($_REQUEST['request_id']) && !empty($_REQUEST['request_id'])) {
		// Get price and quantity from db
		// Add price and quantity for this bid to session variable
		// TODO: Fix modifying POST array from this page
		$bid = fn_get_bid_by_product($_REQUEST['product_id'],$_REQUEST['request_id']);
		$request = fn_get_request($_REQUEST);
		if(!empty($bid) && isset($bid) && $bid != null){
			$bid_id = $bid['bb_item_id'];
			$_SESSION['bids'][$bid_id] = $bid;
			$view->assign('price',$bid['price']);
			$view->assign('quantity',$bid['quantity']);
			$view->assign('owned_user',$request['user_id']);
			$view->assign('item_added_to_cart',$request['item_added_to_cart']);
			$view->assign('breadcrumbs',false);
		}else{
			$view->assign('price',$lang['bb_item_enter_through_bids']);
		}
	}else{
		$view->assign("price",$lang['bb_item_enter_through_bids']);
	}
}

?>