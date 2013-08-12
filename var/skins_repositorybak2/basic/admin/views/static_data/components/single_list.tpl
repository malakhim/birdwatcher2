{include file="common_templates/sortable_position_scripts.tpl" sortable_table="static_data" sortable_id_name="param_id"}

<div class="items-container cm-sortable">
{foreach from=$static_data item="s"}
	{if ""|fn_allow_save_object:"static_data":$section_data.skip_edition_checking}
		{assign var="href_delete" value="static_data.delete?param_id=`$s.param_id`&amp;section=$section"}
	{else}
		{assign var="href_delete" value=""}
	{/if}

	{include file="common_templates/object_group.tpl" id=$s.param_id text=$s.descr status=$s.status hidden=false href="static_data.update?param_id=`$s.param_id`&amp;section=$section" object_id_name="param_id" table="static_data" href_delete=$href_delete rev_delete="static_data_list" header_text=$lang[$section_data.edit_title]|cat:": `$s.descr`" link_text="" additional_class="cm-sortable-row cm-sortable-id-`$s.param_id`"}

{foreachelse}
	<p class="no-items">{$lang.no_data}</p>
{/foreach}
</div>