{if $order_info.gift_certificates}
{foreach from=$order_info.gift_certificates item="gift" key="gift_key"}
<tr>
	<td>
		<div class="float-right">{include file="buttons/button_popup_link.tpl" but_href="gift_certificates.print?order_id=`$order_info.order_id`&gift_cert_cart_id=`$gift_key`" but_text=$lang.print_card but_role="text" width="750" height="350"}</div>
		<span class="product-title">{$lang.gift_certificate}</span>
		{if $gift.gift_cert_code}
		<p class="code">{$lang.code}:<a href="{"gift_certificates.verify?verify_code=`$gift.gift_cert_code`"|fn_url}">{$gift.gift_cert_code}</a></p>
		{/if}
		<div class="details-block">
			<a id="sw_options_{$gift_key}" class="cm-combo-on cm-combination"><i>{$lang.text_click_here}</i></a>
			<div id="options_{$gift_key}" class="details-block-box hidden">
				<div class="gray-block-arrow"></div>
				<div class="details-block-field">
					<label>{$lang.gift_cert_to}:</label>
					<span>{$gift.recipient}</span>
				</div>
				<div class="details-block-field">
					<label>{$lang.gift_cert_from}:</label>
					<span>{$gift.sender}</span>
				</div>
				<div class="details-block-field">
					<label>{$lang.amount}:</label>
					<span>{include file="common_templates/price.tpl" value=$gift.amount}</span>
				</div>
				<div class="details-block-field">
					<label>{$lang.send_via}:</label>
					<span>{if $gift.send_via == "E"}{$lang.email}{else}{$lang.postal_mail}{/if}</span>
				</div>
			</div>
		</div>
	</td>
	
	<td class="right nowrap">{if !$gift.extra.exclude_from_calculate}{include file="common_templates/price.tpl" value=$gift.display_subtotal}{else}{$lang.free}{/if}</td>
	<td class="center">&nbsp;1</td>
	<td class="right nowrap">{if !$gift.extra.exclude_from_calculate}{include file="common_templates/price.tpl" value=$gift.display_subtotal}{else}{$lang.free}{/if}</td>
</tr>	
{/foreach}

{/if}