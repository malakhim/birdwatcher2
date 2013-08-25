<?php /* Smarty version 2.6.18, created on 2013-08-22 16:22:20
         compiled from C:/wamp5/www/dutchme2/skins/basic/customer/blocks/static_templates/auth_info.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_url', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/static_templates/auth_info.tpl', 4, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('text_login_form','register_new_account','text_recover_password_title','text_recover_password'));
?>
<?php  ob_start();  ?><div class="login-info">
<?php if ($this->_tpl_vars['controller'] == 'auth' && $this->_tpl_vars['mode'] == 'login_form'): ?>
	<?php echo fn_get_lang_var('text_login_form', $this->getLanguage()); ?>

	<a href="<?php echo fn_url("profiles.add"); ?>
"><?php echo fn_get_lang_var('register_new_account', $this->getLanguage()); ?>
</a>
<?php elseif ($this->_tpl_vars['controller'] == 'auth' && $this->_tpl_vars['mode'] == 'recover_password'): ?>
	<h4><?php echo fn_get_lang_var('text_recover_password_title', $this->getLanguage()); ?>
</h4>
	<?php echo fn_get_lang_var('text_recover_password', $this->getLanguage()); ?>

<?php endif; ?>
</div><?php  ob_end_flush();  ?>