<?php /* Smarty version 2.6.18, created on 2014-01-25 16:30:45
         compiled from C:/wamp5/www/dutchme2/skins/basic/customer/views/block_manager/render/block.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'unescape', 'C:/wamp5/www/dutchme2/skins/basic/customer/views/block_manager/render/block.tpl', 5, false),array('modifier', 'trim', 'C:/wamp5/www/dutchme2/skins/basic/customer/views/block_manager/render/block.tpl', 8, false),array('function', 'set_id', 'C:/wamp5/www/dutchme2/skins/basic/customer/views/block_manager/render/block.tpl', 8, false),)), $this); ?>
<?php  ob_start();  ?><?php ob_start(); ?><?php if ($this->_tpl_vars['block']['user_class'] || $this->_tpl_vars['content_alignment'] == 'RIGHT' || $this->_tpl_vars['content_alignment'] == 'LEFT'): ?>
	<div class="<?php if ($this->_tpl_vars['block']['user_class']): ?> <?php echo $this->_tpl_vars['block']['user_class']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['content_alignment'] == 'RIGHT'): ?> float-right<?php elseif ($this->_tpl_vars['content_alignment'] == 'LEFT'): ?>
	float-left<?php endif; ?>">
<?php endif; ?>
		<?php echo smarty_modifier_unescape($this->_tpl_vars['content']); ?>

<?php if ($this->_tpl_vars['block']['user_class'] || $this->_tpl_vars['content_alignment'] == 'RIGHT' || $this->_tpl_vars['content_alignment'] == 'LEFT'): ?>
	</div>
<?php endif; ?><?php $this->_smarty_vars['capture']['template_content'] = ob_get_contents(); ob_end_clean(); ?><?php if (trim($this->_smarty_vars['capture']['template_content'])): ?><?php if ($this->_tpl_vars['auth']['area'] == 'A'): ?><span class="cm-template-box" template="views/block_manager/render/block.tpl" id="<?php echo smarty_function_set_id(array('name' => "views/block_manager/render/block.tpl"), $this);?>
"><img class="cm-template-icon hidden" src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/layout_edit.gif" width="16" height="16" alt="" /><?php echo $this->_smarty_vars['capture']['template_content']; ?>
<!--[/tpl_id]--></span><?php else: ?><?php echo $this->_smarty_vars['capture']['template_content']; ?>
<?php endif; ?><?php endif; ?><?php  ob_end_flush();  ?>