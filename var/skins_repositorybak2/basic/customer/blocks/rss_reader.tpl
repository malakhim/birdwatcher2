{** block-description:rss_reader **}

{if $items}
<ul class="site-rss">
{foreach from=$items[0] item="item" name="site_rss"}
	<li>
		{if $item.pubDate}
		<strong>{$item.pubDate|date_format:$settings.Appearance.date_format}</strong>
		{/if}
		<a href="{$item.link}">{$item.title}</a>
	</li>
	{if !$smarty.foreach.site_rss.last}
	<li class="delim"></li>
	{/if}
{/foreach}
</ul>

<p class="right">
	<a href="{$items[1]}" class="extra-link">{$lang.view_all}</a> | <a href="{$items[2]}" class="extra-link">{$lang.rss_reader}</a>
</p>
{/if}
