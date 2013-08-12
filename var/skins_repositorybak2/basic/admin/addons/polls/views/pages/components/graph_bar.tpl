{math equation="floor(width / 20) + 1" assign="color" width=$value_width|default:"0"}
{if $color > 5}
	{assign var="color" value="5"}
{/if}
{strip}
<div class="graph-bar-border" style="width: {$bar_width}px; height: 7px;" align="left">
	<div {if $value_width > 0}class="graph-bar-{$color}" style="width: {$value_width}%;"{/if}>
		<img src="{$images_dir}/spacer.gif" width="1" height="7" border="0" alt="" />
	</div>
</div>
{/strip}