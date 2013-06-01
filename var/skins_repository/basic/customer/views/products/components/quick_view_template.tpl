{script src="js/exceptions.js"}

{if $product}
{assign var="obj_id" value=$product.product_id}
{assign var="obj_prefix" value="ajax"}
<script type="text/javascript" class="cm-ajax-force">
//<![CDATA[
function fn_form_post_product_form_{$obj_prefix}{$obj_id}()
{$ldelim}
	// close popup
	$('#product_quick_view_{$obj_id}').ceDialog('close');
{$rdelim}
//]]>
</script>
{/if}

<div class="product-main-info product-quick-view">
{hook name="products:view_main_info"}

	{if $product}
	{assign var="obj_id" value=$product.product_id}
	{include file="common_templates/product_data.tpl" product=$product separate_buttons=false}
	{assign var="form_open" value="form_open_`$obj_id`"}
	{$smarty.capture.$form_open}
	<div class="clearfix">
		<div class ="left-side">
			{if !$no_images}
				<div class="image-border cm-reload-{$obj_prefix}{$obj_id}" id="product_images_{$product.product_id}_update">
					{include file="views/products/components/product_images.tpl" product=$product show_detailed_link="Y"}
				<!--product_images_{$product.product_id}_update--></div>
			{/if}

		</div>
		<div class="product-info">
			{assign var="sku" value="sku_$obj_id"}{$smarty.capture.$sku}

			{assign var="rating" value="rating_`$obj_id`"}{$smarty.capture.$rating}
			<div class="{if $smarty.capture.$old_price|trim || $smarty.capture.$clean_price|trim || $smarty.capture.$list_discount|trim}prices-container {/if}price-wrap clearfix">
				{assign var="old_price" value="old_price_`$obj_id`"}
				{assign var="price" value="price_`$obj_id`"}
				{assign var="clean_price" value="clean_price_`$obj_id`"}
				{assign var="list_discount" value="list_discount_`$obj_id`"}
				{assign var="discount_label" value="discount_label_`$obj_id`"}
				{if $smarty.capture.$old_price|trim || $smarty.capture.$clean_price|trim}
					<div class="product-prices">
						{if $smarty.capture.$old_price|trim}{$smarty.capture.$old_price}{/if}
				{/if}
			
				{if !$smarty.capture.$old_price|trim || $details_page}<p class="actual-price">{/if}
						{$smarty.capture.$price}
				{if !$smarty.capture.$old_price|trim || $details_page}</p>{/if}
		
				{if $smarty.capture.$old_price|trim || $smarty.capture.$clean_price|trim}
						{$smarty.capture.$clean_price}
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
			
			{assign var="qty" value="qty_`$obj_id`"}
			{$smarty.capture.$qty}
			
			{assign var="advanced_options" value="advanced_options_`$obj_id`"}
			{$smarty.capture.$advanced_options}
			{if $capture_options_vs_qty}{/capture}{/if}
		
			{assign var="min_qty" value="min_qty_`$obj_id`"}
			{$smarty.capture.$min_qty}
			
			{assign var="product_edp" value="product_edp_`$obj_id`"}
			{$smarty.capture.$product_edp}

			{assign var="prod_descr" value="prod_descr_`$obj_id`"}
			{if $smarty.capture.$prod_descr|trim}
			<h2 class="description-title">{$lang.description}</h2>
			<p class="product-description">{$smarty.capture.$prod_descr}</p>
			{/if}

			{if $capture_buttons}{capture name="buttons"}{/if}
				{assign var="add_to_cart" value="add_to_cart_`$obj_id`"}
				{$smarty.capture.$add_to_cart}

				{assign var="list_buttons" value="list_buttons_`$obj_id`"}
				{$smarty.capture.$list_buttons}
			{if $capture_buttons}{/capture}{/if}
		</div>
	</div>
	{assign var="form_close" value="form_close_`$obj_id`"}
	{$smarty.capture.$form_close}
	{/if}
	
{/hook}

{if $smarty.capture.hide_form_changed == "Y"}
	{assign var="hide_form" value=$smarty.capture.orig_val_hide_form}
{/if}

</div>

<div class="product-details">
</div>

<!-- {capture name="mainbox_title"}{assign var="details_page" value=true}{/capture} -->