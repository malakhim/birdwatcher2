{script src="js/block_manager.js"}

<script type="text/javascript">
	var selected_location = '{$location.location_id|default:0}';

	var dynamic_object_id = '{$dynamic_object.object_id|default:0}';
	var dynamic_object_type = '{$dynamic_object_scheme.object_type|default:''}';

	var BlockManager = new BlockManager_Class();

{literal}
	if (dynamic_object_id > 0) {
		var items = null;
	} else {
		var items = '.block';
	}

	$(function() {
		$('#content_location_' + selected_location).appear(function(){
			BlockManager.init('.grid', {
				// UI settings
				connectWith: '.grid',
				items: items,
				revert: true,
				placeholder: 'ui-hover-block',
				opacity: 0.5,
				
				// BlockManager_Class settings
				container_class: 'container',
				grid_class: 'grid',
				block_class: 'block',
				hover_element_class: 'hover-element'
			});
		});
	});
{/literal}
</script>

<link href="{$config.skin_path}/block_manager.css" rel="stylesheet" type="text/css"/>
{if $dynamic_object.object_id > 0}
	<link href="{$config.skin_path}/block_manager_in_tab.css" rel="stylesheet" type="text/css"/>
{/if}
<link href="{$config.skin_path}/css/960/960.css" rel="stylesheet" type="text/css"/>

<div id="block_window" class="grid-block hidden"></div>
<div id="block_manager_menu" class="grid-menu hidden"></div>
<div id="block_manager_prop" class="grid-prop hidden"></div>

{include file="views/block_manager/render/grid.tpl" default_class="base-grid hidden" show_menu=true}
{include file="views/block_manager/render/block.tpl" default_class="base-block hidden" block_data=true}

{capture name="mainbox"}
{capture name="tabsbox"}

	<div id="content_location_{$location.location_id}">
		{render_location 
			dispatch=$location.dispatch
			location_id=$location.location_id
			area='A'
			lang_code=$location.lang_code
		}
	</div>
{/capture}

{capture name="tools"}
	{* Display this buttons only on block manager page *}
	{if !$dynamic_object.object_id}
		{include file="common_templates/popupbox.tpl"
			id="add_new_location"
			text=$lang.new_location
			link_text=$lang.add_location
			act="general"
			href="block_manager.update_location"
			opener_ajax_class="cm-ajax"
			link_class="cm-ajax-force"
			content=""
		}

		{include file="common_templates/popupbox.tpl"
			id="manage_blocks"
			text=$lang.block_manager
			link_text=$lang.manage_blocks
			link_class="cm-action bm-action-manage-blocks"
			act="general"
			content=""
			general_class="action-btn"
		}

		{include file="common_templates/popupbox.tpl"
			id="export_locations_manager"
			text=$lang.export_locations
			link_text=$lang.export_locations
			act="general"
			href="block_manager.export_locations"
			opener_ajax_class="cm-ajax"
			link_class="cm-ajax-force"
			content=""
			general_class="action-btn"
		}

		{include file="common_templates/popupbox.tpl"
			id="import_locations_manager"
			text=$lang.import_locations
			link_text=$lang.import_locations
			act="general"
			href="block_manager.import_locations"
			opener_ajax_class="cm-ajax"
			link_class="cm-ajax-force"
			content=""
			general_class="action-btn"
		}
	{/if}
{/capture}

{capture name="active_tab_extra"}
	{* Display locations only on block manager page *}
	{if !$dynamic_object.object_id}
		{capture name="_link_text"}
			<div class="text-button-settings"></div>			
		{/capture}
		{include 
			file="common_templates/popupbox.tpl" 
			id="tab_location_`$location.location_id`" 
			text="`$lang.editing_location`: `$location.name`"
			act="edit" 
			picker_meta="cm-clear-content" 
			href="block_manager.update_location?location=`$location.location_id`"  
			opener_ajax_class="cm-ajax" 
			link_class="cm-ajax-force" 
			link_text=$smarty.capture._link_text
			content=""
		}
	{/if}
{/capture}

{include 
	file="common_templates/tabsbox.tpl" 
	content=$smarty.capture.tabsbox 
	active_tab="location_`$location.location_id`" 
	active_tab_extra=$smarty.capture.active_tab_extra
}

{/capture}

{if $dynamic_object.object_id}
	{$smarty.capture.mainbox}
{else}
	{include file="common_templates/mainbox.tpl" title=$lang.blocks content=$smarty.capture.mainbox tools=$smarty.capture.tools select_languages=true}
{/if}