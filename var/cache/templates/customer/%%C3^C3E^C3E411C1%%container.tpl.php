<?php /* Smarty version 2.6.18, created on 2014-01-21 22:56:44
         compiled from C:/wamp5/www/dutchme2/skins/basic/customer/views/block_manager/render/container.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'trim', 'C:/wamp5/www/dutchme2/skins/basic/customer/views/block_manager/render/container.tpl', 4, false),array('function', 'set_id', 'C:/wamp5/www/dutchme2/skins/basic/customer/views/block_manager/render/container.tpl', 4, false),)), $this); ?>
<?php  ob_start();  ?><?php ob_start(); ?><div class="container_<?php echo $this->_tpl_vars['container']['width']; ?>
 <?php echo $this->_tpl_vars['container']['user_class']; ?>
">	
	<?php echo $this->_tpl_vars['content']; ?>

	<div class="clear"></div>
</div><?php $this->_smarty_vars['capture']['template_content'] = ob_get_contents(); ob_end_clean(); ?><?php if (trim($this->_smarty_vars['capture']['template_content'])): ?><?php if ($this->_tpl_vars['auth']['area'] == 'A'): ?><span class="cm-template-box" template="views/block_manager/render/container.tpl" id="<?php echo smarty_function_set_id(array('name' => "views/block_manager/render/container.tpl"), $this);?>
"><img class="cm-template-icon hidden" src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/layout_edit.gif" width="16" height="16" alt="" /><?php echo $this->_smarty_vars['capture']['template_content']; ?>
<!--[/tpl_id]--></span><?php else: ?><?php echo $this->_smarty_vars['capture']['template_content']; ?>
<?php endif; ?><?php endif; ?><?php  ob_end_flush();  ?>