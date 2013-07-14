<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
{include file="meta.tpl"}
{strip}
<title>
{if $page_title}
{$page_title}
{else}
{if $navigation.selected_tab}{$lang[$navigation.selected_tab]}{if $navigation.subsection} :: {$lang[$navigation.subsection]}{/if} - {/if}{$lang.admin_panel}
{/if}
</title>
{/strip}

<link href="{$images_dir}/icons/favicon.ico" rel="shortcut icon" />
{include file="common_templates/styles.tpl"}
{include file="common_templates/scripts.tpl"}
</head>

<body {if !$auth.user_id || $view_mode == "simple"}id="simple_view"{/if}>
{if "SKINS_PANEL"|defined}
{include file="demo_skin_selector.tpl"}
{/if}
	{include file="common_templates/loading_box.tpl"}
	{if !($auth.user_id && $view_mode != 'simple')}
		{include file="common_templates/notification.tpl"}
	{/if}
	
	{if $auth.user_id && $view_mode != 'simple'}
		{include file="top.tpl"}
	{/if}
	{include file="main.tpl"}
	{if $auth.user_id && $view_mode != 'simple'}
		{include file="bottom.tpl"}
	{/if}
	{$stats|default:""|unescape}
{if "TRANSLATION_MODE"|defined}
	{include file="common_templates/translate_box.tpl"}
{/if}

{include file="common_templates/comet.tpl"}

</body>

</html>