<?php /* Smarty version 2.6.18, created on 2013-08-30 14:14:06
         compiled from views/checkout/checkout.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'script', 'views/checkout/checkout.tpl', 15, false),array('modifier', 'implode', 'views/checkout/checkout.tpl', 21, false),array('modifier', 'fn_url', 'views/checkout/checkout.tpl', 34, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('user_info','billing_shipping_address','shipping_options','billing_options','secure_checkout','secure_checkout'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'views/checkout/components/progressbar.tpl' => 1367063747,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php echo smarty_function_script(array('src' => "js/exceptions.js"), $this);?>

<?php echo smarty_function_script(array('src' => "js/cc_validator.js"), $this);?>


<script type="text/javascript">
//<![CDATA[
	<?php if ($this->_tpl_vars['edit_steps']): ?>
	<?php $this->assign('c_step', implode($this->_tpl_vars['edit_steps'], ""), false); ?>	
	$(function() <?php echo $this->_tpl_vars['ldelim']; ?>

		$.scrollToElm($('#<?php echo $this->_tpl_vars['c_step']; ?>
'));
	<?php echo $this->_tpl_vars['rdelim']; ?>
);
	<?php endif; ?>
//]]>
</script>

<?php if ($this->_tpl_vars['settings']['General']['checkout_style'] == 'multi_page'): ?>
	<?php if ($this->_tpl_vars['cart_products']): ?>
	<?php $__parent_tpl_vars = $this->_tpl_vars; ?><div class="pb-container">
	<span class="<?php if ($this->_tpl_vars['edit_step'] == 'step_one'): ?>active<?php elseif ($this->_tpl_vars['completed_steps']['step_one'] == true): ?>complete<?php endif; ?>">
		<em>1</em>
		<?php if ($this->_tpl_vars['edit_step'] != 'step_one'): ?><a href="<?php echo fn_url("checkout.checkout?edit_step=step_one"); ?>
"><?php endif; ?><span><?php echo fn_get_lang_var('user_info', $this->getLanguage()); ?>
</span><?php if ($this->_tpl_vars['edit_step'] != 'step_one'): ?></a><?php endif; ?>
	</span>

	<img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/pb_arrow.gif" width="25" height="7" border="0" alt="&rarr;" />

	<span class="<?php if ($this->_tpl_vars['edit_step'] == 'step_two'): ?>active<?php elseif ($this->_tpl_vars['completed_steps']['step_two'] == true): ?>complete<?php endif; ?>">
		<em>2</em>
		<?php if ($this->_tpl_vars['edit_step'] != 'step_two'): ?><a href="<?php echo fn_url("checkout.checkout?edit_step=step_two"); ?>
"><?php endif; ?><span><?php echo fn_get_lang_var('billing_shipping_address', $this->getLanguage()); ?>
</span><?php if ($this->_tpl_vars['edit_step'] != 'step_two'): ?></a><?php endif; ?>
	</span>

	<img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/pb_arrow.gif" width="25" height="7" border="0" alt="&rarr;" />

	<span class="<?php if ($this->_tpl_vars['edit_step'] == 'step_three'): ?>active<?php elseif ($this->_tpl_vars['completed_steps']['step_three'] == true): ?>complete<?php endif; ?>">
		<em>3</em>
		<?php if ($this->_tpl_vars['edit_step'] != 'step_three'): ?><a href="<?php echo fn_url("checkout.checkout?edit_step=step_three"); ?>
"><?php endif; ?><span><?php echo fn_get_lang_var('shipping_options', $this->getLanguage()); ?>
</span><?php if ($this->_tpl_vars['edit_step'] != 'step_three'): ?></a><?php endif; ?>
	</span>

	<img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/pb_arrow.gif" width="25" height="7" border="0" alt="&rarr;" />

	<span class="<?php if ($this->_tpl_vars['edit_step'] == 'step_four'): ?>active<?php elseif ($this->_tpl_vars['completed_steps']['step_four'] == true): ?>complete<?php endif; ?>">
		<em>4</em>
		<?php if ($this->_tpl_vars['edit_step'] != 'step_four'): ?><a href="<?php echo fn_url("checkout.checkout?edit_step=step_four"); ?>
"><?php endif; ?><span><?php echo fn_get_lang_var('billing_options', $this->getLanguage()); ?>
</span><?php if ($this->_tpl_vars['edit_step'] != 'step_four'): ?></a><?php endif; ?>
	</span>
</div><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	<?php endif; ?>

	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/checkout/components/checkout_steps.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php ob_start(); ?><span class="secure-page-title classic-checkout-title"><?php echo fn_get_lang_var('secure_checkout', $this->getLanguage()); ?>
</span><?php $this->_smarty_vars['capture']['mainbox_title'] = ob_get_contents(); ob_end_clean(); ?>
<?php else: ?>
	<?php echo $this->_smarty_vars['capture']['checkout_error_content']; ?>

	<a name="checkout_top"></a>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/checkout/components/checkout_steps.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

	<?php ob_start(); ?><span class="secure-page-title"><?php echo fn_get_lang_var('secure_checkout', $this->getLanguage()); ?>
</span><?php $this->_smarty_vars['capture']['mainbox_title'] = ob_get_contents(); ob_end_clean(); ?>
<?php endif; ?>