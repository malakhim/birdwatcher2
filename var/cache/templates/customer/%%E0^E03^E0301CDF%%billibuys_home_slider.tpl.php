<?php /* Smarty version 2.6.18, created on 2014-03-06 15:46:32
         compiled from C:/wamp5/www/dutchme2/skins/basic/customer/addons/billibuys/blocks/static_templates/billibuys_home_slider.tpl */ ?>
<?php
fn_preload_lang_vars(array('for_the_buyers','step','request_a_product','step_1_buyer','step_1_buyer','for_the_buyers','step','get_bids','step_2_buyer','step_1_buyer','for_the_buyers','step','purchase_items','step_3_buyer','step_1_buyer','for_the_sellers','step','step_1_seller','step_1_buyer','for_the_sellers','step','step_2_seller','step_1_buyer','for_the_sellers','step','step_3_seller','step_1_buyer','for_the_sellers','step','step_4_seller','step_1_buyer','register_now_for_free'));
?>
<?php  ob_start();  ?>
<script type="text/javascript" src="js/modernizr.custom.28468.js"></script>
<script type="text/javascript" src="js/jquery-timing.min.js"></script>
<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script> -->
<script type="text/javascript" src="js/jquery.cslider.js"></script>

<link rel="stylesheet" type="text/css" href="css/style.css" />

<?php ob_start(); ?>
	<?php echo '
		$lang_group = {$lang_group}
		$step_subheading = {$step_subheading}
		$step_number = {$step_number}
	'; ?>

<?php $this->_smarty_vars['capture']['slide'] = ob_get_contents(); ob_end_clean(); ?> 

<div id="da-slider" class="da-slider buyerslider">

	<div class="da-slide">
		<h2><?php echo fn_get_lang_var('for_the_buyers', $this->getLanguage()); ?>
</h2>
		<p><?php echo fn_get_lang_var('step', $this->getLanguage()); ?>
 1 <?php echo fn_get_lang_var('request_a_product', $this->getLanguage()); ?>
</p>
		<span class="slide-body"><?php echo fn_get_lang_var('step_1_buyer', $this->getLanguage()); ?>
</span>

		<div class="da-img stickimg">
			<img src="http://placekitten.com/400/80" />
		</div>

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

		<div class="da-img stickimg">
			<img src="http://placekitten.com/400/80" />
		</div>

		<div class="da-img">
			<img src="http://placekitten.com/350/250" />
		</div>

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

		<div class="da-img stickimg">
			<img src="http://placekitten.com/400/80" />
		</div>

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

		<div class="da-img stickimg">
			<img src="http://placekitten.com/400/80" />
		</div>

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

		<div class="da-img stickimg">
			<img src="http://placekitten.com/400/80" />
		</div>

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

		<div class="da-img stickimg">
			<img src="http://placekitten.com/400/80" />
		</div>

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

		<div class="da-img stickimg">
			<img src="http://placekitten.com/400/80" />
		</div>
		
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
	<?php echo fn_get_lang_var('register_now_for_free', $this->getLanguage()); ?>
!
</div><?php  ob_end_flush();  ?>