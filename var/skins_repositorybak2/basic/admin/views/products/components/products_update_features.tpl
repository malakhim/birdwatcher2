<div id="content_features" class="hidden">

{if $product_data.product_features}
<fieldset>
	{include file="views/products/components/product_assign_features.tpl" product_features=$product_data.product_features}
</fieldset>
{else}
<p class="no-items">{$lang.no_items}</p>
{/if}
</div>