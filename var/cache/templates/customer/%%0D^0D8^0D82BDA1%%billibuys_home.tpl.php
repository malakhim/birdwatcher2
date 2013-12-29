<?php /* Smarty version 2.6.18, created on 2013-12-29 11:22:46
         compiled from C:/wamp5/www/dutchme2/skins/basic/customer/addons/billibuys/blocks/static_templates/billibuys_home.tpl */ ?>
<?php
fn_preload_lang_vars(array('jumbotron_buyer_heading','jumbotron_buyer_subheading','learn_more_buyer','jumbotron_seller_heading','jumbotron_seller_subheading','learn_more_seller','how_does_billibuys_work','for_buyers','step','step_1_buyer','step','step_2_buyer','step','step_3_buyer','register_as_buyer'));
?>
<?php  ob_start();  ?><div class="container">
	<div class="panel panel-default" id="buyer_panel">
		<div class="panel_heading">
			<?php echo fn_get_lang_var('jumbotron_buyer_heading', $this->getLanguage()); ?>

		</div>
		<div class="panel_subheading"><?php echo fn_get_lang_var('jumbotron_buyer_subheading', $this->getLanguage()); ?>
</div>
		<button type="button" id="buyer_btn_lrn_more" class="btn btn-primary"><?php echo fn_get_lang_var('learn_more_buyer', $this->getLanguage()); ?>
</button>
	</div>

	<div class="panel panel-default" id="seller_panel">
		<div class="panel_heading">
			<?php echo fn_get_lang_var('jumbotron_seller_heading', $this->getLanguage()); ?>

		</div>
		<div class="panel_subheading"><?php echo fn_get_lang_var('jumbotron_seller_subheading', $this->getLanguage()); ?>
</div>
		<button type="button" id="seller_btn_lrn_more" class="btn btn-primary"><?php echo fn_get_lang_var('learn_more_seller', $this->getLanguage()); ?>
</button>
	</div>

	<div class="steps" id="buyer_steps">
		<div class="steps_heading"><?php echo fn_get_lang_var('how_does_billibuys_work', $this->getLanguage()); ?>
 <?php echo fn_get_lang_var('for_buyers', $this->getLanguage()); ?>
?</div>
		<div class="steps_images" id="buyer_step_images">
			<span id="buyer_step_img_1">
				<img src="http://placekitten.com/220/240" alt="Step 1"/>
			</span>

			<span id="buyer_step_img_2">
				<img src="http://placekitten.com/220/240" alt="Step 2"/>
			</span>
			<span id="buyer_step_img_3">
				<img src="http://placekitten.com/220/240"  alt="Step 3"/>
			</span>
		</div>
		<div class="steps_text">
			<div id="buyer_step_heading_1">
				<?php echo fn_get_lang_var('step', $this->getLanguage()); ?>
 1
			</div>
			<div id="buyer_step_text_1">
				<?php echo fn_get_lang_var('step_1_buyer', $this->getLanguage()); ?>

			</div>
		</div>

		<div class="steps_text">
			<div id="buyer_step_heading_2">
				<?php echo fn_get_lang_var('step', $this->getLanguage()); ?>
 2
			</div>
			<div id="buyer_step_text_2">
				<?php echo fn_get_lang_var('step_2_buyer', $this->getLanguage()); ?>

			</div>
		</div>

		<div class="steps_text">
			<div id="buyer_step_heading_3">
				<?php echo fn_get_lang_var('step', $this->getLanguage()); ?>
 3
			</div>
			<div id="buyer_step_text_3">
				<?php echo fn_get_lang_var('step_3_buyer', $this->getLanguage()); ?>

			</div>
		</div>

		<div class="cta">
			<button type="button" id="cta_buyer" class="btn btn-primary"><?php echo fn_get_lang_var('register_as_buyer', $this->getLanguage()); ?>
</button>
		</div>
	</div>


</div><?php  ob_end_flush();  ?>