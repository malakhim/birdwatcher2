{script src="js/exceptions.js"}

{assign var="obj_id" value="`$obj_prefix``$product.product_id`"}
{assign var="obj_id_prefix" value="`$obj_prefix``$product.product_id`"}
{if $product.result_type == "full"}
{hook name="products:one_product"}
<div class="product-container clearfix">
	<div class="product-image">
		<span class="cm-reload-{$obj_id} image-reload" id="list_image_update_{$obj_id}">
			<input type="hidden" name="image[list_image_update_{$obj_id}][data]" value="{$obj_id_prefix},{$settings.Thumbnails.product_lists_thumbnail_width},{$settings.Thumbnails.product_lists_thumbnail_height},product" />
			
			<a href="{"products.view?product_id=`$product.product_id`"|fn_url}">{include file="common_templates/image.tpl" image_width=$settings.Thumbnails.product_lists_thumbnail_width image_height=$settings.Thumbnails.product_lists_thumbnail_height obj_id=$obj_id images=$product.main_pair object_type="product" show_thumbnail="Y"}</a>
		<!--list_image_update_{$obj_id}--></span>
	</div>
	<div class="product-description">
		{include file="blocks/list_templates/simple_list.tpl" product=$product show_name=true show_sku=true show_features=true show_descr=true show_old_price=true show_price=true show_list_discount=true show_discount_label=true show_product_amount=true show_product_options=true show_qty=true min_qty=true show_edp=true show_add_to_cart=true show_list_buttons=true but_role="action"}
	</div>
</div>
{/hook}
{else}
<div class="search-result">
	<strong>{$product.result_number}.</strong> <a href="{"products.view?product_id=`$product.product_id`"|fn_url}" class="product-title">{$product.product|unescape}</a>
	{if !$hide_info}
	{if $product.short_description || $product.full_description}
	<p>
	{if $product.short_description}
		{$product.short_description|unescape}
	{else}
		{$product.full_description|unescape|strip_tags|truncate:280:"..."}{if $product.full_description|strlen > 280}<a href="{"products.view?product_id=`$product.product_id`"|fn_url}">{$lang.more_link}</a>{/if}
	{/if}
	</p>
	{/if}

	{elseif $hide_info == "age-verify"}
		<div class="box margin-top">
			{$product.age_warning_message}
			<div class="buttons-container">
				{include file="buttons/button.tpl" but_text=$lang.verify but_href="products.view?product_id=`$product.product_id`" but_role="text"}
			</div>
		</div>
	{/if}
</div>
{/if}