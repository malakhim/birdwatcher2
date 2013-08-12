{script src="lib/js/jquery/jquery.min.js"}
{script src="lib/js/jqueryui/jquery-ui.custom.min.js"}

{script src="lib/js/appear/jquery.appear-1.1.1.js"}
{script src="lib/js/tools/tooltip.min.js"}

{script src="js/editors/`$settings.Appearance.default_wysiwyg_editor`.editor.js"}

{script src="js/core.js"}
{script src="js/ajax.js"}

<script type="text/javascript">
//<![CDATA[
	var index_script = '{$index_script|escape:"javascript"}';
	var changes_warning = '{$settings.Appearance.changes_warning|escape:"javascript"}';

	var lang = {$ldelim}
		cannot_buy: '{$lang.cannot_buy|escape:"javascript"}',
		no_products_selected: '{$lang.no_products_selected|escape:"javascript"}',
		error_no_items_selected: '{$lang.error_no_items_selected|escape:"javascript"}',
		delete_confirmation: '{$lang.delete_confirmation|escape:"javascript"}',
		text_out_of_stock: '{$lang.text_out_of_stock|escape:javascript}',
		items: '{$lang.items|escape:javascript}',
		text_required_group_product: '{$lang.text_required_group_product|escape:javascript}',
		save: '{$lang.save|escape:javascript}',
		close: '{$lang.close|escape:javascript}',
		loading: '{$lang.loading|escape:"javascript"}',
		notice: '{$lang.notice|escape:"javascript"}',
		warning: '{$lang.warning|escape:"javascript"}',
		error: '{$lang.error|escape:"javascript"}',
		text_are_you_sure_to_proceed: '{$lang.text_are_you_sure_to_proceed|escape:"javascript"}',
		text_invalid_url: '{$lang.text_invalid_url|escape:"javascript"}',
		error_validator_email: '{$lang.error_validator_email|escape:"javascript"}',
		error_validator_confirm_email: '{$lang.error_validator_confirm_email|escape:"javascript"}',
		error_validator_phone: '{$lang.error_validator_phone|escape:"javascript"}',
		error_validator_integer: '{$lang.error_validator_integer|escape:"javascript"}',
		error_validator_multiple: '{$lang.error_validator_multiple|escape:"javascript"}',
		error_validator_password: '{$lang.error_validator_password|escape:"javascript"}',
		error_validator_required: '{$lang.error_validator_required|escape:"javascript"}',
		error_validator_zipcode: '{$lang.error_validator_zipcode|escape:"javascript"}',
		error_validator_message: '{$lang.error_validator_message|escape:"javascript"}',
		text_page_loading: '{$lang.text_page_loading|escape:"javascript"}',
		error_ajax: '{$lang.error_ajax|escape:"javascript"}',
		text_changes_not_saved: '{$lang.text_changes_not_saved|escape:"javascript"}',
		text_data_changed: '{$lang.text_data_changed|escape:"javascript"}',
		trial_notice: '{$lang.text_block_trial_notice|escape:"javascript"}',
		expired_license: '{$lang.text_expired_license|escape:"javascript"}',
		file_browser: '{$lang.file_browser|escape:"javascript"}',
		editing_block: '{$lang.editing_block|escape:"javascript"}',
		editing_grid: '{$lang.editing_grid|escape:"javascript"}',
		editing_container: '{$lang.editing_container|escape:"javascript"}',
		adding_grid: '{$lang.adding_grid|escape:"javascript"}',
		adding_block_to_grid: '{$lang.adding_block_to_grid|escape:"javascript"}',
		manage_blocks: '{$lang.manage_blocks|escape:"javascript"}',
		editing_block: '{$lang.editing_block|escape:"javascript"}',
		add_block: '{$lang.add_block|escape:"javascript"}'
	{$rdelim}

	var currencies = {$ldelim}
		'primary': {$ldelim}
			'decimals_separator': '{$currencies.$primary_currency.decimals_separator|escape:javascript}',
			'thousands_separator': '{$currencies.$primary_currency.thousands_separator|escape:javascript}',
			'decimals': '{$currencies.$primary_currency.decimals|escape:javascript}'
		{$rdelim},
		'secondary': {$ldelim}
			'decimals_separator': '{$currencies.$secondary_currency.decimals_separator|escape:javascript}',
			'thousands_separator': '{$currencies.$secondary_currency.thousands_separator|escape:javascript}',
			'decimals': '{$currencies.$secondary_currency.decimals|escape:javascript}',
			'coefficient': '{$currencies.$secondary_currency.coefficient}'
		{$rdelim}
	{$rdelim}
	var current_path = '{$config.current_path|escape:javascript}';
	var current_location = '{$config.current_location|escape:javascript}';
	var current_url = '{$config.current_url|escape:javascript}';
	var skin_name = '{$settings.skin_name_admin}';
	var skin_name_customer = '{$settings.skin_name_customer}';
	var customer_skin_path = '{$customer_skin_path}';
	var images_dir = '{$images_dir}';
	var notice_displaying_time = {if $settings.Appearance.notice_displaying_time}{$settings.Appearance.notice_displaying_time}{else}0{/if};
	var cart_language = '{$smarty.const.CART_LANGUAGE}';
	var default_language = '{$smarty.const.DEFAULT_LANGUAGE}';
	var cart_prices_w_taxes = {if ($settings.Appearance.cart_prices_w_taxes == 'Y')}true{else}false{/if};
	var translate_mode = {if "TRANSLATION_MODE"|defined}true{else}false{/if};
	var control_buttons_container, control_buttons_floating;
	var defined_company_id = '{"COMPANY_ID"|defined}';
	var regexp = new Array();
	
	var default_editor = '{$settings.Appearance.default_wysiwyg_editor}';
	var default_previewer = '{$settings.Appearance.default_image_previewer}';
	
	{if $config.tweaks.anti_csrf}
		// CSRF form protection key
		var security_hash = '{""|fn_generate_security_hash}';
	{/if}
	
	$(function(){$ldelim}
		$.runCart('A');
	{$rdelim});
	
//]]>
</script>

{hook name="index:scripts"}
{/hook}