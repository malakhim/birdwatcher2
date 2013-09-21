<?php /* Smarty version 2.6.18, created on 2013-09-21 20:02:00
         compiled from views/checkout/components/payments/payment_methods.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'script', 'views/checkout/components/payments/payment_methods.tpl', 1, false),array('modifier', 'count', 'views/checkout/components/payments/payment_methods.tpl', 7, false),array('modifier', 'fn_url', 'views/checkout/components/payments/payment_methods.tpl', 13, false),array('modifier', 'reset', 'views/checkout/components/payments/payment_methods.tpl', 33, false),array('modifier', 'fn_get_payment_method_data', 'views/checkout/components/payments/payment_methods.tpl', 36, false),array('modifier', 'trim', 'views/checkout/components/payments/payment_methods.tpl', 44, false),array('block', 'hook', 'views/checkout/components/payments/payment_methods.tpl', 96, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('skip_payment','checkout_terms_n_conditions_alert','submit_my_order'));
?>
<?php echo smarty_function_script(array('src' => "js/tabs.js"), $this);?>


<?php if ($this->_tpl_vars['settings']['General']['checkout_style'] == 'multi_page'): ?>
	<?php $this->assign('extra_ids', ",step_four", false); ?>
<?php endif; ?>

<?php if (count($this->_tpl_vars['payment_methods']) > 1): ?>
<div class="tabs cm-j-tabs cm-track clearfix">
	<ul id="payment_tabs">
		<?php $_from = $this->_tpl_vars['payment_methods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tab_id'] => $this->_tpl_vars['payments']):
?>
			<?php $this->assign('tab_name', "payments_".($this->_tpl_vars['tab_id']), false); ?>
			<li id="payments_<?php echo $this->_tpl_vars['tab_id']; ?>
" class="cm-ajax cm-ajax-force <?php if ($this->_tpl_vars['tab_id'] == $this->_tpl_vars['active_tab'] || ( ! $this->_tpl_vars['active_tab'] && $this->_tpl_vars['payments'][$this->_tpl_vars['cart']['payment_id']] )): ?>cm-active<?php $this->assign('active', $this->_tpl_vars['tab_id'], false); ?><?php endif; ?>">
				<a class="cm-ajax cm-ajax-force cm-ajax-full-render" rev="checkout*<?php echo $this->_tpl_vars['extra_ids']; ?>
" href="<?php echo fn_url("checkout.checkout.payments?active_tab=".($this->_tpl_vars['tab_id'])); ?>
"><?php echo fn_get_lang_var($this->_tpl_vars['tab_name'], $this->getLanguage()); ?>
</a>
			</li>
		<?php endforeach; endif; unset($_from); ?>
	</ul>
</div>
<?php endif; ?>

<div class="cm-tabs-content clearfix" id="tabs_content">
	<?php $_from = $this->_tpl_vars['payment_methods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tab_id'] => $this->_tpl_vars['payments']):
?>
		<div class="<?php if ($this->_tpl_vars['active'] != $this->_tpl_vars['tab_id'] && count($this->_tpl_vars['payment_methods']) > 1): ?>hidden<?php endif; ?>" id="content_payments_<?php echo $this->_tpl_vars['tab_id']; ?>
">
			<form name="payments_form_<?php echo $this->_tpl_vars['tab_id']; ?>
" action="<?php echo fn_url(""); ?>
" method="post">
			<div class="checkout-billing-options <?php if (count($this->_tpl_vars['payment_methods']) == 1): ?>notab<?php endif; ?>">
				<div class="hidden">
					<label for="group_payment_<?php echo $this->_tpl_vars['tab_id']; ?>
" class="cm-required">&nbsp;</label>
				</div>

				<?php ob_start(); ?>Y<?php $this->_smarty_vars['capture']['group_payment'] = ob_get_contents(); ob_end_clean(); ?>
				<?php ob_start(); ?>N<?php $this->_smarty_vars['capture']['require_payment'] = ob_get_contents(); ob_end_clean(); ?>

				<?php if (count($this->_tpl_vars['payments']) == 1): ?>
					<?php $this->assign('payment', reset($this->_tpl_vars['payments']), false); ?>
					<input type="hidden" name="payment_id" value="<?php echo $this->_tpl_vars['payment']['payment_id']; ?>
" />
					
					<?php $this->assign('payment_data', fn_get_payment_method_data($this->_tpl_vars['payment']['payment_id']), false); ?>
					
					<?php if ($this->_tpl_vars['payment_data']['template']): ?>
						<?php ob_start(); ?>
							<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/orders/components/payments/".($this->_tpl_vars['payment_data']['template']), 'smarty_include_vars' => array('card_id' => $this->_tpl_vars['payment']['payment_id'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php $this->_smarty_vars['capture']['payment_template'] = ob_get_contents(); ob_end_clean(); ?>
					<?php endif; ?>

					<?php if ($this->_tpl_vars['payment_data']['template'] && trim($this->_smarty_vars['capture']['payment_template']) != ""): ?>
						<div class="clearfix">
							<div class="other-text other-text-right"><?php echo $this->_tpl_vars['payment_data']['instructions']; ?>
</div>
							<?php echo $this->_smarty_vars['capture']['payment_template']; ?>

						</div>
					<?php else: ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/checkout/components/payments/payment_simple.tpl", 'smarty_include_vars' => array('payment' => $this->_tpl_vars['payment_data'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php if ($this->_tpl_vars['cart']['payment_id'] != $this->_tpl_vars['payment_data']['payment_id']): ?>
							<?php ob_start(); ?>Y<?php $this->_smarty_vars['capture']['require_payment'] = ob_get_contents(); ob_end_clean(); ?>
						<?php endif; ?>
					<?php endif; ?>
				<?php else: ?>
					<?php $this->assign('list_view', false, false); ?>

					<?php $_from = $this->_tpl_vars['payments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['payment']):
?>
						<?php if ($this->_tpl_vars['payment']['processor_type'] == 'C'): ?>
							<?php $this->assign('list_view', true, false); ?>
						<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?>

					<?php if ($this->_tpl_vars['list_view']): ?>
						<?php $_from = $this->_tpl_vars['payments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['payment']):
?>
							<?php $this->assign('payment_data', fn_get_payment_method_data($this->_tpl_vars['payment']['payment_id']), false); ?>
							<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/checkout/components/payments/payment_simple.tpl", 'smarty_include_vars' => array('payment' => $this->_tpl_vars['payment_data'],'active_tab' => $this->_tpl_vars['tab_id'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php endforeach; endif; unset($_from); ?>
					<?php else: ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/checkout/components/payments/payments_list.tpl", 'smarty_include_vars' => array('payment' => $this->_tpl_vars['payments'],'active_tab' => $this->_tpl_vars['tab_id'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php endif; ?>
				<?php endif; ?>
				
				<?php if ($this->_smarty_vars['capture']['require_payment'] == 'Y' || ( $this->_smarty_vars['capture']['group_payment'] == 'Y' && count($this->_tpl_vars['payments']) > 1 )): ?>
					<div class="hidden">
						<input type="text" name="group_payment_<?php echo $this->_tpl_vars['tab_id']; ?>
" id="group_payment_<?php echo $this->_tpl_vars['tab_id']; ?>
" value="" />
					</div>
				<?php endif; ?>

				<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/checkout/components/terms_and_conditions.tpl", 'smarty_include_vars' => array('suffix' => $this->_tpl_vars['tab_id'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

				<?php $this->assign('show_checkout_button', false, false); ?>
				<?php $_from = $this->_tpl_vars['payments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['payment']):
?>
					<?php if ($this->_tpl_vars['cart']['payment_id'] == $this->_tpl_vars['payment']['payment_id'] && $this->_tpl_vars['checkout_buttons'][$this->_tpl_vars['cart']['payment_id']]): ?>
						<?php $this->assign('show_checkout_button', true, false); ?>
					<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?>

				<?php if ($this->_tpl_vars['auth']['act_as_user']): ?>
					<div class="select-field">
						<input type="checkbox" id="skip_payment" name="skip_payment" value="Y" class="checkbox" />
						<label for="skip_payment"><?php echo fn_get_lang_var('skip_payment', $this->getLanguage()); ?>
</label>
					</div>
				<?php endif; ?>

				<?php $this->_tag_stack[] = array('hook', array('name' => "checkout:extra_payment_info")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if ($this->_tpl_vars['addons']['news_and_emails']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/news_and_emails/hooks/checkout/extra_payment_info.pre.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
				</div>

				<?php if ($this->_tpl_vars['iframe_mode']): ?>
					<div class="payment-method-iframe-box">
						<iframe width="100%" height="700" id="order_iframe_<?php echo @TIME; ?>
" src="<?php echo fn_url("checkout.process_payment", @AREA, 'checkout'); ?>
" style="border: 0px" frameBorder="0" ></iframe>
						<?php if ($this->_tpl_vars['cart_agreements'] || $this->_tpl_vars['settings']['General']['agree_terms_conditions'] == 'Y'): ?>
						<div id="payment_method_iframe<?php echo $this->_tpl_vars['tab_id']; ?>
" class="payment-method-iframe">
							<div class="payment-method-iframe-label">
								<div class="payment-method-iframe-text"><?php echo fn_get_lang_var('checkout_terms_n_conditions_alert', $this->getLanguage()); ?>
</div>
							</div>
						</div>
						<?php endif; ?>
					</div>
				<?php else: ?>
					<div class="checkout-buttons">
						<?php if (! $this->_tpl_vars['show_checkout_button']): ?>
							<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/place_order_new.tpl", 'smarty_include_vars' => array('but_text' => fn_get_lang_var('submit_my_order', $this->getLanguage()),'but_name' => "dispatch[checkout.place_order]",'but_role' => 'big','but_id' => "place_order_".($this->_tpl_vars['tab_id']))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>	
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<div class="processor-buttons hidden"></div>
			</form>

			<?php if ($this->_tpl_vars['show_checkout_button']): ?>
				<?php echo $this->_tpl_vars['checkout_buttons'][$this->_tpl_vars['cart']['payment_id']]; ?>

			<?php endif; ?>
		<!--content_payments_<?php echo $this->_tpl_vars['tab_id']; ?>
--></div>
	<?php endforeach; endif; unset($_from); ?>
</div>