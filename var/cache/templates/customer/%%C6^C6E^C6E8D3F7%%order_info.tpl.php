<?php /* Smarty version 2.6.18, created on 2014-03-10 11:21:05
         compiled from C:/wamp5/www/dutchme2/skins/basic/customer/blocks/checkout/order_info.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_get_profile_fields', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/checkout/order_info.tpl', 6, false),array('modifier', 'fn_get_profile_field_value', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/checkout/order_info.tpl', 9, false),array('modifier', 'replace', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/checkout/order_info.tpl', 11, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('billing_address','shipping_address','shipping_method'));
?>
<?php  ob_start();  ?>
<?php if ($this->_tpl_vars['completed_steps']['step_two']): ?>
	<?php if ($this->_tpl_vars['profile_fields']['B']): ?>
		<h4><?php echo fn_get_lang_var('billing_address', $this->getLanguage()); ?>
:</h4>

		<?php $this->assign('profile_fields', fn_get_profile_fields('I'), false); ?>
		<ul class="shipping-adress clearfix">
			<?php $_from = $this->_tpl_vars['profile_fields']['B']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field']):
?>
				<?php $this->assign('value', fn_get_profile_field_value($this->_tpl_vars['cart']['user_data'], $this->_tpl_vars['field']), false); ?>
				<?php if ($this->_tpl_vars['value']): ?>
					<li class="<?php echo smarty_modifier_replace($this->_tpl_vars['field']['field_name'], '_', "-"); ?>
"><?php echo $this->_tpl_vars['value']; ?>
</li>
				<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
		</ul>

		<hr />
	<?php endif; ?>

	<?php if ($this->_tpl_vars['profile_fields']['S']): ?>
		<h4><?php echo fn_get_lang_var('shipping_address', $this->getLanguage()); ?>
:</h4>
		<ul class="shipping-adress clearfix">
			<?php $_from = $this->_tpl_vars['profile_fields']['S']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field']):
?>
				<?php $this->assign('value', fn_get_profile_field_value($this->_tpl_vars['cart']['user_data'], $this->_tpl_vars['field']), false); ?>
				<?php if ($this->_tpl_vars['value']): ?>
					<li class="<?php echo smarty_modifier_replace($this->_tpl_vars['field']['field_name'], '_', "-"); ?>
"><?php echo $this->_tpl_vars['value']; ?>
</li>
				<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
		</ul>
		<hr />
	<?php endif; ?>

	<?php if ($this->_tpl_vars['cart']['shipping']): ?>
		<h4><?php echo fn_get_lang_var('shipping_method', $this->getLanguage()); ?>
:</h4>
		<ul>
			<?php $_from = $this->_tpl_vars['cart']['shipping']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['shipping']):
?>
				<li><?php echo $this->_tpl_vars['shipping']['shipping']; ?>
</li>
			<?php endforeach; endif; unset($_from); ?>
		</ul>
	<?php endif; ?>
<?php endif; ?>

<?php $this->assign('block_wrap', "checkout_order_info_".($this->_tpl_vars['block']['snapping_id'])."_wrap", false); ?>
<?php  ob_end_flush();  ?>