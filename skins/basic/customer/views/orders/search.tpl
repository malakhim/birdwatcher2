{capture name="section"}
	{include file="views/orders/components/orders_search_form.tpl"}
{/capture}
{include file="common_templates/section.tpl" section_title=$lang.search_options section_content=$smarty.capture.section class="search-form"}

{assign var="c_url" value=$config.current_url|fn_query_remove:"sort_by":"sort_order"}
{if $search.sort_order == "asc"}
{assign var="sort_sign" value="table-asc"}
{else}
{assign var="sort_sign" value="table-desc"}
{/if}
{if $settings.DHTML.customer_ajax_based_pagination == "Y"}
	{assign var="ajax_class" value="cm-ajax"}

{/if}

{include file="common_templates/pagination.tpl"}
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="table orders">
<thead>
<tr>
	<th width="7%"><a class="{$ajax_class} {if $search.sort_by == "order_id"} {$sort_sign}{/if}" href="{"`$c_url`&amp;sort_by=order_id&amp;sort_order=`$search.sort_order`"|fn_url}" rev="pagination_contents">{$lang.id}</a></th>
	<th width="14%"><a class="{$ajax_class} {if $search.sort_by == "status"}{$sort_sign}{/if}" href="{"`$c_url`&amp;sort_by=status&amp;sort_order=`$search.sort_order`"|fn_url}" rev="pagination_contents">{$lang.status}</a></th>
	<th width="44%"><a class="{$ajax_class} {if $search.sort_by == "customer"}{$sort_sign}{/if}" href="{"`$c_url`&amp;sort_by=customer&amp;sort_order=`$search.sort_order`"|fn_url}" rev="pagination_contents">{$lang.customer}</a></th>
	<th width="20%"><a class="{$ajax_class} {if $search.sort_by == "date"}{$sort_sign}{/if}" href="{"`$c_url`&amp;sort_by=date&amp;sort_order=`$search.sort_order`"|fn_url}" rev="pagination_contents">{$lang.date}</a></th>
	<th width="15%"><a class="{$ajax_class} {if $search.sort_by == "total"}{$sort_sign}{/if}" href="{"`$c_url`&amp;sort_by=total&amp;sort_order=`$search.sort_order`"|fn_url}" rev="pagination_contents">{$lang.total}</a></th>
</tr>
</thead>
{foreach from=$orders item="o"}
<tr {cycle values=",class=\"table-row\""}>
	<td><a href="{"orders.details?order_id=`$o.order_id`"|fn_url}"><strong>#{$o.order_id}</strong></a></td>
	<td>{include file="common_templates/status.tpl" status=$o.status display="view"}</td>
	<td>
		<ul class="no-markers">
			<li>{$o.firstname} {$o.lastname}</li>
			<li><a href="mailto:{$o.email|escape:url}">{$o.email}</a></li>
		</ul>
	</td>
	<td><a href="{"orders.details?order_id=`$o.order_id`"|fn_url}">{$o.timestamp|date_format:"`$settings.Appearance.date_format`, `$settings.Appearance.time_format`"}</a></td>
	<td>{include file="common_templates/price.tpl" value=$o.total}</td>
</tr>
{foreachelse}
<tr>
	<td colspan="7"><p class="no-items">{$lang.text_no_orders}</p></td>
</tr>
{/foreach}
</table>

{include file="common_templates/pagination.tpl"}

{capture name="mainbox_title"}{$lang.orders}{/capture}