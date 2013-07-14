{script src="js/template_editor_scripts.js"}
<script type="text/javascript">
	//<![CDATA[
	lang.text_enter_filename = '{$lang.text_enter_filename|escape:"javascript"}';
	lang.text_are_you_sure_to_delete_file = '{$lang.text_are_you_sure_to_delete_file|escape:"javascript"}';

	{literal}
	$(function(){
		template_editor.refresh();
	});

	function fn_form_post_add_file_dir_form(frm, elm) 
	{
		var val;
		var is_dir;
		if ($('input[name=new_file]', frm).length) {
			val = $('input[name=new_file]', frm).val();
			is_dir = false;
		} else {
			val = $('input[name=new_directory]', frm).val();
			is_dir = true;
		}

		template_editor.create_file(val, is_dir);

		return false;
	}
	{/literal}
	//]]>
</script>

{capture name="mainbox"}

{notes title=$lang.legend}
	<table cellpadding="0" cellspacing="0" border="0" class="template-editor-legend">
	<tr>
		<td class="nowrap"><img src="{$images_dir}/icons/icon_folder_c.png" alt="" border="0" /></td>
		<td><p>{$lang.legend_customer_directory}</p></td>
	</tr>
	<tr>
		<td class="nowrap"><img src="{$images_dir}/icons/icon_folder_a.png" alt="" border="0" /></td>
		<td><p>{$lang.legend_admin_directory}</p></td>
	</tr>
	<tr>
		<td class="nowrap"><img src="{$images_dir}/icons/icon_folder_ac.png" alt="" border="0" /></td>
		<td><p>{$lang.legend_all_areas_directory}</p></td>
	</tr>
	</table>
{/notes}


<div id="error_box" class="hidden">
	<div align="center" class="notification-e">
		<div id="error_status"></div>
	</div>
</div>

<div id="status_box" class="hidden">
	<div class="notification-n" align="center">
		<div id="status"></div>
	</div>
</div>

<div class="items-container sortable">
<div class="editor-tools clear">
	<div class="float-left"><span>{$lang.current_path}</span>:&nbsp;&nbsp;<span id="path"></span></div>
	<div class="select-field float-right">
		<input type="checkbox" name="show_active_skins_only" id="show_active_skins_only" value="Y" {if $show_active_skins_only == "Y"}checked="checked"{/if} onclick="$.ajaxRequest('{"template_editor.active_skins?show_active_skins_only="|fn_url:'A':'rel':'&'}'+(this.checked ? 'Y' : ''), {literal}{callback: [template_editor, 'refresh'], cache: false}{/literal});" class="checkbox" />
		<label for="show_active_skins_only">{$lang.show_active_skins_only}</label>
	</div>
</div>

<div id="filelist">{$lang.loading}</div>

<div class="editor-tools clear hidden" id="actions_table">
	<ul>
		<li><a href="javascript: template_editor.delete_file();">{$lang.delete}</a></li>
		<li>|<a href="javascript: template_editor.rename();">{$lang.rename}</a></li>
		<li>|<a href="javascript: template_editor.restore_file();">{$lang.restore_from_repository}</a></li>
	{if 1||$smarty.const.IS_WINDOWS == false}
	<li>|
	{*<a href="javascript: template_editor.show_perms_dialog();">{$lang.change_permissions}</a>*}
	{capture name="chmod"}
		{include file="views/template_editor/components/chmod.tpl"}
	{/capture}
	{include file="common_templates/popupbox.tpl" id="chmod" text=$lang.change_permissions content=$smarty.capture.chmod link_text=$lang.change_permissions act="edit" edit_onclick="template_editor.parse_permissions();" link_text=$lang.change_permissions}
	</li>
	{/if}
	</ul>

	<ul id="file_actions" class="hidden">
		<li>|<a href="javascript: template_editor.show_content('');">{$lang.edit}</a></li>
	</ul>
</div>
</div>

<div class="buttons-container">
	{capture name="upload_file"}
		<form name="upload_form" action="{""|fn_url}" method="post" enctype="multipart/form-data" class="cm-form-highlight">

		<div class="form-field">
			<label for="type_{"uploaded_data[0]"|md5}" class="cm-required">{$lang.select}:</label>
			<input type="hidden" name="fake" value="1" />
			{include file="common_templates/fileuploader.tpl" var_name="uploaded_data[0]"}
		</div>
		
		<div class="buttons-container">
			{include file="buttons/save_cancel.tpl" but_text=$lang.upload but_name="dispatch[template_editor.upload_file]" cancel_action="close"}
		</div>
		</form>
	{/capture}
	
	{capture name="tools"}
		{include file="common_templates/popupbox.tpl" id="upload_file" text=$lang.upload_file content=$smarty.capture.upload_file link_text=$lang.upload_file
		act="general"}
	{/capture}
	
	{capture name="add_new_folder"}
		<form name="add_file_dir_form" class="cm-form-highlight">

		<div class="form-field">
			<label for="new_directory" class="cm-required">{$lang.name}:</label>
				<input class="input-text main-input" type="text" name="new_directory" id="new_directory" value="" size="30" />
		</div>
		
		<div class="buttons-container">
			{include file="buttons/save_cancel.tpl" create=true cancel_action="close" but_meta="cm-dialog-closer"}
		</div>
		</form>
	{/capture}
	
	{capture name="tools"}
		{$smarty.capture.tools}
		{include file="common_templates/popupbox.tpl" id="add_new_folder" text=$lang.new_folder content=$smarty.capture.add_new_folder link_text=$lang.create_folder act="general"}
	{/capture}

	{capture name="add_new_file"}
		<form name="add_file_dir_form" class="cm-form-highlight">

		<div class="form-field">
			<label for="new_file" class="cm-required">{$lang.name}:</label>
			<input class="input-text main-input" type="text" name="new_file" id="new_file" value="" size="30" />
		</div>

		
		<div class="buttons-container">
			{include file="buttons/save_cancel.tpl" create=true cancel_action="close" but_meta="cm-dialog-closer"}
		</div>
		</form>
	{/capture}
	
	{capture name="tools"}
		{$smarty.capture.tools}
		{include file="common_templates/popupbox.tpl" id="add_new_file" text=$lang.new_file content=$smarty.capture.add_new_file link_text=$lang.create_file act="general"}
	{/capture}


</div>

{include file="views/template_editor/components/template_editor_picker.tpl"}

{/capture}
{include file="common_templates/mainbox.tpl" content=$smarty.capture.mainbox title=$lang.template_editor tools=$smarty.capture.tools}