{** block-description:text_links **}

<{if $block.properties.item_number == "Y"}ol{else}ul{/if} class="bullets-list">

{foreach from=$items item="product"}
{assign var="obj_id" value="`$block.block_id`000`$product.product_id`"}
{if $product}
	<li>
		<a href="{"products.view?product_id=`$product.product_id`"|fn_url}">{$product.product|unescape}</a>
	</li>
{/if}
{/foreach}

</{if $block.properties.item_number == "Y"}ol{else}ul{/if}>
