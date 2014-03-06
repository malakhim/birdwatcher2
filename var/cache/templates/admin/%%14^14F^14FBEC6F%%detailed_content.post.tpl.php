<?php /* Smarty version 2.6.18, created on 2014-03-06 20:02:58
         compiled from addons/bundled_products/hooks/products/detailed_content.post.tpl */ ?>
<?php
fn_preload_lang_vars(array('bundled_products','use_as_a_bundle'));
?>
<fieldset>

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('bundled_products', $this->getLanguage()))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="form-field">
	<label for="bundle"><?php echo fn_get_lang_var('use_as_a_bundle', $this->getLanguage()); ?>
:</label>
	<input type="hidden" name="product_data[bundle]" value="N" />
	<input type="checkbox" name="product_data[bundle]" id="bundle" value="Y" <?php if ($this->_tpl_vars['product_data']['bundle'] == 'Y'): ?>checked="checked"<?php endif; ?> class="checkbox" />
</div>

</fieldset>