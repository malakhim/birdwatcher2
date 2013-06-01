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

fn_define('GOOGLE_EXPORT_MAX_DESCR_LENGTH', 9999);

$schema['export_fields']['Description']['process_get'] = array (
    'fn_exim_google_export_format_description',
    '#this'
);

function fn_exim_google_export_format_description($product_descr)
{
    $return = strip_tags($product_descr);
    if (strlen($return) > GOOGLE_EXPORT_MAX_DESCR_LENGTH) {
        $return = substr($return, 0, GOOGLE_EXPORT_MAX_DESCR_LENGTH);
    }

    return $return;
}

?>
