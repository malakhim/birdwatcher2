{if $show_email}
	<div class="form-field">
		<label for="{$id_prefix}elm_email" class="cm-required cm-email">{$lang.email}<i>*</i></label>
		<input type="text" id="{$id_prefix}elm_email" name="user_data[email]" size="32" value="{$user_data.email}" class="input-text {$_class}" {$disabled_param} />
	</div>
{else}

{if $profile_fields.$section}

{if $address_flag}
	<div class="address-switch clearfix">
		<div class="float-left"><span>{if $section == "S"}{$lang.shipping_same_as_billing}{else}{$lang.text_billing_same_with_shipping}{/if}</span></div>
		<div class="float-right">
			<input class="radio cm-switch-availability cm-switch-inverse cm-switch-visibilty" type="radio" name="copy_address" value="Y" id="sw_{$body_id}_suffix_yes" {if !$ship_to_another}checked="checked"{/if} /><label for="sw_{$body_id}_suffix_yes">{$lang.yes}</label>
			<input class="radio cm-switch-availability cm-switch-visibilty" type="radio" name="copy_address" value="" id="sw_{$body_id}_suffix_no" {if $ship_to_another}checked="checked"{/if} /><label for="sw_{$body_id}_suffix_no">{$lang.no}</label>
		</div>
	</div>
{/if}

{if ($address_flag && !$ship_to_another && ($section == "S" || $section == "B")) || $disabled_by_default}
	{assign var="disabled_param" value="disabled=\"disabled\""}
	{assign var="_class" value="disabled"}
	{assign var="hide_fields" value=true}
{else}
	{assign var="disabled_param" value=""}
	{assign var="_class" value=""}
{/if}

<div class="clearfix">
{if $body_id || $grid_wrap}
	<div id="{$body_id}" class="{if $hide_fields}hidden{/if}">
		<div class="{$grid_wrap}">
{/if}

{if !$nothing_extra}
	{include file="common_templates/subheader.tpl" title=$title}
{/if}

{foreach from=$profile_fields.$section item=field}

{if $field.field_name}
	{assign var="data_name" value="user_data"}
	{assign var="data_id" value=$field.field_name}
	{assign var="value" value=$user_data.$data_id}
{else}
	{assign var="data_name" value="user_data[fields]"}
	{assign var="data_id" value=$field.field_id}
	{assign var="value" value=$user_data.fields.$data_id}
{/if}

{assign var="skip_field" value=false}
{if $section == "S" || $section == "B"}
	{if $section == "S"}
		{assign var="_to" value="B"}
	{else}
		{assign var="_to" value="S"}
	{/if}
	{if !$profile_fields.$_to[$field.matching_id]}
		{assign var="skip_field" value=true}
	{/if}
{/if}

{hook name="profiles:profile_fields"}
<div class="form-field {$field.class}">
	{if $pref_field_name != $field.description || $field.required == "Y"}
		<label for="{$id_prefix}elm_{$field.field_id}" class="cm-profile-field {if $field.required == "Y"}cm-required{/if}{if $field.field_type == "P"} cm-phone{/if}{if $field.field_type == "Z"} cm-zipcode{/if}{if $field.field_type == "E"} cm-email{/if}{if $field.field_type == "A"} cm-state{/if}{if $field.field_type == "O"} cm-country{/if} {if $field.field_type == "O" || $field.field_type == "A" || $field.field_type == "Z"}{if $section == "S"}cm-location-shipping{else}cm-location-billing{/if}{/if}">{$field.description}</label>
	{/if}
	{if $field.field_type == "L"} {* Titles selectbox *}
		<select id="{$id_prefix}elm_{$field.field_id}" class="{if !$skip_field}{$_class}{else}cm-skip-avail-switch{/if}" name="{$data_name}[{$data_id}]" {if !$skip_field}{$disabled_param}{/if}>
			{foreach from=$titles item="t"}
			<option {if $value == $t.param}selected="selected"{/if} value="{$t.param}">{$t.descr}</option>
			{/foreach}
		</select>

	{elseif $field.field_type == "A"}  {* State selectbox *}
		<select id="{$id_prefix}elm_{$field.field_id}" class="{if !$skip_field}{$_class}{/if}" name="{$data_name}[{$data_id}]" {if !$skip_field}{$disabled_param}{/if}>
			<option value="">- {$lang.select_state} -</option>
			{* Initializing default states *}
			{assign var="country_code" value=$settings.General.default_country}
			{assign var="state_code" value=$value|default:$settings.General.default_state}
			{if $states}
				{foreach from=$states.$country_code item=state}
					<option {if $state_code == $state.code}selected="selected"{/if} value="{$state.code}">{$state.state}</option>
				{/foreach}
			{/if}
		</select><input type="text" id="elm_{$field.field_id}_d" name="{$data_name}[{$data_id}]" size="32" maxlength="64" value="{$value}" disabled="disabled" class="input-text hidden {if $_class}disabled{/if}"/>
		<input type="hidden" id="{$id_prefix}elm_{$field.field_id}_default" value="{$state_code}" />

	{elseif $field.field_type == "O"}  {* Countries selectbox *}
		{assign var="_country" value=$value|default:$settings.General.default_country}
		<select id="{$id_prefix}elm_{$field.field_id}" class="{if $section == "S"}cm-location-shipping{else}cm-location-billing{/if} {if !$skip_field}{$_class}{else}cm-skip-avail-switch{/if}" name="{$data_name}[{$data_id}]" {if !$skip_field}{$disabled_param}{/if}>
			{hook name="profiles:country_selectbox_items"}
			<option value="">- {$lang.select_country} -</option>
			{foreach from=$countries item=country}
			<option {if $_country == $country.code}selected="selected"{/if} value="{$country.code}">{$country.country}</option>
			{/foreach}
			{/hook}
		</select>
	
	{elseif $field.field_type == "C"}  {* Checkbox *}
		<input type="hidden" name="{$data_name}[{$data_id}]" value="N" {if !$skip_field}{$disabled_param}{/if} />
		<input type="checkbox" id="{$id_prefix}elm_{$field.field_id}" name="{$data_name}[{$data_id}]" value="Y" {if $value == "Y"}checked="checked"{/if} class="checkbox {if !$skip_field}{$_class}{else}cm-skip-avail-switch{/if}" {if !$skip_field}{$disabled_param}{/if} />

	{elseif $field.field_type == "T"}  {* Textarea *}
		<textarea class="input-textarea {if !$skip_field}{$_class}{else}cm-skip-avail-switch{/if}" id="{$id_prefix}elm_{$field.field_id}" name="{$data_name}[{$data_id}]" cols="32" rows="3" {if !$skip_field}{$disabled_param}{/if}>{$value}</textarea>
	
	{elseif $field.field_type == "D"}  {* Date *}
		{if !$skip_field}
			{include file="common_templates/calendar.tpl" date_id="`$id_prefix`elm_`$field.field_id`" date_name="`$data_name`[`$data_id`]" date_val=$value start_year="1902" end_year="0" extra=$disabled_param}
		{else}
			{include file="common_templates/calendar.tpl" date_id="`$id_prefix`elm_`$field.field_id`" date_name="`$data_name`[`$data_id`]" date_val=$value start_year="1902" end_year="0"}
		{/if}

	{elseif $field.field_type == "S"}  {* Selectbox *}
		<select id="{$id_prefix}elm_{$field.field_id}" class="{if !$skip_field}{$_class}{else}cm-skip-avail-switch{/if}" name="{$data_name}[{$data_id}]" {if !$skip_field}{$disabled_param}{/if}>
			{if $field.required != "Y"}
			<option value="">--</option>
			{/if}
			{foreach from=$field.values key=k item=v}
			<option {if $value == $k}selected="selected"{/if} value="{$k}">{$v}</option>
			{/foreach}
		</select>
	
	{elseif $field.field_type == "R"}  {* Radiogroup *}
		<div id="{$id_prefix}elm_{$field.field_id}">
			{foreach from=$field.values key=k item=v name="rfe"}
			<input class="radio valign {if !$skip_field}{$_class}{else}cm-skip-avail-switch{/if} {$id_prefix}elm_{$field.field_id}" type="radio" id="{$id_prefix}elm_{$field.field_id}_{$k}" name="{$data_name}[{$data_id}]" value="{$k}" {if (!$value && $smarty.foreach.rfe.first) || $value == $k}checked="checked"{/if} {if !$skip_field}{$disabled_param}{/if} /><span class="radio">{$v}</span>
			{/foreach}
		</div>

	{elseif $field.field_type == "N"}  {* Address type *}
		<input class="radio valign {if !$skip_field}{$_class}{else}cm-skip-avail-switch{/if} {$id_prefix}elm_{$field.field_id}" type="radio" id="{$id_prefix}elm_{$field.field_id}_residential" name="{$data_name}[{$data_id}]" value="residential" {if !$value || $value == "residential"}checked="checked"{/if} {if !$skip_field}{$disabled_param}{/if} /><span class="radio">{$lang.address_residential}</span>
		<input class="radio valign {if !$skip_field}{$_class}{else}cm-skip-avail-switch{/if} {$id_prefix}elm_{$field.field_id}" type="radio" id="{$id_prefix}elm_{$field.field_id}_commercial" name="{$data_name}[{$data_id}]" value="commercial" {if $value == "commercial"}checked="checked"{/if} {if !$skip_field}{$disabled_param}{/if} /><span class="radio">{$lang.address_commercial}</span>

	{else}  {* Simple input *}
		<input type="text" id="{$id_prefix}elm_{$field.field_id}" name="{$data_name}[{$data_id}]" size="32" value="{$value}" class="input-text {if !$skip_field}{$_class}{else}cm-skip-avail-switch{/if}" {if !$skip_field}{$disabled_param}{/if} />
	{/if}

	{assign var="pref_field_name" value=$field.description}
</div>
{/hook}
{/foreach}

{if $body_id || $grid_wrap}
		</div>
	</div>
{/if}
</div>

{/if}
{/if}