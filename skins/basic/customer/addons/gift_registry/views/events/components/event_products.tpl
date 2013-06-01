<div class="events-products" id="content_products">
<p class="events-help">{$lang.text_gr_desired_products}</p>
{script src="js/exceptions.js"}
{if $event_data.products}
<form action="{""|fn_url}" method="post" name="event_products_form" >
{include file="common_templates/subheader.tpl" title=$lang.defined_desired_products}
<input type="hidden" name="event_id" value="{$event_id}" />
{if $access_key}
<input type="hidden" name="access_key" value="{$access_key}" />
{/if}
{include file="common_templates/pagination.tpl"}
{foreach from=$event_data.products item="product" key="key" name="products"}
<div class="product-container">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tbody>
			<tr>
				<td rowspan="5" width="10%">
					<div class="product-image cm-reload-{$key}" id="image_update_{$key}">
					<a href="{"products.view?product_id=`$product.product_id`"|fn_url}">
					{include file="common_templates/image.tpl" image_width=$settings.Thumbnails.product_lists_thumbnail_width image_height=$settings.Thumbnails.product_lists_thumbnail_height obj_id=$key images=$product.main_pair object_type="product" show_thumbnail="Y"}</a>
					<!--image_update_{$key}--></div>
				</td>
			</tr>
			<tr>
				<td>
					<a href="{"products.view?product_id=`$product.product_id`"|fn_url}" class="product-title">{$product.product|unescape}</a>
					<a href="{"events.delete?item_id=`$key`&amp;event_id=`$event_id`&amp;access_key=`$access_key`&amp;selected_section=products"|fn_url}" class="icon-delete-big" title="{$lang.remove|escape:html}"></a>
					<p class="sku{if !$product.product_code} hidden{/if}">
					<span class="cm-reload-{$key}" id="product_code_update_{$key}">
						<span id="sku_{$product.product_id}">
							{$lang.sku}: <span id="product_code_{$product.product_id}">{$product.product_code}</span>
						</span>
					<!--product_code_update_{$key}--></span>
					</p>					
				</td>
			</tr>
			<tr>
				<td>
					{if $product.product_options}
						<div class="cm-reload-{$key}" id="options_update_{$key}">
							<input type="hidden" name="appearance[events]" value="1" />
							<input type="hidden" name="appearance[event_id]" value="{$event_id}" />
							{include file="views/products/components/product_options.tpl" product_options=$product.product_options product=$product name="event_products" id=$key location="cart"}
						<!--options_update_{$key}--></div>
					{/if}
				</td>
			</tr>
			<tr>
				<td>
				<div class="cm-reload-{$key}" id="additional_info_update_{$key}">
					<table cellpadding="0" cellspacing="0" border="0" class="table margin-top">
						<thead>
							<tr>
								<th class="right">{$lang.price}</th>
								<th>{$lang.desired_amount}</th>
								<th>{$lang.bought_amount}</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="nowrap center">
									{include file="common_templates/price.tpl" value=$product.price span_id="original_price_`$key`" class="sub-price"}</td>
								<td class="nowrap center">
									<input type="hidden" name="event_products[{$key}][product_id]" value="{$product.product_id}" />
									<input type="text" size="3" id="amount_{$key}" name="event_products[{$key}][amount]" value="{$product.amount}" class="input-text-short" {if $product.is_edp == "Y"}readonly="readonly"{/if} /></td>
								<td class="nowrap center">
									<strong>{$product.ordered_amount}</strong></td>
								</tr>
						</tbody>
					</table>
				<!--additional_info_update_{$key}--></div>
				</td>
			</tr>
			<tr>
				<td>
					{if $product.short_description || $product.full_description}
						<div class="product-desc">
							<h4>{$lang.description}</h4>						
						{if $product.short_description}
							{$product.short_description|unescape}
						{else}
							{$product.full_description|unescape|strip_tags|truncate:280:"..."}{if $product.full_description|strlen > 280}<a href="{"products.view?product_id=`$product.product_id`"|fn_url}">{$lang.more_link}</a>{/if}
						{/if}
						</div>
					{/if}
				</td>
			</tr>
		</tbody>
	</table>
</div>
{if !$smarty.foreach.products.last}
<hr />
{/if}
{/foreach}
{include file="common_templates/pagination.tpl"}
<div class="buttons-container">
	{include file="buttons/button.tpl" but_text=$lang.update but_name="dispatch[events.update_products]"}
	<div class="float-left">
		{include file="pickers/products_picker.tpl" data_id="ev_products" but_text=$lang.add_product extra_var="dispatch=events.add_products&event_id=`$event_id`&access_key=`$access_key`" no_container=true}
	</div>
</div>
</form>
{else}
<p class="no-items"><strong>{$lang.text_no_products_defined}</strong></p>
{include file="pickers/products_picker.tpl" data_id="ev_products" but_text=$lang.add_product extra_var="dispatch=events.add_products&event_id=`$event_id`&access_key=`$access_key`"}
{/if}
</div>