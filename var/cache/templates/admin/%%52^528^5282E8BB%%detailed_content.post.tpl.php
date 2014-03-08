<?php /* Smarty version 2.6.18, created on 2014-03-08 23:25:02
         compiled from addons/seo/hooks/products/detailed_content.post.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'defined', 'addons/seo/hooks/products/detailed_content.post.tpl', 1, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('seo','seo_name'));
?>
<?php if (defined('COMPANY_ID') && @PRODUCT_TYPE == 'ULTIMATE' || @PRODUCT_TYPE != 'ULTIMATE'): ?>
<fieldset>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('seo', $this->getLanguage()))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	
	<div class="form-field cm-no-hide-input">
		<label for="product_seo_name"><?php echo fn_get_lang_var('seo_name', $this->getLanguage()); ?>
:</label>
		<input type="text" name="product_data[seo_name]" id="product_seo_name" size="55" value="<?php echo $this->_tpl_vars['product_data']['seo_name']; ?>
" class="input-text-large" />
	</div>
</fieldset>
<?php endif; ?>