<link href="{$config.skin_path}/css/ui/jqueryui.css" rel="stylesheet" type="text/css"/>
<link href="{$config.skin_path}/design_mode.css" rel="stylesheet" type="text/css" />
<link href="{$config.skin_path}/styles.css" rel="stylesheet" type="text/css" />
{if $smarty.const.AREA == "C"}
<link href="{$config.skin_path}/base.css" rel="stylesheet" type="text/css" />
{/if}

{script src="lib/js/jquery/jquery.min.js"}
{script src="lib/js/jqueryui/jquery-ui.custom.min.js"}

{script src="lib/js/appear/jquery.appear-1.1.1.js"}

{script src="js/core.js"}
{script src="js/ajax.js"}

<script type="text/javascript">
//<![CDATA[
	var index_script = '{$index_script|escape:"javascript"}';
	var changes_warning = '{$settings.Appearance.changes_warning|escape:"javascript"}';

	var lang = {$ldelim}
		save: '{$lang.save|escape:javascript}',
		close: '{$lang.close|escape:javascript}',
		loading: '{$lang.loading|escape:"javascript"}',
		notice: '{$lang.notice|escape:"javascript"}',
		warning: '{$lang.warning|escape:"javascript"}',
		error: '{$lang.error|escape:"javascript"}',
	{$rdelim}

	var images_dir = '{$images_dir}';
	var translate_mode = {if $settings.translation_mode == "Y"}true{else}false{/if};
	var cart_language = '{$smarty.const.CART_LANGUAGE}';
	var default_language = '{$smarty.const.DEFAULT_LANGUAGE}';

	{if $config.tweaks.anti_csrf}
		// CSRF form protection key
		var security_hash = '{""|fn_generate_security_hash}';
	{/if}

	$(document).ready(function(){$ldelim}
		jQuery.runCart('{$smarty.const.AREA}');
	{$rdelim});

//]]>
</script>

{include file="common_templates/loading_box.tpl"}
{include file="common_templates/notification.tpl"}
{include file="common_templates/translate_box.tpl"}
