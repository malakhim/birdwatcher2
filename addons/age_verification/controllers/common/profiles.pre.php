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


if ( !defined('AREA') ) { die('Access denied'); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (($mode == 'update' || $mode == 'add') && !empty($_REQUEST['user_data']['birthday'])) {
		$_REQUEST['user_data']['birthday'] = fn_parse_date($_REQUEST['user_data']['birthday']);
	}

	if ($mode == 'add' && !empty($_POST['user_data']['birthday'])) {
		$_POST['user_data']['birthday'] = fn_parse_date($_POST['user_data']['birthday']);
	}

	return;
}

?>