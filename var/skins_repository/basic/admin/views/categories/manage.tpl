{capture name="mainbox"}

<form action="{""|fn_url}" method="post" name="category_tree_form" class="{if ""|fn_check_form_permissions}cm-hide-inputs{/if}">
<div class="items-container multi-level">
	{if $categories_tree}
		{include file="views/categories/components/categories_tree.tpl" header="1" parent_id=$category_id}
	{else}
		<p class="no-items">{$lang.no_items}</p>
	{/if}
</div>

{capture name="select_fields_to_edit"}

	<p>{$lang.text_select_fields2edit_note}</p>
	{include file="views/categories/components/categories_select_fields.tpl"}

	<div class="buttons-container">
		{include file="buttons/save_cancel.tpl" but_text=$lang.modify_selected but_meta="cm-process-items" but_name="dispatch[categories.store_selection]" cancel_action="close"}
	</div>
{/capture}


{include file="common_templates/popupbox.tpl" id="select_fields_to_edit" text=$lang.select_fields_to_edit content=$smarty.capture.select_fields_to_edit}

{if $categories_tree}
<div class="buttons-container buttons-bg">
	<div class="float-left">
		{capture name="tools_list"}
		<ul>
			<li><a class="cm-confirm cm-process-items" name="dispatch[categories.m_delete]" rev="category_tree_form">{$lang.delete_selected}</a></li>
			<li><a class="cm-process-items cm-dialog-opener" rev="content_select_fields_to_edit" >{$lang.edit_selected}</a></li>
		</ul>
		{/capture}
		{include file="buttons/save.tpl" but_name="dispatch[categories.m_update]" but_role="button_main"}
		{include file="common_templates/tools.tpl" prefix="main" hide_actions=true tools_list=$smarty.capture.tools_list display="inline" link_text=$lang.choose_action}
	</div>
</div>
{/if}

{capture name="tools"}
	{include file="common_templates/tools.tpl" tool_href="categories.add" prefix="top" hide_tools="true" link_text=$lang.add_category}
{/capture}

</form>

{/capture}
{include file="common_templates/mainbox.tpl" title=$lang.categories content=$smarty.capture.mainbox tools=$smarty.capture.tools}