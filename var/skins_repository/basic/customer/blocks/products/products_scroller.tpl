{** block-description:scroller **}

{if $scrollers_initialization != "Y"}
<script type="text/javascript">
//<![CDATA[
var scroller_directions = "";
var scrollers_list = [];
//]]>
</script>
{capture name="scrollers_initialization"}Y{/capture}
{/if}

{assign var="obj_prefix" value="`$block.block_id`000"}

{assign var="delim_width" value="50"}
{math equation="delim_w + image_w" assign="item_width" image_w=$block.properties.thumbnail_width delim_w = $delim_width}
{assign var="item_qty" value=$block.properties.item_quantity}

	<ul id="scroll_list_{$block.block_id}" class="jcarousel jcarousel-skin hidden">
		{assign var="image_h" value=$block.properties.thumbnail_width}
		{assign var="text_h" value="65"}
		{if $block.properties.hide_add_to_cart_button == "N"}
		{math equation="text_h + 20" assign="text_h" text_h=$text_h}
		{/if}
		{if $block.properties.show_price == "Y"}
		{math equation="text_h + 20" assign="text_h" text_h=$text_h}
		{/if}

		{math equation="item_qty + image_h + text_h" assign="item_height" image_h=$image_h text_h=$text_h item_qty=$item_qty}

		{foreach from=$items item="product" name="for_products"}
			<li>
			{assign var="obj_id" value="scr_`$block.block_id`000`$product.product_id`"}
			{assign var="img_object_type" value="product"}
			{include file="common_templates/image.tpl" assign="object_img" image_width=$block.properties.thumbnail_width image_height=$block.properties.thumbnail_width images=$product.main_pair no_ids=true object_type=$img_object_type show_thumbnail="Y"}
			<div class="jscroll-item" width="{$item_width}">
				<div class="center product-image" style="height: {$image_h}px;">
					<a href="{"products.view?product_id=`$product.product_id`"|fn_url}">{$object_img}</a>
					{if $block.properties.enable_quick_view == "Y"}
					{include file="views/products/components/quick_view_link.tpl"}
					{/if}
				</div>
				<div class="center compact"{if $block.properties.scroller_direction == "up" || $block.properties.scroller_direction == "down"} style="height: {$text_h}px;"{/if}>
					{if $block.properties.hide_add_to_cart_button == "Y"}
						{assign var="_show_add_to_cart" value=false}
					{else}
						{assign var="_show_add_to_cart" value=true}
					{/if}
					{if $block.properties.show_price == "Y"}
						{assign var="_hide_price" value=false}
					{else}
						{assign var="_hide_price" value=true}
					{/if}
					{strip}
					{include file="blocks/list_templates/simple_list.tpl" product=$product show_trunc_name=true show_price=true show_add_to_cart=$_show_add_to_cart but_role="text" hide_price=$_hide_price}
					{/strip}
				</div>
			</div>
			</li>
		{/foreach}
	</ul>

{script src="lib/js/jcarousel/jquery.jcarousel.js"}
{include file="common_templates/scroller_init.tpl"}