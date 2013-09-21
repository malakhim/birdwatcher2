<?php /* Smarty version 2.6.18, created on 2013-09-21 11:03:04
         compiled from blocks/product_list_templates/products_multicolumns.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'blocks/product_list_templates/products_multicolumns.tpl', 1, false),)), $this); ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "blocks/list_templates/grid_list.tpl", 'smarty_include_vars' => array('show_trunc_name' => true,'show_old_price' => true,'show_price' => true,'show_clean_price' => true,'show_list_discount' => true,'show_add_to_cart' => smarty_modifier_default(@$this->_tpl_vars['show_add_to_cart'], false),'but_role' => 'action')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>