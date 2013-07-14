
{capture name="mainbox"}

{if ""|fn_check_form_permissions}
	{assign var="update_link_text" value=$lang.view}
	{assign var="hide_inputs" value="cm-hide-inputs"}
{/if}

<form action="{""|fn_url}" method="post" name="fields_form"  class="{$hide_inputs}">
{math equation = "x + 5" assign="_colspan" x=$profile_fields_areas|sizeof}

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table profile-fields hidden-inputs">
<tr>
	<th>
		<input type="checkbox" name="check_all" value="Y" title="{$lang.check_uncheck_all}" class="checkbox cm-check-items" /></th>
	<th>{$lang.position_short}</th>
	<th width="100%">{$lang.description}</th>
	<th>{$lang.type}</th>
	{foreach from=$profile_fields_areas key="key" item="d"}
	<th class="center">
		<ul>
			<li>{$lang.$d}</li>
			<li>{$lang.show}&nbsp;/&nbsp;{$lang.required}</li>
		</ul>
	</th>
	{/foreach}
	<th>&nbsp;</th>
</tr>

{foreach from=$profile_fields key=section item=fields name="profile_fields"}
	{if $section != "E"}
	<tr>
		<td colspan="{$_colspan}">
			{if $section == "C"}{assign var="s_title" value=$lang.contact_information}
			{elseif $section == "B"}{assign var="s_title" value=$lang.billing_address}
			{elseif $section == "S"}{assign var="s_title" value=$lang.shipping_address}
			{/if}
			{include file="common_templates/subheader.tpl" title=$s_title}
		</td>
	</tr>
	{foreach from=$fields item=field}
	<tr {cycle values="class=\"table-row\", "}>
		<td class="center">
			{if $section != "B" && $field.is_default != "Y"}{assign var="extra_fields" value=true}{assign var="custom_fields" value=true}{if $field.matching_id}<input type="hidden" name="matches[{$field.matching_id}]" value="{$field.field_id}" />{/if}<input type="checkbox" name="field_ids[]" value="{$field.field_id}" class="checkbox cm-item" />{else}&nbsp;{/if}</td>
		<td><input class="input-text-short" type="text" size="3" name="fields_data[{$field.field_id}][position]" value="{$field.position}" /></td>
		<td>
			<input id="descr_elm_{$field.field_id}" class="input-text" size="20" type="text" name="fields_data[{$field.field_id}][description]" value="{$field.description}" /></td>
		<td class="nowrap">
			{if $field.field_type == "C"}{$lang.checkbox}
			{elseif $field.field_type == "I"}{$lang.input_field}
			{elseif $field.field_type == "R"}{$lang.radiogroup}
			{elseif $field.field_type == "S"}{$lang.selectbox}
			{elseif $field.field_type == "T"}{$lang.textarea}
			{elseif $field.field_type == "D"}{$lang.date}
			{elseif $field.field_type == "E"}{$lang.email}
			{elseif $field.field_type == "Z"}{$lang.zip_postal_code}
			{elseif $field.field_type == "P"}{$lang.phone}
			{elseif $field.field_type == "L"}<a href="{"static_data.manage?section=T"|fn_url}" class="underlined">{$lang.titles}&nbsp;&#155;&#155;</a>
			{elseif $field.field_type == "O"}<a href="{"countries.manage"|fn_url}" class="underlined">{$lang.country}&nbsp;&#155;&#155;</a>
			{elseif $field.field_type == "A"}<a href="{"states.manage"|fn_url}" class="underlined">{$lang.state}&nbsp;&#155;&#155;</a>
			{elseif $field.field_type == "N"}{$lang.address_type}
			{/if}

			<input type="hidden" name="fields_data[{$field.field_id}][field_id]" value="{$field.field_id}" />
			<input type="hidden" name="fields_data[{$field.field_id}][field_name]" value="{$field.field_name}" />
			<input type="hidden" name="fields_data[{$field.field_id}][section]" value="{$section}" />
			<input type="hidden" name="fields_data[{$field.field_id}][matching_id]" value="{$field.matching_id}" />
			<input type="hidden" name="fields_data[{$field.field_id}][field_type]" value="{$field.field_type}" />
		</td>

		{foreach from=$profile_fields_areas key="key" item="d"}
		{assign var="_show" value="`$key`_show"}
		{assign var="_required" value="`$key`_required"}
		<td class="center">
            <input type="hidden" name="fields_data[{$field.field_id}][{$_show}]" value="N" />
            {if $field.field_name == "email"}
                <input type="radio" name="fields_data[email][{$_show}]" value="{$field.field_id}" {if $field.$_show == "Y"}checked="checked"{/if} id="sw_req_{$key}_{$field.field_id}" class="cm-switch-availability" />
            {else}
                <input type="checkbox" name="fields_data[{$field.field_id}][{$_show}]" value="Y" {if $field.$_show == "Y"}checked="checked"{/if} id="sw_req_{$key}_{$field.field_id}" class="cm-switch-availability" />
            {/if}

			<input type="hidden" name="fields_data[{$field.field_id}][{$_required}]" value="{if $field.field_name == "email"}Y{else}N{/if}" />
            <span id="req_{$key}_{$field.field_id}{if $field.field_name == "email"}_email{/if}">
                <input type="checkbox" name="fields_data[{$field.field_id}][{$_required}]" value="Y" {if $field.$_required == "Y" || $field.field_name == "email"}checked="checked"{/if} {if $field.$_show == "N" || $field.field_name == "email"}disabled="disabled"{/if} />
			</span>
		</td>
		{/foreach}
		<td class="nowrap">
			{capture name="tools_items"}
				{if $custom_fields}
					<li><a class="cm-confirm" href="{"profile_fields.delete?field_id=`$field.field_id`"|fn_url}">{$lang.delete}</a></li>
				{else}
					<li><span class="undeleted-element">{$lang.delete}</span></li>
				{/if}
			{/capture}
			
			{include file="common_templates/table_tools_list.tpl" href="profile_fields.update?field_id=`$field.field_id`"|fn_url prefix=$field.field_id tools_list=$smarty.capture.tools_items link_text=$update_link_text}
		</td>
	</tr>
	
	{assign var="custom_fields" value=false}
	{/foreach}

	{/if}
{foreachelse}
<tr class="no-items">
	<td colspan="{$_colspan}"><p>{$lang.no_items}</p></td>
</tr>

{/foreach}
</table>

<div class="buttons-container buttons-bg">
	{if $profile_fields}
		<div class="float-left">
			{include file="buttons/save.tpl" but_name="dispatch[profile_fields.m_update]" but_role="button_main"}
			{if $extra_fields}
			{capture name="tools_list"}
			<ul>
				<li><a class="cm-process-items cm-confirm" name="dispatch[profile_fields.delete]" rev="fields_form">{$lang.delete_selected}</a></li>
			</ul>
			{/capture}
			{include file="common_templates/tools.tpl" prefix="main" hide_actions=true tools_list=$smarty.capture.tools_list display="inline" link_text=$lang.choose_action}
			{/if}
		</div>
	{/if}
</div>

</form>

{capture name="tools"}
	{include file="common_templates/tools.tpl" tool_href="profile_fields.add" prefix="top" link_text=$lang.add_field hide_tools=true}
{/capture}

{/capture}
{include file="common_templates/mainbox.tpl" title=$lang.profile_fields content=$smarty.capture.mainbox tools=$smarty.capture.tools select_languages=true}
