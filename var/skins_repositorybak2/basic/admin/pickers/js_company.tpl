{if $company_id}
	{assign var="company" value=$company_id|fn_get_company_name|default:"`$ldelim`company`$rdelim`"}
{else}
	{assign var="company" value=$default_name}
{/if}
{if $multiple}
	<tr {if !$clone}id="{$holder}_{$company_id}" {/if}class="cm-js-item {if $clone} cm-clone hidden{/if}">
		{if $position_field}<td><input type="text" name="{$input_name}[{$company_id}]" value="{math equation="a*b" a=$position b=10}" size="3" class="input-text-short"{if $clone} disabled="disabled"{/if} /></td>{/if}
		<td>{if $hidden_field}<input type="hidden" name="{$input_name}[]" value="{$company_id}" size="3" class="input-text-short"{if $clone} disabled="disabled"{/if} />{/if}{if !$view_only}<a href="{"companies.update?company_id=`$company_id`"|fn_url}">{/if}{$company|escape}{if !$view_only}</a>{/if}</td>
		<td class="nowrap">
		{if !$hide_delete_button && !$view_only}
		{capture name="tools_items"}
			<li><a onclick="$.delete_js_item('{$holder}', '{$company_id}', 'm'); return false;">{$lang.delete}</a></li>
			{/capture}
			{if !$hide_edit_button != "view"}
				{assign var="href" value="companies.update?company_id=`$company_id`"}
			{/if}
			{include file="common_templates/table_tools_list.tpl" prefix=$company_id tools_list=$smarty.capture.tools_items href=$href}
		{else}&nbsp;
		{/if}
		</td>
	</tr>
{else}
	<{if $single_line}span{else}p{/if} {if !$clone}id="{$holder}_{$company_id}" {/if}class="cm-js-item no-margin{if $clone} cm-clone hidden{/if}">
	{if !$first_item && $single_line}<span class="cm-comma{if $clone} hidden{/if}">,&nbsp;&nbsp;</span>{/if}
	<input class="input-text-medium cm-picker-value-description{$extra_class}" type="text" value="{$company|escape}" {if $display_input_id}id="{$display_input_id}"{/if} size="10" name="company_name" readonly="readonly" {$extra} />
	</{if $single_line}span{else}p{/if}>
{/if}