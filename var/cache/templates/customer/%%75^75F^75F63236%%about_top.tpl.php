<?php /* Smarty version 2.6.18, created on 2014-01-31 21:09:25
         compiled from C:/wamp5/www/dutchme2/skins/basic/customer/addons/billibuys/blocks/static_templates/about_top.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'trim', 'C:/wamp5/www/dutchme2/skins/basic/customer/addons/billibuys/blocks/static_templates/about_top.tpl', 5, false),array('function', 'set_id', 'C:/wamp5/www/dutchme2/skins/basic/customer/addons/billibuys/blocks/static_templates/about_top.tpl', 5, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('about_line_5'));
?>
<?php  ob_start();  ?><?php ob_start(); ?><div id="billibuys_about_text">
	<div class="about_line_5">
		<?php echo fn_get_lang_var('about_line_5', $this->getLanguage()); ?>

	</div>
</div><?php $this->_smarty_vars['capture']['template_content'] = ob_get_contents(); ob_end_clean(); ?><?php if (trim($this->_smarty_vars['capture']['template_content'])): ?><?php if ($this->_tpl_vars['auth']['area'] == 'A'): ?><span class="cm-template-box" template="addons/billibuys/blocks/static_templates/about_top.tpl" id="<?php echo smarty_function_set_id(array('name' => "addons/billibuys/blocks/static_templates/about_top.tpl"), $this);?>
"><img class="cm-template-icon hidden" src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/layout_edit.gif" width="16" height="16" alt="" /><?php echo $this->_smarty_vars['capture']['template_content']; ?>
<!--[/tpl_id]--></span><?php else: ?><?php echo $this->_smarty_vars['capture']['template_content']; ?>
<?php endif; ?><?php endif; ?><?php  ob_end_flush();  ?>