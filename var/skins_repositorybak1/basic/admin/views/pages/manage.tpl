{capture name="mainbox"}

{include file="views/pages/components/pages_search_form.tpl" dispatch="pages.manage"}

<div id="content_manage_pages">
<form action="{""|fn_url}" method="post" name="pages_tree_form">
<input type="hidden" name="redirect_url" value="{$config.current_url}" />
{assign var="come_from" value=$smarty.request.page_type}
{include file="common_templates/pagination.tpl" save_current_page=true save_current_url=true div_id=$smarty.request.content_id}

<div class="items-container multi-level">
	{include file="views/pages/components/pages_tree.tpl" header=true combination_suffix="_list"}
</div>

{include file="common_templates/pagination.tpl" div_id=$smarty.request.content_id}

{assign var="rev" value=$smarty.request.content_id|default:"pagination_contents"}

{if $pages_tree}
<div class="buttons-container buttons-bg">
	<div class="float-left">
		{capture name="tools_list"}
		<ul>
			<li><a name="dispatch[pages.m_clone]" class="cm-process-items" rev="pages_tree_form">{$lang.clone_selected}</a></li>
			<li><a name="dispatch[pages.m_delete]" class="cm-process-items cm-confirm" rev="pages_tree_form">{$lang.delete_selected}</a></li>
		</ul>
		{/capture}
		{include file="buttons/save.tpl" but_name="dispatch[pages.m_update]" but_role="button_main"}
		{include file="common_templates/tools.tpl" prefix="main`$smarty.request.content_id`" hide_actions=true tools_list=$smarty.capture.tools_list display="inline" link_text=$lang.choose_action}
	</div>
</div>
{/if}

{capture name="tools"}
	{foreach from=$page_types key="_k" item="_p"}
	{include file="common_templates/tools.tpl" tool_href="pages.add?page_type=`$_k`&come_from=`$come_from`" prefix="top" link_text=$lang[$_p.add_name] hide_tools=true}
	{/foreach}
{/capture}

</form>
<!--content_manage_pages--></div>
{/capture}

{capture name="extra_tools"}
	{include file="buttons/button.tpl" but_text=$lang.tree but_href="pages.manage?get_tree=multi_level" but_role="tool"}
	{foreach from=$page_types key="_k" item="_p" name="fe_p"}
	{include file="buttons/button.tpl" but_text=$lang[$_p.name] but_href="pages.manage?page_type=`$_k`" but_role="tool"}{if !$smarty.foreach.fe_p.last}{/if}
	{/foreach}
{/capture}


{include file="common_templates/mainbox.tpl" title=$lang.content content=$smarty.capture.mainbox title_extra=$smarty.capture.title_extra tools=$smarty.capture.tools extra_tools=$smarty.capture.extra_tools}