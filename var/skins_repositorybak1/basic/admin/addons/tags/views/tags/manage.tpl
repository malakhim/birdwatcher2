{capture name="mainbox"}

   

{include file="addons/tags/views/tags/components/tags_search_form.tpl" dispatch="tags.manage"}

{assign var="c_url" value=$config.current_url|fn_query_remove:"sort_by":"sort_order"}

<form action="{""|fn_url}" method="post" name="tags_form">

{include file="common_templates/pagination.tpl" save_current_page=true save_current_url=true}

<table class="table sortable hidden-inputs" width="100%" cellpadding="0" cellspacing="0" border="0">
<tr>
	<th class="center"><input type="checkbox" name="check_all" value="Y" title="{$lang.check_uncheck_all}" class="checkbox cm-check-items" /></th>
	<th width="60%"><a class="cm-ajax{if $search.sort_by == "tag"} sort-link-{$search.sort_order}{/if}" href="{"`$c_url`&amp;sort_by=tag&amp;sort_order=`$search.sort_order`"|fn_url}" rev="pagination_contents">{$lang.tag}</a></th>
	<th><a class="cm-ajax{if $search.sort_by == "popularity"} sort-link-{$search.sort_order}{/if}" href="{"`$c_url`&amp;sort_by=popularity&amp;sort_order=`$search.sort_order`"|fn_url}" rev="pagination_contents">{$lang.popularity}</a></th>
	<th><a class="cm-ajax{if $search.sort_by == "users"} sort-link-{$search.sort_order}{/if}" href="{"`$c_url`&amp;sort_by=users&amp;sort_order=`$search.sort_order`"|fn_url}" rev="pagination_contents">{$lang.users}</a></th>
	{foreach from=$tag_objects item="o"}
	<th>&nbsp;&nbsp;{$lang[$o.name]}&nbsp;&nbsp;</th>
	{/foreach}
	<th width="10%"><a class="cm-ajax{if $search.sort_by == "status"} sort-link-{$search.sort_order}{/if}" href="{"`$c_url`&amp;sort_by=status&amp;sort_order=`$search.sort_order`"|fn_url}" rev="pagination_contents">{$lang.status}</a></th>
	<th width="7%">&nbsp;</th>
</tr>
{foreach from=$tags item="tag"}
	<tr {cycle values="class=\"table-row\", "}>
		<td><input type="checkbox" class="checkbox cm-item" value="{$tag.tag_id}" name="tag_ids[]"/></td>
		<td width="60%">
			<input type="text" name="tags_data[{$tag.tag_id}][tag]" value="{$tag.tag}" size="20" class="input-text" />
		</td>
		<td>{$tag.popularity}</td>
		<td>{if $tag.users}<a href="{"profiles.manage?tag=`$tag.tag`"|fn_url}">{$tag.users}{else}0{/if}</td>
		{foreach from=$tag_objects key="k" item="o"}
		<td>
			{if $tag.objects_count.$k}<a href="{"`$o.url`&amp;tag=`$tag.tag`"|fn_url}">{$tag.objects_count.$k}</a>{else}0{/if}
		</td>
		{/foreach}
		<td>
			{include file="common_templates/select_popup.tpl" id=$tag.tag_id status=$tag.status items_status="tags"|fn_get_predefined_statuses object_id_name="tag_id" table="tags"}
		</td>
		<td class="nowrap">
		{capture name="tools_items"}
		<li><a class="cm-confirm" href="{"tags.delete&amp;tag_id=`$tag.tag_id`"|fn_url}">{$lang.delete}</a></li>
		{/capture}
		{include file="common_templates/table_tools_list.tpl" prefix=$tag.tag_id tools_list=$smarty.capture.tools_items}
		</td>
	</tr>
{foreachelse}
<tr class="no-items">
	<td colspan="{math equation="6 + x" x=$tag_objects|count}"><p>{$lang.no_data}</p></td>
</tr>
{/foreach}
</table>

{include file="common_templates/pagination.tpl"}

{if $tags}
<div class="buttons-container buttons-bg">
	<div class="float-left">

		{capture name="tools_list"}
		<ul>
			{hook name="tags:list_extra_links"}
			<li><a class="cm-process-items" name="dispatch[tags.disapprove]" rev="tags_form">{$lang.disapprove_selected}</a></li>
			<li><a class="cm-process-items" name="dispatch[tags.approve]" rev="tags_form">{$lang.approve_selected}</a></li>
			<li><a class="cm-confirm cm-process-items" name="dispatch[tags.delete]" rev="tags_form">{$lang.delete_selected}</a></li>
			{/hook}
		</ul>
		{/capture}

		{include file="buttons/save.tpl" but_name="dispatch[tags.m_update]" but_role="button_main"}
		{include file="common_templates/tools.tpl" prefix="main" hide_actions=true tools_list=$smarty.capture.tools_list display="inline" link_text=$lang.choose_action}
	</div>
</div>
{/if}
</form>


{capture name="tools"}
{capture name="add_new_picker"}
<form action="{""|fn_url}" method="post" name="add_tag_form" class="cm-form-highlight">

<input type="hidden" name="tag_id" value="0">

<div class="tabs cm-j-tabs">
	<ul>
		<li id="tab_static_data_new" class="cm-js cm-active"><a>{$lang.general}</a></li>
	</ul>
</div>

<div class="cm-tabs-content" id="content_tab_static_data_new">
	<div class="form-field">
		<label class="cm-required" for="add_tag_data">{$lang.tag}:</label>
		<input type="text" size="40" name="tag_data[tag]" id="add_tag_data" value="" class="input-text-large main-input" />
	</div>

	<div class="form-field">
		<label for="add_tag_status" class="cm-required">{$lang.status}:</label>
		<select name="tag_data[status]" id="add_tag_status">
			<option value="A">{$lang.approved}</option>
			<option value="D">{$lang.disapproved}</option>
			<option value="P">{$lang.pending}</option>
		</select>
	</div>
</div>

<div class="buttons-container">
	{include file="buttons/save_cancel.tpl" but_name="dispatch[tags.update]" create=true cancel_action="close"}
</div>

</form>
{/capture}
{include file="common_templates/popupbox.tpl" id="add_new_section" text=$lang.new_tag content=$smarty.capture.add_new_picker link_text=$lang.add_tag act="general"}
{/capture}

       

{/capture}

{include file="common_templates/mainbox.tpl" title=$lang.tags content=$smarty.capture.mainbox title_extra=$smarty.capture.title_extra tools=$smarty.capture.tools}