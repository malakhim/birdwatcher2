{if $news}
<div class="news">
	{capture name="tabsbox"}
	<div class="news-item">
		<h1>
			<span>{$lang.date_added}: {$news.date|date_format:"`$settings.Appearance.date_format`"}</span>
			{$news.news}
		</h1>
		<div class="news-content">
			{$news.description|unescape}
		</div>
	</div>
	{hook name="news:view"}
	{/hook}
	
	{/capture}
	{include file="common_templates/tabsbox.tpl" content=$smarty.capture.tabsbox active_tab=$smarty.request.selected_section}
</div>
{capture name="mainbox_title"}{$lang.site_news}{/capture}
{/if}