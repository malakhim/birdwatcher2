{assign var="id" value=$menu_data.menu_id|default:"0"}

<form action="{""|fn_url}" name="update_product_menu_form_{$id}" method="post" class="cm-skip-check-items cm-form-highlight">
<div id="content_group_menu_{$id}">

<input type="hidden" name="menu_data[menu_id]" value="{$id}" />
<input type="hidden" name="result_ids" value="content_group_menu_{$id}" />

<fieldset>
	<div class="form-field">
		<label class="cm-required" for="description_{$id}">{$lang.name}:</label>
		<input type="text" name="menu_data[name]" value="{$menu_data.name}" id="description_{$id}" class="input-text" size="18" />
	</div>
	
	{include file="common_templates/select_status.tpl" input_name="menu_data[status]" id="menu_data" obj=$menu_data}

	</fieldset>

<!--content_group_menu_{$id}--></div>
<div class="buttons-container">
	{include file="buttons/save_cancel.tpl" but_name="dispatch[menus.update]" cancel_action="close"}
</div>
</form>
