<?php /* Smarty version 2.6.18, created on 2014-03-09 13:08:20
         compiled from profiles/create_profile_subj.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_get_user_type_description', 'profiles/create_profile_subj.tpl', 1, false),array('modifier', 'lower', 'profiles/create_profile_subj.tpl', 1, false),array('modifier', 'unescape', 'profiles/create_profile_subj.tpl', 2, false),array('modifier', 'replace', 'profiles/create_profile_subj.tpl', 2, false),)), $this); ?>
<?php $this->assign('u_type', smarty_modifier_lower(fn_get_user_type_description($this->_tpl_vars['user_data']['user_type'])), false); ?>
<?php if ($this->_tpl_vars['user_data']['company_name']): ?><?php echo smarty_modifier_unescape($this->_tpl_vars['user_data']['company_name']); ?>
<?php else: ?><?php echo smarty_modifier_unescape($this->_tpl_vars['settings']['Company']['company_name']); ?>
<?php endif; ?>: <?php echo smarty_modifier_replace(fn_get_lang_var('new_profile_notification', $this->getLanguage()), '[user_type]', $this->_tpl_vars['u_type']); ?>