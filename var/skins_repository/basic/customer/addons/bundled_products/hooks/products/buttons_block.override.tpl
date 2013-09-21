{*{if $product.chains}
	{include file="buttons/button.tpl" but_id="button_cart_`$obj_prefix``$obj_id`" but_text=$lang.select_options but_href="products.view?product_id=`$product.product_id`" but_role="text" but_name=""}
{/if}*}