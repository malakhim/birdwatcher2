<?php /* Smarty version 2.6.18, created on 2013-09-01 10:55:38
         compiled from orders/order_notification.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'unescape', 'orders/order_notification.tpl', 5, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "letter_header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php echo fn_get_lang_var('dear', $this->getLanguage()); ?>
 <?php echo $this->_tpl_vars['order_info']['firstname']; ?>
,<br /><br />

<?php echo smarty_modifier_unescape($this->_tpl_vars['order_status']['email_header']); ?>
<br /><br />

<?php $this->assign('order_header', fn_get_lang_var('invoice', $this->getLanguage()), false); ?>
<?php if ($this->_tpl_vars['status_settings']['appearance_type'] == 'C' && $this->_tpl_vars['order_info']['doc_ids'][$this->_tpl_vars['status_settings']['appearance_type']]): ?>
	<?php $this->assign('order_header', fn_get_lang_var('credit_memo', $this->getLanguage()), false); ?>
<?php elseif ($this->_tpl_vars['status_settings']['appearance_type'] == 'O'): ?>
	<?php $this->assign('order_header', fn_get_lang_var('order_details', $this->getLanguage()), false); ?>
<?php endif; ?>

<b><?php echo $this->_tpl_vars['order_header']; ?>
:</b><br />

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "orders/invoice.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "letter_footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>