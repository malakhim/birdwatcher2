<?php

if($mode == 'login'){
	// Check POSTed array is valid and exists
	if(isset($_POST) && !empty($_POST)){
		$redirect_url .= "&request_title=".$_POST['request_title'];
	}
}elseif($mode == 'login_form'){
	if (!empty($auth['user_id'])) {
		return array(CONTROLLER_STATUS_REDIRECT, 'billibuys.view');
	}
}

?>