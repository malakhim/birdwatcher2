<?php /* Smarty version 2.6.18, created on 2013-09-03 09:47:36
         compiled from views/checkout/components/payments/payments_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_url', 'views/checkout/components/payments/payments_list.tpl', 4, false),array('modifier', 'fn_get_payment_method_data', 'views/checkout/components/payments/payments_list.tpl', 6, false),array('modifier', 'unescape', 'views/checkout/components/payments/payments_list.tpl', 22, false),)), $this); ?>
<div class="other-pay clearfix">
	<ul class="paym-methods">
		<?php $_from = $this->_tpl_vars['payments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['payment']):
?>
			<li><input id="payment_<?php echo $this->_tpl_vars['payment']['payment_id']; ?>
" class="radio valign" type="radio" name="payment_id" value="<?php echo $this->_tpl_vars['payment']['payment_id']; ?>
" <?php if ($this->_tpl_vars['cart']['payment_id'] == $this->_tpl_vars['payment']['payment_id']): ?>checked="checked"<?php endif; ?> onchange="$.ajaxRequest('<?php echo fn_url("checkout.update_payment?payment_id=".($this->_tpl_vars['payment']['payment_id'])."&active_tab=".($this->_tpl_vars['tab_id']), 'C', 'rel', '&amp;'); ?>
', <?php echo '{method: \'POST\', caching: false, force_exec: true, full_render: true, result_ids: '; ?>
'checkout*,content_payments*'<?php echo '}'; ?>
);" /><div class="radio1"><h5><label for="payment_<?php echo $this->_tpl_vars['payment']['payment_id']; ?>
"><?php echo $this->_tpl_vars['payment']['payment']; ?>
</label></h5><?php echo $this->_tpl_vars['payment']['description']; ?>
</div></li>

			<?php $this->assign('payment_data', fn_get_payment_method_data($this->_tpl_vars['payment']['payment_id']), false); ?>
			
			<?php if ($this->_tpl_vars['payment_data']['template'] && $this->_tpl_vars['payment_data']['template'] != "cc_outside.tpl" && $this->_tpl_vars['cart']['payment_id'] == $this->_tpl_vars['payment']['payment_id']): ?>
				<div>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/orders/components/payments/".($this->_tpl_vars['payment_data']['template']), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				</div>
			<?php endif; ?>

			<?php if ($this->_tpl_vars['cart']['payment_id'] == $this->_tpl_vars['payment']['payment_id']): ?>
				<?php ob_start(); ?>N<?php $this->_smarty_vars['capture']['group_payment'] = ob_get_contents(); ob_end_clean(); ?>
				<?php $this->assign('instructions', $this->_tpl_vars['payment']['instructions'], false); ?>
				<?php $this->assign('description', $this->_tpl_vars['payment']['description'], false); ?>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
	</ul>
		<div class="other-text">
			<?php echo smarty_modifier_unescape($this->_tpl_vars['instructions']); ?>

		</div>
</div>