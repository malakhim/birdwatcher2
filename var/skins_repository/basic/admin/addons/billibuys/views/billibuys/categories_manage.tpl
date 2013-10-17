{capture name="mainbox"}

<div class="items-container multi-level">
	{if $categories}
		{include file="views/categories/components/categories_tree.tpl" header="1" parent_id=$bb_request_category_id}
	{else}
		<p class="no-items">{$lang.no_items}</p>
	{/if}
</div>

{capture name="tools"}
	{include file="common_templates/tools.tpl" tool_href="billibuys.category_add" prefix="top" hide_tools="true" link_text=$lang.add_category}
{/capture}

{/capture}
{include file="common_templates/mainbox.tpl" title=$lang.bb_manage_billibuys_categories content=$smarty.capture.mainbox tools=$smarty.capture.tools}