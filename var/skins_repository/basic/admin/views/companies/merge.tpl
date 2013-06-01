{include file="views/profiles/components/profiles_scripts.tpl"}

{capture name="mainbox"}

{include file="views/companies/components/companies_search_form.tpl" dispatch="companies.merge" company_id=$smarty.request.company_id}

{if $smarty.const.PRODUCT_TYPE == "MULTIVENDOR" || $smarty.const.PRODUCT_TYPE == "ULTIMATE"}
{assign var="lang_action" value="`$lang.merge`&nbsp;`$lang.vendor`"}
{else}
{assign var="lang_action" value="`$lang.merge`&nbsp;`$lang.supplier`"}
{/if}
<div><span>{$lang.warning_merging_companies|replace:"[company_name]":$company_name}</span></div>
<div>{$lang.select_new_owner_company}</div>
<form action="{$index_script}" method="post" name="userlist_form" id="userlist_form">
<input type="hidden" name="fake" value="1" />
<input type="hidden" name="from_company_id" value="{$smarty.request.company_id}" />

{include file="common_templates/pagination.tpl" save_current_page=true save_current_url=false}

{assign var="c_url" value=$config.current_url|fn_query_remove:"sort_by":"sort_order"}

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table sortable">
<tr>
	<th width="1%" class="center">
	<th><a class="cm-ajax{if $search.sort_by == "id"} sort-link-{$search.sort_order}{/if}" href="{$c_url}&amp;sort_by=id&amp;sort_order={$search.sort_order}" rev="pagination_contents">{$lang.id}</a></th>
	<th width="25%"><a class="cm-ajax{if $search.sort_by == "company"} sort-link-{$search.sort_order}{/if}" href="{$c_url}&amp;sort_by=company&amp;sort_order={$search.sort_order}" rev="pagination_contents">{$lang.name}</a></th>
	<th width="25%"><a class="cm-ajax{if $search.sort_by == "email"} sort-link-{$search.sort_order}{/if}" href="{$c_url}&amp;sort_by=email&amp;sort_order={$search.sort_order}" rev="pagination_contents">{$lang.email}</a></th>
	<th width="25%"><a class="cm-ajax{if $search.sort_by == "date"} sort-link-{$search.sort_order}{/if}" href="{$c_url}&amp;sort_by=date&amp;sort_order={$search.sort_order}" rev="pagination_contents">{$lang.registered}</a></th>
</tr>
{foreach from=$companies key=k item=company}
<tr {cycle values="class=\"table-row\", "}>
	<td class="center">
		<input type="radio"{if $k == 0} checked="checked"{/if} name="to_company_id" value="{$company.company_id}" class="" /></td>
	<td><a href="{"companies.update?company_id=`$company.company_id`"|fn_url}">&nbsp;<span>{$company.company_id}</span>&nbsp;</a></td>
	<td><a href="{"companies.update?company_id=`$company.company_id`"|fn_url}">{$company.company}</a></td>
	<td><a href="mailto:{$company.email}">{$company.email}</a></td>
	<td>{$company.timestamp|date_format:"`$settings.Appearance.date_format`, `$settings.Appearance.time_format`"}</td>
</tr>
{foreachelse}
<tr class="no-items">
	<td colspan="9"><p>{$lang.no_data}</p></td>
</tr>
{/foreach}
</table>

{if $companies}
	{*include file="common_templates/table_tools.tpl" href="#companies"*}
{/if}

{include file="common_templates/pagination.tpl"}

<div class="buttons-container buttons-bg">
	{if $companies}
	<div class="float-left">
		{*capture name="tools_list"}
		<ul>
			<li><a class="cm-process-items" name="dispatch[profiles.export_range]" rev="userlist_form">{$lang.export_selected}</a></li>
		</ul>
		{/capture*}
		{include file="buttons/button.tpl" but_text=$lang.merge but_name="dispatch[companies.merge]" but_meta="cm-confirm" but_role="button_main"}
		{*include file="common_templates/tools.tpl" prefix="main" hide_actions=true tools_list=$smarty.capture.tools_list display="inline" link_text=$lang.choose_action*}
	</div>
	{/if}
	
</div>


</form>

{/capture}
{include file="common_templates/mainbox.tpl" title="`$lang_action`:&nbsp;`$company_name`" content=$smarty.capture.mainbox title_extra=$smarty.capture.title_extra tools=$smarty.capture.tools}
