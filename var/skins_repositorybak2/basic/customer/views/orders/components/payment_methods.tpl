
{script src="js/tabs.js"}

<div class="tabs cm-j-tabs cm-track clearfix">
	<ul id="payment_tabs">
		{foreach from=$payment_methods key="tab_id" item="payments"}
			{assign var="tab_name" value="payments_`$tab_id`"}
			<li id="payments_{$tab_id}" class="cm-js {if $tab_id == $active_tab || $payments[$order_payment_id]}cm-active{/if}"><a href="">{$lang.$tab_name}</a></li>
		{/foreach}
	</ul>
</div>

<div class="cm-tabs-content clearfix" id="tabs_content">
	{foreach from=$payment_methods key="tab_id" item="payments"}
		<div class="hidden" id="content_payments_{$tab_id}">
			<form action="{""|fn_url}" method="post" name="order_repay_form">
				<input type="hidden" name="order_id" value="{$order_info.order_id}" />

				<div class="hidden">
					<label for="group_payment_{$tab_id}" class="cm-required">&nbsp;</label>
				</div>

				{capture name="group_payment"}Y{/capture}

				{if $payments|count == 1}
					{assign var="payment" value=$payments|reset}
					<input type="hidden" name="payment_id" value="{$payment.payment_id}" />
					
					{assign var="payment_data" value=$payment.payment_id|fn_get_payment_method_data}
					
					{if $payment_data.template}
						{capture name="payment_template"}
							{include file="views/orders/components/payments/`$payment_data.template`"  payment_id=$payment_data.payment_id}
						{/capture}
					{/if}

					{if $payment_data.template && $smarty.capture.payment_template|trim != ""}
						{$smarty.capture.payment_template}
						{capture name="group_payment"}N{/capture}
					{else}
						{include file="views/orders/components/payment_simple.tpl" payment=$payment_data}
					{/if}
				{else}
					{assign var="list_view" value=false}

					{foreach from=$payments item="payment"}
						{if $payment.processor_type == "C"}
							{assign var="list_view" value=true}
						{/if}
					{/foreach}

					{if $list_view}
						{foreach from=$payments item="payment"}
							{assign var="payment_data" value=$payment.payment_id|fn_get_payment_method_data}
							{include file="views/orders/components/payments/payment_simple.tpl"}
						{/foreach}
					{else}
						{include file="views/orders/components/payments_list.tpl" payment=$payments}
					{/if}
				{/if}

				{if $smarty.capture.group_payment == "Y"}
					<div class="hidden">
						<input type="text" name="group_payment_{$tab_id}" id="group_payment_{$tab_id}" value="" />
					</div>
				{/if}

				{include file="views/checkout/components/customer_notes.tpl"}

				<div class="checkout-buttons">
					{if $payment_method.params.button}
						{$payment_method.params.button}
					{else}
						{include file="buttons/button.tpl" but_text=$lang.repay_order but_name="dispatch[orders.repay]" but_role="big"}
					{/if}
				</div>

				<div class="processor-buttons hidden"></div>
			</form>
		<!--content_payments_{$tab_id}--></div>
	{/foreach}
</div>
