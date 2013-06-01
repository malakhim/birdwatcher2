{script src="js/tabs.js"}

<div class="step-container{if $edit}-active{/if}" id="step_four">
	{if $settings.General.checkout_style != "multi_page"}
		<h2 class="step-title{if $edit}-active{/if} clearfix">
			<span class="float-left">{if $profile_fields.B || $profile_fields.S}4{else}3{/if}</span>
			
			{hook name="checkout:edit_link_title"}
			<a class="title{if $complete && !$edit} cm-ajax cm-ajax-force{/if}" {if $complete && !$edit}href="{"checkout.checkout?edit_step=step_four&amp;from_step=`$edit_step`"|fn_url}" rev="checkout_*"{/if}>{$lang.billing_options}</a>
			{/hook}
		</h2>
	{/if}

	<div id="step_four_body" class="step-body{if $edit}-active{/if} {if !$edit}hidden{/if}">
		<div class="clearfix">
			
			{if $cart|fn_allow_place_order}
				{if $edit}
					<div class="clearfix">

						{if $cart.payment_id}
							{include file="views/checkout/components/payments/payment_methods.tpl" no_mainbox="Y"}
						{else}
							<div class="checkout-inside-block"><h2 class="subheader">{$lang.text_no_payments_needed}</h2></div>

							<form name="paymens_form" action="{""|fn_url}" method="post">
								<div class="checkout-buttons">
									{include file="buttons/place_order_new.tpl" but_text=$lang.submit_my_order but_name="dispatch[checkout.place_order]" but_role="big" but_id="place_order"}	
								</div>
							</form>
						{/if}
					</div>
				{/if}

			{else}
				{if $cart.shipping_failed}
					<p class="error-text center">{$lang.text_no_shipping_methods}</p>
				{/if}

				{if $cart.amount_failed}
					<div class="checkout-inside-block">
						<p class="error-text">{$lang.text_min_order_amount_required}&nbsp;<strong>{include file="common_templates/price.tpl" value=$settings.General.min_order_amount}</strong></p>
					</div>
				{/if}

				<div class="checkout-buttons">
					{include file="buttons/continue_shopping.tpl" but_href=$continue_url|default:$index_script but_role="action"}
				</div>
				
			{/if}
		</div>
	</div>
<!--step_four--></div>