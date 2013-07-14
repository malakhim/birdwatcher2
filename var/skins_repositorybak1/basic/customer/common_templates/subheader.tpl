{if $anchor}
<a name="{$anchor}"></a>
{/if}
<h2 class="{$class|default:"subheader"}">
	{$extra}
	{$title}

	{if $tooltip|trim}
		{include file="common_templates/tooltip.tpl" tooltip=$tooltip}
	{/if}
</h2>