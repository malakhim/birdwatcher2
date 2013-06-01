<div class="rma">
{capture name="section"}
	{include file="addons/rma/views/rma/components/rma_search_form.tpl"}
{/capture}
{include file="common_templates/section.tpl" section_title=$lang.search_options section_content=$smarty.capture.section}
<form action="{""|fn_url}" method="post" name="rma_list_form">
{include file="common_templates/pagination.tpl"}

{assign var="c_url" value=$config.current_url|fn_query_remove:"sort_by":"sort_order"}
{if $search.sort_order == "asc"}
{assign var="sort_sign" value="table-asc"}
{else}
{assign var="sort_sign" value="table-desc"}
{/if}
<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table rma-return-table">
<thead>
	<tr>
		<th width="10%"><a class="{$ajax_class} {if $search.sort_by == "return_id"} {$sort_sign}{/if}" href="{"`$c_url`&amp;sort_by=return_id&amp;sort_order=`$search.sort_order`"|fn_url}" rev="pagination_contents">{$lang.id}</a></th>
		<th width="13%"><a class="{$ajax_class} {if $search.sort_by == "status"} {$sort_sign}{/if}" href="{"`$c_url`&amp;sort_by=status&amp;sort_order=`$search.sort_order`"|fn_url}" rev="pagination_contents">{$lang.status}</a></th>
		<th width="35%"><a class="{$ajax_class} {if $search.sort_by == "customer"} {$sort_sign}{/if}" href="{"`$c_url`&amp;sort_by=customer&amp;sort_order=`$search.sort_order`"|fn_url}" rev="pagination_contents">{$lang.customer}</a></th>
		<th width="20%"><a class="{$ajax_class} {if $search.sort_by == "timestamp"} {$sort_sign}{/if}" href="{"`$c_url`&amp;sort_by=timestamp&amp;sort_order=`$search.sort_order`"|fn_url}" rev="pagination_contents">{$lang.date}</a></th>
		<th width="5%"><a class="{$ajax_class} {if $search.sort_by == "order_id"} {$sort_sign}{/if}" href="{"`$c_url`&amp;sort_by=order_id&amp;sort_order=`$search.sort_order`"|fn_url}" rev="pagination_contents">{$lang.order}&nbsp;{$lang.id}</a></th>
		<th width="5%"><a class="{$ajax_class} {if $search.sort_by == "amount"} {$sort_sign}{/if}" href="{"`$c_url`&amp;sort_by=amount&amp;sort_order=`$search.sort_order`"|fn_url}" rev="pagination_contents">{$lang.quantity}</a></th>
	</tr>
</thead>
{foreach from=$return_requests item="request"}
<tbody>
<tr {cycle values=",class=\"table-row\""}>
	<td class="center"><a href="{"rma.details?return_id=`$request.return_id`"|fn_url}"><strong>#{$request.return_id}</strong></a></td>
	<td>
		<input type="hidden" name="origin_statuses[{$request.return_id}]" value="{$request.status}">
		{include file="common_templates/status.tpl" status=$request.status display="view" name="return_statuses[`$request.return_id`]" status_type=$smarty.const.STATUSES_RETURN}
	</td>
	<td>{$request.firstname} {$request.lastname}</td>
	<td><a href="{"rma.details?return_id=`$request.return_id`"|fn_url}">{$request.timestamp|date_format:"`$settings.Appearance.date_format`, `$settings.Appearance.time_format`"}</a></td>
	<td class="center"><a href="{"orders.details?order_id=`$request.order_id`"|fn_url}">#{$request.order_id}</a></td>
	<td class="center">{$request.total_amount}</td>
<tr>
{foreachelse}
<tr>
	<td colspan="6"><p class="no-items">{$lang.no_return_requests_found}</p></td>
</tr>
{/foreach}
</tbody>
</table>
{include file="common_templates/pagination.tpl"}
</form>
{capture name="mainbox_title"}{$lang.return_requests}{/capture}
</div>