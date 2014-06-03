<?php /* Smarty version 2.6.18, created on 2014-06-03 11:32:15
         compiled from C:/wamp5/www/dutchme2/skins/basic/customer/addons/billibuys/blocks/static_templates/about_billibuys_block.tpl */ ?>
<?php
fn_preload_lang_vars(array('about','about_line_1','about_line_2','about_line_3','about_line_4','were_here_to_introduce_text','find_out_how'));
?>
<?php  ob_start();  ?><div class="about_heading"><?php echo fn_get_lang_var('about', $this->getLanguage()); ?>
 <span class="billibuys_coloured_1">Billi</span><span class="billibuys_coloured_2">Buys</span></div>

<div id="billibuys_about_text">
	<br/> 
	<?php echo fn_get_lang_var('about_line_1', $this->getLanguage()); ?>
<br/>
	<?php echo fn_get_lang_var('about_line_2', $this->getLanguage()); ?>
<br/>
	<?php echo fn_get_lang_var('about_line_3', $this->getLanguage()); ?>
<br/>
	<?php echo fn_get_lang_var('about_line_4', $this->getLanguage()); ?>
<br/>
	<div class="about_line_5 bottom">
		<?php echo fn_get_lang_var('were_here_to_introduce_text', $this->getLanguage()); ?>

	</div><br/>
 	<div class="find_out_how_subbtn">
		<?php echo fn_get_lang_var('find_out_how', $this->getLanguage()); ?>

	</div>
</div><?php  ob_end_flush();  ?>