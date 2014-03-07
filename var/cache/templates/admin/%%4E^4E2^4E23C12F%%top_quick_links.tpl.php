<?php /* Smarty version 2.6.18, created on 2014-03-07 21:22:23
         compiled from top_quick_links.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_url', 'top_quick_links.tpl', 6, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('sign_out'));
?>
<a href="<?php echo fn_url("profiles.update?user_id=".($this->_tpl_vars['auth']['user_id'])); ?>
"><span><?php if ($this->_tpl_vars['settings']['General']['use_email_as_login'] == 'Y'): ?><?php echo $this->_tpl_vars['user_info']['email']; ?>
<?php else: ?><?php echo $this->_tpl_vars['user_info']['user_login']; ?>
<?php endif; ?></span></a><span class="top-signout" title="<?php echo fn_get_lang_var('sign_out', $this->getLanguage()); ?>
">
<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/sign_out.tpl", 'smarty_include_vars' => array('but_href' => "auth.logout",'but_role' => 'text')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></span>