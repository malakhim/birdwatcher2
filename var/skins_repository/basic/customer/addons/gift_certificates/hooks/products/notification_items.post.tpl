{if $gift_cert}
	<div class="clearfix">
		{include file="addons/gift_certificates/views/gift_certificates/components/gift_certificates_cart_icon.tpl" width="40" height="40" class="product-notification-image"}
		<div class="product-notification-content">
			<a href="{"gift_certificates.update?gift_cert_id=`$gift_cert.gift_cert_id`"|fn_url}" class="product-notification-product-name">{$lang.gift_certificate}</a>
			<div class="product-notification-price">
			{include file="common_templates/price.tpl" value=$gift_cert.display_subtotal span_id="price_`$gift_cert.gift_cert_id`" class="none"}
			</div>
		</div>
	</div>
{/if}