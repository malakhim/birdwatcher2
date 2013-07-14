<div id="addon_upgrade">

{include file="addons/twigmo/settings/contact_twigmo_support.tpl"}

{include file="common_templates/subheader.tpl" title=$lang.upgrade}

{if $next_version_info.next_version and $next_version_info.next_version != $smarty.const.TWIGMO_VERSION}
	<p>{$next_version_info.description|unescape}</p>
	
	<input type="submit" name="dispatch[upgrade_center.upgrade_twigmo]" value="{$lang.upgrade}" class="cm-skip-validation">
{else}
	<p>{$lang.text_no_upgrades_available}</p>
{/if}
<!--addon_upgrade--></div>
