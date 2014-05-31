<?php /* Smarty version 2.6.18, created on 2014-03-10 11:21:24
         compiled from profiles/profiles_extra_fields.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'strpos', 'profiles/profiles_extra_fields.tpl', 6, false),array('modifier', 'date_format', 'profiles/profiles_extra_fields.tpl', 12, false),array('modifier', 'default', 'profiles/profiles_extra_fields.tpl', 16, false),)), $this); ?>
<?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field']):
?>
<?php if (! $this->_tpl_vars['field']['field_name']): ?>
<?php $this->assign('value', $this->_tpl_vars['order_info']['fields'][$this->_tpl_vars['field']['field_id']], false); ?>
<p>
	<?php echo $this->_tpl_vars['field']['description']; ?>
:
	<?php if (strpos('AOL', $this->_tpl_vars['field']['field_type']) !== false): ?> 		<?php $this->assign('title', ($this->_tpl_vars['field']['field_id'])."_descr", false); ?>
		<?php echo $this->_tpl_vars['user_data'][$this->_tpl_vars['title']]; ?>

	<?php elseif ($this->_tpl_vars['field']['field_type'] == 'C'): ?>  		<?php if ($this->_tpl_vars['value'] == 'Y'): ?><?php echo fn_get_lang_var('yes', $this->getLanguage()); ?>
<?php else: ?><?php echo fn_get_lang_var('no', $this->getLanguage()); ?>
<?php endif; ?>
	<?php elseif ($this->_tpl_vars['field']['field_type'] == 'D'): ?>  		<?php echo smarty_modifier_date_format($this->_tpl_vars['value'], $this->_tpl_vars['settings']['Appearance']['date_format']); ?>

	<?php elseif (strpos('RS', $this->_tpl_vars['field']['field_type']) !== false): ?>  		<?php echo $this->_tpl_vars['field']['values'][$this->_tpl_vars['value']]; ?>

	<?php else: ?>  		<?php echo smarty_modifier_default(@$this->_tpl_vars['value'], "-"); ?>

	<?php endif; ?>
</p>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>