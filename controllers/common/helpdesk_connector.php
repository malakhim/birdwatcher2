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
	if ($mode == 'validate_request' && !empty($_REQUEST['token'])) {
		$result = 'invalid';

		if (fn_get_storage_data('hd_request_code') == trim($_REQUEST['token'])) {
			$result = 'valid';
		}
		
		echo $result;
		exit(0);
	} elseif ($mode == 'messages') {
		if (!empty($_REQUEST['token'])) {
			$uc_settings = CSettings::instance()->get_values('Upgrade_center');
			
			$is_valid = fn_get_contents(Registry::get('config.updates_server') . '/index.php?dispatch=validators.validate_request&token=' . $_REQUEST['token'] . '&license_key=' . $uc_settings['license_number']);
			if ($is_valid == 'valid') {
				$data = simplexml_load_string(urldecode($_REQUEST['request']));
				
				fn_helpdesk_process_messages($data->Messages);
				
				echo 'OK';
				exit(0);
				
			} else {
				return array(CONTROLLER_STATUS_NO_PAGE);
			}
		}
	}
}

if ($mode == 'auth') {
	
	header('Content-Type: image/png');
	echo base64_decode('iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAlJJREFUeNqkUztoVEEUPfN5k7gf4q4J6yduxKDRQhBEUCQ2KbaJCiI2Wtgt0cJCUEGxshJs/EBSWCoWFhKxULtFDUYXBUFMjJFl1WVBVkX39/a9N96ZfbtuoYU4cLgz8+45986ZeUxrjf8ZMjfBTIxxjqzgyAiJpBT0Qf4ZXKDCGR4whhni/ZQ0ASE7mE4cH9qYGFYRpRhlciHATeyA1owQtFpurVgYbXwqmsKXJVU1AhlDrjerquU3IShREqkDhGRGbQrGVDQ9MkwCmbaAtAJJU9mQV1/4CFAMKh8QFB5Dv7kDXi2DE5kxe1xw1afIuqSd2/MK2DZN5ebcdbRe3QLqXyG3H4Vz+DbE1gNdsjG9DVjYDs03HrbtPr1iozbrwU3g46eBveeIyqAXZi0Zvt8V4F13w/PGTy1gxdQ8nMmrVhSPzgCll8Cuk9CxNcQlsuch+JtAkL8B/f4hWGobMDlNF5yCfnKJkvqBLQfhGTJBB0AQ9Aiw0AM9fw3IXQTuHmu/lJ0noCvL0NQFG9nTFfCJ7PcIuKZdIyCmKDGbB358Bgo5YO0O23bwZREsseG3gAeXABm+5FLnnjvDmlWvgDlRS5JujQr0tQVIsFpFyaSw14eMv5gZ2zd+RDZq0d6rMpUNoRdmT6lINX/v3U3yICuelYGJVUi7nh6NrxsaEPGoRD8ZphTgONSBA04QBIf2ghZvLL6oLBWX6/fPL+G5eR3p9RGkzo5h/+YYdkNjpXG347IfRgsfdHB8e/sdc9NlzJY9lI3AAIFKQvzjn0xyaPwSYACS4hG3ZjB6zgAAAABJRU5ErkJggg==');

	if ($_SESSION['auth']['area'] == 'A' && !empty($_SESSION['auth']['user_id'])) {
		$data = Helpdesk::get_license_information();
		Helpdesk::parse_license_information($data, $auth);
	}

	exit;
}

return array(CONTROLLER_STATUS_NO_PAGE);

?>