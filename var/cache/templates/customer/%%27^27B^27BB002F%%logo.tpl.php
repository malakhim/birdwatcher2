<?php /* Smarty version 2.6.18, created on 2014-06-04 13:35:01
         compiled from C:/wamp5/www/dutchme2/skins/basic/customer/addons/billibuys/blocks/static_templates/logo.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_url', 'C:/wamp5/www/dutchme2/skins/basic/customer/addons/billibuys/blocks/static_templates/logo.tpl', 8, false),)), $this); ?>
<?php  ob_start();  ?><div class="logo-container">
	<?php if (isset ( $_SESSION['auth']['user_id'] ) && $_SESSION['auth']['user_id'] != 0): ?>
		<?php $this->assign('home_href', "billibuys.view", false); ?>
	<?php else: ?>
		<?php $this->assign('home_href', "", false); ?>
	<?php endif; ?>
	<a href="<?php echo fn_url($this->_tpl_vars['home_href']); ?>
" style="background: url('<?php echo $this->_tpl_vars['images_dir']; ?>
/logo_1.png') no-repeat; width:360px; height:112px;" title="<?php echo $this->_tpl_vars['manifest']['Customer_logo']['alt']; ?>
" class="logo"></a>
</div><?php  ob_end_flush();  ?>