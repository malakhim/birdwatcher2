<div {if $smarty.request.selected_section && $smarty.request.selected_section != "content_steps"}class="hidden"{/if} id="content_steps">

<form action="{""|fn_url}" method="post" name="steps_form">

{assign var="c_url" value=$config.current_url|fn_query_remove:"step_sort_by":"step_sort_order":"selected_section"}

<div id="pagination_steps">

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table sortable hidden-inputs">
<tr>
	<th class="center" width="1%">
		<input type="checkbox" name="check_all" value="Y" title="{$lang.check_uncheck_all}" class="checkbox cm-check-items" /></th>
	<th><a class="cm-ajax{if $steps_search.step_sort_by == "pos"} sort-link-{$steps_search.step_sort_order}{/if}" href="{"`$c_url`&amp;step_sort_by=pos&amp;step_sort_order=`$steps_search.step_sort_order`&amp;selected_section=steps"|fn_url}" rev="pagination_steps">{$lang.position_short}</a></th>
	<th width="80%"><a class="cm-ajax{if $steps_search.step_sort_by == "step_name"} sort-link-{$steps_search.step_sort_order}{/if}" href="{"`$c_url`&amp;step_sort_by=step_name&amp;step_sort_order=`$steps_search.step_sort_order`&amp;selected_section=steps"|fn_url}" rev="pagination_steps">{$lang.name}</a></th>
	<th width="15%"><a class="cm-ajax{if $steps_search.step_sort_by == "status"} sort-link-{$steps_search.step_sort_order}{/if}" href="{"`$c_url`&amp;step_sort_by=status&amp;step_sort_order=`$steps_search.step_sort_order`&amp;selected_section=steps"|fn_url}" rev="pagination_steps">{$lang.status}</a></th>
	<th>&nbsp;</th>
</tr>
{foreach from=$steps item=step}
<tr {cycle values="class=\"table-row\", " name="1"}>
	<td class="center" width="1%">
		<input type="checkbox" name="delete[]" value="{$step.step_id}" class="checkbox cm-item" /></td>
	<td class="center">
		<input type="text" name="step_data[{$step.step_id}][position]" value="{$step.position}" class="input-text-short" size="3" /></td>
	<td>
		<input type="text" name="step_data[{$step.step_id}][step_name]" value="{$step.step_name}" size="60" class="input-text" /></td>
	<td>
		{include file="common_templates/select_popup.tpl" id=$step.step_id prefix="step" status=$step.status hidden="" object_id_name="step_id" table="conf_steps"}
	</td>
	<td class="nowrap">
		{capture name="tools_items"}
		<li><a class="cm-confirm" href="{"configurator.delete_step?step_id=`$step.step_id`"|fn_url}">{$lang.delete}</a></li>
		{/capture}
		{include file="common_templates/table_tools_list.tpl" prefix=$step.step_id tools_list=$smarty.capture.tools_items}
	</td>
</tr>
{foreachelse}
<tr class="no-items">
	<td colspan="5"><p>{$lang.no_items}</p></td>
</tr>
{/foreach}
</table>
{if $steps}
{include file="common_templates/table_tools.tpl" href="#steps" visibility="Y"}
{/if}

<!--pagination_steps--></div>

<div class="buttons-container buttons-bg">
	{if $steps}
	<div class="float-left">
		{capture name="tools_list"}
		<ul>
			<li><a name="dispatch[configurator.m_delete_steps]" class="cm-process-items cm-confirm" rev="steps_form">{$lang.delete_selected}</a></li>
		</ul>
		{/capture}
		{include file="buttons/save.tpl" but_name="dispatch[configurator.m_update_steps]" but_role="button_main"}
		{include file="common_templates/tools.tpl" prefix="main" hide_actions=true tools_list=$smarty.capture.tools_list display="inline" link_text=$lang.choose_action}
	</div>
	{/if}

	<div class="float-right">
		{include file="common_templates/popupbox.tpl" id="add_new_steps" text=$lang.add_new_steps link_text=$lang.add_step act="general" content=""}
	</div>

</div>

</form>

{capture name="add_new_picker"}
<form action="{""|fn_url}" method="post" name="add_steps_form">
<input type="hidden" name="step_id" value="0">

<div class="tabs cm-j-tabs">
	<ul>
		<li id="tab_steps_new" class="cm-js cm-active"><a>{$lang.general}</a></li>
	</ul>
</div>

<div class="cm-tabs-content" id="content_tab_steps_new">
<fieldset>
	<div class="form-field">
		<label class="cm-required" for="elm_step_name">{$lang.name}:</label>
		<input type="text" id="elm_step_name" name="step_data[step_name]"  value="" class="input-text-large main-input" size="60" />
	</div>

	<div class="form-field">
		<label for="elm_step_pos">{$lang.position}:</label>
		<input type="text" id="elm_step_pos" name="step_data[position]" value="" class="input-text-short" size="3" />
	</div>

	{include file="common_templates/select_status.tpl" input_name="step_data[status]" id="elm_step_data_0"}
</fieldset>
</div>

<div class="buttons-container">
	{include file="buttons/save_cancel.tpl" but_name="dispatch[configurator.update_step]" create=true cancel_action="close"}
</div>

</form>
{/capture}
{include file="common_templates/popupbox.tpl" id="add_new_steps" content=$smarty.capture.add_new_picker text=$lang.add_new_steps act=""}

<!--content_steps--></div>
