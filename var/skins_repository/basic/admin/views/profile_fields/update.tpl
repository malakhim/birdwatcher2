{script src="js/tabs.js"}

{literal}
<script type="text/javascript">
//<![CDATA[
function fn_check_field_type(value, tab_id)
{
	$('#' + tab_id).toggleBy(!(value == 'R' || value == 'S'));
}
//]]>
</script>
{/literal}

{assign var="id" value=$field.field_id|default:"0"}
{if $field.is_default == "Y" || $field.section == "B"}
	{assign var="block_fields" value=true}
{/if}



{capture name="mainbox"}

<form action="{""|fn_url}" method="post" name="add_fields_form" class="cm-form-highlight {$hide_inputs}">

<div class="tabs cm-j-tabs">
	<ul>
		<li id="tab_new_profile{$id}" class="cm-js cm-active"><a>{$lang.general}</a></li>
		<li id="tab_variants{$id}" class="cm-js {if $block_fields || ($field.field_type != "R" && $field.field_type != "S")}hidden{/if}"><a>{$lang.variants}</a></li>
	</ul>
</div>
<div class="cm-tabs-content">
	<div id="content_tab_new_profile{$id}">
		<input type="hidden" name="field_data[field_id]" value="{$field.field_id}" />
		<input type="hidden" name="field_data[matching_id]" value="{$field.matching_id}" />
		<input type="hidden" name="field_id" value="{$id}" />
		<input type="hidden" name="field_data[field_name]" value="{$field.field_name}" />

		<div class="form-field">
			<label for="elm_field_description" class="cm-required">{$lang.description}:</label>
			<input id="elm_field_description" class="input-text-large main-input" type="text" name="field_data[description]" value="{$field.description}" />
		</div>

		<div class="form-field">
			<label for="elm_field_position">{$lang.position}:</label>
			<input class="input-text-short" id="elm_field_position" type="text" size="3" name="field_data[position]" value="{$field.position}" />
		</div>

		<div class="form-field">
			<label for="elm_field_type">{$lang.type}:</label>
			<select id="elm_field_type" name="field_data[field_type]" onchange="fn_check_field_type(this.value, 'tab_variants{$id}');" {if $block_fields}disabled="disabled"{/if}>
				<option value="P" {if $field.field_type == "P"}selected="selected"{/if}>{$lang.phone}</option>
				<option value="Z" {if $field.field_type == "Z"}selected="selected"{/if}>{$lang.zip_postal_code}</option>
				<option value="C" {if $field.field_type == "C"}selected="selected"{/if}>{$lang.checkbox}</option>
				<option value="D" {if $field.field_type == "D"}selected="selected"{/if}>{$lang.date}</option>
				<option value="I" {if $field.field_type == "I"}selected="selected"{/if}>{$lang.input_field}</option>
				<option value="R" {if $field.field_type == "R"}selected="selected"{/if}>{$lang.radiogroup}</option>
				<option value="S" {if $field.field_type == "S"}selected="selected"{/if}>{$lang.selectbox}</option>
				<option value="T" {if $field.field_type == "T"}selected="selected"{/if}>{$lang.textarea}</option>
				<option value="E" {if $field.field_type == "E"}selected="selected"{/if}>{$lang.email}</option>
			</select>
			{if $block_fields}
				<input type="hidden" name="field_data[field_type]" value="{$field.field_type}" />
			{/if}
		</div>

		<div class="form-field">
			<label for="elm_field_section">{$lang.section}:</label>
			{if $id}
				<input type="hidden" name="field_data[section]" value="{$field.section}" />
				<span class="shift-input">
					{if $field.section == "C"}{$lang.contact_information}{elseif $field.section == "B" || $field.section == "S"}{$lang.billing_address}/{$lang.shipping_address}{/if}
				</span>
			{else}
				<select id="elm_field_section" name="field_data[section]">
					<option value="C">{$lang.contact_information}</option>
					<option value="BS">{$lang.billing_address}/{$lang.shipping_address}</option>
				</select>
			{/if}
		</div>

		<div class="form-field">
			<label for="elm_field_user_class">{$lang.user_class}:</label>
			<input id="elm_field_user_class" class="input-text-large main-input" type="text" name="field_data[class]" value="{$field.class}" />
		</div>
		
		{foreach from=$profile_fields_areas key="key" item="d"}
		{assign var="_show" value="`$key`_show"}
		{assign var="_required" value="`$key`_required"}
		<div class="form-field">
			<label>{$lang.$d} ({$lang.show}&nbsp;/&nbsp;{$lang.required}):</label>
                <input type="hidden" name="field_data[{$_show}]" value="{if $field.$_show == "Y" && $field.field_name == "email"}Y{else}N{/if}" />
                <input type="checkbox" name="field_data[{$_show}]" value="Y" {if $field.$_show == "Y"}checked="checked"{/if} id="sw_req_{$_required}" class="cm-switch-availability checkbox" {if $field.field_name == "email"}disabled="disabled"{/if} />&nbsp;

                <input type="hidden" name="field_data[{$_required}]" value="{if $field.field_name == "email"}Y{else}N{/if}" />
                <span id="req_{$_required}{if $field.field_name == "email"}_email{/if}"><input type="checkbox" name="field_data[{$_required}]" value="Y" {if $field.$_required == "Y"}checked="checked"{/if} {if $field.$_show == "N" || $field.field_name == "email"}disabled="disabled"{/if} class="checkbox" /></span>
		</div>
		{/foreach}
	<!--content_tab_new_profile{$id}--></div>

	<div class="{if $block_fields || ($field.field_type != "R" && $field.field_type != "S")}hidden{/if}" id="content_tab_variants{$id}">
		<table cellpadding="0" cellspacing="0" border="0" class="table">
		<tr id="field_values_{$id}">
			<td colspan="{$_colspan}">
				<table cellpadding="0" cellspacing="0" border="0" width="1" class="table">
				<tr class="cm-first-sibling">
					<th>&nbsp;</th>
					<th>{$lang.position_short}</th>
					<th>{$lang.description}</th>
					<th>&nbsp;</th>
				</tr>
				{if $field}
					{foreach name="values" from=$field.values key="value_id" item="value"}
					<tr class="cm-first-sibling">
						<td class="center">
							<input type="checkbox" name="value_ids[]" value="{$value_id}" class="checkbox cm-item" />
						</td>
						<td>
							<input class="input-text-short" size="3" type="text" name="field_data[values][{$value_id}][position]" value="{$smarty.foreach.values.iteration}" />
						</td>
						<td>
							<input class="input-text" type="text" name="field_data[values][{$value_id}][description]" value="{$value}" />
						</td>
						<td>
							{include file="buttons/multiple_buttons.tpl" only_delete="Y"}
						</td>
					</tr>
					{/foreach}
				{/if}
				<tr id="box_elm_values_{$id}">
					<td>&nbsp;</td>
					<td><input class="input-text-short" size="3" type="text" name="field_data[add_values][0][position]" /></td>
					<td><input class="input-text" type="text" name="field_data[add_values][0][description]" /></td>
					<td>{include file="buttons/multiple_buttons.tpl" item_id="elm_values_`$id`" tag_level=2}</td>
				</tr>
				</table>
			</td>
		</tr>
		</table>
	<!--content_tab_variants{$id}--></div>
</div>

<div class="buttons-container buttons-bg">
	{include file="buttons/save_cancel.tpl" but_name="dispatch[profile_fields.update]"}
</div>

</form>

{/capture}

{if !$id}
	{assign var="title" value=$lang.new_profile_field}
{else}
	{assign var="title" value="`$lang.editing_profile_field`:&nbsp;`$field.description`"}
{/if}
{include file="common_templates/mainbox.tpl" title=$title content=$smarty.capture.mainbox select_languages=true}