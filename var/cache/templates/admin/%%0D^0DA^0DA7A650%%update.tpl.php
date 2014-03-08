<?php /* Smarty version 2.6.18, created on 2014-03-08 23:32:41
         compiled from views/companies/update.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'replace', 'views/companies/update.tpl', 1, false),array('modifier', 'escape', 'views/companies/update.tpl', 27, false),array('modifier', 'fn_url', 'views/companies/update.tpl', 64, false),array('modifier', 'defined', 'views/companies/update.tpl', 87, false),array('modifier', 'is_array', 'views/companies/update.tpl', 114, false),array('modifier', 'fn_from_json', 'views/companies/update.tpl', 115, false),array('modifier', 'default', 'views/companies/update.tpl', 118, false),array('modifier', 'lower', 'views/companies/update.tpl', 118, false),array('modifier', 'cat', 'views/companies/update.tpl', 368, false),array('modifier', 'md5', 'views/companies/update.tpl', 368, false),array('modifier', 'count', 'views/companies/update.tpl', 402, false),array('modifier', 'explode', 'views/companies/update.tpl', 480, false),array('modifier', 'in_array', 'views/companies/update.tpl', 486, false),array('modifier', 'empty_tabs', 'views/companies/update.tpl', 529, false),array('function', 'script', 'views/companies/update.tpl', 57, false),array('function', 'cycle', 'views/companies/update.tpl', 483, false),array('block', 'hook', 'views/companies/update.tpl', 78, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('available_for_vendor','new_vendor','editing_vendor','information','company','active','hidden','disabled','status','active','hidden','disabled','status','active','hidden','pending','disabled','status','active','pending','disabled','language','create_administrator_account','account_name','first_name','last_name','vendor_commission','request_account_name','contact_information','contact_information','email','phone','url','fax','shipping_address','shipping_address','address','city','country','select_country','state','select_state','zip_postal_code','description','upload_another_file','local','local','remove_this_item','remove_this_item','remove_this_item','remove_this_item','text_select_file','upload_another_file','local','server','url','alt_text','text_all_items_included','categories','shipping_methods','no_items'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/tabsbox.tpl' => 1367063753,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?>
<?php $this->assign('lang_available_for_vendor_supplier', fn_get_lang_var('available_for_vendor', $this->getLanguage()), false); ?>
<?php $this->assign('lang_new_vendor_supplier', fn_get_lang_var('new_vendor', $this->getLanguage()), false); ?>
<?php $this->assign('lang_editing_vendor_supplier', fn_get_lang_var('editing_vendor', $this->getLanguage()), false); ?>





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

<?php ob_start(); ?>

<?php ob_start(); ?>

<form action="<?php echo fn_url(""); ?>
" method="post" class="<?php echo $this->_tpl_vars['form_class']; ?>
" id="company_update_form" enctype="multipart/form-data"> <input type="hidden" name="fake" value="1" />
<input type="hidden" name="selected_section" id="selected_section" value="<?php echo $this->_tpl_vars['_REQUEST']['selected_section']; ?>
" />
<input type="hidden" name="company_id" value="<?php echo $this->_tpl_vars['company_data']['company_id']; ?>
" />

<div id="content_detailed"> <fieldset>



<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('information', $this->getLanguage()))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $this->_tag_stack[] = array('hook', array('name' => "companies:general_information")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<div class="form-field">
	<label for="company_description_company" class="cm-required"><?php echo fn_get_lang_var('company', $this->getLanguage()); ?>
:</label>
	<input type="text" name="company_data[company]" id="company_description_company" size="32" value="<?php echo $this->_tpl_vars['company_data']['company']; ?>
" class="input-text" />
</div>




<?php if (! defined('COMPANY_ID')): ?>
	<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('input_name' => "company_data[status]", 'id' => 'company_data', 'obj' => $this->_tpl_vars['company_data'], )); ?><?php if ($this->_tpl_vars['display'] == 'select'): ?>
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
<?php else: ?>
<div class="form-field">
	<label><?php echo fn_get_lang_var('status', $this->getLanguage()); ?>
:</label>
	<div class="select-field">
		<input type="radio" checked="checked" class="radio" /><label><?php if ($this->_tpl_vars['company_data']['status'] == 'A'): ?><?php echo fn_get_lang_var('active', $this->getLanguage()); ?>
<?php elseif ($this->_tpl_vars['company_data']['status'] == 'P'): ?><?php echo fn_get_lang_var('pending', $this->getLanguage()); ?>
<?php elseif ($this->_tpl_vars['company_data']['status'] == 'D'): ?><?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>
<?php endif; ?></label>
	</div>
</div>
<?php endif; ?>



<div class="form-field">
	<label for="company_language"><?php echo fn_get_lang_var('language', $this->getLanguage()); ?>
:</label>
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



	<?php if (@MODE == 'add'): ?>
		<?php echo '
		<script type="text/javascript">
		//<![CDATA[
		function fn_toggle_required_fields() {

			if ($(\'#company_description_vendor_admin\').attr(\'checked\')) {
				$(\'#company_description_username\').removeAttr(\'disabled\');
				$(\'#company_description_first_name\').removeAttr(\'disabled\');
				$(\'#company_description_last_name\').removeAttr(\'disabled\');

				$(\'.cm-profile-field\').each(function(index){
					$(\'#\' + $(this).attr(\'for\')).removeAttr(\'disabled\');
				});

			} else {
				$(\'#company_description_username\').attr(\'disabled\', true);
				$(\'#company_description_first_name\').attr(\'disabled\', true);
				$(\'#company_description_last_name\').attr(\'disabled\', true);

				$(\'.cm-profile-field\').each(function(index){
					$(\'#\' + $(this).attr(\'for\')).attr(\'disabled\', true);
				});
			}
		}
		
		function fn_switch_store_settings(elm)
		{
			jelm = $(elm);
			var close = true;
			if (jelm.val() != \'all\' && jelm.val() != \'\') {
				close = false;
			}
			
			$(\'#clone_settings_container\').toggleBy(close);
		}
		
		function fn_check_dependence(object, enabled)
		{
			if (enabled) {
				$(\'.cm-dependence-\' + object).attr(\'checked\', \'checked\').attr(\'readonly\', \'readonly\').bind(\'click\', function(e) {return false;});
			} else {
				$(\'.cm-dependence-\' + object).removeAttr(\'readonly\').unbind(\'click\');
			}
		}
		//]]>
		</script>
		'; ?>

		
		<?php if (@PRODUCT_TYPE != 'ULTIMATE'): ?>
			<div class="form-field">
				<label for="company_description_vendor_admin"><?php echo fn_get_lang_var('create_administrator_account', $this->getLanguage()); ?>
:</label>
				<input type="checkbox" name="company_data[is_create_vendor_admin]" id="company_description_vendor_admin" checked="checked" value="Y" onchange="fn_toggle_required_fields();" class="checkbox" />
			</div>
			<?php if ($this->_tpl_vars['settings']['General']['use_email_as_login'] != 'Y'): ?>
			<div class="form-field" id="company_description_admin">
				<label for="company_description_username" class="cm-required"><?php echo fn_get_lang_var('account_name', $this->getLanguage()); ?>
:</label>
				<input type="text" name="company_data[admin_username]" id="company_description_username" size="32" value="<?php echo $this->_tpl_vars['company_data']['admin_username']; ?>
" class="input-text" />
			</div>
			<div class="form-field">
				<label for="company_description_first_name" class="cm-required"><?php echo fn_get_lang_var('first_name', $this->getLanguage()); ?>
:</label>
				<input type="text" name="company_data[admin_firstname]" id="company_description_first_name" size="32" value="<?php echo $this->_tpl_vars['company_data']['admin_first_name']; ?>
" class="input-text" />
			</div>
			<div class="form-field">
				<label for="company_description_last_name" class="cm-required"><?php echo fn_get_lang_var('last_name', $this->getLanguage()); ?>
:</label>
				<input type="text" name="company_data[admin_lastname]" id="company_description_last_name" size="32" value="<?php echo $this->_tpl_vars['company_data']['admin_last_name']; ?>
" class="input-text" />
			</div>
		<?php endif; ?>
		<?php endif; ?>
	<?php endif; ?>
	<?php if (! defined('COMPANY_ID') && @PRODUCT_TYPE == 'MULTIVENDOR'): ?>
	<div class="form-field">
		<label for="company_vendor_commission"><?php echo fn_get_lang_var('vendor_commission', $this->getLanguage()); ?>
:</label>
		<input type="text" name="company_data[commission]" id="company_vendor_commission" value="<?php echo $this->_tpl_vars['company_data']['commission']; ?>
" class="input-text-medium" />
		<select name="company_data[commission_type]">
			<option value="A" <?php if ($this->_tpl_vars['company_data']['commission_type'] == 'A'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']]['symbol']; ?>
</option>
			<option value="P" <?php if ($this->_tpl_vars['company_data']['commission_type'] == 'P'): ?>selected="selected"<?php endif; ?>>%</option>
		</select>
	</div>
	<?php endif; ?>



<?php if ($this->_tpl_vars['company_data']['status'] == 'N' && $this->_tpl_vars['settings']['General']['use_email_as_login'] != 'Y'): ?>
<div class="form-field">
	<label for="company_request_account_name"><?php echo fn_get_lang_var('request_account_name', $this->getLanguage()); ?>
:</label>
	<input type="text" name="company_data[request_account_name]" id="company_request_account_name" size="32" value="<?php echo $this->_tpl_vars['company_data']['request_account_name']; ?>
" class="input-text" />
</div>
<?php endif; ?>




<?php $this->_tag_stack[] = array('hook', array('name' => "companies:contact_information")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<?php if (@MODE == 'add' && ( @PRODUCT_TYPE == 'MULTIVENDOR' || @PRODUCT_TYPE == 'ULTIMATE' )): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/profiles/components/profile_fields.tpl", 'smarty_include_vars' => array('section' => 'C','title' => fn_get_lang_var('contact_information', $this->getLanguage()))));
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
	<label for="company_description_email" class="cm-required cm-email"><?php echo fn_get_lang_var('email', $this->getLanguage()); ?>
:</label>
	<input type="text" name="company_data[email]" id="company_description_email" size="32" value="<?php echo $this->_tpl_vars['company_data']['email']; ?>
" class="input-text" />
</div>

<div class="form-field">
	<label for="company_description_phone" class="cm-required"><?php echo fn_get_lang_var('phone', $this->getLanguage()); ?>
:</label>
	<input type="text" name="company_data[phone]" id="company_description_phone" size="32" value="<?php echo $this->_tpl_vars['company_data']['phone']; ?>
" class="input-text" />
</div>

<div class="form-field">
	<label for="company_description_url"><?php echo fn_get_lang_var('url', $this->getLanguage()); ?>
:</label>
	<input type="text" name="company_data[url]" id="company_description_url" size="32" value="<?php echo $this->_tpl_vars['company_data']['url']; ?>
" class="input-text" />
</div>

<div class="form-field">
	<label for="company_description_fax"><?php echo fn_get_lang_var('fax', $this->getLanguage()); ?>
:</label>
	<input type="text" name="company_data[fax]" id="company_description_fax" size="32" value="<?php echo $this->_tpl_vars['company_data']['fax']; ?>
" class="input-text" />
</div>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<?php $this->_tag_stack[] = array('hook', array('name' => "companies:shipping_address")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<?php if (@MODE == 'add' && ( @PRODUCT_TYPE == 'MULTIVENDOR' || @PRODUCT_TYPE == 'ULTIMATE' )): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/profiles/components/profile_fields.tpl", 'smarty_include_vars' => array('section' => 'B','title' => fn_get_lang_var('shipping_address', $this->getLanguage()),'shipping_flag' => false)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php else: ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('shipping_address', $this->getLanguage()))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>

<div class="form-field">
	<label for="company_address_address" class="cm-required"><?php echo fn_get_lang_var('address', $this->getLanguage()); ?>
:</label>
	<input type="text" name="company_data[address]" id="company_address_address" size="32" value="<?php echo $this->_tpl_vars['company_data']['address']; ?>
" class="input-text" />
</div>

<div class="form-field">
	<label for="company_address_city" class="cm-required"><?php echo fn_get_lang_var('city', $this->getLanguage()); ?>
:</label>
	<input type="text" name="company_data[city]" id="company_address_city" size="32" value="<?php echo $this->_tpl_vars['company_data']['city']; ?>
" class="input-text" />
</div>

<div class="form-field">
	<label for="company_address_country" class="cm-required cm-country cm-location-shipping"><?php echo fn_get_lang_var('country', $this->getLanguage()); ?>
:</label>
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

<div class="form-field">
	<?php $this->assign('country_code', smarty_modifier_default(@$this->_tpl_vars['company_data']['country'], @$this->_tpl_vars['settings']['General']['default_country']), false); ?>
	<?php $this->assign('state_code', smarty_modifier_default(@$this->_tpl_vars['company_data']['state'], @$this->_tpl_vars['settings']['General']['default_state']), false); ?>
	<label for="company_address_state" class="cm-required cm-state cm-location-shipping"><?php echo fn_get_lang_var('state', $this->getLanguage()); ?>
:</label>
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
	<input type="hidden" id="company_address_state_default" value="<?php echo $this->_tpl_vars['state_code']; ?>
" />
</div>

<div class="form-field">
	<label for="company_address_zipcode" class="cm-required cm-zipcode cm-location-shipping"><?php echo fn_get_lang_var('zip_postal_code', $this->getLanguage()); ?>
:</label>
	<input type="text" name="company_data[zipcode]" id="company_address_zipcode" size="32" value="<?php echo $this->_tpl_vars['company_data']['zipcode']; ?>
" class="input-text" />
</div>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>




<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

</fieldset>
</div> 


<div id="content_description" class="hidden"> <fieldset>
<?php $this->_tag_stack[] = array('hook', array('name' => "companies:description")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<div class="form-field">
	<label for="company_description"><?php echo fn_get_lang_var('description', $this->getLanguage()); ?>
:</label>
	<textarea id="company_description" name="company_data[company_description]" cols="55" rows="8" class="cm-wysiwyg input-textarea-long"><?php echo $this->_tpl_vars['company_data']['company_description']; ?>
</textarea>
	
</div>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
</fieldset>
</div> 


<div id="content_logos" class="hidden"> &nbsp;
<?php $_from = $this->_tpl_vars['manifest_definition']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['fel'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['fel']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['a'] => $this->_tpl_vars['m']):
        $this->_foreach['fel']['iteration']++;
?>
<?php $this->assign('sa', "skin_name_".($this->_tpl_vars['m']['skin']), false); ?>
<p><?php echo fn_get_lang_var($this->_tpl_vars['m']['text'], $this->getLanguage()); ?>
</p>
<div class="clear">
	<div class="float-left">
		<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('var_name' => "logotypes[".($this->_tpl_vars['a'])."]", )); ?><?php echo smarty_function_script(array('src' => "js/fileuploader_scripts.js"), $this);?>

<?php echo smarty_function_script(array('src' => "js/node_cloning.js"), $this);?>


<?php $this->assign('id_var_name', md5(smarty_modifier_cat($this->_tpl_vars['prefix'], $this->_tpl_vars['var_name'])), false); ?>

<script type="text/javascript">
//<![CDATA[
	var id_var_name = "<?php echo $this->_tpl_vars['id_var_name']; ?>
";
	var label_id = "<?php echo $this->_tpl_vars['label_id']; ?>
";

	if (typeof(custom_labels) == "undefined") <?php echo $this->_tpl_vars['ldelim']; ?>

		custom_labels = <?php echo $this->_tpl_vars['ldelim']; ?>
<?php echo $this->_tpl_vars['rdelim']; ?>
;
	<?php echo $this->_tpl_vars['rdelim']; ?>

	
	custom_labels[id_var_name] = <?php echo $this->_tpl_vars['ldelim']; ?>
<?php echo $this->_tpl_vars['rdelim']; ?>
;
	custom_labels[id_var_name]['upload_another_file'] = <?php if ($this->_tpl_vars['multiupload'] == 'Y'): ?><?php if ($this->_tpl_vars['upload_another_file_text']): ?>'<?php echo smarty_modifier_escape($this->_tpl_vars['upload_another_file_text'], 'javascript'); ?>
'<?php else: ?>'<?php echo smarty_modifier_escape(fn_get_lang_var('upload_another_file', $this->getLanguage()), 'javascript'); ?>
'<?php endif; ?><?php else: ?>'<?php echo smarty_modifier_escape(fn_get_lang_var('local', $this->getLanguage()), 'javascript'); ?>
'<?php endif; ?>;
	custom_labels[id_var_name]['upload_file'] = <?php if ($this->_tpl_vars['upload_file_text']): ?>'<?php echo smarty_modifier_escape($this->_tpl_vars['upload_file_text'], 'javascript'); ?>
'<?php else: ?>'<?php echo smarty_modifier_escape(fn_get_lang_var('local', $this->getLanguage()), 'javascript'); ?>
'<?php endif; ?>;
//]]>
</script>

<div class="fileuploader">
<input type="hidden" id="<?php echo $this->_tpl_vars['label_id']; ?>
" value="<?php if ($this->_tpl_vars['images']): ?><?php echo $this->_tpl_vars['id_var_name']; ?>
<?php endif; ?>" />

<?php $_from = $this->_tpl_vars['images']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['image_id'] => $this->_tpl_vars['image']):
?>
	<div class="upload-file-section cm-uploaded-image" id="message_<?php echo $this->_tpl_vars['id_var_name']; ?>
_<?php echo $this->_tpl_vars['image']['file']; ?>
" title="">
		<p class="cm-fu-file">
			<?php $this->_tag_stack[] = array('hook', array('name' => "fileuploader:links")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				<?php if ($this->_tpl_vars['image']['location'] == 'cart'): ?>
					<?php $this->assign('delete_link', ($this->_tpl_vars['controller']).".delete_file?cart_id=".($this->_tpl_vars['id'])."&amp;option_id=".($this->_tpl_vars['po']['option_id'])."&amp;file=".($this->_tpl_vars['image_id'])."&amp;redirect_mode=cart", false); ?>
					<?php $this->assign('download_link', ($this->_tpl_vars['controller']).".get_custom_file?cart_id=".($this->_tpl_vars['id'])."&amp;option_id=".($this->_tpl_vars['po']['option_id'])."&amp;file=".($this->_tpl_vars['image_id']), false); ?>
				<?php endif; ?>
			<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			<?php if ($this->_tpl_vars['image']['is_image']): ?>
				<a href="<?php echo fn_url($this->_tpl_vars['image']['detailed']); ?>
"><img src="<?php echo fn_url($this->_tpl_vars['image']['thumbnail']); ?>
" border="0" /></a><br />
			<?php endif; ?>
			
			<?php $this->_tag_stack[] = array('hook', array('name' => "fileuploader:uploaded_files")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				<?php if ($this->_tpl_vars['delete_link']): ?><a class="cm-ajax" href="<?php echo fn_url($this->_tpl_vars['delete_link']); ?>
"><?php endif; ?><?php if (! ( $this->_tpl_vars['po']['required'] == 'Y' && count($this->_tpl_vars['images']) == 1 )): ?><img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/icon_delete.gif" width="12" height="18" border="0" hspace="3" id="clean_selection_<?php echo $this->_tpl_vars['id_var_name']; ?>
_<?php echo $this->_tpl_vars['image']['file']; ?>
" alt="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" onclick="fileuploader.clean_selection(this.id); <?php if ($this->_tpl_vars['multiupload'] != 'Y'): ?>fileuploader.toggle_links('<?php echo $this->_tpl_vars['id_var_name']; ?>
', 'show');<?php endif; ?> fileuploader.check_required_field('<?php echo $this->_tpl_vars['id_var_name']; ?>
', '<?php echo $this->_tpl_vars['label_id']; ?>
');" class="hand valign" /><?php endif; ?><?php if ($this->_tpl_vars['delete_link']): ?></a><?php endif; ?><span><?php if ($this->_tpl_vars['download_link']): ?><a href="<?php echo fn_url($this->_tpl_vars['download_link']); ?>
"><?php endif; ?><?php echo $this->_tpl_vars['image']['name']; ?>
<?php if ($this->_tpl_vars['download_link']): ?></a><?php endif; ?></span>
			<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		</p>
	</div>
<?php endforeach; endif; unset($_from); ?>

<div class="nowrap" id="file_uploader_<?php echo $this->_tpl_vars['id_var_name']; ?>
">
	<div class="upload-file-section" id="message_<?php echo $this->_tpl_vars['id_var_name']; ?>
" title="">
		<p class="cm-fu-file hidden"><img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/icon_delete.gif" width="12" height="18" border="0" hspace="3" id="clean_selection_<?php echo $this->_tpl_vars['id_var_name']; ?>
" alt="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" onclick="fileuploader.clean_selection(this.id); <?php if ($this->_tpl_vars['multiupload'] != 'Y'): ?>fileuploader.toggle_links(this.id, 'show');<?php endif; ?> fileuploader.check_required_field('<?php echo $this->_tpl_vars['id_var_name']; ?>
', '<?php echo $this->_tpl_vars['label_id']; ?>
');" class="hand valign" /><span></span></p>
		<?php if ($this->_tpl_vars['multiupload'] != 'Y'): ?><p class="cm-fu-no-file <?php if ($this->_tpl_vars['images']): ?>hidden<?php endif; ?>"><?php echo fn_get_lang_var('text_select_file', $this->getLanguage()); ?>
</p><?php endif; ?>
	</div>
	
	<?php echo '<div class="select-field upload-file-links '; ?><?php if ($this->_tpl_vars['multiupload'] != 'Y' && $this->_tpl_vars['images']): ?><?php echo 'hidden'; ?><?php endif; ?><?php echo '" id="link_container_'; ?><?php echo $this->_tpl_vars['id_var_name']; ?><?php echo '"><input type="hidden" name="file_'; ?><?php echo $this->_tpl_vars['var_name']; ?><?php echo '" value="'; ?><?php if ($this->_tpl_vars['image_name']): ?><?php echo ''; ?><?php echo $this->_tpl_vars['image_name']; ?><?php echo ''; ?><?php endif; ?><?php echo '" id="file_'; ?><?php echo $this->_tpl_vars['id_var_name']; ?><?php echo '" '; ?><?php if ($this->_tpl_vars['image']): ?><?php echo 'class="cm-image-field"'; ?><?php endif; ?><?php echo ' /><input type="hidden" name="type_'; ?><?php echo $this->_tpl_vars['var_name']; ?><?php echo '" value="'; ?><?php if ($this->_tpl_vars['image_name']): ?><?php echo 'local'; ?><?php endif; ?><?php echo '" id="type_'; ?><?php echo $this->_tpl_vars['id_var_name']; ?><?php echo '" '; ?><?php if ($this->_tpl_vars['image']): ?><?php echo 'class="cm-image-field"'; ?><?php endif; ?><?php echo ' /><div class="upload-file-local"><input type="file" name="file_'; ?><?php echo $this->_tpl_vars['var_name']; ?><?php echo '" id="_local_'; ?><?php echo $this->_tpl_vars['id_var_name']; ?><?php echo '" onchange="fileuploader.show_loader(this.id); '; ?><?php if ($this->_tpl_vars['multiupload'] == 'Y'): ?><?php echo 'fileuploader.check_image(this.id);'; ?><?php endif; ?><?php echo ' fileuploader.check_required_field(\''; ?><?php echo $this->_tpl_vars['id_var_name']; ?><?php echo '\', \''; ?><?php echo $this->_tpl_vars['label_id']; ?><?php echo '\');" onclick="$(this).removeAttr(\'value\');" value="" '; ?><?php if ($this->_tpl_vars['image']): ?><?php echo 'class="cm-image-field"'; ?><?php endif; ?><?php echo ' /><a id="local_'; ?><?php echo $this->_tpl_vars['id_var_name']; ?><?php echo '">'; ?><?php if ($this->_tpl_vars['images']): ?><?php echo ''; ?><?php echo smarty_modifier_default(@$this->_tpl_vars['upload_another_file_text'], fn_get_lang_var('upload_another_file', $this->getLanguage())); ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_default(@$this->_tpl_vars['upload_file_text'], fn_get_lang_var('local', $this->getLanguage())); ?><?php echo ''; ?><?php endif; ?><?php echo '</a></div>&nbsp;&nbsp;|&nbsp;&nbsp;'; ?><?php if (! ( $this->_tpl_vars['hide_server'] || defined('COMPANY_ID') || defined('RESTRICTED_ADMIN') )): ?><?php echo '<a onclick="fileuploader.show_loader(this.id);" id="server_'; ?><?php echo $this->_tpl_vars['id_var_name']; ?><?php echo '">'; ?><?php echo fn_get_lang_var('server', $this->getLanguage()); ?><?php echo '</a>&nbsp;&nbsp;|&nbsp;&nbsp;'; ?><?php endif; ?><?php echo '<a onclick="fileuploader.show_loader(this.id);" id="url_'; ?><?php echo $this->_tpl_vars['id_var_name']; ?><?php echo '">'; ?><?php echo fn_get_lang_var('url', $this->getLanguage()); ?><?php echo '</a>'; ?><?php if ($this->_tpl_vars['hidden_name']): ?><?php echo '<input type="hidden" name="'; ?><?php echo $this->_tpl_vars['hidden_name']; ?><?php echo '" value="'; ?><?php echo $this->_tpl_vars['hidden_value']; ?><?php echo '">'; ?><?php endif; ?><?php echo '</div>'; ?>

</div>

</div><!--fileuploader--><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	</div>
	<div class="float-left attach-images-alt logo-image">
		<?php if ($this->_tpl_vars['manifests'][$this->_tpl_vars['m']['skin']][$this->_tpl_vars['m']['name']]['vendor']): ?>
		<img class="solid-border" src="<?php echo $this->_tpl_vars['config']['images_path']; ?>
<?php echo $this->_tpl_vars['manifests'][$this->_tpl_vars['m']['skin']][$this->_tpl_vars['m']['name']]['filename']; ?>
" width="<?php echo $this->_tpl_vars['manifests'][$this->_tpl_vars['m']['skin']][$this->_tpl_vars['m']['name']]['width']; ?>
" height="<?php echo $this->_tpl_vars['manifests'][$this->_tpl_vars['m']['skin']][$this->_tpl_vars['m']['name']]['height']; ?>
" />
		<?php else: ?>
		<img class="logo-empty" src="<?php echo $this->_tpl_vars['config']['no_image_path']; ?>
" />
		<?php endif; ?>
		<label for="alt_text_<?php echo $this->_tpl_vars['a']; ?>
"><?php echo fn_get_lang_var('alt_text', $this->getLanguage()); ?>
:</label>
		<input type="text" class="input-text cm-image-field" id="alt_text_<?php echo $this->_tpl_vars['a']; ?>
" name="logo_alt[<?php echo $this->_tpl_vars['a']; ?>
]" value="<?php echo $this->_tpl_vars['manifests'][$this->_tpl_vars['m']['skin']][$this->_tpl_vars['m']['name']]['alt']; ?>
" />
	</div>
</div>
<?php if (! ($this->_foreach['fel']['iteration'] == $this->_foreach['fel']['total'])): ?>
<hr />
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
</div> 



<div id="content_categories" class="hidden"> 	<?php $this->_tag_stack[] = array('hook', array('name' => "companies:categories")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "pickers/categories_picker.tpl", 'smarty_include_vars' => array('multiple' => true,'input_name' => "company_data[categories]",'item_ids' => $this->_tpl_vars['company_data']['categories'],'data_id' => 'category_ids','no_item_text' => smarty_modifier_replace(fn_get_lang_var('text_all_items_included', $this->getLanguage()), "[items]", fn_get_lang_var('categories', $this->getLanguage())),'use_keys' => 'N')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
</div> 






<?php if (! defined('COMPANY_ID')): ?>
<div id="content_shipping_methods" class="hidden"> 	<?php $this->_tag_stack[] = array('hook', array('name' => "companies:shipping_methods")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
		<tr>
			<th width="50%"><?php echo fn_get_lang_var('shipping_methods', $this->getLanguage()); ?>
</th>
			<th class="center"><?php echo $this->_tpl_vars['lang_available_for_vendor_supplier']; ?>
</th>
		</tr>
		<?php if ($this->_tpl_vars['company_data']['shippings']): ?>
			<?php $this->assign('shippings_ids', explode(",", $this->_tpl_vars['company_data']['shippings']), false); ?>
		<?php endif; ?>
		<?php $_from = $this->_tpl_vars['shippings']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['shipping_id'] => $this->_tpl_vars['shipping']):
?>
		<tr <?php echo smarty_function_cycle(array('values' => "class=\"table-row\", "), $this);?>
>
			<td><a href="<?php echo fn_url("shippings.update?shipping_id=".($this->_tpl_vars['shipping_id'])); ?>
"><?php echo $this->_tpl_vars['shipping']; ?>
</a></td>
			<td class="center">
				<input type="checkbox" class="checkbox"<?php if (! $this->_tpl_vars['company_data']['company_id'] || smarty_modifier_in_array($this->_tpl_vars['shipping_id'], $this->_tpl_vars['shippings_ids'])): ?> checked="checked"<?php endif; ?> name="company_data[shippings][]" value="<?php echo $this->_tpl_vars['shipping_id']; ?>
">
			</td>
		</tr>
		<?php endforeach; else: ?>
		<tr class="no-items">
			<td colspan="2"><p><?php echo fn_get_lang_var('no_items', $this->getLanguage()); ?>
</p></td>
		</tr>
		<?php endif; unset($_from); ?>
		</table>
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
</div> <?php endif; ?>


<div id="content_addons" class="hidden">
	<?php $this->_tag_stack[] = array('hook', array('name' => "companies:detailed_content")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if ($this->_tpl_vars['addons']['seo']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/seo/hooks/companies/detailed_content.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
</div>

<?php $this->_tag_stack[] = array('hook', array('name' => "companies:tabs_content")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>


<div class="buttons-container cm-toggle-button buttons-bg">
	<?php if ($this->_tpl_vars['mode'] == 'add'): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[companies.add]")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php else: ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[companies.update]")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
</div>

</form> 
<?php $this->_tag_stack[] = array('hook', array('name' => "companies:tabs_extra")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if ($this->_tpl_vars['addons']['discussion']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/discussion/hooks/companies/tabs_extra.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<?php $this->_smarty_vars['capture']['tabsbox'] = ob_get_contents(); ob_end_clean(); ?>
<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('content' => $this->_smarty_vars['capture']['tabsbox'], 'group_name' => $this->_tpl_vars['controller'], 'active_tab' => $this->_tpl_vars['_REQUEST']['selected_section'], 'track' => true, )); ?><?php echo smarty_function_script(array('src' => "js/tabs.js"), $this);?>


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
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('title' => $this->_tpl_vars['lang_new_vendor_supplier'],'content' => $this->_smarty_vars['capture']['mainbox'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php else: ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('title' => ($this->_tpl_vars['lang_editing_vendor_supplier']).":&nbsp;".($this->_tpl_vars['company_data']['company']),'content' => $this->_smarty_vars['capture']['mainbox'],'select_languages' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>