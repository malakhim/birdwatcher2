

{include file="common_templates/sortable_position_scripts.tpl" sortable_id="attachments_list" sortable_table="attachments" sortable_id_name="attachment_id" handle_class=""}
<div class="items-container cm-sortable" id="attachments_list">
{foreach from=$attachments item="a"}

	{capture name="object_group"}
		{include file="addons/attachments/views/attachments/update.tpl" mode="update" attachment=$a object_id=$object_id object_type=$object_type hide_inputs=$hide_inputs}
	{/capture}
	{include file="common_templates/object_group.tpl" content=$smarty.capture.object_group id=$a.attachment_id text=$a.description status=$a.status object_id_name="attachment_id" table="attachments" href_delete="attachments.delete?attachment_id=`$a.attachment_id`&object_id=`$object_id`&object_type=`$object_type`" rev_delete="attachments_list" header_text="`$lang.editing_attachment`: `$a.description`" additional_class="cm-sortable-row cm-sortable-id-`$a.attachment_id`" id_prefix="_attachments_" prefix="attachments" hide_for_vendor=$hide_for_vendor skip_delete=$skip_delete}

{foreachelse}

	<p class="no-items">{$lang.no_data}</p>

{/foreach}
<!--attachments_list--></div>

{if !$hide_for_vendor}
<div class="buttons-container">
	{capture name="add_new_picker"}
		{include file="addons/attachments/views/attachments/update.tpl" mode="add" attachment="" object_id=$object_id object_type=$object_type}
	{/capture}
	{include file="common_templates/popupbox.tpl" id="add_new_attachments_files" text=$lang.new_attachment link_text=$lang.add_attachment content=$smarty.capture.add_new_picker act="general"}
</div>
{/if}