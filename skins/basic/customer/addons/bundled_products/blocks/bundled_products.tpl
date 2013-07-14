{** block-description:buy_together **}

{script src="js/exceptions.js"}
{if $chains}
{foreach from=$chains item=product key=key name="products"}

{assign var="obj_id" value=$product.product_id}
{assign var="obj_id_prefix" value="`$obj_prefix``$product.product_id`"}
{include file="common_templates/product_data.tpl" product=$product min_qty=true}

<div class="float-left product-item-image center">
		<span class="cm-reload-{$obj_prefix}{$obj_id} image-reload" id="list_image_update_{$obj_prefix}{$obj_id}">
			{if !$hide_links}
				<a href="{"products.view?product_id=`$product.product_id`"|fn_url}">
				<input type="hidden" name="image[list_image_update_{$obj_prefix}{$obj_id}][link]" value="{"products.view?product_id=`$product.product_id`"|fn_url}" />
			{/if}
			
			<input type="hidden" name="image[list_image_update_{$obj_prefix}{$obj_id}][data]" value="{$obj_id_prefix},{$settings.Thumbnails.product_lists_thumbnail_width},{$settings.Thumbnails.product_lists_thumbnail_height},product" />
			{include file="common_templates/image.tpl" image_width=$settings.Thumbnails.product_lists_thumbnail_width obj_id=$obj_id_prefix images=$product.main_pair object_type="product" show_thumbnail="Y" image_height=$settings.Thumbnails.product_lists_thumbnail_height}
			
			{if !$hide_links}
				</a>
			{/if}
		<!--list_image_update_{$obj_prefix}{$obj_id}--></span>
		
		{assign var="rating" value="rating_$obj_id"}
		{$smarty.capture.$rating}
	</div>
	<div class="product-info">
		{if $item_number == "Y"}<strong>{$smarty.foreach.products.iteration}.&nbsp;</strong>{/if}
		{assign var="name" value="name_$obj_id"}{$smarty.capture.$name}
		{assign var="sku" value="sku_$obj_id"}{$smarty.capture.$sku}
		
		<div class="float-right right add-product">
			{assign var="add_to_cart" value="add_to_cart_`$obj_id`"}
			{$smarty.capture.$add_to_cart}
		</div>
		
		<div class="prod-info">
			<div class="chain-price">
				
				<div class="chain-old-price">
					<span class="chain-old">{$lang.total_list_price}</span>
					<span class="chain-old-line">{include file="common_templates/price.tpl" value=$chain.total_price}</span>
				</div>
				<div class="chain-new-price">
					<span class="chain-new">{$lang.price_for_all}</span>
					
					{include file="common_templates/price.tpl" value=$chain.chain_price}
				</div>
				
			</div>
			
		</div>
		
	</div>
{/foreach}

{/if}