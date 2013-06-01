<div class="form-field" id="parent_page_selector">

	<label class="cm-required" for="elm_parent_id">{$lang.parent_page}:</label>
	{if !$parent_pages}
		{include file="pickers/pages_picker.tpl" data_id="location_page" input_name="page_data[parent_id]" item_ids=$page_data.parent_id|default:"0" hide_link=true hide_delete_button=true show_root=true default_name=$lang.root_level display_input_id="elm_parent_id" except_id=$page_data.page_id company_id=$page_data.company_id}
	{else}
		<select name="page_data[parent_id]" id="elm_parent_id">
			<option value="0">- {$lang.root_page} -</option>
			{foreach from=$parent_pages item="page"}
			{if ($page.id_path|strpos:"`$page_data.id_path`/" === false && $page_data.page_id != $page.page_id) || $show_all}
				<option value="{$page.page_id}" {if $page.page_id == $smarty.request.parent_id || $page.page_id == $page_data.parent_id}selected="selected"{/if}>{$page.page|escape|indent:$page.level:"&#166;&nbsp;&nbsp;&nbsp;&nbsp;":"&#166;--&nbsp;"}</option>
			{/if}
			{/foreach}
		</select>
	{/if}
<!--parent_page_selector--></div>
