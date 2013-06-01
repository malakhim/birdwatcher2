{if $location == "cart" && $cart.shipping_required == true && $settings.General.estimate_shipping_cost == "Y"}
{capture name="shipping_estimation"}
<a id="opener_shipping_estimation_block" class="cm-dialog-opener cm-dialog-auto-size shipping-edit-link" rev="shipping_estimation_block" href="{"checkout.cart"|fn_url}"><span>{if $cart.shipping}{$lang.change}{else}{$lang.calculate}{/if}</span></a>
{/capture}
<div class="hidden" id="shipping_estimation_block" title="{$lang.calculate_shipping_cost}">
	<div class="shipping-estimation">
		{include file="views/checkout/components/shipping_estimation.tpl" location="popup" result_ids="shipping_estimation_link"}
	</div>
</div>
{/if}
<div class="statistic-list-wrap">
	<div class="checkout-totals clearfix" id="checkout_totals">
		{if $cart_products}
			<div class="coupons-container">
				{if $cart.has_coupons}
					{include file="views/checkout/components/promotion_coupon.tpl" location=$location}
				{/if}
					
				{hook name="checkout:payment_extra"}
				{/hook}
				</div>
		{/if}
		
		{hook name="checkout:payment_options"}
		{/hook}
		
		{include file="views/checkout/components/checkout_totals_info.tpl"}
		<div class="clear"></div>
		<ul class="statistic-list total">
				<li class="total">
				<span class="total-title">{$lang.total_cost}</span><span class="checkout-item-value">{include file="common_templates/price.tpl" value=$_total|default:$smarty.capture._total|default:$cart.total span_id="cart_total" class="price"}</span>
				</li>
		</ul>
	<!--checkout_totals--></div>
</div>