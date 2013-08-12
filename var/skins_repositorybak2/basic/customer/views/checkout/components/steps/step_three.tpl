<div class="step-container{if $edit}-active{/if}" id="step_three">
	{if $settings.General.checkout_style != "multi_page"}
		<h2 class="step-title{if $edit}-active{/if}{if $complete && !$edit}-complete{/if} clearfix">
			<span class="float-left">{if !$complete || $edit}{if $profile_fields.B || $profile_fields.S}3{else}2{/if}{/if}</span>

			{if $complete && !$edit}
				{hook name="checkout:edit_link"}
				<span class="float-right">
					{include file="buttons/button.tpl" but_meta="cm-ajax" but_href="checkout.checkout?edit_step=step_three&amp;from_step=$edit_step" but_rev="checkout_*" but_text=$lang.change but_role="tool"}
				</span>
				{/hook}
			{/if}
			
			{hook name="checkout:edit_link_title"}
			<a class="title{if $complete && !$edit} cm-ajax cm-ajax-force{/if}" {if $complete && !$edit}href="{"checkout.checkout?edit_step=step_three&amp;from_step=`$edit_step`&amp;is_ajax=1"|fn_url}" rev="checkout_*"{/if}>{$lang.shipping_options}</a>
			{/hook}
		</h2>
	{/if}

	<div id="step_three_body" class="step-body{if $edit}-active{/if} {if !$edit}hidden{/if} clearfix">
		{if $edit}
			<form name="step_three_payment_and_shipping" class="{$ajax_form} {$ajax_form_force} cm-ajax-full-render" action="{""|fn_url}" method="{if !$edit}get{else}post{/if}">
				<input type="hidden" name="update_step" value="step_three" />
				<input type="hidden" name="next_step" value="step_four" />
				<input type="hidden" name="result_ids" value="checkout*" />
				
				<div class="clearfix">
					<div class="checkout-inside-block">
					{hook name="checkout:select_shipping"}
						{if !$cart.shipping_failed}
							{include file="views/checkout/components/shipping_rates.tpl" no_form=true display="radio"}
						{else}
							<p class="error-text">{$lang.text_no_shipping_methods}</p>
						{/if}
					{/hook}
				
					
					
					{if $edit}
						{include file="views/checkout/components/customer_notes.tpl"}
						<div class="shipping-tips">
						<p>{$lang.delivery_times_text}</p>
							{$lang.shipping_tips}
						</div>
					{/if}
					</div>
				</div>
				
				<div class="checkout-buttons">
					{include file="buttons/button.tpl" but_name="dispatch[checkout.update_steps]" but_text=$but_text but_id="step_three_but"}
				</div>
			</form>
		{/if}
	</div>
<!--step_three--></div>