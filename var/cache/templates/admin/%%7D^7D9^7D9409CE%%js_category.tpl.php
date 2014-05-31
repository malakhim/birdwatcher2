<?php /* Smarty version 2.6.18, created on 2014-03-10 02:22:37
         compiled from pickers/js_category.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_get_category_data', 'pickers/js_category.tpl', 16, false),array('modifier', 'default', 'pickers/js_category.tpl', 17, false),array('modifier', 'defined', 'pickers/js_category.tpl', 18, false),array('modifier', 'fn_url', 'pickers/js_category.tpl', 30, false),array('modifier', 'escape', 'pickers/js_category.tpl', 30, false),array('modifier', 'fn_get_company_name', 'pickers/js_category.tpl', 39, false),array('function', 'math', 'pickers/js_category.tpl', 29, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('vendor','supplier','delete','remove','vendor','supplier','remove','remove'));
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
			 ?><?php if ($this->_tpl_vars['category_id']): ?>
	<?php $this->assign('category_data', fn_get_category_data($this->_tpl_vars['category_id'], @CART_LANGUAGE, '', false, true), false); ?>
	<?php $this->assign('category', smarty_modifier_default(@$this->_tpl_vars['category_data']['category'], ($this->_tpl_vars['ldelim'])."category".($this->_tpl_vars['rdelim'])), false); ?>
	<?php if (defined('COMPANY_ID') && ( $this->_tpl_vars['owner_company_id'] && $this->_tpl_vars['owner_company_id'] != @COMPANY_ID && $this->_tpl_vars['category_data']['company_id'] != @COMPANY_ID || $this->_tpl_vars['category_data']['company_id'] != @COMPANY_ID )): ?>
	    <?php $this->assign('show_only_name', true, false); ?>
	<?php endif; ?>
	<?php if (defined('COMPANY_ID') && $this->_tpl_vars['owner_company_id'] && $this->_tpl_vars['owner_company_id'] != @COMPANY_ID): ?>
		<?php $this->assign('hide_delete_button', true, false); ?>
	<?php endif; ?>
<?php else: ?>
	<?php $this->assign('category', $this->_tpl_vars['default_name'], false); ?>
<?php endif; ?>
<?php if ($this->_tpl_vars['multiple']): ?>
	<tr <?php if (! $this->_tpl_vars['clone']): ?>id="<?php echo $this->_tpl_vars['holder']; ?>
_<?php echo $this->_tpl_vars['category_id']; ?>
" <?php endif; ?>class="cm-js-item <?php if ($this->_tpl_vars['clone']): ?> cm-clone hidden<?php endif; ?>">
		<?php if ($this->_tpl_vars['position_field']): ?><td><input type="text" name="<?php echo $this->_tpl_vars['input_name']; ?>
[<?php echo $this->_tpl_vars['category_id']; ?>
]" value="<?php echo smarty_function_math(array('equation' => "a*b",'a' => $this->_tpl_vars['position'],'b' => 10), $this);?>
" size="3" class="input-text-short"<?php if ($this->_tpl_vars['clone']): ?> disabled="disabled"<?php endif; ?> /></td><?php endif; ?>
		<td><?php if (! $this->_tpl_vars['show_only_name']): ?><a href="<?php echo fn_url("categories.update?category_id=".($this->_tpl_vars['category_id'])); ?>
"><?php echo smarty_modifier_escape($this->_tpl_vars['category']); ?>
</a><?php else: ?><?php echo smarty_modifier_escape($this->_tpl_vars['category']); ?>
 <?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('company_id' => $this->_tpl_vars['category_data']['company_id'], )); ?><?php if (@PRODUCT_TYPE == 'MULTIVENDOR' || @PRODUCT_TYPE == 'ULTIMATE'): ?>
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
		<td class="nowrap">
		<?php if (! $this->_tpl_vars['view_only']): ?>
		<?php ob_start(); ?>
			<?php if (! $this->_tpl_vars['hide_delete_button']): ?>
			<li><a onclick="$.delete_js_item('<?php echo $this->_tpl_vars['holder']; ?>
', '<?php echo $this->_tpl_vars['category_id']; ?>
', 'c'); return false;"><?php echo fn_get_lang_var('delete', $this->getLanguage()); ?>
</a></li>
			<?php endif; ?>
			<?php $this->_smarty_vars['capture']['tools_items'] = ob_get_contents(); ob_end_clean(); ?>
			<?php if ($this->_tpl_vars['show_only_name']): ?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/table_tools_list.tpl", 'smarty_include_vars' => array('prefix' => $this->_tpl_vars['category_id'],'tools_list' => $this->_smarty_vars['capture']['tools_items'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php else: ?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/table_tools_list.tpl", 'smarty_include_vars' => array('prefix' => $this->_tpl_vars['category_id'],'tools_list' => $this->_smarty_vars['capture']['tools_items'],'href' => "categories.update?category_id=".($this->_tpl_vars['category_id']))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php endif; ?>
		<?php else: ?>&nbsp;
		<?php endif; ?>
		</td>
	</tr>
<?php else: ?>
	<?php if ($this->_tpl_vars['view_mode'] != 'list'): ?>
		<<?php if ($this->_tpl_vars['single_line']): ?>span<?php else: ?>p<?php endif; ?> <?php if (! $this->_tpl_vars['clone']): ?>id="<?php echo $this->_tpl_vars['holder']; ?>
_<?php echo $this->_tpl_vars['category_id']; ?>
" <?php endif; ?>class="cm-js-item no-margin<?php if ($this->_tpl_vars['clone']): ?> cm-clone hidden<?php endif; ?>">
		<?php if (! $this->_tpl_vars['first_item'] && $this->_tpl_vars['single_line']): ?><span class="cm-comma<?php if ($this->_tpl_vars['clone']): ?> hidden<?php endif; ?>">,&nbsp;&nbsp;</span><?php endif; ?>
		<input class="input-text-medium cm-picker-value-description float-left<?php echo $this->_tpl_vars['extra_class']; ?>
" type="text" value="<?php echo smarty_modifier_escape($this->_tpl_vars['category']); ?>
" <?php if ($this->_tpl_vars['display_input_id']): ?>id="<?php echo $this->_tpl_vars['display_input_id']; ?>
"<?php endif; ?> size="10" name="category_name" readonly="readonly" <?php echo $this->_tpl_vars['extra']; ?>
 />
		</<?php if ($this->_tpl_vars['single_line']): ?>span<?php else: ?>p<?php endif; ?>>
	<?php else: ?>
		<?php $this->assign('default_category', ($this->_tpl_vars['ldelim'])."category".($this->_tpl_vars['rdelim']), false); ?>
		<?php $this->assign('default_category_id', ($this->_tpl_vars['ldelim'])."category_id".($this->_tpl_vars['rdelim']), false); ?>
		<?php if ($this->_tpl_vars['first_item'] || ! $this->_tpl_vars['category_id']): ?><p class="cm-js-item cm-clone hidden margin-top-clear"><?php if ($this->_tpl_vars['hide_input'] != 'Y'): ?><input class="radio" id="category_rb_<?php echo $this->_tpl_vars['default_category_id']; ?>
" type="radio" name="<?php echo $this->_tpl_vars['radio_input_name']; ?>
" value="<?php echo $this->_tpl_vars['default_category_id']; ?>
"><?php endif; ?><label for="category_rb_<?php echo $this->_tpl_vars['default_category_id']; ?>
"><?php echo $this->_tpl_vars['default_category']; ?>
</label> <a onclick="$.delete_js_item('<?php echo $this->_tpl_vars['holder']; ?>
', '<?php echo $this->_tpl_vars['default_category_id']; ?>
', 'c'); return false;"><img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/delete_icon.gif" width="12" height="11" border="0" alt="<?php echo fn_get_lang_var('remove', $this->getLanguage()); ?>
" align="bottom" /></a></p><?php endif; ?>
		<?php if ($this->_tpl_vars['category_id']): ?><p class="cm-js-item categories-list-item <?php echo $this->_tpl_vars['extra_class']; ?>
" id="<?php echo $this->_tpl_vars['holder']; ?>
_<?php echo $this->_tpl_vars['category_id']; ?>
" <?php echo $this->_tpl_vars['extra']; ?>
><?php if ($this->_tpl_vars['hide_input'] != 'Y'): ?><input class="radio" id="category_radio_button_<?php echo $this->_tpl_vars['category_id']; ?>
"<?php if ($this->_tpl_vars['main_category'] == $this->_tpl_vars['category_id']): ?>checked<?php endif; ?> type="radio" name="<?php echo $this->_tpl_vars['radio_input_name']; ?>
" value="<?php echo $this->_tpl_vars['category_id']; ?>
" /><?php endif; ?><?php if ($this->_tpl_vars['category_data']['company_id']): ?><span class="categories-store-name"><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('company_name' => $this->_tpl_vars['category_data']['company_name'], 'company_id' => $this->_tpl_vars['category_data']['company_id'], )); ?><?php if (@PRODUCT_TYPE == 'MULTIVENDOR' || @PRODUCT_TYPE == 'ULTIMATE'): ?>
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
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></span><?php endif; ?><label for="category_radio_button_<?php echo $this->_tpl_vars['category_id']; ?>
"><?php echo smarty_modifier_escape($this->_tpl_vars['category']); ?>
</label><?php if (! defined('COMPANY_ID') || ( defined('COMPANY_ID') && ( $this->_tpl_vars['category_data']['company_id'] == @COMPANY_ID || @COMPANY_ID == $this->_tpl_vars['owner_company_id'] ) )): ?><a onclick="$.delete_js_item('<?php echo $this->_tpl_vars['holder']; ?>
', '<?php echo $this->_tpl_vars['category_id']; ?>
', 'c'); return false;" class="icon-delete-small"><img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/delete_icon.gif" width="12" height="11" border="0" alt="<?php echo fn_get_lang_var('remove', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('remove', $this->getLanguage()); ?>
" align="bottom" /></a><?php endif; ?></p><?php endif; ?>
	<?php endif; ?>
<?php endif; ?>