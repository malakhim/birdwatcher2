{script src="js/tabs.js"}
<link href="{$config.skin_path}/block_manager.css" rel="stylesheet" type="text/css"/>

{capture name="mainbox"}

{if !$dynamic_object}
	{include file="common_templates/sortable_position_scripts.tpl" sortable_table="product_tabs" sortable_id_name="tab_id"}
{/if}

{assign var="r_url" value=$config.current_url|escape:url}
{if "tabs.update"|fn_check_view_permissions}
	{assign var="non_editable" value=false}
{else}
	{assign var="non_editable" value=true}
{/if}
<div class="items-container {if !$dynamic_object}cm-sortable{/if}" id="manage_tabs_list">

{foreach from=$product_tabs item="tab"}
	{if $tab.is_primary == "Y" || $dynamic_object || $non_editable}
		{assign var="_href_delete" value=""}
	{else}
		{assign var="_href_delete" value="tabs.delete?tab_id=`$tab.tab_id`"}
	{/if}	

	{if $dynamic_object} 
		{assign var="dynamic_object_href" value="&amp;dynamic_object[object_type]=`$dynamic_object.object_type`&amp;dynamic_object[object_id]=`$dynamic_object.object_id`&amp;selected_location=`$location.location_id`&amp;hide_status=1"}
		{assign var="r_url" value="products.update?product_id=`$dynamic_object.object_id`&amp;selected_section=product_tabs"|urlencode}
		{assign var="additional_class" value=""}
	{else}
		{assign var="dynamic_object_href" value=""}
		{assign var="r_url" value="tabs.manage"}
		{assign var="additional_class" value="cm-sortable-row cm-sortable-id-`$tab.tab_id`"}
	{/if}

	{if $tab.product_ids}
		{assign var="confirm" value=true}
	{else}
		{assign var="confirm" value=""}
	{/if}

	{capture name = "tool_items"}{strip}
		{if $tab.tab_type == "B"}
			<span class="small-note lowercase">{strip}(
				{if $tab.block_id && $dynamic_object}
					{include file="common_templates/popupbox.tpl"
						id="edit_block_properties_`$tab.block_id`_tab_`$tab.tab_id`"
						text="`$lang.block_settings`"
						link_text="`$lang.block_settings`"
						act="link"
						href="block_manager.update_block?block_data[block_id]=`$tab.block_id`&amp;r_url=`$r_url`&amp;html_id=tab_`$tab.tab_id``$dynamic_object_href`"
						action="block_manager.update_block"
						opener_ajax_class="cm-ajax"
						link_class="cm-ajax-force"
						content=""
					}
				{else}
					{$lang.block}
				{/if}
			){/strip}</span>
		{/if} 
	{/strip}{/capture}

	{include
		file="common_templates/object_group.tpl"
		id=$tab.tab_id
		text=$tab.name
		href="tabs.update?tab_data[tab_id]=`$tab.tab_id`&amp;return_url=`$r_url`"
		href_delete=$_href_delete
		rev_delete="pagination_contents"
		header_text="`$lang.editing_tab`:&nbsp;`$tab.name`"
		table="product_tabs"
		object_id_name="tab_id"
		update_controller='tabs'
		dynamic_object=$dynamic_object_href
		status=$tab.status
		additional_class=$additional_class
		details=$smarty.capture.tool_items
		non_editable=$dynamic_object
		confirm=$confirm
		prefix="product_tabs"
		no_popup = $non_editable
	}
{foreachelse}

	<p class="no-items">{$lang.no_data}</p>

{/foreach}
<!--manage_tabs_list--></div>

<div class="buttons-container">
	{capture name="extra_tools"}
		{hook name="currencies:import_rates"}{/hook}
	{/capture}
</div>

{if !$dynamic_object}
	{capture name="tools"}	
		{include file="common_templates/popupbox.tpl"
			act="general"
			id="add_tab"
			text=$lang.new_tab
			link_text=$lang.add_tab
			act="general"
			href="tabs.update"
			action="tabs.update"
			opener_ajax_class="cm-ajax"
			link_class="cm-ajax-force"
			content=""}
	{/capture}
{/if}

{/capture}

{if !$dynamic_object}
	{include file="common_templates/mainbox.tpl" title=$lang.product_tabs content=$smarty.capture.mainbox tools=$smarty.capture.tools title_extra=$smarty.capture.title_extra select_languages=true extra_tools=$smarty.capture.extra_tools|trim}
{else}
	{$smarty.capture.mainbox}
{/if}

