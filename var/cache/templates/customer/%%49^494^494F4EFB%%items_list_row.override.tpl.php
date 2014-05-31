<?php /* Smarty version 2.6.18, created on 2014-03-10 11:21:46
         compiled from addons/bundled_products/hooks/orders/items_list_row.override.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'addons/bundled_products/hooks/orders/items_list_row.override.tpl', 16, false),array('modifier', 'fn_url', 'addons/bundled_products/hooks/orders/items_list_row.override.tpl', 36, false),array('modifier', 'unescape', 'addons/bundled_products/hooks/orders/items_list_row.override.tpl', 36, false),array('modifier', 'fn_get_recurring_period_name', 'addons/bundled_products/hooks/orders/items_list_row.override.tpl', 51, false),array('modifier', 'escape', 'addons/bundled_products/hooks/orders/items_list_row.override.tpl', 51, false),array('modifier', 'fn_get_statuses', 'addons/bundled_products/hooks/orders/items_list_row.override.tpl', 68, false),array('modifier', 'format_price', 'addons/bundled_products/hooks/orders/items_list_row.override.tpl', 88, false),array('modifier', 'truncate', 'addons/bundled_products/hooks/orders/items_list_row.override.tpl', 145, false),array('modifier', 'floatval', 'addons/bundled_products/hooks/orders/items_list_row.override.tpl', 202, false),array('function', 'math', 'addons/bundled_products/hooks/orders/items_list_row.override.tpl', 26, false),array('function', 'cycle', 'addons/bundled_products/hooks/orders/items_list_row.override.tpl', 33, false),array('block', 'hook', 'addons/bundled_products/hooks/orders/items_list_row.override.tpl', 43, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('download','code','rb_recurring_plan','rb_recurring_period','days','rb_duration','rb_start_duration','days','months','expand_sublist_of_items','expand_sublist_of_items','collapse_sublist_of_items','collapse_sublist_of_items','returns_info','items','price_in_points','expand_sublist_of_items','expand_sublist_of_items','collapse_sublist_of_items','collapse_sublist_of_items','bundled_products','product','price','quantity','discount','tax','subtotal','code','rb_recurring_plan','rb_recurring_period','days','rb_duration','rb_start_duration','days','months','expand_sublist_of_items','expand_sublist_of_items','collapse_sublist_of_items','collapse_sublist_of_items','returns_info','items','price_in_points'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/price.tpl' => 1367063745,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php if ($this->_tpl_vars['product']['extra']['bundled_products']): ?>
	<?php $this->assign('conf_price', smarty_modifier_default(@$this->_tpl_vars['product']['price'], '0'), false); ?>
	<?php $this->assign('conf_subtotal', smarty_modifier_default(@$this->_tpl_vars['product']['display_subtotal'], '0'), false); ?>
	<?php $this->assign('conf_discount', smarty_modifier_default(@$this->_tpl_vars['product']['extra']['discount'], '0'), false); ?>
	<?php $this->assign('conf_tax', smarty_modifier_default(@$this->_tpl_vars['product']['tax_value'], '0'), false); ?>

	<?php $this->assign('_colspan', 4, false); ?>
	<?php $this->assign('c_product', $this->_tpl_vars['product'], false); ?>
	<?php $_from = $this->_tpl_vars['order_info']['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sub_oi']):
?>
		<?php if ($this->_tpl_vars['sub_oi']['extra']['parent']['bundled_products'] && $this->_tpl_vars['sub_oi']['extra']['parent']['bundled_products'] == $this->_tpl_vars['product']['cart_id']): ?>
			<?php ob_start(); ?>1<?php $this->_smarty_vars['capture']['is_conf'] = ob_get_contents(); ob_end_clean(); ?>
			<?php echo smarty_function_math(array('equation' => "item_price * amount + conf_price",'amount' => smarty_modifier_default(@$this->_tpl_vars['sub_oi']['extra']['min_qty'], '1'),'item_price' => smarty_modifier_default(@$this->_tpl_vars['sub_oi']['price'], '0'),'conf_price' => $this->_tpl_vars['conf_price'],'assign' => 'conf_price'), $this);?>

			<?php echo smarty_function_math(array('equation' => "discount + conf_discount",'discount' => smarty_modifier_default(@$this->_tpl_vars['sub_oi']['extra']['discount'], '0'),'conf_discount' => $this->_tpl_vars['conf_discount'],'assign' => 'conf_discount'), $this);?>

			<?php echo smarty_function_math(array('equation' => "tax + conf_tax",'tax' => smarty_modifier_default(@$this->_tpl_vars['sub_oi']['tax_value'], '0'),'conf_tax' => $this->_tpl_vars['conf_tax'],'assign' => 'conf_tax'), $this);?>

			<?php echo smarty_function_math(array('equation' => "subtotal + conf_subtotal",'subtotal' => smarty_modifier_default(@$this->_tpl_vars['sub_oi']['display_subtotal'], '0'),'conf_subtotal' => $this->_tpl_vars['conf_subtotal'],'assign' => 'conf_subtotal'), $this);?>
	
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>

	<?php echo smarty_function_cycle(array('values' => ",table-row",'name' => 'class_cycle','assign' => '_class'), $this);?>

	<tr class="<?php echo $this->_tpl_vars['_class']; ?>
" valign="top">
		<td valign="top">
			<?php if ($this->_tpl_vars['product']['is_accessible']): ?><a href="<?php echo fn_url("products.view?product_id=".($this->_tpl_vars['product']['product_id'])); ?>
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
			
			<?php if ($this->_smarty_vars['capture']['is_conf']): ?>
			<p><img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/plus.gif" width="14" height="9" border="0" alt="<?php echo fn_get_lang_var('expand_sublist_of_items', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('expand_sublist_of_items', $this->getLanguage()); ?>
" id="on_conf_<?php echo $this->_tpl_vars['key']; ?>
" class="hand cm-combination" /><img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/minus.gif" width="14" height="9" border="0" alt="<?php echo fn_get_lang_var('collapse_sublist_of_items', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('collapse_sublist_of_items', $this->getLanguage()); ?>
" id="off_conf_<?php echo $this->_tpl_vars['key']; ?>
" class="hand cm-combination hidden" /><a class="cm-combination" id="sw_conf_<?php echo $this->_tpl_vars['key']; ?>
"><?php echo fn_get_lang_var('bundled_products', $this->getLanguage()); ?>
</a></p>
			<?php endif; ?>
		</td>
		<td class="right"><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['conf_price'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
		<td class="center">&nbsp;<?php echo $this->_tpl_vars['product']['amount']; ?>
</td>
		<?php if ($this->_tpl_vars['order_info']['use_discount']): ?>
		<?php $this->assign('_colspan', $this->_tpl_vars['_colspan']+1, false); ?>
		<td class="right">
			<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['conf_discount'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['order_info']['taxes'] && $this->_tpl_vars['settings']['General']['tax_calculation'] != 'subtotal'): ?>
		<?php $this->assign('_colspan', $this->_tpl_vars['_colspan']+1, false); ?>
		<td class="center">
			<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['conf_tax'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
		<?php endif; ?>
		<td class="right">&nbsp;<strong><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['conf_subtotal'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></strong></td>
	</tr>
	<?php if ($this->_smarty_vars['capture']['is_conf']): ?>
	<tr class="<?php echo $this->_tpl_vars['_class']; ?>
 hidden" id="conf_<?php echo $this->_tpl_vars['key']; ?>
">
		<td colspan="<?php echo $this->_tpl_vars['_colspan']; ?>
">
		<div class="box">
			<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
			<tr>
				<th><?php echo fn_get_lang_var('product', $this->getLanguage()); ?>
</th>
				<th><?php echo fn_get_lang_var('price', $this->getLanguage()); ?>
</th>
				<th><?php echo fn_get_lang_var('quantity', $this->getLanguage()); ?>
</th>
				<?php if ($this->_tpl_vars['order_info']['use_discount']): ?>
				<th><?php echo fn_get_lang_var('discount', $this->getLanguage()); ?>
</th>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['order_info']['taxes'] && $this->_tpl_vars['settings']['General']['tax_calculation'] != 'subtotal'): ?>
				<th><?php echo fn_get_lang_var('tax', $this->getLanguage()); ?>
</th>
				<?php endif; ?>
				<th><?php echo fn_get_lang_var('subtotal', $this->getLanguage()); ?>
</th>
			</tr>
			<?php $_from = $this->_tpl_vars['order_info']['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sub_key'] => $this->_tpl_vars['product']):
?>
			<?php if ($this->_tpl_vars['product']['extra']['parent']['bundled_products'] && $this->_tpl_vars['product']['extra']['parent']['bundled_products'] == $this->_tpl_vars['c_product']['cart_id']): ?>
			<tr <?php echo smarty_function_cycle(array('values' => ",class=\"table-row\"",'name' => "gc_".($this->_tpl_vars['gift_key'])), $this);?>
 valign="top">
				<td>
					<?php if ($this->_tpl_vars['product']['is_accessible']): ?><a href="<?php echo fn_url("products.view?product_id=".($this->_tpl_vars['product']['product_id'])); ?>
"><?php endif; ?><?php echo smarty_modifier_truncate(smarty_modifier_unescape($this->_tpl_vars['product']['product']), 50, "...", true); ?>
<?php if ($this->_tpl_vars['product']['is_accessible']): ?></a><?php endif; ?>&nbsp;
					<?php if ($this->_tpl_vars['product']['product_code']): ?>
					<p><?php echo fn_get_lang_var('code', $this->getLanguage()); ?>
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
					<?php if ($this->_tpl_vars['product']['product_options']): ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/options_info.tpl", 'smarty_include_vars' => array('product_options' => $this->_tpl_vars['product']['product_options'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php endif; ?>
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
				<td class="center nowrap">
					<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['product']['price'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
				<td class="center nowrap">
					<?php echo $this->_tpl_vars['product']['amount']; ?>
</td>
				<?php if ($this->_tpl_vars['order_info']['use_discount']): ?>
				<td class="right nowrap">
					<?php if (floatval($this->_tpl_vars['product']['extra']['discount'])): ?><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['product']['extra']['discount'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php else: ?>-<?php endif; ?></td>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['order_info']['taxes'] && $this->_tpl_vars['settings']['General']['tax_calculation'] != 'subtotal'): ?>
				<td class="center nowrap">
					<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['product']['tax_value'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
				<?php endif; ?>
				<td class="right nowrap">
					<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['product']['display_subtotal'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
			</tr>
			<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
			<tr class="table-footer">
				<td colspan="10">&nbsp;</td>
			</tr>
			</table>
		</div>
		</td>
	</tr>
	<?php endif; ?>
<?php endif; ?>