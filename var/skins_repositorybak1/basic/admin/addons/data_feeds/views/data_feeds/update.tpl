{if $datafeed_data.datafeed_id}
	{assign var="id" value=$datafeed_data.datafeed_id}
{else}
	{assign var="id" value=0}
{/if}

{capture name="mainbox"}

{capture name="tabsbox"}
{** /Item menu section **}
{assign var="date" value=$smarty.const.TIME|date_format:"%m%d%Y"}

<form action="{""|fn_url}" method="post" name="feed_update_form" class="cm-form-highlight" enctype="multipart/form-data"> {* feed update form *}
<input type="hidden" name="fake" value="1" />
<input type="hidden" name="selected_section" id="selected_section" value="{$smarty.request.selected_section}" />
<input type="hidden" name="datafeed_id" value="{$id}" />

{** Datafeed description section **}

<div id="content_detailed"> {* content detailed *}
<fieldset>

{include file="common_templates/subheader.tpl" title=$lang.general_settings}

<div class="form-field">
	<label for="datafeed_name" class="cm-required">{$lang.datafeed_name}:</label>
	<input type="text" name="datafeed_data[datafeed_name]" id="datafeed_name" size="55" value="{$datafeed_data.datafeed_name}" class="input-text-large main-input" />
</div>

<div class="form-field">
	<label for="datafeed_file_name" class="cm-required">{$lang.filename}:</label>
	<input type="text" name="datafeed_data[file_name]" id="datafeed_file_name" size="55" value="{$datafeed_data.file_name|default:"datafeed_`$date`.csv"}" class="input-text-large" />
</div>

<div class="form-field">
	<label for="datafeed_enclosure" class="">{$lang.enclosure}:</label>
	<input type="text" name="datafeed_data[enclosure]" id="datafeed_enclosure" size="55" value="{$datafeed_data.enclosure}" class="input-text-large" />
</div>

{if $pattern.options}
{foreach from=$pattern.options key=k item=o}
{if !$o.import_only}
<div class="form-field">
	<label for="{$p_id}_{$k}">{$lang[$o.title]}:</label>
	{if $o.type == "checkbox"}
		<input type="hidden" name="datafeed_data[export_options][{$k}]" value="N" />
		<input id="{$p_id}_{$k}" class="checkbox" type="checkbox" name="datafeed_data[export_options][{$k}]" value="Y" {if $datafeed_data.export_options.$k == "Y"}checked="checked"{/if} />
	{elseif $o.type == "input"}
		<input id="{$p_id}_{$k}" class="input-text-large" type="text" name="datafeed_data[export_options][{$k}]" value="{$datafeed_data.export_options.$k|default:$o.default_value}" />
	{elseif $o.type == "languages"}
		<select id="{$p_id}_{$k}" name="datafeed_data[export_options][{$k}]">
		{foreach from=$languages item=language}
			<option value="{$language.lang_code}" {if $language.lang_code == $datafeed_data.export_options.$k}selected="selected"{/if}>{$language.name}</option>
		{/foreach}
		</select>
	{elseif $o.type == "select"}
		<select id="{$p_id}_{$k}" name="datafeed_data[export_options][{$k}]">
		{if $o.variants_function}
			{foreach from=$o.variants_function|call_user_func key=vk item=vi}
			<option value="{$vk}" {if $vk == $datafeed_data.export_options.$k|default:$o.default_value}checked="checked"{/if}>{$vi}</option>
			{/foreach}
		{else}
			{foreach from=$o.variants key=vk item=vi}
			<option value="{$vk}" {if $vk == $datafeed_data.export_options.$k|default:$o.default_value}checked="checked"{/if}>{$lang.$vi}</option>
			{/foreach}
		{/if}
		</select>
	{/if}
	{if $o.description}<p class="description">{$lang[$o.description]}</p>{/if}
</div>
{/if}
{/foreach}
{/if}

<div class="form-field">
	<label for="datafeed_csv_delimiter">{$lang.csv_delimiter}:</label>
	{include file="views/exim/components/csv_delimiters.tpl" name="datafeed_data[csv_delimiter]" value=$datafeed_data.csv_delimiter id="datafeed_csv_delimiter"}
</div>

<div class="form-field">
	<label for="exclude_disabled_products" class="">{$lang.exclude_disabled_products}:</label>
	<input type="hidden" name="datafeed_data[exclude_disabled_products]" value="N" />
	<input type="checkbox" name="datafeed_data[exclude_disabled_products]" id="exclude_disabled_products" value="Y" class="checkbox" {if $datafeed_data.exclude_disabled_products == "Y"}checked="checked"{/if} />
</div>

{include file="common_templates/select_status.tpl" input_name="datafeed_data[status]" id="datafeed_data" obj=$datafeed_data hidden=false}

{include file="common_templates/subheader.tpl" title=$lang.export_to_server}

<div class="form-field">
	<label for="datafeed_save_directory" id="label_save_directory">{$lang.save_directory}:</label>
	<input type="text" name="datafeed_data[save_dir]" id="datafeed_save_directory" size="55" value="{$datafeed_data.save_dir|default:$smarty.const.DIR_EXIM}" class="input-text-large" />
</div>

{include file="common_templates/subheader.tpl" title=$lang.export_to_ftp}

<div class="form-field">
	<label for="datafeed_ftp_url" id="label_ftp_url">{$lang.ftp_url}:</label>
	<input type="text" name="datafeed_data[ftp_url]" id="datafeed_ftp_url" size="55" value="{$datafeed_data.ftp_url}" class="input-text-large" />
	<p class="description">{$lang.ftp_url_hint}</p>
</div>

<div class="form-field">
	<label for="datafeed_ftp_user" id="label_ftp_user">{$lang.ftp_user}:</label>
	<input type="text" name="datafeed_data[ftp_user]" id="datafeed_ftp_user" size="20" value="{$datafeed_data.ftp_user}" class="input-text-medium" />
</div>

<div class="form-field">
	<label for="datafeed_ftp_pass" id="label_ftp_pass">{$lang.ftp_pass}:</label>
	<input type="password" name="datafeed_data[ftp_pass]" id="datafeed_ftp_pass" size="20" value="{$datafeed_data.ftp_pass}" class="input-text-medium" />
</div>

{include file="common_templates/subheader.tpl" title=$lang.cron_export}

<div class="form-field">
	<label for="datafeed_export_file_location">{$lang.export_by_cron_to}:</label>
	<select name="datafeed_data[export_location]" id="datafeed_export_file_location">
		<option value=""> -- </option>
		<option value="S" {if $datafeed_data.export_location == "S"}selected="selected"{/if}>{$lang.server}</option>
		<option value="F" {if $datafeed_data.export_location == "F"}selected="selected"{/if}>{$lang.ftp}</option>
	</select>
	
	<p class="description">{$lang.export_cron_hint}:<br />
		<span>php /path/to/cart/{""|fn_get_index_script} --dispatch=exim.cron_export --cron_password={$addons.data_feeds.cron_password}</span>
	</p>
</div>

</fieldset>

</div> {* /content detailed *}

<div id="content_exported_items" class="hidden"> {* content products *}
	{include file="common_templates/subheader.tpl" title=$lang.categories_products}
	
	{include file="pickers/categories_picker.tpl" input_name="datafeed_data[categories]" item_ids=$datafeed_data.categories multiple=true single_line=true use_keys="N"}

	{include file="common_templates/subheader.tpl" title=$lang.products}

	{include file="pickers/products_picker.tpl" input_name="datafeed_data[products]" data_id="added_products" item_ids=$datafeed_data.products type="links"}
</div> {* /content products *}

<div id="content_fields" class="hidden"> {* content fields *}
	{include file="addons/data_feeds/views/data_feeds/components/datafeed_fields.tpl"}
</div> {* /content fields *}

<div class="buttons-container cm-toggle-button buttons-bg">
	{include file="buttons/save_cancel.tpl" but_name="dispatch[data_feeds.update]"}
</div>

</form>

{/capture}
{include file="common_templates/tabsbox.tpl" content=$smarty.capture.tabsbox group_name=$controller active_tab=$smarty.request.selected_section track=true}

{/capture}
{if !$id}
	{include file="common_templates/mainbox.tpl" title=$lang.add_new_datafeed content=$smarty.capture.mainbox}
{else}
	{include file="common_templates/mainbox.tpl" title="`$lang.update_datafeed`:&nbsp;`$datafeed_data.datafeed_name`"|unescape content=$smarty.capture.mainbox select_languages=true}
{/if}