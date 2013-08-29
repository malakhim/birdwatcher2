{if $product}
	{assign var="obj_id" value=$product.product_id}

	{assign var="obj_id" value=$product.product_id}
	{include file="common_templates/product_data.tpl" product=$product}
	{assign var="form_open" value="form_open_`$obj_id`"}
	{$smarty.capture.$form_open}

	{if !$no_images}
		<div class="image-border float-left center cm-reload-{$product.product_id}" id="product_images_{$product.product_id}_update">
			{include file="views/products/components/product_images.tpl" product=$product show_detailed_link="Y"}
		<!--product_images_{$product.product_id}_update--></div>
	{/if}
	
	<div class="product-info">
		{assign var="form_open" value="form_open_`$obj_id`"}
		{$smarty.capture.$form_open}

		{if !$hide_title}<h1 class="mainbox-title">{$product.product|unescape}</h1>{/if}
		{assign var="rating" value="rating_`$obj_id`"}{$smarty.capture.$rating}
		{assign var="sku" value="sku_$obj_id"}{$smarty.capture.$sku}
		{assign var="bid_price" value="`$price`"}

		<div class="{if $bid_price|trim}prices-container {/if}price-wrap clearfix">
			{if $bid_price|trim}
				<div class="float-left product-prices">
					{if $bid_price|trim}{$bid_price}&nbsp;{/if}
			{/if}
		</div>

		{if $show_descr}
			{assign var="prod_descr" value="prod_descr_`$obj_id`"}
			<h2 class="description-title">{$lang.description}</h2>
			<p class="product-description">{$smarty.capture.$prod_descr}</p>
		{/if}

		{if $capture_buttons}{capture name="buttons"}{/if}
			<div class="buttons-container">
				{assign var="qty" value="qty_`$obj_id`"}
				{$quantity}
				{if $show_details_button}
					{include file="buttons/button.tpl" but_href="products.view?product_id=`$product.product_id`" but_text=$lang.view_details but_role="submit"}
				{/if}

				{assign var="add_to_cart" value="add_to_cart_`$obj_id`"}
				{$smarty.capture.$add_to_cart}

				{assign var="list_buttons" value="list_buttons_`$obj_id`"}
				{$smarty.capture.$list_buttons}
			</div>
		{if $capture_buttons}{/capture}{/if}

		{assign var="form_close" value="form_close_`$obj_id`"}
		{$smarty.capture.$form_close}

		{if $show_product_tabs}
		{include file="views/tabs/components/product_popup_tabs.tpl"}
		{$smarty.capture.popupsbox_content}
		{/if}
	</div>
{/if}
