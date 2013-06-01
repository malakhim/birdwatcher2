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

	if ($mode == 'update_totals') {

		$cart = & $_SESSION['cart'];
		// Update Affiliate code
		if (Registry::get('addons.affiliate.show_affiliate_code') == 'Y' || (!empty($cart['order_id']) && $cart['affiliate']['is_payouts'] != 'Y')) {
			$cart['affiliate']['code'] = empty($_REQUEST['affiliate_code']) ? '' : $_REQUEST['affiliate_code'];
			$_partner_id = fn_any2dec($cart['affiliate']['code']);
			$_partner_data = db_get_row("SELECT firstname, lastname, user_id as partner_id FROM ?:users WHERE user_id = ?i AND user_type = 'P'", $_partner_id);
			if (!empty($_partner_data)) {
				$cart['affiliate'] = $_partner_data + $cart['affiliate'];
				$_SESSION['partner_data'] = array(
					'partner_id' => $cart['affiliate']['partner_id'],
					'is_payouts' => 'N'
				);
			} else {
				unset($cart['affiliate']['partner_id']);
				unset($cart['affiliate']['firstname']);
				unset($cart['affiliate']['lastname']);
				unset($_SESSION['partner_data']);
			}
		}
	}

	return;
}

?>
