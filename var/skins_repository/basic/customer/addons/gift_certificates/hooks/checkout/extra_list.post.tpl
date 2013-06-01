{if $cart.gift_certificates}

{foreach from=$cart.gift_certificates item="gift" key="gift_key" name="f_gift_certificates"}
{assign var="obj_id" value=$gift.object_id|default:$gift_key}
{if !$smarty.capture.prods}
	{capture name="prods"}Y{/capture}
{/if}
<tr>
	<td valign="top" class="product-image-cell">
	{if $mode == "cart" || $show_images}
	<div class="product-image cm-reload-{$obj_id}" id="product_image_update_{$obj_id}">
		{if !$gift.extra.exclude_from_calculate}
			<a href="{"gift_certificates.update?gift_cert_id=`$gift_key`"|fn_url}">
			{include file="addons/gift_certificates/views/gift_certificates/components/gift_certificates_cart_icon.tpl" width=$settings.Thumbnails.product_cart_thumbnail_width height=$settings.Thumbnails.product_cart_thumbnail_height}
			</a>
			<p class="center">{include file="buttons/button.tpl" but_text=$lang.edit but_href="gift_certificates.update?gift_cert_id=$gift_key" but_role="text"}</p>
		{else}
			{include file="addons/gift_certificates/views/gift_certificates/components/gift_certificates_cart_icon.tpl" width=$settings.Thumbnails.product_cart_thumbnail_width height=$settings.Thumbnails.product_cart_thumbnail_height}
		{/if}
	<!--product_image_update_{$obj_id}--></div>
	</td>
	<td class="product-description" width="50%" valign="top">
	{/if}
		{if !$gift.extra.exclude_from_calculate}
			<a href="{"gift_certificates.update?gift_cert_id=`$gift_key`"|fn_url}" class="product-title">{$lang.gift_certificate}{if !$gift.extra.exclude_from_calculate}<a class="{$ajax_class} icon-delete-big" href="{"gift_certificates.delete?gift_cert_id=`$gift_key`&amp;redirect_mode=`$mode`"|fn_url}"  rev="cart_items,checkout_totals,cart_status*,checkout_steps,checkout_cart" title="{$lang.remove}"></a>{/if}</a>&nbsp;
			{if $use_ajax == true && $cart.amount != 1}
				{assign var="ajax_class" value="cm-ajax"}
			{/if}
		{else}
			<strong>{$lang.gift_certificate}</strong>
		{/if}
		<div class="form-field product-list-field">
			<label class="valign">{$lang.gift_cert_to}:</label><span>{$gift.recipient}</span>
		</div>
		<div class="form-field product-list-field">
			<label class="valign">{$lang.gift_cert_from}:</label><span>{$gift.sender}</span>
		</div>
		<div class="form-field product-list-field">
			<label class="valign">{$lang.amount}:</label><span>{include file="common_templates/price.tpl" value=$gift.amount}</span>
		</div>
		<div class="form-field product-list-field">
			<label class="valign">{$lang.send_via}:</label><span>{if $gift.send_via == "E"}{$lang.email}{else}{$lang.postal_mail}{/if}</span>
		</div>
		{if $gift.products && $addons.gift_certificates.free_products_allow == "Y" && !$gift.extra.exclude_from_calculate}
		
		<p><a id="sw_gift_products_{$gift_key}" class="cm-combo-on cm-combination">{$lang.free_products}</a></p>

		<div id="gift_products_{$gift_key}" class="product-options hidden">
			<table cellpadding="0" cellspacing="0" border="0" class="table fixed-layout" width="100%">
			<tr>
				<th width="40%">{$lang.product}</th>
				<th width="15%">{$lang.price}</th>
				<th width="15%">{$lang.qty}</th>
				{if $cart.use_discount}
				<th width="15%">{$lang.discount}</th>
				{/if}
				{if $cart.taxes && $settings.General.tax_calculation != "subtotal"}
				<th width="15%">{$lang.tax}</th>
				{/if}
				<th class="right" width="16%">{$lang.subtotal}</th>
			</tr>
			{foreach from=$cart_products item="product" key="key"}
			{if $cart.products.$key.extra.parent.certificate == $gift_key}
			<tr {cycle values=",class=\"table-row\""}>
				<td width="30%">
					<a href="{"products.view?product_id=`$product.product_id`"|fn_url}" title="{$product.product|unescape}">{$product.product|unescape|strip_tags|truncate:70:"...":true}</a>
					{if $use_ajax == true}
						{assign var="ajax_class" value="cm-ajax"}
					{/if}
					<a class="{$ajax_class} icon-delete-big" href="{"checkout.delete?cart_id=`$key`&amp;redirect_mode=`$mode`"|fn_url}" rev="cart_items,checkout_totals,cart_status*,checkout_steps" title="{$lang.remove}"></a>
					<p>{include file="common_templates/options_info.tpl" product_options=$cart.products.$key.product_options|fn_get_selected_product_options_info fields_prefix="cart_products[`$key`][product_options]"}</p>
					{hook name="checkout:product_info"}{/hook}
					<input type="hidden" name="cart_products[{$key}][extra][parent][certificate]" value="{$gift_key}" /></td>
				<td class="center">
					{include file="common_templates/price.tpl" value=$product.original_price}</td>
				<td class="center">
					<input type="text" size="3" name="cart_products[{$key}][amount]" value="{$product.amount}" class="input-text-short" {if $product.is_edp == "Y"}readonly="readonly"{/if} />
					<input type="hidden" name="cart_products[{$key}][product_id]" value="{$product.product_id}" /></td>
				{if $cart.use_discount}
				<td class="center">
					{if $product.discount|floatval}{include file="common_templates/price.tpl" value=$product.discount}{else}-{/if}</td>
				{/if}
				{if $cart.taxes && $settings.General.tax_calculation != "subtotal"}
				<td class="center">
					{include file="common_templates/price.tpl" value=$product.tax_summary.total}</td>
				{/if}
				<td class="right">
					{include file="common_templates/price.tpl" value=$product.display_subtotal}</td>
			</tr>
			{/if}
			{/foreach}
			</table>
			<div class="form-field product-list-field float-right nowrap">
				<p><label class="valign">{$lang.price_summary}:</label>
				{if !$gift.extra.exclude_from_calculate}{include file="common_templates/price.tpl" value=$gift.display_subtotal class="price"}{else}<span class="price">{$lang.free}</span>{/if}</p>
			</div>
			<div class="clear"></div>
		</div>
		{/if}
	</td>
	<td class="right price-cell cm-reload-{$obj_id}" id="price_display_update_{$obj_id}">
		{if !$gift.extra.exclude_from_calculate}{include file="common_templates/price.tpl" value=$gift.display_subtotal class="sub-price"}{else}<span class="price">{$lang.free}</span>{/if}
	<!--price_display_update_{$obj_id}--></td>
	<td class="quantity-cell center">
	</td>
	<td class="right price-cell cm-reload-{$obj_id}" id="price_subtotal_update_{$obj_id}">
		{if !$gift.extra.exclude_from_calculate}{include file="common_templates/price.tpl" value=$gift.display_subtotal class="price"}{else}<span class="price">{$lang.free}</span>{/if}
	<!--price_subtotal_update_{$obj_id}--></td>
</tr>
{/foreach}

{/if}
