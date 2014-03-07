<?php /* Smarty version 2.6.18, created on 2014-03-07 22:31:26
         compiled from pickers/products_picker.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_get_product_name', 'pickers/products_picker.tpl', 1, false),array('modifier', 'default', 'pickers/products_picker.tpl', 1, false),array('modifier', 'count', 'pickers/products_picker.tpl', 1, false),array('modifier', 'fn_get_selected_product_options_info', 'pickers/products_picker.tpl', 1, false),array('modifier', 'fn_url', 'pickers/products_picker.tpl', 1, false),array('modifier', 'is_array', 'pickers/products_picker.tpl', 21, false),array('modifier', 'explode', 'pickers/products_picker.tpl', 22, false),array('modifier', 'implode', 'pickers/products_picker.tpl', 33, false),array('modifier', 'fn_get_product_options', 'pickers/products_picker.tpl', 110, false),array('modifier', 'escape', 'pickers/products_picker.tpl', 146, false),array('modifier', 'fn_check_view_permissions', 'pickers/products_picker.tpl', 173, false),array('function', 'math', 'pickers/products_picker.tpl', 15, false),array('function', 'script', 'pickers/products_picker.tpl', 19, false),array('block', 'hook', 'pickers/products_picker.tpl', 69, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('add_product','position_short','name','deleted_product','no_items','editing_defined_products','defined_items','name','quantity','price','discount','value','discounted_price','to_fixed','options','any_option_combinations','deleted_product','no_items','add_products','remove_this_item','remove_this_item','add_products'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'buttons/button.tpl' => 1367063752,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php echo smarty_function_math(array('equation' => "rand()",'assign' => 'rnd'), $this);?>

<?php $this->assign('data_id', ($this->_tpl_vars['data_id'])."_".($this->_tpl_vars['rnd']), false); ?>
<?php $this->assign('view_mode', smarty_modifier_default(@$this->_tpl_vars['view_mode'], 'mixed'), false); ?>
<?php $this->assign('start_pos', smarty_modifier_default(@$this->_tpl_vars['start_pos'], 0), false); ?>
<?php echo smarty_function_script(array('src' => "js/picker.js"), $this);?>


<?php if ($this->_tpl_vars['item_ids'] && ! is_array($this->_tpl_vars['item_ids']) && $this->_tpl_vars['type'] != 'table'): ?>
		<?php $this->assign('item_ids', explode(",", $this->_tpl_vars['item_ids']), false); ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['view_mode'] != 'list'): ?>
	<div class="button-container">
		<a rev="opener_picker_<?php echo $this->_tpl_vars['data_id']; ?>
" class="cm-external-click text-button text-button-add"><?php echo fn_get_lang_var('add_product', $this->getLanguage()); ?>
</a>
	</div>
<?php endif; ?>

<?php if ($this->_tpl_vars['view_mode'] != 'button'): ?>
<?php if ($this->_tpl_vars['type'] == 'links'): ?>
	<input type="hidden" id="p<?php echo $this->_tpl_vars['data_id']; ?>
_ids" name="<?php echo $this->_tpl_vars['input_name']; ?>
" value="<?php if ($this->_tpl_vars['item_ids']): ?><?php echo implode(",", $this->_tpl_vars['item_ids']); ?>
<?php endif; ?>" />
	<?php ob_start(); ?>
	<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
	<tr>
		<?php if ($this->_tpl_vars['positions']): ?><th><?php echo fn_get_lang_var('position_short', $this->getLanguage()); ?>
</th><?php endif; ?>
		<th width="100%"><?php echo fn_get_lang_var('name', $this->getLanguage()); ?>
</th>
		<th>&nbsp;</th>
		<th>&nbsp;</th>
	</tr>
	<tbody id="<?php echo $this->_tpl_vars['data_id']; ?>
"<?php if (! $this->_tpl_vars['item_ids']): ?> class="hidden"<?php endif; ?>>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "pickers/js_product.tpl", 'smarty_include_vars' => array('clone' => true,'product' => ($this->_tpl_vars['ldelim'])."product".($this->_tpl_vars['rdelim']),'root_id' => $this->_tpl_vars['data_id'],'delete_id' => ($this->_tpl_vars['ldelim'])."delete_id".($this->_tpl_vars['rdelim']),'type' => 'product','position_field' => $this->_tpl_vars['positions'],'position' => '0')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php if ($this->_tpl_vars['item_ids']): ?>
	<?php $_from = $this->_tpl_vars['item_ids']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['items'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['items']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['product']):
        $this->_foreach['items']['iteration']++;
?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "pickers/js_product.tpl", 'smarty_include_vars' => array('product_id' => $this->_tpl_vars['product'],'product' => smarty_modifier_default(fn_get_product_name($this->_tpl_vars['product']), fn_get_lang_var('deleted_product', $this->getLanguage())),'root_id' => $this->_tpl_vars['data_id'],'delete_id' => $this->_tpl_vars['product'],'type' => 'product','first_item' => ($this->_foreach['items']['iteration'] <= 1),'position_field' => $this->_tpl_vars['positions'],'position' => $this->_foreach['items']['iteration']+$this->_tpl_vars['start_pos'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endforeach; endif; unset($_from); ?>
	<?php endif; ?>
	</tbody>
	<tbody id="<?php echo $this->_tpl_vars['data_id']; ?>
_no_item"<?php if ($this->_tpl_vars['item_ids']): ?> class="hidden"<?php endif; ?>>
	<tr class="no-items">
		<td colspan="<?php if ($this->_tpl_vars['positions']): ?>4<?php else: ?>3<?php endif; ?>"><p><?php echo smarty_modifier_default(@$this->_tpl_vars['no_item_text'], fn_get_lang_var('no_items', $this->getLanguage())); ?>
</p></td>
	</tr>
	</tbody>
	</table>
	<?php $this->_smarty_vars['capture']['products_list'] = ob_get_contents(); ob_end_clean(); ?>
	<?php if ($this->_tpl_vars['picker_view']): ?>
		<div class="defined-items">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => "inner_".($this->_tpl_vars['data_id']),'link_text' => count($this->_tpl_vars['item_ids']),'act' => 'edit','content' => $this->_smarty_vars['capture']['products_list'],'text' => (fn_get_lang_var('editing_defined_products', $this->getLanguage())).":",'link_class' => "text-button-edit",'picker_meta' => "cm-bg-close",'method' => 'GET')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php echo fn_get_lang_var('defined_items', $this->getLanguage()); ?>

		</div>
	<?php else: ?>
		<?php echo $this->_smarty_vars['capture']['products_list']; ?>

	<?php endif; ?>
<?php elseif ($this->_tpl_vars['type'] == 'table'): ?>
	<table class="table" width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<th width="80%"><?php echo fn_get_lang_var('name', $this->getLanguage()); ?>
</th>
		<th><?php echo fn_get_lang_var('quantity', $this->getLanguage()); ?>
</th>
		<?php $this->_tag_stack[] = array('hook', array('name' => "product_picker:table_header")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		<?php if ($this->_tpl_vars['addons']['bundled_products']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><?php if ($this->_tpl_vars['controller'] == 'bundled_products' || $this->_tpl_vars['extra_mode'] == 'bundled_products'): ?>
	<th><?php echo fn_get_lang_var('price', $this->getLanguage()); ?>
</th>
	<th><?php echo fn_get_lang_var('discount', $this->getLanguage()); ?>
</th>
	<th><?php echo fn_get_lang_var('value', $this->getLanguage()); ?>
</th>
	<th><?php echo fn_get_lang_var('discounted_price', $this->getLanguage()); ?>
</th>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		<th>&nbsp;</th>
	</tr>
	<tbody id="<?php echo $this->_tpl_vars['data_id']; ?>
" class="<?php if (! $this->_tpl_vars['item_ids']): ?>hidden<?php endif; ?> cm-picker-options">
	<?php $this->_tag_stack[] = array('hook', array('name' => "product_picker:table_rows")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if ($this->_tpl_vars['addons']['bundled_products']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><?php if ($this->_tpl_vars['controller'] == 'bundled_products' || $this->_tpl_vars['extra_mode'] == 'bundled_products'): ?>

<?php if ($this->_tpl_vars['product_data']['min_qty'] == 0 || $this->_tpl_vars['item']['min_qty'] == 0): ?>
	<?php $this->assign('min_qty', '1', false); ?>
<?php else: ?>
	<?php $this->assign('min_qty', smarty_modifier_default(@$this->_tpl_vars['product_data']['min_qty'], @$this->_tpl_vars['item']['min_qty']), false); ?>
<?php endif; ?>

<tr>
	<td><?php echo smarty_modifier_default(@$this->_tpl_vars['item']['product_name'], @$this->_tpl_vars['product_data']['product']); ?>
</td>
	<td><?php echo $this->_tpl_vars['min_qty']; ?>
</td>
	<td>
		<input type="hidden" id="item_price_bp_<?php echo $this->_tpl_vars['item']['chain_id']; ?>
_<?php echo $this->_tpl_vars['item']['chain_id']; ?>
" value="<?php echo smarty_modifier_default(smarty_modifier_default(@$this->_tpl_vars['item']['price'], @$this->_tpl_vars['product_data']['price']), '0'); ?>
" />
		<input type="hidden" name="item_data_bp_[amount]" id="item_amount_bp_<?php echo $this->_tpl_vars['item']['chain_id']; ?>
" value="<?php echo $this->_tpl_vars['min_qty']; ?>
" />
	</td>
	<td>
		<select id="item_modifier_type_bp_<?php echo $this->_tpl_vars['item']['chain_id']; ?>
_<?php echo $this->_tpl_vars['item']['chain_id']; ?>
" name="item_data[modifier_type]" class="hidden">
			<option value="to_fixed" <?php if ($this->_tpl_vars['item']['modifier_type'] == 'to_fixed'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('to_fixed', $this->getLanguage()); ?>
</option>
		</select>
	</td>
	<td>
		<input type="hidden" class="cm-chain-<?php echo $this->_tpl_vars['item']['chain_id']; ?>
" value="<?php echo $this->_tpl_vars['item']['chain_id']; ?>
" />
		<input type="hidden" name="item_data[modifier]" id="item_modifier_bp_<?php echo $this->_tpl_vars['item']['chain_id']; ?>
_<?php echo $this->_tpl_vars['item']['chain_id']; ?>
" size="4" value="0" class="input-text" />
	</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?>
	<?php if ($this->_tpl_vars['item_ids']): ?>
	<?php $_from = $this->_tpl_vars['item_ids']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['product_id'] => $this->_tpl_vars['product']):
?>
		<?php ob_start(); ?>
			<?php $this->assign('prod_opts', fn_get_product_options($this->_tpl_vars['product']['product_id']), false); ?>
			<?php if ($this->_tpl_vars['prod_opts'] && ! $this->_tpl_vars['product']['product_options']): ?>
				<span><?php echo fn_get_lang_var('options', $this->getLanguage()); ?>
: </span>&nbsp;<?php echo fn_get_lang_var('any_option_combinations', $this->getLanguage()); ?>

			<?php elseif ($this->_tpl_vars['product']['product_options']): ?>
				<?php if ($this->_tpl_vars['product']['product_options_value']): ?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/options_info.tpl", 'smarty_include_vars' => array('product_options' => $this->_tpl_vars['product']['product_options_value'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php else: ?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/options_info.tpl", 'smarty_include_vars' => array('product_options' => fn_get_selected_product_options_info($this->_tpl_vars['product']['product_options']))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php endif; ?>
			<?php endif; ?>
		<?php $this->_smarty_vars['capture']['product_options'] = ob_get_contents(); ob_end_clean(); ?>
		<?php if ($this->_tpl_vars['product']['product']): ?>
			<?php $this->assign('product_name', $this->_tpl_vars['product']['product'], false); ?>
		<?php else: ?>
			<?php $this->assign('product_name', smarty_modifier_default(fn_get_product_name($this->_tpl_vars['product']['product_id']), fn_get_lang_var('deleted_product', $this->getLanguage())), false); ?>
		<?php endif; ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "pickers/js_product.tpl", 'smarty_include_vars' => array('product' => $this->_tpl_vars['product_name'],'root_id' => $this->_tpl_vars['data_id'],'delete_id' => $this->_tpl_vars['product_id'],'input_name' => ($this->_tpl_vars['input_name'])."[".($this->_tpl_vars['product_id'])."]",'amount' => $this->_tpl_vars['product']['amount'],'amount_input' => 'text','type' => 'options','options' => $this->_smarty_vars['capture']['product_options'],'options_array' => $this->_tpl_vars['product']['product_options'],'product_id' => $this->_tpl_vars['product']['product_id'],'product_info' => $this->_tpl_vars['product'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endforeach; endif; unset($_from); ?>
	<?php endif; ?>
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "pickers/js_product.tpl", 'smarty_include_vars' => array('clone' => true,'product' => ($this->_tpl_vars['ldelim'])."product".($this->_tpl_vars['rdelim']),'root_id' => $this->_tpl_vars['data_id'],'delete_id' => ($this->_tpl_vars['ldelim'])."delete_id".($this->_tpl_vars['rdelim']),'input_name' => ($this->_tpl_vars['input_name'])."[".($this->_tpl_vars['ldelim'])."product_id".($this->_tpl_vars['rdelim'])."]",'amount' => '1','amount_input' => 'text','type' => 'options','options' => ($this->_tpl_vars['ldelim'])."options".($this->_tpl_vars['rdelim']),'product_id' => "")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</tbody>
	<tbody id="<?php echo $this->_tpl_vars['data_id']; ?>
_no_item"<?php if ($this->_tpl_vars['item_ids']): ?> class="hidden"<?php endif; ?>>
	<tr class="no-items">
		<td colspan="<?php echo smarty_modifier_default(@$this->_tpl_vars['colspan'], '3'); ?>
"><p><?php echo smarty_modifier_default(@$this->_tpl_vars['no_item_text'], fn_get_lang_var('no_items', $this->getLanguage())); ?>
</p></td>
	</tr>
	</tbody>
	</table>
	<?php if (! $this->_tpl_vars['display']): ?>
		<?php $this->assign('display', 'options', false); ?>
	<?php endif; ?>
<?php endif; ?>
<?php endif; ?>
<?php if ($this->_tpl_vars['view_mode'] != 'list'): ?>
	<div class="hidden">
		<?php if ($this->_tpl_vars['extra_var']): ?>
			<?php $this->assign('extra_var', smarty_modifier_escape($this->_tpl_vars['extra_var'], 'url'), false); ?>
		<?php endif; ?>
		<?php if (! $this->_tpl_vars['no_container']): ?><div class="buttons-container"><?php endif; ?><?php if ($this->_tpl_vars['picker_view']): ?>[<?php endif; ?>
			<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('but_id' => "opener_picker_".($this->_tpl_vars['data_id']), 'but_href' => fn_url("products.picker?display=".($this->_tpl_vars['display'])."&amp;company_id=".($this->_tpl_vars['company_id'])."&amp;company_ids=".($this->_tpl_vars['company_ids'])."&amp;picker_for=".($this->_tpl_vars['picker_for'])."&amp;extra=".($this->_tpl_vars['extra_var'])."&amp;checkbox_name=".($this->_tpl_vars['checkbox_name'])."&amp;aoc=".($this->_tpl_vars['aoc'])."&amp;data_id=".($this->_tpl_vars['data_id'])), 'but_text' => smarty_modifier_default(@$this->_tpl_vars['but_text'], fn_get_lang_var('add_products', $this->getLanguage())), 'but_role' => 'add', 'but_rev' => "content_".($this->_tpl_vars['data_id']), 'but_meta' => "cm-dialog-opener", )); ?><?php if ($this->_tpl_vars['but_role'] == 'text'): ?>
	<?php $this->assign('class', "text-link", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'delete'): ?>
	<?php $this->assign('class', "text-button-delete", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'add'): ?>
	<?php $this->assign('class', "text-button text-button-add", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'reload'): ?>
	<?php $this->assign('class', "text-button text-button-reload", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'delete_item'): ?>
	<?php $this->assign('class', "text-button-delete-item", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'edit'): ?>
	<?php $this->assign('class', "text-button-edit", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'tool'): ?>
	<?php $this->assign('class', "tool-link", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'link'): ?>
	<?php $this->assign('class', "text-button-link", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'simple'): ?>
	<?php $this->assign('class', "text-button-simple", false); ?>
<?php else: ?>
	<?php $this->assign('class', "", false); ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['but_name']): ?><?php $this->assign('r', $this->_tpl_vars['but_name'], false); ?><?php else: ?><?php $this->assign('r', $this->_tpl_vars['but_href'], false); ?><?php endif; ?>
<?php $this->assign('method', smarty_modifier_default(@$this->_tpl_vars['method'], 'POST'), false); ?>
<?php if (fn_check_view_permissions($this->_tpl_vars['r'], $this->_tpl_vars['method'])): ?>

<?php if ($this->_tpl_vars['but_name'] || $this->_tpl_vars['but_role'] == 'submit' || $this->_tpl_vars['but_role'] == 'button_main' || $this->_tpl_vars['but_type'] || $this->_tpl_vars['but_role'] == 'big'): ?> 
	<span <?php if ($this->_tpl_vars['but_css']): ?>style="<?php echo $this->_tpl_vars['but_css']; ?>
"<?php endif; ?> class="submit-button<?php if ($this->_tpl_vars['but_role'] == 'big'): ?>-big<?php endif; ?><?php if ($this->_tpl_vars['but_role'] == 'button_main'): ?> cm-button-main<?php endif; ?> <?php echo $this->_tpl_vars['but_meta']; ?>
"><input <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_meta']): ?>class="<?php echo $this->_tpl_vars['but_meta']; ?>
"<?php endif; ?> type="<?php echo smarty_modifier_default(@$this->_tpl_vars['but_type'], 'submit'); ?>
"<?php if ($this->_tpl_vars['but_name']): ?> name="<?php echo $this->_tpl_vars['but_name']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_onclick']): ?> onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
;<?php if (! $this->_tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> value="<?php echo $this->_tpl_vars['but_text']; ?>
" <?php if ($this->_tpl_vars['tabindex']): ?>tabindex="<?php echo $this->_tpl_vars['tabindex']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_disabled']): ?>disabled="disabled"<?php endif; ?> /></span>

<?php elseif ($this->_tpl_vars['but_role'] && $this->_tpl_vars['but_role'] != 'submit' && $this->_tpl_vars['but_role'] != 'action' && $this->_tpl_vars['but_role'] != "advanced-search" && $this->_tpl_vars['but_role'] != 'button'): ?> 
	<a <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_href']): ?> href="<?php echo fn_url($this->_tpl_vars['but_href']); ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_onclick']): ?> onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
;<?php if (! $this->_tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?><?php if ($this->_tpl_vars['but_target']): ?> target="<?php echo $this->_tpl_vars['but_target']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?> class="<?php echo $this->_tpl_vars['class']; ?>
<?php if ($this->_tpl_vars['but_meta']): ?> <?php echo $this->_tpl_vars['but_meta']; ?>
<?php endif; ?>"><?php if ($this->_tpl_vars['but_role'] == 'delete_item'): ?><img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/icon_delete.gif" width="12" height="18" border="0" alt="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" class="valign" /><?php else: ?><?php echo $this->_tpl_vars['but_text']; ?>
<?php endif; ?></a>

<?php elseif ($this->_tpl_vars['but_role'] == 'action' || $this->_tpl_vars['but_role'] == "advanced-search"): ?> 
	<a <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_href']): ?> href="<?php echo fn_url($this->_tpl_vars['but_href']); ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_onclick']): ?>onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
;<?php if (! $this->_tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> <?php if ($this->_tpl_vars['but_target']): ?>target="<?php echo $this->_tpl_vars['but_target']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?> class="button<?php if ($this->_tpl_vars['but_meta']): ?> <?php echo $this->_tpl_vars['but_meta']; ?>
<?php endif; ?>"><?php echo $this->_tpl_vars['but_text']; ?>
<?php if ($this->_tpl_vars['but_role'] == 'action'): ?>&nbsp;<img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/but_arrow.gif" width="8" height="7" border="0" alt=""/><?php endif; ?></a>
	
<?php elseif ($this->_tpl_vars['but_role'] == 'button'): ?>
	<input <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_meta']): ?>class="<?php echo $this->_tpl_vars['but_meta']; ?>
"<?php endif; ?> type="button" <?php if ($this->_tpl_vars['but_onclick']): ?>onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
;<?php if (! $this->_tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> value="<?php echo $this->_tpl_vars['but_text']; ?>
" <?php if ($this->_tpl_vars['tabindex']): ?>tabindex="<?php echo $this->_tpl_vars['tabindex']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?> />

<?php elseif ($this->_tpl_vars['but_role'] == 'icon'): ?> 
	<a <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_href']): ?> href="<?php echo fn_url($this->_tpl_vars['but_href']); ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_onclick']): ?>onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
;<?php if (! $this->_tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> <?php if ($this->_tpl_vars['but_target']): ?>target="<?php echo $this->_tpl_vars['but_target']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?> class="<?php if ($this->_tpl_vars['but_meta']): ?> <?php echo $this->_tpl_vars['but_meta']; ?>
<?php endif; ?>"><?php echo $this->_tpl_vars['but_text']; ?>
</a>

<?php elseif (! $this->_tpl_vars['but_role']): ?> 
	<input <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?> class="default-button<?php if ($this->_tpl_vars['but_meta']): ?> <?php echo $this->_tpl_vars['but_meta']; ?>
<?php endif; ?>" type="submit" onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
;<?php if (! $this->_tpl_vars['allow_href']): ?> return false;<?php endif; ?>" value="<?php echo $this->_tpl_vars['but_text']; ?>
" <?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?> />
<?php endif; ?>

<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
		<?php if ($this->_tpl_vars['picker_view']): ?>]<?php endif; ?><?php if (! $this->_tpl_vars['no_container']): ?></div><?php endif; ?>
		<div class="hidden" id="content_<?php echo $this->_tpl_vars['data_id']; ?>
" title="<?php echo smarty_modifier_default(@$this->_tpl_vars['but_text'], fn_get_lang_var('add_products', $this->getLanguage())); ?>
">
		</div>
	</div>
<?php endif; ?>