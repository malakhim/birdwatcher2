{capture name="mainbox"}

{$request|@var_dump}

{include file="buttons/button.tpl" but_text=$lang.place_bid but_href="billibuys.place_bid&request_id=`$request.bb_request_id`"|@fn_url but_role="link"}

{/capture}

{include file="common_templates/mainbox.tpl" title=$lang.billibuys content=$smarty.capture.mainbox title_extra=$smarty.capture.title_extra tools=$smarty.capture.tools}