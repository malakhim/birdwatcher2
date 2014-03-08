<?php /* Smarty version 2.6.18, created on 2014-03-08 11:24:15
         compiled from views/orders/details.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'views/orders/details.tpl', 1, false),array('modifier', 'fn_check_view_permissions', 'views/orders/details.tpl', 55, false),array('modifier', 'fn_url', 'views/orders/details.tpl', 61, false),array('modifier', 'fn_get_statuses', 'views/orders/details.tpl', 153, false),array('modifier', 'escape', 'views/orders/details.tpl', 154, false),array('modifier', 'lower', 'views/orders/details.tpl', 180, false),array('modifier', 'is_array', 'views/orders/details.tpl', 184, false),array('modifier', 'fn_from_json', 'views/orders/details.tpl', 185, false),array('modifier', 'trim', 'views/orders/details.tpl', 255, false),array('modifier', 'fn_get_company_name', 'views/orders/details.tpl', 321, false),array('modifier', 'date_format', 'views/orders/details.tpl', 328, false),array('modifier', 'nl2br', 'views/orders/details.tpl', 375, false),array('modifier', 'count', 'views/orders/details.tpl', 528, false),array('modifier', 'unescape', 'views/orders/details.tpl', 555, false),array('modifier', 'fn_get_recurring_period_name', 'views/orders/details.tpl', 592, false),array('modifier', 'format_price', 'views/orders/details.tpl', 612, false),array('modifier', 'floatval', 'views/orders/details.tpl', 627, false),array('modifier', 'fn_parse_date', 'views/orders/details.tpl', 843, false),array('modifier', 'empty_tabs', 'views/orders/details.tpl', 942, false),array('modifier', 'in_array', 'views/orders/details.tpl', 948, false),array('block', 'hook', 'views/orders/details.tpl', 29, false),array('function', 'html_options', 'views/orders/details.tpl', 367, false),array('function', 'html_checkboxes', 'views/orders/details.tpl', 370, false),array('function', 'cycle', 'views/orders/details.tpl', 553, false),array('function', 'math', 'views/orders/details.tpl', 830, false),array('function', 'script', 'views/orders/details.tpl', 936, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('print_credit_memo','print_pdf_credit_memo','print_order_details','print_pdf_order_details','print_invoice','print_pdf_invoice','remove_this_item','remove_this_item','print_packing_slip','edit_order','remove_this_item','remove_this_item','new_shipment','active','hidden','disabled','pending','new','active','disabled','hidden','pending','new','active','disabled','hidden','pending','notify_customer','notify_orders_department','notify_vendor','notify_supplier','order','vendor','invoice','credit_memo','by','on','payment_information','method','credit_card','expiry_date','start_date','remove_cc_info','remove_this_item','remove_this_item','shipping_information','method','tracking_number','carrier','usps','usps','ups','ups','fedex','fedex','australia_post','australia_post','dhl','dhl','chp','chp','method','tracking_number','carrier','usps','usps','ups','ups','fedex','fedex','australia_post','australia_post','dhl','dhl','chp','chp','new_shipment','view_shipments','product','price','quantity','discount','tax','subtotal','sku','expand_sublist_of_items','expand_sublist_of_items','collapse_sublist_of_items','collapse_sublist_of_items','returns_info','status','amount','price_in_points','rb_recurring_plan','rb_recurring_period','days','rb_duration','rb_start_duration','days','months','free','shipped','free','customer_notes','staff_only_notes','subtotal','shipping_cost','including_discount','order_discount','discount_coupon','taxes','included','tax_exempt','payment_surcharge','total','filename','activation_mode','downloads_max_left','download_key_expiry','active','manually','immediately','after_full_payment','none','time_unlimited_download','download_key_expiry','prolongate_download_key','calendar','calendar','weekday_abr_0','weekday_abr_1','weekday_abr_2','weekday_abr_3','weekday_abr_4','weekday_abr_5','weekday_abr_6','month_name_abr_1','month_name_abr_2','month_name_abr_3','month_name_abr_4','month_name_abr_5','month_name_abr_6','month_name_abr_7','month_name_abr_8','month_name_abr_9','month_name_abr_10','month_name_abr_11','month_name_abr_12','file_doesnt_have_key','active','not_active','notify_customer','notify_orders_department','notify_vendor','notify_supplier','viewing_order','total','vendor','previous','next'));
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
	<?php if ($this->_tpl_vars['status_settings']['appearance_type'] == 'C' && $this->_tpl_vars['order_info']['doc_ids'][$this->_tpl_vars['status_settings']['appearance_type']]): ?>
		<?php $this->assign('print_order', fn_get_lang_var('print_credit_memo', $this->getLanguage()), false); ?>
		<?php $this->assign('print_pdf_order', fn_get_lang_var('print_pdf_credit_memo', $this->getLanguage()), false); ?>
	<?php elseif ($this->_tpl_vars['status_settings']['appearance_type'] == 'O'): ?>
		<?php $this->assign('print_order', fn_get_lang_var('print_order_details', $this->getLanguage()), false); ?>
		<?php $this->assign('print_pdf_order', fn_get_lang_var('print_pdf_order_details', $this->getLanguage()), false); ?>
	<?php else: ?>
		<?php $this->assign('print_order', fn_get_lang_var('print_invoice', $this->getLanguage()), false); ?>
		<?php $this->assign('print_pdf_order', fn_get_lang_var('print_pdf_invoice', $this->getLanguage()), false); ?>
	<?php endif; ?>
	<span id="order_extra_tools">
	<?php $this->_tag_stack[] = array('hook', array('name' => "orders:details_tools")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/button_popup.tpl", 'smarty_include_vars' => array('but_text' => $this->_tpl_vars['print_order'],'but_href' => "orders.print_invoice?order_id=".($this->_tpl_vars['order_info']['order_id']),'width' => '900','height' => '600','but_role' => 'tool')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('but_text' => $this->_tpl_vars['print_pdf_order'], 'but_href' => "orders.print_invoice?order_id=".($this->_tpl_vars['order_info']['order_id'])."&format=pdf", 'but_role' => 'tool', )); ?><?php if ($this->_tpl_vars['but_role'] == 'text'): ?>
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
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/button_popup.tpl", 'smarty_include_vars' => array('but_text' => fn_get_lang_var('print_packing_slip', $this->getLanguage()),'but_href' => "orders.print_packing_slip?order_id=".($this->_tpl_vars['order_info']['order_id']),'width' => '900','height' => '600','but_role' => 'tool')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('but_text' => fn_get_lang_var('edit_order', $this->getLanguage()), 'but_href' => "order_management.edit?order_id=".($this->_tpl_vars['order_info']['order_id']), 'but_role' => 'tool', )); ?><?php if ($this->_tpl_vars['but_role'] == 'text'): ?>
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
	<?php if ($this->_tpl_vars['addons']['rma']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/rma/hooks/orders/details_tools.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	<!--order_extra_tools--></span>
<?php $this->_smarty_vars['capture']['extra_tools'] = ob_get_contents(); ob_end_clean(); ?>

<?php ob_start(); ?>

<?php if ($this->_tpl_vars['settings']['General']['use_shipments'] == 'Y'): ?>
	<?php ob_start(); ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/shipments/components/new_shipment.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php $this->_smarty_vars['capture']['add_new_picker'] = ob_get_contents(); ob_end_clean(); ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'add_shipment','content' => $this->_smarty_vars['capture']['add_new_picker'],'text' => fn_get_lang_var('new_shipment', $this->getLanguage()),'act' => 'hidden')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>


<form action="<?php echo fn_url(""); ?>
" method="post" name="order_info_form" class="cm-form-highlight">
<input type="hidden" name="order_id" value="<?php echo $this->_tpl_vars['_REQUEST']['order_id']; ?>
" />
<input type="hidden" name="order_status" value="<?php echo $this->_tpl_vars['order_info']['status']; ?>
" />
<input type="hidden" name="result_ids" value="content_general" />
<input type="hidden" name="selected_section" value="<?php echo $this->_tpl_vars['_REQUEST']['selected_section']; ?>
" />

<div id="content_general">

	<div class="item-summary clear center" id="order_summary">
		<div class="float-right">
		<?php if ($this->_tpl_vars['order_info']['status'] == @STATUS_INCOMPLETED_ORDER): ?>
			<?php $this->assign('get_additional_statuses', true, false); ?>
		<?php else: ?>
			<?php $this->assign('get_additional_statuses', false, false); ?>
		<?php endif; ?>
		<?php $this->assign('order_status_descr', fn_get_statuses(@STATUSES_ORDER, true, $this->_tpl_vars['get_additional_statuses'], true), false); ?>
		<?php $this->assign('extra_status', smarty_modifier_escape($this->_tpl_vars['config']['current_url'], 'url'), false); ?>
		<?php if ($this->_tpl_vars['order_info']['have_suppliers'] == 'Y'): ?>
			<?php $this->assign('notify_supplier', true, false); ?>
		<?php else: ?>
			<?php $this->assign('notify_supplier', false, false); ?>
		<?php endif; ?>

		<?php $this->assign('order_statuses', fn_get_statuses(@STATUSES_ORDER, false, $this->_tpl_vars['get_additional_statuses'], true), false); ?>
		<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('suffix' => 'o', 'id' => $this->_tpl_vars['order_info']['order_id'], 'status' => $this->_tpl_vars['order_info']['status'], 'items_status' => $this->_tpl_vars['order_status_descr'], 'update_controller' => 'orders', 'notify' => true, 'notify_department' => true, 'notify_supplier' => $this->_tpl_vars['notify_supplier'], 'status_rev' => "order_summary,order_extra_tools,content_downloads", 'extra' => "&return_url=".($this->_tpl_vars['extra_status']), 'statuses' => $this->_tpl_vars['order_statuses'], )); ?><?php if ($this->_tpl_vars['display'] == 'text'): ?>
	<span class="view-status">
		<?php if ($this->_tpl_vars['status'] == 'A'): ?>
			<?php echo fn_get_lang_var('active', $this->getLanguage()); ?>

		<?php elseif ($this->_tpl_vars['status'] == 'H'): ?>
			<?php echo fn_get_lang_var('hidden', $this->getLanguage()); ?>

		<?php elseif ($this->_tpl_vars['status'] == 'D'): ?>
			<?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>

		<?php elseif ($this->_tpl_vars['status'] == 'P'): ?>
			<?php echo fn_get_lang_var('pending', $this->getLanguage()); ?>

		<?php elseif ($this->_tpl_vars['status'] == 'N'): ?>
			<?php echo fn_get_lang_var('new', $this->getLanguage()); ?>

		<?php endif; ?>
	</span>
<?php else: ?>
	<?php $this->assign('prefix', smarty_modifier_default(@$this->_tpl_vars['prefix'], 'select'), false); ?>
	<div class="select-popup-container <?php echo $this->_tpl_vars['popup_additional_class']; ?>
">
		<?php if (! $this->_tpl_vars['hide_for_vendor']): ?>
		<div <?php if ($this->_tpl_vars['id']): ?>id="sw_<?php echo $this->_tpl_vars['prefix']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
_wrap"<?php endif; ?> class="<?php if ($this->_tpl_vars['statuses'][$this->_tpl_vars['status']]['color']): ?>selected-status-base<?php else: ?>selected-status status-<?php if ($this->_tpl_vars['suffix']): ?><?php echo $this->_tpl_vars['suffix']; ?>
-<?php endif; ?><?php echo smarty_modifier_lower($this->_tpl_vars['status']); ?>
<?php endif; ?><?php if ($this->_tpl_vars['id']): ?> cm-combo-on cm-combination<?php endif; ?>">
			<a <?php if ($this->_tpl_vars['id']): ?>class="cm-combo-on<?php if (! $this->_tpl_vars['popup_disabled']): ?> cm-combination<?php endif; ?>"<?php endif; ?>>
		<?php endif; ?>
			<?php if ($this->_tpl_vars['items_status']): ?>
				<?php if (! is_array($this->_tpl_vars['items_status'])): ?>
					<?php $this->assign('items_status', fn_from_json($this->_tpl_vars['items_status']), false); ?>
				<?php endif; ?>
				<?php echo $this->_tpl_vars['items_status'][$this->_tpl_vars['status']]; ?>

			<?php else: ?>
				<?php if ($this->_tpl_vars['status'] == 'A'): ?>
					<?php echo fn_get_lang_var('active', $this->getLanguage()); ?>

				<?php elseif ($this->_tpl_vars['status'] == 'D'): ?>
					<?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>

				<?php elseif ($this->_tpl_vars['status'] == 'H'): ?>
					<?php echo fn_get_lang_var('hidden', $this->getLanguage()); ?>

				<?php elseif ($this->_tpl_vars['status'] == 'P'): ?>
					<?php echo fn_get_lang_var('pending', $this->getLanguage()); ?>

				<?php elseif ($this->_tpl_vars['status'] == 'N'): ?>
					<?php echo fn_get_lang_var('new', $this->getLanguage()); ?>

				<?php endif; ?>
			<?php endif; ?>
		<?php if (! $this->_tpl_vars['hide_for_vendor']): ?>
			</a>
			<?php if ($this->_tpl_vars['statuses'][$this->_tpl_vars['status']]['color']): ?>
			<span class="selected-status-icon" style="background-color: #<?php echo $this->_tpl_vars['statuses'][$this->_tpl_vars['status']]['color']; ?>
">&nbsp;</span>
			<?php endif; ?>

		</div>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['id'] && ! $this->_tpl_vars['hide_for_vendor']): ?>
			<?php $this->assign('_update_controller', smarty_modifier_default(@$this->_tpl_vars['update_controller'], 'tools'), false); ?>
			<?php if ($this->_tpl_vars['table'] && $this->_tpl_vars['object_id_name']): ?><?php ob_start(); ?>&amp;table=<?php echo $this->_tpl_vars['table']; ?>
&amp;id_name=<?php echo $this->_tpl_vars['object_id_name']; ?>
<?php $this->_smarty_vars['capture']['_extra'] = ob_get_contents(); ob_end_clean(); ?><?php endif; ?>
			<div id="<?php echo $this->_tpl_vars['prefix']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
_wrap" class="popup-tools cm-popup-box cm-smart-position hidden">
				<div class="status-scroll-y">
				<ul class="cm-select-list">
				<?php if ($this->_tpl_vars['items_status']): ?>
					<?php $_from = $this->_tpl_vars['items_status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['st'] => $this->_tpl_vars['val']):
?>
					<li><a class="<?php if ($this->_tpl_vars['confirm']): ?>cm-confirm <?php endif; ?>status-link-<?php echo smarty_modifier_lower($this->_tpl_vars['st']); ?>
 <?php if ($this->_tpl_vars['status'] == $this->_tpl_vars['st']): ?>cm-active<?php else: ?>cm-ajax<?php endif; ?>"<?php if ($this->_tpl_vars['status_rev']): ?> rev="<?php echo $this->_tpl_vars['status_rev']; ?>
"<?php endif; ?> href="<?php echo fn_url(($this->_tpl_vars['_update_controller']).".update_status?id=".($this->_tpl_vars['id'])."&amp;status=".($this->_tpl_vars['st']).($this->_smarty_vars['capture']['_extra']).($this->_tpl_vars['extra'])); ?>
" onclick="return fn_check_object_status(this, '<?php echo smarty_modifier_lower($this->_tpl_vars['st']); ?>
', '<?php if ($this->_tpl_vars['statuses']): ?><?php echo smarty_modifier_default(@$this->_tpl_vars['statuses'][$this->_tpl_vars['st']]['color'], ''); ?>
<?php endif; ?>');" name="update_object_status_callback"><?php echo $this->_tpl_vars['val']; ?>
</a></li>
					<?php endforeach; endif; unset($_from); ?>
				<?php else: ?>
					<li><a class="<?php if ($this->_tpl_vars['confirm']): ?>cm-confirm <?php endif; ?>status-link-a <?php if ($this->_tpl_vars['status'] == 'A'): ?>cm-active<?php else: ?>cm-ajax<?php endif; ?>"<?php if ($this->_tpl_vars['status_rev']): ?> rev="<?php echo $this->_tpl_vars['status_rev']; ?>
"<?php endif; ?> href="<?php echo fn_url(($this->_tpl_vars['_update_controller']).".update_status?id=".($this->_tpl_vars['id'])."&amp;table=".($this->_tpl_vars['table'])."&amp;id_name=".($this->_tpl_vars['object_id_name'])."&amp;status=A".($this->_tpl_vars['dynamic_object'])); ?>
" onclick="return fn_check_object_status(this, 'a', '');" name="update_object_status_callback"><?php echo fn_get_lang_var('active', $this->getLanguage()); ?>
</a></li>
					<li><a class="<?php if ($this->_tpl_vars['confirm']): ?>cm-confirm <?php endif; ?>status-link-d <?php if ($this->_tpl_vars['status'] == 'D'): ?>cm-active<?php else: ?>cm-ajax<?php endif; ?>"<?php if ($this->_tpl_vars['status_rev']): ?> rev="<?php echo $this->_tpl_vars['status_rev']; ?>
"<?php endif; ?> href="<?php echo fn_url(($this->_tpl_vars['_update_controller']).".update_status?id=".($this->_tpl_vars['id'])."&amp;table=".($this->_tpl_vars['table'])."&amp;id_name=".($this->_tpl_vars['object_id_name'])."&amp;status=D".($this->_tpl_vars['dynamic_object'])); ?>
" onclick="return fn_check_object_status(this, 'd', '');" name="update_object_status_callback"><?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>
</a></li>
					<?php if ($this->_tpl_vars['hidden']): ?>
					<li><a class="<?php if ($this->_tpl_vars['confirm']): ?>cm-confirm <?php endif; ?>status-link-h <?php if ($this->_tpl_vars['status'] == 'H'): ?>cm-active<?php else: ?>cm-ajax<?php endif; ?>"<?php if ($this->_tpl_vars['status_rev']): ?> rev="<?php echo $this->_tpl_vars['status_rev']; ?>
"<?php endif; ?> href="<?php echo fn_url(($this->_tpl_vars['_update_controller']).".update_status?id=".($this->_tpl_vars['id'])."&amp;table=".($this->_tpl_vars['table'])."&amp;id_name=".($this->_tpl_vars['object_id_name'])."&amp;status=H".($this->_tpl_vars['dynamic_object'])); ?>
" onclick="return fn_check_object_status(this, 'h', '');" name="update_object_status_callback"><?php echo fn_get_lang_var('hidden', $this->getLanguage()); ?>
</a></li>
					<?php endif; ?>
					
					<?php if ($this->_tpl_vars['status'] == 'N'): ?>
					<li><a class="<?php if ($this->_tpl_vars['confirm']): ?>cm-confirm <?php endif; ?>status-link-p <?php if ($this->_tpl_vars['status'] == 'P'): ?>cm-active<?php else: ?>cm-ajax<?php endif; ?>"<?php if ($this->_tpl_vars['status_rev']): ?> rev="<?php echo $this->_tpl_vars['status_rev']; ?>
"<?php endif; ?> href="<?php echo fn_url(($this->_tpl_vars['_update_controller']).".update_status?id=".($this->_tpl_vars['id'])."&amp;table=".($this->_tpl_vars['table'])."&amp;id_name=".($this->_tpl_vars['object_id_name'])."&amp;status=P".($this->_tpl_vars['dynamic_object'])); ?>
" onclick="return fn_check_object_status(this, 'p', '');" name="update_object_status_callback"><?php echo fn_get_lang_var('pending', $this->getLanguage()); ?>
</a></li>
					<?php endif; ?>
				<?php endif; ?>
				</ul>
				</div>
				<?php ob_start(); ?>
				<?php if ($this->_tpl_vars['notify']): ?>
					<li class="select-field">
						<input type="checkbox" name="__notify_user" id="<?php echo $this->_tpl_vars['prefix']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
_notify" value="Y" class="checkbox" checked="checked" onclick="$('input[name=__notify_user]').attr('checked', this.checked);" />
						<label for="<?php echo $this->_tpl_vars['prefix']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
_notify"><?php echo smarty_modifier_default(@$this->_tpl_vars['notify_text'], fn_get_lang_var('notify_customer', $this->getLanguage())); ?>
</label>
					</li>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['notify_department']): ?>
					<li class="select-field notify-department">
						<input type="checkbox" name="__notify_department" id="<?php echo $this->_tpl_vars['prefix']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
_notify_department" value="Y" class="checkbox" checked="checked" onclick="$('input[name=__notify_department]').attr('checked', this.checked);" />
						<label for="<?php echo $this->_tpl_vars['prefix']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
_notify_department"><?php echo fn_get_lang_var('notify_orders_department', $this->getLanguage()); ?>
</label>
					</li>
				<?php endif; ?>
				
				<?php if ($this->_tpl_vars['notify_supplier']): ?>
					<li class="select-field notify-department">
						<input type="checkbox" name="__notify_supplier" id="<?php echo $this->_tpl_vars['prefix']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
_notify_supplier" value="Y" class="checkbox" checked="checked" onclick="$('input[name=__notify_supplier]').attr('checked', this.checked);" />
						<label for="<?php echo $this->_tpl_vars['prefix']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
_notify_supplier"><?php if (@PRODUCT_TYPE == 'MULTIVENDOR' || @PRODUCT_TYPE == 'ULTIMATE'): ?><?php echo fn_get_lang_var('notify_vendor', $this->getLanguage()); ?>
<?php else: ?><?php echo fn_get_lang_var('notify_supplier', $this->getLanguage()); ?>
<?php endif; ?></label>
					</li>
				<?php endif; ?>
				
				<?php $this->_smarty_vars['capture']['list_items'] = ob_get_contents(); ob_end_clean(); ?>
				
				<?php if (trim($this->_smarty_vars['capture']['list_items'])): ?>
				<ul class="cm-select-list select-list-tools">
					<?php echo $this->_smarty_vars['capture']['list_items']; ?>

				</ul>
				<?php endif; ?>
			</div>
			<?php if (! $this->_smarty_vars['capture']['avail_box']): ?>
			<script type="text/javascript">
			//<![CDATA[
			<?php echo '
			function fn_check_object_status(obj, status, color) 
			{
				if ($(obj).hasClass(\'cm-active\')) {
					$(obj).removeClass(\'cm-ajax\');
					return false;
				}
				fn_update_object_status(obj, status, color);
				return true;
			}
			function fn_update_object_status_callback(data, params) 
			{
				if (data.return_status && params.obj) {
					var color = data.color ? data.color : \'\';
					fn_update_object_status(params.obj, data.return_status.toLowerCase(), color);
				}
			}
			function fn_update_object_status(obj, status, color)
			{
				var upd_elm_id = $(obj).parents(\'.cm-popup-box:first\').attr(\'id\');
				var upd_elm = $(\'#\' + upd_elm_id);
				upd_elm.hide();
				$(obj).attr(\'href\', fn_query_remove($(obj).attr(\'href\'), [\'notify_user\', \'notify_department\']));
				if ($(\'input[name=__notify_user]:checked\', upd_elm).length) {
					$(obj).attr(\'href\', $(obj).attr(\'href\') + \'&notify_user=Y\');
				}
				if ($(\'input[name=__notify_department]:checked\', upd_elm).length) {
					$(obj).attr(\'href\', $(obj).attr(\'href\') + \'&notify_department=Y\');
				}
				
				if ($(\'input[name=__notify_supplier]:checked\', upd_elm).length) {
					$(obj).attr(\'href\', $(obj).attr(\'href\') + \'&notify_supplier=Y\');
				}
				
				$(\'.cm-select-list li a\', upd_elm).removeClass(\'cm-active\').addClass(\'cm-ajax\');
				$(\'.status-link-\' + status, upd_elm).addClass(\'cm-active\');
				$(\'#sw_\' + upd_elm_id + \' a\').text($(\'.status-link-\' + status, upd_elm).text());
				if (color) {
					$(\'#sw_\' + upd_elm_id).removeAttr(\'class\').addClass(\'selected-status-base \' + $(\'#sw_\' + upd_elm_id + \' a\').attr(\'class\'));
					$(\'#sw_\' + upd_elm_id).children(\'.selected-status-icon:first\').css(\'background-color\', \'#\' + color);
				} else {
					'; ?>

					$('#sw_' + upd_elm_id).removeAttr('class').addClass('selected-status status-<?php if ($this->_tpl_vars['suffix']): ?><?php echo $this->_tpl_vars['suffix']; ?>
-<?php endif; ?>' + status + ' ' + $('#sw_' + upd_elm_id + ' a').attr('class'));
					<?php echo '
				}
			}
			'; ?>

			//]]>
			</script>
			<?php ob_start(); ?>Y<?php $this->_smarty_vars['capture']['avail_box'] = ob_get_contents(); ob_end_clean(); ?>
			<?php endif; ?>
		<?php endif; ?>
	</div>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
		</div>

		<div class="float-left">
		<?php echo fn_get_lang_var('order', $this->getLanguage()); ?>
&nbsp;&nbsp;<span>#<?php echo $this->_tpl_vars['order_info']['order_id']; ?>
</span>&nbsp;<?php if ($this->_tpl_vars['order_info']['company_id']): ?>(<?php echo fn_get_lang_var('vendor', $this->getLanguage()); ?>
: <?php echo fn_get_company_name($this->_tpl_vars['order_info']['company_id']); ?>
)<?php endif; ?>
		<?php if ($this->_tpl_vars['status_settings']['appearance_type'] == 'I' && $this->_tpl_vars['order_info']['doc_ids'][$this->_tpl_vars['status_settings']['appearance_type']]): ?>
		(<?php echo fn_get_lang_var('invoice', $this->getLanguage()); ?>
&nbsp;&nbsp;<span>#<?php echo $this->_tpl_vars['order_info']['doc_ids'][$this->_tpl_vars['status_settings']['appearance_type']]; ?>
</span>)&nbsp;
		<?php elseif ($this->_tpl_vars['status_settings']['appearance_type'] == 'C' && $this->_tpl_vars['order_info']['doc_ids'][$this->_tpl_vars['status_settings']['appearance_type']]): ?>
		(<?php echo fn_get_lang_var('credit_memo', $this->getLanguage()); ?>
&nbsp;<span>#<?php echo $this->_tpl_vars['order_info']['doc_ids'][$this->_tpl_vars['status_settings']['appearance_type']]; ?>
</span>)&nbsp;
		<?php endif; ?>
		<?php echo fn_get_lang_var('by', $this->getLanguage()); ?>
&nbsp;&nbsp;<span><?php if ($this->_tpl_vars['order_info']['user_id']): ?><a href="<?php echo fn_url("profiles.update?user_id=".($this->_tpl_vars['order_info']['user_id'])); ?>
"><?php endif; ?><?php echo $this->_tpl_vars['order_info']['firstname']; ?>
&nbsp;<?php echo $this->_tpl_vars['order_info']['lastname']; ?>
<?php if ($this->_tpl_vars['order_info']['user_id']): ?></a><?php endif; ?></span>&nbsp;
		<?php $this->assign('timestamp', smarty_modifier_escape(smarty_modifier_date_format($this->_tpl_vars['order_info']['timestamp'], ($this->_tpl_vars['settings']['Appearance']['date_format'])), 'url'), false); ?>
		<?php echo fn_get_lang_var('on', $this->getLanguage()); ?>
&nbsp;<a href="<?php echo fn_url("orders.manage?period=C&amp;time_from=".($this->_tpl_vars['timestamp'])."&amp;time_to=".($this->_tpl_vars['timestamp'])); ?>
"><?php echo smarty_modifier_date_format($this->_tpl_vars['order_info']['timestamp'], ($this->_tpl_vars['settings']['Appearance']['date_format'])); ?>
</a>,&nbsp;&nbsp;<?php echo smarty_modifier_date_format($this->_tpl_vars['order_info']['timestamp'], ($this->_tpl_vars['settings']['Appearance']['time_format'])); ?>

		</div>
		
		<?php $this->_tag_stack[] = array('hook', array('name' => "orders:customer_shot_info")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		<?php if ($this->_tpl_vars['addons']['anti_fraud']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/anti_fraud/hooks/orders/customer_shot_info.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	<!--order_summary--></div>
	
	<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr valign="top">
		<td width="68%">
						<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/profiles/components/profiles_info.tpl", 'smarty_include_vars' => array('user_data' => $this->_tpl_vars['order_info'],'location' => 'I')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</td>
		<td width="32%" class="details-block-container">
			<?php $this->_tag_stack[] = array('hook', array('name' => "orders:payment_info")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
						<?php if ($this->_tpl_vars['order_info']['payment_id']): ?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('payment_information', $this->getLanguage()))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<div class="form-field">
					<label><?php echo fn_get_lang_var('method', $this->getLanguage()); ?>
:</label>
					<?php echo $this->_tpl_vars['order_info']['payment_method']['payment']; ?>
&nbsp;<?php if ($this->_tpl_vars['order_info']['payment_method']['description']): ?>(<?php echo $this->_tpl_vars['order_info']['payment_method']['description']; ?>
)<?php endif; ?>
				</div>

				<?php if ($this->_tpl_vars['order_info']['payment_info']): ?>
					<?php $_from = $this->_tpl_vars['order_info']['payment_info']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
					<?php if ($this->_tpl_vars['item'] && ( $this->_tpl_vars['key'] != 'expiry_year' && $this->_tpl_vars['key'] != 'start_year' )): ?>
						<div class="form-field">
							<label><?php if ($this->_tpl_vars['key'] == 'card'): ?><?php $this->assign('cc_exists', true, false); ?><?php echo fn_get_lang_var('credit_card', $this->getLanguage()); ?>
<?php elseif ($this->_tpl_vars['key'] == 'expiry_month'): ?><?php echo fn_get_lang_var('expiry_date', $this->getLanguage()); ?>
<?php elseif ($this->_tpl_vars['key'] == 'start_month'): ?><?php echo fn_get_lang_var('start_date', $this->getLanguage()); ?>
<?php else: ?><?php echo fn_get_lang_var($this->_tpl_vars['key'], $this->getLanguage()); ?>
<?php endif; ?>:</label>
							<?php if ($this->_tpl_vars['key'] == 'order_status'): ?>
								<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('status' => $this->_tpl_vars['item'], 'display' => 'view', 'status_type' => "", )); ?><?php if (! $this->_tpl_vars['order_status_descr']): ?>
	<?php if (! $this->_tpl_vars['status_type']): ?><?php $this->assign('status_type', @STATUSES_ORDER, false); ?><?php endif; ?>
	<?php $this->assign('order_status_descr', fn_get_statuses($this->_tpl_vars['status_type'], true), false); ?>
<?php endif; ?>

<?php echo ''; ?><?php if ($this->_tpl_vars['display'] == 'view'): ?><?php echo ''; ?><?php echo $this->_tpl_vars['order_status_descr'][$this->_tpl_vars['status']]; ?><?php echo ''; ?><?php elseif ($this->_tpl_vars['display'] == 'select'): ?><?php echo ''; ?><?php echo smarty_function_html_options(array('name' => $this->_tpl_vars['name'],'options' => $this->_tpl_vars['order_status_descr'],'selected' => $this->_tpl_vars['status'],'id' => $this->_tpl_vars['select_id']), $this);?><?php echo ''; ?><?php elseif ($this->_tpl_vars['display'] == 'checkboxes'): ?><?php echo '<div>'; ?><?php echo smarty_function_html_checkboxes(array('name' => $this->_tpl_vars['name'],'options' => $this->_tpl_vars['order_status_descr'],'selected' => $this->_tpl_vars['status'],'columns' => smarty_modifier_default(@$this->_tpl_vars['columns'], 4)), $this);?><?php echo '</div>'; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
							<?php elseif ($this->_tpl_vars['key'] == 'reason_text'): ?>
								<?php echo smarty_modifier_nl2br($this->_tpl_vars['item']); ?>

							<?php elseif ($this->_tpl_vars['key'] == 'expiry_month'): ?>
								<?php echo $this->_tpl_vars['item']; ?>
/<?php echo $this->_tpl_vars['order_info']['payment_info']['expiry_year']; ?>

							<?php elseif ($this->_tpl_vars['key'] == 'start_month'): ?>
								<?php echo $this->_tpl_vars['item']; ?>
/<?php echo $this->_tpl_vars['order_info']['payment_info']['start_year']; ?>

							<?php else: ?>
								<?php echo $this->_tpl_vars['item']; ?>

							<?php endif; ?>
						</div>
					<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?>

					<?php if ($this->_tpl_vars['cc_exists']): ?>
					<p class="right">
						<input type="hidden" name="order_ids[]" value="<?php echo $this->_tpl_vars['order_info']['order_id']; ?>
" />
						<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('but_text' => fn_get_lang_var('remove_cc_info', $this->getLanguage()), 'but_meta' => "cm-ajax cm-comet", 'but_name' => "dispatch[orders.remove_cc_info]", )); ?><?php if ($this->_tpl_vars['but_role'] == 'text'): ?>
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
					</p>
					<?php endif; ?>
				<?php endif; ?>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['addons']['gift_certificates']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/gift_certificates/hooks/orders/payment_info.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

						<?php if ($this->_tpl_vars['order_info']['shipping']): ?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('shipping_information', $this->getLanguage()))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			
				<?php $_from = $this->_tpl_vars['order_info']['shipping']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['f_shipp'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['f_shipp']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['shipping_id'] => $this->_tpl_vars['shipping']):
        $this->_foreach['f_shipp']['iteration']++;
?>
				<div class="form-field">
					<label><?php echo fn_get_lang_var('method', $this->getLanguage()); ?>
:</label>
					<?php echo $this->_tpl_vars['shipping']['shipping']; ?>

				</div>
				
				<?php if ($this->_tpl_vars['settings']['General']['use_shipments'] != 'Y'): ?>
					<div class="form-field">
						<label for="tracking_number"><?php echo fn_get_lang_var('tracking_number', $this->getLanguage()); ?>
:</label>
						<input id="tracking_number" type="text" class="input-text-medium" name="update_shipping[<?php echo $this->_tpl_vars['shipping_id']; ?>
][tracking_number]" size="45" value="<?php echo $this->_tpl_vars['shipping']['tracking_number']; ?>
" />
					</div>
					<div class="form-field">
						<label for="carrier_key"><?php echo fn_get_lang_var('carrier', $this->getLanguage()); ?>
:</label>
						<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('id' => 'carrier_key', 'name' => "update_shipping[".($this->_tpl_vars['shipping_id'])."][carrier]", 'carrier' => $this->_tpl_vars['shipping']['carrier'], )); ?><?php if ($this->_tpl_vars['capture']): ?>
<?php ob_start(); ?>
<?php endif; ?>
<select <?php if ($this->_tpl_vars['id']): ?>id="<?php echo $this->_tpl_vars['id']; ?>
"<?php endif; ?> name="<?php echo $this->_tpl_vars['name']; ?>
">
	<option value="">--</option>
	<option value="USP" <?php if ($this->_tpl_vars['carrier'] == 'USP'): ?><?php $this->assign('carrier_name', fn_get_lang_var('usps', $this->getLanguage()), false); ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('usps', $this->getLanguage()); ?>
</option>
	<option value="UPS" <?php if ($this->_tpl_vars['carrier'] == 'UPS'): ?><?php $this->assign('carrier_name', fn_get_lang_var('ups', $this->getLanguage()), false); ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('ups', $this->getLanguage()); ?>
</option>
	<option value="FDX" <?php if ($this->_tpl_vars['carrier'] == 'FDX'): ?><?php $this->assign('carrier_name', fn_get_lang_var('fedex', $this->getLanguage()), false); ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('fedex', $this->getLanguage()); ?>
</option>
	<option value="AUP" <?php if ($this->_tpl_vars['carrier'] == 'AUP'): ?><?php $this->assign('carrier_name', fn_get_lang_var('australia_post', $this->getLanguage()), false); ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('australia_post', $this->getLanguage()); ?>
</option>
	<option value="DHL" <?php if ($this->_tpl_vars['carrier'] == 'DHL' || $this->_tpl_vars['user_data']['carrier'] == 'ARB'): ?><?php $this->assign('carrier_name', fn_get_lang_var('dhl', $this->getLanguage()), false); ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('dhl', $this->getLanguage()); ?>
</option>
	<option value="CHP" <?php if ($this->_tpl_vars['carrier'] == 'CHP'): ?><?php $this->assign('carrier_name', fn_get_lang_var('chp', $this->getLanguage()), false); ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('chp', $this->getLanguage()); ?>
</option>
</select>
<?php if ($this->_tpl_vars['capture']): ?>
<?php $this->_smarty_vars['capture']['carrier_field'] = ob_get_contents(); ob_end_clean(); ?>

<?php ob_start(); ?>
<?php echo $this->_tpl_vars['carrier_name']; ?>

<?php $this->_smarty_vars['capture']['carrier_name'] = ob_get_contents(); ob_end_clean(); ?>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
					</div>
				<?php endif; ?>
				<?php endforeach; else: ?>
					<?php if ($this->_tpl_vars['settings']['General']['use_shipments'] != 'Y'): ?>
						<div class="form-field">
							<label for="shipping_method"><?php echo fn_get_lang_var('method', $this->getLanguage()); ?>
:</label>
							<?php if ($this->_tpl_vars['shippings']): ?>
								<select id="shipping_method" name="add_shipping[shipping_id]">
								<?php $_from = $this->_tpl_vars['shippings']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['shipping']):
?>
									<option value="<?php echo $this->_tpl_vars['shipping']['shipping_id']; ?>
"><?php echo $this->_tpl_vars['shipping']['shipping']; ?>
</option>
								<?php endforeach; endif; unset($_from); ?>
								</select>
							<?php endif; ?>
						</div>
					
						<div class="form-field">
							<label for="tracking_number"><?php echo fn_get_lang_var('tracking_number', $this->getLanguage()); ?>
:</label>
							<input id="tracking_number" type="text" class="input-text-medium" name="add_shipping[tracking_number]" size="45" />
						</div>
						<div class="form-field">
							<label for="carrier_key"><?php echo fn_get_lang_var('carrier', $this->getLanguage()); ?>
:</label>
							<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('id' => 'carrier_key', 'name' => "add_shipping[carrier]", )); ?><?php if ($this->_tpl_vars['capture']): ?>
<?php ob_start(); ?>
<?php endif; ?>
<select <?php if ($this->_tpl_vars['id']): ?>id="<?php echo $this->_tpl_vars['id']; ?>
"<?php endif; ?> name="<?php echo $this->_tpl_vars['name']; ?>
">
	<option value="">--</option>
	<option value="USP" <?php if ($this->_tpl_vars['carrier'] == 'USP'): ?><?php $this->assign('carrier_name', fn_get_lang_var('usps', $this->getLanguage()), false); ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('usps', $this->getLanguage()); ?>
</option>
	<option value="UPS" <?php if ($this->_tpl_vars['carrier'] == 'UPS'): ?><?php $this->assign('carrier_name', fn_get_lang_var('ups', $this->getLanguage()), false); ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('ups', $this->getLanguage()); ?>
</option>
	<option value="FDX" <?php if ($this->_tpl_vars['carrier'] == 'FDX'): ?><?php $this->assign('carrier_name', fn_get_lang_var('fedex', $this->getLanguage()), false); ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('fedex', $this->getLanguage()); ?>
</option>
	<option value="AUP" <?php if ($this->_tpl_vars['carrier'] == 'AUP'): ?><?php $this->assign('carrier_name', fn_get_lang_var('australia_post', $this->getLanguage()), false); ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('australia_post', $this->getLanguage()); ?>
</option>
	<option value="DHL" <?php if ($this->_tpl_vars['carrier'] == 'DHL' || $this->_tpl_vars['user_data']['carrier'] == 'ARB'): ?><?php $this->assign('carrier_name', fn_get_lang_var('dhl', $this->getLanguage()), false); ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('dhl', $this->getLanguage()); ?>
</option>
	<option value="CHP" <?php if ($this->_tpl_vars['carrier'] == 'CHP'): ?><?php $this->assign('carrier_name', fn_get_lang_var('chp', $this->getLanguage()), false); ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('chp', $this->getLanguage()); ?>
</option>
</select>
<?php if ($this->_tpl_vars['capture']): ?>
<?php $this->_smarty_vars['capture']['carrier_field'] = ob_get_contents(); ob_end_clean(); ?>

<?php ob_start(); ?>
<?php echo $this->_tpl_vars['carrier_name']; ?>

<?php $this->_smarty_vars['capture']['carrier_name'] = ob_get_contents(); ob_end_clean(); ?>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
						</div>
					<?php endif; ?>
				<?php endif; unset($_from); ?>
			<?php endif; ?>
			
			<?php if ($this->_tpl_vars['settings']['General']['use_shipments'] == 'Y'): ?>
				<div class="form-field">
					<?php if ($this->_tpl_vars['order_info']['need_shipment']): ?>
						<div class="small-picker-container"><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'add_shipment','content' => "",'but_text' => fn_get_lang_var('new_shipment', $this->getLanguage()),'act' => 'create')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
					<?php endif; ?>
					<a href="<?php echo fn_url("shipments.manage?order_id=".($this->_tpl_vars['order_info']['order_id'])); ?>
"><?php echo fn_get_lang_var('view_shipments', $this->getLanguage()); ?>
&nbsp;(<?php echo count($this->_tpl_vars['order_info']['shipment_ids']); ?>
)</a>
				</div>
			<?php endif; ?>
		</td>
	</tr>
	</table>


		<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
	<tr>
		<th><?php echo fn_get_lang_var('product', $this->getLanguage()); ?>
</th>
		<th width="5%"><?php echo fn_get_lang_var('price', $this->getLanguage()); ?>
</th>
		<th width="5%"><?php echo fn_get_lang_var('quantity', $this->getLanguage()); ?>
</th>
		<?php if ($this->_tpl_vars['order_info']['use_discount']): ?>
		<th width="5%"><?php echo fn_get_lang_var('discount', $this->getLanguage()); ?>
</th>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['order_info']['taxes'] && $this->_tpl_vars['settings']['General']['tax_calculation'] != 'subtotal'): ?>
		<th width="5%">&nbsp;<?php echo fn_get_lang_var('tax', $this->getLanguage()); ?>
</th>
		<?php endif; ?>
		<th width="7%" class="right">&nbsp;<?php echo fn_get_lang_var('subtotal', $this->getLanguage()); ?>
</th>
	</tr>
	<?php $_from = $this->_tpl_vars['order_info']['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['oi']):
?>
	<?php if ($this->_tpl_vars['addons']['product_configurator']['status'] == 'A'): ?><?php ob_start(); $this->_in_capture[] = 'f13c7ce91a9ed0b3631c4fc14f9d56b6';
$_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/product_configurator/hooks/orders/items_list_row.override.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
$this->_tpl_vars['addon_content'] = ob_get_contents(); ob_end_clean(); array_pop($this->_in_capture); if (!empty($this->_scripts['f13c7ce91a9ed0b3631c4fc14f9d56b6'])) { echo implode("\n", $this->_scripts['f13c7ce91a9ed0b3631c4fc14f9d56b6']); unset($this->_scripts['f13c7ce91a9ed0b3631c4fc14f9d56b6']); }
 ?><?php else: ?><?php $this->assign('addon_content', "", false); ?><?php endif; ?><?php if (trim($this->_tpl_vars['addon_content'])): ?><?php echo $this->_tpl_vars['addon_content']; ?>
<?php else: ?><?php if ($this->_tpl_vars['addons']['bundled_products']['status'] == 'A'): ?><?php ob_start(); $this->_in_capture[] = 'ae0be72039de817148a1a4ef6a0918fb';
$_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/bundled_products/hooks/orders/items_list_row.override.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
$this->_tpl_vars['addon_content'] = ob_get_contents(); ob_end_clean(); array_pop($this->_in_capture); if (!empty($this->_scripts['ae0be72039de817148a1a4ef6a0918fb'])) { echo implode("\n", $this->_scripts['ae0be72039de817148a1a4ef6a0918fb']); unset($this->_scripts['ae0be72039de817148a1a4ef6a0918fb']); }
 ?><?php else: ?><?php $this->assign('addon_content', "", false); ?><?php endif; ?><?php if (trim($this->_tpl_vars['addon_content'])): ?><?php echo $this->_tpl_vars['addon_content']; ?>
<?php else: ?><?php $this->_tag_stack[] = array('hook', array('name' => "orders:items_list_row")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<?php if (! $this->_tpl_vars['oi']['extra']['parent']): ?>
	<tr <?php echo smarty_function_cycle(array('values' => "class=\"table-row\", ",'name' => 'class_cycle'), $this);?>
>
		<td>
			<?php if (! $this->_tpl_vars['oi']['deleted_product']): ?><a href="<?php echo fn_url("products.update?product_id=".($this->_tpl_vars['oi']['product_id'])); ?>
"><?php endif; ?><?php echo smarty_modifier_unescape($this->_tpl_vars['oi']['product']); ?>
<?php if (! $this->_tpl_vars['oi']['deleted_product']): ?></a><?php endif; ?>
			<?php $this->_tag_stack[] = array('hook', array('name' => "orders:product_info")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			<?php if ($this->_tpl_vars['oi']['product_code']): ?><p><?php echo fn_get_lang_var('sku', $this->getLanguage()); ?>
:&nbsp;<?php echo $this->_tpl_vars['oi']['product_code']; ?>
</p><?php endif; ?>
			<?php if ($this->_tpl_vars['addons']['gift_certificates']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/gift_certificates/hooks/orders/product_info.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['rma']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><?php if ($this->_tpl_vars['oi']['returns_info']): ?>
	<?php if (! $this->_tpl_vars['return_statuses']): ?><?php $this->assign('return_statuses', fn_get_statuses(@STATUSES_RETURN, true), false); ?><?php endif; ?>

	<p>
		<img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/plus.gif" width="14" height="9" border="0" alt="<?php echo fn_get_lang_var('expand_sublist_of_items', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('expand_sublist_of_items', $this->getLanguage()); ?>
" id="on_ret_<?php echo $this->_tpl_vars['key']; ?>
" class="hand cm-combination" />
		<img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/minus.gif" width="14" height="9" border="0" alt="<?php echo fn_get_lang_var('collapse_sublist_of_items', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('collapse_sublist_of_items', $this->getLanguage()); ?>
" id="off_ret_<?php echo $this->_tpl_vars['key']; ?>
" class="hand hidden cm-combination" />
		<a id="sw_ret_<?php echo $this->_tpl_vars['key']; ?>
" class="cm-combination"><?php echo fn_get_lang_var('returns_info', $this->getLanguage()); ?>
</a>
	</p>

	<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
	<tbody id="ret_<?php echo $this->_tpl_vars['key']; ?>
" class="hidden">	
	<tr>
		<th>&nbsp;<?php echo fn_get_lang_var('status', $this->getLanguage()); ?>
</th>
		<th><?php echo fn_get_lang_var('amount', $this->getLanguage()); ?>
</th>
	</tr>
	<?php $_from = $this->_tpl_vars['oi']['returns_info']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['f_rinfo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['f_rinfo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['status'] => $this->_tpl_vars['amount']):
        $this->_foreach['f_rinfo']['iteration']++;
?>
	<tr>
		<td><?php echo smarty_modifier_default(@$this->_tpl_vars['return_statuses'][$this->_tpl_vars['status']], ""); ?>
</td>
		<td><?php echo $this->_tpl_vars['amount']; ?>
</td>
	</tr>
	<?php endforeach; endif; unset($_from); ?>	
	</tbody>	
	</table>
	</div>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['reward_points']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><?php if ($this->_tpl_vars['order_info']['points_info']['price'] && $this->_tpl_vars['oi']): ?>
<p><?php echo fn_get_lang_var('price_in_points', $this->getLanguage()); ?>
:<?php echo $this->_tpl_vars['oi']['extra']['points_info']['price']; ?>
</p>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['recurring_billing']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><?php if ($this->_tpl_vars['oi']['extra']['recurring_plan_id'] && ! ( $this->_tpl_vars['controller'] == 'subscriptions' && $this->_tpl_vars['mode'] == 'update' )): ?>
	<div class="options-info">
		<label><?php echo fn_get_lang_var('rb_recurring_plan', $this->getLanguage()); ?>
:</label>
		<?php echo $this->_tpl_vars['oi']['extra']['recurring_plan']['name']; ?>

	</div>

	<div class="options-info">
		<label><?php echo fn_get_lang_var('rb_recurring_period', $this->getLanguage()); ?>
:</label>
		<span class="lowercase"><?php echo smarty_modifier_escape(smarty_modifier_fn_get_recurring_period_name($this->_tpl_vars['oi']['extra']['recurring_plan']['period'])); ?>
</span><?php if ($this->_tpl_vars['oi']['extra']['recurring_plan']['period'] == 'P'): ?> - <?php echo $this->_tpl_vars['oi']['extra']['recurring_plan']['by_period']; ?>
 <?php echo fn_get_lang_var('days', $this->getLanguage()); ?>
<?php endif; ?>
	</div>

	<div class="options-info">
		<label><?php echo fn_get_lang_var('rb_duration', $this->getLanguage()); ?>
:</label>
		<?php echo $this->_tpl_vars['oi']['extra']['recurring_duration']; ?>

	</div>

	<?php if ($this->_tpl_vars['oi']['extra']['recurring_plan']['start_duration']): ?>
	<div class="options-info">
		<label><?php echo fn_get_lang_var('rb_start_duration', $this->getLanguage()); ?>
:</label>
		<?php echo $this->_tpl_vars['oi']['extra']['recurring_plan']['start_duration']; ?>
 <?php if ($this->_tpl_vars['oi']['extra']['recurring_plan']['start_duration_type'] == 'D'): ?><?php echo fn_get_lang_var('days', $this->getLanguage()); ?>
<?php else: ?><?php echo fn_get_lang_var('months', $this->getLanguage()); ?>
<?php endif; ?>
	</div>
	<?php endif; ?>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			<?php if ($this->_tpl_vars['oi']['product_options']): ?><div class="options-info"><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/options_info.tpl", 'smarty_include_vars' => array('product_options' => $this->_tpl_vars['oi']['product_options'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div><?php endif; ?>
		</td>
		<td class="nowrap">
			<?php if ($this->_tpl_vars['oi']['extra']['exclude_from_calculate']): ?><?php echo fn_get_lang_var('free', $this->getLanguage()); ?>
<?php else: ?><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['oi']['original_price'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false)); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true)); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?></td>
		<td class="center">
			&nbsp;<?php echo $this->_tpl_vars['oi']['amount']; ?>
<br />
			
			<?php if ($this->_tpl_vars['settings']['General']['use_shipments'] == 'Y' && $this->_tpl_vars['oi']['shipped_amount'] > 0): ?>
				&nbsp;<span class="small-note">(<span><?php echo $this->_tpl_vars['oi']['shipped_amount']; ?>
</span>&nbsp;<?php echo fn_get_lang_var('shipped', $this->getLanguage()); ?>
)</span>
			<?php endif; ?>
			
		</td>
		<?php if ($this->_tpl_vars['order_info']['use_discount']): ?>
		<td class="nowrap">
			<?php if (floatval($this->_tpl_vars['oi']['extra']['discount'])): ?><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['oi']['extra']['discount'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false)); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true)); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php else: ?>-<?php endif; ?></td>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['order_info']['taxes'] && $this->_tpl_vars['settings']['General']['tax_calculation'] != 'subtotal'): ?>
		<td class="nowrap">
			<?php if (floatval($this->_tpl_vars['oi']['tax_value'])): ?><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['oi']['tax_value'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false)); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true)); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php else: ?>-<?php endif; ?></td>
		<?php endif; ?>
		<td class="right">&nbsp;<span><?php if ($this->_tpl_vars['oi']['extra']['exclude_from_calculate']): ?><?php echo fn_get_lang_var('free', $this->getLanguage()); ?>
<?php else: ?><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['oi']['display_subtotal'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false)); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true)); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?></span></td>
	</tr>
	<?php endif; ?>
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php endif; ?><?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	<?php $this->_tag_stack[] = array('hook', array('name' => "orders:extra_list")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<?php if ($this->_tpl_vars['addons']['gift_certificates']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/gift_certificates/hooks/orders/extra_list.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	</table>

	
	<!---->
	<?php $this->_tag_stack[] = array('hook', array('name' => "orders:totals")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if ($this->_tpl_vars['addons']['rma']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/rma/hooks/orders/totals.pre.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?>
	<div class="clear order-notes">
	<div class="float-left">
		<h3><label for="notes"><?php echo fn_get_lang_var('customer_notes', $this->getLanguage()); ?>
:</label></h3>
		<textarea class="input-textarea" name="update_order[notes]" id="notes" cols="40" rows="5"><?php echo $this->_tpl_vars['order_info']['notes']; ?>
</textarea>
	</div>
	
	<div class="float-left">
		<h3><label for="details"><?php echo fn_get_lang_var('staff_only_notes', $this->getLanguage()); ?>
:</label></h3>
		<textarea class="input-textarea" name="update_order[details]" id="details" cols="40" rows="5"><?php echo $this->_tpl_vars['order_info']['details']; ?>
</textarea>
	</div>

	<div class="float-right statistic-container">
		<ul class="statistic-list">
			<li>
				<em><?php echo fn_get_lang_var('subtotal', $this->getLanguage()); ?>
:</em>
				<span><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['order_info']['display_subtotal'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false)); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true)); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></span>
			</li>

			<?php if (floatval($this->_tpl_vars['order_info']['display_shipping_cost'])): ?>
				<li>
					<em><?php echo fn_get_lang_var('shipping_cost', $this->getLanguage()); ?>
:</em>
					<span><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['order_info']['display_shipping_cost'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false)); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true)); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></span>
				</li>
			<?php endif; ?>

			<?php if (floatval($this->_tpl_vars['order_info']['discount'])): ?>
				<li>
					<em><?php echo fn_get_lang_var('including_discount', $this->getLanguage()); ?>
:</em>
					<span><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['order_info']['discount'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false)); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true)); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></span>
				</li>
			<?php endif; ?>

			<?php if (floatval($this->_tpl_vars['order_info']['subtotal_discount'])): ?>
			<li>
				<em><?php echo fn_get_lang_var('order_discount', $this->getLanguage()); ?>
:</em>
				<span><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['order_info']['subtotal_discount'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false)); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true)); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></span>
			</li>
			<?php endif; ?>

			<?php if ($this->_tpl_vars['order_info']['coupons']): ?>
			<?php $_from = $this->_tpl_vars['order_info']['coupons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['coupon'] => $this->_tpl_vars['_c']):
?>
				<li>
					<em><?php echo fn_get_lang_var('discount_coupon', $this->getLanguage()); ?>
:</em>
					<span><?php echo $this->_tpl_vars['coupon']; ?>
</span>
				</li>
			<?php endforeach; endif; unset($_from); ?>
			<?php endif; ?>

			<?php if ($this->_tpl_vars['order_info']['taxes']): ?>
				<li>
					<em><?php echo fn_get_lang_var('taxes', $this->getLanguage()); ?>
:</em>
					<span>&nbsp;</span>
				</li>

				<?php $_from = $this->_tpl_vars['order_info']['taxes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tax_data']):
?>
				<li>
					<em>&nbsp;<span>&middot;</span>&nbsp;<?php echo $this->_tpl_vars['tax_data']['description']; ?>
&nbsp;<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/modifier.tpl", 'smarty_include_vars' => array('mod_value' => $this->_tpl_vars['tax_data']['rate_value'],'mod_type' => $this->_tpl_vars['tax_data']['rate_type'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php if ($this->_tpl_vars['tax_data']['price_includes_tax'] == 'Y' && ( $this->_tpl_vars['settings']['Appearance']['cart_prices_w_taxes'] != 'Y' || $this->_tpl_vars['settings']['General']['tax_calculation'] == 'subtotal' )): ?>&nbsp;<?php echo fn_get_lang_var('included', $this->getLanguage()); ?>
<?php endif; ?><?php if ($this->_tpl_vars['tax_data']['regnumber']): ?>&nbsp;(<?php echo $this->_tpl_vars['tax_data']['regnumber']; ?>
)<?php endif; ?></em>
					<span><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['tax_data']['tax_subtotal'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false)); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true)); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></span>
				</li>
				<?php endforeach; endif; unset($_from); ?>
			<?php endif; ?>

			<?php if ($this->_tpl_vars['order_info']['tax_exempt'] == 'Y'): ?>
				<li>
					<em><?php echo fn_get_lang_var('tax_exempt', $this->getLanguage()); ?>
</em>
					<span>&nbsp;</span>
				</li>
			<?php endif; ?>

			<?php if (floatval($this->_tpl_vars['order_info']['payment_surcharge']) && ! $this->_tpl_vars['take_surcharge_from_vendor']): ?>
				<li>
					<em><?php echo smarty_modifier_default(@$this->_tpl_vars['order_info']['payment_method']['surcharge_title'], fn_get_lang_var('payment_surcharge', $this->getLanguage())); ?>
:</em>
					<span><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['order_info']['payment_surcharge'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false)); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true)); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></span>
				</li>
			<?php endif; ?>

			<?php $this->_tag_stack[] = array('hook', array('name' => "orders:totals_content")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			<?php if ($this->_tpl_vars['addons']['rma']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/rma/hooks/orders/totals_content.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['reward_points']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/reward_points/hooks/orders/totals_content.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

			<li class="total">
				<em><?php echo fn_get_lang_var('total', $this->getLanguage()); ?>
:</em>
				<span><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['order_info']['total'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false)); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true)); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></span>
			</li>
		</ul>
	</div>
	</div>
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	<!---->
	
	<?php $this->_tag_stack[] = array('hook', array('name' => "orders:staff_only_note")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<?php if ($this->_tpl_vars['addons']['barcode']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><div class="center margin-top"><img src="<?php echo fn_url("image.barcode?id=".($this->_tpl_vars['order_info']['order_id'])."&type=".($this->_tpl_vars['addons']['barcode']['type'])."&width=".($this->_tpl_vars['addons']['barcode']['width'])."&height=".($this->_tpl_vars['addons']['barcode']['height'])."&xres=".($this->_tpl_vars['addons']['barcode']['resolution'])."&font=".($this->_tpl_vars['addons']['barcode']['text_font'])); ?>
" alt="BarCode" width="<?php echo $this->_tpl_vars['addons']['barcode']['width']; ?>
" height="<?php echo $this->_tpl_vars['addons']['barcode']['height']; ?>
" /></div><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<!--content_general--></div>

<div id="content_addons">

	<?php $this->_tag_stack[] = array('hook', array('name' => "orders:customer_info")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<?php if ($this->_tpl_vars['addons']['discussion']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/discussion/hooks/orders/customer_info.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<!--content_addons--></div>

<?php if ($this->_tpl_vars['downloads_exist']): ?>
<div id="content_downloads">
	<input type="hidden" name="order_id" value="<?php echo $this->_tpl_vars['_REQUEST']['order_id']; ?>
" />
	<input type="hidden" name="order_status" value="<?php echo $this->_tpl_vars['order_info']['status']; ?>
" />
	<?php $_from = $this->_tpl_vars['order_info']['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['oi']):
?>
	<?php if ($this->_tpl_vars['oi']['extra']['is_edp'] == 'Y'): ?>
	<p><a href="<?php echo fn_url("products.update?product_id=".($this->_tpl_vars['oi']['product_id'])); ?>
"><?php echo $this->_tpl_vars['oi']['product']; ?>
</a></p>
		<?php if ($this->_tpl_vars['oi']['files']): ?>
		<input type="hidden" name="files_exists[]" value="<?php echo $this->_tpl_vars['oi']['product_id']; ?>
" />
		<table cellpadding="5" cellspacing="0" border="0" class="table">
		<tr>
			<th><?php echo fn_get_lang_var('filename', $this->getLanguage()); ?>
</th>
			<th><?php echo fn_get_lang_var('activation_mode', $this->getLanguage()); ?>
</th>
			<th><?php echo fn_get_lang_var('downloads_max_left', $this->getLanguage()); ?>
</th>
			<th><?php echo fn_get_lang_var('download_key_expiry', $this->getLanguage()); ?>
</th>
			<th><?php echo fn_get_lang_var('active', $this->getLanguage()); ?>
</th>
		</tr>
		<?php $_from = $this->_tpl_vars['oi']['files']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['file']):
?>
		<tr>
			<td><?php echo $this->_tpl_vars['file']['file_name']; ?>
</td>
			<td>
				<?php if ($this->_tpl_vars['file']['activation_type'] == 'M'): ?><?php echo fn_get_lang_var('manually', $this->getLanguage()); ?>
</label><?php elseif ($this->_tpl_vars['file']['activation_type'] == 'I'): ?><?php echo fn_get_lang_var('immediately', $this->getLanguage()); ?>
<?php else: ?><?php echo fn_get_lang_var('after_full_payment', $this->getLanguage()); ?>
<?php endif; ?>
			</td>
			<td><?php if ($this->_tpl_vars['file']['max_downloads']): ?><?php echo $this->_tpl_vars['file']['max_downloads']; ?>
 / <input type="text" class="input-text-short" name="edp_downloads[<?php echo $this->_tpl_vars['file']['ekey']; ?>
][<?php echo $this->_tpl_vars['file']['file_id']; ?>
]" value="<?php echo smarty_function_math(array('equation' => "a-b",'a' => $this->_tpl_vars['file']['max_downloads'],'b' => smarty_modifier_default(@$this->_tpl_vars['file']['downloads'], 0)), $this);?>
" size="3" /><?php else: ?><?php echo fn_get_lang_var('none', $this->getLanguage()); ?>
<?php endif; ?></td>
			<td>
				<?php if ($this->_tpl_vars['oi']['extra']['unlimited_download'] == 'Y'): ?>
					<?php echo fn_get_lang_var('time_unlimited_download', $this->getLanguage()); ?>

				<?php elseif ($this->_tpl_vars['file']['ekey']): ?>
				<p><label><?php echo fn_get_lang_var('download_key_expiry', $this->getLanguage()); ?>
: </label><span><?php echo smarty_modifier_default(smarty_modifier_date_format($this->_tpl_vars['file']['ttl'], ($this->_tpl_vars['settings']['Appearance']['date_format']).", ".($this->_tpl_vars['settings']['Appearance']['time_format'])), "n/a"); ?>
</span></p>
				
				<p><label><?php echo fn_get_lang_var('prolongate_download_key', $this->getLanguage()); ?>
: </label><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('date_id' => "prolongate_date_".($this->_tpl_vars['file']['file_id']), 'date_name' => "prolongate_data[".($this->_tpl_vars['file']['ekey'])."]", 'date_val' => smarty_modifier_default(@$this->_tpl_vars['file']['ttl'], @TIME), 'start_year' => $this->_tpl_vars['settings']['Company']['company_start_year'], )); ?><?php if ($this->_tpl_vars['settings']['Appearance']['calendar_date_format'] == 'month_first'): ?>
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
</script><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></p>
				<?php else: ?><?php echo fn_get_lang_var('file_doesnt_have_key', $this->getLanguage()); ?>
<?php endif; ?>
			</td>
			<td>
				<select name="activate_files[<?php echo $this->_tpl_vars['oi']['product_id']; ?>
][<?php echo $this->_tpl_vars['file']['file_id']; ?>
]">
					<option value="Y" <?php if ($this->_tpl_vars['file']['active'] == 'Y'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('active', $this->getLanguage()); ?>
</option>
					<option value="N" <?php if ($this->_tpl_vars['file']['active'] != 'Y'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('not_active', $this->getLanguage()); ?>
</option>
				</select>
			</td>
		</tr>
		<?php endforeach; endif; unset($_from); ?>
		</table>
		<?php endif; ?>
	<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
<!--content_downloads--></div>
<?php endif; ?>

<?php if ($this->_tpl_vars['order_info']['promotions']): ?>
<div id="content_promotions">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/orders/components/promotions.tpl", 'smarty_include_vars' => array('promotions' => $this->_tpl_vars['order_info']['promotions'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<!--content_promotions--></div>
<?php endif; ?>

<?php $this->_tag_stack[] = array('hook', array('name' => "orders:tabs_content")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<div class="cm-toggle-button">
	<div class="select-field notify-customer">
		<input type="checkbox" name="notify_user" id="notify_user" value="Y" class="checkbox" />
		<label for="notify_user"><?php echo fn_get_lang_var('notify_customer', $this->getLanguage()); ?>
</label>
	</div>

	<div class="select-field notify-department">
		<input type="checkbox" name="notify_department" id="notify_department" value="Y" class="checkbox" />
		<label for="notify_department"><?php echo fn_get_lang_var('notify_orders_department', $this->getLanguage()); ?>
</label>
	</div>

<?php if ($this->_tpl_vars['order_info']['have_suppliers'] == 'Y'): ?>
	<div class="select-field notify-department">
		<input type="checkbox" name="notify_supplier" id="notify_supplier" value="Y" class="checkbox" />
		<label for="notify_supplier"><?php if (@PRODUCT_TYPE == 'MULTIVENDOR'): ?><?php echo fn_get_lang_var('notify_vendor', $this->getLanguage()); ?>
<?php else: ?><?php echo fn_get_lang_var('notify_supplier', $this->getLanguage()); ?>
<?php endif; ?></label>
	</div>
<?php endif; ?>

	<div class="buttons-container buttons-bg">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('but_meta' => "cm-no-ajax",'but_name' => "dispatch[orders.update_details]")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
</div>
</form>

<?php if ($this->_tpl_vars['google_info']): ?>
<div class="cm-hide-save-button" id="content_google">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/orders/components/google_actions.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<!--content_google--></div>
<?php endif; ?>

<?php $this->_tag_stack[] = array('hook', array('name' => "orders:tabs_extra")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<?php if ($this->_tpl_vars['addons']['discussion']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/discussion/hooks/orders/tabs_extra.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<?php $this->_smarty_vars['capture']['tabsbox'] = ob_get_contents(); ob_end_clean(); ?>
<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('content' => $this->_smarty_vars['capture']['tabsbox'], 'active_tab' => $this->_tpl_vars['_REQUEST']['selected_section'], 'track' => true, )); ?><?php echo smarty_function_script(array('src' => "js/tabs.js"), $this);?>


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
<?php ob_start(); ?>
	<?php echo fn_get_lang_var('viewing_order', $this->getLanguage()); ?>
 #<?php echo $this->_tpl_vars['order_info']['order_id']; ?>
 <span class="total">(<?php echo fn_get_lang_var('total', $this->getLanguage()); ?>
: <span><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['order_info']['total'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false)); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true)); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></span><?php if ($this->_tpl_vars['order_info']['company_id']): ?>, <?php echo smarty_modifier_lower(fn_get_lang_var('vendor', $this->getLanguage())); ?>
: <?php echo fn_get_company_name($this->_tpl_vars['order_info']['company_id']); ?>
<?php endif; ?>)</span>
<?php $this->_smarty_vars['capture']['mainbox_title'] = ob_get_contents(); ob_end_clean(); ?>

<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('url' => "orders.details?order_id=", )); ?><?php ob_start(); ?>
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

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('title' => $this->_smarty_vars['capture']['mainbox_title'],'content' => $this->_smarty_vars['capture']['mainbox'],'tools' => $this->_smarty_vars['capture']['view_tools'],'extra_tools' => $this->_smarty_vars['capture']['extra_tools'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>