<?php /* Smarty version 2.6.18, created on 2013-09-01 10:55:53
         compiled from views/orders/details.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'hook', 'views/orders/details.tpl', 23, false),array('modifier', 'replace', 'views/orders/details.tpl', 60, false),array('modifier', 'fn_url', 'views/orders/details.tpl', 60, false),array('modifier', 'fn_get_discussion', 'views/orders/details.tpl', 84, false),array('modifier', 'trim', 'views/orders/details.tpl', 168, false),array('modifier', 'unescape', 'views/orders/details.tpl', 172, false),array('modifier', 'fn_get_recurring_period_name', 'views/orders/details.tpl', 187, false),array('modifier', 'escape', 'views/orders/details.tpl', 187, false),array('modifier', 'fn_get_statuses', 'views/orders/details.tpl', 204, false),array('modifier', 'default', 'views/orders/details.tpl', 208, false),array('modifier', 'format_price', 'views/orders/details.tpl', 221, false),array('modifier', 'floatval', 'views/orders/details.tpl', 229, false),array('modifier', 'strpos', 'views/orders/details.tpl', 338, false),array('modifier', 'empty_tabs', 'views/orders/details.tpl', 584, false),array('modifier', 'in_array', 'views/orders/details.tpl', 593, false),array('modifier', 'date_format', 'views/orders/details.tpl', 647, false),array('function', 'cycle', 'views/orders/details.tpl', 170, false),array('function', 'math', 'views/orders/details.tpl', 486, false),array('function', 'script', 'views/orders/details.tpl', 589, false),array('function', 'html_options', 'views/orders/details.tpl', 639, false),array('function', 'html_checkboxes', 'views/orders/details.tpl', 642, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('print_invoice','print_pdf_invoice','print_credit_memo','print_pdf_credit_memo','print_order_details','print_pdf_order_details','delete','return_registration','order_returns','start_communication','re_order','delete','products_information','product','price','quantity','discount','tax','subtotal','download','code','rb_recurring_plan','rb_recurring_period','days','rb_duration','rb_start_duration','days','months','expand_sublist_of_items','expand_sublist_of_items','collapse_sublist_of_items','collapse_sublist_of_items','returns_info','items','price_in_points','free','free','customer_notes','summary','payment_method','shipping','usps','ups','fedex','australia_post','dhl','chp','tracking_num','subtotal','shipping_cost','including_discount','order_discount','coupon','taxes','included','tax_exempt','payment_surcharge','total','shipment','product','quantity','download','code','shipping_information','usps','ups','fedex','australia_post','dhl','chp','tracking_num','comments','text_no_shipments_found','status','order'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/status.tpl' => 1367063745,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><div class="orders">

<?php if ($this->_tpl_vars['order_info']): ?>

<?php ob_start(); ?>

	<?php if ($this->_tpl_vars['view_only'] != 'Y'): ?>
		<div class="orders-print clearfix">
			<?php $this->_tag_stack[] = array('hook', array('name' => "orders:details_tools")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			<?php $this->assign('print_order', fn_get_lang_var('print_invoice', $this->getLanguage()), false); ?>
			<?php $this->assign('print_pdf_order', fn_get_lang_var('print_pdf_invoice', $this->getLanguage()), false); ?>
			<?php if ($this->_tpl_vars['status_settings']['appearance_type'] == 'C' && $this->_tpl_vars['order_info']['doc_ids'][$this->_tpl_vars['status_settings']['appearance_type']]): ?>
				<?php $this->assign('print_order', fn_get_lang_var('print_credit_memo', $this->getLanguage()), false); ?>
				<?php $this->assign('print_pdf_order', fn_get_lang_var('print_pdf_credit_memo', $this->getLanguage()), false); ?>
			<?php elseif ($this->_tpl_vars['status_settings']['appearance_type'] == 'O'): ?>
				<?php $this->assign('print_order', fn_get_lang_var('print_order_details', $this->getLanguage()), false); ?>
				<?php $this->assign('print_pdf_order', fn_get_lang_var('print_pdf_order_details', $this->getLanguage()), false); ?>
			<?php endif; ?>
			
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/button_popup.tpl", 'smarty_include_vars' => array('but_role' => 'text','but_text' => $this->_tpl_vars['print_order'],'but_href' => "orders.print_invoice?order_id=".($this->_tpl_vars['order_info']['order_id']),'width' => '900','height' => '600')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('but_role' => 'text', 'but_meta' => 'pdf', 'but_text' => $this->_tpl_vars['print_pdf_order'], 'but_href' => "orders.print_invoice?order_id=".($this->_tpl_vars['order_info']['order_id'])."&amp;format=pdf", )); ?>

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
			<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			<ul class="orders-actions">
			<?php if ($this->_tpl_vars['view_only'] != 'Y'): ?>
				<?php $this->_tag_stack[] = array('hook', array('name' => "orders:details_bullets")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				<?php if ($this->_tpl_vars['addons']['rma']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><?php if ($this->_tpl_vars['order_info']['allow_return']): ?>
	<li><a href="<?php echo fn_url("rma.create_return?order_id=".($this->_tpl_vars['order_info']['order_id'])); ?>
" class="return"><?php echo fn_get_lang_var('return_registration', $this->getLanguage()); ?>
</a></li>
<?php endif; ?>
<?php if ($this->_tpl_vars['order_info']['isset_returns']): ?>
	<li><a href="<?php echo fn_url("rma.returns?order_id=".($this->_tpl_vars['order_info']['order_id'])); ?>
" class="return"><?php echo fn_get_lang_var('order_returns', $this->getLanguage()); ?>
</a></li>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['discussion']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><?php $this->assign('discussion', smarty_modifier_fn_get_discussion($this->_tpl_vars['order_info']['order_id'], 'O'), false); ?>
<?php if ($this->_tpl_vars['addons']['discussion']['order_initiate'] == 'Y' && ! $this->_tpl_vars['discussion']): ?>
	<li><a href="<?php echo fn_url("orders.initiate_discussion?order_id=".($this->_tpl_vars['order_info']['order_id'])); ?>
" class="orders-communication-start"><?php echo fn_get_lang_var('start_communication', $this->getLanguage()); ?>
</a></li>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			<?php endif; ?>
			<li><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('but_role' => 'text', 'but_text' => fn_get_lang_var('re_order', $this->getLanguage()), 'but_href' => "orders.reorder?order_id=".($this->_tpl_vars['order_info']['order_id']), )); ?>

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
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></li>
			</ul>
		</div>
	<?php endif; ?>
<?php $this->_smarty_vars['capture']['order_actions'] = ob_get_contents(); ob_end_clean(); ?>

<?php ob_start(); ?>

<div id="content_general" class="<?php if ($this->_tpl_vars['selected_section'] && $this->_tpl_vars['selected_section'] != 'general'): ?>hidden<?php endif; ?>">
	<?php if ($this->_tpl_vars['without_customer'] != 'Y'): ?>
			<div class="orders-customer">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/profiles/components/profiles_info.tpl", 'smarty_include_vars' => array('user_data' => $this->_tpl_vars['order_info'],'location' => 'I')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
		<?php endif; ?>


<?php ob_start(); ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('products_information', $this->getLanguage()))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<table cellpadding="0" cellspacing="0" border="0" class="table" width="100%">
<?php $this->_tag_stack[] = array('hook', array('name' => "orders:items_list_header")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<thead>
<tr>
	<th class="product"><?php echo fn_get_lang_var('product', $this->getLanguage()); ?>
</th>
	<th class="price" align="right"><?php echo fn_get_lang_var('price', $this->getLanguage()); ?>
</th>
	<th class="quantity"><?php echo fn_get_lang_var('quantity', $this->getLanguage()); ?>
</th>
	<?php if ($this->_tpl_vars['order_info']['use_discount']): ?>
		<th><?php echo fn_get_lang_var('discount', $this->getLanguage()); ?>
</th>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['order_info']['taxes'] && $this->_tpl_vars['settings']['General']['tax_calculation'] != 'subtotal'): ?>
		<th><?php echo fn_get_lang_var('tax', $this->getLanguage()); ?>
</th>
	<?php endif; ?>
	<th class="subtotal"><?php echo fn_get_lang_var('subtotal', $this->getLanguage()); ?>
</th>
</tr>
</thead>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php $_from = $this->_tpl_vars['order_info']['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['product']):
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
<?php if (! $this->_tpl_vars['product']['extra']['parent']): ?>
<?php echo smarty_function_cycle(array('values' => ",class=\"table-row\"",'name' => 'class_cycle','assign' => '_class'), $this);?>

<tr <?php echo $this->_tpl_vars['_class']; ?>
 valign="top">
	<td><?php if ($this->_tpl_vars['product']['is_accessible']): ?><a href="<?php echo fn_url("products.view?product_id=".($this->_tpl_vars['product']['product_id'])); ?>
" class="product-title"><?php endif; ?><?php echo smarty_modifier_unescape($this->_tpl_vars['product']['product']); ?>
<?php if ($this->_tpl_vars['product']['is_accessible']): ?></a><?php endif; ?>
		<?php if ($this->_tpl_vars['product']['extra']['is_edp'] == 'Y'): ?>
		<div class="right"><a href="<?php echo fn_url("orders.order_downloads?order_id=".($this->_tpl_vars['order_info']['order_id'])); ?>
"><strong>[<?php echo fn_get_lang_var('download', $this->getLanguage()); ?>
]</strong></a></div>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['product']['product_code']): ?>
		<p class="code"><?php echo fn_get_lang_var('code', $this->getLanguage()); ?>
:&nbsp;<?php echo $this->_tpl_vars['product']['product_code']; ?>
</p>
		<?php endif; ?>
		<?php $this->_tag_stack[] = array('hook', array('name' => "orders:product_info")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if ($this->_tpl_vars['addons']['recurring_billing']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><?php if ($this->_tpl_vars['product']['extra']['recurring_plan_id'] && ! ( @CONTROLLER == 'subscriptions' && @MODE == 'view' )): ?>
	<div class="product-list-field clearfix">
		<label><?php echo fn_get_lang_var('rb_recurring_plan', $this->getLanguage()); ?>
:</label>
		<span><?php echo $this->_tpl_vars['product']['extra']['recurring_plan']['name']; ?>
</span>
	</div>

	<div class="product-list-field clearfix">
		<label><?php echo fn_get_lang_var('rb_recurring_period', $this->getLanguage()); ?>
:</label>
		<span class="lowercase"><?php echo smarty_modifier_escape(smarty_modifier_fn_get_recurring_period_name($this->_tpl_vars['product']['extra']['recurring_plan']['period'])); ?>
</span><?php if ($this->_tpl_vars['product']['extra']['recurring_plan']['period'] == 'P'): ?> - <?php echo $this->_tpl_vars['product']['extra']['recurring_plan']['by_period']; ?>
 <?php echo fn_get_lang_var('days', $this->getLanguage()); ?>
<?php endif; ?>
	</div>

	<div class="product-list-field clearfix">
		<label><?php echo fn_get_lang_var('rb_duration', $this->getLanguage()); ?>
:</label>
		<span><?php echo $this->_tpl_vars['product']['extra']['recurring_duration']; ?>
</span>
	</div>

	<?php if ($this->_tpl_vars['product']['extra']['recurring_plan']['start_duration']): ?>
	<div class="product-list-field clearfix">
		<label><?php echo fn_get_lang_var('rb_start_duration', $this->getLanguage()); ?>
:</label>
		<span><?php echo $this->_tpl_vars['product']['extra']['recurring_plan']['start_duration']; ?>
 <?php if ($this->_tpl_vars['product']['extra']['recurring_plan']['start_duration_type'] == 'D'): ?><?php echo fn_get_lang_var('days', $this->getLanguage()); ?>
<?php else: ?><?php echo fn_get_lang_var('months', $this->getLanguage()); ?>
<?php endif; ?></span>
	</div>
	<?php endif; ?>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?>
		<?php if ($this->_tpl_vars['product']['product_options']): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/options_info.tpl", 'smarty_include_vars' => array('product_options' => $this->_tpl_vars['product']['product_options'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?>
		<?php if ($this->_tpl_vars['addons']['gift_certificates']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/gift_certificates/hooks/orders/product_info.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['rma']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><?php if ($this->_tpl_vars['product']['returns_info']): ?>
	<?php if (! $this->_tpl_vars['return_statuses']): ?><?php $this->assign('return_statuses', fn_get_statuses(@STATUSES_RETURN, true), false); ?><?php endif; ?>
		<p><img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/plus.gif" width="14" height="9" border="0" alt="<?php echo fn_get_lang_var('expand_sublist_of_items', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('expand_sublist_of_items', $this->getLanguage()); ?>
" id="on_ret_<?php echo $this->_tpl_vars['key']; ?>
" class="hand cm-combination" /><img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/minus.gif" width="14" height="9" border="0" alt="<?php echo fn_get_lang_var('collapse_sublist_of_items', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('collapse_sublist_of_items', $this->getLanguage()); ?>
" id="off_ret_<?php echo $this->_tpl_vars['key']; ?>
" class="hand cm-combination hidden" /><a class="cm-combination" id="sw_ret_<?php echo $this->_tpl_vars['key']; ?>
"><?php echo fn_get_lang_var('returns_info', $this->getLanguage()); ?>
</a></p>
	<div class="box hidden" id="ret_<?php echo $this->_tpl_vars['key']; ?>
">
		<?php $_from = $this->_tpl_vars['product']['returns_info']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['f_rinfo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['f_rinfo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['status'] => $this->_tpl_vars['amount']):
        $this->_foreach['f_rinfo']['iteration']++;
?>
			<p><strong><?php echo smarty_modifier_default(@$this->_tpl_vars['return_statuses'][$this->_tpl_vars['status']], ""); ?>
</strong>:&nbsp;<?php echo $this->_tpl_vars['amount']; ?>
 <?php echo fn_get_lang_var('items', $this->getLanguage()); ?>
</p>
		<?php endforeach; endif; unset($_from); ?>	
	</div>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['reward_points']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><?php if ($this->_tpl_vars['order_info']['points_info']['price'] && $this->_tpl_vars['product']): ?>
	<div class="product-list-field">
		<label><?php echo fn_get_lang_var('price_in_points', $this->getLanguage()); ?>
:</label>
		<?php echo $this->_tpl_vars['product']['extra']['points_info']['price']; ?>

	</div>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	</td>
	<td class="right nowrap">
		<?php if ($this->_tpl_vars['product']['extra']['exclude_from_calculate']): ?><?php echo fn_get_lang_var('free', $this->getLanguage()); ?>
<?php else: ?><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['product']['original_price'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?></td>
	<td class="center">&nbsp;<?php echo $this->_tpl_vars['product']['amount']; ?>
</td>
	<?php if ($this->_tpl_vars['order_info']['use_discount']): ?>
		<td class="right nowrap">
			<?php if (floatval($this->_tpl_vars['product']['extra']['discount'])): ?><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['product']['extra']['discount'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php else: ?>-<?php endif; ?>
		</td>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['order_info']['taxes'] && $this->_tpl_vars['settings']['General']['tax_calculation'] != 'subtotal'): ?>
		<td class="center nowrap">
			<?php if (floatval($this->_tpl_vars['product']['tax_value'])): ?><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['product']['tax_value'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php else: ?>-<?php endif; ?>
		</td>
	<?php endif; ?>
	<td class="right">
         &nbsp;<strong><?php if ($this->_tpl_vars['product']['extra']['exclude_from_calculate']): ?><?php echo fn_get_lang_var('free', $this->getLanguage()); ?>
<?php else: ?><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['product']['display_subtotal'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?></strong></td>
</tr>
<?php endif; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php endif; ?><?php endif; ?>
<?php endforeach; endif; unset($_from); ?>

<?php $this->_tag_stack[] = array('hook', array('name' => "orders:extra_list")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if ($this->_tpl_vars['addons']['gift_certificates']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/gift_certificates/hooks/orders/extra_list.pre.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?>
	<?php $this->assign('colsp', 5, false); ?>
	<?php if ($this->_tpl_vars['order_info']['use_discount']): ?><?php $this->assign('colsp', $this->_tpl_vars['colsp']+1, false); ?><?php endif; ?>
	<?php if ($this->_tpl_vars['order_info']['taxes'] && $this->_tpl_vars['settings']['General']['tax_calculation'] != 'subtotal'): ?><?php $this->assign('colsp', $this->_tpl_vars['colsp']+1, false); ?><?php endif; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

</table>

	<?php if ($this->_tpl_vars['order_info']['notes']): ?>
	<div class="orders-notes">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('customer_notes', $this->getLanguage()))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<div class="orders-notes-body">
			<div class="orders-notes-arrow"></div>
			<?php echo $this->_tpl_vars['order_info']['notes']; ?>

		</div>
	</div>
	<?php endif; ?>

<div class="orders-summary">
<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('summary', $this->getLanguage()))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="float-right">
	<?php $this->_tag_stack[] = array('hook', array('name' => "orders:info")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if ($this->_tpl_vars['addons']['barcode']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><div class="float-right"><img src="<?php echo fn_url("image.barcode.draw?id=".($this->_tpl_vars['order_info']['order_id'])."&amp;type=".($this->_tpl_vars['addons']['barcode']['type'])."&amp;width=".($this->_tpl_vars['addons']['barcode']['width'])."&amp;height=".($this->_tpl_vars['addons']['barcode']['height'])."&amp;xres=".($this->_tpl_vars['addons']['barcode']['resolution'])."&amp;font=".($this->_tpl_vars['addons']['barcode']['text_font'])); ?>
" alt="BarCode" width="<?php echo $this->_tpl_vars['addons']['barcode']['width']; ?>
" height="<?php echo $this->_tpl_vars['addons']['barcode']['height']; ?>
" /></div><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
</div>

<div class="orders-summary-wrap">
<table>
<?php $this->_tag_stack[] = array('hook', array('name' => "orders:totals")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<?php if ($this->_tpl_vars['order_info']['payment_id']): ?>
	<tr>
		<td><?php echo fn_get_lang_var('payment_method', $this->getLanguage()); ?>
:&nbsp;</td>
		<td width="57%"><?php echo $this->_tpl_vars['order_info']['payment_method']['payment']; ?>
&nbsp;<?php if ($this->_tpl_vars['order_info']['payment_method']['description']): ?>(<?php echo $this->_tpl_vars['order_info']['payment_method']['description']; ?>
)<?php endif; ?></td>
	</tr>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['order_info']['shipping'] && $this->_tpl_vars['settings']['General']['use_shipments'] != 'Y'): ?>
	<tr valign="top">
		<td><?php echo fn_get_lang_var('shipping', $this->getLanguage()); ?>
:&nbsp;</td>
		<td>
			<?php $_from = $this->_tpl_vars['order_info']['shipping']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['f_shipp'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['f_shipp']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['shipping_id'] => $this->_tpl_vars['shipping']):
        $this->_foreach['f_shipp']['iteration']++;
?>
				<?php if ($this->_tpl_vars['shipping']['carrier'] && $this->_tpl_vars['shipping']['tracking_number']): ?>
					<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('carrier' => $this->_tpl_vars['shipping']['carrier'], 'tracking_number' => $this->_tpl_vars['shipping']['tracking_number'], )); ?><?php if ($this->_tpl_vars['carrier'] == 'USP'): ?>
	<?php $this->assign('url', "http://trkcnfrm1.smi.usps.com/PTSInternetWeb/InterLabelInquiry.do?strOrigTrackNum=".($this->_tpl_vars['tracking_number']), false); ?>
	<?php $this->assign('carrier_name', fn_get_lang_var('usps', $this->getLanguage()), false); ?>
<?php elseif ($this->_tpl_vars['carrier'] == 'UPS'): ?>
	<?php $this->assign('url', "http://wwwapps.ups.com/WebTracking/processInputRequest?AgreeToTermsAndConditions=yes&amp;tracknum=".($this->_tpl_vars['tracking_number']), false); ?>
	<?php $this->assign('carrier_name', fn_get_lang_var('ups', $this->getLanguage()), false); ?>
<?php elseif ($this->_tpl_vars['carrier'] == 'FDX'): ?>
	<?php $this->assign('url', "http://fedex.com/Tracking?action=track&amp;tracknumbers=".($this->_tpl_vars['tracking_number']), false); ?>
	<?php $this->assign('carrier_name', fn_get_lang_var('fedex', $this->getLanguage()), false); ?>
<?php elseif ($this->_tpl_vars['carrier'] == 'AUP'): ?>
	<form name="tracking_form<?php echo $this->_tpl_vars['shipment_id']; ?>
" target="_blank" action="http://ice.auspost.com.au/display.asp?ShowFirstScreenOnly=FALSE&ShowFirstRecOnly=TRUE" method="post">
		<input type="hidden"  name="txtItemNumber" maxlength="13" value="<?php echo $this->_tpl_vars['tracking_number']; ?>
" />
	</form>
	<?php $this->assign('url', "javascript: document.tracking_form".($this->_tpl_vars['shipment_id']).".submit();", false); ?>
	<?php $this->assign('carrier_name', fn_get_lang_var('australia_post', $this->getLanguage()), false); ?>
<?php elseif ($this->_tpl_vars['carrier'] == 'DHL' || $this->_tpl_vars['shipping']['carrier'] == 'ARB'): ?>
	<form name="tracking_form<?php echo $this->_tpl_vars['shipment_id']; ?>
" target="_blank" method="post" action="http://track.dhl-usa.com/TrackByNbr.asp?nav=Tracknbr">
		<input type="hidden" name="txtTrackNbrs" value="<?php echo $this->_tpl_vars['tracking_number']; ?>
" />
	</form>
	<?php $this->assign('url', "javascript: document.tracking_form".($this->_tpl_vars['shipment_id']).".submit();", false); ?>
	<?php $this->assign('carrier_name', fn_get_lang_var('dhl', $this->getLanguage()), false); ?>
<?php elseif ($this->_tpl_vars['carrier'] == 'CHP'): ?>
	<?php $this->assign('url', "http://www.post.ch/swisspost-tracking?formattedParcelCodes=".($this->_tpl_vars['tracking_number']), false); ?>
	<?php $this->assign('carrier_name', fn_get_lang_var('chp', $this->getLanguage()), false); ?>
<?php endif; ?>

<?php ob_start(); ?>
<?php echo $this->_tpl_vars['carrier_name']; ?>

<?php $this->_smarty_vars['capture']['carrier_name'] = ob_get_contents(); ob_end_clean(); ?>

<?php ob_start(); ?>
<?php echo $this->_tpl_vars['url']; ?>

<?php $this->_smarty_vars['capture']['carrier_url'] = ob_get_contents(); ob_end_clean(); ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>

					<?php echo $this->_tpl_vars['shipping']['shipping']; ?>
&nbsp;(<?php echo fn_get_lang_var('tracking_num', $this->getLanguage()); ?>
<a <?php if (strpos($this->_smarty_vars['capture']['carrier_url'], "://")): ?>target="_blank"<?php endif; ?> href="<?php echo $this->_smarty_vars['capture']['carrier_url']; ?>
"><?php echo $this->_tpl_vars['shipping']['tracking_number']; ?>
</a>)
				<?php else: ?>
					<?php echo $this->_tpl_vars['shipping']['shipping']; ?>

				<?php endif; ?>
				<?php if (! ($this->_foreach['f_shipp']['iteration'] == $this->_foreach['f_shipp']['total'])): ?><br><?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
		</td>
	</tr>
	<?php endif; ?>
	<tr>
		<td><?php echo fn_get_lang_var('subtotal', $this->getLanguage()); ?>
:&nbsp;</td>
		<td><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['order_info']['display_subtotal'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
	</tr>
	<?php if (floatval($this->_tpl_vars['order_info']['display_shipping_cost'])): ?>
	<tr>
		<td><?php echo fn_get_lang_var('shipping_cost', $this->getLanguage()); ?>
:&nbsp;</td>
		<td><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['order_info']['display_shipping_cost'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
	</tr>
	<?php endif; ?>
	<?php if (floatval($this->_tpl_vars['order_info']['discount'])): ?>
	<tr>
		<td class="nowrap strong"><?php echo fn_get_lang_var('including_discount', $this->getLanguage()); ?>
:</td>
		<td class="nowrap">
			<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['order_info']['discount'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
	</tr>
	<?php endif; ?>

	<?php if (floatval($this->_tpl_vars['order_info']['subtotal_discount'])): ?>
	<tr>
		<td class="nowrap strong"><?php echo fn_get_lang_var('order_discount', $this->getLanguage()); ?>
:</td>
		<td class="nowrap">
			<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['order_info']['subtotal_discount'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
	</tr>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['order_info']['coupons']): ?>
	<?php $_from = $this->_tpl_vars['order_info']['coupons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['coupon']):
?>
	<tr>
		<td class="nowrap"><?php echo fn_get_lang_var('coupon', $this->getLanguage()); ?>
:</td>
		<td><?php echo $this->_tpl_vars['key']; ?>
</td>
	</tr>
	<?php endforeach; endif; unset($_from); ?>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['order_info']['taxes']): ?>
	<tr class="taxes">
		<td><strong><?php echo fn_get_lang_var('taxes', $this->getLanguage()); ?>
:</strong></td>
		<td>&nbsp;</td>
	</tr>
	<?php $_from = $this->_tpl_vars['order_info']['taxes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tax_data']):
?>
	<tr class="taxes-desc">
		<td><?php echo $this->_tpl_vars['tax_data']['description']; ?>
&nbsp;<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/modifier.tpl", 'smarty_include_vars' => array('mod_value' => $this->_tpl_vars['tax_data']['rate_value'],'mod_type' => $this->_tpl_vars['tax_data']['rate_type'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php if ($this->_tpl_vars['tax_data']['price_includes_tax'] == 'Y' && ( $this->_tpl_vars['settings']['Appearance']['cart_prices_w_taxes'] != 'Y' || $this->_tpl_vars['settings']['General']['tax_calculation'] == 'subtotal' )): ?>&nbsp;<?php echo fn_get_lang_var('included', $this->getLanguage()); ?>
<?php endif; ?><?php if ($this->_tpl_vars['tax_data']['regnumber']): ?>&nbsp;(<?php echo $this->_tpl_vars['tax_data']['regnumber']; ?>
)<?php endif; ?>&nbsp;</td>
		<td><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['tax_data']['tax_subtotal'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
	</tr>
	<?php endforeach; endif; unset($_from); ?>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['order_info']['tax_exempt'] == 'Y'): ?>
	<tr>
		<td><?php echo fn_get_lang_var('tax_exempt', $this->getLanguage()); ?>
</td>
		<td>&nbsp;</td>
	<tr>
	<?php endif; ?>

	<?php if (floatval($this->_tpl_vars['order_info']['payment_surcharge']) && ! $this->_tpl_vars['take_surcharge_from_vendor']): ?>
	<tr>
		<td><?php echo smarty_modifier_default(@$this->_tpl_vars['order_info']['payment_method']['surcharge_title'], fn_get_lang_var('payment_surcharge', $this->getLanguage())); ?>
:&nbsp;</td>
		<td><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['order_info']['payment_surcharge'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
	</tr>
	<?php endif; ?>
	<tr class="total">
		<td><?php echo fn_get_lang_var('total', $this->getLanguage()); ?>
:&nbsp;</td>
		<td><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['order_info']['total'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
	</tr>
<?php if ($this->_tpl_vars['addons']['gift_certificates']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/gift_certificates/hooks/orders/totals.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['rma']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/rma/hooks/orders/totals.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['reward_points']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/reward_points/hooks/orders/totals.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
</table>
	</div>
	<div class="clear"></div>
</div>

<?php if ($this->_tpl_vars['order_info']['promotions']): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/orders/components/promotions.tpl", 'smarty_include_vars' => array('promotions' => $this->_tpl_vars['order_info']['promotions'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['view_only'] != 'Y'): ?>
<div class="orders-repay">
	<?php if ($this->_tpl_vars['addons']['recurring_billing']['status'] == 'A'): ?><?php ob_start(); $this->_in_capture[] = 'ec60d932c2396839c81c3e71a2d86253';
$_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/recurring_billing/hooks/orders/repay.override.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
$this->_tpl_vars['addon_content'] = ob_get_contents(); ob_end_clean(); array_pop($this->_in_capture); if (!empty($this->_scripts['ec60d932c2396839c81c3e71a2d86253'])) { echo implode("\n", $this->_scripts['ec60d932c2396839c81c3e71a2d86253']); unset($this->_scripts['ec60d932c2396839c81c3e71a2d86253']); }
 ?><?php else: ?><?php $this->assign('addon_content', "", false); ?><?php endif; ?><?php if (trim($this->_tpl_vars['addon_content'])): ?><?php echo $this->_tpl_vars['addon_content']; ?>
<?php else: ?><?php $this->_tag_stack[] = array('hook', array('name' => "orders:repay")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<?php if ($this->_tpl_vars['settings']['General']['repay'] == 'Y' && $this->_tpl_vars['payment_methods']): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/orders/components/order_repay.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php endif; ?>
	</div>
<?php endif; ?>


<?php $this->_smarty_vars['capture']['group'] = ob_get_contents(); ob_end_clean(); ?>
<div class="orders-product">
<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('content' => $this->_smarty_vars['capture']['group'], )); ?><div class="border">
	<div class="subheaders-group"><?php echo smarty_modifier_default(@$this->_tpl_vars['content'], "&nbsp;"); ?>
</div>
</div><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
</div>
</div><!-- main order info -->


<?php if ($this->_tpl_vars['settings']['General']['use_shipments'] == 'Y'): ?>
	<div id="content_shipment_info" class="orders-shipment <?php if ($this->_tpl_vars['selected_section'] != 'shipment_info'): ?>hidden<?php endif; ?>">
		<?php $_from = $this->_tpl_vars['shipments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['shipment']):
?>
			<?php echo smarty_function_math(array('equation' => "id + 1",'id' => $this->_tpl_vars['id'],'assign' => 'shipment_display_id'), $this);?>

			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => (fn_get_lang_var('shipment', $this->getLanguage()))."&nbsp;#".($this->_tpl_vars['shipment_display_id']))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

			<table cellpadding="0" cellspacing="0" border="0" class="table" width="100%">
			<thead>
			<tr>
				<th width="90%"><?php echo fn_get_lang_var('product', $this->getLanguage()); ?>
</th>
				<th><?php echo fn_get_lang_var('quantity', $this->getLanguage()); ?>
</th>
			</tr>
			</thead>
			<?php $_from = $this->_tpl_vars['shipment']['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['shipped_product']):
?>
			<?php $this->assign('product_hash', $this->_tpl_vars['shipped_product']['item_id'], false); ?>
			<?php if ($this->_tpl_vars['order_info']['items'][$this->_tpl_vars['product_hash']]): ?>
				<?php $this->assign('product', $this->_tpl_vars['order_info']['items'][$this->_tpl_vars['product_hash']], false); ?>
				<?php echo smarty_function_cycle(array('values' => ",class=\"table-row\"",'name' => 'class_cycle','assign' => '_class'), $this);?>

				<tr <?php echo $this->_tpl_vars['_class']; ?>
 valign="top">
					<td><?php if ($this->_tpl_vars['product']['is_accessible']): ?><a href="<?php echo fn_url("products.view?product_id=".($this->_tpl_vars['product']['product_id'])); ?>
" class="product-title"><?php endif; ?><?php echo smarty_modifier_unescape($this->_tpl_vars['product']['product']); ?>
<?php if ($this->_tpl_vars['product']['is_accessible']): ?></a><?php endif; ?>
						<?php if ($this->_tpl_vars['product']['extra']['is_edp'] == 'Y'): ?>
						<div class="right"><a href="<?php echo fn_url("orders.order_downloads?order_id=".($this->_tpl_vars['order_info']['order_id'])); ?>
"><strong>[<?php echo fn_get_lang_var('download', $this->getLanguage()); ?>
]</strong></a></div>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['product']['product_code']): ?>
						<p><?php echo fn_get_lang_var('code', $this->getLanguage()); ?>
:&nbsp;<?php echo $this->_tpl_vars['product']['product_code']; ?>
</p>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['product']['product_options']): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/options_info.tpl", 'smarty_include_vars' => array('product_options' => $this->_tpl_vars['product']['product_options'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?>
					</td>
					<td class="center">&nbsp;<?php echo $this->_tpl_vars['shipped_product']['amount']; ?>
</td>
				</tr>
			<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
			</table>
			
			<div class="orders-shipment-info"><h2><?php echo fn_get_lang_var('shipping_information', $this->getLanguage()); ?>
</h2>
			<?php if ($this->_tpl_vars['shipment']['carrier'] && $this->_tpl_vars['shipment']['tracking_number']): ?>
				<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('carrier' => $this->_tpl_vars['shipment']['carrier'], 'tracking_number' => $this->_tpl_vars['shipment']['tracking_number'], 'shipment_id' => $this->_tpl_vars['shipment']['shipment_id'], )); ?><?php if ($this->_tpl_vars['carrier'] == 'USP'): ?>
	<?php $this->assign('url', "http://trkcnfrm1.smi.usps.com/PTSInternetWeb/InterLabelInquiry.do?strOrigTrackNum=".($this->_tpl_vars['tracking_number']), false); ?>
	<?php $this->assign('carrier_name', fn_get_lang_var('usps', $this->getLanguage()), false); ?>
<?php elseif ($this->_tpl_vars['carrier'] == 'UPS'): ?>
	<?php $this->assign('url', "http://wwwapps.ups.com/WebTracking/processInputRequest?AgreeToTermsAndConditions=yes&amp;tracknum=".($this->_tpl_vars['tracking_number']), false); ?>
	<?php $this->assign('carrier_name', fn_get_lang_var('ups', $this->getLanguage()), false); ?>
<?php elseif ($this->_tpl_vars['carrier'] == 'FDX'): ?>
	<?php $this->assign('url', "http://fedex.com/Tracking?action=track&amp;tracknumbers=".($this->_tpl_vars['tracking_number']), false); ?>
	<?php $this->assign('carrier_name', fn_get_lang_var('fedex', $this->getLanguage()), false); ?>
<?php elseif ($this->_tpl_vars['carrier'] == 'AUP'): ?>
	<form name="tracking_form<?php echo $this->_tpl_vars['shipment_id']; ?>
" target="_blank" action="http://ice.auspost.com.au/display.asp?ShowFirstScreenOnly=FALSE&ShowFirstRecOnly=TRUE" method="post">
		<input type="hidden"  name="txtItemNumber" maxlength="13" value="<?php echo $this->_tpl_vars['tracking_number']; ?>
" />
	</form>
	<?php $this->assign('url', "javascript: document.tracking_form".($this->_tpl_vars['shipment_id']).".submit();", false); ?>
	<?php $this->assign('carrier_name', fn_get_lang_var('australia_post', $this->getLanguage()), false); ?>
<?php elseif ($this->_tpl_vars['carrier'] == 'DHL' || $this->_tpl_vars['shipping']['carrier'] == 'ARB'): ?>
	<form name="tracking_form<?php echo $this->_tpl_vars['shipment_id']; ?>
" target="_blank" method="post" action="http://track.dhl-usa.com/TrackByNbr.asp?nav=Tracknbr">
		<input type="hidden" name="txtTrackNbrs" value="<?php echo $this->_tpl_vars['tracking_number']; ?>
" />
	</form>
	<?php $this->assign('url', "javascript: document.tracking_form".($this->_tpl_vars['shipment_id']).".submit();", false); ?>
	<?php $this->assign('carrier_name', fn_get_lang_var('dhl', $this->getLanguage()), false); ?>
<?php elseif ($this->_tpl_vars['carrier'] == 'CHP'): ?>
	<?php $this->assign('url', "http://www.post.ch/swisspost-tracking?formattedParcelCodes=".($this->_tpl_vars['tracking_number']), false); ?>
	<?php $this->assign('carrier_name', fn_get_lang_var('chp', $this->getLanguage()), false); ?>
<?php endif; ?>

<?php ob_start(); ?>
<?php echo $this->_tpl_vars['carrier_name']; ?>

<?php $this->_smarty_vars['capture']['carrier_name'] = ob_get_contents(); ob_end_clean(); ?>

<?php ob_start(); ?>
<?php echo $this->_tpl_vars['url']; ?>

<?php $this->_smarty_vars['capture']['carrier_url'] = ob_get_contents(); ob_end_clean(); ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
				
				<?php echo $this->_tpl_vars['shipment']['shipping']; ?>
&nbsp;(<?php echo fn_get_lang_var('tracking_num', $this->getLanguage()); ?>
<a <?php if (strpos($this->_smarty_vars['capture']['carrier_url'], "://")): ?>target="_blank"<?php endif; ?> href="<?php echo $this->_smarty_vars['capture']['carrier_url']; ?>
"><?php echo $this->_tpl_vars['shipment']['tracking_number']; ?>
</a>)
			<?php else: ?>
				<?php echo $this->_tpl_vars['shipment']['shipping']; ?>

			<?php endif; ?>
			</div>
			<?php if ($this->_tpl_vars['shipment']['comments']): ?>
				<div class="orders-shipment-comments"><h2><?php echo fn_get_lang_var('comments', $this->getLanguage()); ?>
</h2><br />
					<div class="orders-notes-body">
						<div class="orders-notes-arrow"></div>
						<?php echo $this->_tpl_vars['shipment']['comments']; ?>

					</div>
				</div>
			<?php endif; ?>
			
		<?php endforeach; else: ?>
			<p class="no-items"><?php echo fn_get_lang_var('text_no_shipments_found', $this->getLanguage()); ?>
</p>
		<?php endif; unset($_from); ?>
	</div>
<?php endif; ?>


<?php $this->_tag_stack[] = array('hook', array('name' => "orders:tabs")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<?php if ($this->_tpl_vars['addons']['discussion']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/discussion/hooks/orders/tabs.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<?php $this->_smarty_vars['capture']['tabsbox'] = ob_get_contents(); ob_end_clean(); ?>
<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('top_order_actions' => $this->_smarty_vars['capture']['order_actions'], 'content' => $this->_smarty_vars['capture']['tabsbox'], 'active_tab' => $this->_tpl_vars['_REQUEST']['selected_section'], )); ?><?php if (! $this->_tpl_vars['active_tab']): ?>
	<?php $this->assign('active_tab', $this->_tpl_vars['_REQUEST']['selected_section'], false); ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['navigation']['tabs']): ?>

<?php $this->assign('empty_tab_ids', smarty_modifier_empty_tabs($this->_tpl_vars['content']), false); ?>
<?php $this->assign('_tabs', false, false); ?>

<?php if ($this->_tpl_vars['top_order_actions']): ?><?php echo $this->_tpl_vars['top_order_actions']; ?>
<?php endif; ?>

<?php echo smarty_function_script(array('src' => "js/tabs.js"), $this);?>

<div class="tabs cm-j-tabs<?php if ($this->_tpl_vars['track']): ?> cm-track<?php endif; ?> clearfix">
	<ul <?php if ($this->_tpl_vars['tabs_section']): ?>id="tabs_<?php echo $this->_tpl_vars['tabs_section']; ?>
"<?php endif; ?>>
	<?php $_from = $this->_tpl_vars['navigation']['tabs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['tabs'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['tabs']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['tab']):
        $this->_foreach['tabs']['iteration']++;
?>
		<?php if (( ( ! $this->_tpl_vars['tabs_section'] && ! $this->_tpl_vars['tab']['section'] ) || ( $this->_tpl_vars['tabs_section'] == $this->_tpl_vars['tab']['section'] ) ) && ! smarty_modifier_in_array($this->_tpl_vars['key'], $this->_tpl_vars['empty_tab_ids'])): ?>
		<?php if (! $this->_tpl_vars['active_tab']): ?>
			<?php $this->assign('active_tab', $this->_tpl_vars['key'], false); ?>
		<?php endif; ?>
		<?php $this->assign('_tabs', true, false); ?>
		<li id="<?php echo $this->_tpl_vars['key']; ?>
" class="<?php if ($this->_tpl_vars['tab']['js']): ?>cm-js<?php elseif ($this->_tpl_vars['tab']['ajax']): ?>cm-js cm-ajax<?php endif; ?><?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['active_tab']): ?> cm-active<?php endif; ?>"><a<?php if ($this->_tpl_vars['tab']['href']): ?> href="<?php echo fn_url($this->_tpl_vars['tab']['href']); ?>
"<?php endif; ?>><?php echo $this->_tpl_vars['tab']['title']; ?>
</a></li>
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	</ul>
</div>

<?php if ($this->_tpl_vars['_tabs']): ?>
<div class="cm-tabs-content clearfix" id="tabs_content">
	<?php echo $this->_tpl_vars['content']; ?>

</div>
<?php endif; ?>

<?php if ($this->_tpl_vars['onclick']): ?>
<script type="text/javascript">
//<![CDATA[
	var hndl = <?php echo $this->_tpl_vars['ldelim']; ?>

		'tabs_<?php echo $this->_tpl_vars['tabs_section']; ?>
': <?php echo $this->_tpl_vars['onclick']; ?>

	<?php echo $this->_tpl_vars['rdelim']; ?>

//]]>
</script>
<?php endif; ?>
<?php else: ?>
	<?php echo $this->_tpl_vars['content']; ?>

<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>

<?php endif; ?>
</div>

<?php $this->_tag_stack[] = array('hook', array('name' => "orders:details")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<?php if ($this->_tpl_vars['addons']['rma']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/rma/hooks/orders/details.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<?php ob_start(); ?>
	<em class="status"><?php echo fn_get_lang_var('status', $this->getLanguage()); ?>
: <?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('status' => $this->_tpl_vars['order_info']['status'], 'display' => 'view', 'name' => "update_order[status]", )); ?><?php if (! $this->_tpl_vars['order_status_descr']): ?>
	<?php if (! $this->_tpl_vars['status_type']): ?><?php $this->assign('status_type', @STATUSES_ORDER, false); ?><?php endif; ?>
	<?php $this->assign('order_status_descr', fn_get_statuses($this->_tpl_vars['status_type'], true), false); ?>
<?php endif; ?>

<?php echo ''; ?><?php if ($this->_tpl_vars['display'] == 'view'): ?><?php echo ''; ?><?php echo $this->_tpl_vars['order_status_descr'][$this->_tpl_vars['status']]; ?><?php echo ''; ?><?php elseif ($this->_tpl_vars['display'] == 'select'): ?><?php echo ''; ?><?php echo smarty_function_html_options(array('name' => $this->_tpl_vars['name'],'options' => $this->_tpl_vars['order_status_descr'],'selected' => $this->_tpl_vars['status'],'id' => $this->_tpl_vars['select_id']), $this);?><?php echo ''; ?><?php elseif ($this->_tpl_vars['display'] == 'checkboxes'): ?><?php echo '<div class="status">'; ?><?php echo smarty_function_html_checkboxes(array('name' => $this->_tpl_vars['name'],'options' => $this->_tpl_vars['order_status_descr'],'selected' => $this->_tpl_vars['status'],'columns' => 4), $this);?><?php echo '</div>'; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></em>
	<?php echo fn_get_lang_var('order', $this->getLanguage()); ?>
&nbsp;#<?php echo $this->_tpl_vars['order_info']['order_id']; ?>

	<em class="date">(<?php echo smarty_modifier_date_format($this->_tpl_vars['order_info']['timestamp'], ($this->_tpl_vars['settings']['Appearance']['date_format']).", ".($this->_tpl_vars['settings']['Appearance']['time_format'])); ?>
)</em>
<?php $this->_smarty_vars['capture']['mainbox_title'] = ob_get_contents(); ob_end_clean(); ?>