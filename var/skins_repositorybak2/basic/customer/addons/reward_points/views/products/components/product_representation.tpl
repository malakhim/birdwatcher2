{if $product.points_info.price}
	<div class="form-field{if !$capture_options_vs_qty} product-list-field{/if}">
		<label>{$lang.price_in_points}:</label>
		<span id="price_in_points_{$obj_prefix}{$obj_id}">{$product.points_info.price}&nbsp;{$lang.points_lower}</span>
	</div>
{/if}
<div class="form-field product-list-field{if !$product.points_info.reward.amount} hidden{/if}">
	<label>{$lang.reward_points}:</label>
	<span id="reward_points_{$obj_prefix}{$obj_id}" >{$product.points_info.reward.amount}&nbsp;{$lang.points_lower}</span>
</div>