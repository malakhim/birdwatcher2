{if $lang_data.lang_code}
	{assign var="id" value=$lang_data.lang_code}
{else}
	{assign var="id" value="0"}
{/if}

<div id="content_group{$id}">

<form action="{""|fn_url}" method="post" name="add_language_form" class="{if !""|fn_allow_save_object:"languages"}cm-hide-inputs{/if}">
<input type="hidden" name="selected_section" value="languages" />
<input type="hidden" name="lang_code" value="{$id}" />

<div class="tabs cm-j-tabs">
	<ul>
		<li id="tab_general_{$id}" class="cm-js cm-active"><a>{$lang.general}</a></li>
	</ul>
</div>

<div class="cm-tabs-content" id="content_tab_general_{$id}">
<fieldset>
	<div class="form-field">
		<label for="elm_to_lang_code" class="cm-required">{$lang.language_code}:</label>
		<input id="elm_to_lang_code" type="text" name="language_data[lang_code]" value="{$lang_data.lang_code}" size="6" maxlength="2" class="input-text" />
	</div>

	<div class="form-field">
		<label for="elm_lang_name" class="cm-required">{$lang.name}:</label>
		<input id="elm_lang_name" type="text" name="language_data[name]" value="{$lang_data.name}" maxlength="64" class="input-text" />
	</div>

	{include file="common_templates/select_status.tpl" obj=$lang_data display="radio" input_name="language_data[status]" hidden=true}

	{if !$id}
	<div class="form-field">
		<label for="elm_from_lang_code" class="cm-required">{$lang.clone_from}:</label>
		<select name="language_data[from_lang_code]" id="elm_from_lang_code">
			{assign var="langiuages" value="true"|fn_get_simple_languages}
			{foreach from=$languages item="language"}
				<option value="{$language.lang_code}">{$language.name}</option>
			{/foreach}
		</select>
	</div>
	{/if}

</fieldset>
<!--content_group{$id}--></div>

{if ""|fn_allow_save_object:"languages"}
	<div class="buttons-container">
		{include file="buttons/save_cancel.tpl" but_name="dispatch[languages.update]" cancel_action="close"}
	</div>
{/if}

</form>

<!--content_group{$id}--></div>