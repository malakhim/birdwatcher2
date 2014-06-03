<?php /* Smarty version 2.6.18, created on 2014-06-01 06:30:49
         compiled from views/auth/login_form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_url', 'views/auth/login_form.tpl', 3, false),array('modifier', 'truncate', 'views/auth/login_form.tpl', 3, false),array('modifier', 'default', 'views/auth/login_form.tpl', 7, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('administration_panel','email','username','password','forgot_password_question'));
?>
<div class="login-wrap">
<h1 class="clear">
	<a href="<?php echo fn_url($this->_tpl_vars['index_script']); ?>
" class="float-left"><?php echo smarty_modifier_truncate($this->_tpl_vars['settings']['Company']['company_name'], 40, '...', true); ?>
</a>
	<span><?php echo fn_get_lang_var('administration_panel', $this->getLanguage()); ?>
</span>
</h1>
<form action="<?php echo $this->_tpl_vars['config']['current_location']; ?>
/<?php echo $this->_tpl_vars['index_script']; ?>
" method="post" name="main_login_form" class="cm-form-highlight cm-skip-check-items">
<input type="hidden" name="return_url" value="<?php echo smarty_modifier_default(@$this->_tpl_vars['_REQUEST']['return_url'], @$this->_tpl_vars['index_script']); ?>
" />



<div class="login-content">
	<div class="clear-form-field">
		<p><label for="username" class="cm-required <?php if ($this->_tpl_vars['settings']['General']['use_email_as_login'] == 'Y'): ?>cm-email<?php endif; ?>"><?php if ($this->_tpl_vars['settings']['General']['use_email_as_login'] == 'Y'): ?><?php echo fn_get_lang_var('email', $this->getLanguage()); ?>
<?php else: ?><?php echo fn_get_lang_var('username', $this->getLanguage()); ?>
<?php endif; ?>:</label></p>
		<input id="username" type="text" name="user_login" size="20" value="<?php echo $this->_tpl_vars['config']['demo_username']; ?>
" class="input-text cm-focus" tabindex="1" />
	</div>
	<div class="clear-form-field">
		<p><label for="password" class="cm-required"><?php echo fn_get_lang_var('password', $this->getLanguage()); ?>
:</label></p>
		<input type="password" id="password" name="password" size="20" value="<?php echo $this->_tpl_vars['config']['demo_password']; ?>
" class="input-text" tabindex="2" maxlength="32" />
	</div>
	<div class="buttons-container nowrap">
		<div class="float-left">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/sign_in.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[auth.login]",'but_role' => 'button_main','tabindex' => '3')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>

		<div class="float-right">
			<a href="<?php echo fn_url("auth.recover_password"); ?>
" class="underlined"><?php echo fn_get_lang_var('forgot_password_question', $this->getLanguage()); ?>
</a>
		</div>
	</div>
</div>
</form>
</div>