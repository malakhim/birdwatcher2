<?php /* Smarty version 2.6.18, created on 2014-03-06 20:02:58
         compiled from views/products/update.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'views/products/update.tpl', 1, false),array('modifier', 'fn_get_usergroups', 'views/products/update.tpl', 1, false),array('modifier', 'unescape', 'views/products/update.tpl', 1, false),array('modifier', 'strip_tags', 'views/products/update.tpl', 1, false),array('modifier', 'fn_url', 'views/products/update.tpl', 28, false),array('modifier', 'fn_check_form_permissions', 'views/products/update.tpl', 28, false),array('modifier', 'defined', 'views/products/update.tpl', 28, false),array('modifier', 'explode', 'views/products/update.tpl', 81, false),array('modifier', 'escape', 'views/products/update.tpl', 85, false),array('modifier', 'fn_format_price', 'views/products/update.tpl', 92, false),array('modifier', 'is_array', 'views/products/update.tpl', 167, false),array('modifier', 'fn_from_json', 'views/products/update.tpl', 168, false),array('modifier', 'lower', 'views/products/update.tpl', 171, false),array('modifier', 'fn_check_view_permissions', 'views/products/update.tpl', 259, false),array('modifier', 'in_array', 'views/products/update.tpl', 331, false),array('modifier', 'fn_get_default_usergroups', 'views/products/update.tpl', 434, false),array('modifier', 'count', 'views/products/update.tpl', 436, false),array('modifier', 'define', 'views/products/update.tpl', 450, false),array('modifier', 'fn_parse_date', 'views/products/update.tpl', 482, false),array('modifier', 'date_format', 'views/products/update.tpl', 482, false),array('modifier', 'fn_get_product_details_views', 'views/products/update.tpl', 577, false),array('modifier', 'fn_explode_localizations', 'views/products/update.tpl', 608, false),array('modifier', 'empty_tabs', 'views/products/update.tpl', 803, false),array('block', 'hook', 'views/products/update.tpl', 67, false),array('function', 'math', 'views/products/update.tpl', 79, false),array('function', 'script', 'views/products/update.tpl', 797, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('information','name','update_for_all_hid_act','update_for_all_hid_dis','update_for_all_act','update_for_all_dis','vendor','categories','tt_views_products_update_categories','price','update_for_all_hid_act','update_for_all_hid_dis','update_for_all_act','update_for_all_dis','full_description','update_for_all_hid_act','update_for_all_hid_dis','update_for_all_act','update_for_all_dis','active','hidden','disabled','status','active','hidden','disabled','status','active','hidden','pending','disabled','images','text_product_thumbnail','text_product_detailed_image','options_settings','options_type','simultaneous','sequential','exceptions_type','forbidden','allowed','pricing_inventory','product_code','list_price','tt_views_products_update_list_price','in_stock','edit','remove_this_item','remove_this_item','zero_price_action','zpa_refuse','zpa_permit','zpa_ask_price','inventory','tt_views_products_update_inventory','track_with_options','track_without_options','dont_track','min_order_qty','max_order_qty','quantity_step','list_quantity_count','taxes','seo_meta_data','page_title','ttc_page_title','update_for_all_hid_act','update_for_all_hid_dis','update_for_all_act','update_for_all_dis','meta_description','update_for_all_hid_act','update_for_all_hid_dis','update_for_all_act','update_for_all_dis','meta_keywords','update_for_all_hid_act','update_for_all_hid_dis','update_for_all_act','update_for_all_dis','availability','usergroups','ttc_usergroups','creation_date','calendar','calendar','weekday_abr_0','weekday_abr_1','weekday_abr_2','weekday_abr_3','weekday_abr_4','weekday_abr_5','weekday_abr_6','month_name_abr_1','month_name_abr_2','month_name_abr_3','month_name_abr_4','month_name_abr_5','month_name_abr_6','month_name_abr_7','month_name_abr_8','month_name_abr_9','month_name_abr_10','month_name_abr_11','month_name_abr_12','available_since','calendar','calendar','weekday_abr_0','weekday_abr_1','weekday_abr_2','weekday_abr_3','weekday_abr_4','weekday_abr_5','weekday_abr_6','month_name_abr_1','month_name_abr_2','month_name_abr_3','month_name_abr_4','month_name_abr_5','month_name_abr_6','month_name_abr_7','month_name_abr_8','month_name_abr_9','month_name_abr_10','month_name_abr_11','month_name_abr_12','out_of_stock_actions','tt_views_products_update_out_of_stock_actions','none','buy_in_advance','sign_up_for_notification','extra','product_details_layout','tt_views_products_update_product_details_layout','feature_comparison','downloadable','edp_enable_shipping','time_unlimited_download','localization','multiple_selectbox_notice','short_description','update_for_all_hid_act','update_for_all_hid_dis','update_for_all_act','update_for_all_dis','popularity','ttc_popularity','search_words','update_for_all_hid_act','update_for_all_hid_dis','update_for_all_act','update_for_all_dis','additional_images','text_position_updating','sort_images','sort','additional_thumbnail','additional_popup_larger_image','text_additional_thumbnail','text_additional_detailed_image','additional_thumbnail','additional_popup_larger_image','text_additional_thumbnail','text_additional_detailed_image','new_product','previous','next','preview','preview_as_admin','editing_product'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/view_tools.tpl' => 1367063753,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php ob_start(); ?>

<?php ob_start(); ?>

<?php $this->assign('categories_company_id', $this->_tpl_vars['product_data']['company_id'], false); ?>

<?php if ($this->_tpl_vars['product_data']['product_id']): ?>
	<?php $this->assign('id', $this->_tpl_vars['product_data']['product_id'], false); ?>
<?php else: ?>
	<?php $this->assign('id', 0, false); ?>
<?php endif; ?>

<form action="<?php echo fn_url(""); ?>
" method="post" name="product_update_form" class="cm-form-highlight cm-disable-empty-files <?php if (fn_check_form_permissions("") || ( defined('COMPANY_ID') && $this->_tpl_vars['product_data']['shared_product'] == 'Y' && $this->_tpl_vars['product_data']['company_id'] != @COMPANY_ID )): ?> cm-hide-inputs<?php endif; ?>" enctype="multipart/form-data"> <input type="hidden" name="fake" value="1" />
<input type="hidden" class="<?php echo $this->_tpl_vars['no_hide_input_if_shared_product']; ?>
" name="selected_section" id="selected_section" value="<?php echo $this->_tpl_vars['_REQUEST']['selected_section']; ?>
" />
<input type="hidden" class="<?php echo $this->_tpl_vars['no_hide_input_if_shared_product']; ?>
" name="product_id" value="<?php echo $this->_tpl_vars['id']; ?>
" />


<div class="product-manage" id="content_detailed"> 
<fieldset>

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('information', $this->getLanguage()))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="form-field <?php echo $this->_tpl_vars['no_hide_input_if_shared_product']; ?>
">
	<label for="product_description_product" class="cm-required"><?php echo fn_get_lang_var('name', $this->getLanguage()); ?>
:</label>
	<span class="input-helper"><input type="text" name="product_data[product]" id="product_description_product" size="55" value="<?php echo $this->_tpl_vars['product_data']['product']; ?>
" class="input-text-large main-input" /></span>
	<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('display' => $this->_tpl_vars['show_update_for_all'], 'object_id' => 'product', 'name' => "update_all_vendors[product]", )); ?><?php if ($this->_tpl_vars['display']): ?>
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
</div>

<?php $this->_tag_stack[] = array('hook', array('name' => "companies:product_details_fields")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	
	<?php if ($this->_tpl_vars['mode'] != 'add'): ?>
		<?php $this->assign('reload_form', true, false); ?>
	<?php endif; ?>
	

	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/companies/components/company_field.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('vendor', $this->getLanguage()),'name' => "product_data[company_id]",'id' => 'product_data_company_id','selected' => $this->_tpl_vars['product_data']['company_id'],'tooltip' => $this->_tpl_vars['companies_tooltip'],'reload_form' => $this->_tpl_vars['reload_form'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<input type="hidden" value="product_categories" name="result_ids">
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<div class="form-field <?php echo $this->_tpl_vars['no_hide_input_if_shared_product']; ?>
" id="product_categories">
	<?php echo smarty_function_math(array('equation' => "rand()",'assign' => 'rnd'), $this);?>

	<?php if ($this->_tpl_vars['_REQUEST']['category_id']): ?>
		<?php $this->assign('request_category_id', explode(",", $this->_tpl_vars['_REQUEST']['category_id']), false); ?>
	<?php else: ?>
		<?php $this->assign('request_category_id', "", false); ?>
	<?php endif; ?>
	<label for="ccategories_<?php echo $this->_tpl_vars['rnd']; ?>
_ids" class="cm-required<?php if ($this->_tpl_vars['product_data']['shared_product'] == 'Y'): ?> cm-no-tooltip<?php endif; ?>"><?php echo fn_get_lang_var('categories', $this->getLanguage()); ?>
<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('tooltip' => fn_get_lang_var('tt_views_products_update_categories', $this->getLanguage()), )); ?><?php if ($this->_tpl_vars['tooltip']): ?> (<a class="cm-tooltip<?php if ($this->_tpl_vars['params']): ?> <?php echo $this->_tpl_vars['params']; ?>
<?php endif; ?>" title="<?php echo smarty_modifier_escape($this->_tpl_vars['tooltip'], 'html'); ?>
">?</a>)<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>:</label>

	<div class="select-field categories"><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "pickers/categories_picker.tpl", 'smarty_include_vars' => array('hide_input' => $this->_tpl_vars['product_data']['shared_product'],'company_ids' => $this->_tpl_vars['categories_company_id'],'rnd' => $this->_tpl_vars['rnd'],'data_id' => 'categories','input_name' => "product_data[categories]",'radio_input_name' => "product_data[main_category]",'main_category' => $this->_tpl_vars['product_data']['main_category'],'item_ids' => smarty_modifier_default(@$this->_tpl_vars['product_data']['category_ids'], @$this->_tpl_vars['request_category_id']),'hide_link' => true,'hide_delete_button' => true,'display_input_id' => 'category_ids','disable_no_item_text' => true,'view_mode' => 'list')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
<!--product_categories--></div>

<div class="form-field <?php echo $this->_tpl_vars['no_hide_input_if_shared_product']; ?>
">
	<label for="price_price" class="cm-required"><?php echo fn_get_lang_var('price', $this->getLanguage()); ?>
 (<?php echo $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']]['symbol']; ?>
):</label>
	<input type="text" name="product_data[price]" id="price_price" size="10" value="<?php echo fn_format_price(smarty_modifier_default(@$this->_tpl_vars['product_data']['price'], "0.00"), $this->_tpl_vars['primary_currency'], null, false); ?>
" class="input-text-medium" />
	<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('display' => $this->_tpl_vars['show_update_for_all'], 'object_id' => 'price', 'name' => "update_all_vendors[price]", )); ?><?php if ($this->_tpl_vars['display']): ?>
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
</div>

<div class="form-field cm-no-hide-input">
	<label for="product_full_descr"><?php echo fn_get_lang_var('full_description', $this->getLanguage()); ?>
:</label>
	<textarea id="product_full_descr" name="product_data[full_description]" cols="55" rows="8" class="cm-wysiwyg input-textarea-long"><?php echo $this->_tpl_vars['product_data']['full_description']; ?>
</textarea>
	<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('display' => $this->_tpl_vars['show_update_for_all'], 'object_id' => 'full_description', 'name' => "update_all_vendors[full_description]", )); ?><?php if ($this->_tpl_vars['display']): ?>
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
</div>

<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('input_name' => "product_data[status]", 'id' => 'product_data', 'obj' => $this->_tpl_vars['product_data'], 'hidden' => true, )); ?><?php if ($this->_tpl_vars['display'] == 'select'): ?>
<select name="<?php echo $this->_tpl_vars['input_name']; ?>
" <?php if ($this->_tpl_vars['input_id']): ?>id="<?php echo $this->_tpl_vars['input_id']; ?>
"<?php endif; ?>>
	<option value="A" <?php if ($this->_tpl_vars['obj']['status'] == 'A'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('active', $this->getLanguage()); ?>
</option>
	<?php if ($this->_tpl_vars['hidden']): ?>
	<option value="H" <?php if ($this->_tpl_vars['obj']['status'] == 'H'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('hidden', $this->getLanguage()); ?>
</option>
	<?php endif; ?>
	<option value="D" <?php if ($this->_tpl_vars['obj']['status'] == 'D'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>
</option>
</select>
<?php elseif ($this->_tpl_vars['display'] == 'text'): ?>
<div class="form-field">
	<label class="cm-required"><?php echo fn_get_lang_var('status', $this->getLanguage()); ?>
:</label>
	<span>
		<?php if ($this->_tpl_vars['obj']['status'] == 'A'): ?>
			<?php echo fn_get_lang_var('active', $this->getLanguage()); ?>

		<?php elseif ($this->_tpl_vars['obj']['status'] == 'H'): ?>
			<?php echo fn_get_lang_var('hidden', $this->getLanguage()); ?>

		<?php elseif ($this->_tpl_vars['obj']['status'] == 'D'): ?>
			<?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>

		<?php endif; ?>
	</span>
</div>
<?php else: ?>
<div class="form-field">
	<label class="cm-required"><?php echo fn_get_lang_var('status', $this->getLanguage()); ?>
:</label>
	<div class="select-field">
		<?php if ($this->_tpl_vars['items_status']): ?>
			<?php if (! is_array($this->_tpl_vars['items_status'])): ?>
				<?php $this->assign('items_status', fn_from_json($this->_tpl_vars['items_status']), false); ?>
			<?php endif; ?>
			<?php $_from = $this->_tpl_vars['items_status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['status_cycle'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['status_cycle']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['st'] => $this->_tpl_vars['val']):
        $this->_foreach['status_cycle']['iteration']++;
?>
			<input type="radio" name="<?php echo $this->_tpl_vars['input_name']; ?>
" id="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$this->_tpl_vars['obj_id'], 0); ?>
_<?php echo smarty_modifier_lower($this->_tpl_vars['st']); ?>
" <?php if ($this->_tpl_vars['obj']['status'] == $this->_tpl_vars['st'] || ( ! $this->_tpl_vars['obj']['status'] && ($this->_foreach['status_cycle']['iteration'] <= 1) )): ?>checked="checked"<?php endif; ?> value="<?php echo $this->_tpl_vars['st']; ?>
" class="radio" /><label for="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$this->_tpl_vars['obj_id'], 0); ?>
_<?php echo smarty_modifier_lower($this->_tpl_vars['st']); ?>
"><?php echo $this->_tpl_vars['val']; ?>
</label>
			<?php endforeach; endif; unset($_from); ?>
		<?php else: ?>
		<input type="radio" name="<?php echo $this->_tpl_vars['input_name']; ?>
" id="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$this->_tpl_vars['obj_id'], 0); ?>
_a" <?php if ($this->_tpl_vars['obj']['status'] == 'A' || ! $this->_tpl_vars['obj']['status']): ?>checked="checked"<?php endif; ?> value="A" class="radio" /><label for="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$this->_tpl_vars['obj_id'], 0); ?>
_a"><?php echo fn_get_lang_var('active', $this->getLanguage()); ?>
</label>

		<?php if ($this->_tpl_vars['hidden']): ?>
		<input type="radio" name="<?php echo $this->_tpl_vars['input_name']; ?>
" id="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$this->_tpl_vars['obj_id'], 0); ?>
_h" <?php if ($this->_tpl_vars['obj']['status'] == 'H'): ?>checked="checked"<?php endif; ?> value="H" class="radio" /><label for="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$this->_tpl_vars['obj_id'], 0); ?>
_h"><?php echo fn_get_lang_var('hidden', $this->getLanguage()); ?>
</label>
		<?php endif; ?>

		<?php if ($this->_tpl_vars['obj']['status'] == 'P'): ?>
		<input type="radio" name="<?php echo $this->_tpl_vars['input_name']; ?>
" id="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$this->_tpl_vars['obj_id'], 0); ?>
_p" checked="checked" value="P" class="radio" /><label for="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$this->_tpl_vars['obj_id'], 0); ?>
_p"><?php echo fn_get_lang_var('pending', $this->getLanguage()); ?>
</label>
		<?php endif; ?>

		<input type="radio" name="<?php echo $this->_tpl_vars['input_name']; ?>
" id="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$this->_tpl_vars['obj_id'], 0); ?>
_d" <?php if ($this->_tpl_vars['obj']['status'] == 'D'): ?>checked="checked"<?php endif; ?> value="D" class="radio" /><label for="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$this->_tpl_vars['obj_id'], 0); ?>
_d"><?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>
</label>
		<?php endif; ?>
	</div>
</div>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>

<div class="form-field">
	<label><?php echo fn_get_lang_var('images', $this->getLanguage()); ?>
:</label>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/attach_images.tpl", 'smarty_include_vars' => array('image_name' => 'product_main','image_object_type' => 'product','image_pair' => $this->_tpl_vars['product_data']['main_pair'],'icon_text' => fn_get_lang_var('text_product_thumbnail', $this->getLanguage()),'detailed_text' => fn_get_lang_var('text_product_detailed_image', $this->getLanguage()),'no_thumbnail' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
</fieldset>


<fieldset>

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('options_settings', $this->getLanguage()))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="form-field">
	<label for="product_options_type"><?php echo fn_get_lang_var('options_type', $this->getLanguage()); ?>
:</label>
	<select name="product_data[options_type]" id="options_type">
		<option value="P" <?php if ($this->_tpl_vars['product_data']['options_type'] == 'P'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('simultaneous', $this->getLanguage()); ?>
</option>
		<option value="S" <?php if ($this->_tpl_vars['product_data']['options_type'] == 'S'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('sequential', $this->getLanguage()); ?>
</option>
	</select>
</div>
<div class="form-field">
	<label for="product_exceptions_type"><?php echo fn_get_lang_var('exceptions_type', $this->getLanguage()); ?>
:</label>
	<select name="product_data[exceptions_type]" id="exceptions_type">
		<option value="F" <?php if ($this->_tpl_vars['product_data']['exceptions_type'] == 'F'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('forbidden', $this->getLanguage()); ?>
</option>
		<option value="A" <?php if ($this->_tpl_vars['product_data']['exceptions_type'] == 'A'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('allowed', $this->getLanguage()); ?>
</option>
	</select>
</div>
</fieldset>


<fieldset>

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('pricing_inventory', $this->getLanguage()))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="form-field">
	<label for="product_product_code"><?php echo fn_get_lang_var('product_code', $this->getLanguage()); ?>
:</label>
	<input type="text" name="product_data[product_code]" id="product_product_code" size="20" maxlength="32"  value="<?php echo $this->_tpl_vars['product_data']['product_code']; ?>
" class="input-text-medium" />
</div>

<div class="form-field">
	<label for="product_list_price"><?php echo fn_get_lang_var('list_price', $this->getLanguage()); ?>
 (<?php echo $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']]['symbol']; ?>
) <?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('tooltip' => fn_get_lang_var('tt_views_products_update_list_price', $this->getLanguage()), )); ?><?php if ($this->_tpl_vars['tooltip']): ?> (<a class="cm-tooltip<?php if ($this->_tpl_vars['params']): ?> <?php echo $this->_tpl_vars['params']; ?>
<?php endif; ?>" title="<?php echo smarty_modifier_escape($this->_tpl_vars['tooltip'], 'html'); ?>
">?</a>)<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>:</label>
	<input type="text" name="product_data[list_price]" id="product_data_list_price" size="10" value="<?php echo smarty_modifier_default(@$this->_tpl_vars['product_data']['list_price'], "0.00"); ?>
" class="input-text-medium" />
</div>

<div class="form-field">
	<label for="product_amount"><?php echo fn_get_lang_var('in_stock', $this->getLanguage()); ?>
:</label>
	<?php if ($this->_tpl_vars['product_data']['tracking'] == 'O'): ?>
		<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('but_text' => fn_get_lang_var('edit', $this->getLanguage()), 'but_href' => "product_options.inventory?product_id=".($this->_tpl_vars['id']), 'but_role' => 'edit', )); ?><?php if ($this->_tpl_vars['but_role'] == 'text'): ?>
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
	<?php else: ?>
		<input type="text" name="product_data[amount]" id="product_amount" size="10" value="<?php echo smarty_modifier_default(@$this->_tpl_vars['product_data']['amount'], '1'); ?>
" class="input-text-short" />
	<?php endif; ?>
</div>

<div class="form-field">
	<label for="zero_price_action"><?php echo fn_get_lang_var('zero_price_action', $this->getLanguage()); ?>
:</label>
	<select name="product_data[zero_price_action]" id="zero_price_action">
		<option value="R" <?php if ($this->_tpl_vars['product_data']['zero_price_action'] == 'R'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('zpa_refuse', $this->getLanguage()); ?>
</option>
		<option value="P" <?php if ($this->_tpl_vars['product_data']['zero_price_action'] == 'P'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('zpa_permit', $this->getLanguage()); ?>
</option>
		<option value="A" <?php if ($this->_tpl_vars['product_data']['zero_price_action'] == 'A'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('zpa_ask_price', $this->getLanguage()); ?>
</option>
	</select>
</div>

<div class="form-field">
	<label for="product_tracking"><?php echo fn_get_lang_var('inventory', $this->getLanguage()); ?>
<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('tooltip' => fn_get_lang_var('tt_views_products_update_inventory', $this->getLanguage()), )); ?><?php if ($this->_tpl_vars['tooltip']): ?> (<a class="cm-tooltip<?php if ($this->_tpl_vars['params']): ?> <?php echo $this->_tpl_vars['params']; ?>
<?php endif; ?>" title="<?php echo smarty_modifier_escape($this->_tpl_vars['tooltip'], 'html'); ?>
">?</a>)<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>:</label>
	<select name="product_data[tracking]" id="product_tracking" <?php if ($this->_tpl_vars['settings']['General']['inventory_tracking'] == 'N'): ?>disabled="disabled"<?php endif; ?>>
		<?php if ($this->_tpl_vars['product_options']): ?>
			<option value="O" <?php if ($this->_tpl_vars['product_data']['tracking'] == 'O' && $this->_tpl_vars['settings']['General']['inventory_tracking'] == 'Y'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('track_with_options', $this->getLanguage()); ?>
</option>
		<?php endif; ?>
		<option value="B" <?php if ($this->_tpl_vars['product_data']['tracking'] == 'B' && $this->_tpl_vars['settings']['General']['inventory_tracking'] == 'Y'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('track_without_options', $this->getLanguage()); ?>
</option>
		<option value="D" <?php if ($this->_tpl_vars['product_data']['tracking'] == 'D' || $this->_tpl_vars['settings']['General']['inventory_tracking'] == 'N'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('dont_track', $this->getLanguage()); ?>
</option>
	</select>
</div>

<div class="form-field">
	<label for="min_qty"><?php echo fn_get_lang_var('min_order_qty', $this->getLanguage()); ?>
:</label>
	<input type="text" name="product_data[min_qty]" size="10" id="min_qty" value="<?php echo smarty_modifier_default(@$this->_tpl_vars['product_data']['min_qty'], '0'); ?>
" class="input-text-short" />
</div>

<div class="form-field">
	<label for="max_qty"><?php echo fn_get_lang_var('max_order_qty', $this->getLanguage()); ?>
:</label>
	<input type="text" name="product_data[max_qty]" id="max_qty" size="10" value="<?php echo smarty_modifier_default(@$this->_tpl_vars['product_data']['max_qty'], '0'); ?>
" class="input-text-short" />
</div>

<div class="form-field">
	<label for="qty_step"><?php echo fn_get_lang_var('quantity_step', $this->getLanguage()); ?>
:</label>
	<input type="text" name="product_data[qty_step]" id="qty_step" size="10" value="<?php echo smarty_modifier_default(@$this->_tpl_vars['product_data']['qty_step'], '0'); ?>
" class="input-text-short" />
</div>

<div class="form-field">
	<label for="list_qty_count"><?php echo fn_get_lang_var('list_quantity_count', $this->getLanguage()); ?>
:</label>
	<input type="text" name="product_data[list_qty_count]" id="list_qty_count" size="10" value="<?php echo smarty_modifier_default(@$this->_tpl_vars['product_data']['list_qty_count'], '0'); ?>
" class="input-text-short" />
</div>

<div class="form-field">
	<label for="products_tax_id"><?php echo fn_get_lang_var('taxes', $this->getLanguage()); ?>
:</label>
	<div class="select-field">
		<input type="hidden" name="product_data[tax_ids]" value="" />
		<?php $_from = $this->_tpl_vars['taxes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tax']):
?>
			<input type="checkbox" name="product_data[tax_ids][<?php echo $this->_tpl_vars['tax']['tax_id']; ?>
]" id="product_data_<?php echo $this->_tpl_vars['tax']['tax_id']; ?>
" <?php if (smarty_modifier_in_array($this->_tpl_vars['tax']['tax_id'], $this->_tpl_vars['product_data']['taxes']) || $this->_tpl_vars['product_data']['taxes'][$this->_tpl_vars['tax']['tax_id']]): ?>checked="checked"<?php endif; ?> class="checkbox" value="<?php echo $this->_tpl_vars['tax']['tax_id']; ?>
" />
			<label for="product_data_<?php echo $this->_tpl_vars['tax']['tax_id']; ?>
"><?php echo $this->_tpl_vars['tax']['tax']; ?>
</label>
		<?php endforeach; else: ?>
			&ndash;
		<?php endif; unset($_from); ?>
	</div>
</div>
</fieldset>

<fieldset>

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('seo_meta_data', $this->getLanguage()))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="form-field <?php echo $this->_tpl_vars['no_hide_input_if_shared_product']; ?>
">
	<label for="product_page_title"><?php echo fn_get_lang_var('page_title', $this->getLanguage()); ?>
<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('tooltip' => fn_get_lang_var('ttc_page_title', $this->getLanguage()), )); ?><?php if ($this->_tpl_vars['tooltip']): ?> (<a class="cm-tooltip<?php if ($this->_tpl_vars['params']): ?> <?php echo $this->_tpl_vars['params']; ?>
<?php endif; ?>" title="<?php echo smarty_modifier_escape($this->_tpl_vars['tooltip'], 'html'); ?>
">?</a>)<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>:</label>
	<input type="text" name="product_data[page_title]" id="product_page_title" size="55" value="<?php echo $this->_tpl_vars['product_data']['page_title']; ?>
" class="input-text-large" />
	<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('display' => $this->_tpl_vars['show_update_for_all'], 'object_id' => 'page_title', 'name' => "update_all_vendors[page_title]", )); ?><?php if ($this->_tpl_vars['display']): ?>
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
</div>

<div class="form-field <?php echo $this->_tpl_vars['no_hide_input_if_shared_product']; ?>
">
	<label for="product_meta_descr"><?php echo fn_get_lang_var('meta_description', $this->getLanguage()); ?>
:</label>
	<textarea name="product_data[meta_description]" id="product_meta_descr" cols="55" rows="2" class="input-textarea-long"><?php echo $this->_tpl_vars['product_data']['meta_description']; ?>
</textarea>
	<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('display' => $this->_tpl_vars['show_update_for_all'], 'object_id' => 'meta_description', 'name' => "update_all_vendors[meta_description]", )); ?><?php if ($this->_tpl_vars['display']): ?>
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
</div>

<div class="form-field <?php echo $this->_tpl_vars['no_hide_input_if_shared_product']; ?>
">
	<label for="product_meta_keywords"><?php echo fn_get_lang_var('meta_keywords', $this->getLanguage()); ?>
:</label>
	<textarea name="product_data[meta_keywords]" id="product_meta_keywords" cols="55" rows="2" class="input-textarea-long"><?php echo $this->_tpl_vars['product_data']['meta_keywords']; ?>
</textarea>
	<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('display' => $this->_tpl_vars['show_update_for_all'], 'object_id' => 'meta_keywords', 'name' => "update_all_vendors[meta_keywords]", )); ?><?php if ($this->_tpl_vars['display']): ?>
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
</div>
</fieldset>

<fieldset>

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('availability', $this->getLanguage()))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="form-field">
	<label><?php echo fn_get_lang_var('usergroups', $this->getLanguage()); ?>
<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('tooltip' => fn_get_lang_var('ttc_usergroups', $this->getLanguage()), )); ?><?php if ($this->_tpl_vars['tooltip']): ?> (<a class="cm-tooltip<?php if ($this->_tpl_vars['params']): ?> <?php echo $this->_tpl_vars['params']; ?>
<?php endif; ?>" title="<?php echo smarty_modifier_escape($this->_tpl_vars['tooltip'], 'html'); ?>
">?</a>)<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>:</label>
		<div class="select-field">
			<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('id' => 'ug_id', 'name' => "product_data[usergroup_ids]", 'usergroups' => fn_get_usergroups('C', @DESCR_SL), 'usergroup_ids' => $this->_tpl_vars['product_data']['usergroup_ids'], 'input_extra' => "", 'list_mode' => false, )); ?>
<?php if ($this->_tpl_vars['usergroup_ids'] !== ""): ?>
<?php $this->assign('ug_ids', explode(",", $this->_tpl_vars['usergroup_ids']), false); ?>
<?php endif; ?>

<?php $this->_tag_stack[] = array('hook', array('name' => "usergroups:select_usergroups")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<input type="hidden" name="<?php echo $this->_tpl_vars['name']; ?>
" value="0" <?php echo $this->_tpl_vars['input_extra']; ?>
/>
<?php $_from = fn_get_default_usergroups(""); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['usergroup']):
?>
	<?php if ($this->_tpl_vars['list_mode']): ?><p><?php endif; ?>
	<input type="checkbox" name="<?php echo $this->_tpl_vars['name']; ?>
[]" id="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo $this->_tpl_vars['usergroup']['usergroup_id']; ?>
"<?php if (( $this->_tpl_vars['ug_ids'] && smarty_modifier_in_array($this->_tpl_vars['usergroup']['usergroup_id'], $this->_tpl_vars['ug_ids']) ) || ( ! $this->_tpl_vars['ug_ids'] && $this->_tpl_vars['usergroup']['usergroup_id'] == @USERGROUP_ALL )): ?> checked="checked"<?php endif; ?> class="checkbox" value="<?php echo $this->_tpl_vars['usergroup']['usergroup_id']; ?>
" <?php echo $this->_tpl_vars['input_extra']; ?>
<?php if (( ! $this->_tpl_vars['ug_ids'] || ( $this->_tpl_vars['ug_ids'] && count($this->_tpl_vars['ug_ids']) == 1 && smarty_modifier_in_array($this->_tpl_vars['usergroup']['usergroup_id'], $this->_tpl_vars['ug_ids']) ) ) && $this->_tpl_vars['usergroup']['usergroup_id'] == @USERGROUP_ALL): ?> disabled="disabled"<?php endif; ?> onclick="fn_switch_default_box(this, '<?php echo $this->_tpl_vars['id']; ?>
', <?php echo @USERGROUP_ALL; ?>
);" />
	<label for="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo $this->_tpl_vars['usergroup']['usergroup_id']; ?>
"><?php echo smarty_modifier_escape($this->_tpl_vars['usergroup']['usergroup']); ?>
</label>
	<?php if ($this->_tpl_vars['list_mode']): ?></p><?php endif; ?>
<?php endforeach; endif; unset($_from); ?>

<?php $_from = $this->_tpl_vars['usergroups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['usergroup']):
?>
	<?php if ($this->_tpl_vars['list_mode']): ?><p><?php endif; ?>
	<input type="checkbox" name="<?php echo $this->_tpl_vars['name']; ?>
[]" id="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo $this->_tpl_vars['usergroup']['usergroup_id']; ?>
"<?php if ($this->_tpl_vars['ug_ids'] && smarty_modifier_in_array($this->_tpl_vars['usergroup']['usergroup_id'], $this->_tpl_vars['ug_ids'])): ?> checked="checked"<?php endif; ?> class="checkbox" value="<?php echo $this->_tpl_vars['usergroup']['usergroup_id']; ?>
" <?php echo $this->_tpl_vars['input_extra']; ?>
 onclick="fn_switch_default_box(this, '<?php echo $this->_tpl_vars['id']; ?>
', <?php echo @USERGROUP_ALL; ?>
);" />
	<label for="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo $this->_tpl_vars['usergroup']['usergroup_id']; ?>
"><?php echo smarty_modifier_escape($this->_tpl_vars['usergroup']['usergroup']); ?>
</label>
	<?php if ($this->_tpl_vars['list_mode']): ?></p><?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<?php if (! defined('SMARTY_USERGROUPS_LOADED')): ?>
<?php $this->assign('tmp', define('SMARTY_USERGROUPS_LOADED', true), false); ?>
<script type="text/javascript">
	//<![CDATA[
	<?php echo '
	function fn_switch_default_box(holder, prefix, default_id)
	{
		var p = $(holder).parents(\':not(p):first\');
		var default_box = $(\'input[id^=\' + prefix + \'_\' + default_id + \']\', p);
		var checked_items = $(\'input[id^=\' + prefix + \'_].checkbox:checked\', p).not(default_box).length + holder.checked ? 1 : 0;
		if (checked_items == 0) {
			default_box.attr(\'disabled\', \'disabled\');
			default_box.attr(\'checked\', \'checked\');
		} else {
			default_box.removeAttr(\'disabled\');
		}
	}
	'; ?>

	//]]>
</script>
<?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
		</div>
</div>

<div class="form-field">
	<label for="date_holder"><?php echo fn_get_lang_var('creation_date', $this->getLanguage()); ?>
:</label>
	<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('date_id' => 'date_holder', 'date_name' => "product_data[timestamp]", 'date_val' => smarty_modifier_default(@$this->_tpl_vars['product_data']['timestamp'], @TIME), 'start_year' => $this->_tpl_vars['settings']['Company']['company_start_year'], )); ?><?php if ($this->_tpl_vars['settings']['Appearance']['calendar_date_format'] == 'month_first'): ?>
	<?php $this->assign('date_format', "%m/%d/%Y", false); ?>
<?php else: ?>
	<?php $this->assign('date_format', "%d/%m/%Y", false); ?>
<?php endif; ?>

<input type="text" id="<?php echo $this->_tpl_vars['date_id']; ?>
" name="<?php echo $this->_tpl_vars['date_name']; ?>
" class="input-text<?php if ($this->_tpl_vars['date_meta']): ?> <?php echo $this->_tpl_vars['date_meta']; ?>
<?php endif; ?> cm-calendar" value="<?php if ($this->_tpl_vars['date_val']): ?><?php echo smarty_modifier_date_format(fn_parse_date($this->_tpl_vars['date_val']), ($this->_tpl_vars['date_format'])); ?>
<?php endif; ?>" <?php echo $this->_tpl_vars['extra']; ?>
 size="10" />&nbsp;<img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/calendar.png" class="cm-external-focus calendar-but" rev="<?php echo $this->_tpl_vars['date_id']; ?>
" title="<?php echo fn_get_lang_var('calendar', $this->getLanguage()); ?>
" alt="<?php echo fn_get_lang_var('calendar', $this->getLanguage()); ?>
" />

<script type="text/javascript">
//<![CDATA[

var calendar_config = <?php echo $this->_tpl_vars['ldelim']; ?>
<?php echo $this->_tpl_vars['rdelim']; ?>
;
calendar_config = <?php echo $this->_tpl_vars['ldelim']; ?>

			changeMonth: true,
			duration: 'fast',
			changeYear: true,
			numberOfMonths: 1,
			selectOtherMonths: true,
			showOtherMonths: true,
			firstDay: <?php if ($this->_tpl_vars['settings']['Appearance']['calendar_week_format'] == 'sunday_first'): ?>0<?php else: ?>1<?php endif; ?>,
			dayNamesMin: ['<?php echo fn_get_lang_var('weekday_abr_0', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_1', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_2', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_3', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_4', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_5', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_6', $this->getLanguage()); ?>
'],
			monthNamesShort: ['<?php echo fn_get_lang_var('month_name_abr_1', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_2', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_3', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_4', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_5', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_6', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_7', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_8', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_9', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_10', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_11', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_12', $this->getLanguage()); ?>
'],
			yearRange: '<?php echo smarty_modifier_default(@$this->_tpl_vars['start_year'], @$this->_tpl_vars['settings']['Company']['company_start_year']); ?>
:<?php echo smarty_function_math(array('equation' => "x+y",'x' => smarty_modifier_default(@$this->_tpl_vars['end_year'], 1),'y' => smarty_modifier_date_format(@TIME, "%Y")), $this);?>
',
			dateFormat: '<?php if ($this->_tpl_vars['settings']['Appearance']['calendar_date_format'] == 'month_first'): ?>mm/dd/yy<?php else: ?>dd/mm/yy<?php endif; ?>'
		<?php echo $this->_tpl_vars['rdelim']; ?>
;

if ($.ua.browser == 'Internet Explorer') <?php echo $this->_tpl_vars['ldelim']; ?>

	$(window).load(function()<?php echo $this->_tpl_vars['ldelim']; ?>

		$('#<?php echo $this->_tpl_vars['date_id']; ?>
').datepicker(calendar_config);
	<?php echo $this->_tpl_vars['rdelim']; ?>
);
<?php echo $this->_tpl_vars['rdelim']; ?>
 else <?php echo $this->_tpl_vars['ldelim']; ?>

	$(function() <?php echo $this->_tpl_vars['ldelim']; ?>

		$('#<?php echo $this->_tpl_vars['date_id']; ?>
').datepicker(calendar_config);
	<?php echo $this->_tpl_vars['rdelim']; ?>
);
<?php echo $this->_tpl_vars['rdelim']; ?>



//]]>
</script><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
</div>

<div class="form-field">
	<label for="date_avail_holder"><?php echo fn_get_lang_var('available_since', $this->getLanguage()); ?>
:</label>
	<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('date_id' => 'date_avail_holder', 'date_name' => "product_data[avail_since]", 'date_val' => smarty_modifier_default(@$this->_tpl_vars['product_data']['avail_since'], ""), 'start_year' => $this->_tpl_vars['settings']['Company']['company_start_year'], )); ?><?php if ($this->_tpl_vars['settings']['Appearance']['calendar_date_format'] == 'month_first'): ?>
	<?php $this->assign('date_format', "%m/%d/%Y", false); ?>
<?php else: ?>
	<?php $this->assign('date_format', "%d/%m/%Y", false); ?>
<?php endif; ?>

<input type="text" id="<?php echo $this->_tpl_vars['date_id']; ?>
" name="<?php echo $this->_tpl_vars['date_name']; ?>
" class="input-text<?php if ($this->_tpl_vars['date_meta']): ?> <?php echo $this->_tpl_vars['date_meta']; ?>
<?php endif; ?> cm-calendar" value="<?php if ($this->_tpl_vars['date_val']): ?><?php echo smarty_modifier_date_format(fn_parse_date($this->_tpl_vars['date_val']), ($this->_tpl_vars['date_format'])); ?>
<?php endif; ?>" <?php echo $this->_tpl_vars['extra']; ?>
 size="10" />&nbsp;<img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/calendar.png" class="cm-external-focus calendar-but" rev="<?php echo $this->_tpl_vars['date_id']; ?>
" title="<?php echo fn_get_lang_var('calendar', $this->getLanguage()); ?>
" alt="<?php echo fn_get_lang_var('calendar', $this->getLanguage()); ?>
" />

<script type="text/javascript">
//<![CDATA[

var calendar_config = <?php echo $this->_tpl_vars['ldelim']; ?>
<?php echo $this->_tpl_vars['rdelim']; ?>
;
calendar_config = <?php echo $this->_tpl_vars['ldelim']; ?>

			changeMonth: true,
			duration: 'fast',
			changeYear: true,
			numberOfMonths: 1,
			selectOtherMonths: true,
			showOtherMonths: true,
			firstDay: <?php if ($this->_tpl_vars['settings']['Appearance']['calendar_week_format'] == 'sunday_first'): ?>0<?php else: ?>1<?php endif; ?>,
			dayNamesMin: ['<?php echo fn_get_lang_var('weekday_abr_0', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_1', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_2', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_3', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_4', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_5', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_6', $this->getLanguage()); ?>
'],
			monthNamesShort: ['<?php echo fn_get_lang_var('month_name_abr_1', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_2', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_3', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_4', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_5', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_6', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_7', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_8', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_9', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_10', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_11', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_12', $this->getLanguage()); ?>
'],
			yearRange: '<?php echo smarty_modifier_default(@$this->_tpl_vars['start_year'], @$this->_tpl_vars['settings']['Company']['company_start_year']); ?>
:<?php echo smarty_function_math(array('equation' => "x+y",'x' => smarty_modifier_default(@$this->_tpl_vars['end_year'], 1),'y' => smarty_modifier_date_format(@TIME, "%Y")), $this);?>
',
			dateFormat: '<?php if ($this->_tpl_vars['settings']['Appearance']['calendar_date_format'] == 'month_first'): ?>mm/dd/yy<?php else: ?>dd/mm/yy<?php endif; ?>'
		<?php echo $this->_tpl_vars['rdelim']; ?>
;

if ($.ua.browser == 'Internet Explorer') <?php echo $this->_tpl_vars['ldelim']; ?>

	$(window).load(function()<?php echo $this->_tpl_vars['ldelim']; ?>

		$('#<?php echo $this->_tpl_vars['date_id']; ?>
').datepicker(calendar_config);
	<?php echo $this->_tpl_vars['rdelim']; ?>
);
<?php echo $this->_tpl_vars['rdelim']; ?>
 else <?php echo $this->_tpl_vars['ldelim']; ?>

	$(function() <?php echo $this->_tpl_vars['ldelim']; ?>

		$('#<?php echo $this->_tpl_vars['date_id']; ?>
').datepicker(calendar_config);
	<?php echo $this->_tpl_vars['rdelim']; ?>
);
<?php echo $this->_tpl_vars['rdelim']; ?>



//]]>
</script><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
</div>

<div class="form-field">
	<label for="out_of_stock_actions"><?php echo fn_get_lang_var('out_of_stock_actions', $this->getLanguage()); ?>
<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('tooltip' => fn_get_lang_var('tt_views_products_update_out_of_stock_actions', $this->getLanguage()), )); ?><?php if ($this->_tpl_vars['tooltip']): ?> (<a class="cm-tooltip<?php if ($this->_tpl_vars['params']): ?> <?php echo $this->_tpl_vars['params']; ?>
<?php endif; ?>" title="<?php echo smarty_modifier_escape($this->_tpl_vars['tooltip'], 'html'); ?>
">?</a>)<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>:</label>
	<select name="product_data[out_of_stock_actions]" id="product_out_of_stock_actions">
		<option value="N" <?php if ($this->_tpl_vars['product_data']['out_of_stock_actions'] == 'N'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('none', $this->getLanguage()); ?>
</option>
		<option value="B" <?php if ($this->_tpl_vars['product_data']['out_of_stock_actions'] == 'B'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('buy_in_advance', $this->getLanguage()); ?>
</option>
		<option value="S" <?php if ($this->_tpl_vars['product_data']['out_of_stock_actions'] == 'S'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('sign_up_for_notification', $this->getLanguage()); ?>
</option>
	</select>
</div>
</fieldset>

<fieldset>

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('extra', $this->getLanguage()))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="form-field">
	<label for="details_layout"><?php echo fn_get_lang_var('product_details_layout', $this->getLanguage()); ?>
<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('tooltip' => fn_get_lang_var('tt_views_products_update_product_details_layout', $this->getLanguage()), )); ?><?php if ($this->_tpl_vars['tooltip']): ?> (<a class="cm-tooltip<?php if ($this->_tpl_vars['params']): ?> <?php echo $this->_tpl_vars['params']; ?>
<?php endif; ?>" title="<?php echo smarty_modifier_escape($this->_tpl_vars['tooltip'], 'html'); ?>
">?</a>)<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>:</label>
	<select id="details_layout" name="product_data[details_layout]">
		<?php $_from = fn_get_product_details_views($this->_tpl_vars['id']); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['layout'] => $this->_tpl_vars['item']):
?>
			<option <?php if ($this->_tpl_vars['product_data']['details_layout'] == $this->_tpl_vars['layout']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['layout']; ?>
"><?php echo $this->_tpl_vars['item']; ?>
</option>
		<?php endforeach; endif; unset($_from); ?>
	</select>
</div>

<div class="form-field">
	<label for="product_feature_comparison"><?php echo fn_get_lang_var('feature_comparison', $this->getLanguage()); ?>
:</label>
	<input type="hidden" name="product_data[feature_comparison]" value="N" />
	<input type="checkbox" name="product_data[feature_comparison]" id="product_feature_comparison" value="Y" <?php if ($this->_tpl_vars['product_data']['feature_comparison'] == 'Y'): ?>checked="checked"<?php endif; ?> class="checkbox" />
</div>

<div class="form-field">
	<label for="product_is_edp"><?php echo fn_get_lang_var('downloadable', $this->getLanguage()); ?>
:</label>
	<input type="hidden" name="product_data[is_edp]" value="N" />
	<input type="checkbox" name="product_data[is_edp]" id="product_is_edp" value="Y" <?php if ($this->_tpl_vars['product_data']['is_edp'] == 'Y'): ?>checked="checked"<?php endif; ?> onclick="$('#edp_shipping').toggleBy(); $('#edp_unlimited').toggleBy();" class="checkbox" />
</div>

<div class="form-field <?php if ($this->_tpl_vars['product_data']['is_edp'] != 'Y'): ?>hidden<?php endif; ?>" id="edp_shipping">
	<label for="product_edp_shipping"><?php echo fn_get_lang_var('edp_enable_shipping', $this->getLanguage()); ?>
:</label>
	<input type="hidden" name="product_data[edp_shipping]" value="N" />
	<input type="checkbox" name="product_data[edp_shipping]" id="product_edp_shipping" value="Y" <?php if ($this->_tpl_vars['product_data']['edp_shipping'] == 'Y'): ?>checked="checked"<?php endif; ?> class="checkbox" />
</div>

<div class="form-field <?php if ($this->_tpl_vars['product_data']['is_edp'] != 'Y'): ?>hidden<?php endif; ?>" id="edp_unlimited">
	<label for="product_edp_unlimited"><?php echo fn_get_lang_var('time_unlimited_download', $this->getLanguage()); ?>
:</label>
	<input type="hidden" name="product_data[unlimited_download]" value="N" />
	<input type="checkbox" name="product_data[unlimited_download]" id="product_edp_unlimited" value="Y" <?php if ($this->_tpl_vars['product_data']['unlimited_download'] == 'Y'): ?>checked="checked"<?php endif; ?> class="checkbox" />
</div>

<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('data_from' => $this->_tpl_vars['product_data']['localization'], 'data_name' => "product_data[localization]", )); ?>
<?php $this->assign('data', fn_explode_localizations($this->_tpl_vars['data_from']), false); ?>

<?php if ($this->_tpl_vars['localizations']): ?>
<?php if (! $this->_tpl_vars['no_div']): ?>
<div class="form-field">
	<label for="<?php echo $this->_tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('localization', $this->getLanguage()); ?>
:</label>
<?php endif; ?>
		<?php if (! $this->_tpl_vars['disabled']): ?><input type="hidden" name="<?php echo $this->_tpl_vars['data_name']; ?>
" value="" /><?php endif; ?>
		<select	name="<?php echo $this->_tpl_vars['data_name']; ?>
[]" multiple="multiple" size="3" id="<?php echo smarty_modifier_default(@$this->_tpl_vars['id'], @$this->_tpl_vars['data_name']); ?>
" class="<?php if ($this->_tpl_vars['disabled']): ?>elm-disabled<?php else: ?>input-text<?php endif; ?>" <?php if ($this->_tpl_vars['disabled']): ?>disabled="disabled"<?php endif; ?>>
			<?php $_from = $this->_tpl_vars['localizations']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['loc']):
?>
			<option	value="<?php echo $this->_tpl_vars['loc']['localization_id']; ?>
" <?php $_from = $this->_tpl_vars['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['p_loc']):
?><?php if ($this->_tpl_vars['p_loc'] == $this->_tpl_vars['loc']['localization_id']): ?>selected="selected"<?php endif; ?><?php endforeach; endif; unset($_from); ?>><?php echo smarty_modifier_escape($this->_tpl_vars['loc']['localization']); ?>
</option>
			<?php endforeach; endif; unset($_from); ?>
		</select>
<?php if (! $this->_tpl_vars['no_div']): ?>
<?php echo fn_get_lang_var('multiple_selectbox_notice', $this->getLanguage()); ?>

</div>
<?php endif; ?>
<?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>

<div class="form-field <?php echo $this->_tpl_vars['no_hide_input_if_shared_product']; ?>
">
	<label for="product_short_descr"><?php echo fn_get_lang_var('short_description', $this->getLanguage()); ?>
:</label>
	<textarea id="product_short_descr" name="product_data[short_description]" cols="55" rows="2" class="cm-wysiwyg input-textarea-long"><?php echo $this->_tpl_vars['product_data']['short_description']; ?>
</textarea>
	<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('display' => $this->_tpl_vars['show_update_for_all'], 'object_id' => 'short_description', 'name' => "update_all_vendors[short_description]", )); ?><?php if ($this->_tpl_vars['display']): ?>
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
</div>

<div class="form-field">
	<label for="product_popularity"><?php echo fn_get_lang_var('popularity', $this->getLanguage()); ?>
<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('tooltip' => fn_get_lang_var('ttc_popularity', $this->getLanguage()), )); ?><?php if ($this->_tpl_vars['tooltip']): ?> (<a class="cm-tooltip<?php if ($this->_tpl_vars['params']): ?> <?php echo $this->_tpl_vars['params']; ?>
<?php endif; ?>" title="<?php echo smarty_modifier_escape($this->_tpl_vars['tooltip'], 'html'); ?>
">?</a>)<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>:</label>
	<input type="text" name="product_data[popularity]" id="product_popularity" size="55" value="<?php echo smarty_modifier_default(@$this->_tpl_vars['product_data']['popularity'], 0); ?>
" class="input-text-medium" />
</div>

<div class="form-field <?php echo $this->_tpl_vars['no_hide_input_if_shared_product']; ?>
">
	<label for="product_search_words"><?php echo fn_get_lang_var('search_words', $this->getLanguage()); ?>
:</label>
	<textarea name="product_data[search_words]" id="product_search_words" cols="55" rows="2" class="input-textarea-long"><?php echo $this->_tpl_vars['product_data']['search_words']; ?>
</textarea>
	<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('display' => $this->_tpl_vars['show_update_for_all'], 'object_id' => 'search_words', 'name' => "update_all_vendors[search_words]", )); ?><?php if ($this->_tpl_vars['display']): ?>
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
</div>
</fieldset>
<!--content_detailed--></div> 

<div id="content_images" class="hidden"> <fieldset>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('additional_images', $this->getLanguage()))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php if ($this->_tpl_vars['product_data']['image_pairs']): ?>
	<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('sortable_id' => 'additional_images', 'sortable_table' => 'images_links', 'sortable_id_name' => 'pair_id', 'handle_class' => "cm-sortable-handle", )); ?><script type="text/javascript">
//<![CDATA[
$(function() <?php echo $this->_tpl_vars['ldelim']; ?>

	var params = <?php echo $this->_tpl_vars['ldelim']; ?>
<?php echo $this->_tpl_vars['rdelim']; ?>
;
		params.text_position_updating = '<?php echo fn_get_lang_var('text_position_updating', $this->getLanguage()); ?>
';
		params.update_sortable_url = '<?php echo fn_url("tools.update_position?table=".($this->_tpl_vars['sortable_table'])."&id_name=".($this->_tpl_vars['sortable_id_name']), 'A', 'rel', '&'); ?>
';
		params.handle_class = '<?php echo $this->_tpl_vars['handle_class']; ?>
';

	var sortable_id = '<?php if ($this->_tpl_vars['sortable_id']): ?>#<?php echo $this->_tpl_vars['sortable_id']; ?>
<?php else: ?><?php endif; ?>';
	
	$(sortable_id + '.cm-sortable').ceSortable(params);
<?php echo $this->_tpl_vars['rdelim']; ?>
);

//]]>
</script><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	<div class="cm-sortable" id="additional_images">
	<?php $this->assign('new_image_position', '0', false); ?>
	<?php $_from = $this->_tpl_vars['product_data']['image_pairs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['detailed_images'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['detailed_images']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['pair']):
        $this->_foreach['detailed_images']['iteration']++;
?>
		<div class="cm-row-item cm-sortable-id-<?php echo $this->_tpl_vars['pair']['pair_id']; ?>
 cm-sortable-box">
			<div class="cm-sortable-handle sortable-bar"><img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/icon_sort_bar.gif" width="26" height="25" border="0" title="<?php echo fn_get_lang_var('sort_images', $this->getLanguage()); ?>
" alt="<?php echo fn_get_lang_var('sort', $this->getLanguage()); ?>
" class="valign" /></div>
			<div class="sortable-item">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/attach_images.tpl", 'smarty_include_vars' => array('image_name' => 'product_additional','image_object_type' => 'product','image_key' => $this->_tpl_vars['pair']['pair_id'],'image_type' => 'A','image_pair' => $this->_tpl_vars['pair'],'icon_title' => fn_get_lang_var('additional_thumbnail', $this->getLanguage()),'detailed_title' => fn_get_lang_var('additional_popup_larger_image', $this->getLanguage()),'icon_text' => fn_get_lang_var('text_additional_thumbnail', $this->getLanguage()),'detailed_text' => fn_get_lang_var('text_additional_detailed_image', $this->getLanguage()),'delete_pair' => true,'no_thumbnail' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</div>
			<div class="clear"></div>
		</div>
		<?php if ($this->_tpl_vars['new_image_position'] <= $this->_tpl_vars['pair']['position']): ?>
			<?php $this->assign('new_image_position', $this->_tpl_vars['pair']['position'], false); ?>
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	</div>
	<?php endif; ?>

</fieldset>

<div id="box_new_image" class="margin-top">
	<div class="clear cm-row-item">
		<input type="hidden" name="product_add_additional_image_data[][position]" value="<?php echo $this->_tpl_vars['new_image_position']; ?>
" class="cm-image-field" />
		<div class="float-left"><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/attach_images.tpl", 'smarty_include_vars' => array('image_name' => 'product_add_additional','image_object_type' => 'product','image_type' => 'A','icon_title' => fn_get_lang_var('additional_thumbnail', $this->getLanguage()),'detailed_title' => fn_get_lang_var('additional_popup_larger_image', $this->getLanguage()),'icon_text' => fn_get_lang_var('text_additional_thumbnail', $this->getLanguage()),'detailed_text' => fn_get_lang_var('text_additional_detailed_image', $this->getLanguage()),'no_thumbnail' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
		<div class="buttons-container"><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/multiple_buttons.tpl", 'smarty_include_vars' => array('item_id' => 'new_image')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
	</div>
	<hr />
</div>

</div> 
<div id="content_shippings" class="hidden"> 	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/products/components/products_shipping_settings.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div> 
<?php $this->_tag_stack[] = array('hook', array('name' => "products:update_qty_discounts")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/products/components/products_update_qty_discounts.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/products/components/products_update_features.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


<div id="content_addons">
<?php $this->_tag_stack[] = array('hook', array('name' => "products:detailed_content")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<?php if ($this->_tpl_vars['addons']['bundled_products']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/bundled_products/hooks/products/detailed_content.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['product_configurator']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/product_configurator/hooks/products/detailed_content.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['rma']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/rma/hooks/products/detailed_content.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['seo']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/seo/hooks/products/detailed_content.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['bestsellers']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/bestsellers/hooks/products/detailed_content.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['age_verification']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/age_verification/hooks/products/detailed_content.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['discussion']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/discussion/hooks/products/detailed_content.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
</div>


<?php $this->_tag_stack[] = array('hook', array('name' => "products:tabs_content")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<?php if ($this->_tpl_vars['addons']['tags']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/tags/hooks/products/tabs_content.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['reward_points']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/reward_points/hooks/products/tabs_content.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['required_products']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/required_products/hooks/products/tabs_content.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>


<div class="buttons-container cm-toggle-button buttons-bg">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[products.update]")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>

</form> 
<?php $this->_tag_stack[] = array('hook', array('name' => "products:tabs_extra")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if ($this->_tpl_vars['addons']['bundled_products']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/bundled_products/hooks/products/tabs_extra.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['product_configurator']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/product_configurator/hooks/products/tabs_extra.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['attachments']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/attachments/hooks/products/tabs_extra.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['discussion']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/discussion/hooks/products/tabs_extra.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<?php if ($this->_tpl_vars['id']): ?>
<div class="cm-hide-save-button hidden" id="content_options">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/products/components/products_update_options.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>

<div id="content_files" class="cm-hide-save-button hidden">
	<?php $this->_tag_stack[] = array('hook', array('name' => "products:content_files")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/products/components/products_update_files.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
</div>

<div id="content_subscribers" class="cm-hide-save-button hidden">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/products/components/product_subscribers.tpl", 'smarty_include_vars' => array('product_id' => $this->_tpl_vars['id'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<?php endif; ?>

<?php $this->_smarty_vars['capture']['tabsbox'] = ob_get_contents(); ob_end_clean(); ?>
<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('content' => $this->_smarty_vars['capture']['tabsbox'], 'group_name' => $this->_tpl_vars['controller'], 'active_tab' => $this->_tpl_vars['_REQUEST']['selected_section'], 'track' => true, )); ?><?php echo smarty_function_script(array('src' => "js/tabs.js"), $this);?>


<?php if (! $this->_tpl_vars['active_tab']): ?>
	<?php $this->assign('active_tab', $this->_tpl_vars['_REQUEST']['selected_section'], false); ?>
<?php endif; ?>

<?php $this->assign('empty_tab_ids', smarty_modifier_empty_tabs($this->_tpl_vars['content']), false); ?>

<?php if ($this->_tpl_vars['navigation']['tabs']): ?>
<div class="tabs cm-j-tabs<?php if ($this->_tpl_vars['track']): ?> cm-track<?php endif; ?>">
	<ul>
	<?php $_from = $this->_tpl_vars['navigation']['tabs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['tabs'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['tabs']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['tab']):
        $this->_foreach['tabs']['iteration']++;
?>
		<?php if (( ! $this->_tpl_vars['tabs_section'] || $this->_tpl_vars['tabs_section'] == $this->_tpl_vars['tab']['section'] ) && ( $this->_tpl_vars['tab']['hidden'] || ! smarty_modifier_in_array($this->_tpl_vars['key'], $this->_tpl_vars['empty_tab_ids']) )): ?>
		<li id="<?php echo $this->_tpl_vars['key']; ?>
<?php echo $this->_tpl_vars['id_suffix']; ?>
" class="<?php if ($this->_tpl_vars['tab']['hidden'] == 'Y'): ?>hidden <?php endif; ?><?php if ($this->_tpl_vars['tab']['js']): ?>cm-js<?php elseif ($this->_tpl_vars['tab']['ajax']): ?>cm-js cm-ajax<?php endif; ?><?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['active_tab']): ?> cm-active<?php endif; ?>"><a <?php if ($this->_tpl_vars['tab']['href']): ?>href="<?php echo fn_url($this->_tpl_vars['tab']['href']); ?>
"<?php endif; ?>><?php echo $this->_tpl_vars['tab']['title']; ?>
</a><?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['active_tab']): ?><?php echo $this->_tpl_vars['active_tab_extra']; ?>
<?php endif; ?></li>
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	</ul>
</div>
<div class="cm-tabs-content">
	<?php echo $this->_tpl_vars['content']; ?>

</div>
<?php else: ?>
	<?php echo $this->_tpl_vars['content']; ?>

<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>

<?php $this->_smarty_vars['capture']['mainbox'] = ob_get_contents(); ob_end_clean(); ?>
<?php if (! $this->_tpl_vars['id']): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('new_product', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['mainbox'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php else: ?>
	<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('url' => "products.update?product_id=", )); ?><?php ob_start(); ?>
	<div class="float-right next-prev">
		<?php if ($this->_tpl_vars['prev_id']): ?>
			<?php if ($this->_tpl_vars['links_label']): ?>
			<a href="<?php echo fn_url(($this->_tpl_vars['url']).($this->_tpl_vars['prev_id'])); ?>
">&laquo;&nbsp;<?php echo $this->_tpl_vars['links_label']; ?>
&nbsp;<?php if ($this->_tpl_vars['show_item_id']): ?>#<?php echo $this->_tpl_vars['prev_id']; ?>
<?php endif; ?></a>&nbsp;&nbsp;&nbsp;
			<?php else: ?>
			<a class="lowercase" href="<?php echo fn_url(($this->_tpl_vars['url']).($this->_tpl_vars['prev_id'])); ?>
">&laquo;&nbsp;<?php echo fn_get_lang_var('previous', $this->getLanguage()); ?>
</a>&nbsp;&nbsp;&nbsp;
			<?php endif; ?>
		<?php endif; ?>

		<?php if ($this->_tpl_vars['next_id']): ?>
			<?php if ($this->_tpl_vars['links_label']): ?>
			<a href="<?php echo fn_url(($this->_tpl_vars['url']).($this->_tpl_vars['next_id'])); ?>
"><?php echo $this->_tpl_vars['links_label']; ?>
&nbsp;<?php if ($this->_tpl_vars['show_item_id']): ?>#<?php echo $this->_tpl_vars['next_id']; ?>
<?php endif; ?>&nbsp;&raquo;</a>
			<?php else: ?>
			<a class="lowercase" href="<?php echo fn_url(($this->_tpl_vars['url']).($this->_tpl_vars['next_id'])); ?>
"><?php echo fn_get_lang_var('next', $this->getLanguage()); ?>
&nbsp;&raquo;</a>
			<?php endif; ?>
			
		<?php endif; ?>
	</div>
<?php $this->_smarty_vars['capture']['view_tools'] = ob_get_contents(); ob_end_clean(); ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	
	<?php ob_start(); ?>
		
		<?php $this->assign('view_uri', "products.view?product_id=".($this->_tpl_vars['id']), false); ?>
		<?php $this->assign('view_uri_escaped', smarty_modifier_escape(fn_url(($this->_tpl_vars['view_uri'])."&amp;action=preview", 'C', 'http', '&', @DESCR_SL), 'url'), false); ?>
		
		

		<a target="_blank" class="tool-link" title="<?php echo fn_url($this->_tpl_vars['view_uri'], 'C', 'http', '&', @DESCR_SL); ?>
" href="<?php echo fn_url($this->_tpl_vars['view_uri'], 'C', 'http', '&', @DESCR_SL); ?>
"><?php echo fn_get_lang_var('preview', $this->getLanguage()); ?>
</a>
		<a target="_blank" class="tool-link" title="<?php echo fn_url($this->_tpl_vars['view_uri'], 'C', 'http', '&', @DESCR_SL); ?>
" href="<?php echo fn_url("profiles.act_as_user?user_id=".($this->_tpl_vars['auth']['user_id'])."&amp;area=C&amp;redirect_url=".($this->_tpl_vars['view_uri_escaped'])); ?>
"><?php echo fn_get_lang_var('preview_as_admin', $this->getLanguage()); ?>
</a>
	<?php $this->_smarty_vars['capture']['preview'] = ob_get_contents(); ob_end_clean(); ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('title' => smarty_modifier_strip_tags(smarty_modifier_unescape((fn_get_lang_var('editing_product', $this->getLanguage())).":&nbsp;".($this->_tpl_vars['product_data']['product']))),'content' => $this->_smarty_vars['capture']['mainbox'],'select_languages' => true,'tools' => $this->_smarty_vars['capture']['view_tools'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>