<div class="grid_{$grid.width}{if $grid.prefix} prefix_{$grid.prefix}{/if}{if $grid.suffix} suffix_{$grid.suffix}{/if}{if $grid.alpha} alpha{/if}{if $grid.omega} omega{/if} {$grid.user_class}" >
	{if $content} 
		{$content|unescape}
	{else}
		&nbsp;
	{/if}
</div>
{if $grid.clear}
	<div class="clear"></div>
{/if}