<div class="coupons-container">
	<div class="cm-tools-list code-input discount-coupon">						
		<div class="cm-tools-list code-input gift-certificate">
			<form method="post" action="index.php" name="gift_certificate_payment_form">
				<input type="hidden" value="cart" name="redirect_mode">
				<input type="hidden" value="checkout_steps,cart_status*,checkout_cart" name="result_ids">
				<div class="form-field">
					<input type="text" value="" size="40" name="gift_cert_code" class="input-text" id="gc_field">
					<input type="submit" value="" name="dispatch[checkout.apply_certificate]" class="hidden">
					<span class="code-button">	
					<a rev="gift_certificate_payment_form" name="dispatch:-checkout.apply_certificate-:" class="cm-submit-link text-button">Apply</a></span>
				</div>
			</form>
		</div>
	</div>
</div>