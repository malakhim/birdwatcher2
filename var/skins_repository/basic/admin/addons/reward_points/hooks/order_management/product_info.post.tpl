{if $cart.points_info.total_price}
	<p>{$lang.price_in_points}:&nbsp;{$cart.products.$key.extra.points_info.price|default:"-"}</p>
{/if}