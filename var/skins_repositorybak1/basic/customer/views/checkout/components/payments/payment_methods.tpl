{script src="js/tabs.js"}

{if $settings.General.checkout_style == "multi_page"}
	{assign var="extra_ids" value=",step_four"}
{/if}

{if $payment_methods|count > 1}
<div class="tabs cm-j-tabs cm-track clearfix">
	<ul id="payment_tabs">
		{foreach from=$payment_methods key="tab_id" item="payments"}
			{assign var="tab_name" value="payments_`$tab_id`"}
			<li id="payments_{$tab_id}" class="cm-ajax cm-ajax-force {if $tab_id == $active_tab || (!$active_tab && $payments[$cart.payment_id])}cm-active{assign var="active" value=$tab_id}{/if}">
				<a class="cm-ajax cm-ajax-force cm-ajax-full-render" rev="checkout*{$extra_ids}" href="{"checkout.checkout.payments?active_tab=`$tab_id`"|fn_url}">{$lang.$tab_name}</a>
			</li>
		{/foreach}
	</ul>
</div>
{/if}

<div class="cm-tabs-content clearfix" id="tabs_content">
	{foreach from=$payment_methods key="tab_id" item="payments"}
		<div class="{if $active != $tab_id && $payment_methods|count > 1}hidden{/if}" id="content_payments_{$tab_id}">
			<form name="payments_form_{$tab_id}" action="{""|fn_url}" method="post">
			<div class="checkout-billing-options {if $payment_methods|count == 1}notab{/if}">
				<div class="hidden">
					<label for="group_payment_{$tab_id}" class="cm-required">&nbsp;</label>
				</div>

				{capture name="group_payment"}Y{/capture}
				{capture name="require_payment"}N{/capture}

				{if $payments|count == 1}
					{assign var="payment" value=$payments|reset}
					<input type="hidden" name="payment_id" value="{$payment.payment_id}" />
					
					{assign var="payment_data" value=$payment.payment_id|fn_get_payment_method_data}
					
					{if $payment_data.template}
						{capture name="payment_template"}
							{include file="views/orders/components/payments/`$payment_data.template`" card_id=$payment.payment_id}
						{/capture}
					{/if}

					{if $payment_data.template && $smarty.capture.payment_template|trim != ""}
						<div class="clearfix">
							<div class="other-text other-text-right">{$payment_data.instructions nofilter}</div>
							{$smarty.capture.payment_template nofilter}
						</div>
					{else}
						{include file="views/checkout/components/payments/payment_simple.tpl" payment=$payment_data}
						{if $cart.payment_id != $payment_data.payment_id}
							{capture name="require_payment"}Y{/capture}
						{/if}
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
							{include file="views/checkout/components/payments/payment_simple.tpl" payment=$payment_data active_tab=$tab_id}
						{/foreach}
					{else}
						{include file="views/checkout/components/payments/payments_list.tpl" payment=$payments active_tab=$tab_id}
					{/if}
				{/if}
				
				{if $smarty.capture.require_payment == "Y" || ($smarty.capture.group_payment == "Y" && $payments|count > 1)}
					<div class="hidden">
						<input type="text" name="group_payment_{$tab_id}" id="group_payment_{$tab_id}" value="" />
					</div>
				{/if}

				{include file="views/checkout/components/terms_and_conditions.tpl" suffix=$tab_id}

				{assign var="show_checkout_button" value=false}
				{foreach from=$payments item="payment"}
					{if $cart.payment_id == $payment.payment_id && $checkout_buttons[$cart.payment_id]}
						{assign var="show_checkout_button" value=true}
					{/if}
				{/foreach}

				{if $auth.act_as_user}
					<div class="select-field">
						<input type="checkbox" id="skip_payment" name="skip_payment" value="Y" class="checkbox" />
						<label for="skip_payment">{$lang.skip_payment}</label>
					</div>
				{/if}

				{hook name="checkout:extra_payment_info"}{/hook}
				</div>

				{if $iframe_mode}
					<div class="payment-method-iframe-box">
						<iframe width="100%" height="700" id="order_iframe_{$smarty.const.TIME}" src="{"checkout.process_payment"|fn_url:$smarty.const.AREA:'checkout'}" style="border: 0px" frameBorder="0" ></iframe>
						{if $cart_agreements || $settings.General.agree_terms_conditions == "Y"}
						<div id="payment_method_iframe{$tab_id}" class="payment-method-iframe">
							<div class="payment-method-iframe-label">
								<div class="payment-method-iframe-text">{$lang.checkout_terms_n_conditions_alert}</div>
							</div>
						</div>
						{/if}
					</div>
				{else}
					<div class="checkout-buttons">
						{if !$show_checkout_button}
							{include file="buttons/place_order_new.tpl" but_text=$lang.submit_my_order but_name="dispatch[checkout.place_order]" but_role="big" but_id="place_order_`$tab_id`"}	
						{/if}
					</div>
				{/if}

				<div class="processor-buttons hidden"></div>
			</form>

			{if $show_checkout_button}
				{$checkout_buttons[$cart.payment_id]}
			{/if}
		<!--content_payments_{$tab_id}--></div>
	{/foreach}
</div>