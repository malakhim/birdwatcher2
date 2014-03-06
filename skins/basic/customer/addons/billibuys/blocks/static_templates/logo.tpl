{** block-description:billibuys_tmpl_logo **}
<div class="logo-container">
	{if isset($smarty.session.auth.user_id) && $smarty.session.auth.user_id != 0}
		{assign var="home_href" value="billibuys.view"}
	{else}
		{assign var="home_href" value=""}
	{/if}
	<a href="{$home_href|fn_url}" style="background: url('{$images_dir}/{$manifest.Customer_logo.filename}') no-repeat; width:{$manifest.Customer_logo.width}px; height:{$manifest.Customer_logo.height}px;" title="{$manifest.Customer_logo.alt}" class="logo"></a>
</div>