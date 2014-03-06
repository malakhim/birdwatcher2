<?php /* Smarty version 2.6.18, created on 2014-03-07 09:01:50
         compiled from addons/billibuys/hooks/profiles/my_account_menu.override.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_url', 'addons/billibuys/hooks/profiles/my_account_menu.override.tpl', 11, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('profile_details'));
?>
<?php  ob_start();  ?><?php if ($this->_tpl_vars['auth']['user_id']): ?>
	<?php if ($this->_tpl_vars['user_info']['firstname'] || $this->_tpl_vars['user_info']['lastname']): ?>
		<li class="user-name"><?php echo $this->_tpl_vars['user_info']['firstname']; ?>
 <?php echo $this->_tpl_vars['user_info']['lastname']; ?>
</li>
	<?php else: ?>
		<?php if ($this->_tpl_vars['settings']['General']['use_email_as_login'] == 'Y'): ?>
			<li class="user-name"><?php echo $this->_tpl_vars['user_info']['email']; ?>
</li>
		<?php else: ?>
			<li class="user-name"><?php echo $this->_tpl_vars['user_info']['user_login']; ?>
</li>
		<?php endif; ?>
	<?php endif; ?>
	<li><a href="<?php echo fn_url("profiles.update"); ?>
" rel="nofollow" class="underlined"><?php echo fn_get_lang_var('profile_details', $this->getLanguage()); ?>
</a></li>
<?php elseif ($this->_tpl_vars['user_data']['firstname'] || $this->_tpl_vars['user_data']['lastname']): ?>
	<li class="user-name"><?php echo $this->_tpl_vars['user_data']['firstname']; ?>
 <?php echo $this->_tpl_vars['user_data']['lastname']; ?>
</li>
<?php elseif ($this->_tpl_vars['settings']['General']['use_email_as_login'] == 'Y' && $this->_tpl_vars['user_data']['email']): ?>
	<li class="user-name"><?php echo $this->_tpl_vars['user_data']['email']; ?>
</li>
<?php elseif ($this->_tpl_vars['settings']['General']['use_email_as_login'] != 'Y' && $this->_tpl_vars['user_data']['user_login']): ?>
	<li class="user-name"><?php echo $this->_tpl_vars['user_data']['user_login']; ?>
</li>
<?php endif; ?><?php  ob_end_flush();  ?>