{script src="js/tabs.js"}

{capture name="mainbox"}

{assign var="r_url" value=$config.current_url|escape:url}

<div class="items-container" id="manage_tabs_list">

{foreach from=$menus item="menu"}
		{assign var="_href_delete" value="menus.delete?menu_id=`$menu.menu_id`"}		
		{assign var="dialog_name" value="`$lang.editing_menu`:&nbsp;`$menu.name`"}
		{assign var="name" value=$menu.name}
		{assign var="edit_link" value="menus.update?menu_data[menu_id]=`$menu.menu_id`&amp;return_url=$r_url"}
		{capture name = "items_link"}			
			<a href="{"static_data.manage&section=A&menu_id=`$menu.menu_id`"|fn_url}">{$lang.manage_items}</a> |
		{/capture}
	{include file="common_templates/object_group.tpl" id=$menu.menu_id text=$name href=$edit_link href_delete=$_href_delete rev_delete="pagination_contents" header_text=$dialog_name table="menus" object_id_name="menu_id" status=$menu.status tool_items=$smarty.capture.items_link}
{foreachelse}

	<p class="no-items">{$lang.no_data}</p>

{/foreach}
<!--manage_tabs_list--></div>

<div class="buttons-container">
	{capture name="extra_tools"}
		{hook name="currencies:import_rates"}{/hook}
	{/capture}
</div>

{capture name="tools"}		
	{include file="common_templates/popupbox.tpl"
		act="general"
		id="add_menu"
		text=$lang.new_menu
		link_text=$lang.add_menu
		act="general"
		href="menus.update"
		opener_ajax_class="cm-ajax"
		link_class="cm-ajax-force"
		content=""}
{/capture}

{/capture}

{include file="common_templates/mainbox.tpl" title=$lang.menus content=$smarty.capture.mainbox tools=$smarty.capture.tools title_extra=$smarty.capture.title_extra select_languages=true extra_tools=$smarty.capture.extra_tools|trim}
