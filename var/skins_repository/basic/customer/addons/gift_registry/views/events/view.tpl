<div class="events events-view">
	<div class="events-actions">
		<ul>
			<li>{include file="buttons/button.tpl" but_text=$lang.view_events but_href="events.search" but_role="text"}</li>
			<li>{include file="buttons/button.tpl" but_text=$lang.private_events but_href="events.access_key" but_role="text" but_meta="private"}</li>
			<li>{include file="buttons/button.tpl" but_text=$lang.event_add but_href="events.add" but_role="text" but_meta="add"}</li>
		</ul>
	</div>
{foreach from=$event_fields item="field" key="f_id"}
<div class="form-field">
	<label>{$field.description}:</label>
	{if $field.field_type == "S" || $field.field_type == "R"}
		{assign var="i" value=$event_data.fields.$f_id}
		{$field.variants.$i.description}
	{elseif $field.field_type == "C"}
		{if $event_data.fields.$f_id == "Y"}{$lang.yes}{else}{$lang.no}{/if}
	{elseif $field.field_type == "I" || $field.field_type == "T"}
		{$event_data.fields.$f_id}
	{elseif $field.field_type == "V"}
		{$event_data.fields.$f_id|date_format:$settings.Appearance.date_format}
	{/if}
</div>
{/foreach}
{include file="common_templates/subheader.tpl" title=$lang.defined_desired_products}
{if $event_data.products}
{script src="js/exceptions.js"}
<form {if $settings.DHTML.ajax_add_to_cart == "Y" && !$no_ajax}class="cm-ajax cm-ajax-full-render"{/if} action="{""|fn_url}" method="post" name="event_products_form">
<input type="hidden" name="result_ids" value="cart_status*" />
<input type="hidden" name="redirect_url" value="{$config.current_url}" />
{include file="common_templates/pagination.tpl"}
{foreach from=$event_data.products item="product" key="key" name="products"}
<input type="hidden" name="product_data[{$key}][product_id]" value="{$product.product_id}" />
<div class="events-products">
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
							{include file="views/products/components/product_options.tpl" product_options=$product.product_options product=$product name="event_products" id=$key location="cart" disabled=$product.disabled_options}
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
								<th>{$lang.quantity}</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="nowrap center">
									{include file="common_templates/price.tpl" value=$product.price span_id="original_price_`$key`" class="sub-price"}</td>
								<td class="nowrap center">{$product.amount}</td>
								<td class="nowrap center"><strong>{$product.ordered_amount}</strong></td>
								<td class="nowrap center">
										<input id="giftreg_item_amount_{$product.item_id}" type="hidden" name="product_data[{$key}][extra][events][{$product.item_id}]" value="0"  />
										<input id="giftreg_id" type="hidden" name="product_data[{$key}][extra][events][event_id]" value="{$event_data.event_id}"  />
										{if $product.avail_amount}
											{assign var="range" value=1|range:$product.avail_amount}

											<select name="product_data[{$key}][amount]" onchange="$('#giftreg_item_amount_{$product.item_id}').val(this.value);">
												<option value="">0</option>
												{foreach from=$range item=r}
													<option value="{$r}">{$r}</option>
												{/foreach}
											</select>
											{assign var="show_add_to_cart" value="Y"}
										{else}
											&nbsp;-&nbsp;
										{/if}
								</td>
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
</div>
{if !$smarty.foreach.products.last}
<hr />
{/if}
{/foreach}
{include file="common_templates/pagination.tpl"}
{* if $show_add_to_cart == "Y" *}
<div class="buttons-container">
	{include file="buttons/add_to_cart.tpl" but_name="dispatch[checkout.add]" but_role="action"}
</div>
{* /if *}
</form>
{else}
	<p class="no-items">{$lang.text_no_products_defined}</p>
{/if}
{capture name="mainbox_title"}
	{$event_data.title}
	<em class="date">({$event_data.start_date|date_format:$settings.Appearance.date_format} - {$event_data.end_date|date_format:$settings.Appearance.date_format})</em>
	<em class="status">{$event_data.owner}</em>
{/capture}
{hook name="events:view"}
{/hook}
</div>