{* $Id *}

{* NOTE: This template doesn\'t used for direct display
   It will store in the session and then display into notification box
   ---------------------------------------------------------------
   So, it is STRONGLY recommended to use strip tags in such templates
*}

{strip}
<div class="notification-body">
	{hook name="products:notification_items"}
	{if $added_products}
		{foreach from=$added_products item=product key="key"}
			{hook name="products:notification_product"}
			<div class="clearfix">
				{include file="common_templates/image.tpl" image_width="40" image_height="40" images=$product.main_pair show_thumbnail="Y" no_ids=true class="product-notification-image"}
				<div class="product-notification-content">
					<a href="{"products.view?product_id=`$product.product_id`"|fn_url}" class="product-notification-product-name">{$product.product_id|fn_get_product_name|unescape}</a>
					<div class="product-notification-price">
					{if !$hide_amount}
					<span class="none">{$product.amount}</span>&nbsp;x&nbsp;{include file="common_templates/price.tpl" value=$product.display_price span_id="price_`$key`" class="none"}
					{/if}
					</div>
					{if $product.product_option_data}
					{include file="common_templates/options_info.tpl" product_options=$product.product_option_data}
					{/if}	
				</div>
			</div>
			{/hook}
		{/foreach}
	{else}
	{$empty_text}
	{/if}
	{/hook}
</div>
<div class="product-notification-buttons clearfix{if $n_type} center{/if}">
	<div class="float-left">
		{if $settings.DHTML.ajax_add_to_cart != "Y" && $settings.General.redirect_to_cart == 'Y'}
			{include file="buttons/continue_shopping.tpl" but_href=$continue_url|default:$index_script but_role="action"}
		{else}
			{include file="buttons/continue_shopping.tpl" but_meta="cm-notification-close" but_href=$continue_url|default:$index_script}
		{/if}
	</div>
	<div class="float-right">
		{if !$n_type}
				{include file="buttons/checkout.tpl" but_href="checkout.checkout"}

		{else}
			{hook name="products:notification_control"}
			{if $n_type == "C"}
				{include file="buttons/button.tpl" but_href="product_features.compare" but_text=$lang.view_compare_list}
			{/if}
			{/hook}
		{/if}
	</div>
</div>
{/strip}
