{if $product.product_type == "C" && !$product.configuration_mode}
	<div class="buttons-container">
		{if $quick_view}
		{assign var="but_role" value="submit"}
		{else}
		{assign var="but_role" value="text"}
		{/if}
		{include file="buttons/button.tpl" but_text=$lang.configure but_role=$but_role but_href="products.view?product_id=`$product.product_id`"}
	</div>
{/if}