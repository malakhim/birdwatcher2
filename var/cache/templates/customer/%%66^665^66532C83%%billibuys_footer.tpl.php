<?php /* Smarty version 2.6.18, created on 2014-03-07 19:27:29
         compiled from C:/wamp5/www/dutchme2/skins/basic/customer/addons/billibuys/blocks/static_templates/billibuys_footer.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date', 'C:/wamp5/www/dutchme2/skins/basic/customer/addons/billibuys/blocks/static_templates/billibuys_footer.tpl', 5, false),array('modifier', 'fn_url', 'C:/wamp5/www/dutchme2/skins/basic/customer/addons/billibuys/blocks/static_templates/billibuys_footer.tpl', 6, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('footer_copyright','terms_and_conditions','disclaimer'));
?>
<?php  ob_start();  ?>
<link rel="stylesheet" href="css/font-awesome.min.css">

<?php echo date('Y'); ?>
 &copy; <?php echo fn_get_lang_var('footer_copyright', $this->getLanguage()); ?>
&nbsp; 
<a href="<?php echo fn_url('termsandconditions'); ?>
"><?php echo fn_get_lang_var('terms_and_conditions', $this->getLanguage()); ?>
</a>
<a href="<?php echo fn_url('disclaimer'); ?>
"><?php echo fn_get_lang_var('disclaimer', $this->getLanguage()); ?>
</a> &nbsp;
<a href="http://www.facebook.com/billibuys"><i class="fa fa-facebook fa-2x"></i></a>&nbsp;&nbsp;
<i class="fa fa-twitter fa-2x"></i>&nbsp;&nbsp;
<i class="fa fa-pinterest fa-2x"></i>&nbsp;&nbsp;
<i class="fa fa-google-plus fa-2x"></i><?php  ob_end_flush();  ?>