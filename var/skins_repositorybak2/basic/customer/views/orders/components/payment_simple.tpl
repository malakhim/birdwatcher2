<div class="form-payment payment-delim clearfix">
	{if $payment.image}
		<span class="payment-image">
			<label for="payment_{$payment.payment_id}"><img src="{$payment.image.icon.image_path}" border="0" alt="" class="valign" /></label>
		</span>
	{/if}

	<input type="radio" id="payment_{$payment.payment_id}" name="payment_id" value="{$payment.payment_id}" {if $order_payment_id == $payment.payment_id}checked="checked"{/if} onclick="$.redirect('{"orders.details?order_id=`$order_info.order_id`&payment_id=`$payment.payment_id`"|fn_url}');" /><label for="payment_{$payment.payment_id}"><strong>{$payment.payment}</strong></label>

	{if $payment.description}
		<p class="description">{$payment.description}</p>
	{/if}

	{if $order_payment_id == $payment.payment_id}
		{capture name="group_payment"}N{/capture}
		{if $payment_method.template && $payment_method.template != "cc_outside.tpl"}
			<div>
				{include file="views/orders/components/payments/`$payment_method.template`"}
			</div>
		{/if}
	{/if}

	{if $payment.instructions}
		{$payment.instructions}
	{/if}
</div>