<?php /* Smarty version 2.6.18, created on 2013-09-06 22:44:02
         compiled from views/checkout/components/shipping_rates.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'array_sum', 'views/checkout/components/shipping_rates.tpl', 1, false),array('modifier', 'fn_url', 'views/checkout/components/shipping_rates.tpl', 54, false),array('modifier', 'unescape', 'views/checkout/components/shipping_rates.tpl', 73, false),array('modifier', 'fn_get_product_name', 'views/checkout/components/shipping_rates.tpl', 73, false),array('modifier', 'format_price', 'views/checkout/components/shipping_rates.tpl', 85, false),array('modifier', 'replace', 'views/checkout/components/shipping_rates.tpl', 146, false),array('modifier', 'is_array', 'views/checkout/components/shipping_rates.tpl', 178, false),array('modifier', 'implode', 'views/checkout/components/shipping_rates.tpl', 179, false),array('block', 'hook', 'views/checkout/components/shipping_rates.tpl', 59, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('vendor','supplier','select_shipping_method','inc_tax','free_shipping','inc_tax','free_shipping','inc_tax','free_shipping','free_shipping','no_shipping_required','remove_undeliverable_products','text_no_shipping_methods','total','no_shipping_required','free_shipping','inc_tax','free_shipping','no_shipping_required','free_shipping','shipping_method','free_shipping','free_shipping','select','delete'));
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
			 ?><?php echo '
<script type="text/javascript">
//<![CDATA[
function fn_calculate_total_shipping_cost() {
	params = [];
	parents = $(\'#shipping_rates_list\');
	radio = $(\':radio:checked\', parents);

	$.each(radio, function(id, elm) {
		params.push({name: elm.name, value: elm.value});
	});

	url = fn_url(\'checkout.calculate_total_shipping_cost\');

	for (i in params) {
		url += \'&\' + params[i][\'name\'] + \'=\' + escape(params[i][\'value\']);
	}

	$.ajaxRequest(url, {
		result_ids: \'shipping_rates_list\',
		method: \'post\'
	});
}
//]]>
</script>
'; ?>



	<?php if (@PRODUCT_TYPE == 'MULTIVENDOR'): ?>
		<?php $this->assign('lang_vendor_supplier', fn_get_lang_var('vendor', $this->getLanguage()), false); ?>
	<?php else: ?>
		<?php $this->assign('lang_vendor_supplier', fn_get_lang_var('supplier', $this->getLanguage()), false); ?>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['show_header'] == true): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('select_shipping_method', $this->getLanguage()))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>

	<?php if (! $this->_tpl_vars['no_form']): ?>
	<form <?php if ($this->_tpl_vars['use_ajax']): ?>class="cm-ajax"<?php endif; ?> action="<?php echo fn_url(""); ?>
" method="post" name="shippings_form">
	<input type="hidden" name="redirect_mode" value="checkout" />
	<?php if ($this->_tpl_vars['use_ajax']): ?><input type="hidden" name="result_ids" value="checkout_totals,checkout_steps" /><?php endif; ?>
	<?php endif; ?>

	<?php $this->_tag_stack[] = array('hook', array('name' => "checkout:shipping_rates")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>

	<?php if (@PRODUCT_TYPE == 'MULTIVENDOR' || ( $this->_tpl_vars['settings']['Suppliers']['enable_suppliers'] == 'Y' && $this->_tpl_vars['settings']['Suppliers']['display_shipping_methods_separately'] == 'Y' )): ?>
	
		<?php if ($this->_tpl_vars['display'] == 'show'): ?>
		<div class="step-complete-wrapper">
		<?php endif; ?>

		<div id="shipping_rates_list">

		<?php $_from = $this->_tpl_vars['suppliers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['s'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['s']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['supplier_id'] => $this->_tpl_vars['supplier']):
        $this->_foreach['s']['iteration']++;
?>
		<span class="vendor-name"><?php echo $this->_tpl_vars['lang_vendor_supplier']; ?>
:&nbsp;<?php echo $this->_tpl_vars['supplier']['company']; ?>
</span>
		<ul class="bullets-list">
		<?php $_from = $this->_tpl_vars['supplier']['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cart_id']):
?>
			<?php if ($this->_tpl_vars['supplier_id'] != 0 || ( $this->_tpl_vars['supplier_id'] == 0 && ( $this->_tpl_vars['supplier']['all_edp_no_shipping'] == true || ! ( $this->_tpl_vars['cart_products'][$this->_tpl_vars['cart_id']]['is_edp'] == 'Y' && $this->_tpl_vars['cart_products'][$this->_tpl_vars['cart_id']]['edp_shipping'] == 'N' ) ) )): ?><li><?php if ($this->_tpl_vars['cart_products'][$this->_tpl_vars['cart_id']]): ?><?php echo smarty_modifier_unescape($this->_tpl_vars['cart_products'][$this->_tpl_vars['cart_id']]['product']); ?>
<?php else: ?><?php echo fn_get_product_name($this->_tpl_vars['cart']['products'][$this->_tpl_vars['cart_id']]['product_id'], @CART_LANGUAGE); ?>
<?php endif; ?></li><?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
		</ul>
		<?php if (! $this->_tpl_vars['supplier']['shipping_failed']): ?>
			<?php if ($this->_tpl_vars['supplier']['rates'] && ! $this->_tpl_vars['supplier']['all_edp_no_shipping']): ?>

				<?php if ($this->_tpl_vars['display'] == 'radio'): ?>

				<?php $_from = $this->_tpl_vars['supplier']['rates']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['shipping_id'] => $this->_tpl_vars['rate']):
?>
				<p>
					<input type="radio" class="valign" id="sh_<?php echo $this->_tpl_vars['supplier_id']; ?>
_<?php echo $this->_tpl_vars['shipping_id']; ?>
" name="shipping_ids[<?php echo $this->_tpl_vars['supplier_id']; ?>
]" value="<?php echo $this->_tpl_vars['shipping_id']; ?>
" onclick="fn_calculate_total_shipping_cost();" <?php if (isset ( $this->_tpl_vars['cart']['shipping'][$this->_tpl_vars['shipping_id']]['rates'][$this->_tpl_vars['supplier_id']] )): ?>checked="checked"<?php endif; ?> /><label for="sh_<?php echo $this->_tpl_vars['supplier_id']; ?>
_<?php echo $this->_tpl_vars['shipping_id']; ?>
" class="valign"><?php echo $this->_tpl_vars['rate']['name']; ?>
 <?php if ($this->_tpl_vars['rate']['delivery_time']): ?>(<?php echo $this->_tpl_vars['rate']['delivery_time']; ?>
)<?php endif; ?> - <?php if ($this->_tpl_vars['rate']['rate']): ?><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['rate']['rate'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php if ($this->_tpl_vars['rate']['inc_tax']): ?> (<?php if ($this->_tpl_vars['rate']['taxed_price'] && $this->_tpl_vars['rate']['taxed_price'] != $this->_tpl_vars['rate']['rate']): ?><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['rate']['taxed_price'], 'class' => 'nowrap', )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?> <?php endif; ?><?php echo fn_get_lang_var('inc_tax', $this->getLanguage()); ?>
)<?php endif; ?><?php else: ?><?php echo fn_get_lang_var('free_shipping', $this->getLanguage()); ?>
<?php endif; ?></label>
				</p>
				<?php endforeach; endif; unset($_from); ?>

				<?php elseif ($this->_tpl_vars['display'] == 'select'): ?>

				<p>
				<select id="ssr_<?php echo $this->_tpl_vars['supplier_id']; ?>
" name="shipping_ids[<?php echo $this->_tpl_vars['supplier_id']; ?>
]" <?php if ($this->_tpl_vars['onchange']): ?>onchange="<?php echo $this->_tpl_vars['onchange']; ?>
"<?php endif; ?>>
				<?php $_from = $this->_tpl_vars['supplier']['rates']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['shipping_id'] => $this->_tpl_vars['rate']):
?>
				<option value="<?php echo $this->_tpl_vars['shipping_id']; ?>
" <?php if (isset ( $this->_tpl_vars['cart']['shipping'][$this->_tpl_vars['shipping_id']]['rates'][$this->_tpl_vars['supplier_id']] )): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['rate']['name']; ?>
 <?php if ($this->_tpl_vars['rate']['delivery_time']): ?>(<?php echo $this->_tpl_vars['rate']['delivery_time']; ?>
)<?php endif; ?> - <?php if ($this->_tpl_vars['rate']['rate']): ?><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['rate']['rate'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php if ($this->_tpl_vars['rate']['inc_tax']): ?> (<?php if ($this->_tpl_vars['rate']['taxed_price'] && $this->_tpl_vars['rate']['taxed_price'] != $this->_tpl_vars['rate']['rate']): ?><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['rate']['taxed_price'], 'class' => 'nowrap', )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?> <?php endif; ?><?php echo fn_get_lang_var('inc_tax', $this->getLanguage()); ?>
)<?php endif; ?><?php else: ?><?php echo fn_get_lang_var('free_shipping', $this->getLanguage()); ?>
<?php endif; ?></option>
				<?php endforeach; endif; unset($_from); ?>
				</select>
				</p>

				<?php elseif ($this->_tpl_vars['display'] == 'show'): ?>

				<?php $_from = $this->_tpl_vars['supplier']['rates']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['shipping_id'] => $this->_tpl_vars['rate']):
?>
				<?php if (isset ( $this->_tpl_vars['cart']['shipping'][$this->_tpl_vars['shipping_id']]['rates'][$this->_tpl_vars['supplier_id']] )): ?><p><strong><?php echo $this->_tpl_vars['rate']['name']; ?>
 <?php if ($this->_tpl_vars['rate']['delivery_time']): ?>(<?php echo $this->_tpl_vars['rate']['delivery_time']; ?>
)<?php endif; ?> - <?php if ($this->_tpl_vars['rate']['rate']): ?><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['rate']['rate'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php if ($this->_tpl_vars['rate']['inc_tax']): ?> (<?php if ($this->_tpl_vars['rate']['taxed_price'] && $this->_tpl_vars['rate']['taxed_price'] != $this->_tpl_vars['rate']['rate']): ?><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['rate']['taxed_price'], 'class' => 'nowrap', )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?> <?php endif; ?><?php echo fn_get_lang_var('inc_tax', $this->getLanguage()); ?>
)<?php endif; ?><?php else: ?><?php echo fn_get_lang_var('free_shipping', $this->getLanguage()); ?>
<?php endif; ?></strong></p><?php endif; ?>
				<?php endforeach; endif; unset($_from); ?>

				<?php endif; ?>
			<?php else: ?>
				<p><?php if ($this->_tpl_vars['display'] == 'show'): ?><strong><?php endif; ?><?php if ($this->_tpl_vars['supplier']['all_edp_free_shipping'] || $this->_tpl_vars['supplier']['all_free_shipping']): ?><?php echo fn_get_lang_var('free_shipping', $this->getLanguage()); ?>
<?php else: ?><p><?php echo fn_get_lang_var('no_shipping_required', $this->getLanguage()); ?>
</p><?php endif; ?><?php if ($this->_tpl_vars['display'] == 'show'): ?></strong><?php endif; ?></p>
			<?php endif; ?>
		<?php else: ?>
			<?php if (@PRODUCT_TYPE == 'MULTIVENDOR' || @PRODUCT_TYPE == 'PROFESSIONAL'): ?>
				<?php $this->assign('purge_undeliverable_url', fn_url("checkout.purge_undeliverable"), false); ?>
				<p class="error-text"><?php if ($this->_tpl_vars['display'] == 'show'): ?><strong><?php endif; ?><?php echo smarty_modifier_replace(fn_get_lang_var('remove_undeliverable_products', $this->getLanguage()), '<a>', "<a href=".($this->_tpl_vars['purge_undeliverable_url']).">"); ?>
<?php if ($this->_tpl_vars['display'] == 'show'): ?></strong><?php endif; ?></p>
			<?php else: ?>
				<p class="error-text"><?php if ($this->_tpl_vars['display'] == 'show'): ?><strong><?php endif; ?><?php echo fn_get_lang_var('text_no_shipping_methods', $this->getLanguage()); ?>
<?php if ($this->_tpl_vars['display'] == 'show'): ?></strong><?php endif; ?></p> 
			<?php endif; ?>
		<?php endif; ?>
		<?php if (($this->_foreach['s']['iteration'] == $this->_foreach['s']['total'])): ?><p class="shipping-options-total"><?php echo fn_get_lang_var('total', $this->getLanguage()); ?>
:&nbsp;<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['cart']['shipping_cost'], 'class' => 'price', )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></p><?php endif; ?>
		<?php endforeach; else: ?>
		<p>
			<?php $_from = $this->_tpl_vars['cart_products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['product']):
?>
			<?php if ($this->_tpl_vars['product']['is_edp'] == 'Y'): ?>
				<?php $this->assign('has_edp', 'true', false); ?>
			<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
			<?php if ($this->_tpl_vars['has_edp']): ?><?php echo fn_get_lang_var('no_shipping_required', $this->getLanguage()); ?>
<?php else: ?><?php echo fn_get_lang_var('free_shipping', $this->getLanguage()); ?>
<?php endif; ?>
		</p>
		<?php endif; unset($_from); ?>

		<!--shipping_rates_list--></div>

		<?php if ($this->_tpl_vars['display'] == 'show'): ?>
		</div>
		<?php endif; ?>

	<?php else: ?>
	
		<?php if (is_array($this->_tpl_vars['supplier_ids'])): ?>
			<?php $this->assign('_suppliers_ids', implode(",", $this->_tpl_vars['supplier_ids']), false); ?>
		<?php elseif ($this->_tpl_vars['supplier_ids']): ?>
			<?php $this->assign('_suppliers_ids', $this->_tpl_vars['supplier_ids'], false); ?>
		<?php else: ?>
			<?php $this->assign('_suppliers_ids', "", false); ?>
		<?php endif; ?>

		<div class="<?php if ($this->_tpl_vars['display'] == 'select'): ?>overflow-hidden form-field shipping-rates<?php elseif ($this->_tpl_vars['display'] == 'radio'): ?> shipping-rates-radio<?php endif; ?>" id="shipping_rates_list" class="shipping-options">
		<?php if ($this->_tpl_vars['display'] == 'radio'): ?>

			<?php $_from = $this->_tpl_vars['shipping_rates']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['shipping_id'] => $this->_tpl_vars['s_rate']):
?>
			<p>
				<input type="radio" class="valign" name="shipping_ids[<?php echo $this->_tpl_vars['_suppliers_ids']; ?>
]" value="<?php echo $this->_tpl_vars['shipping_id']; ?>
" id="sh_<?php echo $this->_tpl_vars['shipping_id']; ?>
" <?php if ($this->_tpl_vars['cart']['shipping'][$this->_tpl_vars['shipping_id']]): ?>checked="checked"<?php endif; ?> />&nbsp;<label for="sh_<?php echo $this->_tpl_vars['shipping_id']; ?>
" class="valign"><?php echo $this->_tpl_vars['s_rate']['name']; ?>
 <?php if ($this->_tpl_vars['s_rate']['delivery_time']): ?>(<?php echo $this->_tpl_vars['s_rate']['delivery_time']; ?>
)<?php endif; ?>  - <?php if (array_sum($this->_tpl_vars['s_rate']['rates'])): ?><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => array_sum($this->_tpl_vars['s_rate']['rates']), )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php if ($this->_tpl_vars['s_rate']['inc_tax']): ?> (<?php if ($this->_tpl_vars['s_rate']['taxed_price'] && $this->_tpl_vars['s_rate']['taxed_price'] != array_sum($this->_tpl_vars['s_rate']['rates'])): ?><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['s_rate']['taxed_price'], 'class' => 'nowrap', )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?> <?php endif; ?><?php echo fn_get_lang_var('inc_tax', $this->getLanguage()); ?>
)<?php endif; ?><?php else: ?><?php echo fn_get_lang_var('free_shipping', $this->getLanguage()); ?>
<?php endif; ?></label>
			</p>
			<?php endforeach; else: ?>
				<p>
					<?php $_from = $this->_tpl_vars['cart_products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['product']):
?>
						<?php if ($this->_tpl_vars['product']['is_edp'] == 'Y'): ?>
							<?php $this->assign('has_edp', 'true', false); ?>
						<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?>
					<?php if ($this->_tpl_vars['has_edp']): ?><?php echo fn_get_lang_var('no_shipping_required', $this->getLanguage()); ?>
<?php else: ?><?php echo fn_get_lang_var('free_shipping', $this->getLanguage()); ?>
<?php endif; ?>
				</p>
			<?php endif; unset($_from); ?>
			
		<?php elseif ($this->_tpl_vars['display'] == 'select'): ?>

			<label for="ssr"><?php echo fn_get_lang_var('shipping_method', $this->getLanguage()); ?>
:</label>
	
			<select id="ssr" name="shipping_ids[<?php echo $this->_tpl_vars['_suppliers_ids']; ?>
]">
			<?php $_from = $this->_tpl_vars['shipping_rates']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['shipping_id'] => $this->_tpl_vars['s_rate']):
?>
				<option value="<?php echo $this->_tpl_vars['shipping_id']; ?>
" <?php if ($this->_tpl_vars['cart']['shipping'][$this->_tpl_vars['shipping_id']]): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['s_rate']['name']; ?>
 <?php if ($this->_tpl_vars['s_rate']['delivery_time']): ?>(<?php echo $this->_tpl_vars['s_rate']['delivery_time']; ?>
)<?php endif; ?>  - <?php if (array_sum($this->_tpl_vars['s_rate']['rates'])): ?><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => array_sum($this->_tpl_vars['s_rate']['rates']), )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php else: ?><?php echo fn_get_lang_var('free_shipping', $this->getLanguage()); ?>
<?php endif; ?></option>
			<?php endforeach; endif; unset($_from); ?>
			</select>

		<?php elseif ($this->_tpl_vars['display'] == 'show'): ?>

			<?php $_from = $this->_tpl_vars['shipping_rates']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['shipping_id'] => $this->_tpl_vars['s_rate']):
?>
				<?php if ($this->_tpl_vars['cart']['shipping'][$this->_tpl_vars['shipping_id']]): ?>
					<?php ob_start(); ?>
						<?php echo $this->_tpl_vars['s_rate']['name']; ?>
 <?php if ($this->_tpl_vars['s_rate']['delivery_time']): ?>(<?php echo $this->_tpl_vars['s_rate']['delivery_time']; ?>
)<?php endif; ?>  - <?php if (array_sum($this->_tpl_vars['s_rate']['rates'])): ?><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => array_sum($this->_tpl_vars['s_rate']['rates']), )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php else: ?><?php echo fn_get_lang_var('free_shipping', $this->getLanguage()); ?>
<?php endif; ?>
					<?php $this->_smarty_vars['capture']['selected_shipping'] = ob_get_contents(); ob_end_clean(); ?>
				<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
			<?php echo $this->_smarty_vars['capture']['selected_shipping']; ?>

		<?php endif; ?>

		<!--shipping_rates_list--></div>

	
	<?php endif; ?>
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

	<?php if (! $this->_tpl_vars['no_form']): ?>
	<div class="cm-noscript buttons-container center"><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('but_name' => "dispatch[checkout.update_shipping]", 'but_text' => fn_get_lang_var('select', $this->getLanguage()), )); ?>

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
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></div>

	</form>
	<?php endif; ?>
