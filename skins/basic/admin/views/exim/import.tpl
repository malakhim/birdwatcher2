{capture name="mainbox"}

{capture name="tabsbox"}

{assign var="p_id" value=$pattern.pattern_id}
<div id="content_{$p_id}">
	{*Notes for tab*}
	{*include file="common_templates/help.tpl" content="" id=""*}

	{if $pattern.notes}
		{capture name="local_notes"}
			{foreach from=$pattern.notes item=note}
				{eval var=$lang.$note}
				<hr />
			{/foreach}
		{/capture}
	{/if}
	
	{include file="common_templates/subheader.tpl" title=$pattern.name notes=$smarty.capture.local_notes notes_id=$p_id}

	<p class="p-notice">{$lang.text_exim_import_notice}</p>
	{split data=$pattern.export_fields size=3 assign="splitted_fields" simple=true}
	<div class="clear block-inside-list">
		{foreach from=$splitted_fields item="fields"}
			<ul class="float-left inside-list">
				{foreach from=$fields key="field" item="f"}
					<li {if $f.required}class="strong"{/if}>{$field}</li>
				{/foreach}
			</ul>
		{/foreach}
	</div>

	{include file="common_templates/subheader.tpl" title=$lang.import_options}
	<form action="{""|fn_url}" method="post" name="{$p_id}_import_form" enctype="multipart/form-data" class="cm-ajax cm-comet">
	<input type="hidden" name="section" value="{$pattern.section}" />
	<input type="hidden" name="pattern_id" value="{$p_id}" />
	<input type="hidden" name="result_ids" value="content_{$p_id}" />

	{if $pattern.options}
	{foreach from=$pattern.options key=k item=o}
	<div class="form-field">
		<label for="{$k}">{$lang[$o.title]}:</label>
		{if $o.type == "checkbox"}
			<input type="hidden" name="import_options[{$k}]" value="N" />
			<input id="{$k}" class="checkbox" type="checkbox" name="import_options[{$k}]" value="Y" {if $o.default_value == "Y"}checked="checked"{/if} />
		{elseif $o.type == "input"}
			<input id="{$k}" class="input-text-large" type="text" name="import_options[{$k}]" value="{$o.default_value}" />
		{elseif $o.type == "languages"}
			<select name="import_options[{$k}]" id="{$k}">
				{foreach from=$languages item=language}
					<option value="{$language.lang_code}" {if $language.lang_code == $smarty.const.CART_LANGUAGE}selected="selected"{/if}>{$language.name}</option>
				{/foreach}
			</select>
		{elseif $o.type == "select"}
			<select name="import_options[{$k}]" id="{$k}">
				{foreach from=$o.variants key=vk item=vi}
					<option value="{$vk}" {if $vk == $o.default_value}checked="checked"{/if}>{$lang.$vi}</option>
				{/foreach}
			</select>
		{/if}
		{if $o.description}
			<p class="description">{$lang[$o.description]}</p>
		{/if}
	</div>
	{/foreach}
	{/if}

	<div class="form-field">
		<label>{$lang.csv_delimiter}:</label>
		{include file="views/exim/components/csv_delimiters.tpl" name="import_options[delimiter]"}
	</div>

	<div class="form-field">
		<label>{$lang.select_file}:</label>
		{include file="common_templates/fileuploader.tpl" var_name="csv_file[0]" prefix=$p_id}
	</div>

	<div class="buttons-container buttons-bg">
	{include file="buttons/button.tpl" but_text=$lang.import but_name="dispatch[exim.import]" but_role="button_main"}
	</div>
	</form>
<!--content_{$p_id}--></div>

{/capture}
{include file="common_templates/tabsbox.tpl" content=$smarty.capture.tabsbox active_tab=$p_id}

{/capture}
{include file="common_templates/mainbox.tpl" title=$lang.import_data content=$smarty.capture.mainbox}