{if "COMPANY_ID"|defined && $news_data.news && $news_data.company_id != $smarty.const.COMPANY_ID}
	{assign var="hide_fields" value=true}
{/if}

{capture name="mainbox"}

{capture name="tabsbox"}

<form action="{""|fn_url}" method="post" name="news_update_form" class="cm-form-highlight{if $hide_fields} cm-hide-inputs{/if}">
<input type="hidden" class="cm-no-hide-input" name="fake" value="1" />
<input type="hidden" class="cm-no-hide-input" name="news_id" value="{$smarty.request.news_id}" />
<input type="hidden" class="cm-no-hide-input" name="selected_section" value="{$smarty.request.selected_section|default:"detailed"}" />

<div id="content_detailed">
<fieldset>
	<div class="form-field">
		<label for="news" class="cm-required">{$lang.name}:</label>
		<input type="text" name="news_data[news]" id="news" value="{$news_data.news}" size="40" class="input-text main-input" />
	</div>

	{include file="views/companies/components/company_field.tpl" title=$lang.vendor name="news_data[company_id]" id="news_data_company_id" selected=$news_data.company_id}

	<div class="form-field">
		<label for="news_description">{$lang.description}:</label>
		<textarea id="news_description" name="news_data[description]" cols="35" rows="8" class="cm-wysiwyg input-textarea-long">{$news_data.description}</textarea>
		
	</div>

	<div class="form-field">
		<label for="news_date">{$lang.date}:</label>
		{include file="common_templates/calendar.tpl" date_id="news_date" date_name="news_data[date]" date_val=$news_data.date start_year=$settings.Company.company_start_year}
	</div>

	<div class="form-field">
		<label for="news_separate">{$lang.show_on_separate_page}:</label>
		<input type="hidden" name="news_data[separate]" value="N" />
		<input type="checkbox" name="news_data[separate]" id="news_separate" value="Y" {if $news_data.separate == "Y"}checked="checked"{/if} class="checkbox" />
	</div>

	{include file="views/localizations/components/select.tpl" data_from=$news_data.localization data_name="news_data[localization]"}

	{hook name="news_and_emails:detailed_content"}
	{/hook}

	{include file="common_templates/select_status.tpl" input_name="news_data[status]" id="news" obj_id=$news_data.news_id obj=$news_data}
</fieldset>
</div>

<div id="content_addons">
{hook name="news:detailed_content"}
{/hook}
</div>

{hook name="news_and_emails:tabs_content"}
{/hook}

<div class="buttons-container cm-toggle-button buttons-bg ">	
	{if $mode == "add"}
		{include file="buttons/save_cancel.tpl" but_name="dispatch[news.update]"}
	{else}
		
		{if !$news_data|fn_allow_save_object:"news"}
			{assign var="hide_first_button" value=true}
			{assign var="hide_second_button" value=true}
		{/if}
		
		{include file="buttons/save_cancel.tpl" but_name="dispatch[news.update]" hide_first_button=$hide_first_button hide_second_button=$hide_second_button}
	{/if}
</div>

</form>

{if $mode == "update"}
{hook name="news_and_emails:tabs_extra"}
{/hook}
{/if}

{/capture}
{include file="common_templates/tabsbox.tpl" content=$smarty.capture.tabsbox track=true}

{/capture}

{if $mode == "update"}
	{assign var="title" value="`$lang.editing_news`:&nbsp;`$news_data.news`"}
{else}
	{assign var="title" value=$lang.new_news}
{/if}

{include file="common_templates/mainbox.tpl" title=$title content=$smarty.capture.mainbox select_languages=true}
