{capture name="mainbox"}
	{include file="addons/discussion/views/discussion_manager/components/discussion.tpl"}
{/capture}
{include file="common_templates/mainbox.tpl" title=$lang.discussion_title_home_page content=$smarty.capture.mainbox select_languages=true tools=$smarty.capture.tools}