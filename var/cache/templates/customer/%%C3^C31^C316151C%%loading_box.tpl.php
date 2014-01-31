<?php /* Smarty version 2.6.18, created on 2014-01-28 18:26:58
         compiled from common_templates/loading_box.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'trim', 'common_templates/loading_box.tpl', 4, false),array('function', 'set_id', 'common_templates/loading_box.tpl', 4, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('loading'));
?>
<?php  ob_start();  ?><?php ob_start(); ?>
<div id="ajax_loading_box" class="ajax-loading-box"><div id="ajax_loading_message" class="ajax-inner-loading-box"><?php echo fn_get_lang_var('loading', $this->getLanguage()); ?>
</div></div>
<?php $this->_smarty_vars['capture']['template_content'] = ob_get_contents(); ob_end_clean(); ?><?php if (trim($this->_smarty_vars['capture']['template_content'])): ?><?php if ($this->_tpl_vars['auth']['area'] == 'A'): ?><span class="cm-template-box" template="common_templates/loading_box.tpl" id="<?php echo smarty_function_set_id(array('name' => "common_templates/loading_box.tpl"), $this);?>
"><img class="cm-template-icon hidden" src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/layout_edit.gif" width="16" height="16" alt="" /><?php echo $this->_smarty_vars['capture']['template_content']; ?>
<!--[/tpl_id]--></span><?php else: ?><?php echo $this->_smarty_vars['capture']['template_content']; ?>
<?php endif; ?><?php endif; ?><?php  ob_end_flush();  ?>