{$request|@var_dump}

{include file="buttons/button.tpl" but_text=$lang.place_bid but_href="vendor.php?dispatch=billibuys.place_bid&request_id=`$request.bb_request_id`"|@fn_url but_role="link"}