<div class="sort-container">
{if $settings.DHTML.customer_ajax_based_pagination == "Y"}
	{assign var="ajax_class" value="cm-ajax cm-ajax-force"}
{/if}

{assign var="curl" value=$config.current_url|fn_query_remove:"sort_by":"sort_order":"result_ids":"layout"}
{assign var="sorting" value=""|fn_get_products_sorting:"false"}
{assign var="sorting_orders" value=""|fn_get_products_sorting_orders}
{assign var="layouts" value=""|fn_get_products_views:false:false}
{assign var="pagination_id" value=$id|default:"pagination_contents"}
{assign var="avail_sorting" value=$settings.Appearance.available_product_list_sortings}

{if $search.sort_order == "asc"}
	{capture name="sorting_text"}
		<a class="sort-asc">{$sorting[$search.sort_by].description}</a>
	{/capture}
{else}
	{capture name="sorting_text"}
		<a class="sort-desc">{$sorting[$search.sort_by].description}</a>
	{/capture}
{/if}

{if $search.sort_order == "asc"}
	{assign var="layout_sort_order" value="desc"}
{else}
	{assign var="layout_sort_order" value="asc"}
{/if}

{if !(($category_data.selected_layouts|count == 1) || ($category_data.selected_layouts|count == 0 && ""|fn_get_products_views:true|count <= 1)) && !$hide_layouts}
<div class="views-icons">
{foreach from=$layouts key="layout" item="item"}
{if ($category_data.selected_layouts.$layout) || (!$category_data.selected_layouts && $item.active)}
<a class="{$layout|replace:"_":"-"} {$ajax_class} {if $layout == $selected_layout}active{/if}" rev="{$pagination_id}" href="{"`$curl`&amp;sort_by=`$search.sort_by`&amp;sort_order=`$layout_sort_order`&amp;layout=`$layout`"|fn_url}" rel="nofollow" name="layout_callback"></a>
{/if}
{/foreach}
</div>
{/if}

{if $avail_sorting}
{include file="common_templates/sorting.tpl"}
{/if}

{if $pagination.total_items}
{assign var="range_url" value=$curl|fn_query_remove:"items_per_page"}
{assign var="range_url" value=$range_url|fn_query_remove:"page"}
<div class="dropdown-container">
<span class="cm-dropdown-title sort-dropdown dropdown-wrap-left"><a class="dropdown-wrap-right">{$pagination.items_per_page} {$lang.per_page}</a></span>
	<ul class="cm-dropdown-content">
		{foreach from=$pagination.product_steps item="step"}
		{if $step != $pagination.items_per_page}
			<li><a class="{$ajax_class}" href="{"`$range_url`&amp;items_per_page=`$step`"|fn_url}" rev="{$pagination_id}">{$step} {$lang.per_page}</a></li>
		{/if}
		{/foreach}
	</ul>
</div>
{/if}
</div>