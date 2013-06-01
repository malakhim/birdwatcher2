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

// Global update handlers
$schema['update_handlers'] = array (
	'addons',
	'settings',
	'bm_blocks',
	'bm_blocks_snapping',
	'bm_blocks_content',
	'bm_blocks_descriptions',
	'bm_snapping',
	'languages',
	'language_values'
);

?>