{if $product.extra.configuration}
<div class="clearfix">
{include file="common_templates/image.tpl" image_width="40" image_height="40" images=$product.main_pair show_thumbnail="Y" no_ids=true class="product-notification-image"}
<div class="product-notification-content">
<ul>
	<li>
		<a href="{"products.view?product_id=`$product.product_id`"|fn_url}">{$product.product_id|fn_get_product_name|escape}</a>
	</li>
	<li>
		<strong class="valign">{$product.amount}</strong>&nbsp;x&nbsp;{include file="common_templates/price.tpl" value=$product.display_price span_id="price_`$key`" class="none"}
	</li>
	{if $product.product_option_data}
		<li>{include file="common_templates/options_info.tpl" product_options=$product.product_option_data}</li>
	{/if}
	<li><ul>
	{foreach from=$added_products item="_product" key="_key"}
		{if $_product.extra.parent.configuration == $key}
			<li>
				{if $_product.is_accessible}
					<a href="{"products.view?product_id=`$_product.product_id`"|fn_url}">{$_product.product_id|fn_get_product_name|escape}</a>
				{else}
					{$_product.product_id|fn_get_product_name|escape}
				{/if}
			</li>
			<li>
				<strong class="valign">{$_product.amount}</strong>&nbsp;x&nbsp;{include file="common_templates/price.tpl" value=$_product.display_price span_id="price_`$_key`" class="none"}
			</li>
			{if $_product.product_option_data}
				<li>{include file="common_templates/options_info.tpl" product_options=$_product.product_option_data}</li>
			{/if}
		{/if}
	{/foreach}
	</ul></li>
</ul>
</div>
</div>
{elseif $product.extra.parent.configuration}
	&nbsp;
{/if}