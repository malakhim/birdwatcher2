<?php /* Smarty version 2.6.18, created on 2014-01-21 22:56:43
         compiled from addons/gift_registry/hooks/profiles/my_account_menu.post.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_url', 'addons/gift_registry/hooks/profiles/my_account_menu.post.tpl', 1, false),array('modifier', 'trim', 'addons/gift_registry/hooks/profiles/my_account_menu.post.tpl', 1, false),array('function', 'set_id', 'addons/gift_registry/hooks/profiles/my_account_menu.post.tpl', 1, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('events'));
?>
<?php  ob_start();  ?><?php ob_start(); ?><li><a href="<?php echo fn_url("events.search"); ?>
" rel="nofollow"><?php echo fn_get_lang_var('events', $this->getLanguage()); ?>
</a></li><?php $this->_smarty_vars['capture']['template_content'] = ob_get_contents(); ob_end_clean(); ?><?php if (trim($this->_smarty_vars['capture']['template_content'])): ?><?php if ($this->_tpl_vars['auth']['area'] == 'A'): ?><span class="cm-template-box" template="addons/gift_registry/hooks/profiles/my_account_menu.post.tpl" id="<?php echo smarty_function_set_id(array('name' => "addons/gift_registry/hooks/profiles/my_account_menu.post.tpl"), $this);?>
"><img class="cm-template-icon hidden" src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/layout_edit.gif" width="16" height="16" alt="" /><?php echo $this->_smarty_vars['capture']['template_content']; ?>
<!--[/tpl_id]--></span><?php else: ?><?php echo $this->_smarty_vars['capture']['template_content']; ?>
<?php endif; ?><?php endif; ?><?php  ob_end_flush();  ?>