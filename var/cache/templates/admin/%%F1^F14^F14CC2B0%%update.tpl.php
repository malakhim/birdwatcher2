<?php /* Smarty version 2.6.18, created on 2014-03-08 11:46:47
         compiled from views/profiles/update.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_compare_shipping_billing', 'views/profiles/update.tpl', 1, false),array('modifier', 'fn_get_predefined_statuses', 'views/profiles/update.tpl', 1, false),array('modifier', 'defined', 'views/profiles/update.tpl', 1, false),array('modifier', 'escape', 'views/profiles/update.tpl', 18, false),array('modifier', 'fn_allow_save_object', 'views/profiles/update.tpl', 56, false),array('modifier', 'fn_string_not_empty', 'views/profiles/update.tpl', 56, false),array('modifier', 'fn_url', 'views/profiles/update.tpl', 61, false),array('modifier', 'fn_check_user_type_admin_area', 'views/profiles/update.tpl', 73, false),array('modifier', 'default', 'views/profiles/update.tpl', 135, false),array('modifier', 'lower', 'views/profiles/update.tpl', 138, false),array('modifier', 'is_array', 'views/profiles/update.tpl', 142, false),array('modifier', 'fn_from_json', 'views/profiles/update.tpl', 143, false),array('modifier', 'trim', 'views/profiles/update.tpl', 213, false),array('modifier', 'empty_tabs', 'views/profiles/update.tpl', 318, false),array('modifier', 'in_array', 'views/profiles/update.tpl', 324, false),array('modifier', 'fn_get_user_type_description', 'views/profiles/update.tpl', 339, false),array('modifier', 'fn_user_need_login', 'views/profiles/update.tpl', 353, false),array('function', 'script', 'views/profiles/update.tpl', 48, false),array('function', 'cycle', 'views/profiles/update.tpl', 112, false),array('block', 'hook', 'views/profiles/update.tpl', 70, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('vendor','contact_information','user_profile_info','text_multiprofile_notice','billing_address','shipping_address','shipping_address','usergroup','status','active','hidden','disabled','pending','new','active','disabled','hidden','pending','new','active','disabled','hidden','pending','notify_customer','notify_orders_department','notify_vendor','notify_supplier','no_items','notify_user','new_profile','editing_profile','editing_profile','editing_profile','view_all_orders','act_on_behalf','previous','next'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/view_tools.tpl' => 1367063753,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><script type="text/javascript">
//<![CDATA[

var default_country = '<?php echo smarty_modifier_escape($this->_tpl_vars['settings']['General']['default_country'], 'javascript'); ?>
';
<?php echo '
var zip_validators = {
	US: {
		regex: /^(\\d{5})(-\\d{4})?$/,
		format: \'01342 (01342-5678)\'
	},
	CA: {
		regex: /^(\\w{3} ?\\w{3})$/,
		format: \'K1A OB1 (K1AOB1)\'
	},
	RU: {
		regex: /^(\\d{6})?$/,
		format: \'123456\'
	}
}
'; ?>


var states = new Array();
<?php if ($this->_tpl_vars['states']): ?>
<?php $_from = $this->_tpl_vars['states']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['country_code'] => $this->_tpl_vars['country_states']):
?>
states['<?php echo $this->_tpl_vars['country_code']; ?>
'] = new Array();
<?php $_from = $this->_tpl_vars['country_states']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['fs'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['fs']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['state']):
        $this->_foreach['fs']['iteration']++;
?>
states['<?php echo $this->_tpl_vars['country_code']; ?>
']['__<?php echo smarty_modifier_escape($this->_tpl_vars['state']['code'], 'quotes'); ?>
'] = '<?php echo smarty_modifier_escape($this->_tpl_vars['state']['state'], 'javascript'); ?>
';
<?php endforeach; endif; unset($_from); ?>
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>

//]]>
</script>
<?php echo smarty_function_script(array('src' => "js/profiles_scripts.js"), $this);?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>

<?php ob_start(); ?>

<?php ob_start(); ?>
	<?php $this->assign('hide_inputs', false, false); ?>

	
	<?php if (! fn_allow_save_object($this->_tpl_vars['user_data'], 'users') || defined('COMPANY_ID') && ( $this->_tpl_vars['_REQUEST']['user_type'] == 'C' || fn_string_not_empty($this->_tpl_vars['user_data']['company_id']) && $this->_tpl_vars['user_data']['company_id'] != @COMPANY_ID )): ?>
		<?php $this->assign('hide_inputs', true, false); ?>
	<?php endif; ?>
	

	<form name="profile_form" action="<?php echo fn_url(""); ?>
" method="post" class="cm-form-highlight<?php if ($this->_tpl_vars['hide_inputs']): ?> cm-hide-inputs<?php endif; ?>">		
	<?php if ($this->_tpl_vars['mode'] != 'add'): ?>
		<input type="hidden" name="user_id" value="<?php echo $this->_tpl_vars['_REQUEST']['user_id']; ?>
" />
	<?php endif; ?>
	<input type="hidden" class="cm-no-hide-input" name="selected_section" id="selected_section" value="<?php echo $this->_tpl_vars['selected_section']; ?>
" />
	<input type="hidden" class="cm-no-hide-input" name="user_type" value="<?php echo $this->_tpl_vars['_REQUEST']['user_type']; ?>
" />

	
	<div id="content_general">
		<?php $this->_tag_stack[] = array('hook', array('name' => "profiles:general_content")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		<fieldset>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/profiles/components/profiles_account.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php if (@PRODUCT_TYPE == 'ULTIMATE' && ( ( $this->_tpl_vars['_REQUEST']['user_type'] && ! fn_check_user_type_admin_area($this->_tpl_vars['_REQUEST']['user_type']) ) || ( ! $this->_tpl_vars['_REQUEST']['user_type'] && ! fn_check_user_type_admin_area($this->_tpl_vars['user_data']['user_type']) ) ) || @PRODUCT_TYPE != 'ULTIMATE' && ( $this->_tpl_vars['_REQUEST']['user_type'] == 'V' || ! $this->_tpl_vars['_REQUEST']['user_type'] && $this->_tpl_vars['user_data']['user_type'] == 'V' )): ?>
				<?php $this->assign('exclude_company_id', '0', false); ?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/companies/components/company_field.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('vendor', $this->getLanguage()),'name' => "user_data[company_id]",'selected' => $this->_tpl_vars['user_data']['company_id'],'exclude_company_id' => $this->_tpl_vars['exclude_company_id'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php else: ?>
				<input type="hidden" name="user_data[company_id]" id="company_id" value="0">
			<?php endif; ?>
		</fieldset>
		<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		
		<fieldset>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/profiles/components/profile_fields.tpl", 'smarty_include_vars' => array('section' => 'C','title' => fn_get_lang_var('contact_information', $this->getLanguage()))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</fieldset>

		<?php if ($this->_tpl_vars['settings']['General']['user_multiple_profiles'] == 'Y' && $this->_tpl_vars['mode'] == 'update'): ?>
		<fieldset>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('user_profile_info', $this->getLanguage()))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<p class="form-note"><?php echo fn_get_lang_var('text_multiprofile_notice', $this->getLanguage()); ?>
</p>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/profiles/components/multiple_profiles.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</fieldset>
		<?php endif; ?>

		<fieldset>
		<?php if ($this->_tpl_vars['profile_fields']['B']): ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/profiles/components/profile_fields.tpl", 'smarty_include_vars' => array('section' => 'B','title' => fn_get_lang_var('billing_address', $this->getLanguage()))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/profiles/components/profile_fields.tpl", 'smarty_include_vars' => array('section' => 'S','title' => fn_get_lang_var('shipping_address', $this->getLanguage()),'body_id' => 'sa','shipping_flag' => fn_compare_shipping_billing($this->_tpl_vars['profile_fields']))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php else: ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/profiles/components/profile_fields.tpl", 'smarty_include_vars' => array('section' => 'S','title' => fn_get_lang_var('shipping_address', $this->getLanguage()),'shipping_flag' => false)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php endif; ?>
		</fieldset>
	</div>
	
	<?php if ($this->_tpl_vars['mode'] == 'update' && ( ( ! fn_check_user_type_admin_area($this->_tpl_vars['user_data']) && ! defined('COMPANY_ID') ) || ( fn_check_user_type_admin_area($this->_tpl_vars['user_data']) && $this->_tpl_vars['usergroups'] && ! defined('COMPANY_ID') && $this->_tpl_vars['auth']['is_root'] == 'Y' && ( $this->_tpl_vars['user_data']['company_id'] != 0 || ( $this->_tpl_vars['user_data']['company_id'] == 0 && $this->_tpl_vars['user_data']['is_root'] != 'Y' ) ) ) || ( $this->_tpl_vars['user_data']['user_type'] == 'V' && defined('COMPANY_ID') && $this->_tpl_vars['auth']['is_root'] == 'Y' && $this->_tpl_vars['user_data']['user_id'] != $this->_tpl_vars['auth']['user_id'] && $this->_tpl_vars['user_data']['company_id'] == @COMPANY_ID ) )): ?>
	<div id="content_usergroups" class="cm-hide-save-button">
		<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
		<tr>
			<th width="50%"><?php echo fn_get_lang_var('usergroup', $this->getLanguage()); ?>
</th>
			<th><?php echo fn_get_lang_var('status', $this->getLanguage()); ?>
</th>
		</tr>
		<?php $_from = $this->_tpl_vars['usergroups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['usergroup']):
?>
		<tr <?php echo smarty_function_cycle(array('values' => "class=\"table-row\", "), $this);?>
>
			<td><a href="<?php echo fn_url("usergroups.manage#opener_group".($this->_tpl_vars['usergroup']['usergroup_id'])); ?>
"><?php echo $this->_tpl_vars['usergroup']['usergroup']; ?>
</a></td>
			<td>
				<?php if ($this->_tpl_vars['user_data']['usergroups'][$this->_tpl_vars['usergroup']['usergroup_id']]): ?>
					<?php $this->assign('ug_status', $this->_tpl_vars['user_data']['usergroups'][$this->_tpl_vars['usergroup']['usergroup_id']]['status'], false); ?>
				<?php else: ?>
					<?php $this->assign('ug_status', 'F', false); ?>
				<?php endif; ?>
				<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('id' => $this->_tpl_vars['usergroup']['usergroup_id'], 'status' => $this->_tpl_vars['ug_status'], 'hidden' => "", 'items_status' => fn_get_predefined_statuses('profiles'), 'extra' => "&amp;user_id=".($this->_tpl_vars['user_data']['user_id']), 'update_controller' => 'usergroups', 'notify' => true, 'hide_for_vendor' => defined('COMPANY_ID'), )); ?><?php if ($this->_tpl_vars['display'] == 'text'): ?>
	<span class="view-status">
		<?php if ($this->_tpl_vars['status'] == 'A'): ?>
			<?php echo fn_get_lang_var('active', $this->getLanguage()); ?>

		<?php elseif ($this->_tpl_vars['status'] == 'H'): ?>
			<?php echo fn_get_lang_var('hidden', $this->getLanguage()); ?>

		<?php elseif ($this->_tpl_vars['status'] == 'D'): ?>
			<?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>

		<?php elseif ($this->_tpl_vars['status'] == 'P'): ?>
			<?php echo fn_get_lang_var('pending', $this->getLanguage()); ?>

		<?php elseif ($this->_tpl_vars['status'] == 'N'): ?>
			<?php echo fn_get_lang_var('new', $this->getLanguage()); ?>

		<?php endif; ?>
	</span>
<?php else: ?>
	<?php $this->assign('prefix', smarty_modifier_default(@$this->_tpl_vars['prefix'], 'select'), false); ?>
	<div class="select-popup-container <?php echo $this->_tpl_vars['popup_additional_class']; ?>
">
		<?php if (! $this->_tpl_vars['hide_for_vendor']): ?>
		<div <?php if ($this->_tpl_vars['id']): ?>id="sw_<?php echo $this->_tpl_vars['prefix']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
_wrap"<?php endif; ?> class="<?php if ($this->_tpl_vars['statuses'][$this->_tpl_vars['status']]['color']): ?>selected-status-base<?php else: ?>selected-status status-<?php if ($this->_tpl_vars['suffix']): ?><?php echo $this->_tpl_vars['suffix']; ?>
-<?php endif; ?><?php echo smarty_modifier_lower($this->_tpl_vars['status']); ?>
<?php endif; ?><?php if ($this->_tpl_vars['id']): ?> cm-combo-on cm-combination<?php endif; ?>">
			<a <?php if ($this->_tpl_vars['id']): ?>class="cm-combo-on<?php if (! $this->_tpl_vars['popup_disabled']): ?> cm-combination<?php endif; ?>"<?php endif; ?>>
		<?php endif; ?>
			<?php if ($this->_tpl_vars['items_status']): ?>
				<?php if (! is_array($this->_tpl_vars['items_status'])): ?>
					<?php $this->assign('items_status', fn_from_json($this->_tpl_vars['items_status']), false); ?>
				<?php endif; ?>
				<?php echo $this->_tpl_vars['items_status'][$this->_tpl_vars['status']]; ?>

			<?php else: ?>
				<?php if ($this->_tpl_vars['status'] == 'A'): ?>
					<?php echo fn_get_lang_var('active', $this->getLanguage()); ?>

				<?php elseif ($this->_tpl_vars['status'] == 'D'): ?>
					<?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>

				<?php elseif ($this->_tpl_vars['status'] == 'H'): ?>
					<?php echo fn_get_lang_var('hidden', $this->getLanguage()); ?>

				<?php elseif ($this->_tpl_vars['status'] == 'P'): ?>
					<?php echo fn_get_lang_var('pending', $this->getLanguage()); ?>

				<?php elseif ($this->_tpl_vars['status'] == 'N'): ?>
					<?php echo fn_get_lang_var('new', $this->getLanguage()); ?>

				<?php endif; ?>
			<?php endif; ?>
		<?php if (! $this->_tpl_vars['hide_for_vendor']): ?>
			</a>
			<?php if ($this->_tpl_vars['statuses'][$this->_tpl_vars['status']]['color']): ?>
			<span class="selected-status-icon" style="background-color: #<?php echo $this->_tpl_vars['statuses'][$this->_tpl_vars['status']]['color']; ?>
">&nbsp;</span>
			<?php endif; ?>

		</div>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['id'] && ! $this->_tpl_vars['hide_for_vendor']): ?>
			<?php $this->assign('_update_controller', smarty_modifier_default(@$this->_tpl_vars['update_controller'], 'tools'), false); ?>
			<?php if ($this->_tpl_vars['table'] && $this->_tpl_vars['object_id_name']): ?><?php ob_start(); ?>&amp;table=<?php echo $this->_tpl_vars['table']; ?>
&amp;id_name=<?php echo $this->_tpl_vars['object_id_name']; ?>
<?php $this->_smarty_vars['capture']['_extra'] = ob_get_contents(); ob_end_clean(); ?><?php endif; ?>
			<div id="<?php echo $this->_tpl_vars['prefix']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
_wrap" class="popup-tools cm-popup-box cm-smart-position hidden">
				<div class="status-scroll-y">
				<ul class="cm-select-list">
				<?php if ($this->_tpl_vars['items_status']): ?>
					<?php $_from = $this->_tpl_vars['items_status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['st'] => $this->_tpl_vars['val']):
?>
					<li><a class="<?php if ($this->_tpl_vars['confirm']): ?>cm-confirm <?php endif; ?>status-link-<?php echo smarty_modifier_lower($this->_tpl_vars['st']); ?>
 <?php if ($this->_tpl_vars['status'] == $this->_tpl_vars['st']): ?>cm-active<?php else: ?>cm-ajax<?php endif; ?>"<?php if ($this->_tpl_vars['status_rev']): ?> rev="<?php echo $this->_tpl_vars['status_rev']; ?>
"<?php endif; ?> href="<?php echo fn_url(($this->_tpl_vars['_update_controller']).".update_status?id=".($this->_tpl_vars['id'])."&amp;status=".($this->_tpl_vars['st']).($this->_smarty_vars['capture']['_extra']).($this->_tpl_vars['extra'])); ?>
" onclick="return fn_check_object_status(this, '<?php echo smarty_modifier_lower($this->_tpl_vars['st']); ?>
', '<?php if ($this->_tpl_vars['statuses']): ?><?php echo smarty_modifier_default(@$this->_tpl_vars['statuses'][$this->_tpl_vars['st']]['color'], ''); ?>
<?php endif; ?>');" name="update_object_status_callback"><?php echo $this->_tpl_vars['val']; ?>
</a></li>
					<?php endforeach; endif; unset($_from); ?>
				<?php else: ?>
					<li><a class="<?php if ($this->_tpl_vars['confirm']): ?>cm-confirm <?php endif; ?>status-link-a <?php if ($this->_tpl_vars['status'] == 'A'): ?>cm-active<?php else: ?>cm-ajax<?php endif; ?>"<?php if ($this->_tpl_vars['status_rev']): ?> rev="<?php echo $this->_tpl_vars['status_rev']; ?>
"<?php endif; ?> href="<?php echo fn_url(($this->_tpl_vars['_update_controller']).".update_status?id=".($this->_tpl_vars['id'])."&amp;table=".($this->_tpl_vars['table'])."&amp;id_name=".($this->_tpl_vars['object_id_name'])."&amp;status=A".($this->_tpl_vars['dynamic_object'])); ?>
" onclick="return fn_check_object_status(this, 'a', '');" name="update_object_status_callback"><?php echo fn_get_lang_var('active', $this->getLanguage()); ?>
</a></li>
					<li><a class="<?php if ($this->_tpl_vars['confirm']): ?>cm-confirm <?php endif; ?>status-link-d <?php if ($this->_tpl_vars['status'] == 'D'): ?>cm-active<?php else: ?>cm-ajax<?php endif; ?>"<?php if ($this->_tpl_vars['status_rev']): ?> rev="<?php echo $this->_tpl_vars['status_rev']; ?>
"<?php endif; ?> href="<?php echo fn_url(($this->_tpl_vars['_update_controller']).".update_status?id=".($this->_tpl_vars['id'])."&amp;table=".($this->_tpl_vars['table'])."&amp;id_name=".($this->_tpl_vars['object_id_name'])."&amp;status=D".($this->_tpl_vars['dynamic_object'])); ?>
" onclick="return fn_check_object_status(this, 'd', '');" name="update_object_status_callback"><?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>
</a></li>
					<?php if ($this->_tpl_vars['hidden']): ?>
					<li><a class="<?php if ($this->_tpl_vars['confirm']): ?>cm-confirm <?php endif; ?>status-link-h <?php if ($this->_tpl_vars['status'] == 'H'): ?>cm-active<?php else: ?>cm-ajax<?php endif; ?>"<?php if ($this->_tpl_vars['status_rev']): ?> rev="<?php echo $this->_tpl_vars['status_rev']; ?>
"<?php endif; ?> href="<?php echo fn_url(($this->_tpl_vars['_update_controller']).".update_status?id=".($this->_tpl_vars['id'])."&amp;table=".($this->_tpl_vars['table'])."&amp;id_name=".($this->_tpl_vars['object_id_name'])."&amp;status=H".($this->_tpl_vars['dynamic_object'])); ?>
" onclick="return fn_check_object_status(this, 'h', '');" name="update_object_status_callback"><?php echo fn_get_lang_var('hidden', $this->getLanguage()); ?>
</a></li>
					<?php endif; ?>
					
					<?php if ($this->_tpl_vars['status'] == 'N'): ?>
					<li><a class="<?php if ($this->_tpl_vars['confirm']): ?>cm-confirm <?php endif; ?>status-link-p <?php if ($this->_tpl_vars['status'] == 'P'): ?>cm-active<?php else: ?>cm-ajax<?php endif; ?>"<?php if ($this->_tpl_vars['status_rev']): ?> rev="<?php echo $this->_tpl_vars['status_rev']; ?>
"<?php endif; ?> href="<?php echo fn_url(($this->_tpl_vars['_update_controller']).".update_status?id=".($this->_tpl_vars['id'])."&amp;table=".($this->_tpl_vars['table'])."&amp;id_name=".($this->_tpl_vars['object_id_name'])."&amp;status=P".($this->_tpl_vars['dynamic_object'])); ?>
" onclick="return fn_check_object_status(this, 'p', '');" name="update_object_status_callback"><?php echo fn_get_lang_var('pending', $this->getLanguage()); ?>
</a></li>
					<?php endif; ?>
				<?php endif; ?>
				</ul>
				</div>
				<?php ob_start(); ?>
				<?php if ($this->_tpl_vars['notify']): ?>
					<li class="select-field">
						<input type="checkbox" name="__notify_user" id="<?php echo $this->_tpl_vars['prefix']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
_notify" value="Y" class="checkbox" checked="checked" onclick="$('input[name=__notify_user]').attr('checked', this.checked);" />
						<label for="<?php echo $this->_tpl_vars['prefix']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
_notify"><?php echo smarty_modifier_default(@$this->_tpl_vars['notify_text'], fn_get_lang_var('notify_customer', $this->getLanguage())); ?>
</label>
					</li>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['notify_department']): ?>
					<li class="select-field notify-department">
						<input type="checkbox" name="__notify_department" id="<?php echo $this->_tpl_vars['prefix']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
_notify_department" value="Y" class="checkbox" checked="checked" onclick="$('input[name=__notify_department]').attr('checked', this.checked);" />
						<label for="<?php echo $this->_tpl_vars['prefix']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
_notify_department"><?php echo fn_get_lang_var('notify_orders_department', $this->getLanguage()); ?>
</label>
					</li>
				<?php endif; ?>
				
				<?php if ($this->_tpl_vars['notify_supplier']): ?>
					<li class="select-field notify-department">
						<input type="checkbox" name="__notify_supplier" id="<?php echo $this->_tpl_vars['prefix']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
_notify_supplier" value="Y" class="checkbox" checked="checked" onclick="$('input[name=__notify_supplier]').attr('checked', this.checked);" />
						<label for="<?php echo $this->_tpl_vars['prefix']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
_notify_supplier"><?php if (@PRODUCT_TYPE == 'MULTIVENDOR' || @PRODUCT_TYPE == 'ULTIMATE'): ?><?php echo fn_get_lang_var('notify_vendor', $this->getLanguage()); ?>
<?php else: ?><?php echo fn_get_lang_var('notify_supplier', $this->getLanguage()); ?>
<?php endif; ?></label>
					</li>
				<?php endif; ?>
				
				<?php $this->_smarty_vars['capture']['list_items'] = ob_get_contents(); ob_end_clean(); ?>
				
				<?php if (trim($this->_smarty_vars['capture']['list_items'])): ?>
				<ul class="cm-select-list select-list-tools">
					<?php echo $this->_smarty_vars['capture']['list_items']; ?>

				</ul>
				<?php endif; ?>
			</div>
			<?php if (! $this->_smarty_vars['capture']['avail_box']): ?>
			<script type="text/javascript">
			//<![CDATA[
			<?php echo '
			function fn_check_object_status(obj, status, color) 
			{
				if ($(obj).hasClass(\'cm-active\')) {
					$(obj).removeClass(\'cm-ajax\');
					return false;
				}
				fn_update_object_status(obj, status, color);
				return true;
			}
			function fn_update_object_status_callback(data, params) 
			{
				if (data.return_status && params.obj) {
					var color = data.color ? data.color : \'\';
					fn_update_object_status(params.obj, data.return_status.toLowerCase(), color);
				}
			}
			function fn_update_object_status(obj, status, color)
			{
				var upd_elm_id = $(obj).parents(\'.cm-popup-box:first\').attr(\'id\');
				var upd_elm = $(\'#\' + upd_elm_id);
				upd_elm.hide();
				$(obj).attr(\'href\', fn_query_remove($(obj).attr(\'href\'), [\'notify_user\', \'notify_department\']));
				if ($(\'input[name=__notify_user]:checked\', upd_elm).length) {
					$(obj).attr(\'href\', $(obj).attr(\'href\') + \'&notify_user=Y\');
				}
				if ($(\'input[name=__notify_department]:checked\', upd_elm).length) {
					$(obj).attr(\'href\', $(obj).attr(\'href\') + \'&notify_department=Y\');
				}
				
				if ($(\'input[name=__notify_supplier]:checked\', upd_elm).length) {
					$(obj).attr(\'href\', $(obj).attr(\'href\') + \'&notify_supplier=Y\');
				}
				
				$(\'.cm-select-list li a\', upd_elm).removeClass(\'cm-active\').addClass(\'cm-ajax\');
				$(\'.status-link-\' + status, upd_elm).addClass(\'cm-active\');
				$(\'#sw_\' + upd_elm_id + \' a\').text($(\'.status-link-\' + status, upd_elm).text());
				if (color) {
					$(\'#sw_\' + upd_elm_id).removeAttr(\'class\').addClass(\'selected-status-base \' + $(\'#sw_\' + upd_elm_id + \' a\').attr(\'class\'));
					$(\'#sw_\' + upd_elm_id).children(\'.selected-status-icon:first\').css(\'background-color\', \'#\' + color);
				} else {
					'; ?>

					$('#sw_' + upd_elm_id).removeAttr('class').addClass('selected-status status-<?php if ($this->_tpl_vars['suffix']): ?><?php echo $this->_tpl_vars['suffix']; ?>
-<?php endif; ?>' + status + ' ' + $('#sw_' + upd_elm_id + ' a').attr('class'));
					<?php echo '
				}
			}
			'; ?>

			//]]>
			</script>
			<?php ob_start(); ?>Y<?php $this->_smarty_vars['capture']['avail_box'] = ob_get_contents(); ob_end_clean(); ?>
			<?php endif; ?>
		<?php endif; ?>
	</div>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
			</td>
		</tr>
		<?php endforeach; else: ?>
		<tr class="no-items">
			<td colspan="2"><p><?php echo fn_get_lang_var('no_items', $this->getLanguage()); ?>
</p></td>
		</tr>
		<?php endif; unset($_from); ?>
		</table>
	</div>
	<?php endif; ?>
	
	<div id="content_addons">
		<?php $this->_tag_stack[] = array('hook', array('name' => "profiles:detailed_content")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		<?php if ($this->_tpl_vars['addons']['age_verification']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/age_verification/hooks/profiles/detailed_content.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	</div>

	<?php $this->_tag_stack[] = array('hook', array('name' => "profiles:tabs_content")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

	<p class="select-field notify-customer cm-toggle-button">
		<input type="checkbox" name="notify_customer" value="Y" checked="checked" class="checkbox" id="notify_customer" />
		<label for="notify_customer"><?php echo fn_get_lang_var('notify_user', $this->getLanguage()); ?>
</label>
	</p>

	<div class="buttons-container buttons-bg cm-toggle-button">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[profiles.update]",'hide_first_button' => $this->_tpl_vars['hide_inputs'],'hide_second_button' => $this->_tpl_vars['hide_inputs'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>

	</form>

	<?php if ($this->_tpl_vars['mode'] != 'add'): ?>
		<?php $this->_tag_stack[] = array('hook', array('name' => "profiles:tabs_extra")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	<?php endif; ?>
<?php $this->_smarty_vars['capture']['tabsbox'] = ob_get_contents(); ob_end_clean(); ?>

<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('content' => $this->_smarty_vars['capture']['tabsbox'], 'group_name' => $this->_tpl_vars['controller'], 'active_tab' => $this->_tpl_vars['selected_section'], 'track' => true, )); ?><?php echo smarty_function_script(array('src' => "js/tabs.js"), $this);?>


<?php if (! $this->_tpl_vars['active_tab']): ?>
	<?php $this->assign('active_tab', $this->_tpl_vars['_REQUEST']['selected_section'], false); ?>
<?php endif; ?>

<?php $this->assign('empty_tab_ids', smarty_modifier_empty_tabs($this->_tpl_vars['content']), false); ?>

<?php if ($this->_tpl_vars['navigation']['tabs']): ?>
<div class="tabs cm-j-tabs<?php if ($this->_tpl_vars['track']): ?> cm-track<?php endif; ?>">
	<ul>
	<?php $_from = $this->_tpl_vars['navigation']['tabs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['tabs'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['tabs']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['tab']):
        $this->_foreach['tabs']['iteration']++;
?>
		<?php if (( ! $this->_tpl_vars['tabs_section'] || $this->_tpl_vars['tabs_section'] == $this->_tpl_vars['tab']['section'] ) && ( $this->_tpl_vars['tab']['hidden'] || ! smarty_modifier_in_array($this->_tpl_vars['key'], $this->_tpl_vars['empty_tab_ids']) )): ?>
		<li id="<?php echo $this->_tpl_vars['key']; ?>
<?php echo $this->_tpl_vars['id_suffix']; ?>
" class="<?php if ($this->_tpl_vars['tab']['hidden'] == 'Y'): ?>hidden <?php endif; ?><?php if ($this->_tpl_vars['tab']['js']): ?>cm-js<?php elseif ($this->_tpl_vars['tab']['ajax']): ?>cm-js cm-ajax<?php endif; ?><?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['active_tab']): ?> cm-active<?php endif; ?>"><a <?php if ($this->_tpl_vars['tab']['href']): ?>href="<?php echo fn_url($this->_tpl_vars['tab']['href']); ?>
"<?php endif; ?>><?php echo $this->_tpl_vars['tab']['title']; ?>
</a><?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['active_tab']): ?><?php echo $this->_tpl_vars['active_tab_extra']; ?>
<?php endif; ?></li>
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	</ul>
</div>
<div class="cm-tabs-content">
	<?php echo $this->_tpl_vars['content']; ?>

</div>
<?php else: ?>
	<?php echo $this->_tpl_vars['content']; ?>

<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>

<?php $this->_smarty_vars['capture']['mainbox'] = ob_get_contents(); ob_end_clean(); ?>
<?php if ($this->_tpl_vars['mode'] == 'add'): ?>
	<?php $this->assign('_user_desc', fn_get_user_type_description($this->_tpl_vars['user_type']), false); ?>
	<?php $this->assign('_title', (fn_get_lang_var('new_profile', $this->getLanguage()))." (".($this->_tpl_vars['_user_desc']).")", false); ?>
<?php else: ?>
	<?php if ($this->_tpl_vars['user_data']['firstname']): ?>
		<?php $this->assign('_title', (fn_get_lang_var('editing_profile', $this->getLanguage())).": ".($this->_tpl_vars['user_data']['firstname'])." ".($this->_tpl_vars['user_data']['lastname']), false); ?>
	<?php elseif ($this->_tpl_vars['user_data']['b_firstname']): ?>
		<?php $this->assign('_title', (fn_get_lang_var('editing_profile', $this->getLanguage())).": ".($this->_tpl_vars['user_data']['b_firstname'])." ".($this->_tpl_vars['user_data']['b_lastname']), false); ?>
	<?php else: ?>
		<?php $this->assign('_title', (fn_get_lang_var('editing_profile', $this->getLanguage())).": ".($this->_tpl_vars['user_data']['company']), false); ?>
	<?php endif; ?>
	<?php ob_start(); ?>
		<?php if ($this->_tpl_vars['user_data']['user_type'] == 'C'): ?>
			<a class="tool-link" href="<?php echo fn_url("orders.manage?user_id=".($this->_tpl_vars['user_data']['user_id'])); ?>
"><?php echo fn_get_lang_var('view_all_orders', $this->getLanguage()); ?>
</a>
		<?php endif; ?>
		<?php if (fn_user_need_login($this->_tpl_vars['user_data']['user_type']) && ! defined('COMPANY_ID')): ?>
			<a class="tool-link" href="<?php echo fn_url("profiles.act_as_user?user_id=".($this->_tpl_vars['user_data']['user_id'])); ?>
" target="_blank"><?php echo fn_get_lang_var('act_on_behalf', $this->getLanguage()); ?>
</a>
		<?php endif; ?>
	<?php $this->_smarty_vars['capture']['extra_tools'] = ob_get_contents(); ob_end_clean(); ?>
	<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('url' => "profiles.update?user_id=", )); ?><?php ob_start(); ?>
	<div class="float-right next-prev">
		<?php if ($this->_tpl_vars['prev_id']): ?>
			<?php if ($this->_tpl_vars['links_label']): ?>
			<a href="<?php echo fn_url(($this->_tpl_vars['url']).($this->_tpl_vars['prev_id'])); ?>
">&laquo;&nbsp;<?php echo $this->_tpl_vars['links_label']; ?>
&nbsp;<?php if ($this->_tpl_vars['show_item_id']): ?>#<?php echo $this->_tpl_vars['prev_id']; ?>
<?php endif; ?></a>&nbsp;&nbsp;&nbsp;
			<?php else: ?>
			<a class="lowercase" href="<?php echo fn_url(($this->_tpl_vars['url']).($this->_tpl_vars['prev_id'])); ?>
">&laquo;&nbsp;<?php echo fn_get_lang_var('previous', $this->getLanguage()); ?>
</a>&nbsp;&nbsp;&nbsp;
			<?php endif; ?>
		<?php endif; ?>

		<?php if ($this->_tpl_vars['next_id']): ?>
			<?php if ($this->_tpl_vars['links_label']): ?>
			<a href="<?php echo fn_url(($this->_tpl_vars['url']).($this->_tpl_vars['next_id'])); ?>
"><?php echo $this->_tpl_vars['links_label']; ?>
&nbsp;<?php if ($this->_tpl_vars['show_item_id']): ?>#<?php echo $this->_tpl_vars['next_id']; ?>
<?php endif; ?>&nbsp;&raquo;</a>
			<?php else: ?>
			<a class="lowercase" href="<?php echo fn_url(($this->_tpl_vars['url']).($this->_tpl_vars['next_id'])); ?>
"><?php echo fn_get_lang_var('next', $this->getLanguage()); ?>
&nbsp;&raquo;</a>
			<?php endif; ?>
			
		<?php endif; ?>
	</div>
<?php $this->_smarty_vars['capture']['view_tools'] = ob_get_contents(); ob_end_clean(); ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('title' => $this->_tpl_vars['_title'],'content' => $this->_smarty_vars['capture']['mainbox'],'extra_tools' => $this->_smarty_vars['capture']['extra_tools'],'tools' => $this->_smarty_vars['capture']['view_tools'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>