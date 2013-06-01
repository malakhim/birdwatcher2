

<div class="items-container cm-sortable" id="product_files_list">

{foreach from=$product_files item="file"}
	{capture name="object_group"}
		{include file="views/products/components/products_update_file_details.tpl" product_file=$file product_id=$product_data.product_id hide_inputs=$hide_inputs}
	{/capture}
	{include file="common_templates/object_group.tpl" content=$smarty.capture.object_group id=$file.file_id text=$file.file_name status=$file.status object_id_name="file_id" table="product_files" href_delete="products.delete_file?file_id=`$file.file_id`" rev_delete="product_files_list" header_text="`$lang.editing_file`: `$file.file_name`" id_prefix="_files_" prefix="files" hide_for_vendor=$hide_for_vendor skip_delete=$skip_delete}

{foreachelse}

	<p class="no-items">{$lang.no_data}</p>

{/foreach}
<!--product_files_list--></div>

{if !$hide_for_vendor}
<div class="buttons-container">
	{capture name="add_new_picker"}
		{include file="views/products/components/products_update_file_details.tpl" product_id=$product_data.product_id}
	{/capture}
	{include file="common_templates/popupbox.tpl" id="add_new_files" text=$lang.new_file content=$smarty.capture.add_new_picker link_text=$lang.add_file act="general"}
</div>
{/if}