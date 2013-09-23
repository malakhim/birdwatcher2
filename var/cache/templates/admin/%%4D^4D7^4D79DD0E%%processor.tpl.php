<?php /* Smarty version 2.6.18, created on 2013-09-21 20:04:50
         compiled from views/payments/processor.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_get_curl_info', 'views/payments/processor.tpl', 4, false),)), $this); ?>
<div id="content_tab_conf_<?php echo $this->_tpl_vars['payment_id']; ?>
">

<?php if ($this->_tpl_vars['callback'] == 'Y'): ?>
	<?php echo fn_get_curl_info($this->_tpl_vars['processor_name']); ?>

<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/payments/components/cc_processors/".($this->_tpl_vars['processor_template']), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<!--content_tab_conf_<?php echo $this->_tpl_vars['payment_id']; ?>
--></div>