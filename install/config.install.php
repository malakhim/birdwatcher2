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


//
// $Id: install.php 7961 2009-09-08 13:14:30Z zeke $
//
if ( !defined('AREA') ) { die('Access denied'); }

/*
Example console-mode config file, please replace these values
*/

$config['http_host'] = 'site.com';
$config['http_path'] = '';
$config['https_host'] = 'site.com';
$config['https_path'] = '';

$config['db_host'] = 'localhost';
$config['db_name'] = 'mycart';
$config['db_user'] = 'root';
$config['db_password'] = 'pass';
$config['db_type'] = 'mysql';

$config['additional_languages'] = array('nl', 'it');
$config['demo_catalog'] = 'Y';
$config['admin_email'] = 'admin@site.com';
$config['feedback_auto'] = 'Y';
$config['license_number'] = 'CART-1111-1111-1111-1111';
$config['skin_name'] = 'basic';
$config['crypt_key'] = 'YOURVERYSECRETKEY';

?>