<?php /* Smarty version 2.6.18, created on 2014-03-08 12:34:34
         compiled from profiles/update_profile_subj.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'unescape', 'profiles/update_profile_subj.tpl', 1, false),)), $this); ?>
<?php if ($this->_tpl_vars['user_data']['company_name']): ?><?php echo smarty_modifier_unescape($this->_tpl_vars['user_data']['company_name']); ?>
<?php else: ?><?php echo smarty_modifier_unescape($this->_tpl_vars['settings']['Company']['company_name']); ?>
<?php endif; ?>: <?php echo fn_get_lang_var('update_profile_notification', $this->getLanguage()); ?>