<div id="ci_top_wrapper" class="header clearfix">
	{$containers.top|htmlspecialchars_decode|unescape}
<!--ci_top_wrapper--></div>
<div id="ci_central_wrapper" class="main clearfix">
	{$containers.central|htmlspecialchars_decode|unescape}
<!--ci_central_wrapper--></div>
<div id="ci_bottom_wrapper" class="footer clearfix">
	{$containers.bottom|htmlspecialchars_decode|unescape}
<!--ci_bottom_wrapper--></div>

{if $manifest.copyright}
<p class="bottom-copyright mini">{$lang.skin_by}&nbsp;<a href="{$manifest.copyright_url}">{$manifest.copyright}</a></p>
{/if}

{if "DEBUG_MODE"|defined}
<div class="bug-report">
	<input type="button" onclick="window.open('bug_report.php','popupwindow','width=700,height=450,toolbar=yes,status=no,scrollbars=yes,resizable=no,menubar=yes,location=no,direction=no');" value="Report a bug" />
</div>
{/if}



{if $smarty.request.meta_redirect_url|fn_check_meta_redirect}
	<meta http-equiv="refresh" content="1;url={$smarty.request.meta_redirect_url|fn_check_meta_redirect|fn_url}" />
{/if}