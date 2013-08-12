{if $block.properties.scroller_direction == "up" || $block.properties.scroller_direction == "left"}
	{assign var="scroller_direction" value="next"}
	{assign var="scroller_event" value="onAfterAnimation"}
{else}
	{assign var="scroller_direction" value="prev"}
	{assign var="scroller_event" value="onBeforeAnimation"}
{/if}
{if $block.properties.scroller_direction == "left" || $block.properties.scroller_direction == "right"}
	{assign var="scroller_vert" value="false"}
	{math equation="item_quantity * item_width" assign="clip_width" item_width=$item_width item_quantity=$block.properties.item_quantity|default:1}
	{assign var="clip_height" value=$item_height}
{else}
	{assign var="scroller_vert" value="true"}
	{assign var="clip_width" value=$item_width}
	{math equation="item_quantity * item_height" assign="clip_height" item_height=$item_height item_quantity=$block.properties.item_quantity|default:1}
{/if}

<script type="text/javascript">
//<![CDATA[
$(function() {$ldelim}
	$('#scroll_list_{$block.block_id}').show();
	$('#scroll_list_{$block.block_id}').jcarousel({$ldelim}
		vertical: {$scroller_vert},
		size: {if $items|count > $block.properties.item_quantity}{$items|count|default:"null"}{else}{$block.properties.item_quantity|default:1}{/if},
		scroll: {if $block.properties.scroller_direction == "right" || $block.properties.scroller_direction == "down"}-{/if}{$block.properties.item_quantity|default:1},
		animation: '{$block.properties.speed}',
		easing: '{$block.properties.easing}',
		{if $block.properties.not_scroll_automatically == "Y"}
		auto: 0,
		{else}
		auto: '{$block.properties.pause_delay|default:0}',
		{/if}
		autoDirection: '{$scroller_direction}',
		wrap: 'circular',
		initCallback: $.ceScrollerMethods.init_callback,
		itemVisibleOutCallback: {$ldelim}{$scroller_event}: $.ceScrollerMethods.in_out_callback{$rdelim},
		item_width: {$item_width},
		item_height: {$item_height},
		clip_width: {$clip_width},
		clip_height: {$clip_height},
		item_count: {$items|sizeof}
	{$rdelim});
{$rdelim});
//]]>
</script>