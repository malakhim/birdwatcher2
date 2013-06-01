{if $page_data.page_id}
	{assign var="id" value=$page_data.page_id}
{else}
	{assign var="id" value=0}
{/if}


{capture name="mainbox"}

{capture name="tabsbox"}
{assign var="page_update_form_classes" value="cm-form-highlight"}

<div id="update_page_form_{$page_data.page_id}">
	<form action="{""|fn_url}" method="post" name="page_update_form" class="{$page_update_form_classes}">
	<input type="hidden" class="cm-no-hide-input" id="selected_section" name="selected_section" value="{$selected_section}"/>
	<input type="hidden" class="cm-no-hide-input" id="page_id" name="page_id" value="{$id}" />
	<input type="hidden" class="cm-no-hide-input" name="page_data[page_type]" id="page_type" size="55" value="{$page_type}" class="input-text" />
	<input type="hidden" class="cm-no-hide-input" name="come_from" value="{$come_from}" />
	<input type="hidden" class="cm-no-hide-input" name="result_ids" value="update_page_form_{$page_data.page_id}"/>

	<div id="content_basic">

	<fieldset>
		{include file="common_templates/subheader.tpl" title=$lang.information}

		{include file="views/pages/components/parent_page_selector.tpl"}

		<div class="form-field">
			<label for="page" class="cm-required">{$lang.name}:</label>
			<input type="text" name="page_data[page]" id="page" size="55" value="{$page_data.page}" class="input-text-large main-input" />
		</div>

		{if $page_data.parent_id != 0 && $page_data.page_id != 0}
			{assign var="disable_company_picker" value=true}
		{/if}
		{include file="views/companies/components/company_field.tpl" title=$lang.vendor name="page_data[company_id]" id="page_data_company_id" selected=$page_data.company_id reload_form=true disable_company_picker=$disable_company_picker}
		
		{hook name="pages:detailed_description"}

		{if $page_type != $smarty.const.PAGE_TYPE_LINK}
		<div class="form-field">
			<label for="page_descr">{$lang.description}:</label>
			<textarea id="page_descr" name="page_data[description]" cols="55" rows="8" class="cm-wysiwyg input-textarea-long">{$page_data.description}</textarea>
			
		</div>
		{/if}
		
		{if $page_type == $smarty.const.PAGE_TYPE_LINK}
			{include file="views/pages/components/pages_link.tpl"}
		{/if}

		{/hook}

		{include file="common_templates/select_status.tpl" input_name="page_data[status]" id="page_data" obj=$page_data hidden=true}

		<div class="form-field">
			<label for="show_in_popup">{$lang.show_page_in_popup}:</label>
			<input type="hidden" name="page_data[show_in_popup]" value="N" /><input type="checkbox" name="page_data[show_in_popup]" id="show_in_popup" {if $page_data.show_in_popup == "Y"}checked="checked"{/if} value="Y" class="checkbox"/>
		</div>

	</fieldset>

	{if $page_type != $smarty.const.PAGE_TYPE_LINK}
	<fieldset>
		{include file="common_templates/subheader.tpl" title=$lang.seo_meta_data}

		<div class="form-field">
			<label for="page_page_title">{$lang.page_title}:</label>
			<input type="text" name="page_data[page_title]" id="page_page_title" size="55" value="{$page_data.page_title}" class="input-text-large" />
		</div>

		<div class="form-field">
			<label for="page_meta_descr">{$lang.meta_description}:</label>
			<textarea name="page_data[meta_description]" id="page_meta_descr" cols="55" rows="2" class="input-textarea-long">{$page_data.meta_description}</textarea>
		</div>

		<div class="form-field">
			<label for="page_meta_keywords">{$lang.meta_keywords}:</label>
			<textarea name="page_data[meta_keywords]" id="page_meta_keywords" cols="55" rows="2" class="input-textarea-long">{$page_data.meta_keywords}</textarea>
		</div>

	</fieldset>
	{/if}

	<fieldset>
		{include file="common_templates/subheader.tpl" title=$lang.availability}
		
		<div class="form-field">
			<label>{$lang.usergroups}:</label>
				<div class="select-field">
					{include file="common_templates/select_usergroups.tpl" id="ug_id" name="page_data[usergroup_ids]" usergroups="C"|fn_get_usergroups:$smarty.const.DESCR_SL usergroup_ids=$page_data.usergroup_ids input_extra="" list_mode=false}
				</div>
		</div>
		
		<div class="form-field">
			<label for="page_date">{$lang.creation_date}:</label>
			{include file="common_templates/calendar.tpl" date_id="page_date" date_name="page_data[timestamp]" date_val=$page_data.timestamp|default:$smarty.const.TIME start_year=$settings.Company.company_start_year}
		</div>

		{include file="views/localizations/components/select.tpl" data_name="page_data[localization]" data_from=$page_data.localization}
		
		<div class="form-field">
			<label for="use_avail_period">{$lang.use_avail_period}:</label>
			<div class="select-field float-left nowrap">
				<input type="hidden" name="page_data[use_avail_period]" value="N" /><input type="checkbox" name="page_data[use_avail_period]" id="use_avail_period" {if $page_data.use_avail_period == "Y"}checked="checked"{/if} value="Y" class="checkbox" onclick="fn_activate_calendar(this);"/>
			</div>
		</div>
		
		{capture name="calendar_disable"}{if $page_data.use_avail_period != "Y"}disabled="disabled"{/if}{/capture}
		
		<div class="form-field">
			<label for="avail_from">{$lang.avail_from}:</label>
			{include file="common_templates/calendar.tpl" date_id="avail_from" date_name="page_data[avail_from_timestamp]" date_val=$page_data.avail_from_timestamp|default:$smarty.const.TIME start_year=$settings.Company.company_start_year extra=$smarty.capture.calendar_disable}
		</div>
		
		<div class="form-field">
			<label for="avail_till">{$lang.avail_till}:</label>
			{include file="common_templates/calendar.tpl" date_id="avail_till" date_name="page_data[avail_till_timestamp]" date_val=$page_data.avail_till_timestamp|default:$smarty.const.TIME start_year=$settings.Company.company_start_year extra=$smarty.capture.calendar_disable}
		</div>

	</fieldset>

	{literal}
	<script language="javascript">
	//<![CDATA[

	function fn_activate_calendar(el)
	{
		$('#avail_from').attr('disabled', !el.checked);
		$('#avail_till').attr('disabled', !el.checked);
	}
	//[[>
	</script>
	{/literal}

	</div>

	<div id="content_addons">
	{if $page_type != $smarty.const.PAGE_TYPE_LINK}
	{hook name="pages:detailed_content"}
	{/hook}
	{/if}
	</div>

	{hook name="pages:tabs_content"}
	{/hook}

	<div class="buttons-container cm-toggle-button buttons-bg">

		{include file="buttons/save_cancel.tpl" but_name="dispatch[pages.update]" hide_first_button=$hide_first_button hide_second_button=$hide_second_button}
	</div>

	</form>

	{hook name="pages:tabs_extra"}
	{/hook}
<!--update_page_form_{$page_data.page_id}--></div>
{/capture}
{include file="common_templates/tabsbox.tpl" content=$smarty.capture.tabsbox track=true}

{/capture}

{if !$id}
	{assign var="_title" value=$lang[$page_type_data.new_name]}
{else}
	{assign var="_title" value=$lang[$page_type_data.edit_name]|cat:":&nbsp;`$page_data.page`"}
	{assign var="select_languages" value=true}
	{if $page_type != $smarty.const.PAGE_TYPE_LINK}
		{capture name="preview"}
			
			{assign var="view_uri" value="pages.view?page_id=`$id`"}
			{assign var="view_uri_escaped" value="`$view_uri`&amp;action=preview"|fn_url:'C':'http':'&':$smarty.const.DESCR_SL|escape:"url"}
			
			

			{if PRODUCT_TYPE!='ULTIMATE' || "COMPANY_ID"|defined}
			<a target="_blank" class="tool-link" title="{$view_uri|fn_url:'C':'http':'&':$smarty.const.DESCR_SL}" href="{$view_uri|fn_url:'C':'http':'&':$smarty.const.DESCR_SL}">{$lang.preview}</a>
			<a target="_blank" class="tool-link" title="{$view_uri|fn_url:'C':'http':'&':$smarty.const.DESCR_SL}" href="{"profiles.act_as_user?user_id=`$auth.user_id`&amp;area=C&amp;redirect_url=`$view_uri_escaped`"|fn_url}">{$lang.preview_as_admin}</a>
			{/if}
		{/capture}
	{/if}
{/if}

{include file="common_templates/mainbox.tpl" title=$_title content=$smarty.capture.mainbox}