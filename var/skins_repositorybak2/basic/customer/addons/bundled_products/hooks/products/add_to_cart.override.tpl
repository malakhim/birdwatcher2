{*
{if $product.has_options && !$show_product_options && !$details_page || $product.bundle == "Y"}
	{include file="buttons/button.tpl" but_id="button_cart_`$obj_prefix``$obj_id`" but_text=$lang.select_options but_href="products.view?product_id=`$product.product_id`" but_role="text" but_name=""}
{else}
	{if $extra_button}{$extra_button}&nbsp;{/if}
	{if $quick_view}
	<div class="buttons-container">
		<div class="float-right">
	{/if}
		{include file="buttons/add_to_cart.tpl" but_id="button_cart_`$obj_prefix``$obj_id`" but_name="dispatch[checkout.add..`$obj_id`]" but_role=$but_role block_width=$block_width obj_id=$obj_id product=$product}
	{if $quick_view}
		</div>
		{include file="buttons/button.tpl" but_href="products.view?product_id=`$product.product_id`" but_text=$lang.view_details but_name="" but_role=""}
	</div>
	{/if}

	{assign var="cart_button_exists" value=true}
{/if}
*}