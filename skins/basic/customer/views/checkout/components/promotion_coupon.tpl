<div class="cm-tools-list code-input discount-coupon">
	{if $cart|fn_display_promotion_input_field}
		<form class="cm-ajax cm-ajax-full-render" name="coupon_code_form{$position}" action="{""|fn_url}" method="post">
			<input type="hidden" name="result_ids" value="checkout*,cart_status*,cart_items" />
			<input type="hidden" name="redirect_mode" value="{$location}" />
			<input type="hidden" name="redirect_url" value="{$config.current_url}" />

			{hook name="checkout:discount_coupons"}
				<div class="form-field input-append">
					<label for="coupon_field{$position}" class="hidden cm-required">{$lang.promo_code}</label>
					<input type="text" class="input-text cm-hint" id="coupon_field{$position}" name="coupon_code" size="40" value="{$lang.promo_code}" />
					{include file="buttons/go.tpl" but_name="checkout.apply_coupon" alt=$lang.apply}
				</div>
			{/hook}
		</form>
	{/if}

	{hook name="checkout:applied_discount_coupons"}
		{capture name="promotion_info"}
			{hook name="checkout:applied_coupons_items"}
				{foreach from=$cart.coupons item="coupon" key="coupon_code"}
				<li>
					<span>{$lang.coupon} "{$coupon_code}"
					{assign var="_redirect_url" value=$config.current_url|escape:url}
					{assign var="coupon_code" value=$coupon_code|escape:url}
					{include file="buttons/button.tpl" but_href="checkout.delete_coupon?coupon_code=`$coupon_code`&redirect_url=`$_redirect_url`" but_role="delete" but_meta="cm-ajax cm-ajax-full-render" but_rev="checkout*,cart_status*,cart_items"}
					</span>
				</li>
				{/foreach}
				{if $applied_promotions}
				<li>
					{include file="views/checkout/components/applied_promotions.tpl" location=$location}
				</li>
				{/if}
			{/hook}
		{/capture}

		{if $smarty.capture.promotion_info|trim}
			<ul class="coupon-items discount-info">
				<li class="light-block-arrow-alt"></li>
				{$smarty.capture.promotion_info}
			</ul>
		{/if}
	{/hook}
</div>