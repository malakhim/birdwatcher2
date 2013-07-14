{if $category_id}
	{assign var="category_data" value=$category_id|fn_get_category_data:$smarty.const.CART_LANGUAGE:'':false:true}
	{assign var="category" value=$category_data.category|default:"`$ldelim`category`$rdelim`"}
	{if "COMPANY_ID"|defined && ($owner_company_id && $owner_company_id != $smarty.const.COMPANY_ID && $category_data.company_id != $smarty.const.COMPANY_ID || $category_data.company_id != $smarty.const.COMPANY_ID)}
	    {assign var="show_only_name" value=true}
	{/if}
	{if "COMPANY_ID"|defined && $owner_company_id && $owner_company_id != $smarty.const.COMPANY_ID}
		{assign var="hide_delete_button" value=true}
	{/if}
{else}
	{assign var="category" value=$default_name}
{/if}
{if $multiple}
	<tr {if !$clone}id="{$holder}_{$category_id}" {/if}class="cm-js-item {if $clone} cm-clone hidden{/if}">
		{if $position_field}<td><input type="text" name="{$input_name}[{$category_id}]" value="{math equation="a*b" a=$position b=10}" size="3" class="input-text-short"{if $clone} disabled="disabled"{/if} /></td>{/if}
		<td>{if !$show_only_name}<a href="{"categories.update?category_id=`$category_id`"|fn_url}">{$category|escape}</a>{else}{$category|escape} {include file="views/companies/components/company_name.tpl" company_id=$category_data.company_id}{/if}</td>
		<td class="nowrap">
		{if !$view_only}
		{capture name="tools_items"}
			{if !$hide_delete_button}
			<li><a onclick="$.delete_js_item('{$holder}', '{$category_id}', 'c'); return false;">{$lang.delete}</a></li>
			{/if}
			{/capture}
			{if $show_only_name}
				{include file="common_templates/table_tools_list.tpl" prefix=$category_id tools_list=$smarty.capture.tools_items}
			{else}
				{include file="common_templates/table_tools_list.tpl" prefix=$category_id tools_list=$smarty.capture.tools_items href="categories.update?category_id=`$category_id`"}
			{/if}
		{else}&nbsp;
		{/if}
		</td>
	</tr>
{else}
	{if $view_mode != "list"}
		<{if $single_line}span{else}p{/if} {if !$clone}id="{$holder}_{$category_id}" {/if}class="cm-js-item no-margin{if $clone} cm-clone hidden{/if}">
		{if !$first_item && $single_line}<span class="cm-comma{if $clone} hidden{/if}">,&nbsp;&nbsp;</span>{/if}
		<input class="input-text-medium cm-picker-value-description float-left{$extra_class}" type="text" value="{$category|escape}" {if $display_input_id}id="{$display_input_id}"{/if} size="10" name="category_name" readonly="readonly" {$extra} />
		</{if $single_line}span{else}p{/if}>
	{else}
		{assign var="default_category" value="`$ldelim`category`$rdelim`"}
		{assign var="default_category_id" value="`$ldelim`category_id`$rdelim`"}
		{if $first_item || !$category_id}<p class="cm-js-item cm-clone hidden margin-top-clear">{if $hide_input != "Y"}<input class="radio" id="category_rb_{$default_category_id}" type="radio" name="{$radio_input_name}" value="{$default_category_id}">{/if}<label for="category_rb_{$default_category_id}">{$default_category}</label> <a onclick="$.delete_js_item('{$holder}', '{$default_category_id}', 'c'); return false;"><img src="{$images_dir}/icons/delete_icon.gif" width="12" height="11" border="0" alt="{$lang.remove}" align="bottom" /></a></p>{/if}
		{if $category_id}<p class="cm-js-item categories-list-item {$extra_class}" id="{$holder}_{$category_id}" {$extra}>{if $hide_input != "Y"}<input class="radio" id="category_radio_button_{$category_id}"{if $main_category == $category_id}checked{/if} type="radio" name="{$radio_input_name}" value="{$category_id}" />{/if}{if $category_data.company_id}<span class="categories-store-name">{include file="views/companies/components/company_name.tpl" company_name=$category_data.company_name company_id=$category_data.company_id}</span>{/if}<label for="category_radio_button_{$category_id}">{$category|escape}</label>{if !"COMPANY_ID"|defined || ("COMPANY_ID"|defined && ($category_data.company_id == $smarty.const.COMPANY_ID || $smarty.const.COMPANY_ID == $owner_company_id))}<a onclick="$.delete_js_item('{$holder}', '{$category_id}', 'c'); return false;" class="icon-delete-small"><img src="{$images_dir}/icons/delete_icon.gif" width="12" height="11" border="0" alt="{$lang.remove}" title="{$lang.remove}" align="bottom" /></a>{/if}</p>{/if}
	{/if}
{/if}