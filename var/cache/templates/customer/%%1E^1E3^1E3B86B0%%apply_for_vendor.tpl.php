<?php /* Smarty version 2.6.18, created on 2014-03-06 17:03:03
         compiled from views/companies/apply_for_vendor.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'views/companies/apply_for_vendor.tpl', 19, false),array('modifier', 'fn_url', 'views/companies/apply_for_vendor.tpl', 60, false),array('modifier', 'count', 'views/companies/apply_for_vendor.tpl', 72, false),array('modifier', 'key', 'views/companies/apply_for_vendor.tpl', 82, false),array('modifier', 'default', 'views/companies/apply_for_vendor.tpl', 191, false),array('modifier', 'fn_needs_image_verification', 'views/companies/apply_for_vendor.tpl', 223, false),array('modifier', 'uniqid', 'views/companies/apply_for_vendor.tpl', 226, false),array('modifier', 'replace', 'views/companies/apply_for_vendor.tpl', 267, false),array('function', 'script', 'views/companies/apply_for_vendor.tpl', 50, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('apply_for_vendor_account','company','description','language','account_name','first_name','last_name','contact_information','contact_information','email','phone','url','fax','shipping_address','shipping_address','address','city','country','select_country','state','select_state','zip_postal_code','image_verification_label','image_verification_body','submit','delete'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'buttons/button.tpl' => 1372320684,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><div class="company">
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

<h1 class="mainbox-title"><span><?php echo fn_get_lang_var('apply_for_vendor_account', $this->getLanguage()); ?>
</span></h1>

<div class="form-wrap">
	<div class="form-wrap-l"></div>
	<div class="form-wrap-r"></div>
	
<div id="apply_for_vendor_account" > 
<form action="<?php echo fn_url("companies.apply_for_vendor"); ?>
" method="post" name="apply_for_vendor_form">

<div class="form-field">
	<label for="company_description_company" class="cm-required"><?php echo fn_get_lang_var('company', $this->getLanguage()); ?>
</label>
	<input type="text" name="company_data[company]" id="company_description_company" size="32" value="<?php echo $this->_tpl_vars['company_data']['company']; ?>
" class="input-text" />
</div>

<div class="form-field">
	<label for="company_description"><?php echo fn_get_lang_var('description', $this->getLanguage()); ?>
</label>
	<textarea id="company_description" name="company_data[company_description]" cols="55" rows="5" class="input-textarea-long"><?php echo $this->_tpl_vars['company_data']['company_description']; ?>
</textarea>
</div>

<?php if (count($this->_tpl_vars['languages']) > 1): ?>
<div class="form-field">
	<label for="company_language"><?php echo fn_get_lang_var('language', $this->getLanguage()); ?>
</label>
	<select name="company_data[lang_code]" id="company_language">
		<?php $_from = $this->_tpl_vars['languages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['lang_code'] => $this->_tpl_vars['language']):
?>
			<option value="<?php echo $this->_tpl_vars['lang_code']; ?>
" <?php if ($this->_tpl_vars['lang_code'] == $this->_tpl_vars['company_data']['lang_code']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['language']['name']; ?>
</option>
		<?php endforeach; endif; unset($_from); ?>
	</select>
</div>
<?php else: ?>
<input type="hidden" name="company_data[lang_code]" value="<?php echo key($this->_tpl_vars['languages']); ?>
" />
<?php endif; ?>

<?php if (! $this->_tpl_vars['auth']['user_id'] && $this->_tpl_vars['settings']['Suppliers']['create_vendor_administrator_account'] == 'Y'): ?>

	<?php echo '
	<script type="text/javascript">
	//<![CDATA[

	function fn_toggle_required_fields() {
		var f = $(\'#company_admin_firstname\'); 
		var l = $(\'#company_admin_lastname\'); 
		if ($(\'#company_request_account_name\').val() == \'\') {
			f.attr(\'disabled\', true); f.addClass(\'disabled\');
			l.attr(\'disabled\', true); l.addClass(\'disabled\');

			$(\'.cm-profile-field\').each(function(index){
				if ($(\'#\' + $(this).attr(\'for\')).children() != null) {
					// Traverse subitems
					$(\'.\' + $(this).attr(\'for\')).attr(\'disabled\', true);
					$(\'.\' + $(this).attr(\'for\')).addClass(\'disabled\');
				}
				$(\'#\' + $(this).attr(\'for\')).attr(\'disabled\', true);
				$(\'#\' + $(this).attr(\'for\')).addClass(\'disabled\');
			});
		} else {
			f.removeAttr(\'disabled\'); f.removeClass(\'disabled\');
			l.removeAttr(\'disabled\'); l.removeClass(\'disabled\');

			$(\'.cm-profile-field\').each(function(index){
				if ($(\'#\' + $(this).attr(\'for\')).children() != null) {
					// Traverse subitems
					$(\'.\' + $(this).attr(\'for\')).removeAttr(\'disabled\');
					$(\'.\' + $(this).attr(\'for\')).removeClass(\'disabled\');
				}
				$(\'#\' + $(this).attr(\'for\')).removeAttr(\'disabled\');
				$(\'#\' + $(this).attr(\'for\')).removeClass(\'disabled\');
			});
		}
	}
	//]]>
	</script>
	'; ?>


	<?php if ($this->_tpl_vars['settings']['General']['use_email_as_login'] != 'Y'): ?>
		<?php $this->assign('disabled_by_default', true, false); ?>
		<div class="form-field" id="company_description_admin">
			<label for="company_request_account_name" class="cm-trim"><?php echo fn_get_lang_var('account_name', $this->getLanguage()); ?>
</label>
			<input type="text" name="company_data[request_account_name]" id="company_request_account_name" size="32" value="<?php echo $this->_tpl_vars['company_data']['request_account_name']; ?>
" class="input-text" onkeyup="fn_toggle_required_fields();"/>
		</div>
	<?php else: ?>
		<?php $this->assign('disabled_by_default', false, false); ?>
	<?php endif; ?>
	<div class="form-field shipping-first-name" id="company_description_admin_firstname">
		<label for="company_admin_firstname" class="cm-required"><?php echo fn_get_lang_var('first_name', $this->getLanguage()); ?>
</label>
		<input type="text" name="company_data[admin_firstname]" id="company_admin_firstname" size="32" value="<?php echo $this->_tpl_vars['company_data']['admin_firstname']; ?>
" class="input-text<?php if ($this->_tpl_vars['settings']['General']['use_email_as_login'] != 'Y'): ?> disabled" disabled="disabled"<?php else: ?>"<?php endif; ?>/>
	</div>
	<div class="form-field shipping-last-name" id="company_description_admin_lastname">
		<label for="company_admin_lastname" class="cm-required"><?php echo fn_get_lang_var('last_name', $this->getLanguage()); ?>
</label>
		<input type="text" name="company_data[admin_lastname]" id="company_admin_lastname" size="32" value="<?php echo $this->_tpl_vars['company_data']['admin_lastname']; ?>
" class="input-text<?php if ($this->_tpl_vars['settings']['General']['use_email_as_login'] != 'Y'): ?> disabled" disabled="disabled"<?php else: ?>"<?php endif; ?>/>
	</div>

<?php endif; ?>

<?php if (! $this->_tpl_vars['auth']['user_id']): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/profiles/components/profile_fields.tpl", 'smarty_include_vars' => array('section' => 'C','title' => fn_get_lang_var('contact_information', $this->getLanguage()),'disabled_by_default' => $this->_tpl_vars['disabled_by_default'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php else: ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('contact_information', $this->getLanguage()))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>

<div class="form-field">
	<label for="company_description_email" class="cm-required cm-email cm-trim"><?php echo fn_get_lang_var('email', $this->getLanguage()); ?>
</label>
	<input type="text" name="company_data[email]" id="company_description_email" size="32" value="<?php echo $this->_tpl_vars['company_data']['email']; ?>
" class="input-text" />
</div>

<div class="form-field">
	<label for="company_description_phone" class="cm-required"><?php echo fn_get_lang_var('phone', $this->getLanguage()); ?>
</label>
	<input type="text" name="company_data[phone]" id="company_description_phone" size="32" value="<?php echo $this->_tpl_vars['company_data']['phone']; ?>
" class="input-text" />
</div>

<div class="form-field">
	<label for="company_description_url"><?php echo fn_get_lang_var('url', $this->getLanguage()); ?>
</label>
	<input type="text" name="company_data[url]" id="company_description_url" size="32" value="<?php echo $this->_tpl_vars['company_data']['url']; ?>
" class="input-text" />
</div>

<div class="form-field">
	<label for="company_description_fax"><?php echo fn_get_lang_var('fax', $this->getLanguage()); ?>
</label>
	<input type="text" name="company_data[fax]" id="company_description_fax" size="32" value="<?php echo $this->_tpl_vars['company_data']['fax']; ?>
" class="input-text" />
</div>


<?php if (! $this->_tpl_vars['auth']['user_id']): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/profiles/components/profile_fields.tpl", 'smarty_include_vars' => array('section' => 'B','title' => fn_get_lang_var('shipping_address', $this->getLanguage()),'shipping_flag' => false,'disabled_by_default' => $this->_tpl_vars['disabled_by_default'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php else: ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('shipping_address', $this->getLanguage()))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 
<?php endif; ?>

<div class="form-field ">
	<label for="company_address_address" class="cm-required"><?php echo fn_get_lang_var('address', $this->getLanguage()); ?>
</label>
	<input type="text" name="company_data[address]" id="company_address_address" size="32" value="<?php echo $this->_tpl_vars['company_data']['address']; ?>
" class="input-text" />
</div>

<div class="form-field">
	<label for="company_address_city" class="cm-required"><?php echo fn_get_lang_var('city', $this->getLanguage()); ?>
</label>
	<input type="text" name="company_data[city]" id="company_address_city" size="32" value="<?php echo $this->_tpl_vars['company_data']['city']; ?>
" class="input-text" />
</div>

<div class="form-field  shipping-country">
	<label for="company_address_country" class="cm-required cm-country cm-location-shipping"><?php echo fn_get_lang_var('country', $this->getLanguage()); ?>
</label>
	<?php $this->assign('_country', smarty_modifier_default(@$this->_tpl_vars['company_data']['country'], @$this->_tpl_vars['settings']['General']['default_country']), false); ?>
	<select id="company_address_country" name="company_data[country]">
		<option value="">- <?php echo fn_get_lang_var('select_country', $this->getLanguage()); ?>
 -</option>
		<?php $_from = $this->_tpl_vars['countries']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['country']):
?>
		<option <?php if ($this->_tpl_vars['_country'] == $this->_tpl_vars['country']['code']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['country']['code']; ?>
"><?php echo $this->_tpl_vars['country']['country']; ?>
</option>
		<?php endforeach; endif; unset($_from); ?>
	</select>
</div>

<div class="form-field shipping-state">
	<?php $this->assign('country_code', smarty_modifier_default(@$this->_tpl_vars['company_data']['country'], @$this->_tpl_vars['settings']['General']['default_country']), false); ?>
	<?php $this->assign('state_code', smarty_modifier_default(@$this->_tpl_vars['company_data']['state'], @$this->_tpl_vars['settings']['General']['default_state']), false); ?>
	<label for="company_address_state" class="cm-required cm-state cm-location-shipping"><?php echo fn_get_lang_var('state', $this->getLanguage()); ?>
</label>
	<select id="company_address_state" name="company_data[state]" <?php if (! $this->_tpl_vars['states'][$this->_tpl_vars['country_code']]): ?>class="hidden"<?php endif; ?>>
		<option value="">- <?php echo fn_get_lang_var('select_state', $this->getLanguage()); ?>
 -</option>
				<?php if ($this->_tpl_vars['states'][$this->_tpl_vars['country_code']]): ?>
			<?php $_from = $this->_tpl_vars['states'][$this->_tpl_vars['country_code']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['state']):
?>
				<option <?php if ($this->_tpl_vars['state_code'] == $this->_tpl_vars['state']['code']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['state']['code']; ?>
"><?php echo $this->_tpl_vars['state']['state']; ?>
</option>
			<?php endforeach; endif; unset($_from); ?>
		<?php endif; ?>
	</select>
	<input type="text" id="company_address_state_d" name="company_data[state]" size="32" maxlength="64" value="<?php echo $this->_tpl_vars['company_data']['state']; ?>
" <?php if ($this->_tpl_vars['states'][$this->_tpl_vars['country_code']]): ?>disabled="disabled"<?php endif; ?> class="input-text <?php if ($this->_tpl_vars['states'][$this->_tpl_vars['country_code']]): ?>hidden<?php endif; ?> cm-skip-avail-switch" />
	<input type="hidden" id="company_address_state_default" value="<?php echo $this->_tpl_vars['settings']['General']['default_state']; ?>
" />
</div>

<div class="form-field shipping-zip-code">
	<label for="company_address_zipcode" class="cm-required cm-zipcode cm-location-shipping"><?php echo fn_get_lang_var('zip_postal_code', $this->getLanguage()); ?>
</label>
	<input type="text" name="company_data[zipcode]" id="company_address_zipcode" size="32" value="<?php echo $this->_tpl_vars['company_data']['zipcode']; ?>
" class="input-text" />
</div>

<?php if ($this->_tpl_vars['settings']['Image_verification']['use_for_apply_for_vendor_account'] == 'Y'): ?>
 	<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('id' => 'apply_for_vendor_account', 'align' => 'left', )); ?><?php if (fn_needs_image_verification("") == true): ?>	
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

<div class="buttons-container">
	<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('but_text' => fn_get_lang_var('submit', $this->getLanguage()), 'but_name' => "dispatch[companies.apply_for_vendor]", 'but_id' => 'but_apply_for_vendor', )); ?>

<?php if ($this->_tpl_vars['but_role'] == 'action'): ?>
	<?php $this->assign('suffix', "-action", false); ?>
	<?php $this->assign('file_prefix', 'action_', false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'act'): ?>
	<?php $this->assign('suffix', "-act", false); ?>
	<?php $this->assign('file_prefix', 'action_', false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'disabled_big'): ?>
	<?php $this->assign('suffix', "-disabled-big", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'big'): ?>
	<?php $this->assign('suffix', "-big", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'delete'): ?>
	<?php $this->assign('suffix', "-delete", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'tool'): ?>
	<?php $this->assign('suffix', "-tool", false); ?>
<?php else: ?>
	<?php $this->assign('suffix', "", false); ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['but_name'] && $this->_tpl_vars['but_role'] != 'text' && $this->_tpl_vars['but_role'] != 'act' && $this->_tpl_vars['but_role'] != 'delete'): ?> 
	<span <?php if ($this->_tpl_vars['but_id']): ?>id="wrap_<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_css']): ?>style="<?php echo $this->_tpl_vars['but_css']; ?>
"<?php endif; ?> class="button-submit<?php echo $this->_tpl_vars['suffix']; ?>
 button-wrap-left"><span <?php if ($this->_tpl_vars['but_css']): ?>style="<?php echo $this->_tpl_vars['but_css']; ?>
"<?php endif; ?> class="button-submit<?php echo $this->_tpl_vars['suffix']; ?>
 button-wrap-right"><input <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_meta']): ?>class="<?php echo $this->_tpl_vars['but_meta']; ?>
"<?php endif; ?> type="submit" name="<?php echo $this->_tpl_vars['but_name']; ?>
" <?php if ($this->_tpl_vars['but_onclick']): ?>onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
"<?php endif; ?> value="<?php echo $this->_tpl_vars['but_text']; ?>
" /></span></span>

<?php elseif ($this->_tpl_vars['but_role'] == 'text' || $this->_tpl_vars['but_role'] == 'act' || $this->_tpl_vars['but_role'] == 'edit' || ( $this->_tpl_vars['but_role'] == 'text' && $this->_tpl_vars['but_name'] )): ?> 

	<a class="<?php if ($this->_tpl_vars['but_meta']): ?><?php echo $this->_tpl_vars['but_meta']; ?>
 <?php endif; ?><?php if ($this->_tpl_vars['but_name']): ?>cm-submit-link <?php endif; ?>text-button<?php echo $this->_tpl_vars['suffix']; ?>
"<?php if ($this->_tpl_vars['but_id']): ?> id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_name']): ?> name="<?php echo smarty_modifier_replace(smarty_modifier_replace($this->_tpl_vars['but_name'], "[", ":-"), "]", "-:"); ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_href']): ?> href="<?php echo fn_url($this->_tpl_vars['but_href']); ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_onclick']): ?> onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
 return false;"<?php endif; ?><?php if ($this->_tpl_vars['but_target']): ?> target="<?php echo $this->_tpl_vars['but_target']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_rel']): ?> rel="<?php echo $this->_tpl_vars['but_rel']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?>><?php echo $this->_tpl_vars['but_text']; ?>
</a>

<?php elseif ($this->_tpl_vars['but_role'] == 'delete'): ?>

	<a <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_name']): ?> name="<?php echo smarty_modifier_replace(smarty_modifier_replace($this->_tpl_vars['but_name'], "[", ":-"), "]", "-:"); ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_href']): ?>href="<?php echo fn_url($this->_tpl_vars['but_href']); ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_onclick']): ?> onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
 return false;"<?php endif; ?><?php if ($this->_tpl_vars['but_meta']): ?> class="<?php echo $this->_tpl_vars['but_meta']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_target']): ?> target="<?php echo $this->_tpl_vars['but_target']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_rel']): ?> rel="<?php echo $this->_tpl_vars['but_rel']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?>><span title="<?php echo fn_get_lang_var('delete', $this->getLanguage()); ?>
" class="icon-delete-small"></span></a>

<?php elseif ($this->_tpl_vars['but_role'] == 'icon'): ?> 
	<a <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_href']): ?> href="<?php echo fn_url($this->_tpl_vars['but_href']); ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_onclick']): ?>onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
;<?php if (! $this->_tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> <?php if ($this->_tpl_vars['but_target']): ?>target="<?php echo $this->_tpl_vars['but_target']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_rel']): ?> rel="<?php echo $this->_tpl_vars['but_rel']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?> class="<?php if ($this->_tpl_vars['but_meta']): ?> <?php echo $this->_tpl_vars['but_meta']; ?>
<?php endif; ?>"><?php echo $this->_tpl_vars['but_text']; ?>
</a>

<?php else: ?> 

	<span class="button<?php echo $this->_tpl_vars['suffix']; ?>
 button-wrap-left" <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?>><span class="button<?php echo $this->_tpl_vars['suffix']; ?>
 button-wrap-right"><a <?php if ($this->_tpl_vars['but_href']): ?>href="<?php echo fn_url($this->_tpl_vars['but_href']); ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_onclick']): ?> onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
 return false;"<?php endif; ?> <?php if ($this->_tpl_vars['but_target']): ?>target="<?php echo $this->_tpl_vars['but_target']; ?>
"<?php endif; ?> class="<?php if ($this->_tpl_vars['but_meta']): ?><?php echo $this->_tpl_vars['but_meta']; ?>
 <?php endif; ?>" <?php if ($this->_tpl_vars['but_rel']): ?> rel="<?php echo $this->_tpl_vars['but_rel']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_rev']): ?>rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?>><?php echo $this->_tpl_vars['but_text']; ?>
</a></span></span>

<?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
</div>



</form>

	</div>
</div>
</div>