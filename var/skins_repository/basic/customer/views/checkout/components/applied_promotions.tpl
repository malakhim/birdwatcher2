<div id="applied_promotions">
	<span class="block strong">{$lang.text_applied_promotions}</span>
	<ul>
	{foreach from=$applied_promotions item="promotion"}
		<li>
			{if $promotion.short_description}
				<a id="sw_promo_description_{$promotion.promotion_id}"class="cm-combination">{$promotion.name|unescape}</a>
				<div id="promo_description_{$promotion.promotion_id}" class="wysiwyg-content hidden">{$promotion.short_description|unescape}</div>
			{else}
				{$promotion.name|unescape}
			{/if}
		</li>
	{/foreach}
	</ul>
<!--applied_promotions--></div>