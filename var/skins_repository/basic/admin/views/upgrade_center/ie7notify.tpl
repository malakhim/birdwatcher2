{capture name="mainbox"}
	{$lang.browser_upgrade_notice|replace:"[admin_index]":$config.admin_index}
{/capture}
{include file="common_templates/mainbox.tpl" title=$lang.browser_upgrade_notice_title content=$smarty.capture.mainbox}