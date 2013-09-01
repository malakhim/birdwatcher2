<?php /* Smarty version 2.6.18, created on 2013-09-01 10:52:52
         compiled from C:/wamp5/www/dutchme2/skins/basic/customer/blocks/product_templates/default_template.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'script', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/product_templates/default_template.tpl', 15, false),array('modifier', 'trim', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/product_templates/default_template.tpl', 20, false),array('modifier', 'unescape', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/product_templates/default_template.tpl', 35, false),array('modifier', 'replace', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/product_templates/default_template.tpl', 119, false),array('modifier', 'fn_url', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/product_templates/default_template.tpl', 119, false),array('block', 'hook', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/product_templates/default_template.tpl', 20, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('description','view_details','delete'));
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
			 ?><?php echo smarty_function_script(array('src' => "js/exceptions.js"), $this);?>


<div class="product-main-info">
<div class="clearfix">

<?php if ($this->_tpl_vars['addons']['billibuys']['status'] == 'A'): ?><?php ob_start(); $this->_in_capture[] = '86caf45ec196ffa4dfd66053d3bd8c28';
$_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/billibuys/hooks/products/view_main_info.override.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
$this->_tpl_vars['addon_content'] = ob_get_contents(); ob_end_clean(); array_pop($this->_in_capture); if (!empty($this->_scripts['86caf45ec196ffa4dfd66053d3bd8c28'])) { echo implode("\n", $this->_scripts['86caf45ec196ffa4dfd66053d3bd8c28']); unset($this->_scripts['86caf45ec196ffa4dfd66053d3bd8c28']); }
 ?><?php else: ?><?php $this->assign('addon_content', "", false); ?><?php endif; ?><?php if (trim($this->_tpl_vars['addon_content'])): ?><?php echo $this->_tpl_vars['addon_content']; ?>
<?php else: ?><?php if ($this->_tpl_vars['addons']['product_configurator']['status'] == 'A'): ?><?php ob_start(); $this->_in_capture[] = 'a75b6ab6647a1fd9ff7dfbe1b2d3dd66';
$_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/product_configurator/hooks/products/view_main_info.override.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
$this->_tpl_vars['addon_content'] = ob_get_contents(); ob_end_clean(); array_pop($this->_in_capture); if (!empty($this->_scripts['a75b6ab6647a1fd9ff7dfbe1b2d3dd66'])) { echo implode("\n", $this->_scripts['a75b6ab6647a1fd9ff7dfbe1b2d3dd66']); unset($this->_scripts['a75b6ab6647a1fd9ff7dfbe1b2d3dd66']); }
 ?><?php else: ?><?php $this->assign('addon_content', "", false); ?><?php endif; ?><?php if (trim($this->_tpl_vars['addon_content'])): ?><?php echo $this->_tpl_vars['addon_content']; ?>
<?php else: ?><?php if ($this->_tpl_vars['addons']['bundled_products']['status'] == 'A'): ?><?php ob_start(); $this->_in_capture[] = '9ceb53da09a0694f7d8588e56ec92170';
$_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/bundled_products/hooks/products/view_main_info.override.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
$this->_tpl_vars['addon_content'] = ob_get_contents(); ob_end_clean(); array_pop($this->_in_capture); if (!empty($this->_scripts['9ceb53da09a0694f7d8588e56ec92170'])) { echo implode("\n", $this->_scripts['9ceb53da09a0694f7d8588e56ec92170']); unset($this->_scripts['9ceb53da09a0694f7d8588e56ec92170']); }
 ?><?php else: ?><?php $this->assign('addon_content', "", false); ?><?php endif; ?><?php if (trim($this->_tpl_vars['addon_content'])): ?><?php echo $this->_tpl_vars['addon_content']; ?>
<?php else: ?><?php $this->_tag_stack[] = array('hook', array('name' => "products:view_main_info")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>

	<?php if ($this->_tpl_vars['product']): ?>
	<?php $this->assign('obj_id', $this->_tpl_vars['product']['product_id'], false); ?>

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
			<?php $this->assign('form_open', "form_open_".($this->_tpl_vars['obj_id']), false); ?>
			<?php echo $this->_smarty_vars['capture'][$this->_tpl_vars['form_open']]; ?>


			<?php if (! $this->_tpl_vars['hide_title']): ?><h1 class="mainbox-title"><?php echo smarty_modifier_unescape($this->_tpl_vars['product']['product']); ?>
</h1><?php endif; ?>
			<?php $this->assign('rating', "rating_".($this->_tpl_vars['obj_id']), false); ?><?php echo $this->_smarty_vars['capture'][$this->_tpl_vars['rating']]; ?>

			<?php $this->assign('sku', "sku_".($this->_tpl_vars['obj_id']), false); ?><?php echo $this->_smarty_vars['capture'][$this->_tpl_vars['sku']]; ?>

			<?php $this->assign('old_price', "old_price_".($this->_tpl_vars['obj_id']), false); ?>
			<?php $this->assign('price', "price_".($this->_tpl_vars['obj_id']), false); ?>
			<?php $this->assign('clean_price', "clean_price_".($this->_tpl_vars['obj_id']), false); ?>
			<?php $this->assign('list_discount', "list_discount_".($this->_tpl_vars['obj_id']), false); ?>
			<?php $this->assign('discount_label', "discount_label_".($this->_tpl_vars['obj_id']), false); ?>
			<div class="<?php if (trim($this->_smarty_vars['capture'][$this->_tpl_vars['old_price']]) || trim($this->_smarty_vars['capture'][$this->_tpl_vars['clean_price']]) || trim($this->_smarty_vars['capture'][$this->_tpl_vars['list_discount']])): ?>prices-container <?php endif; ?>price-wrap clearfix">
			<?php if (trim($this->_smarty_vars['capture'][$this->_tpl_vars['old_price']]) || trim($this->_smarty_vars['capture'][$this->_tpl_vars['clean_price']]) || trim($this->_smarty_vars['capture'][$this->_tpl_vars['list_discount']])): ?>
				<div class="float-left product-prices">
					<?php if (trim($this->_smarty_vars['capture'][$this->_tpl_vars['old_price']])): ?><?php echo $this->_smarty_vars['capture'][$this->_tpl_vars['old_price']]; ?>
&nbsp;<?php endif; ?>
			<?php endif; ?>
			
			<?php if (! trim($this->_smarty_vars['capture'][$this->_tpl_vars['old_price']]) || $this->_tpl_vars['details_page']): ?><p class="actual-price"><?php endif; ?>
					<?php echo $this->_smarty_vars['capture'][$this->_tpl_vars['price']]; ?>

			<?php if (! trim($this->_smarty_vars['capture'][$this->_tpl_vars['old_price']]) || $this->_tpl_vars['details_page']): ?></p><?php endif; ?>
		
			<?php if (trim($this->_smarty_vars['capture'][$this->_tpl_vars['old_price']]) || trim($this->_smarty_vars['capture'][$this->_tpl_vars['clean_price']]) || trim($this->_smarty_vars['capture'][$this->_tpl_vars['list_discount']])): ?>
					<?php echo $this->_smarty_vars['capture'][$this->_tpl_vars['clean_price']]; ?>

					<?php echo $this->_smarty_vars['capture'][$this->_tpl_vars['list_discount']]; ?>

				</div>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['show_discount_label'] && trim($this->_smarty_vars['capture'][$this->_tpl_vars['discount_label']])): ?>
				<div class="float-left">
					<?php echo $this->_smarty_vars['capture'][$this->_tpl_vars['discount_label']]; ?>

				</div>
			<?php endif; ?>
			</div>
		
			<?php if ($this->_tpl_vars['capture_options_vs_qty']): ?><?php ob_start(); ?><?php endif; ?>
			
			<?php $this->assign('product_amount', "product_amount_".($this->_tpl_vars['obj_id']), false); ?>
			<?php echo $this->_smarty_vars['capture'][$this->_tpl_vars['product_amount']]; ?>

			
			<?php $this->assign('product_options', "product_options_".($this->_tpl_vars['obj_id']), false); ?>
			<?php echo $this->_smarty_vars['capture'][$this->_tpl_vars['product_options']]; ?>

			
			<?php $this->assign('advanced_options', "advanced_options_".($this->_tpl_vars['obj_id']), false); ?>
			<?php echo $this->_smarty_vars['capture'][$this->_tpl_vars['advanced_options']]; ?>

			<?php if ($this->_tpl_vars['capture_options_vs_qty']): ?><?php $this->_smarty_vars['capture']['product_options'] = ob_get_contents(); ob_end_clean(); ?><?php endif; ?>
		
			<?php $this->assign('min_qty', "min_qty_".($this->_tpl_vars['obj_id']), false); ?>
			<?php echo $this->_smarty_vars['capture'][$this->_tpl_vars['min_qty']]; ?>

			
			<?php $this->assign('product_edp', "product_edp_".($this->_tpl_vars['obj_id']), false); ?>
			<?php echo $this->_smarty_vars['capture'][$this->_tpl_vars['product_edp']]; ?>


			<?php if ($this->_tpl_vars['show_descr']): ?>
			<?php $this->assign('prod_descr', "prod_descr_".($this->_tpl_vars['obj_id']), false); ?>
			<h2 class="description-title"><?php echo fn_get_lang_var('description', $this->getLanguage()); ?>
</h2>
			<p class="product-description"><?php echo $this->_smarty_vars['capture'][$this->_tpl_vars['prod_descr']]; ?>
</p>
			<?php endif; ?>

			<?php if ($this->_tpl_vars['capture_buttons']): ?><?php ob_start(); ?><?php endif; ?>
				<div class="buttons-container">
					<?php $this->assign('qty', "qty_".($this->_tpl_vars['obj_id']), false); ?>
					<?php echo $this->_smarty_vars['capture'][$this->_tpl_vars['qty']]; ?>

					<?php if ($this->_tpl_vars['show_details_button']): ?>
						<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('but_href' => "products.view?product_id=".($this->_tpl_vars['product']['product_id']), 'but_text' => fn_get_lang_var('view_details', $this->getLanguage()), 'but_role' => 'submit', )); ?>

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
					<?php endif; ?>

					<?php $this->assign('add_to_cart', "add_to_cart_".($this->_tpl_vars['obj_id']), false); ?>
					<?php echo $this->_smarty_vars['capture'][$this->_tpl_vars['add_to_cart']]; ?>


					<?php $this->assign('list_buttons', "list_buttons_".($this->_tpl_vars['obj_id']), false); ?>
					<?php echo $this->_smarty_vars['capture'][$this->_tpl_vars['list_buttons']]; ?>

				</div>
			<?php if ($this->_tpl_vars['capture_buttons']): ?><?php $this->_smarty_vars['capture']['buttons'] = ob_get_contents(); ob_end_clean(); ?><?php endif; ?>

			<?php $this->assign('form_close', "form_close_".($this->_tpl_vars['obj_id']), false); ?>
			<?php echo $this->_smarty_vars['capture'][$this->_tpl_vars['form_close']]; ?>


			<?php if ($this->_tpl_vars['show_product_tabs']): ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/tabs/components/product_popup_tabs.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php echo $this->_smarty_vars['capture']['popupsbox_content']; ?>

			<?php endif; ?>
		</div>
	<?php endif; ?>
	
<?php if ($this->_tpl_vars['addons']['recurring_billing']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/recurring_billing/hooks/products/view_main_info.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php endif; ?><?php endif; ?><?php endif; ?>
</div>

<?php if ($this->_smarty_vars['capture']['hide_form_changed'] == 'Y'): ?>
	<?php $this->assign('hide_form', $this->_smarty_vars['capture']['orig_val_hide_form'], false); ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['show_product_tabs']): ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/tabs/components/product_tabs.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['blocks'][$this->_tpl_vars['tabs_block_id']]['properties']['wrapper']): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['blocks'][$this->_tpl_vars['tabs_block_id']]['properties']['wrapper'], 'smarty_include_vars' => array('content' => $this->_smarty_vars['capture']['tabsbox_content'],'title' => $this->_tpl_vars['blocks'][$this->_tpl_vars['tabs_block_id']]['description'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php else: ?>
	<?php echo $this->_smarty_vars['capture']['tabsbox_content']; ?>

<?php endif; ?>

<?php endif; ?>
</div>

<div class="product-details">
</div>

<?php ob_start(); ?><?php $this->assign('details_page', true, false); ?><?php $this->_smarty_vars['capture']['mainbox_title'] = ob_get_contents(); ob_end_clean(); ?>