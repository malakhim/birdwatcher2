{capture name="mainbox"}

{capture name="section"}

<form action="{""|fn_url}" name="{$key}_filter_form" method="get">
<input type="hidden" name="report" value="{$report_data.report}" />
<input type="hidden" name="reports_group" value="{$reports_group}" />

<table cellspacing="0" border="0" class="search-header">
<tr>
	<td class="nowrap search-field">
		<label>{$lang.country}:</label>
		<div class="break">
			<select name="country_code">
				{foreach from=$countries item=country}
					<option	{if	$country.code == $country_code}selected="selected"{/if} value="{$country.code}">{$country.country}</option>
				{/foreach}
			</select>
		</div>
	</td>
	<td class="buttons-container">
		{include file="buttons/search.tpl" but_name="dispatch[states.manage]" but_role="submit"}
	</td>
</tr>
</table>

</form>

{/capture}
{include file="common_templates/section.tpl" section_content=$smarty.capture.section}


<form action="{""|fn_url}" method="post" name="states_form" class="cm-form-highlight{if "COMPANY_ID"|defined} cm-hide-inputs{/if}">
<input type="hidden" name="country_code" value="{$country_code}" />

{include file="common_templates/pagination.tpl" save_current_page=true}

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table hidden-inputs">
<tr>
	<th>
		<input type="checkbox" name="check_all" value="Y" title="{$lang.check_uncheck_all}" class="checkbox cm-check-items" /></th>
	<th width="10%">{$lang.code}</th>
	<th width="40%">{$lang.state}</th>
	<th width="50%">{$lang.status}</th>
	<th>&nbsp;</th>
</tr>
{foreach from=$states item=state}
<tr {cycle values="class=\"table-row\", "}>
	<td>
		<input type="checkbox" name="state_ids[]" value="{$state.state_id}" class="checkbox cm-item" /></td>
	<td class="center nowrap">
		<span>{$state.code}</span>
		{*<input type="text" name="states[{$state.state_id}][code]" size="8" value="{$state.code}" class="input-text" />*}</td>
	<td>
		<input type="text" name="states[{$state.state_id}][state]" size="55" value="{$state.state}" class="input-text" /></td>
	<td>
		{include file="common_templates/select_popup.tpl" id=$state.state_id status=$state.status hidden="" object_id_name="state_id" table="states"}
	</td>
	<td class="nowrap">
		{capture name="tools_items"}
		<li><a class="cm-confirm" href="{"states.delete?state_id=`$state.state_id`&amp;country_code=`$country_code`"|fn_url}">{$lang.delete}</a></li>
		{/capture}
		{include file="common_templates/table_tools_list.tpl" prefix=$state.state_id tools_list=$smarty.capture.tools_items}
	</td>
</tr>
{foreachelse}
<tr class="no-items">
	<td colspan="5"><p>{$lang.no_items}</p></td>
</tr>
{/foreach}
</table>

{include file="common_templates/pagination.tpl"}

<div class="buttons-container buttons-bg">
	{if $states}
	<div class="float-left">
		{capture name="tools_list"}
		<ul>
			<li><a name="dispatch[states.delete]" class="cm-process-items cm-confirm" rev="states_form">{$lang.delete_selected}</a></li>
		</ul>
		{/capture}
		{include file="buttons/save.tpl" but_name="dispatch[states.m_update]" but_role="button_main"}
		{include file="common_templates/tools.tpl" prefix="main" hide_actions=true tools_list=$smarty.capture.tools_list display="inline" link_text=$lang.choose_action}
	</div>
	{/if}
</div>

</form>

{capture name="tools"}
	{capture name="add_new_picker"}

	<form action="{""|fn_url}" method="post" name="add_states_form">
	<input type="hidden" name="state_data[country_code]" value="{$country_code}" />
	<input type="hidden" name="country_code" value="{$country_code}" />
	<input type="hidden" name="state_id" value="0" />

	{foreach from=$countries item=country}
		{if	$country.code == $country_code}
			{assign var="title" value="`$lang.new_states` (`$country.country`)"}
		{/if}
	{/foreach}

	<div class="tabs cm-j-tabs">
		<ul>
			<li id="tab_new_states" class="cm-js cm-active"><a>{$lang.general}</a></li>
		</ul>
	</div>

	<div class="cm-tabs-content">
	<fieldset>
		<div class="form-field">
			<label class="cm-required" for="elm_state_code">{$lang.code}:</label>
			<input type="text" id="elm_state_code" name="state_data[code]" size="8" value="" class="input-text main-input" />
		</div>

		<div class="form-field">
			<label for="elm_state_name">{$lang.state}:</label>
			<input type="text" id="elm_state_name" name="state_data[state]" size="55" value="" class="input-text" />
		</div>

		{include file="common_templates/select_status.tpl" input_name="state_data[status]" id="elm_state_status"}
	</fieldset>
	</div>

	<div class="buttons-container">
		{include file="buttons/save_cancel.tpl" create=true but_name="dispatch[states.update]" cancel_action="close"}
	</div>

	</form>

	{/capture}
	{include file="common_templates/popupbox.tpl" id="new_state" action="states.add" text=$title content=$smarty.capture.add_new_picker link_text=$lang.add_state act="general"}
{/capture}

{/capture}
{include file="common_templates/mainbox.tpl" title=$lang.states content=$smarty.capture.mainbox tools=$smarty.capture.tools select_languages=true}