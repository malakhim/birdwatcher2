<?php /* Smarty version 2.6.18, created on 2013-09-21 20:14:58
         compiled from views/checkout/components/payments/payment_simple.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_get_payment_method_data', 'views/checkout/components/payments/payment_simple.tpl', 5, false),array('modifier', 'fn_url', 'views/checkout/components/payments/payment_simple.tpl', 20, false),)), $this); ?>
<?php if ($this->_tpl_vars['checkout_buttons'][$this->_tpl_vars['payment']['payment_id']]): ?>
	<?php $this->assign('has_button', true, false); ?>
<?php endif; ?>

<?php $this->assign('payment_data', fn_get_payment_method_data($this->_tpl_vars['payment']['payment_id']), false); ?>

<div class="form-payment payment-delim clearfix">
	<?php if ($this->_tpl_vars['payment']['instructions']): ?>
		<div class="other-text other-text-right">
			<?php echo $this->_tpl_vars['payment']['instructions']; ?>

		</div>
	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['payment']['image']): ?>
		<span class="payment-image">
			<label for="payment_<?php echo $this->_tpl_vars['payment']['payment_id']; ?>
"><img src="<?php echo $this->_tpl_vars['payment']['image']['icon']['image_path']; ?>
" border="0" alt="" class="valign" /></label>
		</span>
	<?php endif; ?>

	<input type="radio" id="payment_<?php echo $this->_tpl_vars['payment']['payment_id']; ?>
" name="payment_id" value="<?php echo $this->_tpl_vars['payment']['payment_id']; ?>
" <?php if ($this->_tpl_vars['cart']['payment_id'] == $this->_tpl_vars['payment']['payment_id']): ?>checked="checked"<?php endif; ?> onclick="$.ajaxRequest('<?php echo fn_url("checkout.update_payment&amp;payment_id=".($this->_tpl_vars['payment']['payment_id'])."&amp;active_tab=".($this->_tpl_vars['tab_id']), 'C', 'rel', '&amp;'); ?>
', <?php echo '{method: \'POST\', caching: false, force_exec: true, full_render: true, result_ids: '; ?>
'checkout*'<?php echo '}'; ?>
);" /><label for="payment_<?php echo $this->_tpl_vars['payment']['payment_id']; ?>
"><strong><?php echo $this->_tpl_vars['payment']['payment']; ?>
</strong></label>

	<div class="form-payment-field">
	<?php if ($this->_tpl_vars['cart']['payment_id'] == $this->_tpl_vars['payment']['payment_id']): ?>
		<?php ob_start(); ?>N<?php $this->_smarty_vars['capture']['group_payment'] = ob_get_contents(); ob_end_clean(); ?>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['payment']['description']): ?>
		<p class="description"><?php echo $this->_tpl_vars['payment']['description']; ?>
</p>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['payment_data']['template'] && $this->_tpl_vars['payment_data']['template'] != "cc_outside.tpl" && $this->_tpl_vars['cart']['payment_id'] == $this->_tpl_vars['payment']['payment_id']): ?>
		<div>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/orders/components/payments/".($this->_tpl_vars['payment_data']['template']), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
	<?php endif; ?>
	</div>
</div>