{capture name="section"}
<form action="{"`$index_script`"|fn_url}" name="balance_search_form" method="get" class="cm-disable-empty">

{if $smarty.request.redirect_url}
	<input type="hidden" name="redirect_url" value="{$smarty.request.redirect_url}" />
{/if}
{if $selected_section != ""}
	<input type="hidden" id="selected_section" name="selected_section" value="{$selected_section}" />
{/if}

<table cellspacing="0" border="0" class="search-header">
<tr>
	<td class="nowrap search-field">
		<label>{$lang.vendor}:</label>
		<div class="break">
			{if !"COMPANY_ID"|defined}
			<input type="hidden" name="vendor" id="search_hidden_vendor" value="{$search.vendor|default:'all'}" />
			{include file="common_templates/ajax_select_object.tpl" data_url="companies.get_companies_list?show_all=Y" text=$search.vendor|fn_get_company_name result_elm="search_hidden_vendor" id="company_search"}
			{else}
			{$search.vendor|fn_get_company_name}
			{/if}
		</div>
	</td>
	<td class="nowrap search-field">
		<label>{$lang.transaction_type}:</label>
		<div class="break">
			<select name="transaction_type">
				<option value="both" {if $search.transaction_type == "both"}selected="selected"{/if}>{$lang.both}</option>
				<option value="income" {if $search.transaction_type == "income"}selected="selected"{/if}>{$lang.income}</option>
				<option value="expenditure" {if $search.transaction_type == "expenditure"}selected="selected"{/if}>{$lang.expenditure}</option>
			</select>
		</div>
	</td>
	<td class="buttons-container">
		{include file="buttons/search.tpl" but_name="dispatch[$dispatch]" but_role="submit"}
	</td>
</tr>
</table>

{capture name="advanced_search"}
	<div class="search-field">
		<label>{$lang.sales_period}:</label>
		{include file="common_templates/period_selector.tpl" period=$search.period form_name="balance_search_form"}
	</div>
	<div class="search-field">
		<label>{$lang.payment}:</label>
		<input type="text" class="input-text" name="payment" value="{$search.payment}" />
	</div>
{/capture}

{include file="common_templates/advanced_search.tpl" content=$smarty.capture.advanced_search dispatch=$dispatch view_type="balance"}

</form>

{/capture}
{include file="common_templates/section.tpl" section_content=$smarty.capture.section}