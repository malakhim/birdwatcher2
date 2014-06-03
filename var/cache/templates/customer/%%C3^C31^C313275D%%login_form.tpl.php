<?php /* Smarty version 2.6.18, created on 2014-06-01 06:30:05
         compiled from views/auth/login_form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'views/auth/login_form.tpl', 16, false),array('modifier', 'fn_url', 'views/auth/login_form.tpl', 23, false),array('modifier', 'fn_needs_image_verification', 'views/auth/login_form.tpl', 40, false),array('modifier', 'uniqid', 'views/auth/login_form.tpl', 43, false),array('block', 'hook', 'views/auth/login_form.tpl', 63, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('returning_customer','email','username','password','forgot_password_question','image_verification_label','image_verification_body','remember_me','sign_in'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'addons/billibuys/hooks/index/login_buttons.post.tpl' => 1401568196,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php $this->assign('form_name', smarty_modifier_default(@$this->_tpl_vars['form_name'], 'main_login_form'), false); ?>

<?php ob_start(); ?>
<?php if ($this->_tpl_vars['id'] != 'checkout' && $this->_tpl_vars['style'] != 'popup'): ?>
	<div class="form-wrap-l"></div>
	<div class="form-wrap-r"></div>
<?php endif; ?>
<form name="<?php echo $this->_tpl_vars['form_name']; ?>
" action="<?php echo fn_url(""); ?>
" method="post">
<input type="hidden" name="form_name" value="<?php echo $this->_tpl_vars['form_name']; ?>
" />
<input type="hidden" name="return_url" value="<?php echo smarty_modifier_default(@$this->_tpl_vars['_REQUEST']['return_url'], @$this->_tpl_vars['config']['current_url']); ?>
" />
<?php if ($this->_tpl_vars['id'] == 'checkout'): ?>
	<div class="checkout-login-form"><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('returning_customer', $this->getLanguage()))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>
			<div class="form-field">
				<label for="login_<?php echo $this->_tpl_vars['id']; ?>
" class="cm-required cm-trim<?php if ($this->_tpl_vars['settings']['General']['use_email_as_login'] == 'Y'): ?> cm-email<?php endif; ?>"><?php if ($this->_tpl_vars['settings']['General']['use_email_as_login'] == 'Y'): ?><?php echo fn_get_lang_var('email', $this->getLanguage()); ?>
<?php else: ?><?php echo fn_get_lang_var('username', $this->getLanguage()); ?>
<?php endif; ?></label>
				<input type="text" id="login_<?php echo $this->_tpl_vars['id']; ?>
" name="user_login" size="30" value="<?php echo $this->_tpl_vars['config']['demo_username']; ?>
" class="input-text" />
			</div>

			<div class="form-field password">
				<label for="psw_<?php echo $this->_tpl_vars['id']; ?>
" class="forgot-password-label cm-required"><?php echo fn_get_lang_var('password', $this->getLanguage()); ?>
</label><a href="<?php echo fn_url("auth.recover_password"); ?>
" class="forgot-password"  tabindex="5"><?php echo fn_get_lang_var('forgot_password_question', $this->getLanguage()); ?>
</a>
				<input type="password" id="psw_<?php echo $this->_tpl_vars['id']; ?>
" name="password" size="30" value="<?php echo $this->_tpl_vars['config']['demo_password']; ?>
" class="input-text" maxlength="32" />
			</div>

			<?php if ($this->_tpl_vars['settings']['Image_verification']['use_for_login'] == 'Y'): ?>
				<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('id' => "login_".($this->_tpl_vars['form_name']), 'align' => 'left', )); ?><?php if (fn_needs_image_verification("") == true): ?>	
	<?php $this->assign('is', $this->_tpl_vars['settings']['Image_verification'], false); ?>
	
	<?php $this->assign('id_uniqid', uniqid($this->_tpl_vars['id']), false); ?>
	<div class="captcha form-field">
	<?php if ($this->_tpl_vars['sidebox']): ?>
		<p><img id="verification_image_<?php echo $this->_tpl_vars['id']; ?>
" class="image-captcha valign" src="<?php echo fn_url("image.captcha?verification_id=".($this->_tpl_vars['SESS_ID']).":".($this->_tpl_vars['id'])."&amp;".($this->_tpl_vars['id_uniqid'])."&amp;", 'C', 'rel', '&amp;'); ?>
" alt="" onclick="this.src += 'reload' ;" width="<?php echo $this->_tpl_vars['is']['width']; ?>
" height="<?php echo $this->_tpl_vars['is']['height']; ?>
" /></p>
	<?php endif; ?>
		<label for="verification_answer_<?php echo $this->_tpl_vars['id']; ?>
" class="cm-required"><?php echo fn_get_lang_var('image_verification_label', $this->getLanguage()); ?>
</label>
		<input class="captcha-input-text valign cm-autocomplete-off" type="text" id="verification_answer_<?php echo $this->_tpl_vars['id']; ?>
" name="verification_answer" value= "" />
	<?php if (! $this->_tpl_vars['sidebox']): ?>
		<img id="verification_image_<?php echo $this->_tpl_vars['id']; ?>
" class="image-captcha valign" src="<?php echo fn_url("image.captcha?verification_id=".($this->_tpl_vars['SESS_ID']).":".($this->_tpl_vars['id'])."&amp;".($this->_tpl_vars['id_uniqid'])."&amp;", 'C', 'rel', '&amp;'); ?>
" alt="" onclick="this.src += 'reload' ;"  width="<?php echo $this->_tpl_vars['is']['width']; ?>
" height="<?php echo $this->_tpl_vars['is']['height']; ?>
" />
	<?php endif; ?>
	<p<?php if ($this->_tpl_vars['align']): ?> class="<?php echo $this->_tpl_vars['align']; ?>
"<?php endif; ?>><?php echo fn_get_lang_var('image_verification_body', $this->getLanguage()); ?>
</p>
	</div>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
			<?php endif; ?>

<?php if ($this->_tpl_vars['id'] == 'checkout'): ?>
		</div>
	<div class="clear-both"></div>
	<div class="checkout-buttons clearfix">
<?php endif; ?>
	<?php $this->_tag_stack[] = array('hook', array('name' => "index:login_buttons")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		<?php if ($this->_tpl_vars['id'] != 'checkout'): ?>
			<div class="<?php if ($this->_tpl_vars['style'] == 'popup'): ?>buttons-container<?php endif; ?>">
		<?php endif; ?>
			<div class="body-bc clearfix">
				<div class="float-right">
					<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/login.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[auth.login]",'but_role' => 'submit')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				</div>
				<div class="remember-me-chekbox">
					<label for="remember_me_<?php echo $this->_tpl_vars['id']; ?>
" class="valign lowercase"><input class="valign checkbox" type="checkbox" name="remember_me" id="remember_me_<?php echo $this->_tpl_vars['id']; ?>
" value="Y" /><?php echo fn_get_lang_var('remember_me', $this->getLanguage()); ?>
</label>
				</div>
			</div>
		<?php if ($this->_tpl_vars['id'] != 'checkout'): ?>
			</div>
		<?php endif; ?>
	<?php if ($this->_tpl_vars['addons']['billibuys']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><input type="hidden" name="request_title" value="<?php echo $this->_tpl_vars['_REQUEST']['request_title']; ?>
" /><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php if ($this->_tpl_vars['id'] == 'checkout'): ?>
	</div>
<?php endif; ?>

</form>
<?php $this->_smarty_vars['capture']['login'] = ob_get_contents(); ob_end_clean(); ?>

<?php if ($this->_tpl_vars['style'] == 'popup'): ?>
	<?php echo $this->_smarty_vars['capture']['login']; ?>

<?php else: ?>
	<div<?php if ($this->_tpl_vars['controller'] != 'checkout'): ?> class="<?php if ($this->_tpl_vars['style'] != 'popup'): ?>form-wrap<?php endif; ?> login"<?php endif; ?>>
		<?php echo $this->_smarty_vars['capture']['login']; ?>

	</div>

	<?php ob_start(); ?><?php echo fn_get_lang_var('sign_in', $this->getLanguage()); ?>
<?php $this->_smarty_vars['capture']['mainbox_title'] = ob_get_contents(); ob_end_clean(); ?>
<?php endif; ?>