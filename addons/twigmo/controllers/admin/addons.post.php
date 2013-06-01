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

if ($_SERVER['REQUEST_METHOD'] == 'GET' and $mode == 'update' and $_REQUEST['addon'] == 'twigmo') {
	
	$location = Bm_Location::instance()->get('twigmo.post');
	$locations_info['twigmo'] = $location['location_id'];
	
	$location = Bm_Location::instance()->get('index.index');
	$locations_info['index'] = $location['location_id'];

	$view->assign('locations_info', $locations_info);

	$options = $view->get_template_vars('options');
	if (isset($options['main'])) {
		unset($options['main']);
		$view->assign('options', $options);
	}
}

?>