{if $product.item_type == "G"}
	{$lang.gift_certificate}
{/if}
{if $product.item_type == "C"}
	<a href="{"products.update?product_id=`$product.product_id`"|fn_url}">{$product.product|unescape}</a>
{/if}