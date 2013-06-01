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

if ($action != 'step2') {
	$_SESSION['twigmo_upgrade'] = array('upgrade_dirs' => $upgrade_dirs, 'insall_src_dir' => $insall_src_dir);
	fn_stop_scroller();
	echo '<br><br>';
	fn_redirect('upgrade_center.upgrade_twigmo.step2');
}

?>