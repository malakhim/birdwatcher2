<div id="template_list_menu"><div></div><ul class="float-left"><li></li></ul></div>

<div id="template_editor_content" title="{$lang.template_editor}" class="hidden">

	<table width="100%" cellpadding="0" cellspacing="0" class="editor-table">
		<tr valign="top" class="max-height">
			<td class="templates-tree max-height">
				<div>
				<h4>{$lang.templates_tree}</h4>
				<ul id="template_list"><li></li></ul></div>
			</td>
			<td>
				<textarea id="template_text"></textarea>
			</td>
		</tr>
	</table>

	<div class="buttons-container">
		{include file="buttons/add_close.tpl" is_js=true but_close_text=$lang.save but_close_onclick="fn_save_template();" but_onclick="fn_restore_template();" but_text=$lang.restore_from_repository}
	</div>

</div>

{script src="js/design_mode.js"}
{script src="lib/editarea/edit_area_loader.js"}

<script type="text/javascript">
//<![CDATA[
var current_url = '{$config.current_url}';
lang.text_page_changed = '{$lang.text_page_changed|escape:"javascript"}';
lang.text_restore_question = '{$lang.text_restore_question|escape:"javascript"}';
lang.text_template_changed = '{$lang.text_template_changed|escape:"javascript"}';
//]]>
</script>