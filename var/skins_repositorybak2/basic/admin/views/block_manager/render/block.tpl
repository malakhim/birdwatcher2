{if $block_data}
	{strip}
		{if $block_data.status}
			{assign var="status" value=$block_data.status}
		{else}
			{assign var="status" value="A"}
		{/if}
			
		{if !$dynamic_object && $block_data.items_count > 0}
			{capture name="confirm_message"}
				{if $status == 'A'}
					{assign var="action" value=$lang.disable|lower}
				{else}
					{assign var="action" value=$lang.enable|lower}
				{/if}
				{assign var="message_with_action" value="[action]"|str_replace:$action:$lang.bm_confirm}

				<span class="confirm-message hidden">{"[location_name]"|str_replace:$location.name:$message_with_action}</span>
			{/capture}
		{/if}
		<div class="{$default_class|default:"block"} {if $status != "A"}block-off{/if} {if $parent_grid.content_align == 'RIGHT'}float-right{elseif $parent_grid.content_align == 'LEFT'}float-left{/if}{if $external_render} bm-external-render{/if}" id="snapping_{$block_data.snapping_id}{if $external_render}{$block_data.block_id}_{$external_id}{/if}">
			<div class="block-header" title="{$block_data.name}">
				<div class="block-header-icon block-header-icon-{$block_data.type|replace:"_":"-"}" {if $parent_grid.width == 1}hidden{/if}></div>
				<div class="block-header-holder"></div>
				<h4 class="block-header-title {if $show_for_location && $block_data.location != $show_for_location}fixed-block{/if} {if $parent_grid.width == 1}hidden{/if}">
					{$block_data.name}
				</h4>
			</div>
			
			<div class="bm-full-menu block-control-menu bm-control-menu {if $parent_grid.width <= 2 && !$external_render}hidden{/if}">
				{if !$external_render}
					{* We need extra "hidden" div's for tooltips *}
					<div class="cm-tooltip cm-action action-properties bm-action-properties" title="{$lang.block_options}"></div>
					<div class="hidden"></div>
					{if !$dynamic_object}
						<div class="cm-tooltip cm-action action-delete bm-action-delete extra" title="{$lang.delete_block}"></div>
						<div class="hidden"></div>
					{/if}
					<div class="cm-tooltip cm-action action-switch bm-action-switch{if $status != "A"} switch-off{/if}{if $dynamic_object} bm-dynamic-object{/if}{if !$dynamic_object && $block_data.items_count > 0} bm-confirm{/if}" title="{$lang.enable_or_disable_block}"{if $dynamic_object}rel="{$dynamic_object.object_id}"{/if}>{$smarty.capture.confirm_message}</div>
					<div class="hidden"></div>
				{else}
					<input type="hidden" name="block_data[block_id]" value="{$block_data.block_id}" id="ajax_update_block_{$external_id}"/>
					{include file="common_templates/popupbox.tpl"
						id="edit_block_properties_`$block_data.block_id`_`$external_id`"
						text="`$lang.block_settings`"
						link_text="&nbsp;&nbsp;"
						act="link"
						href="block_manager.update_block?block_data[block_id]=`$block_data.block_id`&amp;ajax_update=1&amp;html_id=`$external_id`&amp;force_close=1"
						opener_ajax_class="cm-ajax cm-ajax-force cm"
						link_class="action-properties bm-action-properties"
						content=""
					}
				{/if}
			</div>
			{if !$external_render}
			<div class="bm-compact-menu block-control-menu bm-control-menu {if $parent_grid.width > 2}hidden{/if}">
				<div class="action-showmenu cm-action action-control-menu  bm-action-control-menu">
					<div class="bm-drop-menu cm-popup-box">
						<div class="bm-drop-menu-hint"></div>
						<a class="cm-action bm-action-properties">{$lang.block_options}</a>
						<a class="cm-action bm-action-delete extra">{$lang.delete_block}</a>
						<a class="cm-action bm-action-switch {if $status != "A"}switch-off{/if}">{$lang.on_off}<span class="action-switch"></span></a>
					</div>
				</div>
			</div>
			{/if}
		</div>

	{/strip}
{/if}