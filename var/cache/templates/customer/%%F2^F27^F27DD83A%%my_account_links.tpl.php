<?php /* Smarty version 2.6.18, created on 2013-06-01 19:33:02
         compiled from C:/wamp5/www/dutchme2/skins/basic/customer/blocks/static_templates/my_account_links.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_url', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/static_templates/my_account_links.tpl', 6, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('my_account','orders','profile_details','sign_in','create_account'));
?>
<?php  ob_start();  ?><p>
	<span><?php echo fn_get_lang_var('my_account', $this->getLanguage()); ?>
</span>
</p>
<ul>
<?php if ($this->_tpl_vars['auth']['user_id']): ?>
	<li><a href="<?php echo fn_url("orders.search"); ?>
"><?php echo fn_get_lang_var('orders', $this->getLanguage()); ?>
</a></li>
	<li><a href="<?php echo fn_url("profiles.update"); ?>
"><?php echo fn_get_lang_var('profile_details', $this->getLanguage()); ?>
</a></li>
<?php else: ?>
	<li><a href="<?php echo fn_url("auth.login_form"); ?>
"><?php echo fn_get_lang_var('sign_in', $this->getLanguage()); ?>
</a></li>
	<li><a href="<?php echo fn_url("profiles.add"); ?>
"><?php echo fn_get_lang_var('create_account', $this->getLanguage()); ?>
</a></li>
<?php endif; ?>
</ul><?php  ob_end_flush();  ?>