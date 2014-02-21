<?php /* Smarty version 2.6.18, created on 2014-02-21 13:39:14
         compiled from C:/wamp5/www/dutchme2/skins/basic/customer/addons/billibuys/blocks/static_templates/frontpage_top_links.tpl */ ?>
<?php
fn_preload_lang_vars(array('about','testimonials','contact_us','log_in','register'));
?>
<?php  ob_start();  ?>
<?php echo '
<script src="addons/billibuys/js/home.js" type="text/javascript"></script>
'; ?>


<div id="background_img"><img src="images/billibuys_header.jpg"></div>

<div class="alpha grid_2 text_link">
	<?php echo fn_get_lang_var('about', $this->getLanguage()); ?>

</div>

<!-- <div class="grid_3 text_link">
	<?php echo fn_get_lang_var('testimonials', $this->getLanguage()); ?>

</div> -->

<div class="grid_3 flat_link red contact-link">
	<?php echo fn_get_lang_var('contact_us', $this->getLanguage()); ?>

</div>

<div class="omega grid_4 flat_link grey login-link">
	<?php echo fn_get_lang_var('log_in', $this->getLanguage()); ?>
/<?php echo fn_get_lang_var('register', $this->getLanguage()); ?>

</div><?php  ob_end_flush();  ?>