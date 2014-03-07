<?php /* Smarty version 2.6.18, created on 2014-03-07 17:24:51
         compiled from pickers/js_order.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_url', 'pickers/js_order.tpl', 20, false),array('modifier', 'fn_get_statuses', 'pickers/js_order.tpl', 23, false),array('modifier', 'default', 'pickers/js_order.tpl', 33, false),array('modifier', 'date_format', 'pickers/js_order.tpl', 39, false),array('modifier', 'format_price', 'pickers/js_order.tpl', 43, false),array('modifier', 'unescape', 'pickers/js_order.tpl', 43, false),array('function', 'html_options', 'pickers/js_order.tpl', 30, false),array('function', 'html_checkboxes', 'pickers/js_order.tpl', 33, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('delete'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/price.tpl' => 1367063753,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php if ($this->_tpl_vars['view_mode'] == 'simple'): ?>
<span <?php if (! $this->_tpl_vars['clone']): ?>id="<?php echo $this->_tpl_vars['holder']; ?>
_<?php echo $this->_tpl_vars['order_id']; ?>
" <?php endif; ?>class="cm-js-item<?php if ($this->_tpl_vars['clone']): ?> cm-clone<?php endif; ?><?php if ($this->_tpl_vars['clone'] || $this->_tpl_vars['hidden']): ?> hidden<?php endif; ?>"><?php if (! $this->_tpl_vars['first_item']): ?><span class="cm-comma<?php if ($this->_tpl_vars['clone']): ?> hidden<?php endif; ?>">, </span><?php endif; ?>#<?php echo $this->_tpl_vars['order_id']; ?>
</span>
<?php else: ?>
<tr <?php if (! $this->_tpl_vars['clone']): ?>id="<?php echo $this->_tpl_vars['holder']; ?>
_<?php echo $this->_tpl_vars['order_id']; ?>
" <?php endif; ?>class="cm-js-item<?php if ($this->_tpl_vars['clone']): ?> cm-clone hidden<?php endif; ?>">
	<td>
		<a href="<?php echo fn_url("orders.details?order_id=".($this->_tpl_vars['order_id'])); ?>
">&nbsp;<span>#<?php echo $this->_tpl_vars['order_id']; ?>
</span>&nbsp;</a></td>
	<td><?php if ($this->_tpl_vars['clone']): ?><?php echo $this->_tpl_vars['status']; ?>
<?php else: ?><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('status' => $this->_tpl_vars['status'], 'display' => 'view', 'name' => "order_statuses[".($this->_tpl_vars['order_id'])."]", )); ?><?php if (! $this->_tpl_vars['order_status_descr']): ?>
	<?php if (! $this->_tpl_vars['status_type']): ?><?php $this->assign('status_type', @STATUSES_ORDER, false); ?><?php endif; ?>
	<?php $this->assign('order_status_descr', fn_get_statuses($this->_tpl_vars['status_type'], true), false); ?>
<?php endif; ?>

<?php echo ''; ?><?php if ($this->_tpl_vars['display'] == 'view'): ?><?php echo ''; ?><?php echo $this->_tpl_vars['order_status_descr'][$this->_tpl_vars['status']]; ?><?php echo ''; ?><?php elseif ($this->_tpl_vars['display'] == 'select'): ?><?php echo ''; ?><?php echo smarty_function_html_options(array('name' => $this->_tpl_vars['name'],'options' => $this->_tpl_vars['order_status_descr'],'selected' => $this->_tpl_vars['status'],'id' => $this->_tpl_vars['select_id']), $this);?><?php echo ''; ?><?php elseif ($this->_tpl_vars['display'] == 'checkboxes'): ?><?php echo '<div>'; ?><?php echo smarty_function_html_checkboxes(array('name' => $this->_tpl_vars['name'],'options' => $this->_tpl_vars['order_status_descr'],'selected' => $this->_tpl_vars['status'],'columns' => smarty_modifier_default(@$this->_tpl_vars['columns'], 4)), $this);?><?php echo '</div>'; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?></td>
	<td><?php echo $this->_tpl_vars['customer']; ?>
</td>
	<td>
		<a href="<?php echo fn_url("orders.details?order_id=".($this->_tpl_vars['order_id'])); ?>
" class="underlined"><?php if ($this->_tpl_vars['clone']): ?><?php echo $this->_tpl_vars['timestamp']; ?>
<?php else: ?><?php echo smarty_modifier_date_format($this->_tpl_vars['timestamp'], ($this->_tpl_vars['settings']['Appearance']['date_format']).", ".($this->_tpl_vars['settings']['Appearance']['time_format'])); ?>
<?php endif; ?></a></td>
	<td class="right">
		<?php if ($this->_tpl_vars['clone']): ?><?php echo $this->_tpl_vars['total']; ?>
<?php else: ?><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['total'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false)); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true)); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?></td>
	<?php if (! $this->_tpl_vars['view_only']): ?>
	<td class="nowrap">
		<?php ob_start(); ?>
		<li><a onclick="$.delete_js_item('<?php echo $this->_tpl_vars['holder']; ?>
', '<?php echo $this->_tpl_vars['order_id']; ?>
', 'o'); return false;"><?php echo fn_get_lang_var('delete', $this->getLanguage()); ?>
</a></li>
		<?php $this->_smarty_vars['capture']['tools_items'] = ob_get_contents(); ob_end_clean(); ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/table_tools_list.tpl", 'smarty_include_vars' => array('prefix' => $this->_tpl_vars['order_id'],'tools_list' => $this->_smarty_vars['capture']['tools_items'],'href' => "orders.details?order_id=".($this->_tpl_vars['order_id']))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</td>
	<?php endif; ?>
</tr>
<?php endif; ?>