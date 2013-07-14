{capture name="mainbox"}

{$request|@var_dump}
{/capture}

{include file="common_templates/mainbox.tpl" title=$lang.billibuys content=$smarty.capture.mainbox title_extra=$smarty.capture.title_extra tools=$smarty.capture.tools}