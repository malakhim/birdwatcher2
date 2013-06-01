
{script src="js/exceptions.js"}

<div class="product-main-info">
<div class="clearfix">
{hook name="products:view_main_info"}

	{if $product}
	{assign var="obj_id" value=$product.product_id}
	{include file="common_templates/product_data.tpl" product=$product separate_buttons=$separate_buttons|default:true but_role="big" but_text=$lang.add_to_shopping_cart}
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
			{assign var="old_price" value="old_price_`$obj_id`"}
			{assign var="price" value="price_`$obj_id`"}
			{assign var="clean_price" value="clean_price_`$obj_id`"}
			{assign var="list_discount" value="list_discount_`$obj_id`"}
			{assign var="discount_label" value="discount_label_`$obj_id`"}
			<div class="{if $smarty.capture.$old_price|trim || $smarty.capture.$clean_price|trim || $smarty.capture.$list_discount|trim}prices-container {/if}price-wrap clearfix">
			{if $smarty.capture.$old_price|trim || $smarty.capture.$clean_price|trim || $smarty.capture.$list_discount|trim}
				<div class="float-left product-prices">
					{if $smarty.capture.$old_price|trim}{$smarty.capture.$old_price}&nbsp;{/if}
			{/if}
			
			{if !$smarty.capture.$old_price|trim || $details_page}<p class="actual-price">{/if}
					{$smarty.capture.$price}
			{if !$smarty.capture.$old_price|trim || $details_page}</p>{/if}
		
			{if $smarty.capture.$old_price|trim || $smarty.capture.$clean_price|trim || $smarty.capture.$list_discount|trim}
					{$smarty.capture.$clean_price}
					{$smarty.capture.$list_discount}
				</div>
			{/if}
			{if $show_discount_label && $smarty.capture.$discount_label|trim}
				<div class="float-left">
					{$smarty.capture.$discount_label}
				</div>
			{/if}
			</div>
		
			{if $capture_options_vs_qty}{capture name="product_options"}{/if}
			
			{assign var="product_amount" value="product_amount_`$obj_id`"}
			{$smarty.capture.$product_amount}
			
			{assign var="product_options" value="product_options_`$obj_id`"}
			{$smarty.capture.$product_options}
			
			{assign var="advanced_options" value="advanced_options_`$obj_id`"}
			{$smarty.capture.$advanced_options}
			{if $capture_options_vs_qty}{/capture}{/if}
		
			{assign var="min_qty" value="min_qty_`$obj_id`"}
			{$smarty.capture.$min_qty}
			
			{assign var="product_edp" value="product_edp_`$obj_id`"}
			{$smarty.capture.$product_edp}

			{if $show_descr}
			{assign var="prod_descr" value="prod_descr_`$obj_id`"}
			<h2 class="description-title">{$lang.description}</h2>
			<p class="product-description">{$smarty.capture.$prod_descr}</p>
			{/if}

			{if $capture_buttons}{capture name="buttons"}{/if}
				<div class="buttons-container">
					{assign var="qty" value="qty_`$obj_id`"}
					{$smarty.capture.$qty}
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
	
{/hook}
</div>

{if $smarty.capture.hide_form_changed == "Y"}
	{assign var="hide_form" value=$smarty.capture.orig_val_hide_form}
{/if}

{if $show_product_tabs}

{include file="views/tabs/components/product_tabs.tpl"}

{if $blocks.$tabs_block_id.properties.wrapper}
	{include file=$blocks.$tabs_block_id.properties.wrapper content=$smarty.capture.tabsbox_content title=$blocks.$tabs_block_id.description}
{else}
	{$smarty.capture.tabsbox_content}
{/if}

{/if}
</div>

<div class="product-details">
</div>

{capture name="mainbox_title"}{assign var="details_page" value=true}{/capture}
