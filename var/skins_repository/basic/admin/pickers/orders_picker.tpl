{math equation="rand()" assign="rnd"}
{assign var="data_id" value="`$data_id`_`$rnd`"}
{assign var="view_mode" value=$view_mode|default:"mixed"}

{script src="js/picker.js"}

{if $item_ids && !$item_ids|is_array}
	{assign var="item_ids" value=","|explode:$item_ids}
{/if}

{if $view_mode == "simple"}
	{assign var="display" value="simple"}
	{assign var="max_displayed_qty" value="50"}
	<input id="o{$data_id}_ids" type="hidden" name="{$input_name}" value="{if $item_ids}{","|implode:$item_ids}{/if}" />
	<span id="{$data_id}"{if !$item_ids} class="hidden"{/if}>
		{include file="pickers/js_order.tpl" order_id="`$ldelim`order_id`$rdelim`" clone=true}
		{foreach from=$item_ids item="o" name="items"}
			{if $smarty.foreach.items.iteration <= $max_displayed_qty}
			{include file="pickers/js_order.tpl" order_id=$o first_item=$smarty.foreach.items.first holder=$data_id}
			{else}
			{include file="pickers/js_order.tpl" order_id=$o first_item=$smarty.foreach.items.first holder=$data_id hidden=true}
			{/if}
		{/foreach}
	</span>
	<span id="{$data_id}_details"{if $item_ids|count <= $max_displayed_qty} class="hidden"{/if}><a href="{"orders.manage?order_id="|fn_url}{if $item_ids}{','|implode:$item_ids}{/if}">..</a></span>
	<span id="{$data_id}_no_item"{if $item_ids} class="hidden"{/if}>{$no_item_text}</span>

{elseif $view_mode != "button"}
	

	<input id="o{$data_id}_ids" type="hidden" name="{$input_name}" value="{if $item_ids}{","|implode:$item_ids}{/if}" />
	<table border="0" cellpadding="0" cellspacing="0" width="100%" class="table">
		<tr>
			<th width="10%">{$lang.id}</th>
			<th width="15%">{$lang.status}</th>
			<th width="25%">{$lang.customer}</th>
			<th width="25%">{$lang.date}</th>
			<th width="24%" class="right">{$lang.total}</th>
			{if !$view_only}<th>&nbsp;</th>{/if}
		</tr>
		<tbody id="{$data_id}"{if !$item_ids} class="hidden"{/if}>
		{include file="pickers/js_order.tpl" order_id="`$ldelim`order_id`$rdelim`" status="`$ldelim`status`$rdelim`" customer="`$ldelim`customer`$rdelim`" timestamp="`$ldelim`timestamp`$rdelim`" total="`$ldelim`total`$rdelim`" holder=$data_id clone=true}
		{foreach from=$item_ids item="o"}
			{assign var="order_info" value=$o|fn_get_order_short_info}
			{include file="pickers/js_order.tpl" order_id=$o status=$order_info.status customer="`$order_info.firstname` `$order_info.lastname`" timestamp=$order_info.timestamp total=$order_info.total holder=$data_id}
		{/foreach}
		</tbody>
		<tbody id="{$data_id}_no_item"{if $item_ids} class="hidden"{/if}>
		<tr class="no-items">
			<td colspan="5"><p>{$no_item_text}</p></td>
		</tr>
		</tbody>
	</table>
{/if}

{if $view_mode != "list"}

	{if $extra_var}
		{assign var="extra_var" value=$extra_var|escape:url}
	{/if}

	{if !$no_container}<div class="buttons-container">{/if}{if $picker_view}[{/if}
		{if $view_mode == "simple"}
		<span class="float-left">
		{/if}
		{include file="buttons/button.tpl" but_id="opener_picker_`$data_id`" but_href="orders.picker?display=`$display`&amp;picker_for=`$picker_for`&amp;extra=`$extra_var`&amp;checkbox_name=`$checkbox_name`&amp;aoc=`$aoc`&amp;data_id=`$data_id`&amp;max_displayed_qty=`$max_displayed_qty`"|fn_url but_text=$but_text|default:$lang.add_orders but_role="add" but_rev="content_`$data_id`" but_meta="cm-dialog-opener"}
		{if $view_mode == "simple"}
		</span>
		{/if}
		{if $view_mode == "simple"}
		<span id="{$data_id}_clear" class="reload-container{if !$item_ids} hidden{/if}">{include file="buttons/button.tpl" but_id="opener_picker_`$data_id`" but_onclick="$.delete_js_item('`$data_id`', 'delete_all', 'o'); fn_check_items_qty('`$data_id`'); return false;" but_text=$but_text|default:$lang.clear_added_orders but_role="reload" but_rev="content_`$data_id`"}</span>
		{/if}
	{if $picker_view}]{/if}{if !$no_container}</div>{/if}

	<div class="hidden" id="content_{$data_id}" title="{$but_text|default:$lang.add_orders}">
	</div>
{/if}