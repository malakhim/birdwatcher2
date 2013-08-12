<?php /* Smarty version 2.6.18, created on 2013-08-13 07:51:22
         compiled from addons/bundled_products/hooks/products/product_data.post.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'trim', 'addons/bundled_products/hooks/products/product_data.post.tpl', 8, false),array('block', 'hook', 'addons/bundled_products/hooks/products/product_data.post.tpl', 8, false),)), $this); ?>
<?php if ($this->_tpl_vars['bp_chain'] || $this->_tpl_vars['bp_id']): ?>
	<div class="cm-reload-<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['obj_id']; ?>
" id="bundled_products_options_update_<?php echo $this->_tpl_vars['bp_chain']; ?>
_<?php echo $this->_tpl_vars['bp_id']; ?>
">
		<?php $this->assign('product_options', "product_options_".($this->_tpl_vars['obj_id']), false); ?>
		<input type="hidden" name="appearance[show_product_options]" value="1" />
		<input type="hidden" name="appearance[bp_chain]" value="<?php echo $this->_tpl_vars['bp_chain']; ?>
" />
		<input type="hidden" name="appearance[bp_id]" value="<?php echo $this->_tpl_vars['bp_id']; ?>
" />
		<input type="hidden" name="appearance[show_product_options]" value="<?php echo $this->_tpl_vars['show_product_options']; ?>
" />
		<?php if ($this->_tpl_vars['addons']['product_configurator']['status'] == 'A'): ?><?php ob_start(); $this->_in_capture[] = '010df988c0f8297f113c64267c9bf81a';
$_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/product_configurator/hooks/products/product_option_content.override.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
$this->_tpl_vars['addon_content'] = ob_get_contents(); ob_end_clean(); array_pop($this->_in_capture); if (!empty($this->_scripts['010df988c0f8297f113c64267c9bf81a'])) { echo implode("\n", $this->_scripts['010df988c0f8297f113c64267c9bf81a']); unset($this->_scripts['010df988c0f8297f113c64267c9bf81a']); }
 ?><?php else: ?><?php $this->assign('addon_content', "", false); ?><?php endif; ?><?php if (trim($this->_tpl_vars['addon_content'])): ?><?php echo $this->_tpl_vars['addon_content']; ?>
<?php else: ?><?php $this->_tag_stack[] = array('hook', array('name' => "products:product_option_content")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			<?php if ($this->_tpl_vars['disable_ids']): ?>
				<?php $this->assign('_disable_ids', ($this->_tpl_vars['disable_ids']).($this->_tpl_vars['obj_id']), false); ?>
			<?php else: ?>
				<?php $this->assign('_disable_ids', "", false); ?>
			<?php endif; ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/products/components/product_options.tpl", 'smarty_include_vars' => array('id' => $this->_tpl_vars['obj_id'],'product_options' => $this->_tpl_vars['product']['product_options'],'name' => 'product_data','capture_options_vs_qty' => $this->_tpl_vars['capture_options_vs_qty'],'disable_ids' => $this->_tpl_vars['_disable_ids'],'extra_id' => $this->_tpl_vars['obj_id'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php if ($this->_tpl_vars['addons']['recurring_billing']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/recurring_billing/hooks/products/product_option_content.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php endif; ?>
	<!--bundled_products_options_update_<?php echo $this->_tpl_vars['bp_chain']; ?>
_<?php echo $this->_tpl_vars['bp_id']; ?>
--></div>
<?php endif; ?>