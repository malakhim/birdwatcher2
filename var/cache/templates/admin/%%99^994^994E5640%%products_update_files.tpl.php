<?php /* Smarty version 2.6.18, created on 2014-03-07 13:52:18
         compiled from views/products/components/products_update_files.tpl */ ?>
<?php
fn_preload_lang_vars(array('editing_file','no_data','new_file','add_file'));
?>


<div class="items-container cm-sortable" id="product_files_list">

<?php $_from = $this->_tpl_vars['product_files']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['file']):
?>
	<?php ob_start(); ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/products/components/products_update_file_details.tpl", 'smarty_include_vars' => array('product_file' => $this->_tpl_vars['file'],'product_id' => $this->_tpl_vars['product_data']['product_id'],'hide_inputs' => $this->_tpl_vars['hide_inputs'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php $this->_smarty_vars['capture']['object_group'] = ob_get_contents(); ob_end_clean(); ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/object_group.tpl", 'smarty_include_vars' => array('content' => $this->_smarty_vars['capture']['object_group'],'id' => $this->_tpl_vars['file']['file_id'],'text' => $this->_tpl_vars['file']['file_name'],'status' => $this->_tpl_vars['file']['status'],'object_id_name' => 'file_id','table' => 'product_files','href_delete' => "products.delete_file?file_id=".($this->_tpl_vars['file']['file_id']),'rev_delete' => 'product_files_list','header_text' => (fn_get_lang_var('editing_file', $this->getLanguage())).": ".($this->_tpl_vars['file']['file_name']),'id_prefix' => '_files_','prefix' => 'files','hide_for_vendor' => $this->_tpl_vars['hide_for_vendor'],'skip_delete' => $this->_tpl_vars['skip_delete'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php endforeach; else: ?>

	<p class="no-items"><?php echo fn_get_lang_var('no_data', $this->getLanguage()); ?>
</p>

<?php endif; unset($_from); ?>
<!--product_files_list--></div>

<?php if (! $this->_tpl_vars['hide_for_vendor']): ?>
<div class="buttons-container">
	<?php ob_start(); ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/products/components/products_update_file_details.tpl", 'smarty_include_vars' => array('product_id' => $this->_tpl_vars['product_data']['product_id'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php $this->_smarty_vars['capture']['add_new_picker'] = ob_get_contents(); ob_end_clean(); ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'add_new_files','text' => fn_get_lang_var('new_file', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['add_new_picker'],'link_text' => fn_get_lang_var('add_file', $this->getLanguage()),'act' => 'general')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<?php endif; ?>