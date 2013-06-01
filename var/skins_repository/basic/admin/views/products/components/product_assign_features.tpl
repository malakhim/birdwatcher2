{foreach from=$product_features item=feature key="feature_id"}
	{if $feature.feature_type != "G"}
		<div class="form-field">
			<label for="feature_{$feature_id}">{$feature.description}:</label>
			<div class="select-field">
			<span>{$feature.prefix}</span>
			{if $feature.feature_type == "S" || $feature.feature_type == "N" || $feature.feature_type == "E"}
				{assign var="value_selected" value=false}
				{if $feature.use_variant_picker}
					<input type="hidden" name="product_data[product_features][{$feature_id}]" id="feature_{$feature_id}" value="{$selected|default:$feature.variant_id}" />
					{if $feature.variants[$feature.variant_id].variant}
						{assign var="selected_variant" value=$feature.variants[$feature.variant_id].variant}
					{elseif $feature.variant_id}
						{assign var="selected_variant" value=$feature.variant_id|fn_get_product_feature_variant}
						{assign var="selected_variant" value=$selected_variant.variant}
					{else}
						{assign var="selected_variant" value=$lang.none}
					{/if}
					{include file="common_templates/ajax_select_object.tpl" data_url="product_features.get_feature_variants_list&feature_id=`$feature_id`" text=$selected_variant result_elm="feature_`$feature_id`" id="`$feature_id`_selector" js_action="$('#input_`$feature_id`').toggleBy(($('#feature_`$feature_id`').val() != 'disable_select'));"}
					<input type="text" class="input-text input-empty hidden{if $feature.feature_type == "N"} cm-value-decimal{/if}" name="product_data[add_new_variant][{$feature.feature_id}][variant]" id="input_{$feature_id}" />					
				{else}
					<select name="product_data[product_features][{$feature_id}]" id="feature_{$feature_id}" onchange="$('#input_{$feature_id}').toggleBy((this.value != 'disable_select'));">
						<option value="">-{$lang.none}-</option>
						{foreach from=$feature.variants item="var"}
						<option value="{$var.variant_id}" {if $var.variant_id == $feature.variant_id}{assign var="value_selected" value=true}selected="selected"{/if}>{$var.variant}</option>
						{/foreach}
						{if !"COMPANY_ID"|defined}
						<option value="disable_select">-{$lang.enter_other}-</option>
						{/if}
					</select>
					<input type="text" class="input-text input-empty hidden{if $feature.feature_type == "N"} cm-value-decimal{/if}" name="product_data[add_new_variant][{$feature.feature_id}][variant]" id="input_{$feature_id}" />
				{/if}
			{elseif $feature.feature_type == "M"}
				<div class="select-field">
					<input type="hidden" name="product_data[product_features][{$feature_id}]" value="" />
					{foreach from=$feature.variants item="var"}
						<p><label class="label-html-checkboxes" for="variant_{$var.variant_id}"><input type="checkbox" class="html-checkboxes" id="variant_{$var.variant_id}" name="product_data[product_features][{$feature_id}][{$var.variant_id}]" {if $var.selected}checked="checked"{/if} value="{$var.variant_id}" />{$var.variant}</label></p>
					{/foreach}
					{if !"COMPANY_ID"|defined}
					<p><label for="input_{$feature_id}">{$lang.enter_other}:</label>&nbsp;
					<input type="text" class="input-text" name="product_data[add_new_variant][{$feature.feature_id}][variant]" id="feature_{$feature_id}" />
					</p>
					{/if}
				</div>
			{elseif $feature.feature_type == "C"}
				<input type="hidden" name="product_data[product_features][{$feature_id}]" value="N" />
				<input type="checkbox" name="product_data[product_features][{$feature_id}]" value="Y" id="feature_{$feature_id}" class="checkbox" {if $feature.value == "Y"}checked="checked"{/if} />

			{elseif $feature.feature_type == "D"}
				{include file="common_templates/calendar.tpl" date_id="date_`$feature_id`" date_name="product_data[product_features][$feature_id]" date_val=$feature.value_int|default:"" start_year=$settings.Company.company_start_year}

			{else}
				<input type="text" name="product_data[product_features][{$feature_id}]" value="{if $feature.feature_type == "O"}{if $feature.value_int != ""}{$feature.value_int|floatval}{/if}{else}{$feature.value}{/if}" id="feature_{$feature_id}" class="input-text{if $feature.feature_type == "O"} cm-value-decimal{/if}" />
			{/if}
			<span>{$feature.suffix}</span>
			</div>
		</div>
	{/if}
{/foreach}

{foreach from=$product_features item=feature key="feature_id"}
	{if $feature.feature_type == "G" && $feature.subfeatures}
		{include file="common_templates/subheader.tpl" title=$feature.description}
		{include file="views/products/components/product_assign_features.tpl" product_features=$feature.subfeatures}
	{/if}
{/foreach}