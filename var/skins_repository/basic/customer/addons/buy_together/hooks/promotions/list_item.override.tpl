{if $promotion_id != "chains"}
	{include file="common_templates/subheader.tpl" title=$promotion.name}
	{$promotion.detailed_description|default:$promotion.short_description|unescape}
{else}
	{include file="addons/buy_together/blocks/product_tabs/buy_together.tpl" chains=$promotion}
{/if}