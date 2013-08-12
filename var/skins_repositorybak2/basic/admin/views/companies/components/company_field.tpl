{if $smarty.const.PRODUCT_TYPE == "MULTIVENDOR" || $smarty.const.PRODUCT_TYPE == "ULTIMATE" || ($settings.Suppliers.enable_suppliers == "Y" && ($smarty.const.CONTROLLER == "products" || $smarty.const.CONTROLLER == "shippings"))}

{if $smarty.const.PRODUCT_TYPE == "MULTIVENDOR" || $smarty.const.PRODUCT_TYPE == "ULTIMATE"}
{assign var="lang_vendor_supplier" value=$lang.vendor}
{else}
{assign var="lang_vendor_supplier" value=$lang.supplier}
{/if}

{if "COMPANY_ID"|defined && !$selected}
	{assign var="selected" value=$smarty.const.COMPANY_ID}
{/if}




{if !$selected && $exclude_company_id === "0" || $selected|strval === $exclude_company_id}
	{assign var="selected" value=""|fn_get_default_company_id}
{/if}


{if $reload_form}
	{assign var="js_action" value="fn_reload_form(elm)"}
{/if}

<div class="form-field">
	<label for="{$id|default:"company_id"}">{$lang_vendor_supplier}{if $tooltip} {capture name="tooltip"}{$tooltip}{/capture}{include file="common_templates/tooltip.tpl" tooltip=$smarty.capture.tooltip"}{/if}:</label>
	{if "COMPANY_ID"|defined && $smarty.const.PRODUCT_TYPE == "MULTIVENDOR" && !$selected}
		{$smarty.const.COMPANY_ID|fn_get_company_name}
		<input type="hidden" name="{$name}" id="{$id|default:"company_id"}" value="{$smarty.const.COMPANY_ID}">
	{elseif "COMPANY_ID"|defined || $disable_company_picker}
		{$selected|fn_get_company_name}
		<input type="hidden" name="{$name}" id="{$id|default:"company_id"}" value="{$selected}">
	{else}
		<input type="hidden" name="{$name}" id="{$id|default:"company_id"}" value="{$selected|default:0}" />
		{include file="common_templates/ajax_select_object.tpl" data_url="companies.get_companies_list?exclude_company_id=`$exclude_company_id`&amp;onclick=`$onclick`" text=$selected|fn_get_company_name:0 result_elm=$id|default:"company_id" id="`$id`_selector" js_action=$js_action}
	{/if}
</div>

{/if}
