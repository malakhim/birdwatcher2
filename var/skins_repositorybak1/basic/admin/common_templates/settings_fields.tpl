{if $item.update_for_all && $settings.Stores.default_state_update_for_all == 'not_active'}
	{assign var="disable_input" value=true}
{/if}

{* Settings without label*}
{if $item.type == "O"}
	<div>{$item.info|unescape}</div>
{elseif $item.type == "E"}
	<div>{include file="addons/`$smarty.request.addon`/settings/`$item.value`"}</div>
{elseif $item.type == "Z"}
	<div>{include file="addons/`$smarty.request.addon`/settings/`$item.value`" skip_addon_check=true}</div>
{elseif $item.type == "H"}
	{include file="common_templates/subheader.tpl" title=$item.description}
{elseif $item.type != "D"}
	{* Settings with label*}
	<div class="form-field">
		<label for="{$html_id}" class="left description {if $highlight && $item.name|in_array:$highlight}highlight{/if} {if $item.type == "X"}cm-country cm-location-billing{elseif $item.type == "W"}cm-state cm-location-billing{/if}" >{$item.description|unescape}{if $item.tooltip}{capture name="tooltip"}{$item.tooltip}{/capture}{include file="common_templates/tooltip.tpl" tooltip=$smarty.capture.tooltip}{/if}:
		</label>
		{if $item.type == "P"}
			<input id="{$html_id}" type="password" name="{$html_name}" size="30" value="{$item.value}" class="input-text" {if $disable_input}disabled="disabled"{/if} />
		{elseif $item.type == "T"}
			<textarea id="{$html_id}" name="{$html_name}" rows="5" cols="19" class="input-text" {if $disable_input}disabled="disabled"{/if}>{$item.value}</textarea>
		{elseif $item.type == "C"}
			<input type="hidden" name="{$html_name}" value="N" {if $disable_input}disabled="disabled"{/if} />
			<input id="{$html_id}" type="checkbox" name="{$html_name}" value="Y" {if $item.value == "Y"}checked="checked"{/if} class="checkbox" {if $disable_input}disabled="disabled"{/if} />
		{elseif $item.type == "S"}
			<select id="{$html_id}" name="{$html_name}" {if $disable_input}disabled="disabled"{/if}>
				{foreach from=$item.variants item=v key=k}
					<option value="{$k}" {if $item.value == $k}selected="selected"{/if}>{$v}</option>
				{/foreach}
			</select>
		{elseif $item.type == "R"}
			<div class="select-field" id="{$html_id}">
			{foreach from=$item.variants item=v key=k}
			<input type="radio" name="{$html_name}" value="{$k}" {if $item.value == $k}checked="checked"{/if} class="radio" id="variant_{$item.description|md5}_{$k|md5}" {if $disable_input}disabled="disabled"{/if} />&nbsp;<label for="variant_{$item.description|md5}_{$k|md5}">{$v}</label>
			{/foreach}
			</div>
		{elseif $item.type == "M"}
			<select id="{$html_id}" name="{$html_name}[]" multiple="multiple" {if $disable_input}disabled="disabled"{/if}>
			{foreach from=$item.variants item=v key="k"}
			<option value="{$k}" {if $item.value.$k == "Y"}selected="selected"{/if}>{$v}</option>
			{/foreach}
			</select>
			{$lang.multiple_selectbox_notice}
		{elseif $item.type == "N"}
			<div class="select-field" id="{$html_id}">
				<input type="hidden" name="{$html_name}" value="N" {if $disable_input}disabled="disabled"{/if} />
			{foreach from=$item.variants item=v key="k"}
				<input type="checkbox" name="{$html_name}[]" id="variant_{$item.description|md5}_{$k|md5}" value="{$k}" {if $item.value.$k == "Y"}checked="checked"{/if} {if $disable_input}disabled="disabled"{/if} />&nbsp;<label for="variant_{$item.description|md5}_{$k|md5}">{$v}</label>
			{/foreach}
			</div>
		{elseif $item.type == "X"}
			<select id="{$html_id}" name="{$html_name}" {if $disable_input}disabled="disabled"{/if}>
				<option value="">- {$lang.select_country} -</option>
				{assign var="countries" value=""|fn_get_simple_countries}
				{foreach from=$countries item=country key=ccode}
					<option value="{$ccode}" {if $ccode == $item.value}selected="selected"{/if}>{$country|escape}</option>
				{/foreach}
			</select>
		{elseif $item.type == "W"}
			<input type="text" id="{$html_id}_d" name="{$html_name}" value="{$item.value}" size="32" maxlength="64" disabled="disabled" class="hidden input-text" {if $disable_input}disabled="disabled"{/if} />
			<select id="{$html_id}" name="{$html_name}" {if $disable_input}disabled="disabled"{/if}>
				<option value="">- {$lang.select_state} -</option>
			</select>
			<input type="hidden" id="{$html_id}_default" value="{$item.value}" />
		{elseif $item.type == "F"}
			<input id="file_{$html_id}" type="text" name="{$html_name}" value="{$item.value}" size="30" class="valign input-text" {if $disable_input}disabled="disabled"{/if} />&nbsp;<input id="{$html_id}" type="button" value="{$lang.browse}" class="valign input-text" onclick="fileuploader.init('box_server_upload', this.id);" {if $disable_input}disabled="disabled"{/if} />
		{elseif $item.type == "G"}
			<div class="table-filters" id="{$html_id}">
				<div class="scroll-y">
					{foreach from=$item.variants item=v key="k"}
						<div class="select-field"><input type="checkbox" class="checkbox cm-combo-checkbox" id="option_{$k}" name="{$html_name}[]" value="{$k}" {if $item.value.$k == "Y"}checked="checked"{/if} {if $disable_input}disabled="disabled"{/if} /><label for="option_{$k}">{$v}</label></div>
					{/foreach}
				</div>
			</div>
		{elseif $item.type == "K"}
			<select id="{$html_id}" name="{$html_name}" class="cm-combo-select" {if $disable_input}disabled="disabled"{/if}>
				{foreach from=$item.variants item=v key=k}
					<option value="{$k}" {if $item.value == $k}selected="selected"{/if}>{$v}</option>
				{/foreach}
			</select>
		{elseif $item.type == "B"}
			{include file="common_templates/selectable_box.tpl" addon=$section name=$html_name id=$html_id fields=$item.variants selected_fields=$item.value}
		{else}
			<input id="{$html_id}" type="text" name="{$html_name}" size="30" value="{$item.value}" class="input-text{if $item.type == "U"} cm-value-integer{/if}" {if $disable_input}disabled="disabled"{/if} />
		{/if}
		<div class="right update-for-all">
			{include file="buttons/update_for_all.tpl" display=$item.update_for_all object_id=$item.object_id name="update_all_vendors[`$item.object_id`]" hide_element=$html_id}
		</div>
	</div>
{/if}