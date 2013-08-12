

{if $type == "options"}
<tr {if !$clone}id="{$root_id}_{$delete_id}" {/if}class="cm-js-item{if $clone} cm-clone hidden{/if}">
{if $position_field}<td><input type="text" name="{$input_name}[{$delete_id}]" value="{math equation="a*b" a=$position b=10}" size="3" class="input-text-short" {if $clone}disabled="disabled"{/if} /></td>{/if}
<td>
	<ul>
		<li>{$product}{if $show_only_name} {include file="views/companies/components/company_name.tpl" company_id=$product_data.company_id}{/if}</li>
		{if $options}
		<li>{$options}</li>
		{/if}
	</ul>
	{if $options_array|is_array}
		{foreach from=$options_array item="option" key="option_id"}
		<input type="hidden" name="{$input_name}[product_options][{$option_id}]" value="{$option}"{if $clone} disabled="disabled"{/if} />
		{/foreach}
	{/if}
	{if $product_id}
		<input type="hidden" name="{$input_name}[product_id]" value="{$product_id}"{if $clone} disabled="disabled"{/if} />
	{/if}
	{if $amount_input == "hidden"}
	<input type="hidden" name="{$input_name}[amount]" value="{$amount}"{if $clone} disabled="disabled"{/if} />
	{/if}
</td>
	{if $amount_input == "text"}
<td>
	{if $show_only_name}
		{$amount}
	{else}
		<input type="text" name="{$input_name}[amount]" value="{$amount}" size="3" class="input-text-short"{if $clone} disabled="disabled"{/if} />
	{/if}
</td>
	{/if}

	{hook name="product_picker:table_column_options"}
	{/hook}
<td class="nowrap">
	{if !$hide_delete_button && !$show_only_name}
		{capture name="tools_items"}
		<li><a onclick="$.delete_js_item('{$root_id}', '{$delete_id}', 'p'); return false;">{$lang.delete}</a></li>
		{/capture}
		{include file="common_templates/table_tools_list.tpl" prefix=$category_id tools_list=$smarty.capture.tools_items skip_check_permissions=1}
	{else}&nbsp;{/if}
</td>
</tr>

{elseif $type == "product"}
	<tr {if !$clone}id="{$root_id}_{$delete_id}" {/if}class="cm-js-item{if $clone} cm-clone hidden{/if}">
		{if $position_field}<td><input type="text" name="{$input_name}[{$delete_id}]" value="{math equation="a*b" a=$position b=10}" size="3" class="input-text-short" {if $clone}disabled="disabled"{/if} /></td>{/if}
		<td>{if !$show_only_name}<a href="{"products.update?product_id=`$delete_id`"|fn_url}">{$product|unescape}</a>{else}{$product|unescape} {include file="views/companies/components/company_name.tpl" company_id=$product_data.company_id}{/if}</td>
		<td>&nbsp;</td>
		<td class="nowrap">{if !$hide_delete_button && !$show_only_name}
			{capture name="tools_items"}
			<li><a onclick="$.delete_js_item('{$root_id}', '{$delete_id}', 'p'); return false;">{$lang.delete}</a></li>
			{/capture}
			{include file="common_templates/table_tools_list.tpl" prefix=$category_id tools_list=$smarty.capture.tools_items href="products.update?product_id=`$delete_id`" skip_check_permissions=1}
		{else}&nbsp;{/if}</td>
	</tr>
{/if}
