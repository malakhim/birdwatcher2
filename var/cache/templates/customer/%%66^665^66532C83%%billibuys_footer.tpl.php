<?php /* Smarty version 2.6.18, created on 2014-06-01 06:30:05
         compiled from C:/wamp5/www/dutchme2/skins/basic/customer/addons/billibuys/blocks/static_templates/billibuys_footer.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date', 'C:/wamp5/www/dutchme2/skins/basic/customer/addons/billibuys/blocks/static_templates/billibuys_footer.tpl', 3, false),array('modifier', 'fn_url', 'C:/wamp5/www/dutchme2/skins/basic/customer/addons/billibuys/blocks/static_templates/billibuys_footer.tpl', 4, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('footer_copyright','terms_and_conditions','disclaimer'));
?>
<?php  ob_start();  ?>
<?php echo date('Y'); ?>
 &copy; <?php echo fn_get_lang_var('footer_copyright', $this->getLanguage()); ?>
&nbsp; 
<a href="<?php echo fn_url('termsandconditions'); ?>
"><?php echo fn_get_lang_var('terms_and_conditions', $this->getLanguage()); ?>
</a>
<a href="<?php echo fn_url('disclaimer'); ?>
"><?php echo fn_get_lang_var('disclaimer', $this->getLanguage()); ?>
</a> &nbsp;
<?php  ob_end_flush();  ?>