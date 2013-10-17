<?php

if($mode == 'login'){
	// Check POSTed array is valid and exists
	if(isset($_POST) && !empty($_POST)){
		$redirect_url .= "&request_title=".$_POST['request_title'];
		var_dump($redirect_url);
	}
}

?>