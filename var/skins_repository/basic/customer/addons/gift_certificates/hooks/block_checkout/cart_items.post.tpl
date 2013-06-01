{if $cart.gift_certificates}
{foreach from=$cart.gift_certificates item="gift" key="gift_key" name="f_gift_certificates"}
	<li>
		{if !$gift.extra.exclude_from_calculate}
			<a href="{"gift_certificates.update?gift_cert_id=`$gift_key`"|fn_url}" class="product-name">{$lang.gift_certificate}</a>{include file="buttons/button.tpl" but_href="gift_certificates.delete?gift_cert_id=`$gift_key`&amp;redirect_mode=`$mode`" but_meta="delete" but_rev="cart_status*" but_role="delete" but_name="delete_cart_item"}
		{else}
			<strong>{$lang.gift_certificate}</strong>
		{/if}
		<span class="product-price">{include file="common_templates/price.tpl" value=$gift.display_subtotal}</span>
	</li>
{/foreach}
{/if}