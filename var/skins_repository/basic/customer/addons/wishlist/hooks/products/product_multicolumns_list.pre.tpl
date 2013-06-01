{if $is_wishlist}
<div class="center">
	<a href="{"wishlist.delete?cart_id=`$product.cart_id`"|fn_url}" class="icon-delete-small" title="{$lang.remove}">{$lang.remove}</a>
</div>
{/if}