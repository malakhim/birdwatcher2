<?php /* Smarty version 2.6.18, created on 2014-01-25 17:32:11
         compiled from C:/wamp5/www/dutchme2/skins/basic/customer/addons/billibuys/blocks/static_templates/billibuys_footer.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date', 'C:/wamp5/www/dutchme2/skins/basic/customer/addons/billibuys/blocks/static_templates/billibuys_footer.tpl', 3, false),array('modifier', 'fn_url', 'C:/wamp5/www/dutchme2/skins/basic/customer/addons/billibuys/blocks/static_templates/billibuys_footer.tpl', 4, false),array('modifier', 'trim', 'C:/wamp5/www/dutchme2/skins/basic/customer/addons/billibuys/blocks/static_templates/billibuys_footer.tpl', 9, false),array('function', 'set_id', 'C:/wamp5/www/dutchme2/skins/basic/customer/addons/billibuys/blocks/static_templates/billibuys_footer.tpl', 9, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('footer_copyright','terms_and_conditions','disclaimer'));
?>
<?php  ob_start();  ?><?php ob_start(); ?>
<?php echo date('Y'); ?>
 <?php echo fn_get_lang_var('footer_copyright', $this->getLanguage()); ?>
&nbsp; 
<a href="<?php echo fn_url('termsandconditions'); ?>
"><?php echo fn_get_lang_var('terms_and_conditions', $this->getLanguage()); ?>
</a>&nbsp;
<a href="<?php echo fn_url('disclaimer'); ?>
"><?php echo fn_get_lang_var('disclaimer', $this->getLanguage()); ?>
</a>&nbsp;
<i class="fa fa-facebook fa-2x"></i>&nbsp;&nbsp;
<i class="fa fa-twitter fa-2x"></i>&nbsp;&nbsp;
<i class="fa fa-pinterest fa-2x"></i>&nbsp;&nbsp;
<i class="fa fa-google-plus fa-2x"></i><?php $this->_smarty_vars['capture']['template_content'] = ob_get_contents(); ob_end_clean(); ?><?php if (trim($this->_smarty_vars['capture']['template_content'])): ?><?php if ($this->_tpl_vars['auth']['area'] == 'A'): ?><span class="cm-template-box" template="addons/billibuys/blocks/static_templates/billibuys_footer.tpl" id="<?php echo smarty_function_set_id(array('name' => "addons/billibuys/blocks/static_templates/billibuys_footer.tpl"), $this);?>
"><img class="cm-template-icon hidden" src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/layout_edit.gif" width="16" height="16" alt="" /><?php echo $this->_smarty_vars['capture']['template_content']; ?>
<!--[/tpl_id]--></span><?php else: ?><?php echo $this->_smarty_vars['capture']['template_content']; ?>
<?php endif; ?><?php endif; ?><?php  ob_end_flush();  ?>