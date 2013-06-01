<?php /* Smarty version 2.6.18, created on 2013-06-01 19:33:02
         compiled from C:/wamp5/www/dutchme2/skins/basic/customer/blocks/html_block.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'unescape', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/html_block.tpl', 1, false),)), $this); ?>
<?php  ob_start();  ?><div class="wysiwyg-content"><?php echo smarty_modifier_unescape($this->_tpl_vars['content']); ?>
</div><?php  ob_end_flush();  ?>