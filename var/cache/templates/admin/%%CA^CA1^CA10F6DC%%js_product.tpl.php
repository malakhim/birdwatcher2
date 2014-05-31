<?php /* Smarty version 2.6.18, created on 2014-03-10 02:13:52
         compiled from pickers/js_product.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'pickers/js_product.tpl', 19, false),array('modifier', 'fn_get_company_name', 'pickers/js_product.tpl', 31, false),array('modifier', 'is_array', 'pickers/js_product.tpl', 38, false),array('modifier', 'fn_url', 'pickers/js_product.tpl', 75, false),array('modifier', 'unescape', 'pickers/js_product.tpl', 75, false),array('block', 'hook', 'pickers/js_product.tpl', 60, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('vendor','supplier','delete','vendor','supplier','delete'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'views/companies/components/company_name.tpl' => 1367063755,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?>

<?php if ($this->_tpl_vars['type'] == 'options'): ?>
<tr <?php if (! $this->_tpl_vars['clone']): ?>id="<?php echo $this->_tpl_vars['root_id']; ?>
_<?php echo $this->_tpl_vars['delete_id']; ?>
" <?php endif; ?>class="cm-js-item<?php if ($this->_tpl_vars['clone']): ?> cm-clone hidden<?php endif; ?>">
<?php if ($this->_tpl_vars['position_field']): ?><td><input type="text" name="<?php echo $this->_tpl_vars['input_name']; ?>
[<?php echo $this->_tpl_vars['delete_id']; ?>
]" value="<?php echo smarty_function_math(array('equation' => "a*b",'a' => $this->_tpl_vars['position'],'b' => 10), $this);?>
" size="3" class="input-text-short" <?php if ($this->_tpl_vars['clone']): ?>disabled="disabled"<?php endif; ?> /></td><?php endif; ?>
<td>
	<ul>
		<li><?php echo $this->_tpl_vars['product']; ?>
<?php if ($this->_tpl_vars['show_only_name']): ?> <?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('company_id' => $this->_tpl_vars['product_data']['company_id'], )); ?><?php if (@PRODUCT_TYPE == 'MULTIVENDOR' || @PRODUCT_TYPE == 'ULTIMATE'): ?>
<?php $this->assign('lang_vendor_supplier', fn_get_lang_var('vendor', $this->getLanguage()), false); ?>
<?php else: ?>
<?php $this->assign('lang_vendor_supplier', fn_get_lang_var('supplier', $this->getLanguage()), false); ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['company_name']): ?>
 (<?php echo $this->_tpl_vars['lang_vendor_supplier']; ?>
: <?php echo $this->_tpl_vars['company_name']; ?>
)
<?php elseif ($this->_tpl_vars['company_id']): ?>
 (<?php echo $this->_tpl_vars['lang_vendor_supplier']; ?>
: <?php echo fn_get_company_name($this->_tpl_vars['company_id']); ?>
)
<?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?></li>
		<?php if ($this->_tpl_vars['options']): ?>
		<li><?php echo $this->_tpl_vars['options']; ?>
</li>
		<?php endif; ?>
	</ul>
	<?php if (is_array($this->_tpl_vars['options_array'])): ?>
		<?php $_from = $this->_tpl_vars['options_array']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['option_id'] => $this->_tpl_vars['option']):
?>
		<input type="hidden" name="<?php echo $this->_tpl_vars['input_name']; ?>
[product_options][<?php echo $this->_tpl_vars['option_id']; ?>
]" value="<?php echo $this->_tpl_vars['option']; ?>
"<?php if ($this->_tpl_vars['clone']): ?> disabled="disabled"<?php endif; ?> />
		<?php endforeach; endif; unset($_from); ?>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['product_id']): ?>
		<input type="hidden" name="<?php echo $this->_tpl_vars['input_name']; ?>
[product_id]" value="<?php echo $this->_tpl_vars['product_id']; ?>
"<?php if ($this->_tpl_vars['clone']): ?> disabled="disabled"<?php endif; ?> />
	<?php endif; ?>
	<?php if ($this->_tpl_vars['amount_input'] == 'hidden'): ?>
	<input type="hidden" name="<?php echo $this->_tpl_vars['input_name']; ?>
[amount]" value="<?php echo $this->_tpl_vars['amount']; ?>
"<?php if ($this->_tpl_vars['clone']): ?> disabled="disabled"<?php endif; ?> />
	<?php endif; ?>
</td>
	<?php if ($this->_tpl_vars['amount_input'] == 'text'): ?>
<td>
	<?php if ($this->_tpl_vars['show_only_name']): ?>
		<?php echo $this->_tpl_vars['amount']; ?>

	<?php else: ?>
		<input type="text" name="<?php echo $this->_tpl_vars['input_name']; ?>
[amount]" value="<?php echo $this->_tpl_vars['amount']; ?>
" size="3" class="input-text-short"<?php if ($this->_tpl_vars['clone']): ?> disabled="disabled"<?php endif; ?> />
	<?php endif; ?>
</td>
	<?php endif; ?>

	<?php $this->_tag_stack[] = array('hook', array('name' => "product_picker:table_column_options")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<?php if ($this->_tpl_vars['addons']['bundled_products']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/bundled_products/hooks/product_picker/table_column_options.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<td class="nowrap">
	<?php if (! $this->_tpl_vars['hide_delete_button'] && ! $this->_tpl_vars['show_only_name']): ?>
		<?php ob_start(); ?>
		<li><a onclick="$.delete_js_item('<?php echo $this->_tpl_vars['root_id']; ?>
', '<?php echo $this->_tpl_vars['delete_id']; ?>
', 'p'); return false;"><?php echo fn_get_lang_var('delete', $this->getLanguage()); ?>
</a></li>
		<?php $this->_smarty_vars['capture']['tools_items'] = ob_get_contents(); ob_end_clean(); ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/table_tools_list.tpl", 'smarty_include_vars' => array('prefix' => $this->_tpl_vars['category_id'],'tools_list' => $this->_smarty_vars['capture']['tools_items'],'skip_check_permissions' => 1)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php else: ?>&nbsp;<?php endif; ?>
</td>
</tr>

<?php elseif ($this->_tpl_vars['type'] == 'product'): ?>
	<tr <?php if (! $this->_tpl_vars['clone']): ?>id="<?php echo $this->_tpl_vars['root_id']; ?>
_<?php echo $this->_tpl_vars['delete_id']; ?>
" <?php endif; ?>class="cm-js-item<?php if ($this->_tpl_vars['clone']): ?> cm-clone hidden<?php endif; ?>">
		<?php if ($this->_tpl_vars['position_field']): ?><td><input type="text" name="<?php echo $this->_tpl_vars['input_name']; ?>
[<?php echo $this->_tpl_vars['delete_id']; ?>
]" value="<?php echo smarty_function_math(array('equation' => "a*b",'a' => $this->_tpl_vars['position'],'b' => 10), $this);?>
" size="3" class="input-text-short" <?php if ($this->_tpl_vars['clone']): ?>disabled="disabled"<?php endif; ?> /></td><?php endif; ?>
		<td><?php if (! $this->_tpl_vars['show_only_name']): ?><a href="<?php echo fn_url("products.update?product_id=".($this->_tpl_vars['delete_id'])); ?>
"><?php echo smarty_modifier_unescape($this->_tpl_vars['product']); ?>
</a><?php else: ?><?php echo smarty_modifier_unescape($this->_tpl_vars['product']); ?>
 <?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('company_id' => $this->_tpl_vars['product_data']['company_id'], )); ?><?php if (@PRODUCT_TYPE == 'MULTIVENDOR' || @PRODUCT_TYPE == 'ULTIMATE'): ?>
<?php $this->assign('lang_vendor_supplier', fn_get_lang_var('vendor', $this->getLanguage()), false); ?>
<?php else: ?>
<?php $this->assign('lang_vendor_supplier', fn_get_lang_var('supplier', $this->getLanguage()), false); ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['company_name']): ?>
 (<?php echo $this->_tpl_vars['lang_vendor_supplier']; ?>
: <?php echo $this->_tpl_vars['company_name']; ?>
)
<?php elseif ($this->_tpl_vars['company_id']): ?>
 (<?php echo $this->_tpl_vars['lang_vendor_supplier']; ?>
: <?php echo fn_get_company_name($this->_tpl_vars['company_id']); ?>
)
<?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?></td>
		<td>&nbsp;</td>
		<td class="nowrap"><?php if (! $this->_tpl_vars['hide_delete_button'] && ! $this->_tpl_vars['show_only_name']): ?>
			<?php ob_start(); ?>
			<li><a onclick="$.delete_js_item('<?php echo $this->_tpl_vars['root_id']; ?>
', '<?php echo $this->_tpl_vars['delete_id']; ?>
', 'p'); return false;"><?php echo fn_get_lang_var('delete', $this->getLanguage()); ?>
</a></li>
			<?php $this->_smarty_vars['capture']['tools_items'] = ob_get_contents(); ob_end_clean(); ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/table_tools_list.tpl", 'smarty_include_vars' => array('prefix' => $this->_tpl_vars['category_id'],'tools_list' => $this->_smarty_vars['capture']['tools_items'],'href' => "products.update?product_id=".($this->_tpl_vars['delete_id']),'skip_check_permissions' => 1)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php else: ?>&nbsp;<?php endif; ?></td>
	</tr>
<?php endif; ?>