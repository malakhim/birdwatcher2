{* $Id: cart_content.tpl 12479 2011-05-18 08:54:10Z alexions $ *}

{assign var="result_ids" value="cart_items,checkout_totals,checkout_steps,cart_status*,checkout_cart"}

<form name="checkout_form" class="cm-check-changes" action="{""|fn_url}" method="post" enctype="multipart/form-data">
<input type="hidden" name="redirect_mode" value="cart" />
<input type="hidden" name="result_ids" value="{$result_ids}" />
<h1 class="mainbox-title">
		<span>{$lang.cart_contents}</span>
</h1>
<div class="buttons-container cart-top-buttons clearfix">
	<div class="float-left cart-left-buttons">
		{include file="buttons/continue.tpl" but_href=$continue_url|default:$index_script}
		{include file="buttons/clear_cart.tpl" but_href="checkout.clear" but_role="text" but_meta="cm-confirm nobg"}</div>
	<div class="float-right right cart-right-buttons">
		<div class="float-right">
		{if $payment_methods}
			{assign var="m_name" value="checkout"}
			{assign var="link_href" value="checkout.checkout"}
			{include file="buttons/proceed_to_checkout.tpl" but_href=$link_href}
		{/if}</div>
		<div class="float-right">{include file="buttons/update_cart.tpl" but_id="button_cart" but_name="dispatch[checkout.update]"}</div>
	</div>
</div>

{include file="views/checkout/components/cart_items.tpl" disable_ids="button_cart"}

</form>

{include file="views/checkout/components/checkout_totals.tpl" location="cart"}

<div class="buttons-container cart-bottom-buttons clearfix">
	<div class="float-left">
		{include file="buttons/continue.tpl" but_href=$continue_url|default:$index_script}</div>
	<div class="float-right right cart-right-buttons">
		<div class="float-right">
		{if $payment_methods}
			{assign var="m_name" value="checkout"}
			{assign var="link_href" value="checkout.checkout"}
			{include file="buttons/proceed_to_checkout.tpl" but_href=$link_href}
		{/if}
		</div>
		<div class="float-right">{include file="buttons/update_cart.tpl" but_onclick="$('#button_cart').click()" but_name="dispatch[checkout.update]"}</div>
	</div>
</div>
{if $checkout_add_buttons}
<div class="payment-methods-wrap">
	<div class="payment-methods"><span class="payment-metgods-or">{$lang.or_use}</span>
		<table width="100%" cellpadding="0" cellspacing="0" border="0">
		<tr>
			{foreach from=$checkout_add_buttons item="checkout_add_button"}
				<td>{$checkout_add_button}</td>
			{/foreach}
		</tr>
		</table>
	</div>
</div>
{/if}
