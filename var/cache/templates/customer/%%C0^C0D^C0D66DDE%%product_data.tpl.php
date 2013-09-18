<?php /* Smarty version 2.6.18, created on 2013-09-16 17:11:14
         compiled from common_templates/product_data.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_get_product_features_list', 'common_templates/product_data.tpl', 1, false),array('modifier', 'escape', 'common_templates/product_data.tpl', 1, false),array('modifier', 'default', 'common_templates/product_data.tpl', 1, false),array('modifier', 'floatval', 'common_templates/product_data.tpl', 17, false),array('modifier', 'fn_url', 'common_templates/product_data.tpl', 30, false),array('modifier', 'unescape', 'common_templates/product_data.tpl', 46, false),array('modifier', 'strip_tags', 'common_templates/product_data.tpl', 48, false),array('modifier', 'truncate', 'common_templates/product_data.tpl', 48, false),array('modifier', 'trim', 'common_templates/product_data.tpl', 88, false),array('modifier', 'replace', 'common_templates/product_data.tpl', 119, false),array('modifier', 'date_format', 'common_templates/product_data.tpl', 192, false),array('modifier', 'strlen', 'common_templates/product_data.tpl', 371, false),array('modifier', 'format_price', 'common_templates/product_data.tpl', 390, false),array('modifier', 'reset', 'common_templates/product_data.tpl', 440, false),array('modifier', 'fn_get_company_name', 'common_templates/product_data.tpl', 601, false),array('modifier', 'fn_generate_thumbnail', 'common_templates/product_data.tpl', 797, false),array('modifier', 'fn_convert_relative_to_absolute_image_url', 'common_templates/product_data.tpl', 800, false),array('block', 'hook', 'common_templates/product_data.tpl', 72, false),array('function', 'math', 'common_templates/product_data.tpl', 715, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('sku','select_options','delete','view_details','delete','product_coming_soon','product_coming_soon_add','product_coming_soon','product_coming_soon_add','text_out_of_stock','notify_when_back_in_stock','email','enter_email','enter_email','go','go','product_coming_soon','product_coming_soon_add','view_details','delete','more','old_price','list_price','enter_your_price','contact_us_for_price','sign_in_to_view_price','inc_tax','including_tax','you_save','you_save','in_stock','items','text_out_of_stock','in_stock','text_out_of_stock','vendor','supplier','bought','qty','text_cart_min_qty','text_edp_product','view_larger_image'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/image.tpl' => 1367063745,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?>
<?php if (( floatval($this->_tpl_vars['product']['price']) || $this->_tpl_vars['product']['zero_price_action'] == 'P' || $this->_tpl_vars['product']['zero_price_action'] == 'A' || ( ! floatval($this->_tpl_vars['product']['price']) && $this->_tpl_vars['product']['zero_price_action'] == 'R' ) ) && ! ( $this->_tpl_vars['settings']['General']['allow_anonymous_shopping'] == 'P' && ! $this->_tpl_vars['auth']['user_id'] )): ?>
	<?php $this->assign('show_price_values', true, false); ?>
<?php else: ?>
	<?php $this->assign('show_price_values', false, false); ?>
<?php endif; ?>
<?php ob_start(); ?><?php echo $this->_tpl_vars['show_price_values']; ?>
<?php $this->_smarty_vars['capture']['show_price_values'] = ob_get_contents(); ob_end_clean(); ?>

<?php $this->assign('cart_button_exists', false, false); ?>
<?php $this->assign('obj_id', smarty_modifier_default(@$this->_tpl_vars['obj_id'], @$this->_tpl_vars['product']['product_id']), false); ?>
<?php $this->assign('product_amount', smarty_modifier_default(@$this->_tpl_vars['product']['inventory_amount'], @$this->_tpl_vars['product']['amount']), false); ?>

<?php ob_start(); ?>
<?php if (! $this->_tpl_vars['hide_form']): ?>
<form action="<?php echo fn_url(""); ?>
" method="post" name="product_form_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
" enctype="multipart/form-data" class="cm-disable-empty-files cm-required-form<?php if ($this->_tpl_vars['settings']['DHTML']['ajax_add_to_cart'] == 'Y' && ! $this->_tpl_vars['no_ajax']): ?> cm-ajax cm-ajax-full-render<?php endif; ?>">
<input type="hidden" name="redirect_url" value="<?php echo $this->_tpl_vars['config']['current_url']; ?>
" />
<input type="hidden" name="result_ids" value="cart_status*,wish_list*,account_info*" />
<?php if (! $this->_tpl_vars['stay_in_cart']): ?>
<input type="hidden" name="redirect_url" value="<?php echo smarty_modifier_default(@$this->_tpl_vars['redirect_url'], @$this->_tpl_vars['config']['current_url']); ?>
" />
<?php endif; ?>
<input type="hidden" name="product_data[<?php echo $this->_tpl_vars['obj_id']; ?>
][product_id]" value="<?php echo $this->_tpl_vars['product']['product_id']; ?>
" />
<?php endif; ?>
<?php $this->_smarty_vars['capture']["form_open_".($this->_tpl_vars['obj_id'])] = ob_get_contents(); ob_end_clean(); ?>
<?php if ($this->_tpl_vars['no_capture']): ?>
	<?php $this->assign('capture_name', "form_open_".($this->_tpl_vars['obj_id']), false); ?>
	<?php echo $this->_smarty_vars['capture'][$this->_tpl_vars['capture_name']]; ?>

<?php endif; ?>

<?php ob_start(); ?>
	<?php if ($this->_tpl_vars['show_name']): ?>
		<?php if ($this->_tpl_vars['hide_links']): ?><strong><?php else: ?><a href="<?php echo fn_url("products.view?product_id=".($this->_tpl_vars['product']['product_id'])); ?>
" class="product-title"><?php endif; ?><?php echo smarty_modifier_unescape($this->_tpl_vars['product']['product']); ?>
<?php if ($this->_tpl_vars['hide_links']): ?></strong><?php else: ?></a><?php endif; ?>
	<?php elseif ($this->_tpl_vars['show_trunc_name']): ?>
		<?php if ($this->_tpl_vars['hide_links']): ?><strong><?php else: ?><a href="<?php echo fn_url("products.view?product_id=".($this->_tpl_vars['product']['product_id'])); ?>
" class="product-title" title="<?php echo smarty_modifier_strip_tags($this->_tpl_vars['product']['product']); ?>
"><?php endif; ?><?php echo smarty_modifier_truncate(smarty_modifier_unescape($this->_tpl_vars['product']['product']), 45, "...", true); ?>
<?php if ($this->_tpl_vars['hide_links']): ?></strong><?php else: ?></a><?php endif; ?>
	<?php endif; ?>
<?php $this->_smarty_vars['capture']["name_".($this->_tpl_vars['obj_id'])] = ob_get_contents(); ob_end_clean(); ?>
<?php if ($this->_tpl_vars['no_capture']): ?>
	<?php $this->assign('capture_name', "name_".($this->_tpl_vars['obj_id']), false); ?>
	<?php echo $this->_smarty_vars['capture'][$this->_tpl_vars['capture_name']]; ?>

<?php endif; ?>

<?php ob_start(); ?>
	<?php if ($this->_tpl_vars['show_sku']): ?>
		<p class="sku<?php if (! $this->_tpl_vars['product']['product_code']): ?> hidden<?php endif; ?>">
			<span class="cm-reload-<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
" id="sku_update_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
">
				<input type="hidden" name="appearance[show_sku]" value="<?php echo $this->_tpl_vars['show_sku']; ?>
" />
				<span id="sku_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
"><?php echo fn_get_lang_var('sku', $this->getLanguage()); ?>
: <span id="product_code_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
"><?php echo $this->_tpl_vars['product']['product_code']; ?>
</span></span>
			<!--sku_update_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
--></span>
		</p>
	<?php endif; ?>
<?php $this->_smarty_vars['capture']["sku_".($this->_tpl_vars['obj_id'])] = ob_get_contents(); ob_end_clean(); ?>
<?php if ($this->_tpl_vars['no_capture']): ?>
	<?php $this->assign('capture_name', "sku_".($this->_tpl_vars['obj_id']), false); ?>
	<?php echo $this->_smarty_vars['capture'][$this->_tpl_vars['capture_name']]; ?>

<?php endif; ?>

<?php ob_start(); ?>
	<?php $this->_tag_stack[] = array('hook', array('name' => "products:data_block")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if ($this->_tpl_vars['addons']['discussion']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/discussion/hooks/products/data_block.pre.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?>
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php $this->_smarty_vars['capture']["rating_".($this->_tpl_vars['obj_id'])] = ob_get_contents(); ob_end_clean(); ?>
<?php if ($this->_tpl_vars['no_capture']): ?>
	<?php $this->assign('capture_name', "rating_".($this->_tpl_vars['obj_id']), false); ?>
	<?php echo $this->_smarty_vars['capture'][$this->_tpl_vars['capture_name']]; ?>

<?php endif; ?>

<?php ob_start(); ?>
<?php if ($this->_tpl_vars['show_add_to_cart']): ?>
<div class="cm-reload-<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
 <?php echo $this->_tpl_vars['add_to_cart_class']; ?>
 <?php if ($this->_tpl_vars['quick_view']): ?>cm-ajax-reload-dialog<?php endif; ?>" id="add_to_cart_update_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
">
<input type="hidden" name="appearance[show_add_to_cart]" value="<?php echo $this->_tpl_vars['show_add_to_cart']; ?>
" />
<input type="hidden" name="appearance[separate_buttons]" value="<?php echo $this->_tpl_vars['separate_buttons']; ?>
" />
<input type="hidden" name="appearance[show_list_buttons]" value="<?php echo $this->_tpl_vars['show_list_buttons']; ?>
" />
<input type="hidden" name="appearance[but_role]" value="<?php echo $this->_tpl_vars['but_role']; ?>
" />
<input type="hidden" name="appearance[quick_view]" value="<?php echo $this->_tpl_vars['quick_view']; ?>
" />
<?php if ($this->_tpl_vars['addons']['product_configurator']['status'] == 'A'): ?><?php ob_start(); $this->_in_capture[] = '8bafe07ab63b336ab024574d533dd40e';
$_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/product_configurator/hooks/products/buttons_block.override.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
$this->_tpl_vars['addon_content'] = ob_get_contents(); ob_end_clean(); array_pop($this->_in_capture); if (!empty($this->_scripts['8bafe07ab63b336ab024574d533dd40e'])) { echo implode("\n", $this->_scripts['8bafe07ab63b336ab024574d533dd40e']); unset($this->_scripts['8bafe07ab63b336ab024574d533dd40e']); }
 ?><?php else: ?><?php $this->assign('addon_content', "", false); ?><?php endif; ?><?php if (trim($this->_tpl_vars['addon_content'])): ?><?php echo $this->_tpl_vars['addon_content']; ?>
<?php else: ?><?php if ($this->_tpl_vars['addons']['bundled_products']['status'] == 'A'): ?><?php ob_start(); $this->_in_capture[] = 'd44e82db4e648a717fb54217c0aa5151';
$_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/bundled_products/hooks/products/buttons_block.override.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
$this->_tpl_vars['addon_content'] = ob_get_contents(); ob_end_clean(); array_pop($this->_in_capture); if (!empty($this->_scripts['d44e82db4e648a717fb54217c0aa5151'])) { echo implode("\n", $this->_scripts['d44e82db4e648a717fb54217c0aa5151']); unset($this->_scripts['d44e82db4e648a717fb54217c0aa5151']); }
 ?><?php else: ?><?php $this->assign('addon_content', "", false); ?><?php endif; ?><?php if (trim($this->_tpl_vars['addon_content'])): ?><?php echo $this->_tpl_vars['addon_content']; ?>
<?php else: ?><?php $this->_tag_stack[] = array('hook', array('name' => "products:buttons_block")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<?php if (! ( $this->_tpl_vars['product']['zero_price_action'] == 'R' && $this->_tpl_vars['product']['price'] == 0 ) && ! ( $this->_tpl_vars['settings']['General']['inventory_tracking'] == 'Y' && $this->_tpl_vars['settings']['General']['allow_negative_amount'] != 'Y' && ( ( $this->_tpl_vars['product_amount'] <= 0 || $this->_tpl_vars['product_amount'] < $this->_tpl_vars['product']['min_qty'] ) && $this->_tpl_vars['product']['tracking'] != 'D' ) && $this->_tpl_vars['product']['is_edp'] != 'Y' ) || ( $this->_tpl_vars['product']['has_options'] && ! $this->_tpl_vars['show_product_options'] )): ?>
		<<?php if ($this->_tpl_vars['separate_buttons']): ?>div class="buttons-container"<?php else: ?>span<?php endif; ?> id="cart_add_block_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
">
			<?php if ($this->_tpl_vars['product']['avail_since'] <= @TIME || ( $this->_tpl_vars['product']['avail_since'] > @TIME && $this->_tpl_vars['product']['out_of_stock_actions'] == 'B' )): ?>
				<?php if ($this->_tpl_vars['addons']['recurring_billing']['status'] == 'A'): ?><?php ob_start(); $this->_in_capture[] = '3873156d53acf01e8b9c41d836c88da9';
$_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/recurring_billing/hooks/products/add_to_cart.override.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
$this->_tpl_vars['addon_content'] = ob_get_contents(); ob_end_clean(); array_pop($this->_in_capture); if (!empty($this->_scripts['3873156d53acf01e8b9c41d836c88da9'])) { echo implode("\n", $this->_scripts['3873156d53acf01e8b9c41d836c88da9']); unset($this->_scripts['3873156d53acf01e8b9c41d836c88da9']); }
 ?><?php else: ?><?php $this->assign('addon_content', "", false); ?><?php endif; ?><?php if (trim($this->_tpl_vars['addon_content'])): ?><?php echo $this->_tpl_vars['addon_content']; ?>
<?php else: ?><?php if ($this->_tpl_vars['addons']['bundled_products']['status'] == 'A'): ?><?php ob_start(); $this->_in_capture[] = 'f1cf3494f21350428f79a25fc09a14a8';
$_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/bundled_products/hooks/products/add_to_cart.override.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
$this->_tpl_vars['addon_content'] = ob_get_contents(); ob_end_clean(); array_pop($this->_in_capture); if (!empty($this->_scripts['f1cf3494f21350428f79a25fc09a14a8'])) { echo implode("\n", $this->_scripts['f1cf3494f21350428f79a25fc09a14a8']); unset($this->_scripts['f1cf3494f21350428f79a25fc09a14a8']); }
 ?><?php else: ?><?php $this->assign('addon_content', "", false); ?><?php endif; ?><?php if (trim($this->_tpl_vars['addon_content'])): ?><?php echo $this->_tpl_vars['addon_content']; ?>
<?php else: ?><?php $this->_tag_stack[] = array('hook', array('name' => "products:add_to_cart")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				<?php if ($this->_tpl_vars['product']['has_options'] && ! $this->_tpl_vars['show_product_options'] && ! $this->_tpl_vars['details_page']): ?>
					<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('but_id' => "button_cart_".($this->_tpl_vars['obj_prefix']).($this->_tpl_vars['obj_id']), 'but_text' => fn_get_lang_var('select_options', $this->getLanguage()), 'but_href' => "products.view?product_id=".($this->_tpl_vars['product']['product_id']), 'but_role' => 'text', 'but_name' => "", )); ?>

<?php if ($this->_tpl_vars['but_role'] == 'action'): ?>
	<?php $this->assign('suffix', "-action", false); ?>
	<?php $this->assign('file_prefix', 'action_', false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'act'): ?>
	<?php $this->assign('suffix', "-act", false); ?>
	<?php $this->assign('file_prefix', 'action_', false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'disabled_big'): ?>
	<?php $this->assign('suffix', "-disabled-big", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'big'): ?>
	<?php $this->assign('suffix', "-big", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'delete'): ?>
	<?php $this->assign('suffix', "-delete", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'tool'): ?>
	<?php $this->assign('suffix', "-tool", false); ?>
<?php else: ?>
	<?php $this->assign('suffix', "", false); ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['but_name'] && $this->_tpl_vars['but_role'] != 'text' && $this->_tpl_vars['but_role'] != 'act' && $this->_tpl_vars['but_role'] != 'delete'): ?> 
	<span <?php if ($this->_tpl_vars['but_id']): ?>id="wrap_<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_css']): ?>style="<?php echo $this->_tpl_vars['but_css']; ?>
"<?php endif; ?> class="button-submit<?php echo $this->_tpl_vars['suffix']; ?>
 button-wrap-left"><span <?php if ($this->_tpl_vars['but_css']): ?>style="<?php echo $this->_tpl_vars['but_css']; ?>
"<?php endif; ?> class="button-submit<?php echo $this->_tpl_vars['suffix']; ?>
 button-wrap-right"><input <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_meta']): ?>class="<?php echo $this->_tpl_vars['but_meta']; ?>
"<?php endif; ?> type="submit" name="<?php echo $this->_tpl_vars['but_name']; ?>
" <?php if ($this->_tpl_vars['but_onclick']): ?>onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
"<?php endif; ?> value="<?php echo $this->_tpl_vars['but_text']; ?>
" /></span></span>

<?php elseif ($this->_tpl_vars['but_role'] == 'text' || $this->_tpl_vars['but_role'] == 'act' || $this->_tpl_vars['but_role'] == 'edit' || ( $this->_tpl_vars['but_role'] == 'text' && $this->_tpl_vars['but_name'] )): ?> 

	<a class="<?php if ($this->_tpl_vars['but_meta']): ?><?php echo $this->_tpl_vars['but_meta']; ?>
 <?php endif; ?><?php if ($this->_tpl_vars['but_name']): ?>cm-submit-link <?php endif; ?>text-button<?php echo $this->_tpl_vars['suffix']; ?>
"<?php if ($this->_tpl_vars['but_id']): ?> id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_name']): ?> name="<?php echo smarty_modifier_replace(smarty_modifier_replace($this->_tpl_vars['but_name'], "[", ":-"), "]", "-:"); ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_href']): ?> href="<?php echo fn_url($this->_tpl_vars['but_href']); ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_onclick']): ?> onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
 return false;"<?php endif; ?><?php if ($this->_tpl_vars['but_target']): ?> target="<?php echo $this->_tpl_vars['but_target']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_rel']): ?> rel="<?php echo $this->_tpl_vars['but_rel']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?>><?php echo $this->_tpl_vars['but_text']; ?>
</a>

<?php elseif ($this->_tpl_vars['but_role'] == 'delete'): ?>

	<a <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_name']): ?> name="<?php echo smarty_modifier_replace(smarty_modifier_replace($this->_tpl_vars['but_name'], "[", ":-"), "]", "-:"); ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_href']): ?>href="<?php echo fn_url($this->_tpl_vars['but_href']); ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_onclick']): ?> onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
 return false;"<?php endif; ?><?php if ($this->_tpl_vars['but_meta']): ?> class="<?php echo $this->_tpl_vars['but_meta']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_target']): ?> target="<?php echo $this->_tpl_vars['but_target']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_rel']): ?> rel="<?php echo $this->_tpl_vars['but_rel']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?>><span title="<?php echo fn_get_lang_var('delete', $this->getLanguage()); ?>
" class="icon-delete-small"></span></a>

<?php elseif ($this->_tpl_vars['but_role'] == 'icon'): ?> 
	<a <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_href']): ?> href="<?php echo fn_url($this->_tpl_vars['but_href']); ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_onclick']): ?>onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
;<?php if (! $this->_tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> <?php if ($this->_tpl_vars['but_target']): ?>target="<?php echo $this->_tpl_vars['but_target']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_rel']): ?> rel="<?php echo $this->_tpl_vars['but_rel']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?> class="<?php if ($this->_tpl_vars['but_meta']): ?> <?php echo $this->_tpl_vars['but_meta']; ?>
<?php endif; ?>"><?php echo $this->_tpl_vars['but_text']; ?>
</a>

<?php else: ?> 

	<span class="button<?php echo $this->_tpl_vars['suffix']; ?>
 button-wrap-left" <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?>><span class="button<?php echo $this->_tpl_vars['suffix']; ?>
 button-wrap-right"><a <?php if ($this->_tpl_vars['but_href']): ?>href="<?php echo fn_url($this->_tpl_vars['but_href']); ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_onclick']): ?> onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
 return false;"<?php endif; ?> <?php if ($this->_tpl_vars['but_target']): ?>target="<?php echo $this->_tpl_vars['but_target']; ?>
"<?php endif; ?> class="<?php if ($this->_tpl_vars['but_meta']): ?><?php echo $this->_tpl_vars['but_meta']; ?>
 <?php endif; ?>" <?php if ($this->_tpl_vars['but_rel']): ?> rel="<?php echo $this->_tpl_vars['but_rel']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_rev']): ?>rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?>><?php echo $this->_tpl_vars['but_text']; ?>
</a></span></span>

<?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
				<?php else: ?>
					<?php if ($this->_tpl_vars['extra_button']): ?><?php echo $this->_tpl_vars['extra_button']; ?>
&nbsp;<?php endif; ?>
					<?php if ($this->_tpl_vars['quick_view']): ?>
					<div class="buttons-container">
						<div class="float-right">
					<?php endif; ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/add_to_cart.tpl", 'smarty_include_vars' => array('but_id' => "button_cart_".($this->_tpl_vars['obj_prefix']).($this->_tpl_vars['obj_id']),'but_name' => "dispatch[checkout.add..".($this->_tpl_vars['obj_id'])."]",'but_role' => $this->_tpl_vars['but_role'],'block_width' => $this->_tpl_vars['block_width'],'obj_id' => $this->_tpl_vars['obj_id'],'product' => $this->_tpl_vars['product'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php if ($this->_tpl_vars['quick_view']): ?>
						</div>
						<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('but_href' => "products.view?product_id=".($this->_tpl_vars['product']['product_id']), 'but_text' => fn_get_lang_var('view_details', $this->getLanguage()), 'but_name' => "", 'but_role' => "", )); ?>

<?php if ($this->_tpl_vars['but_role'] == 'action'): ?>
	<?php $this->assign('suffix', "-action", false); ?>
	<?php $this->assign('file_prefix', 'action_', false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'act'): ?>
	<?php $this->assign('suffix', "-act", false); ?>
	<?php $this->assign('file_prefix', 'action_', false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'disabled_big'): ?>
	<?php $this->assign('suffix', "-disabled-big", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'big'): ?>
	<?php $this->assign('suffix', "-big", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'delete'): ?>
	<?php $this->assign('suffix', "-delete", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'tool'): ?>
	<?php $this->assign('suffix', "-tool", false); ?>
<?php else: ?>
	<?php $this->assign('suffix', "", false); ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['but_name'] && $this->_tpl_vars['but_role'] != 'text' && $this->_tpl_vars['but_role'] != 'act' && $this->_tpl_vars['but_role'] != 'delete'): ?> 
	<span <?php if ($this->_tpl_vars['but_id']): ?>id="wrap_<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_css']): ?>style="<?php echo $this->_tpl_vars['but_css']; ?>
"<?php endif; ?> class="button-submit<?php echo $this->_tpl_vars['suffix']; ?>
 button-wrap-left"><span <?php if ($this->_tpl_vars['but_css']): ?>style="<?php echo $this->_tpl_vars['but_css']; ?>
"<?php endif; ?> class="button-submit<?php echo $this->_tpl_vars['suffix']; ?>
 button-wrap-right"><input <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_meta']): ?>class="<?php echo $this->_tpl_vars['but_meta']; ?>
"<?php endif; ?> type="submit" name="<?php echo $this->_tpl_vars['but_name']; ?>
" <?php if ($this->_tpl_vars['but_onclick']): ?>onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
"<?php endif; ?> value="<?php echo $this->_tpl_vars['but_text']; ?>
" /></span></span>

<?php elseif ($this->_tpl_vars['but_role'] == 'text' || $this->_tpl_vars['but_role'] == 'act' || $this->_tpl_vars['but_role'] == 'edit' || ( $this->_tpl_vars['but_role'] == 'text' && $this->_tpl_vars['but_name'] )): ?> 

	<a class="<?php if ($this->_tpl_vars['but_meta']): ?><?php echo $this->_tpl_vars['but_meta']; ?>
 <?php endif; ?><?php if ($this->_tpl_vars['but_name']): ?>cm-submit-link <?php endif; ?>text-button<?php echo $this->_tpl_vars['suffix']; ?>
"<?php if ($this->_tpl_vars['but_id']): ?> id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_name']): ?> name="<?php echo smarty_modifier_replace(smarty_modifier_replace($this->_tpl_vars['but_name'], "[", ":-"), "]", "-:"); ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_href']): ?> href="<?php echo fn_url($this->_tpl_vars['but_href']); ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_onclick']): ?> onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
 return false;"<?php endif; ?><?php if ($this->_tpl_vars['but_target']): ?> target="<?php echo $this->_tpl_vars['but_target']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_rel']): ?> rel="<?php echo $this->_tpl_vars['but_rel']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?>><?php echo $this->_tpl_vars['but_text']; ?>
</a>

<?php elseif ($this->_tpl_vars['but_role'] == 'delete'): ?>

	<a <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_name']): ?> name="<?php echo smarty_modifier_replace(smarty_modifier_replace($this->_tpl_vars['but_name'], "[", ":-"), "]", "-:"); ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_href']): ?>href="<?php echo fn_url($this->_tpl_vars['but_href']); ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_onclick']): ?> onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
 return false;"<?php endif; ?><?php if ($this->_tpl_vars['but_meta']): ?> class="<?php echo $this->_tpl_vars['but_meta']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_target']): ?> target="<?php echo $this->_tpl_vars['but_target']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_rel']): ?> rel="<?php echo $this->_tpl_vars['but_rel']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?>><span title="<?php echo fn_get_lang_var('delete', $this->getLanguage()); ?>
" class="icon-delete-small"></span></a>

<?php elseif ($this->_tpl_vars['but_role'] == 'icon'): ?> 
	<a <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_href']): ?> href="<?php echo fn_url($this->_tpl_vars['but_href']); ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_onclick']): ?>onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
;<?php if (! $this->_tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> <?php if ($this->_tpl_vars['but_target']): ?>target="<?php echo $this->_tpl_vars['but_target']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_rel']): ?> rel="<?php echo $this->_tpl_vars['but_rel']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?> class="<?php if ($this->_tpl_vars['but_meta']): ?> <?php echo $this->_tpl_vars['but_meta']; ?>
<?php endif; ?>"><?php echo $this->_tpl_vars['but_text']; ?>
</a>

<?php else: ?> 

	<span class="button<?php echo $this->_tpl_vars['suffix']; ?>
 button-wrap-left" <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?>><span class="button<?php echo $this->_tpl_vars['suffix']; ?>
 button-wrap-right"><a <?php if ($this->_tpl_vars['but_href']): ?>href="<?php echo fn_url($this->_tpl_vars['but_href']); ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_onclick']): ?> onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
 return false;"<?php endif; ?> <?php if ($this->_tpl_vars['but_target']): ?>target="<?php echo $this->_tpl_vars['but_target']; ?>
"<?php endif; ?> class="<?php if ($this->_tpl_vars['but_meta']): ?><?php echo $this->_tpl_vars['but_meta']; ?>
 <?php endif; ?>" <?php if ($this->_tpl_vars['but_rel']): ?> rel="<?php echo $this->_tpl_vars['but_rel']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_rev']): ?>rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?>><?php echo $this->_tpl_vars['but_text']; ?>
</a></span></span>

<?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
					</div>
					<?php endif; ?>

					<?php $this->assign('cart_button_exists', true, false); ?>
				<?php endif; ?>
				<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php endif; ?><?php endif; ?>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['product']['avail_since'] > @TIME): ?>
				<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('avail_date' => $this->_tpl_vars['product']['avail_since'], 'add_to_cart' => $this->_tpl_vars['product']['out_of_stock_actions'], )); ?><div class="product-coming-soon">
	<?php $this->assign('date', smarty_modifier_date_format($this->_tpl_vars['avail_date'], $this->_tpl_vars['settings']['Appearance']['date_format']), false); ?>
	<?php if ($this->_tpl_vars['add_to_cart'] == 'N'): ?><?php echo smarty_modifier_replace(fn_get_lang_var('product_coming_soon', $this->getLanguage()), "[avail_date]", $this->_tpl_vars['date']); ?>
<?php else: ?><?php echo smarty_modifier_replace(fn_get_lang_var('product_coming_soon_add', $this->getLanguage()), "[avail_date]", $this->_tpl_vars['date']); ?>
<?php endif; ?>
</div><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
			<?php endif; ?>
		</<?php if ($this->_tpl_vars['separate_buttons']): ?>div<?php else: ?>span<?php endif; ?>>
		
	<?php elseif (( $this->_tpl_vars['settings']['General']['inventory_tracking'] == 'Y' && $this->_tpl_vars['settings']['General']['allow_negative_amount'] != 'Y' && ( ( $this->_tpl_vars['product_amount'] <= 0 || $this->_tpl_vars['product_amount'] < $this->_tpl_vars['product']['min_qty'] ) && $this->_tpl_vars['product']['tracking'] != 'D' ) && $this->_tpl_vars['product']['is_edp'] != 'Y' )): ?>
		<?php if (! $this->_tpl_vars['details_page']): ?>
			<?php if (( ( $this->_tpl_vars['product_amount'] <= 0 || $this->_tpl_vars['product_amount'] < $this->_tpl_vars['product']['min_qty'] ) && ( $this->_tpl_vars['product']['avail_since'] > @TIME ) )): ?>
				<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('avail_date' => $this->_tpl_vars['product']['avail_since'], 'add_to_cart' => $this->_tpl_vars['product']['out_of_stock_actions'], )); ?><div class="product-coming-soon">
	<?php $this->assign('date', smarty_modifier_date_format($this->_tpl_vars['avail_date'], $this->_tpl_vars['settings']['Appearance']['date_format']), false); ?>
	<?php if ($this->_tpl_vars['add_to_cart'] == 'N'): ?><?php echo smarty_modifier_replace(fn_get_lang_var('product_coming_soon', $this->getLanguage()), "[avail_date]", $this->_tpl_vars['date']); ?>
<?php else: ?><?php echo smarty_modifier_replace(fn_get_lang_var('product_coming_soon_add', $this->getLanguage()), "[avail_date]", $this->_tpl_vars['date']); ?>
<?php endif; ?>
</div><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
			<?php elseif (! $this->_tpl_vars['product']['hide_stock_info']): ?>
				<span class="out-of-stock" id="out_of_stock_info_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
"><?php echo fn_get_lang_var('text_out_of_stock', $this->getLanguage()); ?>
</span>
			<?php endif; ?>
		<?php elseif (( ( $this->_tpl_vars['product']['out_of_stock_actions'] == 'S' ) && ( $this->_tpl_vars['product']['tracking'] != 'O' ) )): ?>
			<div class="form-field">
				<label for="product_notify_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
">
					<input id="product_notify_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
" type="checkbox" class="checkbox" name="product_notify" <?php if ($this->_tpl_vars['product_notification_enabled'] == 'Y'): ?>checked="checked"<?php endif; ?> onclick="
						<?php if ($this->_tpl_vars['auth']['user_id'] == 0): ?>
							$('#product_notify_email').attr('style', this.checked ? '' : 'display: none;');
							$('#product_notify_email_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
').attr('disabled', this.checked ? '' : 'disabled');
							if (!this.checked) <?php echo $this->_tpl_vars['ldelim']; ?>

								$.ajaxRequest('<?php echo fn_url("products.product_notifications?enable=", 'C', 'rel', '&'); ?>
' + 'N&product_id=<?php echo $this->_tpl_vars['product']['product_id']; ?>
&email=' + $('#product_notify_email_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
').get(0).value, <?php echo $this->_tpl_vars['ldelim']; ?>
cache: false<?php echo $this->_tpl_vars['rdelim']; ?>
);
							<?php echo $this->_tpl_vars['rdelim']; ?>

						<?php else: ?>
							$.ajaxRequest('<?php echo fn_url("products.product_notifications?enable=", 'C', 'rel', '&'); ?>
' + (this.checked ? 'Y' : 'N') + '&product_id=' + '<?php echo $this->_tpl_vars['product']['product_id']; ?>
', <?php echo $this->_tpl_vars['ldelim']; ?>
cache: false<?php echo $this->_tpl_vars['rdelim']; ?>
);
						<?php endif; ?>
					"/><?php echo fn_get_lang_var('notify_when_back_in_stock', $this->getLanguage()); ?>

				</label>
			</div>
			<?php if ($this->_tpl_vars['auth']['user_id'] == 0): ?>
			<div class="form-field input-append" id="product_notify_email" style="<?php if ($this->_tpl_vars['product_notification_enabled'] != 'Y'): ?> display: none;<?php endif; ?>">
				<form action="index.php" method="post" enctype="multipart/form-data" class="cm-disable-empty-files cm-ajax">
					<label id="product_notify_email_label" for="product_notify_email_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
" class="cm-required cm-email hidden"><?php echo fn_get_lang_var('email', $this->getLanguage()); ?>
</label>
					<input type="text" name="email" id="product_notify_email_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
" size="20" 
						value="<?php if ($this->_tpl_vars['product_notification_email'] != ''): ?><?php echo $this->_tpl_vars['product_notification_email']; ?>
<?php else: ?><?php echo smarty_modifier_escape(fn_get_lang_var('enter_email', $this->getLanguage()), 'html'); ?>
<?php endif; ?>"
						class="input-text cm-hint" disabled="disabled" title="<?php echo smarty_modifier_escape(fn_get_lang_var('enter_email', $this->getLanguage()), 'html'); ?>
" />
					<button class="go-button" title="<?php echo fn_get_lang_var('go', $this->getLanguage()); ?>
" alt="<?php echo fn_get_lang_var('go', $this->getLanguage()); ?>
"></button>
					<input type="hidden" value="products.product_notifications" name="dispatch" />
					<input type="hidden" value="Y" name="enable" />
					<input type="hidden" value="<?php echo $this->_tpl_vars['product']['product_id']; ?>
" name="product_id" />
				</form>
			</div>
			<?php endif; ?>
		<?php elseif (( ( $this->_tpl_vars['product_amount'] <= 0 || $this->_tpl_vars['product_amount'] < $this->_tpl_vars['product']['min_qty'] ) && ( $this->_tpl_vars['product']['avail_since'] > @TIME ) )): ?>
			<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('avail_date' => $this->_tpl_vars['product']['avail_since'], 'add_to_cart' => $this->_tpl_vars['product']['out_of_stock_actions'], )); ?><div class="product-coming-soon">
	<?php $this->assign('date', smarty_modifier_date_format($this->_tpl_vars['avail_date'], $this->_tpl_vars['settings']['Appearance']['date_format']), false); ?>
	<?php if ($this->_tpl_vars['add_to_cart'] == 'N'): ?><?php echo smarty_modifier_replace(fn_get_lang_var('product_coming_soon', $this->getLanguage()), "[avail_date]", $this->_tpl_vars['date']); ?>
<?php else: ?><?php echo smarty_modifier_replace(fn_get_lang_var('product_coming_soon_add', $this->getLanguage()), "[avail_date]", $this->_tpl_vars['date']); ?>
<?php endif; ?>
</div><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
		<?php endif; ?>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['show_list_buttons']): ?>
		<?php ob_start(); ?>
			<?php $this->_tag_stack[] = array('hook', array('name' => "products:buy_now")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if ($this->_tpl_vars['addons']['wishlist']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/wishlist/hooks/products/buy_now.pre.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?>
			<?php if ($this->_tpl_vars['product']['feature_comparison'] == 'Y'): ?>
				<?php if ($this->_tpl_vars['separate_buttons']): ?></div><div class="add-to-compare"><?php endif; ?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/add_to_compare_list.tpl", 'smarty_include_vars' => array('product_id' => $this->_tpl_vars['product']['product_id'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php endif; ?>
			<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		<?php $this->_smarty_vars['capture']["product_buy_now_".($this->_tpl_vars['obj_id'])] = ob_get_contents(); ob_end_clean(); ?>
		<?php $this->assign('capture_buy_now', "product_buy_now_".($this->_tpl_vars['obj_id']), false); ?>

		<?php if (trim($this->_smarty_vars['capture'][$this->_tpl_vars['capture_buy_now']])): ?>
			<?php if ($this->_tpl_vars['separate_buttons']): ?><div class="add-buttons-wrap"><div class="add-buttons-inner-wrap"><?php endif; ?>
				<<?php if ($this->_tpl_vars['separate_buttons']): ?>div<?php else: ?>span<?php endif; ?> id="cart_buttons_block_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
" class="add-buttons add-to-wish">
					<?php echo $this->_smarty_vars['capture'][$this->_tpl_vars['capture_buy_now']]; ?>

				</<?php if ($this->_tpl_vars['separate_buttons']): ?>div<?php else: ?>span<?php endif; ?>>
			<?php if ($this->_tpl_vars['separate_buttons']): ?></div></div><?php endif; ?>
		<?php endif; ?>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['quick_view'] && ! $this->_tpl_vars['cart_button_exists']): ?>
		<div class="buttons-container">
			<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('but_href' => "products.view?product_id=".($this->_tpl_vars['product']['product_id']), 'but_text' => fn_get_lang_var('view_details', $this->getLanguage()), 'but_name' => "", 'but_role' => "", )); ?>

<?php if ($this->_tpl_vars['but_role'] == 'action'): ?>
	<?php $this->assign('suffix', "-action", false); ?>
	<?php $this->assign('file_prefix', 'action_', false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'act'): ?>
	<?php $this->assign('suffix', "-act", false); ?>
	<?php $this->assign('file_prefix', 'action_', false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'disabled_big'): ?>
	<?php $this->assign('suffix', "-disabled-big", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'big'): ?>
	<?php $this->assign('suffix', "-big", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'delete'): ?>
	<?php $this->assign('suffix', "-delete", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'tool'): ?>
	<?php $this->assign('suffix', "-tool", false); ?>
<?php else: ?>
	<?php $this->assign('suffix', "", false); ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['but_name'] && $this->_tpl_vars['but_role'] != 'text' && $this->_tpl_vars['but_role'] != 'act' && $this->_tpl_vars['but_role'] != 'delete'): ?> 
	<span <?php if ($this->_tpl_vars['but_id']): ?>id="wrap_<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_css']): ?>style="<?php echo $this->_tpl_vars['but_css']; ?>
"<?php endif; ?> class="button-submit<?php echo $this->_tpl_vars['suffix']; ?>
 button-wrap-left"><span <?php if ($this->_tpl_vars['but_css']): ?>style="<?php echo $this->_tpl_vars['but_css']; ?>
"<?php endif; ?> class="button-submit<?php echo $this->_tpl_vars['suffix']; ?>
 button-wrap-right"><input <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_meta']): ?>class="<?php echo $this->_tpl_vars['but_meta']; ?>
"<?php endif; ?> type="submit" name="<?php echo $this->_tpl_vars['but_name']; ?>
" <?php if ($this->_tpl_vars['but_onclick']): ?>onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
"<?php endif; ?> value="<?php echo $this->_tpl_vars['but_text']; ?>
" /></span></span>

<?php elseif ($this->_tpl_vars['but_role'] == 'text' || $this->_tpl_vars['but_role'] == 'act' || $this->_tpl_vars['but_role'] == 'edit' || ( $this->_tpl_vars['but_role'] == 'text' && $this->_tpl_vars['but_name'] )): ?> 

	<a class="<?php if ($this->_tpl_vars['but_meta']): ?><?php echo $this->_tpl_vars['but_meta']; ?>
 <?php endif; ?><?php if ($this->_tpl_vars['but_name']): ?>cm-submit-link <?php endif; ?>text-button<?php echo $this->_tpl_vars['suffix']; ?>
"<?php if ($this->_tpl_vars['but_id']): ?> id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_name']): ?> name="<?php echo smarty_modifier_replace(smarty_modifier_replace($this->_tpl_vars['but_name'], "[", ":-"), "]", "-:"); ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_href']): ?> href="<?php echo fn_url($this->_tpl_vars['but_href']); ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_onclick']): ?> onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
 return false;"<?php endif; ?><?php if ($this->_tpl_vars['but_target']): ?> target="<?php echo $this->_tpl_vars['but_target']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_rel']): ?> rel="<?php echo $this->_tpl_vars['but_rel']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?>><?php echo $this->_tpl_vars['but_text']; ?>
</a>

<?php elseif ($this->_tpl_vars['but_role'] == 'delete'): ?>

	<a <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_name']): ?> name="<?php echo smarty_modifier_replace(smarty_modifier_replace($this->_tpl_vars['but_name'], "[", ":-"), "]", "-:"); ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_href']): ?>href="<?php echo fn_url($this->_tpl_vars['but_href']); ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_onclick']): ?> onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
 return false;"<?php endif; ?><?php if ($this->_tpl_vars['but_meta']): ?> class="<?php echo $this->_tpl_vars['but_meta']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_target']): ?> target="<?php echo $this->_tpl_vars['but_target']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_rel']): ?> rel="<?php echo $this->_tpl_vars['but_rel']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?>><span title="<?php echo fn_get_lang_var('delete', $this->getLanguage()); ?>
" class="icon-delete-small"></span></a>

<?php elseif ($this->_tpl_vars['but_role'] == 'icon'): ?> 
	<a <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_href']): ?> href="<?php echo fn_url($this->_tpl_vars['but_href']); ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_onclick']): ?>onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
;<?php if (! $this->_tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> <?php if ($this->_tpl_vars['but_target']): ?>target="<?php echo $this->_tpl_vars['but_target']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_rel']): ?> rel="<?php echo $this->_tpl_vars['but_rel']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?> class="<?php if ($this->_tpl_vars['but_meta']): ?> <?php echo $this->_tpl_vars['but_meta']; ?>
<?php endif; ?>"><?php echo $this->_tpl_vars['but_text']; ?>
</a>

<?php else: ?> 

	<span class="button<?php echo $this->_tpl_vars['suffix']; ?>
 button-wrap-left" <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?>><span class="button<?php echo $this->_tpl_vars['suffix']; ?>
 button-wrap-right"><a <?php if ($this->_tpl_vars['but_href']): ?>href="<?php echo fn_url($this->_tpl_vars['but_href']); ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_onclick']): ?> onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
 return false;"<?php endif; ?> <?php if ($this->_tpl_vars['but_target']): ?>target="<?php echo $this->_tpl_vars['but_target']; ?>
"<?php endif; ?> class="<?php if ($this->_tpl_vars['but_meta']): ?><?php echo $this->_tpl_vars['but_meta']; ?>
 <?php endif; ?>" <?php if ($this->_tpl_vars['but_rel']): ?> rel="<?php echo $this->_tpl_vars['but_rel']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_rev']): ?>rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?>><?php echo $this->_tpl_vars['but_text']; ?>
</a></span></span>

<?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
		</div>
	<?php endif; ?>

		<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php endif; ?><?php endif; ?>
<!--add_to_cart_update_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
--></div>
<?php endif; ?>
<?php $this->_smarty_vars['capture']["add_to_cart_".($this->_tpl_vars['obj_id'])] = ob_get_contents(); ob_end_clean(); ?>

<?php if ($this->_smarty_vars['capture']['cart_button_exists']): ?>
	<?php $this->assign('cart_button_exists', true, false); ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['no_capture']): ?>
	<?php $this->assign('capture_name', "add_to_cart_".($this->_tpl_vars['obj_id']), false); ?>
	<?php echo $this->_smarty_vars['capture'][$this->_tpl_vars['capture_name']]; ?>

<?php endif; ?>

<?php ob_start(); ?>
	<?php if ($this->_tpl_vars['show_features']): ?>
		<div class="cm-reload-<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
" id="product_features_update_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
">
			<input type="hidden" name="appearance[show_features]" value="<?php echo $this->_tpl_vars['show_features']; ?>
" />
			<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('features' => smarty_modifier_escape(fn_get_product_features_list($this->_tpl_vars['product'])), 'no_container' => true, )); ?><?php if ($this->_tpl_vars['features']): ?>
<?php echo ''; ?><?php if (! $this->_tpl_vars['no_container']): ?><?php echo '<p class="features-list description">'; ?><?php endif; ?><?php echo ''; ?><?php $_from = $this->_tpl_vars['features']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['features_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['features_list']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['feature']):
        $this->_foreach['features_list']['iteration']++;
?><?php echo ''; ?><?php if ($this->_tpl_vars['feature']['prefix']): ?><?php echo ''; ?><?php echo $this->_tpl_vars['feature']['prefix']; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['feature']['feature_type'] == 'D'): ?><?php echo ''; ?><?php echo smarty_modifier_date_format($this->_tpl_vars['feature']['value_int'], ($this->_tpl_vars['settings']['Appearance']['date_format'])); ?><?php echo ''; ?><?php elseif ($this->_tpl_vars['feature']['feature_type'] == 'M'): ?><?php echo ''; ?><?php $_from = $this->_tpl_vars['feature']['variants']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['ffev'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['ffev']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['v']):
        $this->_foreach['ffev']['iteration']++;
?><?php echo ''; ?><?php echo smarty_modifier_default(@$this->_tpl_vars['v']['variant'], @$this->_tpl_vars['v']['value']); ?><?php echo ''; ?><?php if (! ($this->_foreach['ffev']['iteration'] == $this->_foreach['ffev']['total'])): ?><?php echo ', '; ?><?php endif; ?><?php echo ''; ?><?php endforeach; endif; unset($_from); ?><?php echo ''; ?><?php elseif ($this->_tpl_vars['feature']['feature_type'] == 'S' || $this->_tpl_vars['feature']['feature_type'] == 'N' || $this->_tpl_vars['feature']['feature_type'] == 'E'): ?><?php echo ''; ?><?php echo smarty_modifier_default(@$this->_tpl_vars['feature']['variant'], @$this->_tpl_vars['feature']['value']); ?><?php echo ''; ?><?php elseif ($this->_tpl_vars['feature']['feature_type'] == 'C'): ?><?php echo ''; ?><?php echo $this->_tpl_vars['feature']['description']; ?><?php echo ''; ?><?php elseif ($this->_tpl_vars['feature']['feature_type'] == 'O'): ?><?php echo ''; ?><?php echo floatval($this->_tpl_vars['feature']['value_int']); ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo $this->_tpl_vars['feature']['value']; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['feature']['suffix']): ?><?php echo ''; ?><?php echo $this->_tpl_vars['feature']['suffix']; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if (! ($this->_foreach['features_list']['iteration'] == $this->_foreach['features_list']['total'])): ?><?php echo ' / '; ?><?php endif; ?><?php echo ''; ?><?php endforeach; endif; unset($_from); ?><?php echo ''; ?><?php if (! $this->_tpl_vars['no_container']): ?><?php echo '</p>'; ?><?php endif; ?><?php echo ''; ?>

<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
		<!--product_features_update_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
--></div>
	<?php endif; ?>
<?php $this->_smarty_vars['capture']["product_features_".($this->_tpl_vars['obj_id'])] = ob_get_contents(); ob_end_clean(); ?>
<?php if ($this->_tpl_vars['no_capture']): ?>
	<?php $this->assign('capture_name', "product_features_".($this->_tpl_vars['obj_id']), false); ?>
	<?php echo $this->_smarty_vars['capture'][$this->_tpl_vars['capture_name']]; ?>

<?php endif; ?>

<?php ob_start(); ?>
	<?php if ($this->_tpl_vars['show_descr']): ?>
		<?php if ($this->_tpl_vars['product']['short_description']): ?>
			<?php echo smarty_modifier_unescape($this->_tpl_vars['product']['short_description']); ?>

		<?php else: ?>
			<?php echo smarty_modifier_truncate(smarty_modifier_strip_tags(smarty_modifier_unescape($this->_tpl_vars['product']['full_description'])), 160); ?>
<?php if (! $this->_tpl_vars['hide_links'] && strlen($this->_tpl_vars['product']['full_description']) > 180): ?> <a href="<?php echo fn_url("products.view?product_id=".($this->_tpl_vars['product']['product_id'])); ?>
" class="lowercase"><?php echo fn_get_lang_var('more', $this->getLanguage()); ?>
&nbsp;<i class="text-arrow">&rarr;</i></a><?php endif; ?>
		<?php endif; ?>
	<?php endif; ?>
<?php $this->_smarty_vars['capture']["prod_descr_".($this->_tpl_vars['obj_id'])] = ob_get_contents(); ob_end_clean(); ?>
<?php if ($this->_tpl_vars['no_capture']): ?>
	<?php $this->assign('capture_name', "prod_descr_".($this->_tpl_vars['obj_id']), false); ?>
	<?php echo $this->_smarty_vars['capture'][$this->_tpl_vars['capture_name']]; ?>

<?php endif; ?>

<?php ob_start(); ?>
	<?php if ($this->_tpl_vars['show_price_values'] && $this->_tpl_vars['show_old_price']): ?>
		<?php if ($this->_tpl_vars['product']['discount'] || $this->_tpl_vars['product']['list_discount']): ?>
		<span class="cm-reload-<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
" id="old_price_update_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
">
			<input type="hidden" name="appearance[show_price_values]" value="<?php echo $this->_tpl_vars['show_price_values']; ?>
" />
			<input type="hidden" name="appearance[show_old_price]" value="<?php echo $this->_tpl_vars['show_old_price']; ?>
" />
			<?php if ($this->_tpl_vars['product']['discount']): ?>
				<span class="list-price nowrap" id="line_old_price_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
"><?php if ($this->_tpl_vars['details_page'] && ! $this->_tpl_vars['quick_view']): ?><?php echo fn_get_lang_var('old_price', $this->getLanguage()); ?>
: <?php endif; ?><strike><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => smarty_modifier_default(@$this->_tpl_vars['product']['original_price'], @$this->_tpl_vars['product']['base_price']), 'span_id' => "old_price_".($this->_tpl_vars['obj_prefix']).($this->_tpl_vars['obj_id']), 'class' => "list-price nowrap", )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></strike></span>
			<?php elseif ($this->_tpl_vars['product']['list_discount']): ?>
				<span class="list-price nowrap" id="line_list_price_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
"><?php if ($this->_tpl_vars['details_page'] && ! $this->_tpl_vars['quick_view']): ?><span class="list-price-label"><?php echo fn_get_lang_var('list_price', $this->getLanguage()); ?>
:</span> <?php endif; ?><strike><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['product']['list_price'], 'span_id' => "list_price_".($this->_tpl_vars['obj_prefix']).($this->_tpl_vars['obj_id']), 'class' => "list-price nowrap", )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></strike></span>
			<?php endif; ?>
		<!--old_price_update_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
--></span>
		<?php endif; ?>
	<?php endif; ?>
<?php $this->_smarty_vars['capture']["old_price_".($this->_tpl_vars['obj_id'])] = ob_get_contents(); ob_end_clean(); ?>
<?php if ($this->_tpl_vars['no_capture']): ?>
	<?php $this->assign('capture_name', "old_price_".($this->_tpl_vars['obj_id']), false); ?>
	<?php echo $this->_smarty_vars['capture'][$this->_tpl_vars['capture_name']]; ?>

<?php endif; ?>

<?php ob_start(); ?>
	<span class="cm-reload-<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
 price-update" id="price_update_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
">
		<input type="hidden" name="appearance[show_price_values]" value="<?php echo $this->_tpl_vars['show_price_values']; ?>
" />
		<input type="hidden" name="appearance[show_price]" value="<?php echo $this->_tpl_vars['show_price']; ?>
" />
		<?php if ($this->_tpl_vars['show_price_values']): ?>
			<?php if ($this->_tpl_vars['show_price']): ?>
			<?php if ($this->_tpl_vars['addons']['bundled_products']['status'] == 'A'): ?><?php ob_start(); $this->_in_capture[] = '0bc3784ba8f6564b623da4eb06ee465c';
$_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/bundled_products/hooks/products/prices_block.override.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
$this->_tpl_vars['addon_content'] = ob_get_contents(); ob_end_clean(); array_pop($this->_in_capture); if (!empty($this->_scripts['0bc3784ba8f6564b623da4eb06ee465c'])) { echo implode("\n", $this->_scripts['0bc3784ba8f6564b623da4eb06ee465c']); unset($this->_scripts['0bc3784ba8f6564b623da4eb06ee465c']); }
 ?><?php else: ?><?php $this->assign('addon_content', "", false); ?><?php endif; ?><?php if (trim($this->_tpl_vars['addon_content'])): ?><?php echo $this->_tpl_vars['addon_content']; ?>
<?php else: ?><?php $this->_tag_stack[] = array('hook', array('name' => "products:prices_block")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				<?php if (floatval($this->_tpl_vars['product']['price']) || $this->_tpl_vars['product']['zero_price_action'] == 'P' || ( $this->_tpl_vars['hide_add_to_cart_button'] == 'Y' && $this->_tpl_vars['product']['zero_price_action'] == 'A' )): ?>
					<span class="price<?php if (! floatval($this->_tpl_vars['product']['price'])): ?> hidden<?php endif; ?>" id="line_discounted_price_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
"><?php if ($this->_tpl_vars['details_page']): ?><?php endif; ?><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['product']['price'], 'span_id' => "discounted_price_".($this->_tpl_vars['obj_prefix']).($this->_tpl_vars['obj_id']), 'class' => "price-num", )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></span>
				<?php elseif ($this->_tpl_vars['product']['zero_price_action'] == 'A'): ?>
					<?php $this->assign('base_currency', $this->_tpl_vars['currencies'][@CART_PRIMARY_CURRENCY], false); ?>
					<span class="price-curency"><?php echo fn_get_lang_var('enter_your_price', $this->getLanguage()); ?>
: <?php if ($this->_tpl_vars['base_currency']['after'] != 'Y'): ?><?php echo $this->_tpl_vars['base_currency']['symbol']; ?>
<?php endif; ?><input class="input-text-short" type="text" size="3" name="product_data[<?php echo $this->_tpl_vars['obj_id']; ?>
][price]" value="" /><?php if ($this->_tpl_vars['base_currency']['after'] == 'Y'): ?>&nbsp;<?php echo $this->_tpl_vars['base_currency']['symbol']; ?>
<?php endif; ?></span>
				<?php elseif ($this->_tpl_vars['product']['zero_price_action'] == 'R'): ?>
					<span class="price"><?php echo fn_get_lang_var('contact_us_for_price', $this->getLanguage()); ?>
</span>
				<?php endif; ?>
			<?php if ($this->_tpl_vars['addons']['recurring_billing']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><?php if ($this->_tpl_vars['product']['recurring_plans'] && ! ( @CONTROLLER == 'products' && ( @MODE == 'view' || @MODE == 'options' ) )): ?>

<?php if ($this->_tpl_vars['product']['extra']['recurring_plan_id']): ?>
	<?php $this->assign('_cur_plan_id', $this->_tpl_vars['product']['extra']['recurring_plan_id'], false); ?>
<?php else: ?>
	<?php $this->assign('first_plan', reset($this->_tpl_vars['product']['recurring_plans']), false); ?>
	<?php $this->assign('_cur_plan_id', $this->_tpl_vars['first_plan']['plan_id'], false); ?>
<?php endif; ?>

<input type="hidden" id="rb_plan_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
" name="product_data[<?php echo $this->_tpl_vars['obj_id']; ?>
][recurring_plan_id]" value="<?php echo $this->_tpl_vars['_cur_plan_id']; ?>
" />

<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php endif; ?>
			<?php endif; ?>
		<?php elseif ($this->_tpl_vars['settings']['General']['allow_anonymous_shopping'] == 'P' && ! $this->_tpl_vars['auth']['user_id']): ?>
			<span class="price"><?php echo fn_get_lang_var('sign_in_to_view_price', $this->getLanguage()); ?>
</span>
		<?php endif; ?>
	<!--price_update_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
--></span>
<?php $this->_smarty_vars['capture']["price_".($this->_tpl_vars['obj_id'])] = ob_get_contents(); ob_end_clean(); ?>
<?php if ($this->_tpl_vars['no_capture']): ?>
	<?php $this->assign('capture_name', "price_".($this->_tpl_vars['obj_id']), false); ?>
	<?php echo $this->_smarty_vars['capture'][$this->_tpl_vars['capture_name']]; ?>

<?php endif; ?>

<?php ob_start(); ?>
	<?php if ($this->_tpl_vars['show_price_values'] && $this->_tpl_vars['show_clean_price'] && $this->_tpl_vars['settings']['Appearance']['show_prices_taxed_clean'] == 'Y' && $this->_tpl_vars['product']['taxed_price']): ?>
		<span class="cm-reload-<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
" id="clean_price_update_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
">
			<input type="hidden" name="appearance[show_price_values]" value="<?php echo $this->_tpl_vars['show_price_values']; ?>
" />
			<input type="hidden" name="appearance[show_clean_price]" value="<?php echo $this->_tpl_vars['show_clean_price']; ?>
" />
			<?php if ($this->_tpl_vars['product']['clean_price'] != $this->_tpl_vars['product']['taxed_price'] && $this->_tpl_vars['product']['included_tax']): ?>
				<span class="list-price nowrap" id="line_product_price_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
">(<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['product']['taxed_price'], 'span_id' => "product_price_".($this->_tpl_vars['obj_prefix']).($this->_tpl_vars['obj_id']), 'class' => "list-price nowrap", )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?> <?php echo fn_get_lang_var('inc_tax', $this->getLanguage()); ?>
)</span>
			<?php elseif ($this->_tpl_vars['product']['clean_price'] != $this->_tpl_vars['product']['taxed_price'] && ! $this->_tpl_vars['product']['included_tax']): ?>
				<span class="list-price nowrap">(<?php echo fn_get_lang_var('including_tax', $this->getLanguage()); ?>
)</span>
			<?php endif; ?>
		<!--clean_price_update_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
--></span>
	<?php endif; ?>
<?php $this->_smarty_vars['capture']["clean_price_".($this->_tpl_vars['obj_id'])] = ob_get_contents(); ob_end_clean(); ?>
<?php if ($this->_tpl_vars['no_capture']): ?>
	<?php $this->assign('capture_name', "clean_price_".($this->_tpl_vars['obj_id']), false); ?>
	<?php echo $this->_smarty_vars['capture'][$this->_tpl_vars['capture_name']]; ?>

<?php endif; ?>

<?php ob_start(); ?>
	<?php if ($this->_tpl_vars['show_price_values'] && $this->_tpl_vars['show_list_discount'] && $this->_tpl_vars['details_page']): ?>
		<?php if ($this->_tpl_vars['product']['discount'] || $this->_tpl_vars['product']['list_discount']): ?>
			<span class="cm-reload-<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
" id="line_discount_update_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
">
				<input type="hidden" name="appearance[show_price_values]" value="<?php echo $this->_tpl_vars['show_price_values']; ?>
" />
				<input type="hidden" name="appearance[show_list_discount]" value="<?php echo $this->_tpl_vars['show_list_discount']; ?>
" />
				<?php if ($this->_tpl_vars['product']['discount']): ?>
					<span class="list-price save-price nowrap" id="line_discount_value_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
"><?php echo fn_get_lang_var('you_save', $this->getLanguage()); ?>
: <?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['product']['discount'], 'span_id' => "discount_value_".($this->_tpl_vars['obj_prefix']).($this->_tpl_vars['obj_id']), 'class' => "list-price nowrap", )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>&nbsp;(<span id="prc_discount_value_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
" class="list-price nowrap"><?php echo $this->_tpl_vars['product']['discount_prc']; ?>
</span>%)</span>
				<?php elseif ($this->_tpl_vars['product']['list_discount']): ?>
					<span class="list-price save-price nowrap" id="line_discount_value_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
"><?php echo fn_get_lang_var('you_save', $this->getLanguage()); ?>
: <?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['product']['list_discount'], 'span_id' => "discount_value_".($this->_tpl_vars['obj_prefix']).($this->_tpl_vars['obj_id']), 'class' => "list-price nowrap", )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>&nbsp;(<span id="prc_discount_value_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
" class="list-price nowrap"><?php echo $this->_tpl_vars['product']['list_discount_prc']; ?>
</span>%)</span>
				<?php endif; ?>
			<!--line_discount_update_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
--></span>
		<?php endif; ?>
	<?php endif; ?>
<?php $this->_smarty_vars['capture']["list_discount_".($this->_tpl_vars['obj_id'])] = ob_get_contents(); ob_end_clean(); ?>
<?php if ($this->_tpl_vars['no_capture']): ?>
	<?php $this->assign('capture_name', "list_discount_".($this->_tpl_vars['obj_id']), false); ?>
	<?php echo $this->_smarty_vars['capture'][$this->_tpl_vars['capture_name']]; ?>

<?php endif; ?>

<?php ob_start(); ?>
	<?php if ($this->_tpl_vars['show_discount_label'] && ( $this->_tpl_vars['product']['discount_prc'] || $this->_tpl_vars['product']['list_discount_prc'] ) && $this->_tpl_vars['show_price_values']): ?>
		<div class="discount-label cm-reload-<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
" id="discount_label_update_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
">
			<input type="hidden" name="appearance[show_discount_label]" value="<?php echo $this->_tpl_vars['show_discount_label']; ?>
" />
			<input type="hidden" name="appearance[show_price_values]" value="<?php echo $this->_tpl_vars['show_price_values']; ?>
" />
			<div id="line_prc_discount_value_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
">
				<em><strong>-</strong><span id="prc_discount_value_label_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
"><?php if ($this->_tpl_vars['product']['discount']): ?><?php echo $this->_tpl_vars['product']['discount_prc']; ?>
<?php else: ?><?php echo $this->_tpl_vars['product']['list_discount_prc']; ?>
<?php endif; ?></span>%</em>
			</div>
		<!--discount_label_update_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
--></div>
	<?php endif; ?>
<?php $this->_smarty_vars['capture']["discount_label_".($this->_tpl_vars['obj_prefix']).($this->_tpl_vars['obj_id'])] = ob_get_contents(); ob_end_clean(); ?>
<?php if ($this->_tpl_vars['no_capture']): ?>
	<?php $this->assign('capture_name', "discount_label_".($this->_tpl_vars['obj_prefix']).($this->_tpl_vars['obj_id']), false); ?>
	<?php echo $this->_smarty_vars['capture'][$this->_tpl_vars['capture_name']]; ?>

<?php endif; ?>

<?php ob_start(); ?>
<?php if ($this->_tpl_vars['show_product_amount'] && $this->_tpl_vars['product']['is_edp'] != 'Y' && $this->_tpl_vars['settings']['General']['inventory_tracking'] == 'Y'): ?>
	<span class="cm-reload-<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
 stock-wrap" id="product_amount_update_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
">
		<input type="hidden" name="appearance[show_product_amount]" value="<?php echo $this->_tpl_vars['show_product_amount']; ?>
" />
		<?php if (! $this->_tpl_vars['product']['hide_stock_info']): ?>
			<?php if ($this->_tpl_vars['settings']['Appearance']['in_stock_field'] == 'Y'): ?>
				<?php if ($this->_tpl_vars['product']['tracking'] != 'D'): ?>
					<?php if (( $this->_tpl_vars['product_amount'] > 0 && $this->_tpl_vars['product_amount'] >= $this->_tpl_vars['product']['min_qty'] ) && $this->_tpl_vars['settings']['General']['inventory_tracking'] == 'Y' || $this->_tpl_vars['details_page']): ?>
						<?php if (( $this->_tpl_vars['product_amount'] > 0 && $this->_tpl_vars['product_amount'] >= $this->_tpl_vars['product']['min_qty'] ) && $this->_tpl_vars['settings']['General']['inventory_tracking'] == 'Y'): ?>
							<div class="form-field product-list-field">
								<label><?php echo fn_get_lang_var('in_stock', $this->getLanguage()); ?>
:</label>
								<span id="qty_in_stock_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
" class="qty-in-stock">
									<?php echo $this->_tpl_vars['product_amount']; ?>
&nbsp;<?php echo fn_get_lang_var('items', $this->getLanguage()); ?>

								</span>	
							</div>
						<?php elseif ($this->_tpl_vars['settings']['General']['inventory_tracking'] == 'Y' && $this->_tpl_vars['settings']['General']['allow_negative_amount'] != 'Y'): ?>
							<p class="out-of-stock"><?php echo fn_get_lang_var('text_out_of_stock', $this->getLanguage()); ?>
</p>
						<?php endif; ?>
					<?php endif; ?>
				<?php endif; ?>
			<?php else: ?>
				<?php if (( ( ( $this->_tpl_vars['product_amount'] > 0 && $this->_tpl_vars['product_amount'] >= $this->_tpl_vars['product']['min_qty'] ) || $this->_tpl_vars['product']['tracking'] == 'D' ) && $this->_tpl_vars['settings']['General']['inventory_tracking'] == 'Y' && $this->_tpl_vars['settings']['General']['allow_negative_amount'] != 'Y' ) || ( $this->_tpl_vars['settings']['General']['inventory_tracking'] == 'Y' && $this->_tpl_vars['settings']['General']['allow_negative_amount'] == 'Y' )): ?>
					<span class="in-stock" id="in_stock_info_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
"><?php echo fn_get_lang_var('in_stock', $this->getLanguage()); ?>
</span>
				<?php elseif ($this->_tpl_vars['details_page'] && ( $this->_tpl_vars['product_amount'] <= 0 || $this->_tpl_vars['product_amount'] < $this->_tpl_vars['product']['min_qty'] ) && $this->_tpl_vars['settings']['General']['inventory_tracking'] == 'Y' && $this->_tpl_vars['settings']['General']['allow_negative_amount'] != 'Y'): ?>
					<span class="out-of-stock" id="out_of_stock_info_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
"><?php echo fn_get_lang_var('text_out_of_stock', $this->getLanguage()); ?>
</span>
				<?php endif; ?>
			<?php endif; ?>
		<?php endif; ?>
	<!--product_amount_update_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
--></span>
<?php endif; ?>
<?php $this->_smarty_vars['capture']["product_amount_".($this->_tpl_vars['obj_id'])] = ob_get_contents(); ob_end_clean(); ?>
<?php if ($this->_tpl_vars['no_capture']): ?>
	<?php $this->assign('capture_name', "product_amount_".($this->_tpl_vars['obj_id']), false); ?>
	<?php echo $this->_smarty_vars['capture'][$this->_tpl_vars['capture_name']]; ?>

<?php endif; ?>

<?php ob_start(); ?>
	<?php if ($this->_tpl_vars['show_product_options']): ?>
	<div class="cm-reload-<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
" id="product_options_update_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
">
		<input type="hidden" name="appearance[show_product_options]" value="<?php echo $this->_tpl_vars['show_product_options']; ?>
" />
		<?php if ($this->_tpl_vars['addons']['product_configurator']['status'] == 'A'): ?><?php ob_start(); $this->_in_capture[] = '010df988c0f8297f113c64267c9bf81a';
$_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/product_configurator/hooks/products/product_option_content.override.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
$this->_tpl_vars['addon_content'] = ob_get_contents(); ob_end_clean(); array_pop($this->_in_capture); if (!empty($this->_scripts['010df988c0f8297f113c64267c9bf81a'])) { echo implode("\n", $this->_scripts['010df988c0f8297f113c64267c9bf81a']); unset($this->_scripts['010df988c0f8297f113c64267c9bf81a']); }
 ?><?php else: ?><?php $this->assign('addon_content', "", false); ?><?php endif; ?><?php if (trim($this->_tpl_vars['addon_content'])): ?><?php echo $this->_tpl_vars['addon_content']; ?>
<?php else: ?><?php $this->_tag_stack[] = array('hook', array('name' => "products:product_option_content")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			<?php if ($this->_tpl_vars['disable_ids']): ?>
				<?php $this->assign('_disable_ids', ($this->_tpl_vars['disable_ids']).($this->_tpl_vars['obj_id']), false); ?>
			<?php else: ?>
				<?php $this->assign('_disable_ids', "", false); ?>
			<?php endif; ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/products/components/product_options.tpl", 'smarty_include_vars' => array('id' => $this->_tpl_vars['obj_id'],'product_options' => $this->_tpl_vars['product']['product_options'],'name' => 'product_data','capture_options_vs_qty' => $this->_tpl_vars['capture_options_vs_qty'],'disable_ids' => $this->_tpl_vars['_disable_ids'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php if ($this->_tpl_vars['addons']['recurring_billing']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/recurring_billing/hooks/products/product_option_content.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php endif; ?>
	<!--product_options_update_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
--></div>
	<?php endif; ?>
<?php $this->_smarty_vars['capture']["product_options_".($this->_tpl_vars['obj_id'])] = ob_get_contents(); ob_end_clean(); ?>
<?php if ($this->_tpl_vars['no_capture']): ?>
	<?php $this->assign('capture_name', "product_options_".($this->_tpl_vars['obj_id']), false); ?>
	<?php echo $this->_smarty_vars['capture'][$this->_tpl_vars['capture_name']]; ?>

<?php endif; ?>

<?php ob_start(); ?>
	<?php if ($this->_tpl_vars['show_product_options']): ?>
		<div class="cm-reload-<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
" id="advanced_options_update_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
">
			<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('company_name' => $this->_tpl_vars['product']['company_name'], 'company_id' => $this->_tpl_vars['product']['company_id'], )); ?><?php if (@PRODUCT_TYPE == 'MULTIVENDOR'): ?>
<?php $this->assign('lang_vendor_supplier', fn_get_lang_var('vendor', $this->getLanguage()), false); ?>
<?php else: ?>
<?php $this->assign('lang_vendor_supplier', fn_get_lang_var('supplier', $this->getLanguage()), false); ?>
<?php endif; ?>

		<?php if (( $this->_tpl_vars['company_name'] || $this->_tpl_vars['company_id'] ) && $this->_tpl_vars['settings']['Suppliers']['display_supplier'] == 'Y'): ?>
			<div class="form-field<?php if (! $this->_tpl_vars['capture_options_vs_qty']): ?> product-list-field<?php endif; ?>">
				<label><?php echo $this->_tpl_vars['lang_vendor_supplier']; ?>
:</label>
				<span><?php if ($this->_tpl_vars['company_name']): ?><?php echo $this->_tpl_vars['company_name']; ?>
<?php else: ?><?php echo fn_get_company_name($this->_tpl_vars['company_id']); ?>
<?php endif; ?></span>
			</div>
		<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
			<?php $this->_tag_stack[] = array('hook', array('name' => "products:options_advanced")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if ($this->_tpl_vars['addons']['required_products']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><?php if ($this->_tpl_vars['show_product_status'] && $this->_tpl_vars['product']['bought'] == 'Y'): ?>
<p><strong><?php echo fn_get_lang_var('bought', $this->getLanguage()); ?>
</strong></p>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?>
			<?php if ($this->_tpl_vars['addons']['rma']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/rma/hooks/products/options_advanced.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['reward_points']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/reward_points/hooks/products/options_advanced.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		<!--advanced_options_update_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
--></div>
	<?php endif; ?>
<?php $this->_smarty_vars['capture']["advanced_options_".($this->_tpl_vars['obj_id'])] = ob_get_contents(); ob_end_clean(); ?>
<?php if ($this->_tpl_vars['no_capture']): ?>
	<?php $this->assign('capture_name', "advanced_options_".($this->_tpl_vars['obj_id']), false); ?>
	<?php echo $this->_smarty_vars['capture'][$this->_tpl_vars['capture_name']]; ?>

<?php endif; ?>

<?php ob_start(); ?>
	<?php $this->_tag_stack[] = array('hook', array('name' => "products:qty")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<?php if ($this->_tpl_vars['show_qty']): ?>
		<div class="cm-reload-<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
" id="qty_update_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
">
		<input type="hidden" name="appearance[show_qty]" value="<?php echo $this->_tpl_vars['show_qty']; ?>
" />
		<input type="hidden" name="appearance[capture_options_vs_qty]" value="<?php echo $this->_tpl_vars['capture_options_vs_qty']; ?>
" />
		<?php if (! empty ( $this->_tpl_vars['product']['selected_amount'] )): ?>
			<?php $this->assign('default_amount', $this->_tpl_vars['product']['selected_amount'], false); ?>
		<?php elseif (! empty ( $this->_tpl_vars['product']['min_qty'] )): ?>
			<?php $this->assign('default_amount', $this->_tpl_vars['product']['min_qty'], false); ?>
		<?php elseif (! empty ( $this->_tpl_vars['product']['qty_step'] )): ?>
			<?php $this->assign('default_amount', $this->_tpl_vars['product']['qty_step'], false); ?>
		<?php else: ?>
			<?php $this->assign('default_amount', '1', false); ?>
		<?php endif; ?>
		<?php if (( $this->_tpl_vars['product']['qty_content'] || $this->_tpl_vars['show_qty'] ) && $this->_tpl_vars['product']['is_edp'] !== 'Y' && $this->_tpl_vars['cart_button_exists'] == true && ( $this->_tpl_vars['settings']['General']['allow_anonymous_shopping'] == 'Y' || $this->_tpl_vars['auth']['user_id'] )): ?>
			<div class="qty <?php if ($this->_tpl_vars['quick_view']): ?> form-field<?php if (! $this->_tpl_vars['capture_options_vs_qty']): ?> product-list-field<?php endif; ?><?php endif; ?><?php if ($this->_tpl_vars['settings']['Appearance']['quantity_changer'] == 'Y'): ?> changer<?php endif; ?>" id="qty_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
">
				<label for="qty_count_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
"><?php echo smarty_modifier_default(@$this->_tpl_vars['quantity_text'], fn_get_lang_var('qty', $this->getLanguage())); ?>
:</label>
				<?php if ($this->_tpl_vars['product']['qty_content']): ?>
				<select name="product_data[<?php echo $this->_tpl_vars['obj_id']; ?>
][amount]" id="qty_count_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
">
				<?php $this->assign('a_name', "product_amount_".($this->_tpl_vars['obj_prefix']).($this->_tpl_vars['obj_id']), false); ?>
				<?php $this->assign('selected_amount', false, false); ?>
				<?php $_from = $this->_tpl_vars['product']['qty_content']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach[($this->_tpl_vars['a_name'])] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach[($this->_tpl_vars['a_name'])]['total'] > 0):
    foreach ($_from as $this->_tpl_vars['var']):
        $this->_foreach[($this->_tpl_vars['a_name'])]['iteration']++;
?>
					<option value="<?php echo $this->_tpl_vars['var']; ?>
" <?php if ($this->_tpl_vars['product']['selected_amount'] && ( $this->_tpl_vars['product']['selected_amount'] == $this->_tpl_vars['var'] || ( ($this->_foreach[$this->_tpl_vars['a_name']]['iteration'] == $this->_foreach[$this->_tpl_vars['a_name']]['total']) && ! $this->_tpl_vars['selected_amount'] ) )): ?><?php $this->assign('selected_amount', true, false); ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['var']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
				</select>
				<?php else: ?>
				<?php if ($this->_tpl_vars['settings']['Appearance']['quantity_changer'] == 'Y'): ?>
				<div class="center valign cm-value-changer">
					<a class="cm-increase"></a>
					<?php endif; ?>
					<input type="text" size="5" class="input-text-short cm-amount" id="qty_count_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
" name="product_data[<?php echo $this->_tpl_vars['obj_id']; ?>
][amount]" value="<?php echo $this->_tpl_vars['default_amount']; ?>
"<?php if ($this->_tpl_vars['product']['qty_step'] > 1): ?> data-ca-step="<?php echo $this->_tpl_vars['product']['qty_step']; ?>
"<?php endif; ?> />
					<?php if ($this->_tpl_vars['settings']['Appearance']['quantity_changer'] == 'Y'): ?>
					<a class="cm-decrease"></a>
				</div>
				<?php endif; ?>
				<?php endif; ?>
			</div>
			<?php if ($this->_tpl_vars['product']['prices']): ?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/products/components/products_qty_discounts.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php endif; ?>
		<?php elseif (! $this->_tpl_vars['bulk_add']): ?>
			<input type="hidden" name="product_data[<?php echo $this->_tpl_vars['obj_id']; ?>
][amount]" value="<?php echo $this->_tpl_vars['default_amount']; ?>
" />
		<?php endif; ?>
		<!--qty_update_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
--></div>
	<?php endif; ?>
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php $this->_smarty_vars['capture']["qty_".($this->_tpl_vars['obj_id'])] = ob_get_contents(); ob_end_clean(); ?>
<?php if ($this->_tpl_vars['no_capture']): ?>
	<?php $this->assign('capture_name', "qty_".($this->_tpl_vars['obj_id']), false); ?>
	<?php echo $this->_smarty_vars['capture'][$this->_tpl_vars['capture_name']]; ?>

<?php endif; ?>

<?php ob_start(); ?>
	<?php if ($this->_tpl_vars['min_qty'] && $this->_tpl_vars['product']['min_qty']): ?>
		<p class="description"><?php echo smarty_modifier_replace(smarty_modifier_replace(fn_get_lang_var('text_cart_min_qty', $this->getLanguage()), "[product]", $this->_tpl_vars['product']['product']), "[quantity]", $this->_tpl_vars['product']['min_qty']); ?>
.</p>
	<?php endif; ?>
<?php $this->_smarty_vars['capture']["min_qty_".($this->_tpl_vars['obj_id'])] = ob_get_contents(); ob_end_clean(); ?>
<?php if ($this->_tpl_vars['no_capture']): ?>
	<?php $this->assign('capture_name', "min_qty_".($this->_tpl_vars['obj_id']), false); ?>
	<?php echo $this->_smarty_vars['capture'][$this->_tpl_vars['capture_name']]; ?>

<?php endif; ?>

<?php ob_start(); ?>
	<?php if ($this->_tpl_vars['show_edp'] && $this->_tpl_vars['product']['is_edp'] == 'Y'): ?>
		<p class="description"><?php echo fn_get_lang_var('text_edp_product', $this->getLanguage()); ?>
.</p>
		<input type="hidden" name="product_data[<?php echo $this->_tpl_vars['obj_id']; ?>
][is_edp]" value="Y" />
	<?php endif; ?>
<?php $this->_smarty_vars['capture']["product_edp_".($this->_tpl_vars['obj_id'])] = ob_get_contents(); ob_end_clean(); ?>
<?php if ($this->_tpl_vars['no_capture']): ?>
	<?php $this->assign('capture_name', "product_edp_".($this->_tpl_vars['obj_id']), false); ?>
	<?php echo $this->_smarty_vars['capture'][$this->_tpl_vars['capture_name']]; ?>

<?php endif; ?>

<?php ob_start(); ?>
<?php if (! $this->_tpl_vars['hide_form']): ?>
</form>
<?php endif; ?>
<?php $this->_smarty_vars['capture']["form_close_".($this->_tpl_vars['obj_id'])] = ob_get_contents(); ob_end_clean(); ?>
<?php if ($this->_tpl_vars['no_capture']): ?>
	<?php $this->assign('capture_name', "form_close_".($this->_tpl_vars['obj_id']), false); ?>
	<?php echo $this->_smarty_vars['capture'][$this->_tpl_vars['capture_name']]; ?>

<?php endif; ?>

<?php $_from = $this->_tpl_vars['images']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['object_id'] => $this->_tpl_vars['image']):
?>
	<div class="cm-reload-<?php echo $this->_tpl_vars['image']['obj_id']; ?>
" id="<?php echo $this->_tpl_vars['object_id']; ?>
">
		<?php if ($this->_tpl_vars['image']['link']): ?>
			<a href="<?php echo $this->_tpl_vars['image']['link']; ?>
">
			<input type="hidden" value="<?php echo $this->_tpl_vars['image']['link']; ?>
" name="image[<?php echo $this->_tpl_vars['object_id']; ?>
][link]" />
		<?php endif; ?>
		<input type="hidden" value="<?php echo $this->_tpl_vars['image']['obj_id']; ?>
,<?php echo $this->_tpl_vars['image']['width']; ?>
,<?php echo $this->_tpl_vars['image']['height']; ?>
,<?php echo $this->_tpl_vars['image']['type']; ?>
" name="image[<?php echo $this->_tpl_vars['object_id']; ?>
][data]" />
		<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('image_width' => $this->_tpl_vars['image']['width'], 'image_height' => $this->_tpl_vars['image']['height'], 'show_thumbnail' => 'Y', 'obj_id' => $this->_tpl_vars['object_id'], 'images' => $this->_tpl_vars['product']['main_pair'], 'object_type' => 'product', )); ?>
<?php echo ''; ?><?php if ($this->_tpl_vars['capture_image']): ?><?php echo ''; ?><?php ob_start(); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if (! $this->_tpl_vars['obj_id']): ?><?php echo ''; ?><?php echo smarty_function_math(array('equation' => "rand()",'assign' => 'obj_id'), $this);?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php $this->assign('flash', false, false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['show_thumbnail'] != 'Y'): ?><?php echo ''; ?><?php if (! $this->_tpl_vars['image_width']): ?><?php echo ''; ?><?php if ($this->_tpl_vars['images']['icon']['image_x']): ?><?php echo ''; ?><?php $this->assign('image_width', $this->_tpl_vars['images']['icon']['image_x'], false); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['images']['icon']['image_y']): ?><?php echo ''; ?><?php $this->assign('image_height', $this->_tpl_vars['images']['icon']['image_y'], false); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if (! $this->_tpl_vars['image_width'] || ! $this->_tpl_vars['image_height']): ?><?php echo ''; ?><?php if ($this->_tpl_vars['images']['detailed']['image_x']): ?><?php echo ''; ?><?php $this->assign('image_width', $this->_tpl_vars['images']['detailed']['image_x'], false); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['images']['detailed']['image_y']): ?><?php echo ''; ?><?php $this->assign('image_height', $this->_tpl_vars['images']['detailed']['image_y'], false); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php if ($this->_tpl_vars['images']['icon']['image_x'] && $this->_tpl_vars['images']['icon']['image_y']): ?><?php echo ''; ?><?php echo smarty_function_math(array('equation' => "new_x * y / x",'new_x' => $this->_tpl_vars['image_width'],'x' => $this->_tpl_vars['images']['icon']['image_x'],'y' => $this->_tpl_vars['images']['icon']['image_y'],'format' => "%d",'assign' => 'image_height'), $this);?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if (! $this->_tpl_vars['image_height'] && $this->_tpl_vars['images']['detailed']['image_x'] && $this->_tpl_vars['images']['detailed']['image_y']): ?><?php echo ''; ?><?php echo smarty_function_math(array('equation' => "new_x * y / x",'new_x' => $this->_tpl_vars['image_width'],'x' => $this->_tpl_vars['images']['detailed']['image_x'],'y' => $this->_tpl_vars['images']['detailed']['image_y'],'format' => "%d",'assign' => 'image_height'), $this);?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['max_width'] && ! $this->_tpl_vars['image_width']): ?><?php echo ''; ?><?php if ($this->_tpl_vars['images']['icon']['image_x']): ?><?php echo ''; ?><?php $this->assign('image_width', $this->_tpl_vars['images']['icon']['image_x'], false); ?><?php echo ''; ?><?php elseif ($this->_tpl_vars['images']['detailed']['image_x']): ?><?php echo ''; ?><?php $this->assign('image_width', $this->_tpl_vars['images']['detailed']['image_x'], false); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['max_height'] && ! $this->_tpl_vars['image_height']): ?><?php echo ''; ?><?php if ($this->_tpl_vars['images']['icon']['image_y']): ?><?php echo ''; ?><?php $this->assign('image_height', $this->_tpl_vars['images']['icon']['image_y'], false); ?><?php echo ''; ?><?php elseif ($this->_tpl_vars['images']['detailed']['image_y']): ?><?php echo ''; ?><?php $this->assign('image_height', $this->_tpl_vars['images']['detailed']['image_y'], false); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['max_width'] && $this->_tpl_vars['image_width'] && $this->_tpl_vars['image_width'] > $this->_tpl_vars['max_width']): ?><?php echo ''; ?><?php $this->assign('image_width', $this->_tpl_vars['max_width'], false); ?><?php echo ''; ?><?php echo smarty_function_math(array('equation' => "new_x * y / x",'new_x' => $this->_tpl_vars['image_width'],'x' => smarty_modifier_default(@$this->_tpl_vars['images']['icon']['image_x'], @$this->_tpl_vars['images']['detailed']['image_x']),'y' => smarty_modifier_default(@$this->_tpl_vars['images']['icon']['image_y'], @$this->_tpl_vars['images']['detailed']['image_y']),'format' => "%d",'assign' => 'image_height'), $this);?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['max_height'] && $this->_tpl_vars['image_height'] && $this->_tpl_vars['image_height'] > $this->_tpl_vars['max_height']): ?><?php echo ''; ?><?php $this->assign('image_height', $this->_tpl_vars['max_height'], false); ?><?php echo ''; ?><?php echo smarty_function_math(array('equation' => "new_y * x / y",'new_y' => $this->_tpl_vars['image_height'],'y' => smarty_modifier_default(@$this->_tpl_vars['images']['icon']['image_y'], @$this->_tpl_vars['images']['detailed']['image_y']),'x' => smarty_modifier_default(@$this->_tpl_vars['images']['icon']['image_x'], @$this->_tpl_vars['images']['detailed']['image_x']),'format' => "%d",'assign' => 'image_width'), $this);?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['images']['icon']): ?><?php echo ''; ?><?php $this->assign('image_id', $this->_tpl_vars['images']['image_id'], false); ?><?php echo ''; ?><?php elseif ($this->_tpl_vars['images']['detailed']): ?><?php echo ''; ?><?php $this->assign('image_id', $this->_tpl_vars['images']['detailed_id'], false); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['show_detailed_link'] && $this->_tpl_vars['images']['detailed_id']): ?><?php echo '<span class="'; ?><?php if (! $this->_tpl_vars['images']['detailed_id'] || $this->_tpl_vars['flash']): ?><?php echo 'hidden'; ?><?php endif; ?><?php echo ' '; ?><?php echo $this->_tpl_vars['detailed_link_class']; ?><?php echo ' larger-image-wrap center" id="box_det_img_link_'; ?><?php echo $this->_tpl_vars['obj_id']; ?><?php echo '"><a class="cm-external-click cm-view-larger-image" rev="det_img_link_'; ?><?php echo $this->_tpl_vars['obj_id']; ?><?php echo '" title="'; ?><?php echo fn_get_lang_var('view_larger_image', $this->getLanguage()); ?><?php echo '"></a></span>'; ?><?php endif; ?><?php echo ''; ?><?php if (! $this->_tpl_vars['images']['icon']['is_flash'] && ! $this->_tpl_vars['images']['detailed']['is_flash']): ?><?php echo ''; ?><?php if ($this->_tpl_vars['show_thumbnail'] == 'Y' && ( $this->_tpl_vars['image_width'] || $this->_tpl_vars['image_height'] ) && $this->_tpl_vars['image_id']): ?><?php echo ''; ?><?php if ($this->_tpl_vars['image_width'] && $this->_tpl_vars['image_height']): ?><?php echo ''; ?><?php $this->assign('make_box', true, false); ?><?php echo ''; ?><?php $this->assign('proportional', true, false); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php $this->assign('object_type', smarty_modifier_default(@$this->_tpl_vars['object_type'], 'product'), false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['images']['icon']['image_path']): ?><?php echo ''; ?><?php $this->assign('image_path', $this->_tpl_vars['images']['icon']['image_path'], false); ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php $this->assign('image_path', $this->_tpl_vars['images']['detailed']['image_path'], false); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php $this->assign('icon_image_path', smarty_modifier_escape(fn_generate_thumbnail(smarty_modifier_unescape($this->_tpl_vars['image_path']), $this->_tpl_vars['image_width'], $this->_tpl_vars['image_height'], $this->_tpl_vars['make_box'])), false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['absolute_image_path']): ?><?php echo ''; ?><?php $this->assign('icon_image_path', fn_convert_relative_to_absolute_image_url($this->_tpl_vars['icon_image_path']), false); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['make_box'] && ! $this->_tpl_vars['proportional']): ?><?php echo ''; ?><?php $this->assign('image_height', $this->_tpl_vars['image_width'], false); ?><?php echo ''; ?><?php elseif ($this->_tpl_vars['object_type'] == 'detailed_product'): ?><?php echo ''; ?><?php if (! $this->_tpl_vars['image_height'] && $this->_tpl_vars['image_width']): ?><?php echo ''; ?><?php if ($this->_tpl_vars['images']['icon']['image_x'] && $this->_tpl_vars['images']['icon']['image_y']): ?><?php echo ''; ?><?php echo smarty_function_math(array('equation' => "new_x * y / x",'new_x' => $this->_tpl_vars['image_width'],'x' => $this->_tpl_vars['images']['icon']['image_x'],'y' => $this->_tpl_vars['images']['icon']['image_y'],'format' => "%d",'assign' => 'image_height'), $this);?><?php echo ''; ?><?php elseif ($this->_tpl_vars['images']['detailed']['image_x'] && $this->_tpl_vars['images']['detailed']['image_y']): ?><?php echo ''; ?><?php echo smarty_function_math(array('equation' => "new_x * y / x",'new_x' => $this->_tpl_vars['image_width'],'x' => $this->_tpl_vars['images']['detailed']['image_x'],'y' => $this->_tpl_vars['images']['detailed']['image_y'],'format' => "%d",'assign' => 'image_height'), $this);?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php elseif (! $this->_tpl_vars['image_width'] && $this->_tpl_vars['image_height']): ?><?php echo ''; ?><?php if ($this->_tpl_vars['images']['icon']['image_x'] && $this->_tpl_vars['images']['icon']['image_y']): ?><?php echo ''; ?><?php echo smarty_function_math(array('equation' => "new_x * y / x",'new_x' => $this->_tpl_vars['image_height'],'x' => $this->_tpl_vars['images']['icon']['image_y'],'y' => $this->_tpl_vars['images']['icon']['image_x'],'format' => "%d",'assign' => 'image_width'), $this);?><?php echo ''; ?><?php elseif ($this->_tpl_vars['images']['detailed']['image_x'] && $this->_tpl_vars['images']['detailed']['image_y']): ?><?php echo ''; ?><?php echo smarty_function_math(array('equation' => "new_x * y / x",'new_x' => $this->_tpl_vars['image_height'],'x' => $this->_tpl_vars['images']['detailed']['image_y'],'y' => $this->_tpl_vars['images']['detailed']['image_x'],'format' => "%d",'assign' => 'image_width'), $this);?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php $this->assign('icon_image_path', $this->_tpl_vars['images']['icon']['image_path'], false); ?><?php echo ''; ?><?php if (! $this->_tpl_vars['icon_image_path']): ?><?php echo ''; ?><?php if ($this->_tpl_vars['object_type'] == 'detailed_product' && $this->_tpl_vars['images']['detailed']['image_x']): ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['Thumbnails']['product_details_thumbnail_width']): ?><?php echo ''; ?><?php $this->assign('image_width', $this->_tpl_vars['settings']['Thumbnails']['product_details_thumbnail_width'], false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['make_box'] && ! $this->_tpl_vars['proportional']): ?><?php echo ''; ?><?php $this->assign('image_height', $this->_tpl_vars['image_width'], false); ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_function_math(array('equation' => "new_x * y / x",'new_x' => $this->_tpl_vars['image_width'],'x' => $this->_tpl_vars['images']['detailed']['image_x'],'y' => $this->_tpl_vars['images']['detailed']['image_y'],'format' => "%d",'assign' => 'image_height'), $this);?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php $this->assign('icon_image_path', smarty_modifier_escape(fn_generate_thumbnail(smarty_modifier_unescape($this->_tpl_vars['images']['detailed']['image_path']), $this->_tpl_vars['image_width'], $this->_tpl_vars['image_height'], $this->_tpl_vars['make_box'])), false); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['show_detailed_link'] && $this->_tpl_vars['images']['detailed_id']): ?><?php echo ''; ?><?php if ($this->_tpl_vars['object_type'] == 'detailed_product' && ( $this->_tpl_vars['settings']['Thumbnails']['product_detailed_image_width'] || $this->_tpl_vars['settings']['Thumbnails']['product_detailed_image_height'] )): ?><?php echo ''; ?><?php $this->assign('detailed_image_path', smarty_modifier_escape(fn_generate_thumbnail(smarty_modifier_unescape($this->_tpl_vars['images']['detailed']['image_path']), $this->_tpl_vars['settings']['Thumbnails']['product_detailed_image_width'], $this->_tpl_vars['settings']['Thumbnails']['product_detailed_image_height'], $this->_tpl_vars['make_box'])), false); ?><?php echo ''; ?><?php elseif ($this->_tpl_vars['object_type'] == 'detailed_category' && ( $this->_tpl_vars['settings']['Thumbnails']['category_detailed_image_width'] || $this->_tpl_vars['settings']['Thumbnails']['category_detailed_image_height'] )): ?><?php echo ''; ?><?php $this->assign('detailed_image_path', smarty_modifier_escape(fn_generate_thumbnail(smarty_modifier_unescape($this->_tpl_vars['images']['detailed']['image_path']), $this->_tpl_vars['settings']['Thumbnails']['category_detailed_image_width'], $this->_tpl_vars['settings']['Thumbnails']['category_detailed_image_height'], $this->_tpl_vars['make_box'])), false); ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php $this->assign('detailed_image_path', $this->_tpl_vars['images']['detailed']['image_path'], false); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['icon_image_path'] || ! $this->_tpl_vars['hide_if_no_image']): ?><?php echo ''; ?><?php if ($this->_tpl_vars['detailed_image_path'] || $this->_tpl_vars['wrap_image']): ?><?php echo '<a id="det_img_link_'; ?><?php echo $this->_tpl_vars['obj_id']; ?><?php echo '" '; ?><?php if ($this->_tpl_vars['detailed_image_path'] && $this->_tpl_vars['rel']): ?><?php echo 'rel="'; ?><?php echo $this->_tpl_vars['rel']; ?><?php echo '"'; ?><?php endif; ?><?php echo ' '; ?><?php if ($this->_tpl_vars['rel']): ?><?php echo 'rev="'; ?><?php echo $this->_tpl_vars['rel']; ?><?php echo '"'; ?><?php endif; ?><?php echo ' class="'; ?><?php echo $this->_tpl_vars['link_class']; ?><?php echo ' '; ?><?php if ($this->_tpl_vars['detailed_image_path']): ?><?php echo 'cm-previewer'; ?><?php endif; ?><?php echo '" '; ?><?php if ($this->_tpl_vars['detailed_image_path']): ?><?php echo 'href="'; ?><?php echo $this->_tpl_vars['detailed_image_path']; ?><?php echo '" title="'; ?><?php echo $this->_tpl_vars['images']['detailed']['alt']; ?><?php echo '"'; ?><?php endif; ?><?php echo '>'; ?><?php endif; ?><?php echo ''; ?><?php $this->assign('alt_text', smarty_modifier_default(@$this->_tpl_vars['images']['icon']['alt'], @$this->_tpl_vars['images']['detailed']['alt']), false); ?><?php echo '<img class="'; ?><?php echo $this->_tpl_vars['valign']; ?><?php echo ' '; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '"  '; ?><?php if ($this->_tpl_vars['obj_id'] && ! $this->_tpl_vars['no_ids']): ?><?php echo 'id="det_img_'; ?><?php echo $this->_tpl_vars['obj_id']; ?><?php echo '"'; ?><?php endif; ?><?php echo ' src="'; ?><?php echo $this->_tpl_vars['config']['full_host_name']; ?><?php echo ''; ?><?php echo smarty_modifier_default(@$this->_tpl_vars['icon_image_path'], @$this->_tpl_vars['config']['no_image_path']); ?><?php echo '" '; ?><?php if ($this->_tpl_vars['image_width']): ?><?php echo 'width="'; ?><?php echo $this->_tpl_vars['image_width']; ?><?php echo '"'; ?><?php endif; ?><?php echo ' '; ?><?php if ($this->_tpl_vars['image_height']): ?><?php echo 'height="'; ?><?php echo $this->_tpl_vars['image_height']; ?><?php echo '"'; ?><?php endif; ?><?php echo ' alt="'; ?><?php echo $this->_tpl_vars['alt_text']; ?><?php echo '" title="'; ?><?php echo $this->_tpl_vars['alt_text']; ?><?php echo '" '; ?><?php if ($this->_tpl_vars['image_onclick']): ?><?php echo 'onclick="'; ?><?php echo $this->_tpl_vars['image_onclick']; ?><?php echo '"'; ?><?php endif; ?><?php echo ' border="0" />'; ?><?php if ($this->_tpl_vars['detailed_image_path'] || $this->_tpl_vars['wrap_image']): ?><?php echo '</a>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php $this->assign('flash', true, false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['images']['icon']['is_flash']): ?><?php echo ''; ?><?php $this->assign('flash_path', $this->_tpl_vars['images']['icon']['image_path'], false); ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php $this->assign('flash_path', $this->_tpl_vars['images']['detailed']['image_path'], false); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php $this->assign('icon_image_path', smarty_modifier_default(@$this->_tpl_vars['flash_path'], @$this->_tpl_vars['config']['no_image_path']), false); ?><?php echo ''; ?><?php $this->assign('detailed_image_path', smarty_modifier_default(@$this->_tpl_vars['flash_path'], @$this->_tpl_vars['config']['no_image_path']), false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['show_detailed_link'] && $this->_tpl_vars['images']['detailed_id'] || $this->_tpl_vars['wrap_image']): ?><?php echo '<a id="det_img_link_'; ?><?php echo $this->_tpl_vars['obj_id']; ?><?php echo '" '; ?><?php if ($this->_tpl_vars['rel']): ?><?php echo 'rel="'; ?><?php echo $this->_tpl_vars['rel']; ?><?php echo '"'; ?><?php endif; ?><?php echo ' '; ?><?php if ($this->_tpl_vars['rel']): ?><?php echo 'rev="'; ?><?php echo $this->_tpl_vars['rel']; ?><?php echo '"'; ?><?php endif; ?><?php echo ' class="'; ?><?php echo $this->_tpl_vars['link_class']; ?><?php echo ' swf-thumb '; ?><?php if ($this->_tpl_vars['show_detailed_link'] && $this->_tpl_vars['images']['detailed_id']): ?><?php echo 'cm-previewer'; ?><?php endif; ?><?php echo '" '; ?><?php if ($this->_tpl_vars['show_detailed_link'] && $this->_tpl_vars['images']['detailed_id']): ?><?php echo 'href="'; ?><?php echo $this->_tpl_vars['config']['full_host_name']; ?><?php echo ''; ?><?php echo smarty_modifier_default(@$this->_tpl_vars['flash_path'], @$this->_tpl_vars['config']['no_image_path']); ?><?php echo '"'; ?><?php endif; ?><?php echo ' onclick="return false;">'; ?><?php endif; ?><?php echo '<span id="'; ?><?php echo $this->_tpl_vars['obj_id']; ?><?php echo '" '; ?><?php if ($this->_tpl_vars['image_onclick']): ?><?php echo 'onmousedown="'; ?><?php echo $this->_tpl_vars['image_onclick']; ?><?php echo '"'; ?><?php endif; ?><?php echo ' class="option-changer '; ?><?php if ($this->_tpl_vars['_class']): ?><?php echo ''; ?><?php echo $this->_tpl_vars['_class']; ?><?php echo ' object-image'; ?><?php endif; ?><?php echo '" style="'; ?><?php if ($this->_tpl_vars['image_width']): ?><?php echo 'width: '; ?><?php echo $this->_tpl_vars['image_width']; ?><?php echo 'px;'; ?><?php endif; ?><?php echo ' '; ?><?php if ($this->_tpl_vars['image_height']): ?><?php echo 'height: '; ?><?php echo $this->_tpl_vars['image_height']; ?><?php echo 'px;'; ?><?php endif; ?><?php echo ' position: relative; z-index: 0; margin: 3px '; ?><?php if (! ( $this->_tpl_vars['show_detailed_link'] && $this->_tpl_vars['images']['detailed_id'] || $this->_tpl_vars['wrap_image'] )): ?><?php echo 'auto'; ?><?php endif; ?><?php echo ';"><span class="option-changer-container" style="'; ?><?php if ($this->_tpl_vars['image_width']): ?><?php echo 'width: '; ?><?php echo $this->_tpl_vars['image_width']; ?><?php echo 'px;'; ?><?php endif; ?><?php echo ' '; ?><?php if ($this->_tpl_vars['image_height']): ?><?php echo 'height: '; ?><?php echo $this->_tpl_vars['image_height']; ?><?php echo 'px;'; ?><?php endif; ?><?php echo '"><span id="swf_'; ?><?php echo $this->_tpl_vars['obj_id']; ?><?php echo '"></span></span><script type="text/javascript">if (typeof swfobject == \'undefined\') '; ?>{<?php echo 'var res = $.get(\'lib/js/swfobject/swfobject.js\', function() '; ?>{<?php echo 'swfobject.embedSWF("'; ?><?php echo $this->_tpl_vars['config']['full_host_name']; ?><?php echo ''; ?><?php echo smarty_modifier_default(@$this->_tpl_vars['flash_path'], @$this->_tpl_vars['config']['no_image_path']); ?><?php echo '", "swf_'; ?><?php echo $this->_tpl_vars['obj_id']; ?><?php echo '", "'; ?><?php if ($this->_tpl_vars['image_width']): ?><?php echo ''; ?><?php echo $this->_tpl_vars['image_width']; ?><?php echo ''; ?><?php else: ?><?php echo '30'; ?><?php endif; ?><?php echo '", "'; ?><?php if ($this->_tpl_vars['image_height']): ?><?php echo ''; ?><?php echo $this->_tpl_vars['image_height']; ?><?php echo ''; ?><?php else: ?><?php echo '30'; ?><?php endif; ?><?php echo '", "9.0.0", "lib/js/swfobject/expressInstall.swf"'; ?><?php if ($this->_tpl_vars['flash_vars']): ?><?php echo ' ,'; ?><?php echo $this->_tpl_vars['flash_vars']; ?><?php echo ','; ?><?php else: ?><?php echo ',"",'; ?><?php endif; ?><?php echo ' '; ?><?php echo '{wmode: \'opaque\'}'; ?><?php echo ');'; ?>}<?php echo ');'; ?>}<?php echo ' else '; ?>{<?php echo 'swfobject.embedSWF("'; ?><?php echo $this->_tpl_vars['config']['full_host_name']; ?><?php echo ''; ?><?php echo smarty_modifier_default(@$this->_tpl_vars['flash_path'], @$this->_tpl_vars['config']['no_image_path']); ?><?php echo '", "swf_'; ?><?php echo $this->_tpl_vars['obj_id']; ?><?php echo '", "'; ?><?php if ($this->_tpl_vars['image_width']): ?><?php echo ''; ?><?php echo $this->_tpl_vars['image_width']; ?><?php echo ''; ?><?php else: ?><?php echo '30'; ?><?php endif; ?><?php echo '", "'; ?><?php if ($this->_tpl_vars['image_height']): ?><?php echo ''; ?><?php echo $this->_tpl_vars['image_height']; ?><?php echo ''; ?><?php else: ?><?php echo '30'; ?><?php endif; ?><?php echo '", "9.0.0", "lib/js/swfobject/expressInstall.swf"'; ?><?php if ($this->_tpl_vars['flash_vars']): ?><?php echo ' ,'; ?><?php echo $this->_tpl_vars['flash_vars']; ?><?php echo ','; ?><?php else: ?><?php echo ',"",'; ?><?php endif; ?><?php echo ' '; ?><?php echo '{wmode: \'opaque\'}'; ?><?php echo ');'; ?>}<?php echo '</script><span class="option-changer-overlay'; ?><?php if ($this->_tpl_vars['show_detailed_link'] && $this->_tpl_vars['images']['detailed_id']): ?><?php echo ' cm-external-click'; ?><?php endif; ?><?php echo '" '; ?><?php if ($this->_tpl_vars['show_detailed_link'] && $this->_tpl_vars['images']['detailed_id']): ?><?php echo 'rev="det_img_link_'; ?><?php echo $this->_tpl_vars['obj_id']; ?><?php echo '"'; ?><?php endif; ?><?php echo '></span></span>'; ?><?php if ($this->_tpl_vars['show_detailed_link'] && $this->_tpl_vars['images']['detailed_id'] || $this->_tpl_vars['wrap_image']): ?><?php echo '</a>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['capture_image']): ?><?php echo ''; ?><?php $this->_smarty_vars['capture']['image'] = ob_get_contents(); ob_end_clean(); ?><?php echo ''; ?><?php ob_start(); ?><?php echo ''; ?><?php echo smarty_modifier_default(@$this->_tpl_vars['icon_image_path'], @$this->_tpl_vars['config']['no_image_path']); ?><?php echo ''; ?><?php $this->_smarty_vars['capture']['icon_image_path'] = ob_get_contents(); ob_end_clean(); ?><?php echo ''; ?><?php ob_start(); ?><?php echo ''; ?><?php echo smarty_modifier_default(@$this->_tpl_vars['detailed_image_path'], @$this->_tpl_vars['config']['no_image_path']); ?><?php echo ''; ?><?php $this->_smarty_vars['capture']['detailed_image_path'] = ob_get_contents(); ob_end_clean(); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>

<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
		<?php if ($this->_tpl_vars['image']['link']): ?>
			</a>
		<?php endif; ?>
	<!--<?php echo $this->_tpl_vars['object_id']; ?>
--></div>
<?php endforeach; endif; unset($_from); ?>

<?php $this->_tag_stack[] = array('hook', array('name' => "products:product_data")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if ($this->_tpl_vars['addons']['bundled_products']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/bundled_products/hooks/products/product_data.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['recurring_billing']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/recurring_billing/hooks/products/product_data.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>