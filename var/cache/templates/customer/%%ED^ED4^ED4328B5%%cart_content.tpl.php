<?php /* Smarty version 2.6.18, created on 2013-09-01 10:35:40
         compiled from views/checkout/components/cart_content.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'views/checkout/components/cart_content.tpl', 1, false),array('modifier', 'fn_url', 'views/checkout/components/cart_content.tpl', 5, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('cart_contents','or_use'));
?>

<?php $this->assign('result_ids', "cart_items,checkout_totals,checkout_steps,cart_status*,checkout_cart", false); ?>

<form name="checkout_form" class="cm-check-changes" action="<?php echo fn_url(""); ?>
" method="post" enctype="multipart/form-data">
<input type="hidden" name="redirect_mode" value="cart" />
<input type="hidden" name="result_ids" value="<?php echo $this->_tpl_vars['result_ids']; ?>
" />
<h1 class="mainbox-title">
		<span><?php echo fn_get_lang_var('cart_contents', $this->getLanguage()); ?>
</span>
</h1>
<div class="buttons-container cart-top-buttons clearfix">
	<div class="float-left cart-left-buttons">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/continue.tpl", 'smarty_include_vars' => array('but_href' => smarty_modifier_default(@$this->_tpl_vars['continue_url'], @$this->_tpl_vars['index_script']))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/clear_cart.tpl", 'smarty_include_vars' => array('but_href' => "checkout.clear",'but_role' => 'text','but_meta' => "cm-confirm nobg")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
	<div class="float-right right cart-right-buttons">
		<div class="float-right">
		<?php if ($this->_tpl_vars['payment_methods']): ?>
			<?php $this->assign('m_name', 'checkout', false); ?>
			<?php $this->assign('link_href', "checkout.checkout", false); ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/proceed_to_checkout.tpl", 'smarty_include_vars' => array('but_href' => $this->_tpl_vars['link_href'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php endif; ?></div>
		<div class="float-right"><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/update_cart.tpl", 'smarty_include_vars' => array('but_id' => 'button_cart','but_name' => "dispatch[checkout.update]")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
	</div>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/checkout/components/cart_items.tpl", 'smarty_include_vars' => array('disable_ids' => 'button_cart')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</form>

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/checkout/components/checkout_totals.tpl", 'smarty_include_vars' => array('location' => 'cart')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="buttons-container cart-bottom-buttons clearfix">
	<div class="float-left">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/continue.tpl", 'smarty_include_vars' => array('but_href' => smarty_modifier_default(@$this->_tpl_vars['continue_url'], @$this->_tpl_vars['index_script']))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
	<div class="float-right right cart-right-buttons">
		<div class="float-right">
		<?php if ($this->_tpl_vars['payment_methods']): ?>
			<?php $this->assign('m_name', 'checkout', false); ?>
			<?php $this->assign('link_href', "checkout.checkout", false); ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/proceed_to_checkout.tpl", 'smarty_include_vars' => array('but_href' => $this->_tpl_vars['link_href'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php endif; ?>
		</div>
		<div class="float-right"><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/update_cart.tpl", 'smarty_include_vars' => array('but_onclick' => "$('#button_cart').click()",'but_name' => "dispatch[checkout.update]")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
	</div>
</div>
<?php if ($this->_tpl_vars['checkout_add_buttons']): ?>
<div class="payment-methods-wrap">
	<div class="payment-methods"><span class="payment-metgods-or"><?php echo fn_get_lang_var('or_use', $this->getLanguage()); ?>
</span>
		<table width="100%" cellpadding="0" cellspacing="0" border="0">
		<tr>
			<?php $_from = $this->_tpl_vars['checkout_add_buttons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['checkout_add_button']):
?>
				<td><?php echo $this->_tpl_vars['checkout_add_button']; ?>
</td>
			<?php endforeach; endif; unset($_from); ?>
		</tr>
		</table>
	</div>
</div>
<?php endif; ?>