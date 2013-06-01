<ul class="statistic-list">
	<li class="subtotal">
		<span class="checkout-item-title">{$lang.subtotal}</span>
		<span class="checkout-item-value">{include file="common_templates/price.tpl" value=$cart.display_subtotal}</span>
	</li>
	
	{hook name="checkout:checkout_totals"}
		{if $cart.shipping_required == true && ($location != "cart" || $settings.General.estimate_shipping_cost == "Y")}
		<li>
		{if $shipping_rates && $cart.shipping}
			<span class="checkout-item-title">
				{foreach from=$cart.shipping item="shipping" key="shipping_id" name="f_shipp"}
					{$shipping.shipping}{if !$smarty.foreach.f_shipp.last}, {/if}
				{/foreach}
				<span class="nowrap">({$smarty.capture.shipping_estimation|trim})</span>
			</span>
			<span class="checkout-item-value">{include file="common_templates/price.tpl" value=$cart.display_shipping_cost}</span>
		{else}
			<span class="checkout-item-title">{$lang.shipping_cost}</span>
			<span class="checkout-item-value">{$smarty.capture.shipping_estimation}</span>
		{/if}
		</li>
		{/if}
	{/hook}
	
	{if ($cart.discount|floatval)}
	<li>
		<span class="checkout-item-title">{$lang.including_discount}</span>
		<span class="checkout-item-value discount-price">-{include file="common_templates/price.tpl" value=$cart.discount}</span>
	</li>
	
	{/if}

	{if ($cart.subtotal_discount|floatval)}
	<li>
		<span class="checkout-item-title">{$lang.order_discount}</span>
		<span class="checkout-item-value discount-price">-{include file="common_templates/price.tpl" value=$cart.subtotal_discount}</span>
	</li>
	{hook name="checkout:checkout_discount"}{/hook}
	{/if}

	{if $cart.taxes}
	<li class="group-title">
		<span class="checkout-item-title">{$lang.taxes}</span>
	</li>
	{foreach from=$cart.taxes item="tax"}
	<li>
		<span class="checkout-item-title">{$tax.description}&nbsp;({include file="common_templates/modifier.tpl" mod_value=$tax.rate_value mod_type=$tax.rate_type}{if $tax.price_includes_tax == "Y" && ($settings.Appearance.cart_prices_w_taxes != "Y" || $settings.General.tax_calculation == "subtotal")}&nbsp;{$lang.included}{/if})</span>
		<span class="checkout-item-value">{include file="common_templates/price.tpl" value=$tax.tax_subtotal}</span>
	</li>
	{/foreach}
	{/if}

	{if $cart.payment_surcharge && !$take_surcharge_from_vendor}
	<li id="payment_surcharge_line">
		{assign var="payment_data" value=$cart.payment_id|fn_get_payment_method_data}
		<span class="checkout-item-title">{$cart.payment_surcharge_title|default:$lang.payment_surcharge}{if $payment_data.payment}&nbsp;({$payment_data.payment}){/if}:</span>
		<span class="checkout-item-value">{include file="common_templates/price.tpl" value=$cart.payment_surcharge span_id="payment_surcharge_value"}</span>
	</li>
	{math equation="x+y" x=$cart.total y=$cart.payment_surcharge assign="_total"}
	{capture name="_total"}{$_total}{/capture}
	{/if}
</ul>