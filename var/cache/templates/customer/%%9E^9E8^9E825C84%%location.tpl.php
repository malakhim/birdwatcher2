<?php /* Smarty version 2.6.18, created on 2013-12-13 16:03:26
         compiled from C:/wamp5/www/dutchme2/skins/basic/customer/views/block_manager/render/location.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'htmlspecialchars_decode', 'C:/wamp5/www/dutchme2/skins/basic/customer/views/block_manager/render/location.tpl', 2, false),array('modifier', 'unescape', 'C:/wamp5/www/dutchme2/skins/basic/customer/views/block_manager/render/location.tpl', 2, false),array('modifier', 'defined', 'C:/wamp5/www/dutchme2/skins/basic/customer/views/block_manager/render/location.tpl', 15, false),array('modifier', 'fn_check_meta_redirect', 'C:/wamp5/www/dutchme2/skins/basic/customer/views/block_manager/render/location.tpl', 23, false),array('modifier', 'fn_url', 'C:/wamp5/www/dutchme2/skins/basic/customer/views/block_manager/render/location.tpl', 24, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('skin_by'));
?>
<?php  ob_start();  ?><div id="ci_top_wrapper" class="header clearfix">
	<?php echo smarty_modifier_unescape(htmlspecialchars_decode($this->_tpl_vars['containers']['top'])); ?>

<!--ci_top_wrapper--></div>
<div id="ci_central_wrapper" class="main clearfix">
	<?php echo smarty_modifier_unescape(htmlspecialchars_decode($this->_tpl_vars['containers']['central'])); ?>

<!--ci_central_wrapper--></div>
<div id="ci_bottom_wrapper" class="footer clearfix">
	<?php echo smarty_modifier_unescape(htmlspecialchars_decode($this->_tpl_vars['containers']['bottom'])); ?>

<!--ci_bottom_wrapper--></div>

<?php if ($this->_tpl_vars['manifest']['copyright']): ?>
<p class="bottom-copyright mini"><?php echo fn_get_lang_var('skin_by', $this->getLanguage()); ?>
&nbsp;<a href="<?php echo $this->_tpl_vars['manifest']['copyright_url']; ?>
"><?php echo $this->_tpl_vars['manifest']['copyright']; ?>
</a></p>
<?php endif; ?>

<?php if (defined('DEBUG_MODE')): ?>
<div class="bug-report">
	<input type="button" onclick="window.open('bug_report.php','popupwindow','width=700,height=450,toolbar=yes,status=no,scrollbars=yes,resizable=no,menubar=yes,location=no,direction=no');" value="Report a bug" />
</div>
<?php endif; ?>



<?php if (fn_check_meta_redirect($this->_tpl_vars['_REQUEST']['meta_redirect_url'])): ?>
	<meta http-equiv="refresh" content="1;url=<?php echo fn_url(fn_check_meta_redirect($this->_tpl_vars['_REQUEST']['meta_redirect_url'])); ?>
" />
<?php endif; ?><?php  ob_end_flush();  ?>