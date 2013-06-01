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

if ($mode == 'picker' && !empty($_REQUEST['picker_for']) && $_REQUEST['picker_for'] == 'subscribers') {
	$mailing_lists = db_get_hash_single_array("SELECT m.list_id, d.object FROM ?:mailing_lists m INNER JOIN ?:common_descriptions d ON m.list_id=d.object_id WHERE d.object_holder='mailing_lists' AND d.lang_code = ?s", array('list_id', 'object'), DESCR_SL);

	$view->assign('mailing_lists', $mailing_lists);
}

?>