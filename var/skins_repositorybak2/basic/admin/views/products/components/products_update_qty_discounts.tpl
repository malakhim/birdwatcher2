
{assign var="usergroups" value="C"|fn_get_usergroups}

<div id="content_qty_discounts" class="hidden">
	<table cellpadding="0" cellspacing="0" border="0" class="table" width="100%">
	<tbody class="cm-first-sibling">
	<tr>
		<th>{$lang.quantity}</th>
		<th>{$lang.value}</th>
		<th>{$lang.type}{include file="common_templates/tooltip.tpl" tooltip=$lang.qty_discount_type_tooltip}</th>
		
		<th width="100%">{$lang.usergroup}</th>
		
		<th width="1%">&nbsp;</th>
	</tr>
	</tbody>
	<tbody>
	{foreach from=$product_data.prices item="price" key="_key" name="prod_prices"}
	<tr class="cm-row-item">
		<td class="{$no_hide_input_if_shared_product}">
			{if $price.lower_limit == "1" && $price.usergroup_id == "0"}
				&nbsp;{$price.lower_limit}
			{else}
			<input type="text" name="product_data[prices][{$_key}][lower_limit]" value="{$price.lower_limit}" class="input-text-short" />
			{/if}</td>
		<td class="{$no_hide_input_if_shared_product}">
			{if $price.lower_limit == "1" && $price.usergroup_id == "0"}
				&nbsp;{if $price.percentage_discount == 0}{$price.price|default:"0.00"}{else}{$price.percentage_discount}{/if}
			{else}
			<input type="text" name="product_data[prices][{$_key}][price]" value="{if $price.percentage_discount == 0}{$price.price|default:"0.00"}{else}{$price.percentage_discount}{/if}" size="10" class="input-text-medium" />
			{/if}</td>
		<td class="{$no_hide_input_if_shared_product}">
			{if $price.lower_limit == "1" && $price.usergroup_id == "0"}
				&nbsp;{if $price.percentage_discount == 0}{$lang.absolute}{else}{$lang.percent}{/if}
			{else}
			<select name="product_data[prices][{$_key}][type]">
				<option value="A" {if $price.percentage_discount == 0}selected="selected"{/if}>{$lang.absolute} ({$currencies.$primary_currency.symbol})</option>
				<option value="P" {if $price.percentage_discount != 0}selected="selected"{/if}>{$lang.percent} (%)</option>
			</select>
			{/if}</td>
		
		<td class="{$no_hide_input_if_shared_product}">
			{if $price.lower_limit == "1" && $price.usergroup_id == "0"}
				&nbsp;{$lang.all}
			{else}
			<select id="usergroup_id" name="product_data[prices][{$_key}][usergroup_id]" class="qty-discount-select">
				{foreach from=""|fn_get_default_usergroups item="usergroup"}
					{if $price.usergroup_id != $usergroup.usergroup_id}
						<option value="{$usergroup.usergroup_id}">{$usergroup.usergroup|escape}</option>
					{else}
						{*we should do this because there are no descriptions for default usergruops in database*}
						{assign var="default_usergroup_name" value=$usergroup.usergroup|escape}
					{/if}
				{/foreach}
				{foreach from=$usergroups item="usergroup"}
					{if $price.usergroup_id != $usergroup.usergroup_id}
						<option value="{$usergroup.usergroup_id}">{$usergroup.usergroup|escape}</option>
					{/if}
				{/foreach}
					<option value="{$price.usergroup_id}" selected="selected">{if $default_usergroup_name}{$default_usergroup_name}{else}{$price.usergroup_id|fn_get_usergroup_name}{/if}</option>
			</select>
			{include file="buttons/update_for_all.tpl" display=$show_update_for_all object_id="price_`$_key`" name="update_all_vendors[prices][`$_key`]"}
			{assign var="default_usergroup_name" value=""}
			{/if}</td>
		
		<td class="nowrap {$no_hide_input_if_shared_product}">
			{if $price.lower_limit == "1" && $price.usergroup_id == "0"}
			&nbsp;{else}
			{include file="buttons/clone_delete.tpl" microformats="cm-delete-row" no_confirm=true}
			{/if}
		</td>
	</tr>
	{/foreach}
	{math equation="x+1" x=$_key|default:0 assign="new_key"}
	<tr class="{cycle values="table-row , " reset=1}{$no_hide_input_if_shared_product}" id="box_add_qty_discount">
		<td>
			<input type="text" name="product_data[prices][{$new_key}][lower_limit]" value="" class="input-text-short" /></td>
		<td>
			<input type="text" name="product_data[prices][{$new_key}][price]" value="0.00" size="10" class="input-text-medium" /></td>
		<td>
		<select name="product_data[prices][{$new_key}][type]">
			<option value="A" selected="selected">{$lang.absolute} ({$currencies.$primary_currency.symbol})</option>
			<option value="P">{$lang.percent} (%)</option>
		</select></td>
		
		<td>
			<select id="usergroup_id" name="product_data[prices][{$new_key}][usergroup_id]" class="qty-discount-select">
				{foreach from=""|fn_get_default_usergroups item="usergroup"}
					<option value="{$usergroup.usergroup_id}">{$usergroup.usergroup|escape}</option>
				{/foreach}
				{foreach from=$usergroups item="usergroup"}
					<option value="{$usergroup.usergroup_id}">{$usergroup.usergroup|escape}</option>
				{/foreach}
			</select>
			{include file="buttons/update_for_all.tpl" display=$show_update_for_all object_id="price_`$new_key`" name="update_all_vendors[prices][`$new_key`]"}
		</td>
		
		<td class="right">
			{include file="buttons/multiple_buttons.tpl" item_id="add_qty_discount"}
		</td>
	</tr>
	</tbody>
	</table>

</div>