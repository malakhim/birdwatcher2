<?php /* Smarty version 2.6.18, created on 2014-03-07 12:45:29
         compiled from C:/wamp5/www/dutchme2/skins/basic/customer/views/block_manager/render/block.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'unescape', 'C:/wamp5/www/dutchme2/skins/basic/customer/views/block_manager/render/block.tpl', 5, false),)), $this); ?>
<?php  ob_start();  ?><?php if ($this->_tpl_vars['block']['user_class'] || $this->_tpl_vars['content_alignment'] == 'RIGHT' || $this->_tpl_vars['content_alignment'] == 'LEFT'): ?>
	<div class="<?php if ($this->_tpl_vars['block']['user_class']): ?> <?php echo $this->_tpl_vars['block']['user_class']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['content_alignment'] == 'RIGHT'): ?> float-right<?php elseif ($this->_tpl_vars['content_alignment'] == 'LEFT'): ?>
	float-left<?php endif; ?>">
<?php endif; ?>
		<?php echo smarty_modifier_unescape($this->_tpl_vars['content']); ?>

<?php if ($this->_tpl_vars['block']['user_class'] || $this->_tpl_vars['content_alignment'] == 'RIGHT' || $this->_tpl_vars['content_alignment'] == 'LEFT'): ?>
	</div>
<?php endif; ?><?php  ob_end_flush();  ?>