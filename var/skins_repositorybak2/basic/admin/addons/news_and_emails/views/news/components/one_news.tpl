<div class="search-result">
	<span>{$n.result_number}.</span> <a href="{"news.update?news_id=`$n.news_id`#`$n.news_id`"|fn_url}"" class="list-product-title">{$n.news|unescape}</a>
	
	<p>
	{$lang.date_added}: {$n.date|date_format:"`$settings.Appearance.date_format`"}<br />
	{assign var="news_link" value="news.update?news_id=`$n.news_id`#`$n.news_id"|fn_url}
	{$n.description|unescape|strip_tags|truncate:280:"<a href=\"`$news_link`\" class=\"underlined\">`$lang.more_link`</a>"}</p>
</div>