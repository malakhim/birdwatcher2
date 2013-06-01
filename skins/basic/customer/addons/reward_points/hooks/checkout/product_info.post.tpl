{if !$cart.products.$key.extra.configuration}
	{if $cart.products.$key.extra.points_info.price}
	<div class="product-list-field">
		<label for="price_in_points_{$key}" class="valign">{$lang.price_in_points}:</label>
		<span id="price_in_points_{$key}">{$cart.products.$key.extra.points_info.display_price}&nbsp;{$lang.points_lower}</span>
	</div>
	{/if}
	{if $cart.products.$key.extra.points_info.reward}
	<div class="product-list-field">
		<label for="reward_points_{$key}" class="valign">{$lang.reward_points}:</label>
		<span id="reward_points_{$key}">{$cart.products.$key.extra.points_info.reward}&nbsp;{$lang.points_lower}</span>
	</div>
	{/if}
{/if}