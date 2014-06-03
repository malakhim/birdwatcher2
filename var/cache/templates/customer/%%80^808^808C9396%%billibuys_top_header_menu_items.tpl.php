<?php /* Smarty version 2.6.18, created on 2014-06-01 06:30:05
         compiled from C:/wamp5/www/dutchme2/skins/basic/customer/addons/billibuys/blocks/static_templates/billibuys_top_header_menu_items.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_url', 'C:/wamp5/www/dutchme2/skins/basic/customer/addons/billibuys/blocks/static_templates/billibuys_top_header_menu_items.tpl', 1, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('account','view_cart'));
?>
<?php  ob_start();  ?><span class="top_menu_item" href="<?php echo fn_url('profiles.update'); ?>
"><img alt="icon here?" /><?php echo fn_get_lang_var('account', $this->getLanguage()); ?>
</span>
<?php if ($_SESSION['cart']['products']): ?>
	<span class="top_menu_item" href="<?php echo fn_url('checkout.cart'); ?>
"><img alt="icon here?" /><?php echo fn_get_lang_var('view_cart', $this->getLanguage()); ?>
</span>
<?php endif; ?><?php  ob_end_flush();  ?>