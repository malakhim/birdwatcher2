{if isset($smarty.session.auth.user_id) && $smarty.session.auth.user_id != 0}
	{assign var="home_href" value="billibuys.view"}
{else}
	{assign var="home_href" value=""}
{/if}

<a href="{$home_href|fn_url}"><img src="images/billibuys_logo_white.png" id="billibuys_footer_logo" width="180px"></a>