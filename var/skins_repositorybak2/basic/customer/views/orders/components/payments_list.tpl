<div class="other-pay clearfix">
	<ul class="paym-methods">
		{foreach from=$payments item="payment"}
			<li><input id="payment_{$payment.payment_id}" class="radio valign" type="radio" name="payment_id" value="{$payment.payment_id}" {if $order_payment_id == $payment.payment_id}checked="checked"{/if} onclick="$.redirect('{"orders.details?order_id=`$order_info.order_id`&payment_id=`$payment.payment_id`"|fn_url}');" /><div class="radio1"><h5><label for="payment_{$payment.payment_id}">{$payment.payment}</label></h5>{$payment.description}</div></li>

			{if $order_payment_id == $payment.payment_id}
				{capture name="group_payment"}N{/capture}
				{if $payment_method.template && $payment_data.template != "cc_outside.tpl"}
					<div>
						{include file="views/orders/components/payments/`$payment_method.template`"}
					</div>
				{/if}
			{/if}
		{/foreach}
	</ul>
	<div class="other-text">
		<h2>{$lang.what_is_other_payment_options}</h2>
		<p>{$lang.other_payment_text}</p>
	</div>
</div>
