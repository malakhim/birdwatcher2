<?php /* Smarty version 2.6.18, created on 2014-01-25 19:04:01
         compiled from C:/wamp5/www/dutchme2/skins/basic/customer/addons/billibuys/blocks/static_templates/how_it_works_header_scroll.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'trim', 'C:/wamp5/www/dutchme2/skins/basic/customer/addons/billibuys/blocks/static_templates/how_it_works_header_scroll.tpl', 14, false),array('function', 'set_id', 'C:/wamp5/www/dutchme2/skins/basic/customer/addons/billibuys/blocks/static_templates/how_it_works_header_scroll.tpl', 14, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('how_does_billibuys_work_for','buyers','sellers'));
?>
<?php  ob_start();  ?><?php ob_start(); ?>
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
<?php $this->_smarty_vars['capture']['template_content'] = ob_get_contents(); ob_end_clean(); ?><?php if (trim($this->_smarty_vars['capture']['template_content'])): ?><?php if ($this->_tpl_vars['auth']['area'] == 'A'): ?><span class="cm-template-box" template="addons/billibuys/blocks/static_templates/how_it_works_header_scroll.tpl" id="<?php echo smarty_function_set_id(array('name' => "addons/billibuys/blocks/static_templates/how_it_works_header_scroll.tpl"), $this);?>
"><img class="cm-template-icon hidden" src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/layout_edit.gif" width="16" height="16" alt="" /><?php echo $this->_smarty_vars['capture']['template_content']; ?>
<!--[/tpl_id]--></span><?php else: ?><?php echo $this->_smarty_vars['capture']['template_content']; ?>
<?php endif; ?><?php endif; ?><?php  ob_end_flush();  ?>