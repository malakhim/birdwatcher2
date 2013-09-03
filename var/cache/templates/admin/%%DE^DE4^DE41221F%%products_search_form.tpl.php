<?php /* Smarty version 2.6.18, created on 2013-09-03 09:46:49
         compiled from views/products/components/products_search_form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_url', 'views/products/components/products_search_form.tpl', 19, false),array('modifier', 'default', 'views/products/components/products_search_form.tpl', 20, false),array('modifier', 'fn_show_picker', 'views/products/components/products_search_form.tpl', 62, false),array('modifier', 'fn_get_plain_categories_tree', 'views/products/components/products_search_form.tpl', 77, false),array('modifier', 'escape', 'views/products/components/products_search_form.tpl', 85, false),array('modifier', 'truncate', 'views/products/components/products_search_form.tpl', 85, false),array('modifier', 'indent', 'views/products/components/products_search_form.tpl', 85, false),array('modifier', 'defined', 'views/products/components/products_search_form.tpl', 159, false),array('modifier', 'fn_string_not_empty', 'views/products/components/products_search_form.tpl', 173, false),array('block', 'hook', 'views/products/components/products_search_form.tpl', 104, false),array('function', 'math', 'views/products/components/products_search_form.tpl', 267, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('find_results_with','search','search','any_words','all_words','exact_phrase','price','search_in_category','all_categories','all_categories','search_in','product_name','short_description','subcategories','full_description','keywords','search_by_product_filters','search_by_product_features','search_by_sku','tag','configurable','yes','no','shipping_freight','weight','quantity','free_shipping','yes','no','status','active','hidden','disabled','popularity','ttc_popularity','purchased_in_orders','no_items','sort_by','list_price','name','price','product_code','quantity','status','desc','asc','close'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/section.tpl' => 1367063753,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php ob_start(); ?>
<?php if ($this->_tpl_vars['page_part']): ?>
    <?php $this->assign('_page_part', "#".($this->_tpl_vars['page_part']), false); ?>
<?php endif; ?>
<form action="<?php echo fn_url(($this->_tpl_vars['index_script']).($this->_tpl_vars['_page_part'])); ?>
" name="<?php echo $this->_tpl_vars['product_search_form_prefix']; ?>
search_form" method="get" class="cm-disable-empty <?php echo $this->_tpl_vars['form_meta']; ?>
">
<input type="hidden" name="type" value="<?php echo smarty_modifier_default(@$this->_tpl_vars['search_type'], 'simple'); ?>
" />
<?php if ($this->_tpl_vars['_REQUEST']['redirect_url']): ?>
<input type="hidden" name="redirect_url" value="<?php echo $this->_tpl_vars['_REQUEST']['redirect_url']; ?>
" />
<?php endif; ?>
<?php if ($this->_tpl_vars['selected_section'] != ""): ?>
<input type="hidden" id="selected_section" name="selected_section" value="<?php echo $this->_tpl_vars['selected_section']; ?>
" />
<?php endif; ?>

<?php if ($this->_tpl_vars['put_request_vars']): ?>
<?php $_from = $this->_tpl_vars['_REQUEST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
<?php if ($this->_tpl_vars['v']): ?>
<input type="hidden" name="<?php echo $this->_tpl_vars['k']; ?>
" value="<?php echo $this->_tpl_vars['v']; ?>
" />
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>

<?php echo $this->_tpl_vars['extra']; ?>


<table cellspacing="0" border="0" class="search-header">
<tr>
	<td class="nowrap search-field">
		<label><?php echo fn_get_lang_var('find_results_with', $this->getLanguage()); ?>
:</label>
		<div class="break">
			<input type="text" name="q" size="20" value="<?php echo $this->_tpl_vars['search']['q']; ?>
" class="search-input-text" />
			<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('search' => 'Y', 'but_name' => ($this->_tpl_vars['dispatch']), )); ?><input type="hidden" name="dispatch" value="<?php echo $this->_tpl_vars['but_name']; ?>
" />
<input type="image" src="<?php echo $this->_tpl_vars['images_dir']; ?>
/search_go.gif" class="search-go" alt="<?php echo fn_get_lang_var('search', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('search', $this->getLanguage()); ?>
" /><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>&nbsp;
			<select name="match">
				<option value="any" <?php if ($this->_tpl_vars['search']['match'] == 'any'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('any_words', $this->getLanguage()); ?>
</option>
				<option value="all" <?php if ($this->_tpl_vars['search']['match'] == 'all'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('all_words', $this->getLanguage()); ?>
</option>
				<option value="exact" <?php if ($this->_tpl_vars['search']['match'] == 'exact'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('exact_phrase', $this->getLanguage()); ?>
</option>
			</select>
		</div>
	</td>
	<td class="nowrap search-field">
		<label><?php echo fn_get_lang_var('price', $this->getLanguage()); ?>
&nbsp;(<?php echo $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']]['symbol']; ?>
):</label>
		<div class="break">
			<input type="text" name="price_from" size="1" value="<?php echo $this->_tpl_vars['search']['price_from']; ?>
" onfocus="this.select();" class="input-text-price" />&nbsp;&ndash;&nbsp;<input type="text" size="1" name="price_to" value="<?php echo $this->_tpl_vars['search']['price_to']; ?>
" onfocus="this.select();" class="input-text-price" />
		</div>
	</td>
	<td class="nowrap search-field">
		<label><?php echo fn_get_lang_var('search_in_category', $this->getLanguage()); ?>
:</label>
		<div class="break clear correct-picker-but">
		<?php if (fn_show_picker('categories', @CATEGORY_THRESHOLD)): ?>
			<?php if ($this->_tpl_vars['search']['cid']): ?>
				<?php $this->assign('s_cid', $this->_tpl_vars['search']['cid'], false); ?>
			<?php else: ?>
				<?php $this->assign('s_cid', '0', false); ?>
			<?php endif; ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "pickers/categories_picker.tpl", 'smarty_include_vars' => array('company_ids' => $this->_tpl_vars['picker_selected_companies'],'data_id' => 'location_category','input_name' => 'cid','item_ids' => $this->_tpl_vars['s_cid'],'hide_link' => true,'hide_delete_button' => true,'show_root' => true,'default_name' => fn_get_lang_var('all_categories', $this->getLanguage()),'extra' => "")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php else: ?>
			<?php if ($this->_tpl_vars['mode'] == 'picker'): ?>
				<?php $this->assign('trunc', '38', false); ?>
			<?php else: ?>
				<?php $this->assign('trunc', '70', false); ?>
			<?php endif; ?>
			<select	name="cid">
								<option	value="0" <?php if ($this->_tpl_vars['category_data']['parent_id'] == '0'): ?>selected="selected"<?php endif; ?>>- <?php echo fn_get_lang_var('all_categories', $this->getLanguage()); ?>
 -</option>
				<?php $_from = fn_get_plain_categories_tree(0, false, @CART_LANGUAGE, $this->_tpl_vars['picker_selected_companies']); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['search_cat'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['search_cat']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['search_cat']):
        $this->_foreach['search_cat']['iteration']++;
?>
					<?php if ($this->_tpl_vars['search_cat']['store']): ?>
						<?php if (! ($this->_foreach['search_cat']['iteration'] <= 1)): ?>
							</optgroup>
						<?php endif; ?>
							<optgroup label="<?php echo $this->_tpl_vars['search_cat']['category']; ?>
">
						<?php $this->assign('close_optgroup', true, false); ?>
					<?php else: ?>
								<option	value="<?php echo $this->_tpl_vars['search_cat']['category_id']; ?>
" <?php if ($this->_tpl_vars['search_cat']['disabled']): ?>disabled="disabled"<?php endif; ?> <?php if ($this->_tpl_vars['search']['cid'] == $this->_tpl_vars['search_cat']['category_id']): ?>selected="selected"<?php endif; ?> title="<?php echo $this->_tpl_vars['search_cat']['category']; ?>
"><?php echo smarty_modifier_indent(smarty_modifier_truncate(smarty_modifier_escape($this->_tpl_vars['search_cat']['category'], 'html'), $this->_tpl_vars['trunc'], "...", true), $this->_tpl_vars['search_cat']['level'], "&#166;&nbsp;&nbsp;&nbsp;&nbsp;", "&#166;--&nbsp;"); ?>
</option>
					<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?>
				<?php if ($this->_tpl_vars['close_optgroup']): ?>
							</optgroup>
				<?php endif; ?>
			</select>
		<?php endif; ?>
		</div>
	</td>
	<td class="buttons-container">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/search.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[".($this->_tpl_vars['dispatch'])."]",'but_role' => 'submit')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</td>
</tr>
</table>

<?php ob_start(); ?>

<?php $this->_tag_stack[] = array('hook', array('name' => "products:advanced_search")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<div class="search-field">
	<label><?php echo fn_get_lang_var('search_in', $this->getLanguage()); ?>
:</label>
	<table cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td class="select-field">
			<input type="checkbox" value="Y" <?php if ($this->_tpl_vars['search']['pname'] == 'Y'): ?>checked="checked"<?php endif; ?> name="pname" id="pname" class="checkbox" /><label for="pname"><?php echo fn_get_lang_var('product_name', $this->getLanguage()); ?>
</label></td>
		<td>&nbsp;&nbsp;&nbsp;</td>

		<td class="select-field"><input type="checkbox" value="Y" <?php if ($this->_tpl_vars['search']['pshort'] == 'Y'): ?>checked="checked"<?php endif; ?> name="pshort" id="pshort" class="checkbox" /><label for="pshort"><?php echo fn_get_lang_var('short_description', $this->getLanguage()); ?>
</label></td>
		<td>&nbsp;&nbsp;&nbsp;</td>

		<td class="select-field"><input type="checkbox" value="Y" <?php if ($this->_tpl_vars['search']['subcats'] == 'Y'): ?>checked="checked"<?php endif; ?> name="subcats" class="checkbox" id="subcats" /><label for="subcats"><?php echo fn_get_lang_var('subcategories', $this->getLanguage()); ?>
</label></td>
	</tr>
	<tr>
		<td class="select-field"><input type="checkbox" value="Y" <?php if ($this->_tpl_vars['search']['pfull'] == 'Y'): ?>checked="checked"<?php endif; ?> name="pfull" id="pfull" class="checkbox" /><label for="pfull"><?php echo fn_get_lang_var('full_description', $this->getLanguage()); ?>
</label></td>
		<td>&nbsp;&nbsp;&nbsp;</td>
		<td class="select-field"><input type="checkbox" value="Y" <?php if ($this->_tpl_vars['search']['pkeywords'] == 'Y'): ?>checked="checked"<?php endif; ?> name="pkeywords" id="pkeywords" class="checkbox" /><label for="pkeywords"><?php echo fn_get_lang_var('keywords', $this->getLanguage()); ?>
</label></td>
		<td colspan="2">&nbsp;</td>
	</tr>
	</table>
</div>
<hr />

<?php if ($this->_tpl_vars['filter_items']): ?>
<div class="search-field">
	<label>
		<a class="search-link cm-combination cm-combo-off cm-save-state" id="sw_filter"><img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/plus.gif" width="14" height="9" border="0" alt="" id="on_filter" class="cm-combination cm-save-state <?php if ($_COOKIE['filter']): ?>hidden<?php endif; ?>" /><img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/minus.gif" width="14" height="9" border="0" alt="" id="off_filter" class="cm-combination cm-save-state <?php if (! $_COOKIE['filter']): ?>hidden<?php endif; ?>" /><?php echo fn_get_lang_var('search_by_product_filters', $this->getLanguage()); ?>
</a>:
	</label>
	<div id="filter"<?php if (! $_COOKIE['filter']): ?> class="hidden"<?php endif; ?>>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/products/components/advanced_search_form.tpl", 'smarty_include_vars' => array('filter_features' => $this->_tpl_vars['filter_items'],'prefix' => 'filter_')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
</div>
<?php endif; ?>

<?php if ($this->_tpl_vars['feature_items']): ?>
<div class="search-field">
	<label>
		<a class="search-link cm-combination cm-combo-off cm-save-state" id="sw_feature"><img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/plus.gif" width="14" height="9" border="0" alt="" id="on_feature" class="cm-combination cm-save-state <?php if ($_COOKIE['feature']): ?>hidden<?php endif; ?>" /><img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/minus.gif" width="14" height="9" border="0" alt="" id="off_feature" class="cm-combination cm-save-state <?php if (! $_COOKIE['feature']): ?>hidden<?php endif; ?>" /><?php echo fn_get_lang_var('search_by_product_features', $this->getLanguage()); ?>
</a>:
	</label>
	<div id="feature"<?php if (! $_COOKIE['feature']): ?> class="hidden"<?php endif; ?>>
		<input type="hidden" name="advanced_filter" value="Y" />
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/products/components/advanced_search_form.tpl", 'smarty_include_vars' => array('filter_features' => $this->_tpl_vars['feature_items'],'prefix' => 'feature_')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
</div>
<?php endif; ?>

<div class="search-field">
	<label for="pcode"><?php echo fn_get_lang_var('search_by_sku', $this->getLanguage()); ?>
:</label>
	<input type="text" name="pcode" id="pcode" value="<?php echo $this->_tpl_vars['search']['pcode']; ?>
" onfocus="this.select();" class="input-text" />
</div>

<hr />
<?php $this->_tag_stack[] = array('hook', array('name' => "products:search_form")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<?php if ($this->_tpl_vars['addons']['tags']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><?php if (defined('COMPANY_ID') && @PRODUCT_TYPE == 'ULTIMATE' || @PRODUCT_TYPE != 'ULTIMATE'): ?>
<div class="search-field">
	<label for="elm_tag"><?php echo fn_get_lang_var('tag', $this->getLanguage()); ?>
:</label>
	<input id="elm_tag" type="text" name="tag" value="<?php echo $this->_tpl_vars['search']['tag']; ?>
" onfocus="this.select();" class="input-text" />
</div>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['product_configurator']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><div class="search-field">
	<label for="configurable"><?php echo fn_get_lang_var('configurable', $this->getLanguage()); ?>
:</label>
	<select name="configurable" id="configurable">
		<option value="">--</option>
		<option value="C" <?php if ($this->_tpl_vars['search']['configurable'] == 'C'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('yes', $this->getLanguage()); ?>
</option>
		<option value="P" <?php if ($this->_tpl_vars['search']['configurable'] == 'P'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('no', $this->getLanguage()); ?>
</option>
	</select>
</div><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<?php if (! fn_string_not_empty($this->_tpl_vars['picker_selected_company']) && ( @PRODUCT_TYPE == 'MULTIVENDOR' || @PRODUCT_TYPE == 'ULTIMATE' || $this->_tpl_vars['settings']['Suppliers']['enable_suppliers'] == 'Y' )): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/select_supplier_vendor.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>
<?php if (fn_string_not_empty($this->_tpl_vars['picker_selected_company'])): ?>
	<input type="hidden" name="company_id" value="<?php echo $this->_tpl_vars['picker_selected_company']; ?>
" />
<?php endif; ?>

<div class="search-field">
	<label for="shipping_freight_from"><?php echo fn_get_lang_var('shipping_freight', $this->getLanguage()); ?>
&nbsp;(<?php echo $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']]['symbol']; ?>
):</label>
	<input type="text" name="shipping_freight_from" id="shipping_freight_from" value="<?php echo $this->_tpl_vars['search']['shipping_freight_from']; ?>
" onfocus="this.select();" class="input-text" />&nbsp;&ndash;&nbsp;<input type="text" name="shipping_freight_to" value="<?php echo $this->_tpl_vars['search']['shipping_freight_to']; ?>
" onfocus="this.select();" class="input-text" />
</div>

<div class="search-field">
	<label for="weight_from"><?php echo fn_get_lang_var('weight', $this->getLanguage()); ?>
&nbsp;(<?php echo $this->_tpl_vars['settings']['General']['weight_symbol']; ?>
):</label>
	<input type="text" name="weight_from" id="weight_from" value="<?php echo $this->_tpl_vars['search']['weight_from']; ?>
" onfocus="this.select();" class="input-text" />&nbsp;&ndash;&nbsp;<input type="text" name="weight_to" value="<?php echo $this->_tpl_vars['search']['weight_to']; ?>
" onfocus="this.select();" class="input-text" />
</div>

<?php $this->assign('have_amount_filter', 0, false); ?>

<?php $_from = $this->_tpl_vars['filter_items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ff']):
?><?php if ($this->_tpl_vars['ff']['field_type'] == 'A'): ?><?php $this->assign('have_amount_filter', 1, false); ?><?php endif; ?><?php endforeach; endif; unset($_from); ?>

<?php if (! $this->_tpl_vars['have_amount_filter']): ?>
<div class="search-field">
	<label for="amount_from"><?php echo fn_get_lang_var('quantity', $this->getLanguage()); ?>
:</label>
	<input type="text" name="amount_from" id="amount_from" value="<?php echo $this->_tpl_vars['search']['amount_from']; ?>
" onfocus="this.select();" class="input-text" />&nbsp;&ndash;&nbsp;<input type="text" name="amount_to" value="<?php echo $this->_tpl_vars['search']['amount_to']; ?>
" onfocus="this.select();" class="input-text" />
</div>
<?php endif; ?>

<hr />

<div class="search-field">
	<label for="free_shipping"><?php echo fn_get_lang_var('free_shipping', $this->getLanguage()); ?>
:</label>
	<select name="free_shipping" id="free_shipping">
		<option value="">--</option>
		<option value="Y" <?php if ($this->_tpl_vars['search']['free_shipping'] == 'Y'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('yes', $this->getLanguage()); ?>
</option>
		<option value="N" <?php if ($this->_tpl_vars['search']['free_shipping'] == 'N'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('no', $this->getLanguage()); ?>
</option>
	</select>
</div>

<div class="search-field">
	<label for="status"><?php echo fn_get_lang_var('status', $this->getLanguage()); ?>
:</label>
	<select name="status" id="status">
		<option value="">--</option>
		<option value="A" <?php if ($this->_tpl_vars['search']['status'] == 'A'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('active', $this->getLanguage()); ?>
</option>
		<option value="H" <?php if ($this->_tpl_vars['search']['status'] == 'H'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('hidden', $this->getLanguage()); ?>
</option>
		<option value="D" <?php if ($this->_tpl_vars['search']['status'] == 'D'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>
</option>
	</select>
</div>

<hr />

<div class="search-field">
	<label for="popularity_from"><?php echo fn_get_lang_var('popularity', $this->getLanguage()); ?>
<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('tooltip' => fn_get_lang_var('ttc_popularity', $this->getLanguage()), )); ?><?php if ($this->_tpl_vars['tooltip']): ?> (<a class="cm-tooltip<?php if ($this->_tpl_vars['params']): ?> <?php echo $this->_tpl_vars['params']; ?>
<?php endif; ?>" title="<?php echo smarty_modifier_escape($this->_tpl_vars['tooltip'], 'html'); ?>
">?</a>)<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>:</label>
	<input type="text" name="popularity_from" id="popularity_from" value="<?php echo $this->_tpl_vars['search']['popularity_from']; ?>
" onfocus="this.select();" class="input-text" />&nbsp;&ndash;&nbsp;<input type="text" name="popularity_to" value="<?php echo $this->_tpl_vars['search']['popularity_to']; ?>
" onfocus="this.select();" class="input-text" />
</div>

<hr />

<?php $this->_tag_stack[] = array('hook', array('name' => "products:search_in_orders")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<div class="search-field">
	<label for="popularity_from"><?php echo fn_get_lang_var('purchased_in_orders', $this->getLanguage()); ?>
:</label>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "pickers/orders_picker.tpl", 'smarty_include_vars' => array('item_ids' => $this->_tpl_vars['search']['order_ids'],'no_item_text' => fn_get_lang_var('no_items', $this->getLanguage()),'data_id' => 'order_ids','input_name' => 'order_ids','view_mode' => 'simple')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<hr />

<div class="search-field">
	<label for="sort_by"><?php echo fn_get_lang_var('sort_by', $this->getLanguage()); ?>
:</label>
	<select name="sort_by" id="sort_by">
		<option <?php if ($this->_tpl_vars['search']['sort_by'] == 'list_price'): ?>selected="selected"<?php endif; ?> value="list_price"><?php echo fn_get_lang_var('list_price', $this->getLanguage()); ?>
</option>
		<option <?php if ($this->_tpl_vars['search']['sort_by'] == 'product'): ?>selected="selected"<?php endif; ?> value="product"><?php echo fn_get_lang_var('name', $this->getLanguage()); ?>
</option>
		<option <?php if ($this->_tpl_vars['search']['sort_by'] == 'price'): ?>selected="selected"<?php endif; ?> value="price"><?php echo fn_get_lang_var('price', $this->getLanguage()); ?>
</option>
		<option <?php if ($this->_tpl_vars['search']['sort_by'] == 'code'): ?>selected="selected"<?php endif; ?> value="code"><?php echo fn_get_lang_var('product_code', $this->getLanguage()); ?>
</option>
		<option <?php if ($this->_tpl_vars['search']['sort_by'] == 'amount'): ?>selected="selected"<?php endif; ?> value="amount"><?php echo fn_get_lang_var('quantity', $this->getLanguage()); ?>
</option>
		<option <?php if ($this->_tpl_vars['search']['sort_by'] == 'status'): ?>selected="selected"<?php endif; ?> value="status"><?php echo fn_get_lang_var('status', $this->getLanguage()); ?>
</option>
	</select>

	<select name="sort_order" id="sort_order">
		<option <?php if ($this->_tpl_vars['search']['sort_order'] == 'asc'): ?>selected="selected"<?php endif; ?> value="desc"><?php echo fn_get_lang_var('desc', $this->getLanguage()); ?>
</option>
		<option <?php if ($this->_tpl_vars['search']['sort_order'] == 'desc'): ?>selected="selected"<?php endif; ?> value="asc"><?php echo fn_get_lang_var('asc', $this->getLanguage()); ?>
</option>
	</select>
</div>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php $this->_smarty_vars['capture']['advanced_search'] = ob_get_contents(); ob_end_clean(); ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/advanced_search.tpl", 'smarty_include_vars' => array('content' => $this->_smarty_vars['capture']['advanced_search'],'dispatch' => $this->_tpl_vars['dispatch'],'view_type' => 'products')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</form>

<?php $this->_smarty_vars['capture']['section'] = ob_get_contents(); ob_end_clean(); ?>

<div class="search-form-wrap">
<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('section_content' => $this->_smarty_vars['capture']['section'], )); ?><?php echo smarty_function_math(array('equation' => "rand()",'assign' => 'rnd'), $this);?>

<div class="clear" id="ds_<?php echo $this->_tpl_vars['rnd']; ?>
">
	<div class="section-border">
		<?php echo $this->_tpl_vars['section_content']; ?>

		<?php if ($this->_tpl_vars['section_state']): ?>
			<p align="right">
				<a href="<?php echo fn_url(($this->_tpl_vars['index_script'])."?".($_SERVER['QUERY_STRING'])."&amp;close_section=".($this->_tpl_vars['key'])); ?>
" class="underlined"><?php echo fn_get_lang_var('close', $this->getLanguage()); ?>
</a>
			</p>
		<?php endif; ?>
	</div>
</div><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
</div>