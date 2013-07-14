{if $promotion_id != "chains"}
	{include file="common_templates/subheader.tpl" title=$promotion.name}
	{$promotion.detailed_description|default:$promotion.short_description|unescape}
{else}
	{include file="addons/bundled_products/blocks/bundled_products.tpl" chains=$promotion}
{/if}

