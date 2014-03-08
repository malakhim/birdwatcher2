<?php /* Smarty version 2.6.18, created on 2014-03-08 11:46:48
         compiled from views/profiles/components/profiles_account.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_check_user_type_admin_area', 'views/profiles/components/profiles_account.tpl', 17, false),array('modifier', 'defined', 'views/profiles/components/profiles_account.tpl', 17, false),array('modifier', 'is_array', 'views/profiles/components/profiles_account.tpl', 82, false),array('modifier', 'fn_from_json', 'views/profiles/components/profiles_account.tpl', 83, false),array('modifier', 'default', 'views/profiles/components/profiles_account.tpl', 86, false),array('modifier', 'lower', 'views/profiles/components/profiles_account.tpl', 86, false),array('modifier', 'fn_query_remove', 'views/profiles/components/profiles_account.tpl', 123, false),array('modifier', 'fn_url', 'views/profiles/components/profiles_account.tpl', 124, false),array('block', 'hook', 'views/profiles/components/profiles_account.tpl', 125, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('user_account_information','email','username','password','confirm_password','active','hidden','disabled','status','active','hidden','disabled','status','active','hidden','pending','disabled','account_type','vendor_administrator','administrator','account_type','customer','vendor_administrator','administrator','tax_exempt','language'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/select_status.tpl' => 1367063753,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('user_account_information', $this->getLanguage()))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['uid'] == 1 || ( fn_check_user_type_admin_area($this->_tpl_vars['user_data']) && defined('RESTRICTED_ADMIN') ) || $this->_tpl_vars['user_data']['is_root'] == 'Y'): ?>
	<input type="hidden" name="user_data[status]" value="A" />
	<input type="hidden" name="user_data[user_type]" value="<?php echo $this->_tpl_vars['user_data']['user_type']; ?>
" />
<?php endif; ?>

<?php if ($this->_tpl_vars['settings']['General']['use_email_as_login'] == 'Y'): ?>
<div class="form-field">
	<label for="email" class="cm-required cm-email"><?php echo fn_get_lang_var('email', $this->getLanguage()); ?>
:</label>
	<input type="text" id="email" name="user_data[email]" class="input-text" size="32" maxlength="128" value="<?php echo $this->_tpl_vars['user_data']['email']; ?>
" />
</div>

<?php else: ?>

<div class="form-field">
	<label for="user_login_profile" class="cm-required"><?php echo fn_get_lang_var('username', $this->getLanguage()); ?>
:</label>
	<input id="user_login_profile" type="text" name="user_data[user_login]" class="input-text" size="32" maxlength="32" value="<?php echo $this->_tpl_vars['user_data']['user_login']; ?>
" />
</div>
<?php endif; ?>

<div class="form-field">
	<label for="password1" class="cm-required"><?php echo fn_get_lang_var('password', $this->getLanguage()); ?>
:</label>
	<input type="password" id="password1" name="user_data[password1]" class="input-text cm-autocomplete-off" size="32" maxlength="32" value="<?php if ($this->_tpl_vars['mode'] == 'update'): ?>            <?php endif; ?>" />
</div>

<div class="form-field">
	<label for="password2" class="cm-required"><?php echo fn_get_lang_var('confirm_password', $this->getLanguage()); ?>
:</label>
	<input type="password" id="password2" name="user_data[password2]" class="input-text cm-autocomplete-off" size="32" maxlength="32" value="<?php if ($this->_tpl_vars['mode'] == 'update'): ?>            <?php endif; ?>" />
</div>


<?php if ($this->_tpl_vars['uid'] != 1 || ! fn_check_user_type_admin_area($this->_tpl_vars['user_data']) || defined('RESTRICTED_ADMIN')): ?>
	<?php if (! ( defined('COMPANY_ID') && $this->_tpl_vars['user_data']['is_root'] == 'Y' )): ?>

		<?php if ($this->_tpl_vars['user_data']['user_id'] == $this->_tpl_vars['auth']['user_id']): ?>
			<?php $this->assign('display', 'text', false); ?>
		<?php else: ?>
			<?php $this->assign('display', "", false); ?>
		<?php endif; ?>

		<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('input_name' => "user_data[status]", 'id' => 'user_data', 'obj' => $this->_tpl_vars['user_data'], 'hidden' => false, 'display' => $this->_tpl_vars['display'], )); ?><?php if ($this->_tpl_vars['display'] == 'select'): ?>
<select name="<?php echo $this->_tpl_vars['input_name']; ?>
" <?php if ($this->_tpl_vars['input_id']): ?>id="<?php echo $this->_tpl_vars['input_id']; ?>
"<?php endif; ?>>
	<option value="A" <?php if ($this->_tpl_vars['obj']['status'] == 'A'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('active', $this->getLanguage()); ?>
</option>
	<?php if ($this->_tpl_vars['hidden']): ?>
	<option value="H" <?php if ($this->_tpl_vars['obj']['status'] == 'H'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('hidden', $this->getLanguage()); ?>
</option>
	<?php endif; ?>
	<option value="D" <?php if ($this->_tpl_vars['obj']['status'] == 'D'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>
</option>
</select>
<?php elseif ($this->_tpl_vars['display'] == 'text'): ?>
<div class="form-field">
	<label class="cm-required"><?php echo fn_get_lang_var('status', $this->getLanguage()); ?>
:</label>
	<span>
		<?php if ($this->_tpl_vars['obj']['status'] == 'A'): ?>
			<?php echo fn_get_lang_var('active', $this->getLanguage()); ?>

		<?php elseif ($this->_tpl_vars['obj']['status'] == 'H'): ?>
			<?php echo fn_get_lang_var('hidden', $this->getLanguage()); ?>

		<?php elseif ($this->_tpl_vars['obj']['status'] == 'D'): ?>
			<?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>

		<?php endif; ?>
	</span>
</div>
<?php else: ?>
<div class="form-field">
	<label class="cm-required"><?php echo fn_get_lang_var('status', $this->getLanguage()); ?>
:</label>
	<div class="select-field">
		<?php if ($this->_tpl_vars['items_status']): ?>
			<?php if (! is_array($this->_tpl_vars['items_status'])): ?>
				<?php $this->assign('items_status', fn_from_json($this->_tpl_vars['items_status']), false); ?>
			<?php endif; ?>
			<?php $_from = $this->_tpl_vars['items_status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['status_cycle'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['status_cycle']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['st'] => $this->_tpl_vars['val']):
        $this->_foreach['status_cycle']['iteration']++;
?>
			<input type="radio" name="<?php echo $this->_tpl_vars['input_name']; ?>
" id="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$this->_tpl_vars['obj_id'], 0); ?>
_<?php echo smarty_modifier_lower($this->_tpl_vars['st']); ?>
" <?php if ($this->_tpl_vars['obj']['status'] == $this->_tpl_vars['st'] || ( ! $this->_tpl_vars['obj']['status'] && ($this->_foreach['status_cycle']['iteration'] <= 1) )): ?>checked="checked"<?php endif; ?> value="<?php echo $this->_tpl_vars['st']; ?>
" class="radio" /><label for="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$this->_tpl_vars['obj_id'], 0); ?>
_<?php echo smarty_modifier_lower($this->_tpl_vars['st']); ?>
"><?php echo $this->_tpl_vars['val']; ?>
</label>
			<?php endforeach; endif; unset($_from); ?>
		<?php else: ?>
		<input type="radio" name="<?php echo $this->_tpl_vars['input_name']; ?>
" id="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$this->_tpl_vars['obj_id'], 0); ?>
_a" <?php if ($this->_tpl_vars['obj']['status'] == 'A' || ! $this->_tpl_vars['obj']['status']): ?>checked="checked"<?php endif; ?> value="A" class="radio" /><label for="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$this->_tpl_vars['obj_id'], 0); ?>
_a"><?php echo fn_get_lang_var('active', $this->getLanguage()); ?>
</label>

		<?php if ($this->_tpl_vars['hidden']): ?>
		<input type="radio" name="<?php echo $this->_tpl_vars['input_name']; ?>
" id="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$this->_tpl_vars['obj_id'], 0); ?>
_h" <?php if ($this->_tpl_vars['obj']['status'] == 'H'): ?>checked="checked"<?php endif; ?> value="H" class="radio" /><label for="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$this->_tpl_vars['obj_id'], 0); ?>
_h"><?php echo fn_get_lang_var('hidden', $this->getLanguage()); ?>
</label>
		<?php endif; ?>

		<?php if ($this->_tpl_vars['obj']['status'] == 'P'): ?>
		<input type="radio" name="<?php echo $this->_tpl_vars['input_name']; ?>
" id="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$this->_tpl_vars['obj_id'], 0); ?>
_p" checked="checked" value="P" class="radio" /><label for="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$this->_tpl_vars['obj_id'], 0); ?>
_p"><?php echo fn_get_lang_var('pending', $this->getLanguage()); ?>
</label>
		<?php endif; ?>

		<input type="radio" name="<?php echo $this->_tpl_vars['input_name']; ?>
" id="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$this->_tpl_vars['obj_id'], 0); ?>
_d" <?php if ($this->_tpl_vars['obj']['status'] == 'D'): ?>checked="checked"<?php endif; ?> value="D" class="radio" /><label for="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$this->_tpl_vars['obj_id'], 0); ?>
_d"><?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>
</label>
		<?php endif; ?>
	</div>
</div>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>

		<?php $this->assign('_u_type', smarty_modifier_default(@$this->_tpl_vars['_REQUEST']['user_type'], @$this->_tpl_vars['user_data']['user_type']), false); ?>
		<?php if ($this->_tpl_vars['mode'] == 'add'): ?>
			<input type="hidden" name="user_data[user_type]" value="<?php echo $this->_tpl_vars['_u_type']; ?>
" />
		<?php else: ?>
			<?php if ($this->_tpl_vars['user_data']['user_id'] == $this->_tpl_vars['auth']['user_id']): ?>
				<div class="form-field">
					<label for="user_type" class="cm-required"><?php echo fn_get_lang_var('account_type', $this->getLanguage()); ?>
:</label>
					<span class="shift-input">
					<?php if ($this->_tpl_vars['_u_type'] == 'V'): ?>
						<?php echo fn_get_lang_var('vendor_administrator', $this->getLanguage()); ?>

					<?php elseif ($this->_tpl_vars['_u_type'] == 'A'): ?>
						<?php echo fn_get_lang_var('administrator', $this->getLanguage()); ?>

					<?php endif; ?>
					</span>
				</div>
			<?php else: ?>
				<div class="form-field">
					<label for="user_type" class="cm-required"><?php echo fn_get_lang_var('account_type', $this->getLanguage()); ?>
:</label>
					<?php $this->assign('r_url', fn_query_remove($this->_tpl_vars['config']['current_url'], 'user_type'), false); ?>
					<select id="user_type" name="user_data[user_type]"<?php if (! $this->_tpl_vars['redirect_denied']): ?> onchange="$.redirect('<?php echo fn_url(($this->_tpl_vars['r_url'])."&user_type="); ?>
' + this.value);"<?php endif; ?>>
						<?php $this->_tag_stack[] = array('hook', array('name' => "profiles:account")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
							<?php if (! ( @PRODUCT_TYPE == 'MULTIVENDOR' && defined('COMPANY_ID') && $this->_tpl_vars['_u_type'] != 'A' )): ?>
								<option value="C" <?php if ($this->_tpl_vars['_u_type'] == 'C'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('customer', $this->getLanguage()); ?>
</option>
							<?php endif; ?>
							<?php if (@RESTRICTED_ADMIN != 1 || $this->_tpl_vars['user_data']['user_id'] == $this->_tpl_vars['auth']['user_id']): ?>
								
								<option value="V" <?php if ($this->_tpl_vars['_u_type'] == 'V'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('vendor_administrator', $this->getLanguage()); ?>
</option>
								
								<?php if (! ( ( @PRODUCT_TYPE == 'ULTIMATE' || @PRODUCT_TYPE == 'MULTIVENDOR' ) && defined('COMPANY_ID') && $this->_tpl_vars['_u_type'] != 'A' )): ?>
									<option value="A" <?php if ($this->_tpl_vars['_u_type'] == 'A'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('administrator', $this->getLanguage()); ?>
</option>
								<?php endif; ?>
							<?php endif; ?>
						<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
					</select>
				</div>
			<?php endif; ?>
		<?php endif; ?>

		<div class="form-field">
			<label for="tax_exempt"><?php echo fn_get_lang_var('tax_exempt', $this->getLanguage()); ?>
:</label>
			<input type="hidden" name="user_data[tax_exempt]" value="N" />
			<input id="tax_exempt" type="checkbox" name="user_data[tax_exempt]" value="Y" <?php if ($this->_tpl_vars['user_data']['tax_exempt'] == 'Y'): ?>checked="checked"<?php endif; ?> class="checkbox" />
		</div>

	<?php endif; ?>
<?php endif; ?>

<div class="form-field">
	<label for="user_language"><?php echo fn_get_lang_var('language', $this->getLanguage()); ?>
</label>
	<select name="user_data[lang_code]" id="user_language">
		<?php $_from = $this->_tpl_vars['languages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['lang_code'] => $this->_tpl_vars['language']):
?>
			<option value="<?php echo $this->_tpl_vars['lang_code']; ?>
" <?php if ($this->_tpl_vars['lang_code'] == $this->_tpl_vars['user_data']['lang_code']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['language']['name']; ?>
</option>
		<?php endforeach; endif; unset($_from); ?>
	</select>
</div>