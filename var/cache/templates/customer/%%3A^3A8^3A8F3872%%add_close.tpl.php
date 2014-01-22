<?php /* Smarty version 2.6.18, created on 2014-01-21 22:57:01
         compiled from buttons/add_close.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'trim', 'buttons/add_close.tpl', 10, false),array('function', 'set_id', 'buttons/add_close.tpl', 10, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('or','cancel'));
?>
<?php ob_start(); ?><?php if ($this->_tpl_vars['is_js'] == true): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/button.tpl", 'smarty_include_vars' => array('but_name' => 'submit','but_text' => $this->_tpl_vars['but_close_text'],'but_onclick' => $this->_tpl_vars['but_close_onclick'],'but_role' => 'button_main','but_meta' => "cm-process-items cm-dialog-closer")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>&nbsp;
	<?php if ($this->_tpl_vars['but_text']): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/button.tpl", 'smarty_include_vars' => array('but_name' => 'submit','but_text' => $this->_tpl_vars['but_text'],'but_onclick' => $this->_tpl_vars['but_onclick'],'but_role' => 'submit','but_meta' => "cm-process-items")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>&nbsp;
	<?php endif; ?>
<?php else: ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/button.tpl", 'smarty_include_vars' => array('but_name' => 'submit','but_text' => $this->_tpl_vars['but_close_text'],'but_role' => 'button_main','but_meta' => "cm-process-items")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>&nbsp;
<?php endif; ?>

&nbsp;<?php echo fn_get_lang_var('or', $this->getLanguage()); ?>
&nbsp;&nbsp;&nbsp;<a class="cm-dialog-closer text-button nobg"><?php echo fn_get_lang_var('cancel', $this->getLanguage()); ?>
</a><?php $this->_smarty_vars['capture']['template_content'] = ob_get_contents(); ob_end_clean(); ?><?php if (trim($this->_smarty_vars['capture']['template_content'])): ?><?php if ($this->_tpl_vars['auth']['area'] == 'A'): ?><span class="cm-template-box" template="buttons/add_close.tpl" id="<?php echo smarty_function_set_id(array('name' => "buttons/add_close.tpl"), $this);?>
"><img class="cm-template-icon hidden" src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/layout_edit.gif" width="16" height="16" alt="" /><?php echo $this->_smarty_vars['capture']['template_content']; ?>
<!--[/tpl_id]--></span><?php else: ?><?php echo $this->_smarty_vars['capture']['template_content']; ?>
<?php endif; ?><?php endif; ?>