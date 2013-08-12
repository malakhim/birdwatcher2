{include file="common_templates/pagination.tpl" div_id="content_tab_variants_`$id`"}
	{if $feature_variants|is_array}
		{assign var="variants_ids" value=$feature_variants|array_keys}
	{/if}
	<input type="hidden" value="{if $variants_ids}{","|implode:$variants_ids}{/if}" name="feature_data[original_var_ids]">
	<table cellpadding="0" cellspacing="0" border="0" class="table" width="100%">
	<tbody>
	<tr class="cm-first-sibling">
		<th>{$lang.position_short}</th>
		<th>{$lang.variant}</th>
		{if $feature_type == "E"}
		<th class="cm-extended-feature"><img src="{$images_dir}/plus_minus.gif" width="13" height="12" border="0" name="plus_minus" id="on_st_{$id}" alt="{$lang.expand_collapse_list}" title="{$lang.expand_collapse_list}" class="hand cm-combinations-features-{$id}" /><img src="{$images_dir}/minus_plus.gif" width="13" height="12" border="0" name="minus_plus" id="off_st_{$id}" alt="{$lang.expand_collapse_list}" title="{$lang.expand_collapse_list}" class="hand hidden cm-combinations-features-{$id}" /></th>
		{/if}
		<th>&nbsp;</th>
	</tr>
	</tbody>
	{foreach from=$feature_variants item="var" name="fe_f"}
	{assign var="num" value=$smarty.foreach.fe_f.iteration}
	<tbody class="hover" id="box_feature_variants_{$var.variant_id}">
	<tr class="cm-first-sibling {cycle values="table-row, "}">
		<td>
			<input type="hidden" name="feature_data[variants][{$num}][variant_id]" value="{$var.variant_id}">
			<input type="text" name="feature_data[variants][{$num}][position]" value="{$var.position}" size="4" class="input-text-short" /></td>
		<td>
			<input type="text" name="feature_data[variants][{$num}][variant]" value="{$var.variant}" class="input-text-large cm-feature-value {if $feature_type == "N"}cm-value-decimal{/if}" /></td>
		{if $feature_type == "E"}
		<td class="cm-extended-feature">
			<img src="{$images_dir}/plus.gif" width="14" height="9" border="0" name="plus_minus" id="on_extra_feature_{$id}_{$num}" alt="{$lang.expand_collapse_list}" title="{$lang.expand_collapse_list}" class="hand cm-combination-features-{$id}" /><img src="{$images_dir}/minus.gif" width="14" height="9" border="0" name="minus_plus" id="off_extra_feature_{$id}_{$num}" alt="{$lang.expand_collapse_list}" title="{$lang.expand_collapse_list}" class="hand hidden cm-combination-features-{$id}" /><a id="sw_extra_feature_{$id}_{$num}" class="cm-combination-features-{$id}">{$lang.extra}</a>
		</td>
		{/if}
		<td class="right nowrap">
			{include file="buttons/multiple_buttons.tpl" item_id="feature_variants_`$var.variant_id`" tag_level="3" only_delete="Y"}
		</td>
	</tr>
	{if $feature_type == "E"}
	<tr class="hidden" id="extra_feature_{$id}_{$num}">
		<td colspan="4">

			<div class="form-field">
				<label for="elm_image_{$id}_{$num}">{$lang.image}</label>
				{include file="common_templates/attach_images.tpl" image_name="variant_image" image_key=$num hide_titles=true no_detailed=true image_object_type="feature_variant" image_type="V" image_pair=$var.image_pair prefix=$id}
			</div>

			<div class="form-field">
				<label for="elm_description_{$id}_{$num}">{$lang.description}</label>
				<!--processForm-->
				<textarea id="elm_description_{$id}_{$num}" name="feature_data[variants][{$num}][description]" cols="55" rows="8" class="cm-wysiwyg input-textarea-long">{$var.description}</textarea>
			</div>

			<div class="form-field">
				<label for="elm_page_title_{$id}_{$num}">{$lang.page_title}:</label>
				<input type="text" name="feature_data[variants][{$num}][page_title]" id="elm_page_title_{$id}_{$num}" size="55" value="{$var.page_title}" class="input-text-large" />
			</div>

			<div class="form-field">
				<label for="elm_url_{$id}_{$num}">{$lang.url}:</label>
				<input type="text" name="feature_data[variants][{$num}][url]" id="elm_url_{$id}_{$num}" size="55" value="{$var.url}" class="input-text-large" />
			</div>

			<div class="form-field">
				<label for="elm_meta_description_{$id}_{$num}">{$lang.meta_description}:</label>
				<textarea name="feature_data[variants][{$num}][meta_description]" id="elm_meta_description_{$id}_{$num}" cols="55" rows="2" class="input-textarea-long">{$var.meta_description}</textarea>
			</div>

			<div class="form-field">
				<label for="elm_meta_keywords_{$id}_{$num}">{$lang.meta_keywords}:</label>
				<textarea name="feature_data[variants][{$num}][meta_keywords]" id="elm_meta_keywords_{$id}_{$num}" cols="55" rows="2" class="input-textarea-long">{$var.meta_keywords}</textarea>
			</div>

			{hook name="product_features:extended_feature"}{/hook}
		</td>
	</tr>
	{/if}
	</tbody>
	{/foreach}

	{math equation="x + 1" assign="num" x=$num|default:0}
	<tbody class="hover" id="box_add_variants_for_existing_{$id}">
	<tr>
		<td>
			<input type="text" name="feature_data[variants][{$num}][position]" value="" size="4" class="input-text-short" /></td>
		<td>
			<input type="text" name="feature_data[variants][{$num}][variant]" value="" class="input-text-large cm-feature-value {if $feature_type == "N"}cm-value-decimal{/if}" /></td>
		{if $feature_type == "E"}
		<td class="cm-extended-feature">
			<img src="{$images_dir}/plus.gif" width="14" height="9" border="0" name="plus_minus" id="on_extra_feature_{$id}_{$num}" alt="{$lang.expand_collapse_list}" title="{$lang.expand_collapse_list}" class="hand cm-combination-features-{$id}" /><img src="{$images_dir}/minus.gif" width="14" height="9" border="0" name="minus_plus" id="off_extra_feature_{$id}_{$num}" alt="{$lang.expand_collapse_list}" title="{$lang.expand_collapse_list}" class="hand hidden cm-combination-features-{$id}" /><a id="sw_extra_feature_{$id}_{$num}" class="cm-combination-features-{$id}">{$lang.extra}</a>
		</td>
		{/if}
		<td class="right">
			{include file="buttons/multiple_buttons.tpl" item_id="add_variants_for_existing_`$id`" tag_level=2}</td>
	</tr>
	<tr class="hidden" id="extra_feature_{$id}_{$num}">
		<td colspan="4">

			<div class="form-field">
				<label for="elm_image_{$id}_{$num}">{$lang.image}</label>
				{include file="common_templates/attach_images.tpl" image_name="variant_image" image_key=$num hide_titles=true no_detailed=true image_object_type="feature_variant" image_type="V" image_pair="" prefix=$id}
			</div>

			<div class="form-field">
				<label for="elm_description_{$id}_{$num}">{$lang.description}</label>
				<textarea id="elm_description_{$id}_{$num}" name="feature_data[variants][{$num}][description]" cols="55" rows="8" class="cm-wysiwyg input-textarea-long"></textarea>
				
			</div>

			<div class="form-field">
				<label for="elm_page_title_{$id}_{$num}">{$lang.page_title}:</label>
				<input type="text" name="feature_data[variants][{$num}][page_title]" id="elm_page_title_{$id}_{$num}" size="55" value="" class="input-text-large" />
			</div>

			<div class="form-field">
				<label for="elm_url_{$id}_{$num}">{$lang.url}:</label>
				<input type="text" name="feature_data[variants][{$num}][url]" id="elm_url_{$id}_{$num}" size="55" value="" class="input-text-large" />
			</div>

			<div class="form-field">
				<label for="elm_meta_description_{$id}_{$num}">{$lang.meta_description}:</label>
				<textarea name="feature_data[variants][{$num}][meta_description]" id="elm_meta_description_{$id}_{$num}" cols="55" rows="2" class="input-textarea-long"></textarea>
			</div>

			<div class="form-field">
				<label for="elm_meta_keywords_{$id}_{$num}">{$lang.meta_keywords}:</label>
				<textarea name="feature_data[variants][{$num}][meta_keywords]" id="elm_meta_keywords_{$id}_{$num}" cols="55" rows="2" class="input-textarea-long"></textarea>
			</div>
			{assign var="empty_string" value="true"}
			{hook name="product_features:extended_feature"}{/hook}
		</td>
	</tr>
	</tbody>
	</table>
{include file="common_templates/pagination.tpl" div_id="content_tab_variants_`$id`"}
