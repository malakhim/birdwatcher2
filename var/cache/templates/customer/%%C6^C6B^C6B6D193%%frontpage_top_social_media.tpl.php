<?php /* Smarty version 2.6.18, created on 2014-01-31 21:37:45
         compiled from C:/wamp5/www/dutchme2/skins/basic/customer/addons/billibuys/blocks/static_templates/frontpage_top_social_media.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'trim', 'C:/wamp5/www/dutchme2/skins/basic/customer/addons/billibuys/blocks/static_templates/frontpage_top_social_media.tpl', 8, false),array('function', 'set_id', 'C:/wamp5/www/dutchme2/skins/basic/customer/addons/billibuys/blocks/static_templates/frontpage_top_social_media.tpl', 8, false),)), $this); ?>
<?php  ob_start();  ?><?php ob_start(); ?>
<link rel="stylesheet" href="css/font-awesome.min.css">

<a href="http://www.facebook.com/billibuys"><i class="fa fa-facebook fa-2x"></i></a>&nbsp;&nbsp;
<i class="fa fa-twitter fa-2x"></i>&nbsp;&nbsp;
<i class="fa fa-pinterest fa-2x"></i>&nbsp;&nbsp;
<i class="fa fa-google-plus fa-2x"></i><?php $this->_smarty_vars['capture']['template_content'] = ob_get_contents(); ob_end_clean(); ?><?php if (trim($this->_smarty_vars['capture']['template_content'])): ?><?php if ($this->_tpl_vars['auth']['area'] == 'A'): ?><span class="cm-template-box" template="addons/billibuys/blocks/static_templates/frontpage_top_social_media.tpl" id="<?php echo smarty_function_set_id(array('name' => "addons/billibuys/blocks/static_templates/frontpage_top_social_media.tpl"), $this);?>
"><img class="cm-template-icon hidden" src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/layout_edit.gif" width="16" height="16" alt="" /><?php echo $this->_smarty_vars['capture']['template_content']; ?>
<!--[/tpl_id]--></span><?php else: ?><?php echo $this->_smarty_vars['capture']['template_content']; ?>
<?php endif; ?><?php endif; ?><?php  ob_end_flush();  ?>