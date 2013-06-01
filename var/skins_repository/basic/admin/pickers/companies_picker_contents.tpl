{if !$smarty.request.extra}
<script type="text/javascript">
//<![CDATA[
lang.text_items_added = '{$lang.text_items_added|escape:javascript}';
var display_type = '{$smarty.request.display|escape:javascript}';
{literal}
	function fn_form_post_companies_form(frm, elm) 
	{
		var companies = {};

		if ($('input.cm-item:checked', $(frm)).length > 0) {
			$('input.cm-item:checked', $(frm)).each( function() {
				var id = $(this).val();
				companies[id] = $('#company_' + id).text();
			});
			$.add_js_item(frm.attr('rev'), companies, 'm', null);

			if (display_type != 'radio') {
				$.showNotifications({'data': {'type': 'N', 'title': lang.notice, 'message': lang.text_items_added, 'save_state': false, 'message_state': 'I'}});
			}
		}

		return false;
	}
{/literal}
//]]>
</script>
{/if}

{include file="views/companies/components/companies_search_form.tpl" dispatch="companies.picker" extra="<input type=\"hidden\" name=\"result_ids\" value=\"pagination_`$smarty.request.data_id`\">" put_request_vars=true form_meta="cm-ajax"}

<form action="{"`$index_script`?`$smarty.request.extra`"|fn_url}" rev="{$smarty.request.data_id}" method="post" name="companies_form">

{include file="common_templates/pagination.tpl" div_id="pagination_`$smarty.request.data_id`"}

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
<tr>
	<th width="1%" class="center">
		{if $smarty.request.display != "radio"}
		<input type="checkbox" name="check_all" value="Y" title="{$lang.check_uncheck_all}" class="checkbox cm-check-items" /></th>
		{/if}
	<th>{$lang.id}</th>
	<th>{$lang.name}</th>
	<th>{$lang.email}</th>
	<th>{$lang.registered}</th>
	
	<th>{$lang.active}</th>
	
</tr>
{foreach from=$companies item=company}
<tr {cycle values=",class=\"table-row\""}>
	<td class="center">
		{if $smarty.request.display == "radio"}
		<input type="radio" name="{$smarty.request.checkbox_name|default:"companies_ids"}" value="{$company.company_id}" class="radio" />
		{else}
		<input type="checkbox" name="{$smarty.request.checkbox_name|default:"companies_ids"}[{$company.company_id}]" value="{$company.company_id}" class="checkbox cm-item" />
		{/if}
	</td>
	<td><a href="{"companies.update?company_id=`$company.company_id`"|fn_url}">&nbsp;<span>{$company.company_id}</span>&nbsp;</a></td>
	<td><a id="company_{$company.company_id}" href="{"companies.update?company_id=`$company.company_id`"|fn_url}">{$company.company}</a></td>
	<td><a href="mailto:{$company.email}">{$company.email}</a></td>
	<td>{$company.timestamp|date_format:"`$settings.Appearance.date_format`, `$settings.Appearance.time_format`"}</td>
	
	<td class="center"><img src="{$images_dir}/checkbox_{if $company.status != "A"}un{/if}ticked.gif" width="13" height="13" alt="{$lang.active}" /></td>
	
</tr>
{foreachelse}
<tr class="no-items">
	<td colspan="6"><p>{$lang.no_data}</p></td>
</tr>
{/foreach}
</table>

{include file="common_templates/pagination.tpl" div_id="pagination_`$smarty.request.data_id`"}

<div class="buttons-container">
	{if $smarty.request.display == "radio"}
		{assign var="but_close_text" value=$lang.choose}
	{else}
		{assign var="but_close_text" value=$lang.add_companies_and_close}
		{assign var="but_text" value=$lang.add_companies}
	{/if}
	{include file="buttons/add_close.tpl" is_js=$smarty.request.extra|fn_is_empty}
</div>

</form>