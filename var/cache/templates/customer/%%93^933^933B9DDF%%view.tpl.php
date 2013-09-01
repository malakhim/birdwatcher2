<?php /* Smarty version 2.6.18, created on 2013-09-01 10:52:52
         compiled from views/products/view.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_get_product_details_layout', 'views/products/view.tpl', 1, false),array('block', 'hook', 'views/products/view.tpl', 21, false),)), $this); ?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'addons/recurring_billing/hooks/products/layout_content.pre.tpl' => 1367063839,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php ob_start(); ?><?php $this->_smarty_vars['capture']['val_hide_form'] = ob_get_contents(); ob_end_clean(); ?>
<?php ob_start(); ?><?php $this->_smarty_vars['capture']['val_capture_options_vs_qty'] = ob_get_contents(); ob_end_clean(); ?>
<?php ob_start(); ?><?php $this->_smarty_vars['capture']['val_capture_buttons'] = ob_get_contents(); ob_end_clean(); ?>
<?php ob_start(); ?><?php $this->_smarty_vars['capture']['val_separate_buttons'] = ob_get_contents(); ob_end_clean(); ?>
<?php ob_start(); ?><?php $this->_smarty_vars['capture']['val_no_ajax'] = ob_get_contents(); ob_end_clean(); ?>

<?php $this->_tag_stack[] = array('hook', array('name' => "products:layout_content")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if ($this->_tpl_vars['addons']['recurring_billing']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><?php if ($this->_tpl_vars['product']['recurring_plans']): ?>
	<?php ob_start(); ?>Y<?php $this->_smarty_vars['capture']['hide_form_changed'] = ob_get_contents(); ob_end_clean(); ?>
	<?php ob_start(); ?><?php echo $this->_smarty_vars['capture']['val_hide_form']; ?>
<?php $this->_smarty_vars['capture']['orig_val_hide_form'] = ob_get_contents(); ob_end_clean(); ?>
	<?php ob_start(); ?>Y<?php $this->_smarty_vars['capture']['val_hide_form'] = ob_get_contents(); ob_end_clean(); ?>
	<?php ob_start(); ?>Y<?php $this->_smarty_vars['capture']['val_capture_options_vs_qty'] = ob_get_contents(); ob_end_clean(); ?>
	<?php ob_start(); ?>Y<?php $this->_smarty_vars['capture']['val_capture_buttons'] = ob_get_contents(); ob_end_clean(); ?>
	<?php ob_start(); ?><?php $this->_smarty_vars['capture']['val_separate_buttons'] = ob_get_contents(); ob_end_clean(); ?>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => fn_get_product_details_layout($this->_tpl_vars['product']['product_id']), 'smarty_include_vars' => array('product' => $this->_tpl_vars['product'],'show_sku' => true,'show_rating' => true,'show_old_price' => true,'show_price' => true,'show_list_discount' => true,'show_clean_price' => true,'details_page' => true,'show_discount_label' => true,'show_product_amount' => true,'show_product_options' => true,'hide_form' => $this->_smarty_vars['capture']['val_hide_form'],'min_qty' => true,'show_edp' => true,'show_add_to_cart' => true,'show_list_buttons' => true,'but_role' => 'action','capture_buttons' => $this->_smarty_vars['capture']['val_capture_buttons'],'capture_options_vs_qty' => $this->_smarty_vars['capture']['val_capture_options_vs_qty'],'separate_buttons' => $this->_smarty_vars['capture']['val_separate_buttons'],'block_width' => true,'no_ajax' => $this->_smarty_vars['capture']['val_no_ajax'],'show_product_tabs' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>