<?php /* Smarty version 2.6.18, created on 2013-09-28 16:55:49
         compiled from C:/wamp5/www/dutchme2/skins/basic/customer/addons/billibuys/blocks/static_templates/billibuys_home.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_url', 'C:/wamp5/www/dutchme2/skins/basic/customer/addons/billibuys/blocks/static_templates/billibuys_home.tpl', 5, false),)), $this); ?>
<?php  ob_start();  ?>
This is the front page!

<a href="<?php echo fn_url("billibuys.view"); ?>
">Billibuysviewtestlink</a><?php  ob_end_flush();  ?>