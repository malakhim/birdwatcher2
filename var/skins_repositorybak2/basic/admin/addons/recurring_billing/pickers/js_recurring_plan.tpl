{if $recurring_plan_id == "0"}
	{assign var="recurring_plan" value=$default_name}
{else}
	{assign var="recurring_plan" value=$recurring_plan_id|fn_get_recurring_plan_name|default:"`$ldelim`recurring_plan`$rdelim`"}
{/if}

<tr {if !$clone}id="{$holder}_{$recurring_plan_id}" {/if}class="cm-js-item{if $clone} cm-clone hidden{/if}">
	<td><a href="{"recurring_plans.update?plan_id=`$recurring_plan_id`"|fn_url}">{$recurring_plan|escape}</a></td>
	<td>{if !$hide_delete_button && !$view_only}<a onclick="$.delete_js_item('{$holder}', '{$recurring_plan_id}', 'r'); return false;"><img width="12" height="18" border="0" class="hand valign" alt="" src="{$images_dir}/icons/icon_delete.gif"/></a>{else}&nbsp;{/if}</td>
</tr>