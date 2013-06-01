{capture name="mainbox"}

{if $params.compact == "Y"}
	{if $found_objects}
		{capture name="tabsbox"}
			{foreach from=$found_objects key="object" item="data"}
				<div id="content_{$key}">
				<!--content_{$key}--></div>
			{/foreach}
		{/capture}
		{include file="common_templates/tabsbox.tpl" content=$smarty.capture.tabsbox active_tab="manage_`$search.default`" track=true}
	{else}
		<p class="no-items">{$lang.text_no_matching_results_found}</p>
	{/if}
	
{else}
	<hr width="100%" />

	{if $search_results}

	{include file="common_templates/pagination.tpl"}
	<p>&nbsp;</p>
	{foreach from=$search_results item=result}
	{if !$result.first}
	<hr />
	{/if}

	{hook name="search:search_results"}
	{if $result.object == "products"}
		{include file="views/products/components/one_product.tpl" product=$result key=$result.id}

	{elseif $result.object == "pages"}
		{include file="views/pages/components/one_page.tpl" page=$result}
	{/if}
	{/hook}

	{/foreach}

	<p>&nbsp;</p>
	{include file="common_templates/pagination.tpl"}

	{else}
		<p class="no-items">{$lang.text_no_matching_results_found}</p>
	{/if}
{/if}

{/capture}
{assign var="title" value="[search]"|str_replace:"\"`$smarty.request.q`\"":$lang.search_results_for}
{include file="common_templates/mainbox.tpl" title=$title content=$smarty.capture.mainbox}