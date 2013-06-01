{capture name="mainbox"}

{capture name="open_store_link"}
<a class="cm-ajax cm-confirm text-button" rev="store_mode" href="{"tools.store_mode?state=opened"|fn_url}">{$lang.open_store}</a>
{/capture}

{assign var="package" value=$smarty.request.package|escape:url}

{if $uc_upgrade_errors}
	{assign var="restore_link" value="upgrade_center.revert?package=`$package`"|fn_url}
	{$lang.text_uc_upgrade_completed_with_errors|replace:"[restore_link]":$restore_link}
{else}
	{$lang.text_uc_upgrade_completed}
{/if}
{$lang.text_uc_upgrade_completed_check_and_open|replace:"[link]":$smarty.capture.open_store_link}

<p>&nbsp;</p>
{if $smarty.request.package}
<a href="{"upgrade_center.revert?package=`$package`"|fn_url}">{$lang.revert}</a>
{/if}

<a href="{"upgrade_center.manage"|fn_url}">{$lang.upgrade_center}</a>

{/capture}
{include file="common_templates/mainbox.tpl" title=$lang.summary content=$smarty.capture.mainbox}