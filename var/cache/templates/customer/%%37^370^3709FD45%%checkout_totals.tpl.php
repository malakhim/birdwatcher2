<?php /* Smarty version 2.6.18, created on 2013-08-29 15:32:07
         compiled from views/checkout/components/checkout_totals.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'views/checkout/components/checkout_totals.tpl', 1, false),array('modifier', 'fn_url', 'views/checkout/components/checkout_totals.tpl', 17, false),array('modifier', 'format_price', 'views/checkout/components/checkout_totals.tpl', 47, false),array('block', 'hook', 'views/checkout/components/checkout_totals.tpl', 33, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('change','calculate','calculate_shipping_cost','total_cost'));
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
			 ?><?php if ($this->_tpl_vars['location'] == 'cart' && $this->_tpl_vars['cart']['shipping_required'] == true && $this->_tpl_vars['settings']['General']['estimate_shipping_cost'] == 'Y'): ?>
<?php ob_start(); ?>
<a id="opener_shipping_estimation_block" class="cm-dialog-opener cm-dialog-auto-size shipping-edit-link" rev="shipping_estimation_block" href="<?php echo fn_url("checkout.cart"); ?>
"><span><?php if ($this->_tpl_vars['cart']['shipping']): ?><?php echo fn_get_lang_var('change', $this->getLanguage()); ?>
<?php else: ?><?php echo fn_get_lang_var('calculate', $this->getLanguage()); ?>
<?php endif; ?></span></a>
<?php $this->_smarty_vars['capture']['shipping_estimation'] = ob_get_contents(); ob_end_clean(); ?>
<div class="hidden" id="shipping_estimation_block" title="<?php echo fn_get_lang_var('calculate_shipping_cost', $this->getLanguage()); ?>
">
	<div class="shipping-estimation">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/checkout/components/shipping_estimation.tpl", 'smarty_include_vars' => array('location' => 'popup','result_ids' => 'shipping_estimation_link')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
</div>
<?php endif; ?>
<div class="statistic-list-wrap">
	<div class="checkout-totals clearfix" id="checkout_totals">
		<?php if ($this->_tpl_vars['cart_products']): ?>
			<div class="coupons-container">
				<?php if ($this->_tpl_vars['cart']['has_coupons']): ?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/checkout/components/promotion_coupon.tpl", 'smarty_include_vars' => array('location' => $this->_tpl_vars['location'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php endif; ?>
					
				<?php $this->_tag_stack[] = array('hook', array('name' => "checkout:payment_extra")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				<?php if ($this->_tpl_vars['addons']['reward_points']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/reward_points/hooks/checkout/payment_extra.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
				</div>
		<?php endif; ?>
		
		<?php $this->_tag_stack[] = array('hook', array('name' => "checkout:payment_options")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		<?php if ($this->_tpl_vars['addons']['reward_points']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/reward_points/hooks/checkout/payment_options.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/checkout/components/checkout_totals_info.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<div class="clear"></div>
		<ul class="statistic-list total">
				<li class="total">
				<span class="total-title"><?php echo fn_get_lang_var('total_cost', $this->getLanguage()); ?>
</span><span class="checkout-item-value"><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => smarty_modifier_default(smarty_modifier_default(@$this->_tpl_vars['_total'], @$this->_smarty_vars['capture']['_total']), @$this->_tpl_vars['cart']['total']), 'span_id' => 'cart_total', 'class' => 'price', )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></span>
				</li>
		</ul>
	<!--checkout_totals--></div>
</div>