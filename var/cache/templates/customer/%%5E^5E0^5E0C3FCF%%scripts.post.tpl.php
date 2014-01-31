<?php /* Smarty version 2.6.18, created on 2014-01-28 18:26:57
         compiled from addons/bundled_products/hooks/index/scripts.post.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'script', 'addons/bundled_products/hooks/index/scripts.post.tpl', 1, false),array('function', 'set_id', 'addons/bundled_products/hooks/index/scripts.post.tpl', 7, false),array('modifier', 'trim', 'addons/bundled_products/hooks/index/scripts.post.tpl', 7, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('bundled_products_fill_the_mandatory_fields'));
?>
<?php  ob_start();  ?><?php ob_start(); ?><?php echo smarty_function_script(array('src' => "addons/bundled_products/js/func.js"), $this);?>


<script type="text/javascript">
//<![CDATA[
	lang['bundled_products_fill_the_mandatory_fields'] = '<?php echo fn_get_lang_var('bundled_products_fill_the_mandatory_fields', $this->getLanguage()); ?>
';
//]]>
</script><?php $this->_smarty_vars['capture']['template_content'] = ob_get_contents(); ob_end_clean(); ?><?php if (trim($this->_smarty_vars['capture']['template_content'])): ?><?php if ($this->_tpl_vars['auth']['area'] == 'A'): ?><span class="cm-template-box" template="addons/bundled_products/hooks/index/scripts.post.tpl" id="<?php echo smarty_function_set_id(array('name' => "addons/bundled_products/hooks/index/scripts.post.tpl"), $this);?>
"><img class="cm-template-icon hidden" src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/layout_edit.gif" width="16" height="16" alt="" /><?php echo $this->_smarty_vars['capture']['template_content']; ?>
<!--[/tpl_id]--></span><?php else: ?><?php echo $this->_smarty_vars['capture']['template_content']; ?>
<?php endif; ?><?php endif; ?><?php  ob_end_flush();  ?>