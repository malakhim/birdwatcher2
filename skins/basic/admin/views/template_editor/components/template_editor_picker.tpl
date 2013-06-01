<div class="hidden" id="template_editor_content" title="{$lang.template_editor}">

<textarea id="template_text" style="height: 350px; width: 100%;"></textarea>

<div>
	<input type="checkbox" id="enabled_template_editor" onchange="template_editor.change_status_editor($(this).val());" /><label>{$lang.enable_template_editor}</label>
</div>

<div class="buttons-container">
	{include file="buttons/add_close.tpl" is_js=true but_close_text=$lang.save but_close_onclick="fn_save_template();" but_onclick="template_editor.restore_file();" but_text=$lang.restore_from_repository}
</div>

</div>

{script src="js/design_mode.js"}
{script src="lib/editarea/edit_area_loader.js"}

<script type="text/javascript">
//<![CDATA[
lang.text_page_changed = '{$lang.text_page_changed|escape:"javascript"}';
lang.text_restore_question = '{$lang.text_restore_question|escape:"javascript"}';
lang.text_template_changed = '{$lang.text_template_changed|escape:"javascript"}';
//]]>
</script>