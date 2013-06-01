{if $mode == "add"}
	{if $is_group == true}
		{assign var="id" value=$smarty.const.NEW_FEATURE_GROUP_ID}
	{else}
		{assign var="id" value=0}
	{/if}
{else}
	{assign var="id" value=$feature.feature_id}
{/if}

<div id="content_group{$id}">

<form action="{""|fn_url}" method="post" name="update_features_form_{$id}" class="cm-form-highlight cm-disable-empty-files{if ""|fn_check_form_permissions || ($smarty.const.PRODUCT_TYPE == "ULTIMATE" && "COMPANY_ID"|defined && $feature.company_id != $smarty.const.COMPANY_ID && $mode != "add")} cm-hide-inputs{/if}" enctype="multipart/form-data">

<input type="hidden" class="cm-no-hide-input" name="redirect_url" value="{$smarty.request.return_url}" />
<input type="hidden" class="cm-no-hide-input" name="feature_id" value="{$id}" />

<div class="tabs cm-j-tabs">
	<ul>
		<li id="tab_details_{$id}" class="cm-js cm-active"><a>{$lang.general}</a></li>
		<li id="tab_variants_{$id}" class="cm-js cm-ajax {if $feature.feature_type && "SMNE"|strpos:$feature.feature_type === false || !$feature}hidden{/if}"><a href="{"product_features.get_variants?feature_id=`$id`&amp;feature_type=`$feature.feature_type`"|fn_url}">{$lang.variants}</a></li>
		<li id="tab_categories_{$id}" class="cm-js {if $feature.parent_id} hidden{/if}"><a>{$lang.categories}</a></li>
	</ul>
</div>

<div class="cm-tabs-content" id="tabs_content_{$id}">
	
	<div id="content_tab_details_{$id}">
	<fieldset>
		<div class="form-field">
			<label class="cm-required" for="feature_name_{$id}">{$lang.name}:</label>
			<input type="text" name="feature_data[description]" value="{$feature.description}" class="input-text-large main-input" id="feature_name_{$id}" />
		</div>
		


		<div class="form-field">
			<label for="feature_position_{$id}">{$lang.position}:</label>
			<input type="text" size="3" name="feature_data[position]" value="{$feature.position}" class="input-text-short" id="feature_position_{$id}" />
		</div>

		<div class="form-field">
			<label for="feature_description_{$id}">{$lang.description}:</label>
			<textarea name="feature_data[full_description]" cols="55" rows="4" class="cm-wysiwyg input-textarea-long" id="feature_description_{$id}">{$feature.full_description}</textarea>
			
		</div>

		{if $is_group || $feature.feature_type == "G"}
			<input type="hidden" name="feature_data[feature_type]" value="G" />
		{else}
		<div class="form-field">
			<label for="feature_type_{$id}" class="cm-required">{$lang.type}:</label>
			{if $feature.feature_type == "G"}{$lang.group}{else}
				<select name="feature_data[feature_type]" id="feature_type_{$id}"  onchange="fn_check_product_feature_type(this.value, '{$id}');">
					<optgroup label="{$lang.checkbox}">
						<option value="C" {if $feature.feature_type == "C"}selected="selected"{/if}>{$lang.single}</option>
						<option value="M" {if $feature.feature_type == "M"}selected="selected"{/if}>{$lang.multiple}</option>
					</optgroup>
					<optgroup label="{$lang.selectbox}">
						<option value="S" {if $feature.feature_type == "S"}selected="selected"{/if}>{$lang.text}</option>
						<option value="N" {if $feature.feature_type == "N"}selected="selected"{/if}>{$lang.number}</option>
						<option value="E" {if $feature.feature_type == "E"}selected="selected"{/if}>{$lang.extended}</option>
					</optgroup>
					<optgroup label="{$lang.others}">
						<option value="T" {if $feature.feature_type == "T"}selected="selected"{/if}>{$lang.text}</option>
						<option value="O" {if $feature.feature_type == "O"}selected="selected"{/if}>{$lang.number}</option>
						<option value="D" {if $feature.feature_type == "D"}selected="selected"{/if}>{$lang.date}</option>
					</optgroup>
				</select>
				<div class="error-message feature_type_{$id}" style="display: none" id="warning_feature_change_{$id}"><div class="arrow"></div><div class="message"><p>{$lang.warning_variants_removal}</p></div></div>
			{/if}
		</div>
			<div class="form-field">
			<label for="feature_group_{$id}">{$lang.group}:</label>
			{if $feature.feature_type == "G"}-{else}
				<select name="feature_data[parent_id]" id="feature_group_{$id}" onchange="$('#tab_categories_{$id}').toggleBy(this.value != 0); $('#feature_display_on_product_{$id}, #feature_catalog_pages_{$id}').attr('disabled', this.value != 0 ? 'disabled' : '');">
					<option value="0">-{$lang.none}-</option>
					{foreach from=$group_features item="group_feature"}
						{if $group_feature.feature_type == "G"}
							<option value="{$group_feature.feature_id}"{if $group_feature.feature_id == $feature.parent_id}selected="selected"{/if}>{$group_feature.description}</option>
						{/if}
					{/foreach}
				</select>
			{/if}
		</div>
		{/if}

		<div class="form-field">
			<label for="feature_display_on_product_{$id}">{$lang.product}:</label>
			<input type="hidden" name="feature_data[display_on_product]" value="0" />
			<input type="checkbox" class="checkbox" name="feature_data[display_on_product]" value="1" {if $feature.display_on_product}checked="checked"{/if} id="feature_display_on_product_{$id}" {if $feature.parent_id}disabled="disabled"{/if} />
		</div>

		<div class="form-field">
			<label for="feature_catalog_pages_{$id}">{$lang.catalog_pages}:</label>
			<input type="hidden" name="feature_data[display_on_catalog]" value="0" />
			<input type="checkbox" class="checkbox" name="feature_data[display_on_catalog]" value="1" {if $feature.display_on_catalog}checked="checked"{/if} id="feature_catalog_pages_{$id}" {if $feature.parent_id}disabled="disabled"{/if}/>
		</div>

		{if (!$feature && !$is_group) || ($feature.feature_type && $feature.feature_type != "G")}
		<div class="form-field">
			<label for="feature_prefix_{$id}">{$lang.prefix}:</label>
			<input type="text" name="feature_data[prefix]" value="{$feature.prefix}" class="input-text-medium" id="feature_prefix_{$id}" />
		</div>

		<div class="form-field">
			<label for="feature_suffix_{$id}">{$lang.suffix}:</label>
			<input type="text" name="feature_data[suffix]" value="{$feature.suffix}" class="input-text-medium" id="feature_suffix_{$id}" />
		</div>
		{/if}
		
		{hook name="product_features:properties"}
		{/hook}
	</fieldset>
	<!--content_tab_details_{$id}--></div>
	{if $mode != "add"}
		{include file="views/product_features/components/variants_list.tpl"}
	{/if}
	{if !$feature.parent_id}
	<div class="hidden" id="content_tab_categories_{$id}">
	{if $feature.categories_path}
		{assign var="items" value=","|explode:$feature.categories_path}
	{/if}
	{include file="pickers/categories_picker.tpl" company_ids=$picker_selected_companies multiple=true input_name="feature_data[categories_path]" item_ids=$items data_id="category_ids_`$id`" no_item_text=$lang.text_all_items_included|replace:"[items]":$lang.categories use_keys="N" owner_company_id=$feature.company_id}

	<!--content_tab_categories_{$id}--></div>
	{/if}

</div>

<div class="buttons-container">

	{include file="buttons/save_cancel.tpl" but_name="dispatch[product_features.update]" cancel_action="close" hide_first_button=$hide_first_button}
</div>


</form>

<!--content_group{$id}--></div>
