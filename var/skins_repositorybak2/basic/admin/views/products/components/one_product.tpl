{assign var="obj_id" value="`$obj_prefix``$product.product_id`"}
<div class="search-result">
	<span>{$product.result_number}.</span> <a href="{"products.update?product_id=`$product.product_id`"|fn_url}" class="list-product-title">{$product.product|unescape}</a>
	{if $product.short_description || $product.full_description}
	<p>
	{if $product.short_description}
		{$product.short_description|unescape}
	{else}
		{$product.full_description|unescape|strip_tags|truncate:380:"..."}
	{/if}
	</p>
	{/if}
</div>