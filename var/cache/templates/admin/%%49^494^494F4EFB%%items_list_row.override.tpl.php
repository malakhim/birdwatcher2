<?php /* Smarty version 2.6.18, created on 2014-03-08 11:24:16
         compiled from addons/bundled_products/hooks/orders/items_list_row.override.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'addons/bundled_products/hooks/orders/items_list_row.override.tpl', 1, false),array('modifier', 'fn_url', 'addons/bundled_products/hooks/orders/items_list_row.override.tpl', 36, false),array('modifier', 'fn_get_statuses', 'addons/bundled_products/hooks/orders/items_list_row.override.tpl', 40, false),array('modifier', 'fn_get_recurring_period_name', 'addons/bundled_products/hooks/orders/items_list_row.override.tpl', 73, false),array('modifier', 'escape', 'addons/bundled_products/hooks/orders/items_list_row.override.tpl', 73, false),array('modifier', 'format_price', 'addons/bundled_products/hooks/orders/items_list_row.override.tpl', 93, false),array('modifier', 'unescape', 'addons/bundled_products/hooks/orders/items_list_row.override.tpl', 93, false),array('modifier', 'truncate', 'addons/bundled_products/hooks/orders/items_list_row.override.tpl', 154, false),array('modifier', 'floatval', 'addons/bundled_products/hooks/orders/items_list_row.override.tpl', 226, false),array('function', 'math', 'addons/bundled_products/hooks/orders/items_list_row.override.tpl', 27, false),array('function', 'cycle', 'addons/bundled_products/hooks/orders/items_list_row.override.tpl', 152, false),array('block', 'hook', 'addons/bundled_products/hooks/orders/items_list_row.override.tpl', 37, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('sku','expand_sublist_of_items','expand_sublist_of_items','collapse_sublist_of_items','collapse_sublist_of_items','returns_info','status','amount','price_in_points','rb_recurring_plan','rb_recurring_period','days','rb_duration','rb_start_duration','days','months','shipped','bundled_products','product','price','quantity','discount','tax','subtotal','code','expand_sublist_of_items','expand_sublist_of_items','collapse_sublist_of_items','collapse_sublist_of_items','returns_info','status','amount','price_in_points','rb_recurring_plan','rb_recurring_period','days','rb_duration','rb_start_duration','days','months','shipped'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/price.tpl' => 1367063753,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php if ($this->_tpl_vars['oi']['extra']['bundled_products']): ?>
	<?php $this->assign('conf_price', smarty_modifier_default(@$this->_tpl_vars['oi']['price'], '0'), false); ?>
	<?php $this->assign('conf_subtotal', smarty_modifier_default(@$this->_tpl_vars['oi']['display_subtotal'], '0'), false); ?>
	<?php $this->assign('conf_discount', smarty_modifier_default(@$this->_tpl_vars['oi']['extra']['discount'], '0'), false); ?>
	<?php $this->assign('conf_tax', smarty_modifier_default(@$this->_tpl_vars['oi']['tax_value'], '0'), false); ?>


	<?php $this->assign('_colspan', 4, false); ?>
	<?php $this->assign('c_oi', $this->_tpl_vars['oi'], false); ?>
	<?php $_from = $this->_tpl_vars['order_info']['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sub_oi']):
?>
		<?php if ($this->_tpl_vars['sub_oi']['extra']['parent']['bundled_products'] && $this->_tpl_vars['sub_oi']['extra']['parent']['bundled_products'] == $this->_tpl_vars['oi']['cart_id']): ?>
			<?php ob_start(); ?>1<?php $this->_smarty_vars['capture']['is_conf'] = ob_get_contents(); ob_end_clean(); ?>
			<?php echo smarty_function_math(array('equation' => "item_price * amount + conf_price",'item_price' => smarty_modifier_default(@$this->_tpl_vars['sub_oi']['price'], '0'),'amount' => smarty_modifier_default(@$this->_tpl_vars['sub_oi']['extra']['min_qty'], '1'),'conf_price' => $this->_tpl_vars['conf_price'],'assign' => 'conf_price'), $this);?>
	
			<?php echo smarty_function_math(array('equation' => "discount + conf_discount",'discount' => smarty_modifier_default(@$this->_tpl_vars['sub_oi']['extra']['discount'], '0'),'conf_discount' => $this->_tpl_vars['conf_discount'],'assign' => 'conf_discount'), $this);?>

			<?php echo smarty_function_math(array('equation' => "tax + conf_tax",'tax' => smarty_modifier_default(@$this->_tpl_vars['sub_oi']['tax_value'], '0'),'conf_tax' => $this->_tpl_vars['conf_tax'],'assign' => 'conf_tax'), $this);?>

			<?php echo smarty_function_math(array('equation' => "subtotal + conf_subtotal",'subtotal' => $this->_tpl_vars['sub_oi']['display_subtotal'],'conf_subtotal' => smarty_modifier_default(@$this->_tpl_vars['conf_subtotal'], @$this->_tpl_vars['oi']['display_subtotal']),'assign' => 'conf_subtotal'), $this);?>
	
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>

	<tr valign="top" class="no-border">
		<td>
			<a href="<?php echo fn_url("products.update?product_id=".($this->_tpl_vars['oi']['product_id'])); ?>
"><?php echo $this->_tpl_vars['oi']['product']; ?>
</a>
			<?php $this->_tag_stack[] = array('hook', array('name' => "orders:product_info")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			<?php if ($this->_tpl_vars['oi']['product_code']): ?></p><?php echo fn_get_lang_var('sku', $this->getLanguage()); ?>
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
		<td class="nowrap"><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => smarty_modifier_default(@$this->_tpl_vars['conf_price'], 0), )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false)); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true)); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
		<td class="center">&nbsp;<?php echo $this->_tpl_vars['oi']['amount']; ?>

			<?php if ($this->_tpl_vars['settings']['General']['use_shipments'] == 'Y' && $this->_tpl_vars['oi']['shipped_amount'] > 0): ?>
				<p><span class="small-note">(<strong><?php echo $this->_tpl_vars['oi']['shipped_amount']; ?>
</strong>&nbsp;<?php echo fn_get_lang_var('shipped', $this->getLanguage()); ?>
)</span></p>
			<?php endif; ?>
		</td>
		<?php if ($this->_tpl_vars['order_info']['use_discount']): ?>
		<?php $this->assign('_colspan', $this->_tpl_vars['_colspan']+1, false); ?>
		<td class="right nowrap">
			<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => smarty_modifier_default(@$this->_tpl_vars['conf_discount'], 0), )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false)); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true)); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['order_info']['taxes'] && $this->_tpl_vars['settings']['General']['tax_calculation'] != 'subtotal'): ?>
		<?php $this->assign('_colspan', $this->_tpl_vars['_colspan']+1, false); ?>
		<td class="nowrap">
			<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => smarty_modifier_default(@$this->_tpl_vars['conf_tax'], 0), )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false)); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true)); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
		<?php endif; ?>
		<td class="right">&nbsp;<strong><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => smarty_modifier_default(@$this->_tpl_vars['conf_subtotal'], 0), )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false)); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true)); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></strong></td>
	</tr>
	<?php if ($this->_smarty_vars['capture']['is_conf']): ?>
	<tr>
		<td colspan="<?php echo $this->_tpl_vars['_colspan']; ?>
">
			<p><?php echo fn_get_lang_var('bundled_products', $this->getLanguage()); ?>
:</p>
			<table cellpadding="0" cellspacing="0" border="0" class="table">
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
    foreach ($_from as $this->_tpl_vars['sub_key'] => $this->_tpl_vars['oi']):
?>
			<?php if ($this->_tpl_vars['oi']['extra']['parent']['bundled_products'] && $this->_tpl_vars['oi']['extra']['parent']['bundled_products'] == $this->_tpl_vars['c_oi']['cart_id']): ?>
			<tr <?php echo smarty_function_cycle(array('values' => ",class=\"table-row\"",'name' => "gc_".($this->_tpl_vars['gift_key'])), $this);?>
 valign="top">
				<td>
					<a href="<?php echo fn_url("products.update?product_id=".($this->_tpl_vars['oi']['product_id'])); ?>
"><?php echo smarty_modifier_truncate($this->_tpl_vars['oi']['product'], 50, "...", true); ?>
</a>&nbsp;
					<?php if ($this->_tpl_vars['oi']['product_code']): ?>
					<p><?php echo fn_get_lang_var('code', $this->getLanguage()); ?>
:&nbsp;<?php echo $this->_tpl_vars['oi']['product_code']; ?>
</p>
					<?php endif; ?>
					<?php $this->_tag_stack[] = array('hook', array('name' => "orders:product_info")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
					<?php if ($this->_tpl_vars['oi']['product_options']): ?><div style="padding-top: 1px; padding-bottom: 2px;">&nbsp;<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/options_info.tpl", 'smarty_include_vars' => array('product_options' => $this->_tpl_vars['oi']['product_options'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div><?php endif; ?>
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
				</td>
				<td class="center nowrap">
					<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['oi']['price'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false)); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true)); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
				<td class="center nowrap">
					<?php echo $this->_tpl_vars['oi']['amount']; ?>

					<?php if ($this->_tpl_vars['settings']['General']['use_shipments'] == 'Y' && $this->_tpl_vars['oi']['shipped_amount']): ?>
						<p><span class="small-note">(<strong><?php echo $this->_tpl_vars['oi']['shipped_amount']; ?>
</strong>&nbsp;<?php echo fn_get_lang_var('shipped', $this->getLanguage()); ?>
)</span></p>
					<?php endif; ?>
				</td>
				<?php if ($this->_tpl_vars['order_info']['use_discount']): ?>
				<td class="right nowrap">
					<?php if (floatval($this->_tpl_vars['oi']['extra']['discount'])): ?><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['oi']['extra']['discount'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false)); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true)); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php else: ?>-<?php endif; ?></td>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['order_info']['taxes'] && $this->_tpl_vars['settings']['General']['tax_calculation'] != 'subtotal'): ?>
				<td class="center nowrap">
					<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['oi']['tax_value'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false)); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true)); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
				<?php endif; ?>
				<td class="right nowrap">
					<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['oi']['display_subtotal'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false)); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true)); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
			</tr>
			<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
			</table>
		</td>
	</tr>
	<?php endif; ?>
<?php endif; ?>