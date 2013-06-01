<div class="exception">
	<span class="exception-code"> {$exception_status} <em>{$lang.exception_error}</em> </span>
<h1>{$lang.exception_title}</h1>
<p>
	{if $smarty.const.HTTPS === true}
		{assign var="return_url" value=$config.https_location|fn_url}
	{else}
		{assign var="return_url" value=$config.http_location|fn_url}
	{/if}
	
	{if $exception_status == "403"}
		{$lang.access_denied_text}
	{elseif $exception_status == "404"}
		{$lang.page_not_found_text}
	{/if}

</p>
<p>{$lang.exception_error_code}
	{if $exception_status == "403"}
		{$lang.access_denied}
	{elseif $exception_status == "404"}
		{$lang.page_not_found}
	{/if}
</p>
	<ul>
		<li><a href="{$return_url}">{$lang.go_to_the_homepage}</a></li>
		<li id="go_back"><a onclick="history.go(-1);">{$lang.go_back}</a></li>
	</ul>
</div>
<script type="text/javascript">
	//<![CDATA[
	{literal}
	$(function() {
		$.each($.browser, function(i, val) {
			if ((i == 'opera') && (val == true)) {
				if (history.length == 0) {
					$('#go_back').hide();
				}
			} else {
				if (history.length == 1) {
					$('#go_back').hide();
				}
			}
		});
	});
	{/literal}
	//]]>
</script>