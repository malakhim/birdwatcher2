<?php /* Smarty version 2.6.18, created on 2014-06-04 13:45:16
         compiled from C:/wamp5/www/dutchme2/skins/basic/customer/addons/billibuys/blocks/static_templates/frontpage_top_links.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_url', 'C:/wamp5/www/dutchme2/skins/basic/customer/addons/billibuys/blocks/static_templates/frontpage_top_links.tpl', 11, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('about','testimonials','contact_us','log_in','register'));
?>
<?php  ob_start();  ?>
<link href="<?php echo $this->_tpl_vars['config']['skin_path']; ?>
/css/960/960_old.css" rel="stylesheet" type="text/css" />

<?php echo '
<script src="addons/billibuys/js/home.js" type="text/javascript"></script>
'; ?>


<div id="background_img"><img src="images/billibuys_header.jpg"></div>

<a href="<?php echo fn_url('pages.view&page_id=2'); ?>
"><span class="alpha grid_2 text_link">
	<?php echo fn_get_lang_var('about', $this->getLanguage()); ?>

</span></a>

<!-- <div class="grid_3 text_link">
	<?php echo fn_get_lang_var('testimonials', $this->getLanguage()); ?>

</div> -->

<a href="<?php echo fn_url('pages.view&page_id=30'); ?>
"><span class="grid_3 flat_link red contact-link">
	<?php echo fn_get_lang_var('contact_us', $this->getLanguage()); ?>

</span></a>

<a href="<?php echo fn_url('auth.login_form'); ?>
"><span class="omega grid_4 flat_link grey login-link">
	<?php echo fn_get_lang_var('log_in', $this->getLanguage()); ?>
/<?php echo fn_get_lang_var('register', $this->getLanguage()); ?>

</span></a><?php  ob_end_flush();  ?>