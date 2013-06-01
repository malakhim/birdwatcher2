{if $category_data.category_id}
	{assign var="id" value=$category_data.category_id}
{else}
	{assign var="id" value=0}
{/if}

{capture name="mainbox"}

{capture name="tabsbox"}

<form action="{""|fn_url}" method="post" name="category_update_form" class="cm-form-highlight{if ""|fn_check_form_permissions} cm-hide-inputs{/if}" enctype="multipart/form-data">
<input type="hidden" name="fake" value="1" />
<input type="hidden" name="category_id" value="{$id}" />
<input type="hidden" name="selected_section" value="{$smarty.request.selected_section}" />

<div id="content_detailed">
	<fieldset>

	{include file="common_templates/subheader.tpl" title=$lang.information}

	<div class="form-field">
		<label for="category" class="cm-required">{$lang.name}:</label>
		<input type="text" name="category_data[category]" id="category" size="55" value="{$category_data.category}" class="input-text-large main-input" />
	</div>

	<div class="form-field">
		{if "categories"|fn_show_picker:$smarty.const.CATEGORY_THRESHOLD}
			<label class="cm-required" for="location_category_id">{$lang.location}:</label>
			{include file="pickers/categories_picker.tpl" data_id="location_category" input_name="category_data[parent_id]" item_ids=$category_data.parent_id|default:"0" hide_link=true hide_delete_button=true show_root=true default_name=$lang.root_level display_input_id="location_category_id" except_id=$id}
		{else}
			<label for="category_data_parent_id">{$lang.location}:</label>
			<select	name="category_data[parent_id]" id="category_data_parent_id">
				<option	value="0" {if $category_data.parent_id == "0"}selected="selected"{/if}>- {$lang.root_level} -</option>
				{foreach from=0|fn_get_plain_categories_tree:false item="cat" name="categories"}
				
					{if $cat.id_path|strpos:"`$category_data.id_path`/" === false && $cat.category_id != $id || !$id}
						<option	value="{$cat.category_id}" {if $cat.disabled}disabled="disabled"{/if} {if $category_data.parent_id == $cat.category_id}selected="selected"{/if}>{$cat.category|indent:$cat.level:"&#166;&nbsp;&nbsp;&nbsp;&nbsp;":"&#166;--&nbsp;"}</option>
					{/if}
				

				{/foreach}
			</select>
		{/if}
	</div>

	<div class="form-field">
		<label for="cat_descr">{$lang.description}:</label>
		<textarea id="cat_descr" name="category_data[description]" cols="55" rows="8" class="cm-wysiwyg input-textarea-long">{$category_data.description}</textarea>
		
	</div>

	{include file="common_templates/select_status.tpl" input_name="category_data[status]" id="category_data" obj=$category_data hidden=true}



	<div class="form-field">
		<label>{$lang.images}:</label>
		<div class="float-left">
			{include file="common_templates/attach_images.tpl" image_name="category_main" image_object_type="category" image_pair=$category_data.main_pair image_object_id=$id icon_text=$lang.text_category_icon detailed_text=$lang.text_category_detailed_image no_thumbnail=true}
		</div>
	</div>

	</fieldset>

	{include file="common_templates/subheader.tpl" title=$lang.seo_meta_data}

	<div class="form-field">
		<label for="page_title">{$lang.page_title}:</label>
		<input type="text" name="category_data[page_title]" id="page_title" size="55" value="{$category_data.page_title}" class="input-text-large" />
	</div>

	<div class="form-field">
		<label for="meta_description">{$lang.meta_description}:</label>
		<textarea name="category_data[meta_description]" id="meta_description" cols="55" rows="4" class="input-textarea-long">{$category_data.meta_description}</textarea>
	</div>

	<div class="form-field">
		<label for="meta_keywords">{$lang.meta_keywords}:</label>
		<textarea name="category_data[meta_keywords]" id="meta_keywords" cols="55" rows="4" class="input-textarea-long">{$category_data.meta_keywords}</textarea>
	</div>
	
	{include file="common_templates/subheader.tpl" title=$lang.availability}
	<div class="form-field">
		<label>{$lang.usergroups}:</label>
			<div class="select-field">
				{include file="common_templates/select_usergroups.tpl" id="ug_id" name="category_data[usergroup_ids]" usergroups="C"|fn_get_usergroups:$smarty.const.DESCR_SL usergroup_ids=$category_data.usergroup_ids input_extra="" list_mode=false}
				<p><label for="usergroup_to_subcats">{$lang.to_all_subcats}</label>
				<input id="usergroup_to_subcats" type="checkbox" name="category_data[usergroup_to_subcats]" value="Y" /></p>
			</div>
	</div>
	

	<div class="form-field">
		<label for="category_position">{$lang.position}:</label>
		<input type="text" name="category_data[position]" id="category_position" size="10" value="{$category_data.position}" class="input-text-short" />
	</div>

	<div class="form-field">
		<label>{$lang.creation_date}:</label>
		{include file="common_templates/calendar.tpl" date_id="category_date" date_name="category_data[timestamp]" date_val=$category_data.timestamp|default:$smarty.const.TIME start_year=$settings.Company.company_start_year}
	</div>

	{include file="views/localizations/components/select.tpl" data_from=$category_data.localization data_name="category_data[localization]"}
	
	</fieldset>
</div>

<div id="content_layout">
	<fieldset>
	
	<div class="form-field">
		<label for="category_default_layout">{$lang.product_details_layout}:</label>
		<select id="category_default_layout" name="category_data[product_details_layout]">
			{foreach from="category"|fn_get_product_details_views key="layout" item="item"}
				<option {if $category_data.product_details_layout == $layout}selected="selected"{/if} value="{$layout}">{$item}</option>
			{/foreach}
		</select>
	</div>
		
	<div class="form-field">
		<label for="use_custom_templates">{$lang.use_custom_layout}:</label>
		<input type="hidden" value="N" name="category_data[use_custom_templates]"/>
		<input type="checkbox" class="checkbox cm-toggle-checkbox" value="Y" name="category_data[use_custom_templates]" id="use_custom_templates"{if $category_data.selected_layouts} checked="checked"{/if} />
	</div>
	
	<div class="form-field">
		<label for="category_product_columns">{$lang.product_columns}:</label>
		<input type="text" name="category_data[product_columns]" id="category_product_columns" size="10" value="{$category_data.product_columns}" class="input-text-short cm-toggle-element" {if !$category_data.selected_layouts}disabled="disabled"{/if} />
	</div>

	{assign var="layouts" value=""|fn_get_products_views:false:false}
	<div class="form-field">
		<label for="available_layouts">{$lang.available_layouts}:</label>
		<div class="table-filters">
			<div class="scroll-y">
				{foreach from=$layouts key="layout" item="item"}
					<div class="select-field"><input type="checkbox" class="checkbox cm-combo-checkbox cm-toggle-element" name="category_data[selected_layouts][{$layout}]" id="layout_{$layout}" value="{$layout}" {if ($category_data.selected_layouts.$layout) || (!$category_data.selected_layouts && $item.active)}checked="checked"{/if} {if !$category_data.selected_layouts}disabled="disabled"{/if} /><label for="layout_{$layout}">{$item.title}</label></div>
				{/foreach}
			</div>
		</div>
	</div>
	
	<div class="form-field">
		<label for="category_default_layout">{$lang.default_category_layout}:</label>
		<select id="category_default_layout" class="cm-combo-select cm-toggle-element" name="category_data[default_layout]" {if !$category_data.selected_layouts}disabled="disabled"{/if}>
			{foreach from=$layouts key="layout" item="item"}
				{if ($category_data.selected_layouts.$layout) || (!$category_data.selected_layouts && $item.active)}
					<option {if $category_data.default_layout == $layout}selected="selected"{/if} value="{$layout}">{$item.title}</option>
				{/if}
			{/foreach}
		</select>
	</div>
	
	</fieldset>
</div>

<div id="content_addons">
{hook name="categories:detailed_content"}
{/hook}
</div>

{hook name="categories:tabs_content"}
{/hook}

<div class="buttons-container cm-toggle-button buttons-bg">
	{include file="buttons/save_cancel.tpl" but_name="dispatch[categories.update]"}
</div>

</form>

{if $id}
	{hook name="categories:tabs_extra"}
	{/hook}
{/if}

{/capture}
{include file="common_templates/tabsbox.tpl" content=$smarty.capture.tabsbox group_name=$controller active_tab=$smarty.request.selected_section track=true}

{/capture}

{if !$id}
	{include file="common_templates/mainbox.tpl" title=$lang.new_category content=$smarty.capture.mainbox}
{else}
	{capture name="preview"}
		
		{assign var="view_uri" value="categories.view?category_id=`$id`"}
		{assign var="view_uri_escaped" value="$view_uri`&amp;action=preview"|fn_url:'C':'http':'&':$smarty.const.DESCR_SL|escape:"url"}
		
		

		
		<a target="_blank" class="tool-link" title="{$view_uri|fn_url:'C':'http':'&':$smarty.const.DESCR_SL}" href="{$view_uri|fn_url:'C':'http':'&':$smarty.const.DESCR_SL}">{$lang.preview}</a>
		<a target="_blank" class="tool-link" title="{$view_uri|fn_url:'C':'http':'&':$smarty.const.DESCR_SL}" href="{"profiles.act_as_user?user_id=`$auth.user_id`&amp;area=C&amp;redirect_url=`$view_uri_escaped`"|fn_url}">{$lang.preview_as_admin}</a>
	{/capture}
	{include file="common_templates/mainbox.tpl" title="`$lang.editing_category`:&nbsp;`$category_data.category`" content=$smarty.capture.mainbox select_languages=true}
{/if}