{assign var="id" value=$block.block_id|default:"0"}
{assign var="snapping_id" value=$snapping_data.snapping_id|default:"0"}
{assign var="html_id" value="`$id`_`$snapping_id`_`$block.type`"}

{if $id == 0}
	{assign var="add_block" value=true}
	{assign var="hide_status" value=true}
{/if}

{if $smarty.request.active_tab}
	{assign var="active_tab" value=$smarty.request.active_tab}
{else}
	{assign var="active_tab" value='block_general'}
{/if}

{script src="js/tabs.js"}

{if $smarty.request.dynamic_object.object_id > 0}
	{assign var="dynamic_object" value=$smarty.request.dynamic_object}
{/if}

{capture name="block_content"}{strip}
	{if $block_scheme.content}
		{include file="views/block_manager/components/block_content.tpl" content_type=$block.properties.content_type block_scheme=$block_scheme block=$block editable=$editable_content tab_id="`$html_id`"}
	{/if}
{/strip}{/capture}

<form action="{""|fn_url}" method="post" class="cm-skip-check-items {if $dynamic_object}cm-hide-inputs{/if} cm-form-highlight {if $smarty.request.ajax_update}cm-ajax{/if}" name="block_{$id}_update_form">
<div id="block_properties_{$html_id}">
	{if $smarty.request.dynamic_object.object_id > 0}
		<input type="hidden" name="dynamic_object[object_id]" value="{$smarty.request.dynamic_object.object_id}" class="cm-no-hide-input"/>	
		<input type="hidden" name="dynamic_object[object_type]" value="{$smarty.request.dynamic_object.object_type}" class="cm-no-hide-input"/>	
	{/if}
	<input type="hidden" name="block_data[type]" value="{$block.type}" class="cm-no-hide-input"/>
	<input type="hidden" name="block_data[block_id]" value="{$id}" class="cm-no-hide-input"/>
	<input type="hidden" name="block_data[content_data][snapping_id]" value="{$snapping_data.snapping_id}" class="cm-no-hide-input"/>	
	<input type="hidden" name="snapping_data[snapping_id]" value="{$snapping_data.snapping_id}" class="cm-no-hide-input"/>
	<input type="hidden" name="snapping_data[grid_id]" value="{$snapping_data.grid_id}" class="cm-no-hide-input"/>
	<input type="hidden" name="selected_location" value="{$smarty.request.selected_location|default:0}" class="cm-no-hide-input" />
	{if $smarty.request.assign_to}
		<input type="hidden" name="assign_to" value="{$smarty.request.assign_to}" class="cm-no-hide-input"/>
	{/if}
	<input type="hidden" name="result_ids" value="block_properties_{$html_id}" class="cm-no-hide-input"/>

	
	{* Redirect to product tabs *}
	{if $smarty.request.r_url}
		<input type="hidden" name="r_url" value="{$smarty.request.r_url}" class="cm-no-hide-input"/>
	{/if}
	<div class="tabs cm-j-tabs cm-track">
		<ul>
			<li id="block_general_{$html_id}" class="cm-js{if $active_tab == "block_general_`$html_id`"} cm-active{/if}"><a>{$lang.general}</a></li>
			{if $smarty.capture.block_content}<li id="block_contents_{$html_id}" class="cm-js{if $active_tab == "block_contents_`$html_id`"} cm-active{/if}"><a>{$lang.content}</a></li>{/if}
			{if $block_scheme.settings}
				<li id="block_settings_{$html_id}" class="cm-js{if $active_tab == "block_settings_`$html_id`"} cm-active{/if}"><a>{$lang.block_settings}</a></li>
			{/if}
			{if $dynamic_object_scheme && !$hide_status}
				<li id="block_status_{$html_id}" class="cm-js{if $active_tab == "block_status_`$html_id`"} cm-active{/if}"><a>{$lang.status}</a></li>
			{/if}
		</ul>
	</div>

	<div class="cm-tabs-content" id="tabs_content_block_{$html_id}">
		<div id="content_block_general_{$html_id}">
			<fieldset>
				<div class="form-field {if $editable_template_name}cm-no-hide-input{/if}">
					<label for="block_{$html_id}_name" class="cm-required">{$lang.name}:</label>
					{if $smarty.request.html_id && $id > 0}
						{$block.name}
					{else}
						<input type="text" name="block_data[description][name]" id="block_{$html_id}_name" size="25" value="{$block.name}" class="input-text main-input" />
					{/if}
				</div>
				{if $block_scheme.templates}
					<div class="form-field {if $editable_template_name}cm-no-hide-input{/if}">
						<label for="block_{$html_id}_template">{$lang.template}:</label>
						{if $block_scheme.templates|is_array}
							<select id="block_{$html_id}_template" name="block_data[properties][template]"  class="cm-reload-form">
								{foreach from=$block_scheme.templates item=v key=k}
									<option value="{$k}" {if $block.properties.template == $k}selected="selected"{/if}>{if $v.name}{$v.name}{else}{$k}{/if}</option>
								{/foreach}
							</select>
						{/if}
						{if $dynamic_object}
							<input type="hidden" name="block_data[properties][template]" value="{$block.properties.template}" class="cm-no-hide-input" />
						{/if}
						{if $block_scheme.templates[$block.properties.template].settings|is_array}
							<a href="#" id="sw_case_settings_{$html_id}" class="cm-combo-off cm-combination" onclick="return false">
								{$lang.settings}
								<span class="combo-arrow"></span>
							</a>
						{/if}
					</div>
				{/if}
				
				{if $block_scheme.templates[$block.properties.template].settings|is_array}		
					<div id="case_settings_{$html_id}" class="hidden">
					{foreach from=$block_scheme.templates[$block.properties.template].settings item=setting_data key=name}
						{include file="views/block_manager/components/setting_element.tpl" option=$setting_data name=`$name` block=$block html_id="block_`$html_id`_properties_`$name`" html_name="block_data[properties][`$name`]" editable=$editable_template_name value=$block.properties.$name}
					{/foreach}
					</div>
				{/if}
				{if $editable_wrapper}
					<div class="form-field">
						<label for="block_{$html_id}_wrapper">{$lang.wrapper}:</label>
						<select name="snapping_data[wrapper]" id="block_{$html_id}_wrapper">
							<option value="">--</option>
							{foreach from=$block_scheme.wrappers item=w key=k}							
								<option value="{$k}" {if $block.wrapper == $k}selected="selected"{/if}>{$w.name}</option>
							{/foreach}
						</select>
					</div>
					<div class="form-field">
						<label for="block_{$html_id}_user_class">{$lang.user_class}:</label>
						<input type="text" name="snapping_data[user_class]" id="block_{$html_id}_user_class" size="25" value="{$block.user_class}" class="input-text main-input" />
					</div>
				{/if}			
				{hook name="block_manager:settings"}
				{/hook}
			</fieldset>
		</div>
		{if $smarty.capture.block_content}
			<div id="content_block_contents_{$html_id}" >
				<fieldset>
				{if $dynamic_object.object_id > 0}
					<input type="hidden" name="block_data[content_data][object_id]" value="{$dynamic_object.object_id}" class="cm-no-hide-input" />
					<input type="hidden" name="block_data[content_data][object_type]" value="{$dynamic_object.object_type}" class="cm-no-hide-input" />
				{/if}
				{if $block.object_id > 0}
					<div class="text-tip">				
						{assign var="url" value="`$dynamic_object_scheme.customer_dispatch`&`$dynamic_object_scheme.key`=`$dynamic_object.object_id`"|fn_url:'C':'http':'&':$smarty.const.DESCR_SL}
						{'[url]'|str_replace:$url:$lang.dynamic_content}
					</div>
				{/if}

				{$smarty.capture.block_content}

				{capture name="content_stat"}{strip}
					{foreach from=$changed_content_stat item=stat}
						{if $stat.object_type != ''}
							<div>
								{include file="common_templates/popupbox.tpl"
									id="show_objects_`$block.block_id`_`$stat.object_type`"
									text=$lang[$stat.object_type]
									link_text="`$stat.contents_count`"
									act="link"
									href="block_manager.show_objects?object_type=`$stat.object_type`&block_id=`$block.block_id`"
									opener_ajax_class="cm-ajax"
									link_class="cm-ajax-force"
									content=""
								} {$stat.object_type}
							</div>
						{/if}
					{/foreach}
				{/strip}{/capture}

				{if $smarty.capture.content_stat}
				<div class="form-field">
					<label for="block_{$html_id}_override_by_this">{$lang.override_by_this}:</label>
					<input type="hidden" class="cm-no-hide-input" name="block_data[content_data][override_by_this]" value="N" />
					<input id="block_{$html_id}_override_by_this" type="checkbox" class="checkbox cm-no-hide-input" name="block_data[content_data][override_by_this]" value="Y" />
				</div>
				<div class="statistics-box">
					<div class="statistics-body">
						<p class="strong">{$lang.content_changed_for}:</p>
						{$smarty.capture.content_stat}
					</div>
				</div>
				{/if}
				</fieldset>
			</div>
		{/if}
		{if $block_scheme.settings}
			<div id="content_block_settings_{$html_id}" >
				<fieldset>
					{foreach from=$block_scheme.settings item=setting_data key=name}
						{include file="views/block_manager/components/setting_element.tpl" option=$setting_data name=`$name` block=$block html_id="block_`$html_id`_properties_`$name`" html_name="block_data[properties][`$name`]" editable=$editable_template_name value=$block.properties.$name}
					{/foreach}
				</fieldset>
			</div>
		{/if}
		{if $dynamic_object_scheme && !$hide_status}
		<div id="content_block_status_{$html_id}" >
			<fieldset>
				<div class="form-field">
					<label>{$lang.global_status}:</label>
					<div class="select-field">
						{if $block.status == 'A'}{$lang.active}{else}{$lang.disabled}{/if}
					</div>
				</div>
				<input type="hidden" class="cm-no-hide-input" name="snapping_data[object_type]" value="{$dynamic_object_scheme.object_type}" />
				<div class="form-field cm-no-hide-input">						
					<label>{if $block.status == 'A'}{$lang.disable_for}{else}{$lang.enable_for}{/if}:</label>
					{include
						file=$dynamic_object_scheme.picker 
						data_id="block_`$html_id`_object_ids_d"
						input_name="snapping_data[object_ids]"
						item_ids=$block.object_ids
						view_mode="links"
						params_array=$dynamic_object_scheme.picker_params
						start_pos=$start_position
					}
				</div>
			</fieldset>
		</div>
		{/if}
	</div>
	<!--block_properties_{$html_id}--></div>
	<div class="buttons-container">
		{if $add_block}
			{include file="buttons/save_cancel.tpl" create=true but_name="dispatch[block_manager.update_block]" cancel_action="close"}
		{elseif $smarty.request.force_close}
			{include file="buttons/save_cancel.tpl" but_name="dispatch[block_manager.update_block]" cancel_action="close" but_meta="cm-submit-closer"}
		{else}
			{include file="buttons/save_cancel.tpl" but_name="dispatch[block_manager.update_block]" cancel_action="close"}
		{/if}
	</div>
</form>
