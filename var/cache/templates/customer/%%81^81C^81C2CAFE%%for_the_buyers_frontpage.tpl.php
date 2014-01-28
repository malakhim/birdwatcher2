<?php /* Smarty version 2.6.18, created on 2014-01-28 18:23:57
         compiled from C:/wamp5/www/dutchme2/skins/basic/customer/addons/billibuys/blocks/static_templates/for_the_buyers_frontpage.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'trim', 'C:/wamp5/www/dutchme2/skins/basic/customer/addons/billibuys/blocks/static_templates/for_the_buyers_frontpage.tpl', 16, false),array('function', 'set_id', 'C:/wamp5/www/dutchme2/skins/basic/customer/addons/billibuys/blocks/static_templates/for_the_buyers_frontpage.tpl', 16, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('for_the_buyers','jumbotron_buyer_heading','jumbotron_buyer_subheading','learn_more'));
?>
<?php  ob_start();  ?><?php ob_start(); ?><div class="infobox_heading">
	<?php echo fn_get_lang_var('for_the_buyers', $this->getLanguage()); ?>

</div>
<br/>

<div class="infobox_subheading">
	<?php echo fn_get_lang_var('jumbotron_buyer_heading', $this->getLanguage()); ?>

</div>

<div class="infobox_text">
	<?php echo fn_get_lang_var('jumbotron_buyer_subheading', $this->getLanguage()); ?>
!
</div>

<div class="learn_more_box">
	<?php echo fn_get_lang_var('learn_more', $this->getLanguage()); ?>

</div><?php $this->_smarty_vars['capture']['template_content'] = ob_get_contents(); ob_end_clean(); ?><?php if (trim($this->_smarty_vars['capture']['template_content'])): ?><?php if ($this->_tpl_vars['auth']['area'] == 'A'): ?><span class="cm-template-box" template="addons/billibuys/blocks/static_templates/for_the_buyers_frontpage.tpl" id="<?php echo smarty_function_set_id(array('name' => "addons/billibuys/blocks/static_templates/for_the_buyers_frontpage.tpl"), $this);?>
"><img class="cm-template-icon hidden" src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/layout_edit.gif" width="16" height="16" alt="" /><?php echo $this->_smarty_vars['capture']['template_content']; ?>
<!--[/tpl_id]--></span><?php else: ?><?php echo $this->_smarty_vars['capture']['template_content']; ?>
<?php endif; ?><?php endif; ?><?php  ob_end_flush();  ?>