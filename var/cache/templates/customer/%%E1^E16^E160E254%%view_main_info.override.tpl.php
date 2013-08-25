<?php /* Smarty version 2.6.18, created on 2013-08-25 15:11:44
         compiled from addons/billibuys/hooks/products/view_main_info.override.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'addons/billibuys/hooks/products/view_main_info.override.tpl', 1, false),array('modifier', 'unescape', 'addons/billibuys/hooks/products/view_main_info.override.tpl', 28, false),array('modifier', 'fn_url', 'addons/billibuys/hooks/products/view_main_info.override.tpl', 34, false),array('modifier', 'format_price', 'addons/billibuys/hooks/products/view_main_info.override.tpl', 60, false),array('modifier', 'replace', 'addons/billibuys/hooks/products/view_main_info.override.tpl', 111, false),array('modifier', 'fn_generate_thumbnail', 'addons/billibuys/hooks/products/view_main_info.override.tpl', 324, false),array('modifier', 'escape', 'addons/billibuys/hooks/products/view_main_info.override.tpl', 324, false),array('modifier', 'fn_convert_relative_to_absolute_image_url', 'addons/billibuys/hooks/products/view_main_info.override.tpl', 327, false),array('modifier', 'trim', 'addons/billibuys/hooks/products/view_main_info.override.tpl', 552, false),array('function', 'math', 'addons/billibuys/hooks/products/view_main_info.override.tpl', 242, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('add_to_shopping_cart','price','qty','add_all_to_cart','delete','bundle_unavailable','bb_item_purchased_through_bids','view_larger_image','description'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'buttons/button.tpl' => 1372320684,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php if ($this->_tpl_vars['chains'] && ! $this->_tpl_vars['quick_view']): ?>

	<?php if ($this->_tpl_vars['product']): ?>
		<?php $this->assign('obj_id', $this->_tpl_vars['product']['product_id'], false); ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/product_data.tpl", 'smarty_include_vars' => array('product' => $this->_tpl_vars['product'],'separate_buttons' => smarty_modifier_default(@$this->_tpl_vars['separate_buttons'], true),'but_role' => 'big','but_text' => fn_get_lang_var('add_to_shopping_cart', $this->getLanguage()),'hide_form' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php if (! $this->_tpl_vars['no_images']): ?>
			<div class="image-border float-left center cm-reload-<?php echo $this->_tpl_vars['product']['product_id']; ?>
" id="product_images_<?php echo $this->_tpl_vars['product']['product_id']; ?>
_update">
				<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/products/components/product_images.tpl", 'smarty_include_vars' => array('product' => $this->_tpl_vars['product'],'show_detailed_link' => 'Y')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<!--product_images_<?php echo $this->_tpl_vars['product']['product_id']; ?>
_update--></div>
		<?php endif; ?>
		
		<div class="product-info">
			
		<?php if (! $this->_tpl_vars['hide_title']): ?><h1 class="mainbox-title"><?php echo smarty_modifier_unescape($this->_tpl_vars['product']['product']); ?>
</h1><?php endif; ?>
		<?php $this->assign('rating', "rating_".($this->_tpl_vars['obj_id']), false); ?><?php echo $this->_smarty_vars['capture'][$this->_tpl_vars['rating']]; ?>

		<?php $this->assign('sku', "sku_".($this->_tpl_vars['obj_id']), false); ?><?php echo $this->_smarty_vars['capture'][$this->_tpl_vars['sku']]; ?>

		
			<?php $_from = $this->_tpl_vars['chains']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['chain']):
?>
			<?php $this->assign('obj_prefix', "bp_".($this->_tpl_vars['chain']['chain_id']), false); ?>
			<form <?php if ($this->_tpl_vars['settings']['DHTML']['ajax_add_to_cart'] == 'Y' && ! $this->_tpl_vars['no_ajax']): ?>class="cm-ajax cm-ajax-full-render"<?php endif; ?> action="<?php echo fn_url(""); ?>
" method="post" name="chain_form_<?php echo $this->_tpl_vars['chain']['chain_id']; ?>
" enctype="multipart/form-data">
		
			<input type="hidden" name="redirect_url" value="<?php echo $this->_tpl_vars['config']['current_url']; ?>
" />
			<input type="hidden" name="result_ids" value="cart_status*,wish_list*" />
			<?php if (! $this->_tpl_vars['stay_in_cart']): ?>
				<input type="hidden" name="redirect_url" value="<?php echo $this->_tpl_vars['config']['current_url']; ?>
" />
			<?php endif; ?>
			<input type="hidden" name="product_data[<?php echo $this->_tpl_vars['chain']['product_id']; ?>
_<?php echo $this->_tpl_vars['chain']['chain_id']; ?>
][chain]" value="<?php echo $this->_tpl_vars['chain']['chain_id']; ?>
" />
			<input type="hidden" name="product_data[<?php echo $this->_tpl_vars['chain']['product_id']; ?>
_<?php echo $this->_tpl_vars['chain']['chain_id']; ?>
][product_id]" value="<?php echo $this->_tpl_vars['chain']['product_id']; ?>
" />
			<input type="hidden" name="package" value="Y"/>

			<div class="chain-content clearfix">
				<div class="chain-products scroll-x nowrap clearfix">
				<?php if ($this->_tpl_vars['chain']['products']): ?>
				
					<?php if (! ( ! $this->_tpl_vars['auth']['user_id'] && $this->_tpl_vars['settings']['General']['allow_anonymous_shopping'] == 'P' )): ?>
						<div class="clearfix"></div>
						<table style="width: 90% !important;">
						<tr>
						<td>
							<div class="chain-price">
								<div class="chain-new-price">
									<span class="chain-new"><?php echo fn_get_lang_var('price', $this->getLanguage()); ?>
</span>
									<input type="hidden" name="product_data[<?php echo $this->_tpl_vars['chain']['product_id']; ?>
_<?php echo $this->_tpl_vars['chain']['chain_id']; ?>
][price]" value="<?php echo $this->_tpl_vars['price']; ?>
"/>
									<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['price'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
								</div>
							
							</div>
						</td>
						</tr>
						<tr>
						<td>
										
							<?php if ($this->_tpl_vars['chain']['stock'] != 'N'): ?>

								<?php if (! ( ! $this->_tpl_vars['auth']['user_id'] && $this->_tpl_vars['settings']['General']['allow_anonymous_shopping'] == 'B' )): ?>
									<?php if ($this->_tpl_vars['disable_chains'] != 'Y'): ?>
										<div style="padding: 0 !important;" class="qty <?php if ($this->_tpl_vars['quick_view']): ?> form-field<?php if (! $this->_tpl_vars['capture_options_vs_qty']): ?> product-list-field<?php endif; ?><?php endif; ?><?php if ($this->_tpl_vars['settings']['Appearance']['quantity_changer'] == 'Y'): ?> changer<?php endif; ?>" id="qty_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['chain']['product_id']; ?>
_<?php echo $this->_tpl_vars['chain']['chain_id']; ?>
">
											<label for="qty_count_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['chain']['product_id']; ?>
_<?php echo $this->_tpl_vars['chain']['chain_id']; ?>
"><?php echo smarty_modifier_default(@$this->_tpl_vars['quantity_text'], fn_get_lang_var('qty', $this->getLanguage())); ?>
:</label>
											<div class="center valign cm-value-changer">
												<input type="text" size="5" class="input-text-short cm-amount" id="qty_count_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['chain']['product_id']; ?>
_<?php echo $this->_tpl_vars['chain']['chain_id']; ?>
"  value="<?php echo smarty_modifier_default(($this->_tpl_vars['quantity']), 1); ?>
" disabled />
												<input type="hidden" name="product_data[<?php echo $this->_tpl_vars['chain']['product_id']; ?>
_<?php echo $this->_tpl_vars['chain']['chain_id']; ?>
][amount]" value="<?php echo smarty_modifier_default(($this->_tpl_vars['quantity']), 1); ?>
" />
											</div>
										</div>
									
										<div style="padding-left: 130px;" class="buttons-container cm-buy-together-submit" id="wrap_chain_button_<?php echo $this->_tpl_vars['chain']['chain_id']; ?>
">
												<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('but_text' => fn_get_lang_var('add_all_to_cart', $this->getLanguage()), 'but_id' => "chain_button_".($this->_tpl_vars['chain']['chain_id']), 'but_name' => "dispatch[checkout.add]", 'but_role' => 'action', 'obj_id' => $this->_tpl_vars['obj_id'], )); ?>

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
									
									<?php else: ?>
										<p><?php echo fn_get_lang_var('bundle_unavailable', $this->getLanguage()); ?>
</p>
									<?php endif; ?>
								<?php endif; ?>
							<?php endif; ?>
						</td>
						<td class="right">
							&nbsp;
						</td>
						</table>
					<?php else: ?>
						<p class="price"><?php echo fn_get_lang_var('bb_item_purchased_through_bids', $this->getLanguage()); ?>
</p>
					<?php endif; ?>
				
					<div>
						<?php if ($this->_tpl_vars['chain']['product_options']): ?>
							<div id="bundled_products_options_<?php echo $this->_tpl_vars['chain']['chain_id']; ?>
_<?php echo $this->_tpl_vars['key']; ?>
" class="chain-product-options">
								<div class="cm-reload-<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['chain']['product_id']; ?>
_<?php echo $this->_tpl_vars['chain']['chain_id']; ?>
" id="bundled_products_options_update_<?php echo $this->_tpl_vars['chain']['chain_id']; ?>
_<?php echo $this->_tpl_vars['key']; ?>
">
									<input type="hidden" name="appearance[show_product_options]" value="1" />
									<input type="hidden" name="appearance[bp_chain]" value="<?php echo $this->_tpl_vars['chain']['chain_id']; ?>
" />
									<input type="hidden" name="appearance[bp_id]" value="<?php echo $this->_tpl_vars['key']; ?>
" />
									
									<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/bundled_products/components/product_options.tpl", 'smarty_include_vars' => array('id' => ($this->_tpl_vars['chain']['product_id'])."_".($this->_tpl_vars['chain']['chain_id']),'product_options' => $this->_tpl_vars['chain']['product_options'],'name' => 'product_data','no_script' => true,'extra_id' => ($this->_tpl_vars['chain']['product_id'])."_".($this->_tpl_vars['chain']['chain_id']))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
									
								</div>
															</div>
												<?php endif; ?>
					</div>
				<?php endif; ?>
				<fieldset>
				
				<div style="padding-top: 20px;">
					&nbsp;
				</div>
				<?php $_from = $this->_tpl_vars['chain']['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['_id'] => $this->_tpl_vars['_product']):
?>
					
					<div class="chain-product">
						<?php if (! $this->_tpl_vars['_product']['aoc']): ?>
							<input type="hidden" name="product_data[<?php echo $this->_tpl_vars['_product']['product_id']; ?>
][product_id]" value="<?php echo $this->_tpl_vars['_product']['product_id']; ?>
" />
						<?php endif; ?>
						<table width="100%">
						<tr>
						<td>
						<a href="<?php echo fn_url("products.view?product_id=".($this->_tpl_vars['_product']['product_id'])); ?>
"><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('image_width' => '75', 'image_height' => '75', 'obj_id' => ($this->_tpl_vars['chain']['chain_id'])."_".($this->_tpl_vars['_product']['product_id']), 'images' => $this->_tpl_vars['_product']['main_pair'], 'object_type' => 'product', 'show_thumbnail' => 'Y', )); ?>
<?php echo ''; ?><?php if ($this->_tpl_vars['capture_image']): ?><?php echo ''; ?><?php ob_start(); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if (! $this->_tpl_vars['obj_id']): ?><?php echo ''; ?><?php echo smarty_function_math(array('equation' => "rand()",'assign' => 'obj_id'), $this);?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php $this->assign('flash', false, false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['show_thumbnail'] != 'Y'): ?><?php echo ''; ?><?php if (! $this->_tpl_vars['image_width']): ?><?php echo ''; ?><?php if ($this->_tpl_vars['images']['icon']['image_x']): ?><?php echo ''; ?><?php $this->assign('image_width', $this->_tpl_vars['images']['icon']['image_x'], false); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['images']['icon']['image_y']): ?><?php echo ''; ?><?php $this->assign('image_height', $this->_tpl_vars['images']['icon']['image_y'], false); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if (! $this->_tpl_vars['image_width'] || ! $this->_tpl_vars['image_height']): ?><?php echo ''; ?><?php if ($this->_tpl_vars['images']['detailed']['image_x']): ?><?php echo ''; ?><?php $this->assign('image_width', $this->_tpl_vars['images']['detailed']['image_x'], false); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['images']['detailed']['image_y']): ?><?php echo ''; ?><?php $this->assign('image_height', $this->_tpl_vars['images']['detailed']['image_y'], false); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php if ($this->_tpl_vars['images']['icon']['image_x'] && $this->_tpl_vars['images']['icon']['image_y']): ?><?php echo ''; ?><?php echo smarty_function_math(array('equation' => "new_x * y / x",'new_x' => $this->_tpl_vars['image_width'],'x' => $this->_tpl_vars['images']['icon']['image_x'],'y' => $this->_tpl_vars['images']['icon']['image_y'],'format' => "%d",'assign' => 'image_height'), $this);?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if (! $this->_tpl_vars['image_height'] && $this->_tpl_vars['images']['detailed']['image_x'] && $this->_tpl_vars['images']['detailed']['image_y']): ?><?php echo ''; ?><?php echo smarty_function_math(array('equation' => "new_x * y / x",'new_x' => $this->_tpl_vars['image_width'],'x' => $this->_tpl_vars['images']['detailed']['image_x'],'y' => $this->_tpl_vars['images']['detailed']['image_y'],'format' => "%d",'assign' => 'image_height'), $this);?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['max_width'] && ! $this->_tpl_vars['image_width']): ?><?php echo ''; ?><?php if ($this->_tpl_vars['images']['icon']['image_x']): ?><?php echo ''; ?><?php $this->assign('image_width', $this->_tpl_vars['images']['icon']['image_x'], false); ?><?php echo ''; ?><?php elseif ($this->_tpl_vars['images']['detailed']['image_x']): ?><?php echo ''; ?><?php $this->assign('image_width', $this->_tpl_vars['images']['detailed']['image_x'], false); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['max_height'] && ! $this->_tpl_vars['image_height']): ?><?php echo ''; ?><?php if ($this->_tpl_vars['images']['icon']['image_y']): ?><?php echo ''; ?><?php $this->assign('image_height', $this->_tpl_vars['images']['icon']['image_y'], false); ?><?php echo ''; ?><?php elseif ($this->_tpl_vars['images']['detailed']['image_y']): ?><?php echo ''; ?><?php $this->assign('image_height', $this->_tpl_vars['images']['detailed']['image_y'], false); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['max_width'] && $this->_tpl_vars['image_width'] && $this->_tpl_vars['image_width'] > $this->_tpl_vars['max_width']): ?><?php echo ''; ?><?php $this->assign('image_width', $this->_tpl_vars['max_width'], false); ?><?php echo ''; ?><?php echo smarty_function_math(array('equation' => "new_x * y / x",'new_x' => $this->_tpl_vars['image_width'],'x' => smarty_modifier_default(@$this->_tpl_vars['images']['icon']['image_x'], @$this->_tpl_vars['images']['detailed']['image_x']),'y' => smarty_modifier_default(@$this->_tpl_vars['images']['icon']['image_y'], @$this->_tpl_vars['images']['detailed']['image_y']),'format' => "%d",'assign' => 'image_height'), $this);?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['max_height'] && $this->_tpl_vars['image_height'] && $this->_tpl_vars['image_height'] > $this->_tpl_vars['max_height']): ?><?php echo ''; ?><?php $this->assign('image_height', $this->_tpl_vars['max_height'], false); ?><?php echo ''; ?><?php echo smarty_function_math(array('equation' => "new_y * x / y",'new_y' => $this->_tpl_vars['image_height'],'y' => smarty_modifier_default(@$this->_tpl_vars['images']['icon']['image_y'], @$this->_tpl_vars['images']['detailed']['image_y']),'x' => smarty_modifier_default(@$this->_tpl_vars['images']['icon']['image_x'], @$this->_tpl_vars['images']['detailed']['image_x']),'format' => "%d",'assign' => 'image_width'), $this);?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['images']['icon']): ?><?php echo ''; ?><?php $this->assign('image_id', $this->_tpl_vars['images']['image_id'], false); ?><?php echo ''; ?><?php elseif ($this->_tpl_vars['images']['detailed']): ?><?php echo ''; ?><?php $this->assign('image_id', $this->_tpl_vars['images']['detailed_id'], false); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['show_detailed_link'] && $this->_tpl_vars['images']['detailed_id']): ?><?php echo '<span class="'; ?><?php if (! $this->_tpl_vars['images']['detailed_id'] || $this->_tpl_vars['flash']): ?><?php echo 'hidden'; ?><?php endif; ?><?php echo ' '; ?><?php echo $this->_tpl_vars['detailed_link_class']; ?><?php echo ' larger-image-wrap center" id="box_det_img_link_'; ?><?php echo $this->_tpl_vars['obj_id']; ?><?php echo '"><a class="cm-external-click cm-view-larger-image" rev="det_img_link_'; ?><?php echo $this->_tpl_vars['obj_id']; ?><?php echo '" title="'; ?><?php echo fn_get_lang_var('view_larger_image', $this->getLanguage()); ?><?php echo '"></a></span>'; ?><?php endif; ?><?php echo ''; ?><?php if (! $this->_tpl_vars['images']['icon']['is_flash'] && ! $this->_tpl_vars['images']['detailed']['is_flash']): ?><?php echo ''; ?><?php if ($this->_tpl_vars['show_thumbnail'] == 'Y' && ( $this->_tpl_vars['image_width'] || $this->_tpl_vars['image_height'] ) && $this->_tpl_vars['image_id']): ?><?php echo ''; ?><?php if ($this->_tpl_vars['image_width'] && $this->_tpl_vars['image_height']): ?><?php echo ''; ?><?php $this->assign('make_box', true, false); ?><?php echo ''; ?><?php $this->assign('proportional', true, false); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php $this->assign('object_type', smarty_modifier_default(@$this->_tpl_vars['object_type'], 'product'), false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['images']['icon']['image_path']): ?><?php echo ''; ?><?php $this->assign('image_path', $this->_tpl_vars['images']['icon']['image_path'], false); ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php $this->assign('image_path', $this->_tpl_vars['images']['detailed']['image_path'], false); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php $this->assign('icon_image_path', smarty_modifier_escape(fn_generate_thumbnail(smarty_modifier_unescape($this->_tpl_vars['image_path']), $this->_tpl_vars['image_width'], $this->_tpl_vars['image_height'], $this->_tpl_vars['make_box'])), false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['absolute_image_path']): ?><?php echo ''; ?><?php $this->assign('icon_image_path', fn_convert_relative_to_absolute_image_url($this->_tpl_vars['icon_image_path']), false); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['make_box'] && ! $this->_tpl_vars['proportional']): ?><?php echo ''; ?><?php $this->assign('image_height', $this->_tpl_vars['image_width'], false); ?><?php echo ''; ?><?php elseif ($this->_tpl_vars['object_type'] == 'detailed_product'): ?><?php echo ''; ?><?php if (! $this->_tpl_vars['image_height'] && $this->_tpl_vars['image_width']): ?><?php echo ''; ?><?php if ($this->_tpl_vars['images']['icon']['image_x'] && $this->_tpl_vars['images']['icon']['image_y']): ?><?php echo ''; ?><?php echo smarty_function_math(array('equation' => "new_x * y / x",'new_x' => $this->_tpl_vars['image_width'],'x' => $this->_tpl_vars['images']['icon']['image_x'],'y' => $this->_tpl_vars['images']['icon']['image_y'],'format' => "%d",'assign' => 'image_height'), $this);?><?php echo ''; ?><?php elseif ($this->_tpl_vars['images']['detailed']['image_x'] && $this->_tpl_vars['images']['detailed']['image_y']): ?><?php echo ''; ?><?php echo smarty_function_math(array('equation' => "new_x * y / x",'new_x' => $this->_tpl_vars['image_width'],'x' => $this->_tpl_vars['images']['detailed']['image_x'],'y' => $this->_tpl_vars['images']['detailed']['image_y'],'format' => "%d",'assign' => 'image_height'), $this);?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php elseif (! $this->_tpl_vars['image_width'] && $this->_tpl_vars['image_height']): ?><?php echo ''; ?><?php if ($this->_tpl_vars['images']['icon']['image_x'] && $this->_tpl_vars['images']['icon']['image_y']): ?><?php echo ''; ?><?php echo smarty_function_math(array('equation' => "new_x * y / x",'new_x' => $this->_tpl_vars['image_height'],'x' => $this->_tpl_vars['images']['icon']['image_y'],'y' => $this->_tpl_vars['images']['icon']['image_x'],'format' => "%d",'assign' => 'image_width'), $this);?><?php echo ''; ?><?php elseif ($this->_tpl_vars['images']['detailed']['image_x'] && $this->_tpl_vars['images']['detailed']['image_y']): ?><?php echo ''; ?><?php echo smarty_function_math(array('equation' => "new_x * y / x",'new_x' => $this->_tpl_vars['image_height'],'x' => $this->_tpl_vars['images']['detailed']['image_y'],'y' => $this->_tpl_vars['images']['detailed']['image_x'],'format' => "%d",'assign' => 'image_width'), $this);?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php $this->assign('icon_image_path', $this->_tpl_vars['images']['icon']['image_path'], false); ?><?php echo ''; ?><?php if (! $this->_tpl_vars['icon_image_path']): ?><?php echo ''; ?><?php if ($this->_tpl_vars['object_type'] == 'detailed_product' && $this->_tpl_vars['images']['detailed']['image_x']): ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['Thumbnails']['product_details_thumbnail_width']): ?><?php echo ''; ?><?php $this->assign('image_width', $this->_tpl_vars['settings']['Thumbnails']['product_details_thumbnail_width'], false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['make_box'] && ! $this->_tpl_vars['proportional']): ?><?php echo ''; ?><?php $this->assign('image_height', $this->_tpl_vars['image_width'], false); ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_function_math(array('equation' => "new_x * y / x",'new_x' => $this->_tpl_vars['image_width'],'x' => $this->_tpl_vars['images']['detailed']['image_x'],'y' => $this->_tpl_vars['images']['detailed']['image_y'],'format' => "%d",'assign' => 'image_height'), $this);?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php $this->assign('icon_image_path', smarty_modifier_escape(fn_generate_thumbnail(smarty_modifier_unescape($this->_tpl_vars['images']['detailed']['image_path']), $this->_tpl_vars['image_width'], $this->_tpl_vars['image_height'], $this->_tpl_vars['make_box'])), false); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['show_detailed_link'] && $this->_tpl_vars['images']['detailed_id']): ?><?php echo ''; ?><?php if ($this->_tpl_vars['object_type'] == 'detailed_product' && ( $this->_tpl_vars['settings']['Thumbnails']['product_detailed_image_width'] || $this->_tpl_vars['settings']['Thumbnails']['product_detailed_image_height'] )): ?><?php echo ''; ?><?php $this->assign('detailed_image_path', smarty_modifier_escape(fn_generate_thumbnail(smarty_modifier_unescape($this->_tpl_vars['images']['detailed']['image_path']), $this->_tpl_vars['settings']['Thumbnails']['product_detailed_image_width'], $this->_tpl_vars['settings']['Thumbnails']['product_detailed_image_height'], $this->_tpl_vars['make_box'])), false); ?><?php echo ''; ?><?php elseif ($this->_tpl_vars['object_type'] == 'detailed_category' && ( $this->_tpl_vars['settings']['Thumbnails']['category_detailed_image_width'] || $this->_tpl_vars['settings']['Thumbnails']['category_detailed_image_height'] )): ?><?php echo ''; ?><?php $this->assign('detailed_image_path', smarty_modifier_escape(fn_generate_thumbnail(smarty_modifier_unescape($this->_tpl_vars['images']['detailed']['image_path']), $this->_tpl_vars['settings']['Thumbnails']['category_detailed_image_width'], $this->_tpl_vars['settings']['Thumbnails']['category_detailed_image_height'], $this->_tpl_vars['make_box'])), false); ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php $this->assign('detailed_image_path', $this->_tpl_vars['images']['detailed']['image_path'], false); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['icon_image_path'] || ! $this->_tpl_vars['hide_if_no_image']): ?><?php echo ''; ?><?php if ($this->_tpl_vars['detailed_image_path'] || $this->_tpl_vars['wrap_image']): ?><?php echo '<a id="det_img_link_'; ?><?php echo $this->_tpl_vars['obj_id']; ?><?php echo '" '; ?><?php if ($this->_tpl_vars['detailed_image_path'] && $this->_tpl_vars['rel']): ?><?php echo 'rel="'; ?><?php echo $this->_tpl_vars['rel']; ?><?php echo '"'; ?><?php endif; ?><?php echo ' '; ?><?php if ($this->_tpl_vars['rel']): ?><?php echo 'rev="'; ?><?php echo $this->_tpl_vars['rel']; ?><?php echo '"'; ?><?php endif; ?><?php echo ' class="'; ?><?php echo $this->_tpl_vars['link_class']; ?><?php echo ' '; ?><?php if ($this->_tpl_vars['detailed_image_path']): ?><?php echo 'cm-previewer'; ?><?php endif; ?><?php echo '" '; ?><?php if ($this->_tpl_vars['detailed_image_path']): ?><?php echo 'href="'; ?><?php echo $this->_tpl_vars['detailed_image_path']; ?><?php echo '" title="'; ?><?php echo $this->_tpl_vars['images']['detailed']['alt']; ?><?php echo '"'; ?><?php endif; ?><?php echo '>'; ?><?php endif; ?><?php echo ''; ?><?php $this->assign('alt_text', smarty_modifier_default(@$this->_tpl_vars['images']['icon']['alt'], @$this->_tpl_vars['images']['detailed']['alt']), false); ?><?php echo '<img class="'; ?><?php echo $this->_tpl_vars['valign']; ?><?php echo ' '; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '"  '; ?><?php if ($this->_tpl_vars['obj_id'] && ! $this->_tpl_vars['no_ids']): ?><?php echo 'id="det_img_'; ?><?php echo $this->_tpl_vars['obj_id']; ?><?php echo '"'; ?><?php endif; ?><?php echo ' src="'; ?><?php echo $this->_tpl_vars['config']['full_host_name']; ?><?php echo ''; ?><?php echo smarty_modifier_default(@$this->_tpl_vars['icon_image_path'], @$this->_tpl_vars['config']['no_image_path']); ?><?php echo '" '; ?><?php if ($this->_tpl_vars['image_width']): ?><?php echo 'width="'; ?><?php echo $this->_tpl_vars['image_width']; ?><?php echo '"'; ?><?php endif; ?><?php echo ' '; ?><?php if ($this->_tpl_vars['image_height']): ?><?php echo 'height="'; ?><?php echo $this->_tpl_vars['image_height']; ?><?php echo '"'; ?><?php endif; ?><?php echo ' alt="'; ?><?php echo $this->_tpl_vars['alt_text']; ?><?php echo '" title="'; ?><?php echo $this->_tpl_vars['alt_text']; ?><?php echo '" '; ?><?php if ($this->_tpl_vars['image_onclick']): ?><?php echo 'onclick="'; ?><?php echo $this->_tpl_vars['image_onclick']; ?><?php echo '"'; ?><?php endif; ?><?php echo ' border="0" />'; ?><?php if ($this->_tpl_vars['detailed_image_path'] || $this->_tpl_vars['wrap_image']): ?><?php echo '</a>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php $this->assign('flash', true, false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['images']['icon']['is_flash']): ?><?php echo ''; ?><?php $this->assign('flash_path', $this->_tpl_vars['images']['icon']['image_path'], false); ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php $this->assign('flash_path', $this->_tpl_vars['images']['detailed']['image_path'], false); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php $this->assign('icon_image_path', smarty_modifier_default(@$this->_tpl_vars['flash_path'], @$this->_tpl_vars['config']['no_image_path']), false); ?><?php echo ''; ?><?php $this->assign('detailed_image_path', smarty_modifier_default(@$this->_tpl_vars['flash_path'], @$this->_tpl_vars['config']['no_image_path']), false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['show_detailed_link'] && $this->_tpl_vars['images']['detailed_id'] || $this->_tpl_vars['wrap_image']): ?><?php echo '<a id="det_img_link_'; ?><?php echo $this->_tpl_vars['obj_id']; ?><?php echo '" '; ?><?php if ($this->_tpl_vars['rel']): ?><?php echo 'rel="'; ?><?php echo $this->_tpl_vars['rel']; ?><?php echo '"'; ?><?php endif; ?><?php echo ' '; ?><?php if ($this->_tpl_vars['rel']): ?><?php echo 'rev="'; ?><?php echo $this->_tpl_vars['rel']; ?><?php echo '"'; ?><?php endif; ?><?php echo ' class="'; ?><?php echo $this->_tpl_vars['link_class']; ?><?php echo ' swf-thumb '; ?><?php if ($this->_tpl_vars['show_detailed_link'] && $this->_tpl_vars['images']['detailed_id']): ?><?php echo 'cm-previewer'; ?><?php endif; ?><?php echo '" '; ?><?php if ($this->_tpl_vars['show_detailed_link'] && $this->_tpl_vars['images']['detailed_id']): ?><?php echo 'href="'; ?><?php echo $this->_tpl_vars['config']['full_host_name']; ?><?php echo ''; ?><?php echo smarty_modifier_default(@$this->_tpl_vars['flash_path'], @$this->_tpl_vars['config']['no_image_path']); ?><?php echo '"'; ?><?php endif; ?><?php echo ' onclick="return false;">'; ?><?php endif; ?><?php echo '<span id="'; ?><?php echo $this->_tpl_vars['obj_id']; ?><?php echo '" '; ?><?php if ($this->_tpl_vars['image_onclick']): ?><?php echo 'onmousedown="'; ?><?php echo $this->_tpl_vars['image_onclick']; ?><?php echo '"'; ?><?php endif; ?><?php echo ' class="option-changer '; ?><?php if ($this->_tpl_vars['_class']): ?><?php echo ''; ?><?php echo $this->_tpl_vars['_class']; ?><?php echo ' object-image'; ?><?php endif; ?><?php echo '" style="'; ?><?php if ($this->_tpl_vars['image_width']): ?><?php echo 'width: '; ?><?php echo $this->_tpl_vars['image_width']; ?><?php echo 'px;'; ?><?php endif; ?><?php echo ' '; ?><?php if ($this->_tpl_vars['image_height']): ?><?php echo 'height: '; ?><?php echo $this->_tpl_vars['image_height']; ?><?php echo 'px;'; ?><?php endif; ?><?php echo ' position: relative; z-index: 0; margin: 3px '; ?><?php if (! ( $this->_tpl_vars['show_detailed_link'] && $this->_tpl_vars['images']['detailed_id'] || $this->_tpl_vars['wrap_image'] )): ?><?php echo 'auto'; ?><?php endif; ?><?php echo ';"><span class="option-changer-container" style="'; ?><?php if ($this->_tpl_vars['image_width']): ?><?php echo 'width: '; ?><?php echo $this->_tpl_vars['image_width']; ?><?php echo 'px;'; ?><?php endif; ?><?php echo ' '; ?><?php if ($this->_tpl_vars['image_height']): ?><?php echo 'height: '; ?><?php echo $this->_tpl_vars['image_height']; ?><?php echo 'px;'; ?><?php endif; ?><?php echo '"><span id="swf_'; ?><?php echo $this->_tpl_vars['obj_id']; ?><?php echo '"></span></span><script type="text/javascript">if (typeof swfobject == \'undefined\') '; ?>{<?php echo 'var res = $.get(\'lib/js/swfobject/swfobject.js\', function() '; ?>{<?php echo 'swfobject.embedSWF("'; ?><?php echo $this->_tpl_vars['config']['full_host_name']; ?><?php echo ''; ?><?php echo smarty_modifier_default(@$this->_tpl_vars['flash_path'], @$this->_tpl_vars['config']['no_image_path']); ?><?php echo '", "swf_'; ?><?php echo $this->_tpl_vars['obj_id']; ?><?php echo '", "'; ?><?php if ($this->_tpl_vars['image_width']): ?><?php echo ''; ?><?php echo $this->_tpl_vars['image_width']; ?><?php echo ''; ?><?php else: ?><?php echo '30'; ?><?php endif; ?><?php echo '", "'; ?><?php if ($this->_tpl_vars['image_height']): ?><?php echo ''; ?><?php echo $this->_tpl_vars['image_height']; ?><?php echo ''; ?><?php else: ?><?php echo '30'; ?><?php endif; ?><?php echo '", "9.0.0", "lib/js/swfobject/expressInstall.swf"'; ?><?php if ($this->_tpl_vars['flash_vars']): ?><?php echo ' ,'; ?><?php echo $this->_tpl_vars['flash_vars']; ?><?php echo ','; ?><?php else: ?><?php echo ',"",'; ?><?php endif; ?><?php echo ' '; ?><?php echo '{wmode: \'opaque\'}'; ?><?php echo ');'; ?>}<?php echo ');'; ?>}<?php echo ' else '; ?>{<?php echo 'swfobject.embedSWF("'; ?><?php echo $this->_tpl_vars['config']['full_host_name']; ?><?php echo ''; ?><?php echo smarty_modifier_default(@$this->_tpl_vars['flash_path'], @$this->_tpl_vars['config']['no_image_path']); ?><?php echo '", "swf_'; ?><?php echo $this->_tpl_vars['obj_id']; ?><?php echo '", "'; ?><?php if ($this->_tpl_vars['image_width']): ?><?php echo ''; ?><?php echo $this->_tpl_vars['image_width']; ?><?php echo ''; ?><?php else: ?><?php echo '30'; ?><?php endif; ?><?php echo '", "'; ?><?php if ($this->_tpl_vars['image_height']): ?><?php echo ''; ?><?php echo $this->_tpl_vars['image_height']; ?><?php echo ''; ?><?php else: ?><?php echo '30'; ?><?php endif; ?><?php echo '", "9.0.0", "lib/js/swfobject/expressInstall.swf"'; ?><?php if ($this->_tpl_vars['flash_vars']): ?><?php echo ' ,'; ?><?php echo $this->_tpl_vars['flash_vars']; ?><?php echo ','; ?><?php else: ?><?php echo ',"",'; ?><?php endif; ?><?php echo ' '; ?><?php echo '{wmode: \'opaque\'}'; ?><?php echo ');'; ?>}<?php echo '</script><span class="option-changer-overlay'; ?><?php if ($this->_tpl_vars['show_detailed_link'] && $this->_tpl_vars['images']['detailed_id']): ?><?php echo ' cm-external-click'; ?><?php endif; ?><?php echo '" '; ?><?php if ($this->_tpl_vars['show_detailed_link'] && $this->_tpl_vars['images']['detailed_id']): ?><?php echo 'rev="det_img_link_'; ?><?php echo $this->_tpl_vars['obj_id']; ?><?php echo '"'; ?><?php endif; ?><?php echo '></span></span>'; ?><?php if ($this->_tpl_vars['show_detailed_link'] && $this->_tpl_vars['images']['detailed_id'] || $this->_tpl_vars['wrap_image']): ?><?php echo '</a>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['capture_image']): ?><?php echo ''; ?><?php $this->_smarty_vars['capture']['image'] = ob_get_contents(); ob_end_clean(); ?><?php echo ''; ?><?php ob_start(); ?><?php echo ''; ?><?php echo smarty_modifier_default(@$this->_tpl_vars['icon_image_path'], @$this->_tpl_vars['config']['no_image_path']); ?><?php echo ''; ?><?php $this->_smarty_vars['capture']['icon_image_path'] = ob_get_contents(); ob_end_clean(); ?><?php echo ''; ?><?php ob_start(); ?><?php echo ''; ?><?php echo smarty_modifier_default(@$this->_tpl_vars['detailed_image_path'], @$this->_tpl_vars['config']['no_image_path']); ?><?php echo ''; ?><?php $this->_smarty_vars['capture']['detailed_image_path'] = ob_get_contents(); ob_end_clean(); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>

<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></a>
						</td>
						<td style="padding-left: 20px; vertical-align: middle;" align="left">
							<a href="<?php echo fn_url("products.view?product_id=".($this->_tpl_vars['_product']['product_id'])); ?>
"><?php echo $this->_tpl_vars['_product']['product_name']; ?>
</a>
											
							<?php if ($this->_tpl_vars['_product']['product_options']): ?>
								<?php $_from = $this->_tpl_vars['_product']['product_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['option']):
?>
									<div><strong><?php echo $this->_tpl_vars['option']['option_name']; ?>
</strong>: <?php echo $this->_tpl_vars['option']['variant_name']; ?>
</div>
								<?php endforeach; endif; unset($_from); ?>
							<?php elseif ($this->_tpl_vars['_product']['aoc']): ?>
									<div id="bundled_products_options_<?php echo $this->_tpl_vars['chain']['chain_id']; ?>
_<?php echo $this->_tpl_vars['_product']['product_id']; ?>
" class="chain-product-options">
										<div class="cm-reload-<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['_product']['product_id']; ?>
" id="bundled_products_options_update_<?php echo $this->_tpl_vars['chain']['chain_id']; ?>
_<?php echo $this->_tpl_vars['_id']; ?>
">
											<input type="hidden" name="appearance[show_product_options]" value="1" />
											<input type="hidden" name="appearance[bp_chain]" value="<?php echo $this->_tpl_vars['chain']['chain_id']; ?>
" />
											<input type="hidden" name="appearance[bp_id]" value="<?php echo $this->_tpl_vars['_id']; ?>
" />
											
											<?php if ($this->_tpl_vars['_product']['amount'] > 0): ?>
												<?php unset($this->_sections['foo']);
$this->_sections['foo']['name'] = 'foo';
$this->_sections['foo']['loop'] = is_array($_loop=$this->_tpl_vars['_product']['amount']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['foo']['show'] = true;
$this->_sections['foo']['max'] = $this->_sections['foo']['loop'];
$this->_sections['foo']['step'] = 1;
$this->_sections['foo']['start'] = $this->_sections['foo']['step'] > 0 ? 0 : $this->_sections['foo']['loop']-1;
if ($this->_sections['foo']['show']) {
    $this->_sections['foo']['total'] = $this->_sections['foo']['loop'];
    if ($this->_sections['foo']['total'] == 0)
        $this->_sections['foo']['show'] = false;
} else
    $this->_sections['foo']['total'] = 0;
if ($this->_sections['foo']['show']):

            for ($this->_sections['foo']['index'] = $this->_sections['foo']['start'], $this->_sections['foo']['iteration'] = 1;
                 $this->_sections['foo']['iteration'] <= $this->_sections['foo']['total'];
                 $this->_sections['foo']['index'] += $this->_sections['foo']['step'], $this->_sections['foo']['iteration']++):
$this->_sections['foo']['rownum'] = $this->_sections['foo']['iteration'];
$this->_sections['foo']['index_prev'] = $this->_sections['foo']['index'] - $this->_sections['foo']['step'];
$this->_sections['foo']['index_next'] = $this->_sections['foo']['index'] + $this->_sections['foo']['step'];
$this->_sections['foo']['first']      = ($this->_sections['foo']['iteration'] == 1);
$this->_sections['foo']['last']       = ($this->_sections['foo']['iteration'] == $this->_sections['foo']['total']);
?> 
													<input type="hidden" name="product_data[<?php echo $this->_tpl_vars['_product']['product_id']; ?>
_<?php echo $this->_sections['foo']['iteration']; ?>
][product_id]" value="<?php echo $this->_tpl_vars['_product']['product_id']; ?>
" />
													<input type="hidden" name="product_data[<?php echo $this->_tpl_vars['_product']['product_id']; ?>
_<?php echo $this->_sections['foo']['iteration']; ?>
][amount]" value="1" />
													<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/bundled_products/components/product_options.tpl", 'smarty_include_vars' => array('id' => ($this->_tpl_vars['_product']['product_id'])."_".($this->_sections['foo']['iteration']),'product_options' => $this->_tpl_vars['_product']['options'],'name' => 'product_data','no_script' => true,'product' => $this->_tpl_vars['_product'],'extra_id' => ($this->_tpl_vars['_product']['product_id'])."_".($this->_sections['foo']['iteration']))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
												<?php endfor; endif; ?>
											<?php endif; ?>
										</div>
																			</div>
					
							<?php endif; ?>
						</td>
						</tr>
						</table>
					</div>
				<?php endforeach; endif; unset($_from); ?>
				
				</div>
				</fieldset>
				
			</div>
		
			</form>
		
		
			<?php endforeach; endif; unset($_from); ?>
		
			<?php if ($this->_tpl_vars['show_product_tabs']): ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/tabs/components/product_popup_tabs.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php echo $this->_smarty_vars['capture']['popupsbox_content']; ?>

			<?php endif; ?>
		</div>
	<?php endif; ?>
<?php elseif ($this->_tpl_vars['quick_view']): ?>

	<?php if ($this->_tpl_vars['product']): ?>
	<?php $this->assign('obj_id', $this->_tpl_vars['product']['product_id'], false); ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/product_data.tpl", 'smarty_include_vars' => array('product' => $this->_tpl_vars['product'],'separate_buttons' => false)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php $this->assign('form_open', "form_open_".($this->_tpl_vars['obj_id']), false); ?>
	<?php echo $this->_smarty_vars['capture'][$this->_tpl_vars['form_open']]; ?>

	<div class="clearfix">
		<div class ="left-side">
			<?php if (! $this->_tpl_vars['no_images']): ?>
				<div class="image-border cm-reload-<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
" id="product_images_<?php echo $this->_tpl_vars['product']['product_id']; ?>
_update">
					<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/products/components/product_images.tpl", 'smarty_include_vars' => array('product' => $this->_tpl_vars['product'],'show_detailed_link' => 'Y')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<!--product_images_<?php echo $this->_tpl_vars['product']['product_id']; ?>
_update--></div>
			<?php endif; ?>

		</div>
		<div class="product-info">

			<?php $this->assign('prod_descr', "prod_descr_".($this->_tpl_vars['obj_id']), false); ?>
			<?php if (trim($this->_smarty_vars['capture'][$this->_tpl_vars['prod_descr']])): ?>
			<h2 class="description-title"><?php echo fn_get_lang_var('description', $this->getLanguage()); ?>
</h2>
			<p class="product-description"><?php echo $this->_smarty_vars['capture'][$this->_tpl_vars['prod_descr']]; ?>
</p>
			<?php endif; ?>

			<?php if ($this->_tpl_vars['capture_buttons']): ?><?php ob_start(); ?><?php endif; ?>
				<?php $this->assign('add_to_cart', "add_to_cart_".($this->_tpl_vars['obj_id']), false); ?>
				<?php echo $this->_smarty_vars['capture'][$this->_tpl_vars['add_to_cart']]; ?>


				<?php $this->assign('list_buttons', "list_buttons_".($this->_tpl_vars['obj_id']), false); ?>
				<?php echo $this->_smarty_vars['capture'][$this->_tpl_vars['list_buttons']]; ?>

			<?php if ($this->_tpl_vars['capture_buttons']): ?><?php $this->_smarty_vars['capture']['buttons'] = ob_get_contents(); ob_end_clean(); ?><?php endif; ?>
		</div>
	</div>
	<?php $this->assign('form_close', "form_close_".($this->_tpl_vars['obj_id']), false); ?>
	<?php echo $this->_smarty_vars['capture'][$this->_tpl_vars['form_close']]; ?>

	<?php endif; ?>

<?php endif; ?>