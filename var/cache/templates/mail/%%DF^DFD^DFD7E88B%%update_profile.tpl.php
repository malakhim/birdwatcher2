<?php /* Smarty version 2.6.18, created on 2013-09-23 17:33:05
         compiled from profiles/update_profile.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_get_user_type_description', 'profiles/update_profile.tpl', 3, false),array('modifier', 'lower', 'profiles/update_profile.tpl', 3, false),array('modifier', 'escape', 'profiles/update_profile.tpl', 3, false),array('block', 'hook', 'profiles/update_profile.tpl', 7, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "letter_header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php echo fn_get_lang_var('dear', $this->getLanguage()); ?>
 <?php if ($this->_tpl_vars['user_data']['firstname']): ?><?php echo $this->_tpl_vars['user_data']['firstname']; ?>
<?php else: ?><?php echo smarty_modifier_escape(smarty_modifier_lower(fn_get_user_type_description($this->_tpl_vars['user_data']['user_type']))); ?>
<?php endif; ?>,<br><br>

<?php echo fn_get_lang_var('update_profile_notification_header', $this->getLanguage()); ?>
<br><br>

<?php $this->_tag_stack[] = array('hook', array('name' => "profiles:update_profile")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "profiles/profiles_info.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "letter_footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>