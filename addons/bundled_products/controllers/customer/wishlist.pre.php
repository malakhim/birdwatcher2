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
	if ($mode == 'add') {
		if ($_REQUEST['package'] == 'Y') {
			foreach ($_REQUEST['product_data'] as $k => $v) {
				
				if (empty($v['chain'])) {
					unset($_REQUEST['product_data'][$k]);
				} else {
					$new_request['extra_id'] = $_REQUEST['product_data'][$k]['product_id'];
					$new_request['product_data'][$_REQUEST['product_data'][$k]['product_id']] = $_REQUEST['product_data'][$k];
					
					unset($_REQUEST['product_data'][$k]);
				}				
			}

			if (!empty($new_request)) {
				$_REQUEST['product_data'] = $new_request['product_data'];
				$_REQUEST['extra_id'] = $new_request['extra_id'];
			}
		}

	}
}

?>