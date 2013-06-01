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


define('SKIP_SESSION_VALIDATION', true);
$_REQUEST['dispatch'] = 'checkout.cresecure_template';

require './init_payment.php';

fn_run_controller(DIR_ROOT . '/controllers/customer/init.php');

$view = & Registry::get('view');

$view->assign('display_base_href', true);

fn_add_breadcrumb(fn_get_lang_var('payment_information'));

$view->assign('content_tpl', 'views/orders/processors/cresecure.tpl');

$view->display(Registry::get('root_template'));
?>