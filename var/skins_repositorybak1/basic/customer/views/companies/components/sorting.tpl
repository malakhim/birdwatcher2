<div class="sort-container">
{if $settings.DHTML.customer_ajax_based_pagination == "Y"}
	{assign var="ajax_class" value="cm-ajax cm-ajax-force"}
{/if}

{assign var="curl" value=$config.current_url|fn_query_remove:"sort_by":"sort_order":"result_ids"}
{assign var="sorting" value="true"|fn_get_companies_sorting}
{assign var="sorting_orders" value=""|fn_get_companies_sorting_orders}
{assign var="pagination_id" value=$id|default:"pagination_contents"}

{if $search.sort_order == "asc"}
	{capture name="sorting_text"}
		<a class="sort-asc">{$sorting[$search.sort_by].description}</a>
	{/capture}
{else}
	{capture name="sorting_text"}
		<a class="sort-desc">{$sorting[$search.sort_by].description}</a>
	{/capture}
{/if}

<div>
{include file="common_templates/sorting.tpl" class_pref="company-"}
</div>
</div>