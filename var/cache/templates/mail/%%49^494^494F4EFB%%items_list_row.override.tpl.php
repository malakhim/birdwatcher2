<?php /* Smarty version 2.6.18, created on 2014-03-10 11:21:24
         compiled from addons/bundled_products/hooks/orders/items_list_row.override.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'addons/bundled_products/hooks/orders/items_list_row.override.tpl', 3, false),array('modifier', 'floatval', 'addons/bundled_products/hooks/orders/items_list_row.override.tpl', 27, false),array('function', 'math', 'addons/bundled_products/hooks/orders/items_list_row.override.tpl', 12, false),array('block', 'hook', 'addons/bundled_products/hooks/orders/items_list_row.override.tpl', 20, false),)), $this); ?>
<?php if ($this->_tpl_vars['oi']['extra']['bundled_products']): ?>
	<?php $this->assign('conf_oi', $this->_tpl_vars['oi'], false); ?>
	<?php $this->assign('conf_price', smarty_modifier_default(@$this->_tpl_vars['oi']['price'], '0'), false); ?>
	<?php $this->assign('conf_subtotal', smarty_modifier_default(@$this->_tpl_vars['oi']['display_subtotal'], '0'), false); ?>
	<?php $this->assign('conf_discount', smarty_modifier_default(@$this->_tpl_vars['oi']['extra']['discount'], '0'), false); ?>
	<?php $this->assign('conf_tax', smarty_modifier_default(@$this->_tpl_vars['oi']['tax_value'], '0'), false); ?>
	
	
	<?php $_from = $this->_tpl_vars['order_info']['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sub_oi']):
?>
		<?php if ($this->_tpl_vars['sub_oi']['extra']['parent']['bundled_products'] && $this->_tpl_vars['sub_oi']['extra']['parent']['bundled_products'] == $this->_tpl_vars['oi']['cart_id']): ?>
			<?php ob_start(); ?>1<?php $this->_smarty_vars['capture']['is_conf'] = ob_get_contents(); ob_end_clean(); ?>
			<?php echo smarty_function_math(array('equation' => "item_price * amount + conf_price",'item_price' => smarty_modifier_default(@$this->_tpl_vars['sub_oi']['price'], '0'),'amount' => smarty_modifier_default(@$this->_tpl_vars['sub_oi']['extra']['min_qty'], '1'),'conf_price' => smarty_modifier_default(@$this->_tpl_vars['conf_price'], @$this->_tpl_vars['oi']['price']),'assign' => 'conf_price'), $this);?>
	
			<?php echo smarty_function_math(array('equation' => "discount + conf_discount",'discount' => smarty_modifier_default(@$this->_tpl_vars['sub_oi']['extra']['discount'], '0'),'conf_discount' => smarty_modifier_default(@$this->_tpl_vars['conf_discount'], '0'),'assign' => 'conf_discount'), $this);?>

			<?php echo smarty_function_math(array('equation' => "tax + conf_tax",'tax' => smarty_modifier_default(@$this->_tpl_vars['sub_oi']['tax_value'], '0'),'conf_tax' => smarty_modifier_default(@$this->_tpl_vars['conf_tax'], '0'),'assign' => 'conf_tax'), $this);?>

			<?php echo smarty_function_math(array('equation' => "subtotal + conf_subtotal",'subtotal' => smarty_modifier_default(@$this->_tpl_vars['sub_oi']['display_subtotal'], '0'),'conf_subtotal' => smarty_modifier_default(@$this->_tpl_vars['conf_subtotal'], @$this->_tpl_vars['oi']['display_subtotal']),'assign' => 'conf_subtotal'), $this);?>

		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	<tr>
		<td style="padding: 5px 10px; background-color: #ffffff;"><?php echo $this->_tpl_vars['oi']['product']; ?>

			<?php $this->_tag_stack[] = array('hook', array('name' => "orders:product_info")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if ($this->_tpl_vars['addons']['recurring_billing']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/recurring_billing/hooks/orders/product_info.pre.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?>
			<?php if ($this->_tpl_vars['oi']['product_code']): ?><p><?php echo fn_get_lang_var('code', $this->getLanguage()); ?>
:&nbsp;<?php echo $this->_tpl_vars['oi']['product_code']; ?>
</p><?php endif; ?>
			<?php if ($this->_tpl_vars['addons']['gift_certificates']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/gift_certificates/hooks/orders/product_info.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['reward_points']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/reward_points/hooks/orders/product_info.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			<?php if ($this->_tpl_vars['oi']['product_options']): ?><div style="padding-top: 1px; padding-bottom: 2px;"><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/options_info.tpl", 'smarty_include_vars' => array('product_options' => $this->_tpl_vars['oi']['product_options'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div><?php endif; ?></td>
		<td style="padding: 5px 10px; background-color: #ffffff; text-align: center;"><?php echo $this->_tpl_vars['oi']['amount']; ?>
</td>
		<td style="padding: 5px 10px; background-color: #ffffff; text-align: right;"><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/price.tpl", 'smarty_include_vars' => array('value' => smarty_modifier_default(@$this->_tpl_vars['conf_price'], 0))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
		<?php if ($this->_tpl_vars['order_info']['use_discount']): ?>
		<td style="padding: 5px 10px; background-color: #ffffff; text-align: right;"><?php if (floatval($this->_tpl_vars['conf_discount'])): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/price.tpl", 'smarty_include_vars' => array('value' => $this->_tpl_vars['conf_discount'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php else: ?>&nbsp;-&nbsp;<?php endif; ?></td>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['order_info']['taxes'] && $this->_tpl_vars['settings']['General']['tax_calculation'] != 'subtotal'): ?>
		<td style="padding: 5px 10px; background-color: #ffffff; text-align: right;"><?php if ($this->_tpl_vars['conf_tax']): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/price.tpl", 'smarty_include_vars' => array('value' => $this->_tpl_vars['conf_tax'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php else: ?>&nbsp;-&nbsp;<?php endif; ?></td>
		<?php endif; ?>

		<td style="padding: 5px 10px; background-color: #ffffff; text-align: right;"><b><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/price.tpl", 'smarty_include_vars' => array('value' => $this->_tpl_vars['conf_subtotal'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></b>&nbsp;</td>
	</tr>
	<?php if ($this->_smarty_vars['capture']['is_conf']): ?>
	<tr>
		<?php $this->assign('_colspan', '4', false); ?>
		<?php if ($this->_tpl_vars['order_info']['use_discount']): ?><?php $this->assign('_colspan', $this->_tpl_vars['_colspan']+1, false); ?><?php endif; ?>
		<?php if ($this->_tpl_vars['order_info']['taxes']): ?><?php $this->assign('_colspan', $this->_tpl_vars['_colspan']+1, false); ?><?php endif; ?>
		<td style="padding: 5px 10px; background-color: #ffffff;" colspan="<?php echo $this->_tpl_vars['_colspan']; ?>
">
			<p><?php echo fn_get_lang_var('bundled_products', $this->getLanguage()); ?>
:</p>


		<table width="100%" cellpadding="0" cellspacing="1" style="background-color: #dddddd;">
		<tr>
			<th width="70%" style="background-color: #eeeeee; padding: 6px 10px; white-space: nowrap;"><?php echo fn_get_lang_var('product', $this->getLanguage()); ?>
</th>
			<th style="background-color: #eeeeee; padding: 6px 10px; white-space: nowrap;"><?php echo fn_get_lang_var('amount', $this->getLanguage()); ?>
</th>
			<th style="background-color: #eeeeee; padding: 6px 10px; white-space: nowrap;"><?php echo fn_get_lang_var('unit_price', $this->getLanguage()); ?>
</th>
			<?php if ($this->_tpl_vars['order_info']['use_discount']): ?>
			<th style="background-color: #eeeeee; padding: 6px 10px; white-space: nowrap;"><?php echo fn_get_lang_var('discount', $this->getLanguage()); ?>
</th>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['order_info']['taxes'] && $this->_tpl_vars['settings']['General']['tax_calculation'] != 'subtotal'): ?>
			<th style="background-color: #eeeeee; padding: 6px 10px; white-space: nowrap;"><?php echo fn_get_lang_var('tax', $this->getLanguage()); ?>
</th>
			<?php endif; ?>
			<th style="background-color: #eeeeee; padding: 6px 10px; white-space: nowrap;"><?php echo fn_get_lang_var('subtotal', $this->getLanguage()); ?>
</th>
		</tr>
		<?php $_from = $this->_tpl_vars['order_info']['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sub_key'] => $this->_tpl_vars['oi']):
?>
		<?php if ($this->_tpl_vars['oi']['extra']['parent']['bundled_products'] && $this->_tpl_vars['oi']['extra']['parent']['bundled_products'] == $this->_tpl_vars['conf_oi']['cart_id']): ?>
		<tr>
			<td style="padding: 5px 10px; background-color: #ffffff;"><?php echo smarty_modifier_default(@$this->_tpl_vars['oi']['product'], fn_get_lang_var('deleted_product', $this->getLanguage())); ?>

				<?php $this->_tag_stack[] = array('hook', array('name' => "orders:product_info")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if ($this->_tpl_vars['addons']['recurring_billing']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/recurring_billing/hooks/orders/product_info.pre.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?>
				<?php if ($this->_tpl_vars['oi']['product_code']): ?><p><?php echo fn_get_lang_var('code', $this->getLanguage()); ?>
:&nbsp;<?php echo $this->_tpl_vars['oi']['product_code']; ?>
</p><?php endif; ?>
				<?php if ($this->_tpl_vars['addons']['gift_certificates']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/gift_certificates/hooks/orders/product_info.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['reward_points']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/reward_points/hooks/orders/product_info.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
				<?php if ($this->_tpl_vars['oi']['product_options']): ?><div style="padding-top: 1px; padding-bottom: 2px;"><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/options_info.tpl", 'smarty_include_vars' => array('product_options' => $this->_tpl_vars['oi']['product_options'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div><?php endif; ?>
			</td>
			<td style="padding: 5px 10px; background-color: #ffffff; text-align: center;"><?php echo $this->_tpl_vars['oi']['amount']; ?>
</td>
			<td style="padding: 5px 10px; background-color: #ffffff; text-align: right;"><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/price.tpl", 'smarty_include_vars' => array('value' => $this->_tpl_vars['oi']['price'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
			<?php if ($this->_tpl_vars['order_info']['use_discount']): ?>
			<td style="padding: 5px 10px; background-color: #ffffff; text-align: right;"><?php if (floatval($this->_tpl_vars['oi']['extra']['discount'])): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/price.tpl", 'smarty_include_vars' => array('value' => $this->_tpl_vars['oi']['extra']['discount'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php else: ?>&nbsp;-&nbsp;<?php endif; ?></td>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['order_info']['taxes'] && $this->_tpl_vars['settings']['General']['tax_calculation'] != 'subtotal'): ?>
			<td style="padding: 5px 10px; background-color: #ffffff; text-align: right;"><?php if ($this->_tpl_vars['oi']['tax_value']): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/price.tpl", 'smarty_include_vars' => array('value' => $this->_tpl_vars['oi']['tax_value'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php else: ?>&nbsp;-&nbsp;<?php endif; ?></td>
			<?php endif; ?>
			<td style="padding: 5px 10px; background-color: #ffffff; text-align: right;"><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/price.tpl", 'smarty_include_vars' => array('value' => $this->_tpl_vars['oi']['display_subtotal'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>&nbsp;</td>
		</tr>
		<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
		</table>
	</tr>
	<?php endif; ?>
<?php endif; ?>