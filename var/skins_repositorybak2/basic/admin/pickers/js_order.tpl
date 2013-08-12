{if $view_mode == "simple"}
<span {if !$clone}id="{$holder}_{$order_id}" {/if}class="cm-js-item{if $clone} cm-clone{/if}{if $clone || $hidden} hidden{/if}">{if !$first_item}<span class="cm-comma{if $clone} hidden{/if}">, </span>{/if}#{$order_id}</span>
{else}
<tr {if !$clone}id="{$holder}_{$order_id}" {/if}class="cm-js-item{if $clone} cm-clone hidden{/if}">
	<td>
		<a href="{"orders.details?order_id=`$order_id`"|fn_url}">&nbsp;<span>#{$order_id}</span>&nbsp;</a></td>
	<td>{*<input type="hidden" name="origin_statuses[{$order_id}]" value="{$status}" />*}{if $clone}{$status}{else}{include file="common_templates/status.tpl" status=$status display="view" name="order_statuses[`$order_id`]"}{/if}</td>
	<td>{$customer}</td>
	<td>
		<a href="{"orders.details?order_id=`$order_id`"|fn_url}" class="underlined">{if $clone}{$timestamp}{else}{$timestamp|date_format:"`$settings.Appearance.date_format`, `$settings.Appearance.time_format`"}{/if}</a></td>
	<td class="right">
		{if $clone}{$total}{else}{include file="common_templates/price.tpl" value=$total}{/if}</td>
	{if !$view_only}
	<td class="nowrap">
		{capture name="tools_items"}
		<li><a onclick="$.delete_js_item('{$holder}', '{$order_id}', 'o'); return false;">{$lang.delete}</a></li>
		{/capture}
		{include file="common_templates/table_tools_list.tpl" prefix=$order_id tools_list=$smarty.capture.tools_items href="orders.details?order_id=`$order_id`"}
	</td>
	{/if}
</tr>
{/if}