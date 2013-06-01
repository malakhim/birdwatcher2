<div class="checkout-summary" id="checkout_info_summary_{$block.snapping_id}">
	<table>
		<tbody class="tbody">
			<tr>
				<td>{$cart.amount} {$lang.items}</td>
				<td class="right">
					<span>{include file="common_templates/price.tpl" value=$cart.display_subtotal}</span>
				</td>
			</tr>

			{if !$cart.shipping_failed}
			<tr>
				<td>{$lang.shipping}</td>
				<td class="right">
					{if !$cart.shipping_required || (!$shipping_failed && ($cart.shipping && !$cart.display_shipping_cost))}
						<span>{$lang.free_shipping}</span>
					{else}
						<span>{include file="common_templates/price.tpl" value=$cart.display_shipping_cost}</span>
					{/if}
				</td>
			</tr>
			{/if}

			{if ($cart.subtotal_discount|floatval)}
				<tr>
					<td>{$lang.order_discount}</td>
					<td class="right discount-price">
						<span>-{include file="common_templates/price.tpl" value=$cart.subtotal_discount}</span>
					</td>
				</tr>
				{hook name="checkout:discount_summary"}
				{/hook}
			{/if}

			{if $cart.payment_surcharge && !$take_surcharge_from_vendor}
				<tr>
					<td>{$cart.payment_surcharge_title|default:$lang.payment_surcharge}</td>
					<td class="right">
						<span>{include file="common_templates/price.tpl" value=$cart.payment_surcharge}</span>
					</td>
				</tr>
				{math equation="x+y" x=$cart.total y=$cart.payment_surcharge assign="_total"}
			{/if}

			{if $cart.taxes}
				<tr>
					<td class="taxes">{$lang.taxes}</td>
					<td class="right taxes">&nbsp;</td>
				</tr>
				{foreach from=$cart.taxes item="tax"}
					<tr>
						<td>{$tax.description}&nbsp;({include file="common_templates/modifier.tpl" mod_value=$tax.rate_value mod_type=$tax.rate_type}{if $tax.price_includes_tax == "Y" && ($settings.Appearance.cart_prices_w_taxes != "Y" || $settings.General.tax_calculation == "subtotal")}&nbsp;{$lang.included}{/if})</td>
						<td class="right">
							<span>{include file="common_templates/price.tpl" value=$tax.tax_subtotal}</span>	
						</td>
					</tr>
				{/foreach}
			{/if}

			{hook name="checkout:summary"}
			{/hook}
			<tr>
				<td colspan="2">
					{include file="views/checkout/components/promotion_coupon.tpl"}
				</td>
			</tr>
		</tbody>
		<tbody class="total">
			<tr>
				<th colspan="2">
					<div>
						{$lang.order_total}
						<span class="total-sum">{include file="common_templates/price.tpl" value=$_total|default:$cart.total}</span>
					</div>
				</th>
			</tr>
		</tbody>
	</table>						
<!--checkout_info_summary_{$block.snapping_id}--></div>