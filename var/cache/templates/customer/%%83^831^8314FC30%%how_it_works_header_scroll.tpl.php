<?php /* Smarty version 2.6.18, created on 2014-02-21 13:57:24
         compiled from C:/wamp5/www/dutchme2/skins/basic/customer/addons/billibuys/blocks/static_templates/how_it_works_header_scroll.tpl */ ?>
<?php
fn_preload_lang_vars(array('how_does_billibuys_work_for','buyers','sellers'));
?>
<?php  ob_start();  ?>
<?php echo '
<script src="addons/billibuys/js/jquery.vticker.min.js" type="text/javascript"></script>
'; ?>


<div id="how_does_it_work_text"><?php echo fn_get_lang_var('how_does_billibuys_work_for', $this->getLanguage()); ?>
</div>
<div id="how_does_it_work_scroller">
	<ul>
		<li><?php echo fn_get_lang_var('buyers', $this->getLanguage()); ?>
?</li>
		<li><span style="color:rgb(232,34,191)"><?php echo fn_get_lang_var('sellers', $this->getLanguage()); ?>
?</span></li>
	</ul>
</div>
<?php  ob_end_flush();  ?>