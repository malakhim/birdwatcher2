{if $mode == "add"}
	{assign var="id" value="0"}
{else}
	{assign var="id" value=$filter.filter_id}
{/if}

{assign var="filter_fields" value=""|fn_get_product_filter_fields}

<div id="content_group{$id}">

<form action="{""|fn_url}" name="update_filter_form_{$id}" method="post" class="cm-form-highlight{if ""|fn_check_form_permissions || ($smarty.const.PRODUCT_TYPE == "ULTIMATE" && "COMPANY_ID"|defined && $filter.company_id != $smarty.const.COMPANY_ID && $mode != "add")} cm-hide-inputs{/if}">

<input type="hidden" class="cm-no-hide-input" name="filter_id" value="{$id}" />
<input type="hidden" class="cm-no-hide-input" name="redirect_url" value="{$smarty.request.return_url}" />

<div class="tabs cm-j-tabs">
	<ul>
		<li id="tab_details_{$id}" class="cm-js cm-active"><a>{$lang.general}</a></li>
		{if ($filter.feature_type && "ODN"|strpos:$filter.feature_type !== false) || ($filter.field_type && $filter_fields[$filter.field_type].is_range == true) || $mode == "add"}
			<li id="tab_variants_{$id}" class="cm-js {if $mode == "add"}hidden{/if}"><a>{$lang.ranges}</a></li>
		{/if}
		<li id="tab_categories_{$id}" class="cm-js"><a>{$lang.categories}</a></li>
	</ul>
</div>
<div class="cm-tabs-content" id="tabs_content_{$id}">
	<div id="content_tab_details_{$id}">
	<fieldset>
		<div class="form-field">
			<label for="filter_name_{$id}" class="cm-required">{$lang.name}:</label>
			<input type="text" id="filter_name_{$id}" name="filter_data[filter]" class="input-text-large main-input" value="{$filter.filter}" />
		</div>



		<div class="form-field">
			<label for="position_{$id}">{$lang.position_short}:</label>
			<input type="text" id="position_{$id}" name="filter_data[position]" size="3" value="{$filter.position}{if $mode == "add"}0{/if}" class="input-text-short" />
		</div>

		<div class="form-field">
			<label for="elm_show_on_home_page_{$id}">{$lang.show_on_home_page}:</label>
			<input type="hidden" name="filter_data[show_on_home_page]" value="N" />
			<input type="checkbox" id="elm_show_on_home_page_{$id}" name="filter_data[show_on_home_page]" {if $filter.show_on_home_page == "Y" || !$filter}checked="checked"{/if} value="Y" class="checkbox" />
		</div>

		<div class="form-field">
			<label for="filter_by_{$id}">{$lang.filter_by}:</label>
			{if $mode == "add"}
				{* F - feature, R - range field, B - base field *}
				<select name="filter_data[filter_type]" onchange="fn_check_product_filter_type(this.value, 'tab_variants_{$id}', {$id});" id="filter_by_{$id}">
				{if $filter_features}
					<optgroup label="{$lang.features}">
					{foreach from=$filter_features item=feature}
						<option value="{if "ON"|strpos:$feature.feature_type !== false}R{elseif $feature.feature_type == "D"}D{else}F{/if}F-{$feature.feature_id}">{$feature.description}</option>
					{if $feature.subfeatures}
					{foreach from=$feature.subfeatures item=subfeature}
						<option value="{if "ON"|strpos:$feature.feature_type !== false}R{elseif $feature.feature_type == "D"}D{else}F{/if}F-{$subfeature.feature_id}">{$subfeature.description}</option>
					{/foreach}
					{/if}
					{/foreach}
					</optgroup>
				{/if}
					<optgroup label="{$lang.product_fields}">
					{foreach from=$filter_fields item="field" key="field_type"}
						{if !$field.hidden}
							<option value="{if $field.is_range}R{else}B{/if}-{$field_type}">{$lang[$field.description]}</option>
						{/if}
					{/foreach}
					</optgroup>
				</select>
			{else}
				<input type="hidden" name="filter_data[filter_type]" value="{if $filter.feature_id}FF-{$filter.feature_id}{else}{if $filter_fields[$filter.field_type].is_range}R{else}B{/if}-{$filter.field_type}{/if}">
				<span>{$filter.feature}{if $filter.feature_group} ({$filter.feature_group}){/if}</span>
			{/if}
		</div>

		<div class="form-field{if !$filter.slider} hidden{/if}" id="round_to_{$id}_container">
			<label for="round_to_{$id}">{$lang.round_to}:</label>
			<select name="filter_data[round_to]" id="round_to_{$id}">
				<option value="1"  {if $filter.round_to == 1}   selected="selected"{/if}>1</option>
				<option value="10" {if $filter.round_to == 10}  selected="selected"{/if}>10</option>
				<option value="100"{if $filter.round_to == 100} selected="selected"{/if}>100</option>
			</select>
		</div>

		<div class="form-field">
			<label for="display_{$id}">{$lang.display_type}:</label>
			<select name="filter_data[display]" id="display_{$id}">
				<option value="Y" {if $filter.display == 'Y'} selected="selected"{/if}>{$lang.expanded}</option>
				<option value="N" {if $filter.display == 'N'} selected="selected"{/if}>{$lang.minimized}</option>
			</select>
		</div>

		<div class="form-field {if !($filter.feature_id || $filter_fields[$filter.field_type].is_range)} hidden{/if}" id="display_count_{$id}_container">
			<label for="display_count_{$id}">{$lang.display_variants_count}:</label>
			<input type="text" id="display_count_{$id}" name="filter_data[display_count]" class="input-text-short" value="{$filter.display_count|default:"10"}" />
		</div>

		<div class="form-field {if !($filter.feature_id || $filter_fields[$filter.field_type].is_range)} hidden{/if}" id="display_more_count_{$id}_container">
			<label for="display_more_count_{$id}">{$lang.display_more_variants_count}:</label>
			<input type="text" id="display_more_count_{$id}" name="filter_data[display_more_count]" class="input-text-short" value="{$filter.display_more_count|default:"20"}" />
		</div>
	</fieldset>
	</div>

	<div class="hidden" id="content_tab_variants_{$id}">
		<table cellpadding="0" cellspacing="0" border="0" class="table">
		<tr>
			<th>{$lang.position_short}</th>
			<th>{$lang.name}</th>
			<th>{$lang.range_from}&nbsp;-&nbsp;{$lang.range_to}</th>
			<th>&nbsp;</th>
		</tr>
		{if $filter.ranges}
		{foreach from=$filter.ranges item="range" name="fe_f"}
		{assign var="num" value=$smarty.foreach.fe_f.iteration}
		<tr {cycle values="class=\"table-row\", " name="sub"} id="range_item_{$id}_{$range.range_id}">
			<td>
				<input type="hidden" name="filter_data[ranges][{$num}][range_id]" value="{$range.range_id}" />
				<input type="text" name="filter_data[ranges][{$num}][position]" size="3" value="{$range.position}" class="input-text-short" />
			</td>
			<td><input type="text" name="filter_data[ranges][{$num}][range_name]" value="{$range.range_name}" class="input-text" /></td>
			<td class="nowrap">
				{if $features[$filter.feature_id].prefix}{$features[$filter.feature_id].prefix}&nbsp;{/if}
				{if $filter.feature_type !== "D"}
					<input type="text" name="filter_data[ranges][{$num}][from]" size="3" value="{$range.from}" class="input-text-medium cm-value-decimal" />&nbsp;-&nbsp;<input type="text" name="filter_data[ranges][{$num}][to]" size="3" value="{$range.to}" class="input-text-medium cm-value-decimal" />
				{else}
					{include file="common_templates/calendar.tpl" date_id="date_1_`$id`_`$range.range_id`" date_name="filter_data[dates_ranges][`$num`][from]" date_val=$range.from|default:$smarty.const.TIME start_year=$settings.Company.company_start_year}&nbsp;-&nbsp;
					{include file="common_templates/calendar.tpl" date_id="date_2_`$id`_`$range.range_id`" date_name="filter_data[dates_ranges][`$num`][to]" date_val=$range.to|default:$smarty.const.TIME start_year=$settings.Company.company_start_year}
				{/if}
				{if $features[$filter.feature_id].suffix}&nbsp;{$features[$filter.feature_id].suffix}{/if}</td>
			<td class="right">
				{include file="buttons/multiple_buttons.tpl" item_id="range_item_`$id`_`$range.range_id`" tag_level="1" only_delete="Y"}
			</td>
		</tr>
		{/foreach}
		{/if}
		
		{math equation="x + 1" assign="num" x=$num|default:0}
		<tr id="box_add_to_range_{$id}">
			<td class="nowrap">
				<input type="text" name="filter_data[ranges][{$num}][position]" size="3" value="0" class="input-text-short" />
			</td>
			<td><input type="text" name="filter_data[ranges][{$num}][range_name]" class="input-text" /></td>
			<td class="nowrap">
				{if $mode == "add" || $filter.feature_type !== "D"}
				<div id="inputs_ranges{$id}">
					<input type="text" name="filter_data[ranges][{$num}][from]" value="" class="input-text-medium cm-value-decimal" />&nbsp;-&nbsp;<input type="text" name="filter_data[ranges][{$num}][to]" value="" class="input-text-medium cm-value-decimal" />
				</div>
				{/if}
				{if $mode == "add" || $filter.feature_type === "D"}
				<div id="dates_ranges{$id}">
					{include file="common_templates/calendar.tpl" date_id="date_3_`$id`" date_name="filter_data[dates_ranges][`$num`][from]" date_val=$smarty.const.TIME start_year=$settings.Company.company_start_year}&nbsp;-&nbsp;
					{include file="common_templates/calendar.tpl" date_id="date_4_`$id`" date_name="filter_data[dates_ranges][`$num`][to]" date_val=$smarty.const.TIME start_year=$settings.Company.company_start_year}
				</div>
				{/if}
			</td>
			<td>
				{include file="buttons/multiple_buttons.tpl" item_id="add_to_range_`$id`" tag_level="1"}</td>
		</tr>
		</table>
	</div>

	<div class="hidden" id="content_tab_categories_{$id}">
		{include file="pickers/categories_picker.tpl" company_ids=$picker_selected_companies multiple=true input_name="filter_data[categories_path]" item_ids=$filter.categories_path data_id="category_ids_`$id`" no_item_text=$lang.text_all_items_included|replace:"[items]":$lang.categories use_keys="N" owner_company_id=$filter.company_id}
	</div>
</div>

<div class="buttons-container">

	{include file="buttons/save_cancel.tpl" but_name="dispatch[product_filters.update]" cancel_action="close" hide_first_button=$hide_first_button}
</div>

</form>
<!--content_group{$id}--></div>

{if $mode == "add"}
<script type="text/javascript">
//<![CDATA[
	fn_check_product_filter_type($('#filter_by_{$id}').val(), 'tab_variants_{$id}', '{$id}');
//]]>
</script>
{/if}