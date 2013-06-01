<?php
/***************************************************************************
*                                                                          *
*   (c) 2004 Vladimir V. Kalynyak, Alexey V. Vinokurov, Ilya M. Shalnev    *
*                                                                          *
* This  is  commercial  software,  only  users  who have purchased a valid *
* license  and  accept  to the terms of the  License Agreement can install *
* and use this program.                                                    *
*                                                                          *
****************************************************************************
* PLEASE READ THE FULL TEXT  OF THE SOFTWARE  LICENSE   AGREEMENT  IN  THE *
* "copyright.txt" FILE PROVIDED WITH THIS DISTRIBUTION PACKAGE.            *
****************************************************************************/

if ( !defined('AREA') )	{ die('Access denied');	}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	return;
}

if ($mode == 'add' || $mode == 'update') {

	if (empty($_REQUEST['user_type']) && (empty($_REQUEST['user_id']) || $_REQUEST['user_id'] != $auth['user_id'])) {

		$user_type = fn_get_request_user_type($_REQUEST, $auth, $mode);

		$params = array();
		if (!empty($_REQUEST['user_id'])) {
			$params[] = "user_id=" . $_REQUEST['user_id'];
		}
		$params[] = "user_type=" . $user_type;

		return array(CONTROLLER_STATUS_REDIRECT, "profiles." . $mode . "?" . implode("&", $params));
	}

}

?>