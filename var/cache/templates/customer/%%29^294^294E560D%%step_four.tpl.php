<?php /* Smarty version 2.6.18, created on 2013-09-03 09:47:35
         compiled from views/checkout/components/steps/step_four.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'views/checkout/components/steps/step_four.tpl', 1, false),array('modifier', 'fn_url', 'views/checkout/components/steps/step_four.tpl', 23, false),array('modifier', 'fn_allow_place_order', 'views/checkout/components/steps/step_four.tpl', 31, false),array('modifier', 'format_price', 'views/checkout/components/steps/step_four.tpl', 58, false),array('function', 'script', 'views/checkout/components/steps/step_four.tpl', 15, false),array('block', 'hook', 'views/checkout/components/steps/step_four.tpl', 22, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('billing_options','text_no_payments_needed','submit_my_order','text_no_shipping_methods','text_min_order_amount_required'));
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
			 ?><?php echo smarty_function_script(array('src' => "js/tabs.js"), $this);?>


<div class="step-container<?php if ($this->_tpl_vars['edit']): ?>-active<?php endif; ?>" id="step_four">
	<?php if ($this->_tpl_vars['settings']['General']['checkout_style'] != 'multi_page'): ?>
		<h2 class="step-title<?php if ($this->_tpl_vars['edit']): ?>-active<?php endif; ?> clearfix">
			<span class="float-left"><?php if ($this->_tpl_vars['profile_fields']['B'] || $this->_tpl_vars['profile_fields']['S']): ?>4<?php else: ?>3<?php endif; ?></span>
			
			<?php $this->_tag_stack[] = array('hook', array('name' => "checkout:edit_link_title")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			<a class="title<?php if ($this->_tpl_vars['complete'] && ! $this->_tpl_vars['edit']): ?> cm-ajax cm-ajax-force<?php endif; ?>" <?php if ($this->_tpl_vars['complete'] && ! $this->_tpl_vars['edit']): ?>href="<?php echo fn_url("checkout.checkout?edit_step=step_four&amp;from_step=".($this->_tpl_vars['edit_step'])); ?>
" rev="checkout_*"<?php endif; ?>><?php echo fn_get_lang_var('billing_options', $this->getLanguage()); ?>
</a>
			<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		</h2>
	<?php endif; ?>

	<div id="step_four_body" class="step-body<?php if ($this->_tpl_vars['edit']): ?>-active<?php endif; ?> <?php if (! $this->_tpl_vars['edit']): ?>hidden<?php endif; ?>">
		<div class="clearfix">
			
			<?php if (fn_allow_place_order($this->_tpl_vars['cart'])): ?>
				<?php if ($this->_tpl_vars['edit']): ?>
					<div class="clearfix">

						<?php if ($this->_tpl_vars['cart']['payment_id']): ?>
							<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/checkout/components/payments/payment_methods.tpl", 'smarty_include_vars' => array('no_mainbox' => 'Y')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php else: ?>
							<div class="checkout-inside-block"><h2 class="subheader"><?php echo fn_get_lang_var('text_no_payments_needed', $this->getLanguage()); ?>
</h2></div>

							<form name="paymens_form" action="<?php echo fn_url(""); ?>
" method="post">
								<div class="checkout-buttons">
									<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/place_order_new.tpl", 'smarty_include_vars' => array('but_text' => fn_get_lang_var('submit_my_order', $this->getLanguage()),'but_name' => "dispatch[checkout.place_order]",'but_role' => 'big','but_id' => 'place_order')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>	
								</div>
							</form>
						<?php endif; ?>
					</div>
				<?php endif; ?>

			<?php else: ?>
				<?php if ($this->_tpl_vars['cart']['shipping_failed']): ?>
					<p class="error-text center"><?php echo fn_get_lang_var('text_no_shipping_methods', $this->getLanguage()); ?>
</p>
				<?php endif; ?>

				<?php if ($this->_tpl_vars['cart']['amount_failed']): ?>
					<div class="checkout-inside-block">
						<p class="error-text"><?php echo fn_get_lang_var('text_min_order_amount_required', $this->getLanguage()); ?>
&nbsp;<strong><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['settings']['General']['min_order_amount'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></strong></p>
					</div>
				<?php endif; ?>

				<div class="checkout-buttons">
					<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/continue_shopping.tpl", 'smarty_include_vars' => array('but_href' => smarty_modifier_default(@$this->_tpl_vars['continue_url'], @$this->_tpl_vars['index_script']),'but_role' => 'action')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				</div>
				
			<?php endif; ?>
		</div>
	</div>
<!--step_four--></div>