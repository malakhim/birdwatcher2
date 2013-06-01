{if $cart.products.$key.extra.configuration}
{foreach from=$cart_products item="_product" key="key_conf"}
	{if $cart.products.$key_conf.extra.parent.configuration == $key}
		{capture name="is_conf_prod"}1{/capture}
	{/if}
{/foreach}

{if $smarty.capture.is_conf_prod}
	<p><a rev="configuration_{$key}" class="cm-dialog-opener cm-dialog-auto-size">{$lang.configuration}</a></p>

	<div class="product-options hidden" id="configuration_{$key}" title="{$lang.configuration}">
		<table cellpadding="0" cellspacing="0" border="0" class="table margin-top cart-configuration">
			<tr>
				<th width="50%">{$lang.product}</th>
				<th width="10%">{$lang.price}</th>
				<th width="10%">{$lang.qty}</th>
				<th class="right" width="10%">{$lang.subtotal}</th>
			</tr>
			{foreach from=$cart_products item="_product" key="key_conf"}
			{if $cart.products.$key_conf.extra.parent.configuration == $key}
			<tr {cycle values=",class=\"table-row\""}>
				<td>{if $_product.is_accessible}<a href="{"products.view?product_id=`$_product.product_id`"|fn_url}">{$_product.product}</a>{else}{$_product.product}{/if}</td>
				<td class="center">
					{include file="common_templates/price.tpl" value=$_product.price}</td>
				<td class="center">
					<input type="hidden" name="cart_products[{$key_conf}][product_id]" value="{$_product.product_id}" />
					{$_product.amount}
				</td>
				<td class="right">
					{include file="common_templates/price.tpl" value=$_product.display_subtotal}
				</td>
			</tr>
			{/if}
			{/foreach}
			<tr class="table-footer">
				<td colspan="4">&nbsp;</td>
			</tr>
		</table>
	</div>
{/if}
{/if}