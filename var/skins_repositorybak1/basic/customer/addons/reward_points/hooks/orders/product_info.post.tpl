{if $order_info.points_info.price && $product}
	<div class="product-list-field">
		<label>{$lang.price_in_points}:</label>
		{$product.extra.points_info.price}
	</div>
{/if}