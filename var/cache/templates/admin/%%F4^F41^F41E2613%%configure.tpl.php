<?php /* Smarty version 2.6.18, created on 2014-03-08 23:37:22
         compiled from views/shippings/configure.tpl */ ?>
<div id="content_configure">

<?php if ($this->_tpl_vars['service_template']): ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/shippings/components/services/".($this->_tpl_vars['service_template']).".tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>

<div class="buttons-container buttons-bg">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[shippings.update_shipping]")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>

<!--content_configure--></div>