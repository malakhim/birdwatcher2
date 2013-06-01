{if $settings.General.checkout_style == "multi_page"}
	{assign var="additional_ids" value=",step_three"}
{/if}

{if $cart_products && $cart.points_info.total_price && $user_info.points > 0}
<div class="coupons-container">
	<div id="point_payment" class="code-input discount-coupon">
		<form class="cm-ajax" name="point_payment_form" action="{""|fn_url}" method="post">
		<input type="hidden" name="redirect_mode" value="{$location}" />
		<input type="hidden" name="result_ids" value="checkout_totals,checkout_steps{$additional_ids}" />
		
		<div class="form-field input-append reward-points">
			<input type="text" class="input-text valign cm-hint" name="points_to_use" size="40" value="{$lang.points_to_use}" />
			{include file="buttons/go.tpl" but_name="checkout.point_payment" alt=$lang.apply}
			<input type="submit" class="hidden" name="dispatch[checkout.point_payment]" value="" />
		</div>
		</form>
		<div class="discount-info">
			<span class="light-block-arrow-alt"></span>
			<span class="block">{$lang.text_point_in_account}&nbsp;{$user_info.points}&nbsp;{$lang.points_lower}.</span>
			
			{if $cart.points_info.in_use.points}
				{assign var="_redirect_url" value=$config.current_url|escape:url}
				{if $use_ajax}{assign var="_class" value="cm-ajax"}{/if}
				<span class="points-in-use">{$cart.points_info.in_use.points}&nbsp;{$lang.points_in_use_lower}.&nbsp;({include file="common_templates/price.tpl" value=$cart.points_info.in_use.cost}){if $settings.General.checkout_style != "multi_page"}&nbsp;{include file="buttons/button.tpl" but_href="checkout.delete_points_in_use?redirect_url=`$_redirect_url`" but_meta="delete-icon" but_role="delete" but_rev="checkout*,cart_status*,subtotal_price_in_points"}{/if}</span>
			{/if}
		</div>
</div>		
	<!--point_payment--></div>
{/if}