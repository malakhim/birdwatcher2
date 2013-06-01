{strip}

{if !$image_width}
	{if $image.image_x}
		{assign var="image_width" value=$image.image_x}
	{/if}
	{if $image.image_y}
		{assign var="image_height" value=$image.image_y}
	{/if}
{else}
	{if $image.image_x && $image.image_y}
		{math equation="new_x * y / x" new_x=$image_width x=$image.image_x y=$image.image_y format="%d" assign="image_height"}
	{/if}
{/if}

{if !$image.is_flash}
	{if $image.image_x || $href}<a href="{$href|default:$image.image_path|default:$config.no_image_path}" {if !$href}target="_blank"{/if}>{/if}
	<img {if $image_id}id="image_{$object_type}_{$image_id}"{/if} src="{$image.image_path|default:$config.no_image_path|unescape|fn_generate_thumbnail:$image_width:$image_height|escape}" {if $image_width}width="{$image_width}"{/if} {if $image_height}height="{$image_height}"{/if} alt="{$image.alt}" title="{$image.alt}" border="0" />
	{if $image.image_x || $href}</a>{/if}
{else}
<object {if $image_id}id="image_{$object_type}_{$image_id}"{/if} classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" {if $image_width}width="{$image_width}"{/if} {if $image_height}height="{$image_height}"{/if}>
<param name="movie" value="{$image.image_path|default:$config.no_image_path}" />
<param name="quality" value="high" />
<param name="wmode" value="transparent" />
<param name="allowScriptAccess" value="sameDomain" />
<embed src="{$image.image_path|default:$config.no_image_path}" quality="high" wmode="transparent" {if $image_width}width="{$image_width}"{/if} {if $image_height}height="{$image_height}"{/if} allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
</object>
{/if}
{/strip}