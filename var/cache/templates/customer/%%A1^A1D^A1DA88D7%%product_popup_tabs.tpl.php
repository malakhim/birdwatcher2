<?php /* Smarty version 2.6.18, created on 2013-08-31 09:07:02
         compiled from views/tabs/components/product_popup_tabs.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'block', 'views/tabs/components/product_popup_tabs.tpl', 9, false),array('modifier', 'trim', 'views/tabs/components/product_popup_tabs.tpl', 15, false),)), $this); ?>
<?php ob_start(); ?>
	<?php $_from = $this->_tpl_vars['tabs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tab_id'] => $this->_tpl_vars['tab']):
?>
		<?php if ($this->_tpl_vars['tab']['show_in_popup'] == 'Y' && $this->_tpl_vars['tab']['status'] == 'A'): ?>
			<?php $this->assign('product_tab_id', "product_tab_".($this->_tpl_vars['tab']['tab_id']), false); ?>
			<?php $this->assign('tab_content_capture', "tab_content_capture_".($this->_tpl_vars['tab_id']), false); ?>

			<?php ob_start(); ?>
				<?php if ($this->_tpl_vars['tab']['tab_type'] == 'B'): ?>
					<?php echo smarty_function_block(array('block_id' => $this->_tpl_vars['tab']['block_id'],'dispatch' => "products.view"), $this);?>

				<?php elseif ($this->_tpl_vars['tab']['tab_type'] == 'T'): ?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['tab']['template'], 'smarty_include_vars' => array('product_tab_id' => $this->_tpl_vars['product_tab_id'],'force_ajax' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php endif; ?>
			<?php $this->_smarty_vars['capture'][$this->_tpl_vars['tab_content_capture']] = ob_get_contents(); ob_end_clean(); ?>

			<?php if (trim($this->_smarty_vars['capture'][$this->_tpl_vars['tab_content_capture']])): ?>
				
				<li><a id="opener_content_block_popup_<?php echo $this->_tpl_vars['tab_id']; ?>
" class="cm-dialog-opener" rev="content_block_popup_<?php echo $this->_tpl_vars['tab_id']; ?>
"><?php echo $this->_tpl_vars['tab']['name']; ?>
</a></li>
				<div id="content_block_popup_<?php echo $this->_tpl_vars['tab_id']; ?>
" class="hidden" title="<?php echo $this->_tpl_vars['tab']['name']; ?>
">
					<?php echo $this->_smarty_vars['capture'][$this->_tpl_vars['tab_content_capture']]; ?>

				</div>
			<?php endif; ?>
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
<?php $this->_smarty_vars['capture']['popupsbox'] = ob_get_contents(); ob_end_clean(); ?>

<?php ob_start(); ?>
<?php if (trim($this->_smarty_vars['capture']['popupsbox'])): ?>
<ul class="popup-tabs">
<?php echo $this->_smarty_vars['capture']['popupsbox']; ?>

</ul>
<?php endif; ?>
<?php $this->_smarty_vars['capture']['popupsbox_content'] = ob_get_contents(); ob_end_clean(); ?>