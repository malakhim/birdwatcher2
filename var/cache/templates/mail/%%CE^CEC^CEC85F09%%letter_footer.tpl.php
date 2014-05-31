<?php /* Smarty version 2.6.18, created on 2014-03-10 11:21:24
         compiled from letter_footer.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_check_user_type_admin_area', 'letter_footer.tpl', 2, false),array('modifier', 'replace', 'letter_footer.tpl', 3, false),)), $this); ?>
<p>
<?php if (fn_check_user_type_admin_area($this->_tpl_vars['user_type']) || fn_check_user_type_admin_area($this->_tpl_vars['user_data'])): ?>
	<?php echo smarty_modifier_replace(fn_get_lang_var('admin_text_letter_footer', $this->getLanguage()), '[company_name]', $this->_tpl_vars['settings']['Company']['company_name']); ?>

<?php elseif ($this->_tpl_vars['user_type'] == 'P' || $this->_tpl_vars['user_data']['user_type'] == 'P'): ?>
	<?php echo fn_get_lang_var('affiliate_text_letter_footer', $this->getLanguage()); ?>

<?php else: ?>
	<?php echo fn_get_lang_var('customer_text_letter_footer', $this->getLanguage()); ?>

<?php endif; ?>
</p>
</body>
</html>