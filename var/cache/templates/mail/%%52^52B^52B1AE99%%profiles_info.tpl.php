<?php /* Smarty version 2.6.18, created on 2014-03-10 12:14:15
         compiled from profiles/profiles_info.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_get_profile_fields', 'profiles/profiles_info.tpl', 69, false),array('function', 'split', 'profiles/profiles_info.tpl', 70, false),)), $this); ?>
<table cellpadding="0" cellspacing="0" border="0">
<tr>
	<td valign="top">
		<table cellpadding="1" cellspacing="1" border="0" width="100%">
		<tr>
			<td colspan="2" class="form-title"><?php echo fn_get_lang_var('user_account_info', $this->getLanguage()); ?>
<hr size="1" noshade></td>
		</tr>
		<?php if ($this->_tpl_vars['settings']['General']['use_email_as_login'] != 'Y' && $this->_tpl_vars['user_data']['user_type'] != 'S'): ?>
		<tr>
			<td class="form-field-caption" nowrap><?php echo fn_get_lang_var('username', $this->getLanguage()); ?>
:&nbsp;</td>
			<td ><?php echo $this->_tpl_vars['user_data']['user_login']; ?>
</td>
		</tr>
		<?php else: ?>
		<tr>
			<td class="form-field-caption" nowrap><?php echo fn_get_lang_var('email', $this->getLanguage()); ?>
:&nbsp;</td>
			<td><?php echo $this->_tpl_vars['user_data']['email']; ?>
</td>
		</tr>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['send_password'] || $this->_tpl_vars['settings']['General']['quick_registration'] == 'Y'): ?>
			<?php if ($this->_tpl_vars['password']): ?>
			<tr>
				<td class="form-field-caption" nowrap><?php echo fn_get_lang_var('password', $this->getLanguage()); ?>
:&nbsp;</td>
				<td><?php echo $this->_tpl_vars['password']; ?>
</td>
			</tr>
			<?php endif; ?>
			<tr>
				<td class="form-field-caption" nowrap><?php echo fn_get_lang_var('login', $this->getLanguage()); ?>
 <?php echo fn_get_lang_var('url', $this->getLanguage()); ?>
:&nbsp;</td>
				<td><?php echo $this->_tpl_vars['login_url']; ?>
</td>
			</tr>
		<?php endif; ?>
		
		<?php if ($this->_tpl_vars['user_data']['usergroups']): ?>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2" class="form-title"><?php echo fn_get_lang_var('usergroups', $this->getLanguage()); ?>
<hr size="1" noshade></td>
		</tr>
		<?php $_from = $this->_tpl_vars['user_data']['usergroups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['user_usergroup']):
?>
		<tr>
			<td class="form-field-caption" nowrap><?php echo $this->_tpl_vars['user_usergroup']['usergroup']; ?>
:&nbsp;</td>
			<td><?php if ($this->_tpl_vars['user_usergroup']['status'] == 'P'): ?><?php echo fn_get_lang_var('pending', $this->getLanguage()); ?>
<?php else: ?><?php echo fn_get_lang_var('active', $this->getLanguage()); ?>
<?php endif; ?></td>
		</tr>
		<?php endforeach; endif; unset($_from); ?>
		<?php endif; ?>
		
		<?php if ($this->_tpl_vars['settings']['General']['user_multiple_profiles'] == 'Y'): ?>
		<tr>
			<td class="form-title"><?php echo fn_get_lang_var('profile_name', $this->getLanguage()); ?>
:&nbsp;</td>
			<td><?php echo $this->_tpl_vars['user_data']['profile_name']; ?>
</td>
		</tr>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['user_data']['tax_exempt'] == 'Y'): ?>
		<tr>
			<td class="form-title"><?php echo fn_get_lang_var('tax_exempt', $this->getLanguage()); ?>
:&nbsp;</td>
			<td><?php echo fn_get_lang_var('yes', $this->getLanguage()); ?>
</td>
		</tr>
		<?php endif; ?>
		</table>
	</td>	
	<td colspan="2">&nbsp;</td>
</tr>
<tr>
	<td colspan="3">&nbsp;</td>
</tr>
</table>

<?php if (! $this->_tpl_vars['send_password']): ?>
	<?php $this->assign('profile_fields', fn_get_profile_fields($this->_tpl_vars['user_data']['user_type']), false); ?>
	<?php echo smarty_function_split(array('data' => $this->_tpl_vars['profile_fields']['C'],'size' => 2,'assign' => 'contact_fields','simple' => true), $this);?>

	<table cellpadding="4" cellspacing="0" border="0" width="100%">
	<?php if ($this->_tpl_vars['profile_fields']['C']): ?>
		<tr>
			<td valign="top" width="50%">
				<table>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "profiles/profile_fields_info.tpl", 'smarty_include_vars' => array('fields' => $this->_tpl_vars['contact_fields']['0'],'title' => fn_get_lang_var('contact_information', $this->getLanguage()))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				</table>
			</td>
			<td width="1%">&nbsp;</td>
			<td valign="top" width="49%">
				<?php if ($this->_tpl_vars['contact_fields']['1']): ?>
				<table>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "profiles/profile_fields_info.tpl", 'smarty_include_vars' => array('fields' => $this->_tpl_vars['contact_fields']['1'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				</table>
				<?php endif; ?>
			</td>
		</tr>
	<?php endif; ?>
	<?php if (( $this->_tpl_vars['profile_fields']['B'] || $this->_tpl_vars['profile_fields']['S'] ) && $this->_tpl_vars['user_data']['register_at_checkout'] != 'Y' && ! ( $this->_tpl_vars['created'] && $this->_tpl_vars['settings']['General']['quick_registration'] == 'Y' )): ?>
	<tr>
		<td valign="top">
		<?php if ($this->_tpl_vars['profile_fields']['B']): ?>
			<p></p>
			<table>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "profiles/profile_fields_info.tpl", 'smarty_include_vars' => array('fields' => $this->_tpl_vars['profile_fields']['B'],'title' => fn_get_lang_var('billing_address', $this->getLanguage()))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</table>
		<?php else: ?>
			&nbsp;
		<?php endif; ?>
		</td>
		<td>&nbsp;</td>
		<td valign="top">
		<?php if ($this->_tpl_vars['profile_fields']['S']): ?>
			<p></p>
			<table>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "profiles/profile_fields_info.tpl", 'smarty_include_vars' => array('fields' => $this->_tpl_vars['profile_fields']['S'],'title' => fn_get_lang_var('shipping_address', $this->getLanguage()))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</table>
		<?php else: ?>
			&nbsp;
		<?php endif; ?>
		</td>
	</tr>
	<?php endif; ?>
	</table>
<?php endif; ?>