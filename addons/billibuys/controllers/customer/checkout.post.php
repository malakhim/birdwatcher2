<?php

if (!defined('AREA')) { die('Access denied'); }
	if($mode == "cart"){
		$view->assign('continue_url','billibuys.view');
	}
?>