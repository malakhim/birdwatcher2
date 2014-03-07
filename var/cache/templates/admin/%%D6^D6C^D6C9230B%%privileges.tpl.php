<?php /* Smarty version 2.6.18, created on 2014-03-07 13:58:53
         compiled from views/usergroups/privileges.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_url', 'views/usergroups/privileges.tpl', 3, false),array('function', 'cycle', 'views/usergroups/privileges.tpl', 19, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('check_uncheck_all','privilege','description','translate_privileges'));
?>
<?php ob_start(); ?>

<form action="<?php echo fn_url(""); ?>
" method="post" name="privileges_form">

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
<tr>
	<th>
		<input type="checkbox" name="check_all" value="Y" title="<?php echo fn_get_lang_var('check_uncheck_all', $this->getLanguage()); ?>
" class="checkbox cm-check-items" /></th>
	<th><?php echo fn_get_lang_var('privilege', $this->getLanguage()); ?>
</th>
	<th width="100%" class="center"><?php echo fn_get_lang_var('description', $this->getLanguage()); ?>
</th>
</tr>			 

<?php $_from = $this->_tpl_vars['privileges']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['section_id'] => $this->_tpl_vars['privilege']):
?>
<tr>
	<td colspan="3"><input size="25" type="text" class="input-text-long" name="section_name[<?php echo $this->_tpl_vars['section_id']; ?>
]" value="<?php echo $this->_tpl_vars['privilege']['0']['section']; ?>
" /></td>
</tr>

<?php $_from = $this->_tpl_vars['privilege']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['p']):
?>
<tr <?php echo smarty_function_cycle(array('values' => "class=\"table-row\", "), $this);?>
>
	<td width="1%">
		<?php if ($this->_tpl_vars['p']['is_default'] == 'Y'): ?>&nbsp;<?php else: ?><input type="checkbox" name="delete[<?php echo $this->_tpl_vars['p']['privilege']; ?>
]" id="delete_checkbox" class="checkbox cm-item" value="Y" /><?php endif; ?></td>
	<td><?php echo $this->_tpl_vars['p']['privilege']; ?>
</td>
	<td><input type="text" class="input-text" size="35" name="privilege_descr[<?php echo $this->_tpl_vars['p']['privilege']; ?>
]" value="<?php echo $this->_tpl_vars['p']['description']; ?>
" /></td>
</tr>
<?php endforeach; endif; unset($_from); ?>
<?php endforeach; endif; unset($_from); ?>
</table>

<div class="buttons-container buttons-bg">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[usergroups.update_privilege_descriptions]",'but_role' => 'button_main')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>

</form>

<?php $this->_smarty_vars['capture']['mainbox'] = ob_get_contents(); ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('translate_privileges', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['mainbox'],'select_languages' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>