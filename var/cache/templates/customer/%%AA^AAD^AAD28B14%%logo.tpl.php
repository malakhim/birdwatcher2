<?php /* Smarty version 2.6.18, created on 2014-01-23 12:47:13
         compiled from C:/wamp5/www/dutchme2/skins/basic/customer/blocks/static_templates/logo.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_url', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/static_templates/logo.tpl', 3, false),array('modifier', 'trim', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/static_templates/logo.tpl', 4, false),array('function', 'set_id', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/static_templates/logo.tpl', 4, false),)), $this); ?>
<?php  ob_start();  ?><?php ob_start(); ?><div class="logo-container">
	<a href="<?php echo fn_url(""); ?>
" style="background: url('<?php echo $this->_tpl_vars['images_dir']; ?>
/<?php echo $this->_tpl_vars['manifest']['Customer_logo']['filename']; ?>
') no-repeat; width:<?php echo $this->_tpl_vars['manifest']['Customer_logo']['width']; ?>
px; height:<?php echo $this->_tpl_vars['manifest']['Customer_logo']['height']; ?>
px;" title="<?php echo $this->_tpl_vars['manifest']['Customer_logo']['alt']; ?>
" class="logo"></a>
</div><?php $this->_smarty_vars['capture']['template_content'] = ob_get_contents(); ob_end_clean(); ?><?php if (trim($this->_smarty_vars['capture']['template_content'])): ?><?php if ($this->_tpl_vars['auth']['area'] == 'A'): ?><span class="cm-template-box" template="blocks/static_templates/logo.tpl" id="<?php echo smarty_function_set_id(array('name' => "blocks/static_templates/logo.tpl"), $this);?>
"><img class="cm-template-icon hidden" src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/layout_edit.gif" width="16" height="16" alt="" /><?php echo $this->_smarty_vars['capture']['template_content']; ?>
<!--[/tpl_id]--></span><?php else: ?><?php echo $this->_smarty_vars['capture']['template_content']; ?>
<?php endif; ?><?php endif; ?><?php  ob_end_flush();  ?>