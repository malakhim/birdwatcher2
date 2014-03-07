<?php /* Smarty version 2.6.18, created on 2014-03-07 21:22:31
         compiled from C:/wamp5/www/dutchme2/skins/basic/customer/addons/billibuys/blocks/static_templates/billibuys_footer_logo.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_url', 'C:/wamp5/www/dutchme2/skins/basic/customer/addons/billibuys/blocks/static_templates/billibuys_footer_logo.tpl', 7, false),)), $this); ?>
<?php  ob_start();  ?><?php if (isset ( $_SESSION['auth']['user_id'] ) && $_SESSION['auth']['user_id'] != 0): ?>
	<?php $this->assign('home_href', "billibuys.view", false); ?>
<?php else: ?>
	<?php $this->assign('home_href', "", false); ?>
<?php endif; ?>

<a href="<?php echo fn_url($this->_tpl_vars['home_href']); ?>
"><img src="images/billibuys_logo_white.png" id="billibuys_footer_logo" width="180px"></a><?php  ob_end_flush();  ?>