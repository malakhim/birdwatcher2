{if $checkout_buttons[$payment.payment_id]}
	{assign var="has_button" value=true}
{/if}

{assign var="payment_data" value=$payment.payment_id|fn_get_payment_method_data}

<div class="form-payment payment-delim clearfix">
	{if $payment.instructions}
		<div class="other-text other-text-right">
			{$payment.instructions}
		</div>
	{/if}
	
	{if $payment.image}
		<span class="payment-image">
			<label for="payment_{$payment.payment_id}"><img src="{$payment.image.icon.image_path}" border="0" alt="" class="valign" /></label>
		</span>
	{/if}

	<input type="radio" id="payment_{$payment.payment_id}" name="payment_id" value="{$payment.payment_id}" {if $cart.payment_id == $payment.payment_id}checked="checked"{/if} onclick="$.ajaxRequest('{"checkout.update_payment&amp;payment_id=`$payment.payment_id`&amp;active_tab=`$tab_id`"|fn_url:'C':'rel':'&amp;'}', {literal}{method: 'POST', caching: false, force_exec: true, full_render: true, result_ids: {/literal}'checkout*'{literal}}{/literal});" /><label for="payment_{$payment.payment_id}"><strong>{$payment.payment}</strong></label>

	<div class="form-payment-field">
	{if $cart.payment_id == $payment.payment_id}
		{capture name="group_payment"}N{/capture}
	{/if}

	{if $payment.description}
		<p class="description">{$payment.description}</p>
	{/if}

	{if $payment_data.template && $payment_data.template != "cc_outside.tpl" && $cart.payment_id == $payment.payment_id}
		<div>
			{include file="views/orders/components/payments/`$payment_data.template`"}
		</div>
	{/if}
	</div>
</div>