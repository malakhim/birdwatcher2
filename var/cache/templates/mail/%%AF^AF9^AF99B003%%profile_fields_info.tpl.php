<?php /* Smarty version 2.6.18, created on 2014-03-08 12:27:54
         compiled from profiles/profile_fields_info.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'profiles/profile_fields_info.tpl', 2, false),array('modifier', 'fn_get_profile_field_value', 'profiles/profile_fields_info.tpl', 5, false),)), $this); ?>
<tr>
	<td colspan="2" class="form-title"><?php echo smarty_modifier_default(@$this->_tpl_vars['title'], "&nbsp;"); ?>
<hr size="1" noshade="noshade" /></td>
</tr>
<?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field']):
?>
<?php $this->assign('value', fn_get_profile_field_value($this->_tpl_vars['user_data'], $this->_tpl_vars['field']), false); ?>
<?php if ($this->_tpl_vars['value']): ?>
<tr>
	<td class="form-field-caption" width="30%" nowrap="nowrap"><?php echo $this->_tpl_vars['field']['description']; ?>
:&nbsp;</td>
	<td>
		<?php echo smarty_modifier_default(@$this->_tpl_vars['value'], "-"); ?>

	</td>
</tr>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>