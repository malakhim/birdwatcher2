<?php /* Smarty version 2.6.18, created on 2014-03-10 12:14:02
         compiled from views/profiles/update.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_compare_shipping_billing', 'views/profiles/update.tpl', 1, false),array('modifier', 'escape', 'views/profiles/update.tpl', 20, false),array('modifier', 'fn_url', 'views/profiles/update.tpl', 58, false),array('modifier', 'fn_needs_image_verification', 'views/profiles/update.tpl', 66, false),array('modifier', 'uniqid', 'views/profiles/update.tpl', 69, false),array('modifier', 'fn_check_user_type_admin_area', 'views/profiles/update.tpl', 169, false),array('modifier', 'trim', 'views/profiles/update.tpl', 228, false),array('modifier', 'empty_tabs', 'views/profiles/update.tpl', 235, false),array('modifier', 'in_array', 'views/profiles/update.tpl', 244, false),array('function', 'script', 'views/profiles/update.tpl', 51, false),array('function', 'cycle', 'views/profiles/update.tpl', 186, false),array('block', 'hook', 'views/profiles/update.tpl', 62, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('image_verification_label','image_verification_body','register_new_account','contact_information','text_multiprofile_notice','billing_address','shipping_address','shipping_address','billing_address','image_verification_label','image_verification_body','revert','usergroup','status','action','active','remove','available','join','declined','join','pending','cancel','profile_details'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/tabsbox.tpl' => 1367063745,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?>
<?php $__parent_tpl_vars = $this->_tpl_vars; ?><script type="text/javascript">
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

<?php if ($this->_tpl_vars['mode'] == 'add' && $this->_tpl_vars['settings']['General']['quick_registration'] == 'Y'): ?>
	<div class="account form-wrap">
	<div class="form-wrap-l"></div>
	<div class="form-wrap-r"></div>
	
		<form name="profiles_register_form" action="<?php echo fn_url(""); ?>
" method="post">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/profiles/components/profile_fields.tpl", 'smarty_include_vars' => array('section' => 'C','nothing_extra' => 'Y')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/profiles/components/profiles_account.tpl", 'smarty_include_vars' => array('nothing_extra' => 'Y','location' => 'checkout')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		
			<?php $this->_tag_stack[] = array('hook', array('name' => "checkout:checkout_steps")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

			<?php if ($this->_tpl_vars['settings']['Image_verification']['use_for_register'] == 'Y'): ?>
				<div class="form-field">
				<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('id' => 'register', 'align' => 'left', )); ?><?php if (fn_needs_image_verification("") == true): ?>	
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
				</div>
			<?php endif; ?>

			<div class="buttons-container left">
				<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/register_profile.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[profiles.update]")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</div>
		</form>
	</div>
	<?php ob_start(); ?><?php echo fn_get_lang_var('register_new_account', $this->getLanguage()); ?>
<?php $this->_smarty_vars['capture']['mainbox_title'] = ob_get_contents(); ob_end_clean(); ?>
<?php else: ?>

	<?php ob_start(); ?>
		<div class="account form-wrap" id="content_general">
			<div class="form-wrap-l"></div>
			<div class="form-wrap-r"></div>
			<form name="profile_form" action="<?php echo fn_url(""); ?>
" method="post">
				<input id="selected_section" type="hidden" value="general" name="selected_section"/>
				<input id="default_card_id" type="hidden" value="" name="default_cc"/>
				<input type="hidden" name="profile_id" value="<?php echo $this->_tpl_vars['user_data']['profile_id']; ?>
" />
				<?php ob_start(); ?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/profiles/components/profiles_account.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/profiles/components/profile_fields.tpl", 'smarty_include_vars' => array('section' => 'C','title' => fn_get_lang_var('contact_information', $this->getLanguage()))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

					<?php if ($this->_tpl_vars['profile_fields']['B'] || $this->_tpl_vars['profile_fields']['S']): ?>
						<?php if ($this->_tpl_vars['settings']['General']['user_multiple_profiles'] == 'Y' && $this->_tpl_vars['mode'] == 'update'): ?>
							<p><?php echo fn_get_lang_var('text_multiprofile_notice', $this->getLanguage()); ?>
</p>
							<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/profiles/components/multiple_profiles.tpl", 'smarty_include_vars' => array('profile_id' => $this->_tpl_vars['user_data']['profile_id'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>	
						<?php endif; ?>

						<?php if ($this->_tpl_vars['settings']['General']['address_position'] == 'billing_first'): ?>
							<?php $this->assign('first_section', 'B', false); ?>
							<?php $this->assign('first_section_text', fn_get_lang_var('billing_address', $this->getLanguage()), false); ?>
							<?php $this->assign('sec_section', 'S', false); ?>
							<?php $this->assign('sec_section_text', fn_get_lang_var('shipping_address', $this->getLanguage()), false); ?>
							<?php $this->assign('body_id', 'sa', false); ?>
						<?php else: ?>
							<?php $this->assign('first_section', 'S', false); ?>
							<?php $this->assign('first_section_text', fn_get_lang_var('shipping_address', $this->getLanguage()), false); ?>
							<?php $this->assign('sec_section', 'B', false); ?>
							<?php $this->assign('sec_section_text', fn_get_lang_var('billing_address', $this->getLanguage()), false); ?>
							<?php $this->assign('body_id', 'ba', false); ?>
						<?php endif; ?>
						
						<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/profiles/components/profile_fields.tpl", 'smarty_include_vars' => array('section' => $this->_tpl_vars['first_section'],'body_id' => "",'ship_to_another' => 'Y','title' => $this->_tpl_vars['first_section_text'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						
						<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/profiles/components/profile_fields.tpl", 'smarty_include_vars' => array('section' => $this->_tpl_vars['sec_section'],'body_id' => $this->_tpl_vars['body_id'],'ship_to_another' => $this->_tpl_vars['ship_to_another'],'title' => $this->_tpl_vars['sec_section_text'],'address_flag' => fn_compare_shipping_billing($this->_tpl_vars['profile_fields']))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php endif; ?>

					<?php $this->_tag_stack[] = array('hook', array('name' => "profiles:account_update")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if ($this->_tpl_vars['addons']['news_and_emails']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/news_and_emails/hooks/profiles/account_update.pre.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?>
					<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

					<?php if (( ! $this->_tpl_vars['user_id']['user_id'] || $this->_tpl_vars['settings']['Image_verification']['hide_if_logged'] != 'Y' ) && $this->_tpl_vars['settings']['Image_verification']['use_for_register'] == 'Y'): ?>
						<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('id' => 'register', 'align' => 'center', )); ?><?php if (fn_needs_image_verification("") == true): ?>	
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

				<?php $this->_smarty_vars['capture']['group'] = ob_get_contents(); ob_end_clean(); ?>
				<?php echo $this->_smarty_vars['capture']['group']; ?>


				<div class="buttons-container left">
					<?php if ($this->_tpl_vars['mode'] == 'add'): ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/register_profile.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[profiles.update]",'but_id' => 'save_profile_but')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php else: ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[profiles.update]",'but_id' => 'save_profile_but')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<input class="account-cancel" type="reset" name="reset" value="<?php echo fn_get_lang_var('revert', $this->getLanguage()); ?>
" id="reset"/>
					<?php endif; ?>
				</div>
			</form>
		</div>
		
		<?php ob_start(); ?>
			<?php if ($this->_tpl_vars['mode'] == 'update'): ?>
				
					<?php if ($this->_tpl_vars['usergroups'] && ! fn_check_user_type_admin_area($this->_tpl_vars['user_data'])): ?>
					<div id="content_usergroups">
						<table border="0" cellpadding="0" cellspacing="0" width="100%" class="table">
						<tr>
							<th width="30%"><?php echo fn_get_lang_var('usergroup', $this->getLanguage()); ?>
</th>
							<th width="30%"><?php echo fn_get_lang_var('status', $this->getLanguage()); ?>
</th>
							<?php if ($this->_tpl_vars['settings']['General']['allow_usergroup_signup'] == 'Y'): ?>
								<th width="40%"><?php echo fn_get_lang_var('action', $this->getLanguage()); ?>
</th>
							<?php endif; ?>
						</tr>
						<?php $_from = $this->_tpl_vars['usergroups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['usergroup']):
?>
							<?php if ($this->_tpl_vars['user_data']['usergroups'][$this->_tpl_vars['usergroup']['usergroup_id']]): ?>
								<?php $this->assign('ug_status', $this->_tpl_vars['user_data']['usergroups'][$this->_tpl_vars['usergroup']['usergroup_id']]['status'], false); ?>
							<?php else: ?>
								<?php $this->assign('ug_status', 'F', false); ?>
							<?php endif; ?>
							<?php if ($this->_tpl_vars['settings']['General']['allow_usergroup_signup'] == 'Y' || $this->_tpl_vars['settings']['General']['allow_usergroup_signup'] != 'Y' && $this->_tpl_vars['ug_status'] == 'A'): ?>
								<tr <?php echo smarty_function_cycle(array('values' => ",class=\"table-row\""), $this);?>
>
									<td><?php echo $this->_tpl_vars['usergroup']['usergroup']; ?>
</td>
									<td class="center">
										<?php if ($this->_tpl_vars['ug_status'] == 'A'): ?>
											<?php echo fn_get_lang_var('active', $this->getLanguage()); ?>

											<?php $this->assign('_link_text', fn_get_lang_var('remove', $this->getLanguage()), false); ?>
										<?php elseif ($this->_tpl_vars['ug_status'] == 'F'): ?>
											<?php echo fn_get_lang_var('available', $this->getLanguage()); ?>

											<?php $this->assign('_link_text', fn_get_lang_var('join', $this->getLanguage()), false); ?>
										<?php elseif ($this->_tpl_vars['ug_status'] == 'D'): ?>
											<?php echo fn_get_lang_var('declined', $this->getLanguage()); ?>

											<?php $this->assign('_link_text', fn_get_lang_var('join', $this->getLanguage()), false); ?>
										<?php elseif ($this->_tpl_vars['ug_status'] == 'P'): ?>
											<?php echo fn_get_lang_var('pending', $this->getLanguage()); ?>

											<?php $this->assign('_link_text', fn_get_lang_var('cancel', $this->getLanguage()), false); ?>
										<?php endif; ?>
									</td>
									<?php if ($this->_tpl_vars['settings']['General']['allow_usergroup_signup'] == 'Y'): ?>
										<td>
											<a class="cm-ajax" rev="content_usergroups" href="<?php echo fn_url("profiles.request_usergroup?usergroup_id=".($this->_tpl_vars['usergroup']['usergroup_id'])."&amp;status=".($this->_tpl_vars['ug_status'])); ?>
"><?php echo $this->_tpl_vars['_link_text']; ?>
</a>
										</td>
									<?php endif; ?>
								</tr>
							<?php endif; ?>
						<?php endforeach; endif; unset($_from); ?>
						<tr class="table-footer">
							<td colspan="<?php if ($this->_tpl_vars['settings']['General']['allow_usergroup_signup'] == 'Y'): ?>3<?php else: ?>2<?php endif; ?>">&nbsp;</td>
						</tr>
						</table>
					<!--content_usergroups--></div>
					<?php endif; ?>
				

				<?php $this->_tag_stack[] = array('hook', array('name' => "profiles:tabs")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			<?php endif; ?>
		<?php $this->_smarty_vars['capture']['additional_tabs'] = ob_get_contents(); ob_end_clean(); ?>

		<?php echo $this->_smarty_vars['capture']['additional_tabs']; ?>


	<?php $this->_smarty_vars['capture']['tabsbox'] = ob_get_contents(); ob_end_clean(); ?>

	<?php if (trim($this->_smarty_vars['capture']['additional_tabs']) != ""): ?>
		<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('content' => $this->_smarty_vars['capture']['tabsbox'], 'active_tab' => $this->_tpl_vars['_REQUEST']['selected_section'], 'track' => true, )); ?><?php if (! $this->_tpl_vars['active_tab']): ?>
	<?php $this->assign('active_tab', $this->_tpl_vars['_REQUEST']['selected_section'], false); ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['navigation']['tabs']): ?>

<?php $this->assign('empty_tab_ids', smarty_modifier_empty_tabs($this->_tpl_vars['content']), false); ?>
<?php $this->assign('_tabs', false, false); ?>

<?php if ($this->_tpl_vars['top_order_actions']): ?><?php echo $this->_tpl_vars['top_order_actions']; ?>
<?php endif; ?>

<?php echo smarty_function_script(array('src' => "js/tabs.js"), $this);?>

<div class="tabs cm-j-tabs<?php if ($this->_tpl_vars['track']): ?> cm-track<?php endif; ?> clearfix">
	<ul <?php if ($this->_tpl_vars['tabs_section']): ?>id="tabs_<?php echo $this->_tpl_vars['tabs_section']; ?>
"<?php endif; ?>>
	<?php $_from = $this->_tpl_vars['navigation']['tabs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['tabs'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['tabs']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['tab']):
        $this->_foreach['tabs']['iteration']++;
?>
		<?php if (( ( ! $this->_tpl_vars['tabs_section'] && ! $this->_tpl_vars['tab']['section'] ) || ( $this->_tpl_vars['tabs_section'] == $this->_tpl_vars['tab']['section'] ) ) && ! smarty_modifier_in_array($this->_tpl_vars['key'], $this->_tpl_vars['empty_tab_ids'])): ?>
		<?php if (! $this->_tpl_vars['active_tab']): ?>
			<?php $this->assign('active_tab', $this->_tpl_vars['key'], false); ?>
		<?php endif; ?>
		<?php $this->assign('_tabs', true, false); ?>
		<li id="<?php echo $this->_tpl_vars['key']; ?>
" class="<?php if ($this->_tpl_vars['tab']['js']): ?>cm-js<?php elseif ($this->_tpl_vars['tab']['ajax']): ?>cm-js cm-ajax<?php endif; ?><?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['active_tab']): ?> cm-active<?php endif; ?>"><a<?php if ($this->_tpl_vars['tab']['href']): ?> href="<?php echo fn_url($this->_tpl_vars['tab']['href']); ?>
"<?php endif; ?>><?php echo $this->_tpl_vars['tab']['title']; ?>
</a></li>
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	</ul>
</div>

<?php if ($this->_tpl_vars['_tabs']): ?>
<div class="cm-tabs-content clearfix" id="tabs_content">
	<?php echo $this->_tpl_vars['content']; ?>

</div>
<?php endif; ?>

<?php if ($this->_tpl_vars['onclick']): ?>
<script type="text/javascript">
//<![CDATA[
	var hndl = <?php echo $this->_tpl_vars['ldelim']; ?>

		'tabs_<?php echo $this->_tpl_vars['tabs_section']; ?>
': <?php echo $this->_tpl_vars['onclick']; ?>

	<?php echo $this->_tpl_vars['rdelim']; ?>

//]]>
</script>
<?php endif; ?>
<?php else: ?>
	<?php echo $this->_tpl_vars['content']; ?>

<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	<?php else: ?>
		<?php echo $this->_smarty_vars['capture']['tabsbox']; ?>

	<?php endif; ?>

	<?php ob_start(); ?><?php echo fn_get_lang_var('profile_details', $this->getLanguage()); ?>
<?php $this->_smarty_vars['capture']['mainbox_title'] = ob_get_contents(); ob_end_clean(); ?>
<?php endif; ?>