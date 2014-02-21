<?php /* Smarty version 2.6.18, created on 2014-02-21 13:39:14
         compiled from C:/wamp5/www/dutchme2/skins/basic/customer/addons/billibuys/blocks/static_templates/for_the_sellers_frontpage.tpl */ ?>
<?php
fn_preload_lang_vars(array('for_the_sellers','jumbotron_seller_heading','jumbotron_seller_subheading','learn_more'));
?>
<?php  ob_start();  ?><div class="infobox_heading">
	<?php echo fn_get_lang_var('for_the_sellers', $this->getLanguage()); ?>

</div>
<br/>

<div class="infobox_subheading">
	<?php echo fn_get_lang_var('jumbotron_seller_heading', $this->getLanguage()); ?>

</div>

<div class="infobox_text">
	<?php echo fn_get_lang_var('jumbotron_seller_subheading', $this->getLanguage()); ?>
!
</div>

<div class="learn_more_box">
	<?php echo fn_get_lang_var('learn_more', $this->getLanguage()); ?>

</div><?php  ob_end_flush();  ?>