<?php

if (!defined('AREA')) { die('Access denied'); }
// var_dump($_REQUEST);die;
	if($mode == "add"){
		parse_str($_REQUEST['redirect_url']);
		$_SESSION['bid_id'] = $bid_id;
	}
?>