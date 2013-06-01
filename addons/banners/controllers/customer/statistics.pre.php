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

if ($mode == 'banners') {

	if (!empty($_REQUEST['banner_id'])) {
		// Check if banner exists
		$banner = db_get_row(
			"SELECT b.banner_id, b.url, b.type, bd.description FROM ?:banners AS b " .
			"LEFT JOIN ?:banner_descriptions bd ON bd.banner_id = b.banner_id AND bd.lang_code = ?s " .
			"WHERE b.banner_id = ?i AND b.status IN ('A', 'H') ",
			CART_LANGUAGE, $_REQUEST['banner_id']
		);
		if (!empty($banner['banner_id'])) {
			db_query('INSERT INTO ?:stat_banners_log ?e', array('banner_id' => $_REQUEST['banner_id'], 'timestamp' => TIME));
		} else {
			return array(CONTROLLER_STATUS_NO_PAGE);
		}
		
		if ($banner['type'] == 'G') {
			return array(CONTROLLER_STATUS_REDIRECT, $banner['url'], true);	
		} elseif ($banner['type'] == 'T' && !empty($banner['description']) && isset($_REQUEST['link'])) {
			preg_match_all('/href=([\'|"])(.*?)([\'|"])/i', $banner['description'], $matches);
			if (!empty($matches[2][$_REQUEST['link']])) {
				return array(CONTROLLER_STATUS_REDIRECT, $matches[2][$_REQUEST['link']], true);	
			}
		}
		return array(CONTROLLER_STATUS_NO_PAGE);
	}

}

?>