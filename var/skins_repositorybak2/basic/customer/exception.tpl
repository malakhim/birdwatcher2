<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="{$smarty.const.CART_LANGUAGE|lower}">
<head>
<title>{$page_title}</title>

{include file="meta.tpl"}
<link href="{$images_dir}/icons/favicon.ico" rel="shortcut icon" />
{include file="common_templates/styles.tpl" include_dropdown=true}
{include file="common_templates/scripts.tpl"}
</head>

<body>
<div class="helper-container">
	<a name="top"></a>

	{render_location dispatch="no_page"}

	{if "TRANSLATION_MODE"|defined}
		{include file="common_templates/translate_box.tpl"}
	{/if}
	{if "CUSTOMIZATION_MODE"|defined}
		{include file="common_templates/template_editor.tpl"}
	{/if}
	{if "CUSTOMIZATION_MODE"|defined || "TRANSLATION_MODE"|defined}
		{include file="common_templates/design_mode_panel.tpl"}
	{/if}
</div>
</body>

</html>