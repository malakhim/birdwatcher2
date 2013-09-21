<?php /* Smarty version 2.6.18, created on 2013-09-21 19:46:37
         compiled from views/checkout/cart.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'views/checkout/cart.tpl', 1, false),array('modifier', 'fn_cart_is_empty', 'views/checkout/cart.tpl', 3, false),array('function', 'script', 'views/checkout/cart.tpl', 1, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('text_cart_empty'));
?>
<?php echo smarty_function_script(array('src' => "js/exceptions.js"), $this);?>


<?php if (! fn_cart_is_empty($this->_tpl_vars['cart'])): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/checkout/components/cart_content.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php else: ?>
	<p class="no-items"><?php echo fn_get_lang_var('text_cart_empty', $this->getLanguage()); ?>
</p>

	<div class="buttons-container wrap">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/continue_shopping.tpl", 'smarty_include_vars' => array('but_href' => smarty_modifier_default(@$this->_tpl_vars['continue_url'], @$this->_tpl_vars['index_script']),'but_role' => 'submit')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
<?php endif; ?>