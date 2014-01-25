<?php /* Smarty version 2.6.18, created on 2014-01-25 13:28:44
         compiled from C:/wamp5/www/dutchme2/skins/basic/customer/addons/billibuys/blocks/static_templates/billibuys_home_slider.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'trim', 'C:/wamp5/www/dutchme2/skins/basic/customer/addons/billibuys/blocks/static_templates/billibuys_home_slider.tpl', 99, false),array('function', 'set_id', 'C:/wamp5/www/dutchme2/skins/basic/customer/addons/billibuys/blocks/static_templates/billibuys_home_slider.tpl', 99, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('for_the_buyers','step','request_a_product','step_1_buyer','step_1_buyer','for_the_buyers','step','get_bids','step_2_buyer','step_1_buyer','for_the_buyers','step','purchase_items','step_3_buyer','step_1_buyer','for_the_sellers','step','step_1_seller','step_1_buyer','for_the_sellers','step','step_2_seller','step_1_buyer','for_the_sellers','step','step_3_seller','step_1_buyer','for_the_sellers','step','step_4_seller','step_1_buyer','register'));
?>
<?php  ob_start();  ?><?php ob_start(); ?>
<script type="text/javascript" src="js/modernizr.custom.28468.js"></script>
<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script> -->
<script type="text/javascript" src="js/jquery.cslider.js"></script>

<link rel="stylesheet" type="text/css" href="css/style.css" />


<div id="da-slider" class="da-slider buyerslider">

	<div class="da-slide">
		<h2><?php echo fn_get_lang_var('for_the_buyers', $this->getLanguage()); ?>
</h2>
		<p><?php echo fn_get_lang_var('step', $this->getLanguage()); ?>
 1 <?php echo fn_get_lang_var('request_a_product', $this->getLanguage()); ?>
</p>
		<span class="slide-body"><?php echo fn_get_lang_var('step_1_buyer', $this->getLanguage()); ?>
</span>
		<!-- <p><?php echo fn_get_lang_var('step_1_buyer', $this->getLanguage()); ?>
</p> -->
		<div class="da-img">
			<img src="http://placekitten.com/350/250" />
		</div>
	</div>

	<div class="da-slide">
		<h2><?php echo fn_get_lang_var('for_the_buyers', $this->getLanguage()); ?>
</h2>
		<p><?php echo fn_get_lang_var('step', $this->getLanguage()); ?>
 2 <?php echo fn_get_lang_var('get_bids', $this->getLanguage()); ?>
</p>
		<span class="slide-body"><?php echo fn_get_lang_var('step_2_buyer', $this->getLanguage()); ?>
</span>
		<!-- <p><?php echo fn_get_lang_var('step_1_buyer', $this->getLanguage()); ?>
</p> -->
		<div class="da-img">
			<img src="http://placekitten.com/350/250" />
		</div>
	</div>

	<div class="da-slide">
		<h2><?php echo fn_get_lang_var('for_the_buyers', $this->getLanguage()); ?>
</h2>
		<p><?php echo fn_get_lang_var('step', $this->getLanguage()); ?>
 3 <?php echo fn_get_lang_var('purchase_items', $this->getLanguage()); ?>
</p>
		<span class="slide-body"><?php echo fn_get_lang_var('step_3_buyer', $this->getLanguage()); ?>
</span>
		<!-- <p><?php echo fn_get_lang_var('step_1_buyer', $this->getLanguage()); ?>
</p> -->
		<div class="da-img">
			<img src="http://placekitten.com/350/250" />
		</div>
	</div>

	<nav class="da-arrows">
        <span class="da-arrows-prev"></span>
        <span class="da-arrows-next"></span>
    </nav>

</div>

<div id="da-slider" class="da-slider sellerslider">

	<div class="da-slide">
		<h2><?php echo fn_get_lang_var('for_the_sellers', $this->getLanguage()); ?>
</h2>
		<p><?php echo fn_get_lang_var('step', $this->getLanguage()); ?>
 1</p>
		<span class="slide-body"><?php echo fn_get_lang_var('step_1_seller', $this->getLanguage()); ?>
</span>
		<!-- <p><?php echo fn_get_lang_var('step_1_buyer', $this->getLanguage()); ?>
</p> -->
		<div class="da-img">
			<img src="http://placekitten.com/350/250" />
		</div>
	</div>

	<div class="da-slide">
		<h2><?php echo fn_get_lang_var('for_the_sellers', $this->getLanguage()); ?>
</h2>
		<p><?php echo fn_get_lang_var('step', $this->getLanguage()); ?>
 2</p>
		<span class="slide-body"><?php echo fn_get_lang_var('step_2_seller', $this->getLanguage()); ?>
</span>
		<!-- <p><?php echo fn_get_lang_var('step_1_buyer', $this->getLanguage()); ?>
</p> -->
		<div class="da-img">
			<img src="http://placekitten.com/350/250" />
		</div>
	</div>

	<div class="da-slide">
		<h2><?php echo fn_get_lang_var('for_the_sellers', $this->getLanguage()); ?>
</h2>
		<p><?php echo fn_get_lang_var('step', $this->getLanguage()); ?>
 3</p>
		<span class="slide-body"><?php echo fn_get_lang_var('step_3_seller', $this->getLanguage()); ?>
</span>
		<!-- <p><?php echo fn_get_lang_var('step_1_buyer', $this->getLanguage()); ?>
</p> -->
		<div class="da-img">
			<img src="http://placekitten.com/350/250" />
		</div>
	</div>

	<div class="da-slide">
		<h2><?php echo fn_get_lang_var('for_the_sellers', $this->getLanguage()); ?>
</h2>
		<p><?php echo fn_get_lang_var('step', $this->getLanguage()); ?>
 4</p>
		<span class="slide-body"><?php echo fn_get_lang_var('step_4_seller', $this->getLanguage()); ?>
</span>
		<!-- <p><?php echo fn_get_lang_var('step_1_buyer', $this->getLanguage()); ?>
</p> -->
		<div class="da-img">
			<img src="http://placekitten.com/350/250" />
		</div>
	</div>	

	<nav class="da-arrows">
        <span class="da-arrows-prev"></span>
        <span class="da-arrows-next"></span>
    </nav>
</div>

<div class="register_btn">
	<?php echo fn_get_lang_var('register', $this->getLanguage()); ?>

</div><?php $this->_smarty_vars['capture']['template_content'] = ob_get_contents(); ob_end_clean(); ?><?php if (trim($this->_smarty_vars['capture']['template_content'])): ?><?php if ($this->_tpl_vars['auth']['area'] == 'A'): ?><span class="cm-template-box" template="addons/billibuys/blocks/static_templates/billibuys_home_slider.tpl" id="<?php echo smarty_function_set_id(array('name' => "addons/billibuys/blocks/static_templates/billibuys_home_slider.tpl"), $this);?>
"><img class="cm-template-icon hidden" src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/layout_edit.gif" width="16" height="16" alt="" /><?php echo $this->_smarty_vars['capture']['template_content']; ?>
<!--[/tpl_id]--></span><?php else: ?><?php echo $this->_smarty_vars['capture']['template_content']; ?>
<?php endif; ?><?php endif; ?><?php  ob_end_flush();  ?>