{if $content|trim}
	{if $anchor}
	<a name="{$anchor}"></a>
	{/if}
	<div class="mainbox2-container{if $block.user_class} {$block.user_class}{/if}{if $content_alignment == 'RIGHT'} float-right{elseif $content_alignment == 'LEFT'} float-left{/if}">
		<h1 class="mainbox2-title clearfix">
			{hook name="wrapper:mainbox_simple_title"}
			{if $smarty.capture.title|trim}
				{$smarty.capture.title}
			{else}
				<span>{$title}</span>
			{/if}
			{/hook}
		</h1>
		<div class="mainbox2-body">{$content|unescape}</div>
		<div class="mainbox2-bottom"><span>&nbsp;</span></div>
	</div>
{/if}