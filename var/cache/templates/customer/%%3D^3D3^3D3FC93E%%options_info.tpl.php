<?php /* Smarty version 2.6.18, created on 2013-09-03 09:47:36
         compiled from common_templates/options_info.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'common_templates/options_info.tpl', 16, false),array('modifier', 'fn_url', 'common_templates/options_info.tpl', 20, false),array('modifier', 'rawurlencode', 'common_templates/options_info.tpl', 20, false),array('modifier', 'truncate', 'common_templates/options_info.tpl', 20, false),array('modifier', 'floatval', 'common_templates/options_info.tpl', 26, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('options'));
?>

<?php if ($this->_tpl_vars['product_options']): ?>
	<?php if (! $this->_tpl_vars['no_block']): ?>
	<div class="product-list-field">
		<label><?php echo fn_get_lang_var('options', $this->getLanguage()); ?>
:</label>
	<?php endif; ?>
		<?php echo ''; ?><?php $_from = $this->_tpl_vars['product_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['po_opt'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['po_opt']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['po']):
        $this->_foreach['po_opt']['iteration']++;
?><?php echo ''; ?><?php if ($this->_tpl_vars['po']['variants']): ?><?php echo ''; ?><?php $this->assign('var', $this->_tpl_vars['po']['variants'][$this->_tpl_vars['po']['value']], false); ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php $this->assign('var', $this->_tpl_vars['po'], false); ?><?php echo ''; ?><?php endif; ?><?php echo '<span class="product-options">'; ?><?php echo $this->_tpl_vars['po']['option_name']; ?><?php echo ': '; ?><?php if (! $this->_tpl_vars['product']['extra']['custom_files'][$this->_tpl_vars['po']['option_id']]): ?><?php echo ''; ?><?php echo smarty_modifier_default(@$this->_tpl_vars['var']['variant_name'], @$this->_tpl_vars['var']['value']); ?><?php echo ''; ?><?php if (! ($this->_foreach['po_opt']['iteration'] == $this->_foreach['po_opt']['total'])): ?><?php echo ';&nbsp;'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['product']['extra']['custom_files'][$this->_tpl_vars['po']['option_id']]): ?><?php echo ''; ?><?php $_from = $this->_tpl_vars['product']['extra']['custom_files'][$this->_tpl_vars['po']['option_id']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['po_files'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['po_files']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['file']):
        $this->_foreach['po_files']['iteration']++;
?><?php echo '<a href="'; ?><?php echo fn_url("orders.get_custom_file?order_id=".($this->_tpl_vars['order_info']['order_id'])); ?><?php echo '&amp;file='; ?><?php echo $this->_tpl_vars['file']['file']; ?><?php echo '&amp;filename='; ?><?php echo rawurlencode($this->_tpl_vars['file']['name']); ?><?php echo '" title="'; ?><?php echo $this->_tpl_vars['file']['name']; ?><?php echo '">'; ?><?php echo smarty_modifier_truncate($this->_tpl_vars['file']['name'], '40'); ?><?php echo '</a>'; ?><?php if (! ($this->_foreach['po_files']['iteration'] == $this->_foreach['po_files']['total'])): ?><?php echo ', '; ?><?php endif; ?><?php echo ''; ?><?php endforeach; endif; unset($_from); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['display_options_modifiers'] == 'Y'): ?><?php echo ''; ?><?php if (floatval($this->_tpl_vars['var']['modifier'])): ?><?php echo '&nbsp;('; ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/modifier.tpl", 'smarty_include_vars' => array('mod_type' => $this->_tpl_vars['var']['modifier_type'],'mod_value' => $this->_tpl_vars['var']['modifier'],'display_sign' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php echo ')'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo '</span>'; ?><?php if ($this->_tpl_vars['fields_prefix']): ?><?php echo '<input type="hidden" name="'; ?><?php echo $this->_tpl_vars['fields_prefix']; ?><?php echo '['; ?><?php echo $this->_tpl_vars['po']['option_id']; ?><?php echo ']" value="'; ?><?php echo $this->_tpl_vars['po']['value']; ?><?php echo '" />'; ?><?php endif; ?><?php echo ''; ?><?php endforeach; endif; unset($_from); ?><?php echo ''; ?>

	<?php if (! $this->_tpl_vars['no_block']): ?>
	</div>
	<?php endif; ?>
<?php endif; ?>