<?php /* Smarty version 2.6.18, created on 2014-03-07 22:31:26
         compiled from addons/bundled_products/hooks/products/tabs_extra.post.tpl */ ?>
<?php
fn_preload_lang_vars(array('editing_combination','no_data','new_combination','add_combination'));
?>

<?php $this->assign('hide_controls', false, false); ?>

<div id="content_bundled_products" class="cm-hide-save-button hidden <?php if ($this->_tpl_vars['hide_controls']): ?>cm-hide-inputs<?php endif; ?>">
	<div class="items-container" id="update_chains_list">
		<?php if ($this->_tpl_vars['chains']): ?>
			<?php $_from = $this->_tpl_vars['chains']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['chain']):
?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/object_group.tpl", 'smarty_include_vars' => array('id' => $this->_tpl_vars['chain']['chain_id'],'id_prefix' => '_bp_','text' => $this->_tpl_vars['chain']['name'],'hidden' => false,'href' => "bundled_products.update?chain_id=".($this->_tpl_vars['chain']['chain_id']),'object_id_name' => 'chain_id','table' => 'bundled_products','href_delete' => "bundled_products.delete?chain_id=".($this->_tpl_vars['chain']['chain_id']),'rev_delete' => 'update_chains_list','header_text' => (fn_get_lang_var('editing_combination', $this->getLanguage())).":&nbsp;".($this->_tpl_vars['chain']['name']),'skip_delete' => $this->_tpl_vars['hide_controls'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php endforeach; endif; unset($_from); ?>
		<?php else: ?>
			<p class="no-items"><?php echo fn_get_lang_var('no_data', $this->getLanguage()); ?>
</p>
		<?php endif; ?>
	<!--update_chains_list--></div>

	<?php if (! $this->_tpl_vars['chains']): ?>
	<div class="buttons-container">
			<?php ob_start(); ?>
				<div id="add_new_chain">
						<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/bundled_products/views/bundled_products/update.tpl", 'smarty_include_vars' => array('product_id' => ($this->_tpl_vars['product_data']['product_id']),'item' => "")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				</div>
			<?php $this->_smarty_vars['capture']['add_new_picker'] = ob_get_contents(); ob_end_clean(); ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'add_new_chain','text' => fn_get_lang_var('new_combination', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['add_new_picker'],'link_text' => fn_get_lang_var('add_combination', $this->getLanguage()),'act' => 'general')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
	<?php endif; ?>
<!--content_bundled_products--></div>