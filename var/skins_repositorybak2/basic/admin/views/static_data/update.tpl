{if $mode == "add"}
	{assign var="id" value="0"}
{else}
	{assign var="id" value=$static_data.param_id}
{/if}

<div id="content_group{$id}">

<form action="{""|fn_url}" method="post" name="static_data_form_{$id}" enctype="multipart/form-data" class="cm-form-highlight">
<input name="section" type="hidden" value="{$section}" />
<input name="param_id" type="hidden" value="{$id}" />

<div class="tabs cm-j-tabs">
	<ul>
		<li id="tab_general_{$id}" class="cm-js cm-active"><a>{$lang.general}</a></li>
	</ul>
</div>

<div class="cm-tabs-content" id="content_tab_general_{$id}">
<fieldset>

	{if $section_data.owner_object}
		{assign var="param_name" value=$section_data.owner_object.param}
		{assign var="request_key" value=$section_data.owner_object.key}	
		{assign var="value" value=$smarty.request.$request_key}

		{*if $static_data[$param_name]}
			{assign var="value" value=$static_data[$param_name]}		
		{/if*}
		
		<input type="hidden" name="static_data[{$param_name}]" value="{$value}" class="input-text-large" />
		<input type="hidden" name="{$request_key}" value="{$value}" class="input-text-large" />
	{/if}

	{if $section_data.multi_level}
	<div class="form-field">
		<label for="parent_{$id}" class="cm-required">{$lang.parent_item}:</label>
		<select id="parent_{$id}" name="static_data[parent_id]">
		<option	value="0">- {$lang.root_level} -</option>
		{foreach from=$parent_items item="i"}
			{if	($i.id_path|strpos:"`$static_data.id_path`/" === false || $static_data.id_path == "") && $i.param_id != $static_data.param_id || $mode == "add"}
				<option	value="{$i.param_id}" {if $static_data.parent_id == $i.param_id}selected="selected"{/if}>{$i.descr|indent:$i.level:"&#166;&nbsp;&nbsp;&nbsp;&nbsp;":"&#166;--&nbsp;"}</option>
			{/if}
		{/foreach}
		</select>
	</div>
	{/if}

	<div class="form-field">
		<label for="descr_{$id}" class="cm-required">{$lang[$section_data.descr]}:</label>
		<input type="text" size="40" id="descr_{$id}" name="static_data[descr]" value="{$static_data.descr}" class="input-text-large main-input" />
	</div>
	{if $section_data.multi_level}
	<div class="form-field">
		<label for="position_{$id}">{$lang.position_short}:</label>
		<input type="text" size="2" id="position_{$id}" name="static_data[position]" value="{$static_data.position}" class="input-text-short" />
	</div>
	{/if}
	<div class="form-field">
		<label for="param_{$id}">{$lang[$section_data.param]}{if $section_data.tooltip}{include file="common_templates/tooltip.tpl" tooltip=$lang[$section_data.tooltip]}{/if}:</label>
		<input type="text" size="40" id="param_{$id}" name="static_data[param]" value="{$static_data.param}" class="input-text-large" />
	</div>

	{if $section_data.icon}
	<div class="form-field">
		<label>{$lang[$section_data.icon.title]}:</label>
		{include file="common_templates/attach_images.tpl" image_name="static_data_icon" image_object_type="static_data_`$section`" image_pair=$static_data.icon no_detailed="Y" hide_titles="Y" image_key=$id image_object_id=$id}
	</div>
	{/if}

	{if $section_data.additional_params}
	{foreach from=$section_data.additional_params key="k" item="p"}
		{if $p.type == "hidden"}	
			<input type="hidden" id="param_{$k}_{$id}" name="static_data[{$p.name}]" value="{$static_data[$p.name]}" class="input-text-large" />
		{else}
			<div class="form-field">
				<label for="param_{$k}_{$id}">{$lang[$p.title]}{if $p.tooltip}{include file="common_templates/tooltip.tpl" tooltip=$lang[$p.tooltip]}{/if}:</label>
				{if $p.type == "checkbox"}
					<input type="hidden" name="static_data[{$p.name}]" value="N" />
					<input type="checkbox" id="param_{$k}_{$id}" name="static_data[{$p.name}]" value="Y" {if $static_data[$p.name] == "Y"}checked="checked"{/if} class="checkbox" />
				{elseif $p.type == "megabox"}
					{assign var="_megabox_values" value=$static_data[$p.name]|fn_static_data_megabox}

					<div class="clear select-field">
						<input type="radio" name="static_data[megabox][type][{$p.name}]" id="rb_{$id}" {if !$_megabox_values}checked="checked"{/if} value="" onclick="$('#un_{$id}').attr('disabled', true);" /><label for="rb_{$id}">{$lang.none}</label>
					</div>
					
					<div class="clear select-field">
						<div class="float-left"><input type="radio" name="static_data[megabox][type][{$p.name}]" id="rb_c_{$id}" {if $_megabox_values.types.C}checked="checked"{/if} value="C" onclick="$('#un_{$id}').attr('disabled', false);" /><label for="rb_c_{$id}">{$lang.category}:</label></div><div id="megabox_container_c_{$id}" class="float-left">{include file="pickers/categories_picker.tpl" data_id="megabox_category_`$id`" input_name="static_data[`$p.name`][C]" item_ids=$_megabox_values.types.C.value hide_link=true hide_delete_button=true show_root=true default_name=$lang.all_categories extra=""}</div>
					</div>

					<div class="clear select-field">
						<div class="float-left"><input type="radio" name="static_data[megabox][type][{$p.name}]" id="rb_a_{$id}" {if $_megabox_values.types.A}checked="checked"{/if} value="A" onclick="$('#un_{$id}').attr('disabled', false);" /><label for="rb_a_{$id}">{$lang.page}:</label></div><div id="megabox_container_a_{$id}" class="float-left">{include file="pickers/pages_picker.tpl" data_id="megabox_page_`$id`" input_name="static_data[`$p.name`][A]" item_ids=$_megabox_values.types.A.value hide_link=true hide_delete_button=true show_root=true default_name=$lang.all_pages extra=""}</div>
					</div>

					<div class="clear select-field">
						<input type="hidden" name="static_data[megabox][use_item][{$p.name}]" value="N" />
						<input type="checkbox" name="static_data[megabox][use_item][{$p.name}]" id="un_{$id}" {if $_megabox_values.use_item == "Y"}checked="checked"{/if} value="Y" /><label for="un_{$id}">{$lang.static_data_use_item}</label>
					</div>

				{elseif $p.type == "select"}
					<select id="param_{$k}_{$id}" name="static_data[{$p.name}]">
					{foreach from=$p.values key="vk" item="vv"}
					<option	value="{$vk}" {if $static_data[$p.name] == $vk}selected="selected"{/if}>{$lang.$vv}</option>
					{/foreach}
					</select>
				{elseif $p.type == "input"}
					<input type="text" id="param_{$k}_{$id}" name="static_data[{$p.name}]" value="{$static_data[$p.name]}" class="input-text-large" />
				{/if}
			</div>		
		{/if}
	{/foreach}
	{/if}

	{if $section_data.has_localization}
		{include file="views/localizations/components/select.tpl" data_name="static_data[localization]" data_from=$static_data.localization}
	{/if}
</fieldset>
<!--content_tab_general_{$id}--></div>

{if ""|fn_allow_save_object:"static_data":$section_data.skip_edition_checking}
	<div class="buttons-container">
		{include file="buttons/save_cancel.tpl" but_name="dispatch[static_data.update]" cancel_action="close"}
	</div>
{/if}

</form>
<!--content_group{$id}--></div>