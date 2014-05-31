<?php /* Smarty version 2.6.18, created on 2014-03-10 02:13:38
         compiled from views/products/components/products_update_qty_discounts.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_get_usergroups', 'views/products/components/products_update_qty_discounts.tpl', 16, false),array('modifier', 'escape', 'views/products/components/products_update_qty_discounts.tpl', 24, false),array('modifier', 'default', 'views/products/components/products_update_qty_discounts.tpl', 42, false),array('modifier', 'fn_get_default_usergroups', 'views/products/components/products_update_qty_discounts.tpl', 61, false),array('modifier', 'fn_get_usergroup_name', 'views/products/components/products_update_qty_discounts.tpl', 74, false),array('modifier', 'fn_url', 'views/products/components/products_update_qty_discounts.tpl', 103, false),array('function', 'math', 'views/products/components/products_update_qty_discounts.tpl', 110, false),array('function', 'cycle', 'views/products/components/products_update_qty_discounts.tpl', 111, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('quantity','value','type','qty_discount_type_tooltip','usergroup','absolute','percent','absolute','percent','all','update_for_all_hid_act','update_for_all_hid_dis','update_for_all_act','update_for_all_dis','clone_this_item','clone_this_item','delete','delete','absolute','percent','update_for_all_hid_act','update_for_all_hid_dis','update_for_all_act','update_for_all_dis'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'buttons/update_for_all.tpl' => 1367063753,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?>
<?php $this->assign('usergroups', fn_get_usergroups('C'), false); ?>

<div id="content_qty_discounts" class="hidden">
	<table cellpadding="0" cellspacing="0" border="0" class="table" width="100%">
	<tbody class="cm-first-sibling">
	<tr>
		<th><?php echo fn_get_lang_var('quantity', $this->getLanguage()); ?>
</th>
		<th><?php echo fn_get_lang_var('value', $this->getLanguage()); ?>
</th>
		<th><?php echo fn_get_lang_var('type', $this->getLanguage()); ?>
<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('tooltip' => fn_get_lang_var('qty_discount_type_tooltip', $this->getLanguage()), )); ?><?php if ($this->_tpl_vars['tooltip']): ?> (<a class="cm-tooltip<?php if ($this->_tpl_vars['params']): ?> <?php echo $this->_tpl_vars['params']; ?>
<?php endif; ?>" title="<?php echo smarty_modifier_escape($this->_tpl_vars['tooltip'], 'html'); ?>
">?</a>)<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></th>
		
		<th width="100%"><?php echo fn_get_lang_var('usergroup', $this->getLanguage()); ?>
</th>
		
		<th width="1%">&nbsp;</th>
	</tr>
	</tbody>
	<tbody>
	<?php $_from = $this->_tpl_vars['product_data']['prices']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['prod_prices'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['prod_prices']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['_key'] => $this->_tpl_vars['price']):
        $this->_foreach['prod_prices']['iteration']++;
?>
	<tr class="cm-row-item">
		<td class="<?php echo $this->_tpl_vars['no_hide_input_if_shared_product']; ?>
">
			<?php if ($this->_tpl_vars['price']['lower_limit'] == '1' && $this->_tpl_vars['price']['usergroup_id'] == '0'): ?>
				&nbsp;<?php echo $this->_tpl_vars['price']['lower_limit']; ?>

			<?php else: ?>
			<input type="text" name="product_data[prices][<?php echo $this->_tpl_vars['_key']; ?>
][lower_limit]" value="<?php echo $this->_tpl_vars['price']['lower_limit']; ?>
" class="input-text-short" />
			<?php endif; ?></td>
		<td class="<?php echo $this->_tpl_vars['no_hide_input_if_shared_product']; ?>
">
			<?php if ($this->_tpl_vars['price']['lower_limit'] == '1' && $this->_tpl_vars['price']['usergroup_id'] == '0'): ?>
				&nbsp;<?php if ($this->_tpl_vars['price']['percentage_discount'] == 0): ?><?php echo smarty_modifier_default(@$this->_tpl_vars['price']['price'], "0.00"); ?>
<?php else: ?><?php echo $this->_tpl_vars['price']['percentage_discount']; ?>
<?php endif; ?>
			<?php else: ?>
			<input type="text" name="product_data[prices][<?php echo $this->_tpl_vars['_key']; ?>
][price]" value="<?php if ($this->_tpl_vars['price']['percentage_discount'] == 0): ?><?php echo smarty_modifier_default(@$this->_tpl_vars['price']['price'], "0.00"); ?>
<?php else: ?><?php echo $this->_tpl_vars['price']['percentage_discount']; ?>
<?php endif; ?>" size="10" class="input-text-medium" />
			<?php endif; ?></td>
		<td class="<?php echo $this->_tpl_vars['no_hide_input_if_shared_product']; ?>
">
			<?php if ($this->_tpl_vars['price']['lower_limit'] == '1' && $this->_tpl_vars['price']['usergroup_id'] == '0'): ?>
				&nbsp;<?php if ($this->_tpl_vars['price']['percentage_discount'] == 0): ?><?php echo fn_get_lang_var('absolute', $this->getLanguage()); ?>
<?php else: ?><?php echo fn_get_lang_var('percent', $this->getLanguage()); ?>
<?php endif; ?>
			<?php else: ?>
			<select name="product_data[prices][<?php echo $this->_tpl_vars['_key']; ?>
][type]">
				<option value="A" <?php if ($this->_tpl_vars['price']['percentage_discount'] == 0): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('absolute', $this->getLanguage()); ?>
 (<?php echo $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']]['symbol']; ?>
)</option>
				<option value="P" <?php if ($this->_tpl_vars['price']['percentage_discount'] != 0): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('percent', $this->getLanguage()); ?>
 (%)</option>
			</select>
			<?php endif; ?></td>
		
		<td class="<?php echo $this->_tpl_vars['no_hide_input_if_shared_product']; ?>
">
			<?php if ($this->_tpl_vars['price']['lower_limit'] == '1' && $this->_tpl_vars['price']['usergroup_id'] == '0'): ?>
				&nbsp;<?php echo fn_get_lang_var('all', $this->getLanguage()); ?>

			<?php else: ?>
			<select id="usergroup_id" name="product_data[prices][<?php echo $this->_tpl_vars['_key']; ?>
][usergroup_id]" class="qty-discount-select">
				<?php $_from = fn_get_default_usergroups(""); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['usergroup']):
?>
					<?php if ($this->_tpl_vars['price']['usergroup_id'] != $this->_tpl_vars['usergroup']['usergroup_id']): ?>
						<option value="<?php echo $this->_tpl_vars['usergroup']['usergroup_id']; ?>
"><?php echo smarty_modifier_escape($this->_tpl_vars['usergroup']['usergroup']); ?>
</option>
					<?php else: ?>
												<?php $this->assign('default_usergroup_name', smarty_modifier_escape($this->_tpl_vars['usergroup']['usergroup']), false); ?>
					<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?>
				<?php $_from = $this->_tpl_vars['usergroups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['usergroup']):
?>
					<?php if ($this->_tpl_vars['price']['usergroup_id'] != $this->_tpl_vars['usergroup']['usergroup_id']): ?>
						<option value="<?php echo $this->_tpl_vars['usergroup']['usergroup_id']; ?>
"><?php echo smarty_modifier_escape($this->_tpl_vars['usergroup']['usergroup']); ?>
</option>
					<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?>
					<option value="<?php echo $this->_tpl_vars['price']['usergroup_id']; ?>
" selected="selected"><?php if ($this->_tpl_vars['default_usergroup_name']): ?><?php echo $this->_tpl_vars['default_usergroup_name']; ?>
<?php else: ?><?php echo fn_get_usergroup_name($this->_tpl_vars['price']['usergroup_id']); ?>
<?php endif; ?></option>
			</select>
			<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('display' => $this->_tpl_vars['show_update_for_all'], 'object_id' => "price_".($this->_tpl_vars['_key']), 'name' => "update_all_vendors[prices][".($this->_tpl_vars['_key'])."]", )); ?><?php if ($this->_tpl_vars['display']): ?>
	<?php if ($this->_tpl_vars['hide_element']): ?>
		<?php $this->assign('title_act', fn_get_lang_var('update_for_all_hid_act', $this->getLanguage()), false); ?>
		<?php $this->assign('title_dis', fn_get_lang_var('update_for_all_hid_dis', $this->getLanguage()), false); ?>
	<?php else: ?>
		<?php $this->assign('title_act', fn_get_lang_var('update_for_all_act', $this->getLanguage()), false); ?>
		<?php $this->assign('title_dis', fn_get_lang_var('update_for_all_dis', $this->getLanguage()), false); ?>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['settings']['Stores']['default_state_update_for_all'] == 'active'): ?>
		<?php $this->assign('title', $this->_tpl_vars['title_act'], false); ?>
		<?php $this->assign('visible', 'visible', false); ?>
	<?php else: ?>
		<?php $this->assign('title', $this->_tpl_vars['title_dis'], false); ?>
	<?php endif; ?>
	<a class="cm-update-for-all-icon <?php echo $this->_tpl_vars['visible']; ?>
" title="<?php echo $this->_tpl_vars['title']; ?>
" title_act="<?php echo $this->_tpl_vars['title_act']; ?>
" title_dis="<?php echo $this->_tpl_vars['title_dis']; ?>
" rev="<?php echo $this->_tpl_vars['object_id']; ?>
" <?php if ($this->_tpl_vars['hide_element']): ?>hide_element="<?php echo $this->_tpl_vars['hide_element']; ?>
"<?php endif; ?>></a>
	<input type="hidden" class="cm-no-hide-input" id="hidden_update_all_vendors_<?php echo $this->_tpl_vars['object_id']; ?>
" name="<?php echo $this->_tpl_vars['name']; ?>
" value="Y" <?php if ($this->_tpl_vars['settings']['Stores']['default_state_update_for_all'] == 'not_active'): ?>disabled="disabled"<?php endif; ?> />
<?php else: ?>
&nbsp;
<?php endif; ?> 
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
			<?php $this->assign('default_usergroup_name', "", false); ?>
			<?php endif; ?></td>
		
		<td class="nowrap <?php echo $this->_tpl_vars['no_hide_input_if_shared_product']; ?>
">
			<?php if ($this->_tpl_vars['price']['lower_limit'] == '1' && $this->_tpl_vars['price']['usergroup_id'] == '0'): ?>
			&nbsp;<?php else: ?>
			<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('microformats' => "cm-delete-row", 'no_confirm' => true, )); ?><?php if ($this->_tpl_vars['href_clone']): ?>
<a class="clone-item" href="<?php echo fn_url($this->_tpl_vars['href_clone']); ?>
"><img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/icon_clone.gif" width="13" height="18" border="0" alt="<?php echo smarty_modifier_escape(fn_get_lang_var('clone_this_item', $this->getLanguage()), 'html'); ?>
" title="<?php echo smarty_modifier_escape(fn_get_lang_var('clone_this_item', $this->getLanguage()), 'html'); ?>
" /></a>
<?php endif; ?>
<a class="delete-item <?php if (! $this->_tpl_vars['no_confirm']): ?>cm-confirm<?php endif; ?><?php if ($this->_tpl_vars['microformats']): ?> <?php echo $this->_tpl_vars['microformats']; ?>
<?php endif; ?>" <?php if ($this->_tpl_vars['href_delete']): ?>href="<?php echo fn_url($this->_tpl_vars['href_delete']); ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['rev_delete']): ?>rev="<?php echo $this->_tpl_vars['rev_delete']; ?>
"<?php endif; ?>><img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/icon_delete.gif" width="12" height="18" border="0" alt="<?php echo smarty_modifier_escape(fn_get_lang_var('delete', $this->getLanguage()), 'html'); ?>
" title="<?php echo smarty_modifier_escape(fn_get_lang_var('delete', $this->getLanguage()), 'html'); ?>
" /></a><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
			<?php endif; ?>
		</td>
	</tr>
	<?php endforeach; endif; unset($_from); ?>
	<?php echo smarty_function_math(array('equation' => "x+1",'x' => smarty_modifier_default(@$this->_tpl_vars['_key'], 0),'assign' => 'new_key'), $this);?>

	<tr class="<?php echo smarty_function_cycle(array('values' => "table-row , ",'reset' => 1), $this);?>
<?php echo $this->_tpl_vars['no_hide_input_if_shared_product']; ?>
" id="box_add_qty_discount">
		<td>
			<input type="text" name="product_data[prices][<?php echo $this->_tpl_vars['new_key']; ?>
][lower_limit]" value="" class="input-text-short" /></td>
		<td>
			<input type="text" name="product_data[prices][<?php echo $this->_tpl_vars['new_key']; ?>
][price]" value="0.00" size="10" class="input-text-medium" /></td>
		<td>
		<select name="product_data[prices][<?php echo $this->_tpl_vars['new_key']; ?>
][type]">
			<option value="A" selected="selected"><?php echo fn_get_lang_var('absolute', $this->getLanguage()); ?>
 (<?php echo $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']]['symbol']; ?>
)</option>
			<option value="P"><?php echo fn_get_lang_var('percent', $this->getLanguage()); ?>
 (%)</option>
		</select></td>
		
		<td>
			<select id="usergroup_id" name="product_data[prices][<?php echo $this->_tpl_vars['new_key']; ?>
][usergroup_id]" class="qty-discount-select">
				<?php $_from = fn_get_default_usergroups(""); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['usergroup']):
?>
					<option value="<?php echo $this->_tpl_vars['usergroup']['usergroup_id']; ?>
"><?php echo smarty_modifier_escape($this->_tpl_vars['usergroup']['usergroup']); ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
				<?php $_from = $this->_tpl_vars['usergroups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['usergroup']):
?>
					<option value="<?php echo $this->_tpl_vars['usergroup']['usergroup_id']; ?>
"><?php echo smarty_modifier_escape($this->_tpl_vars['usergroup']['usergroup']); ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			</select>
			<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('display' => $this->_tpl_vars['show_update_for_all'], 'object_id' => "price_".($this->_tpl_vars['new_key']), 'name' => "update_all_vendors[prices][".($this->_tpl_vars['new_key'])."]", )); ?><?php if ($this->_tpl_vars['display']): ?>
	<?php if ($this->_tpl_vars['hide_element']): ?>
		<?php $this->assign('title_act', fn_get_lang_var('update_for_all_hid_act', $this->getLanguage()), false); ?>
		<?php $this->assign('title_dis', fn_get_lang_var('update_for_all_hid_dis', $this->getLanguage()), false); ?>
	<?php else: ?>
		<?php $this->assign('title_act', fn_get_lang_var('update_for_all_act', $this->getLanguage()), false); ?>
		<?php $this->assign('title_dis', fn_get_lang_var('update_for_all_dis', $this->getLanguage()), false); ?>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['settings']['Stores']['default_state_update_for_all'] == 'active'): ?>
		<?php $this->assign('title', $this->_tpl_vars['title_act'], false); ?>
		<?php $this->assign('visible', 'visible', false); ?>
	<?php else: ?>
		<?php $this->assign('title', $this->_tpl_vars['title_dis'], false); ?>
	<?php endif; ?>
	<a class="cm-update-for-all-icon <?php echo $this->_tpl_vars['visible']; ?>
" title="<?php echo $this->_tpl_vars['title']; ?>
" title_act="<?php echo $this->_tpl_vars['title_act']; ?>
" title_dis="<?php echo $this->_tpl_vars['title_dis']; ?>
" rev="<?php echo $this->_tpl_vars['object_id']; ?>
" <?php if ($this->_tpl_vars['hide_element']): ?>hide_element="<?php echo $this->_tpl_vars['hide_element']; ?>
"<?php endif; ?>></a>
	<input type="hidden" class="cm-no-hide-input" id="hidden_update_all_vendors_<?php echo $this->_tpl_vars['object_id']; ?>
" name="<?php echo $this->_tpl_vars['name']; ?>
" value="Y" <?php if ($this->_tpl_vars['settings']['Stores']['default_state_update_for_all'] == 'not_active'): ?>disabled="disabled"<?php endif; ?> />
<?php else: ?>
&nbsp;
<?php endif; ?> 
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
		</td>
		
		<td class="right">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/multiple_buttons.tpl", 'smarty_include_vars' => array('item_id' => 'add_qty_discount')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</td>
	</tr>
	</tbody>
	</table>

</div>