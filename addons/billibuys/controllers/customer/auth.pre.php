<?php

//Handles redirect if user is logged in and clicks "login/register", pre is so it overrides line 268 of auth.php controller
if($mode == 'login_form'){
	if (!empty($auth['user_id'])) {
		return array(CONTROLLER_STATUS_REDIRECT, 'billibuys.view');
	}
}

?>