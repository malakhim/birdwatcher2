<div class="form-field input-append">
	<label for="coupon_field{$position}" class="hidden cm-required">{$lang.promo_code}</label>
	<input type="text" class="input-text cm-hint" id="coupon_field{$position}" name="coupon_code" size="40" value="{$lang.promo_code_or_certificate}" />
	{include file="buttons/go.tpl" but_name="checkout.apply_coupon" alt=$lang.apply}
</div>