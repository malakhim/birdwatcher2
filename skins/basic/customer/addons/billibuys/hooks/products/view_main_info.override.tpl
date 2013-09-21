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
					<span class="chain-new">{$lang.price}</span>
					<input type="hidden" name="price" value="{$price}"/>
					{include file="common_templates/price.tpl" value=$price}
			{/if}
		</div>

		{if $show_descr}
			{assign var="prod_descr" value="prod_descr_`$obj_id`"}
			<h2 class="description-title">{$lang.description}</h2>
			<p class="product-description">{$smarty.capture.$prod_descr}</p>
		{/if}

		<br/>
		{if $capture_options_vs_qty}{/capture}{/if}
		<div style="padding: 0 !important;" class="qty {if $quick_view} form-field{if !$capture_options_vs_qty} product-list-field{/if}{/if}{if $settings.Appearance.quantity_changer == "Y"} changer{/if}" id="qty_{$obj_prefix}{$product.product_id}">
			<input type="hidden" name="product_data[{$product.product_id}][amount]" value="{$quantity}"/>
			<label for="qty_count_{$obj_prefix}{$product.product_id}">{$quantity_text|default:$lang.qty}:</label>
			<div class="center valign cm-value-changer">
			<input type="text" size="5" class="input-text-short cm-amount" id="qty_count_{$product.product_id}" name="product_data[{$product.product_id}][amount]" value="{"$quantity"|default:1}" disabled />
			</div>
		</div>
		{if $capture_buttons}{capture name="buttons"}{/if}
			<div class="buttons-container">
				{if $show_details_button}
					{include file="buttons/button.tpl" but_href="products.view?product_id=`$product.product_id`" but_text=$lang.view_details but_role="submit"}
				{/if}

				{if $auth.user_id == $owned_user}
					{if !$item_added_to_cart}
					{assign var="add_to_cart" value="add_to_cart_`$obj_id`"}
					{$smarty.capture.$add_to_cart}
					{else}
						{$lang.bid_already_accepted_for_this_auction}
					{/if}
				{else}
					{$lang.are_you_owner}
				{/if}

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
