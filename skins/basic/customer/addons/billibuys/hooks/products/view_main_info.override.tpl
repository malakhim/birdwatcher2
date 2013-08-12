{if $chains && !$quick_view}

	{if $product}
		{assign var="obj_id" value=$product.product_id}
		{include file="common_templates/product_data.tpl" product=$product separate_buttons=$separate_buttons|default:true but_role="big" but_text=$lang.add_to_shopping_cart hide_form=true}
		{if !$no_images}
			<div class="image-border float-left center cm-reload-{$product.product_id}" id="product_images_{$product.product_id}_update">
				{include file="views/products/components/product_images.tpl" product=$product show_detailed_link="Y"}
			<!--product_images_{$product.product_id}_update--></div>
		{/if}
		
		<div class="product-info">
			
		{if !$hide_title}<h1 class="mainbox-title">{$product.product|unescape}</h1>{/if}
		{assign var="rating" value="rating_`$obj_id`"}{$smarty.capture.$rating}
		{assign var="sku" value="sku_$obj_id"}{$smarty.capture.$sku}
		
			{foreach from=$chains key="key" item="chain"}
			{assign var="obj_prefix" value="bp_`$chain.chain_id`"}
			<form {if $settings.DHTML.ajax_add_to_cart == "Y" && !$no_ajax}class="cm-ajax cm-ajax-full-render"{/if} action="{""|fn_url}" method="post" name="chain_form_{$chain.chain_id}" enctype="multipart/form-data">
		
			<input type="hidden" name="redirect_url" value="{$config.current_url}" />
			<input type="hidden" name="result_ids" value="cart_status*,wish_list*" />
			{if !$stay_in_cart}
				<input type="hidden" name="redirect_url" value="{$config.current_url}" />
			{/if}
			<input type="hidden" name="product_data[{$chain.product_id}_{$chain.chain_id}][chain]" value="{$chain.chain_id}" />
			<input type="hidden" name="product_data[{$chain.product_id}_{$chain.chain_id}][product_id]" value="{$chain.product_id}" />
			<input type="hidden" name="package" value="Y"/>

			<div class="chain-content clearfix">
				<div class="chain-products scroll-x nowrap clearfix">
				{if $chain.products}
				
					{if !(!$auth.user_id && $settings.General.allow_anonymous_shopping == "P")}
						<div class="clearfix"></div>
						<table style="width: 90% !important;">
						<tr>
						<td>
							<div class="chain-price">
								<div class="chain-new-price">
									<span class="chain-new">{$lang.price}</span>
									<input type="hidden" name="package_price" value="{$chain.chain_price}"/>
									{include file="common_templates/price.tpl" value=$chain.chain_price}
								</div>
							
							</div>
						</td>
						</tr>
						<tr>
						<td>
										
							{if $chain.stock != "N"}

								{if !(!$auth.user_id && $settings.General.allow_anonymous_shopping == "B")}
									{if $disable_chains != "Y"}
										<div style="padding: 0 !important;" class="qty {if $quick_view} form-field{if !$capture_options_vs_qty} product-list-field{/if}{/if}{if $settings.Appearance.quantity_changer == "Y"} changer{/if}" id="qty_{$obj_prefix}{$chain.product_id}_{$chain.chain_id}">
											<label for="qty_count_{$obj_prefix}{$chain.product_id}_{$chain.chain_id}">{$quantity_text|default:$lang.qty}:</label>
											<div class="center valign cm-value-changer">
												<input type="text" size="5" class="input-text-short cm-amount" id="qty_count_{$obj_prefix}{$chain.product_id}_{$chain.chain_id}" name="product_data[{$chain.product_id}_{$chain.chain_id}][amount]" value="{"$default_amount"|default:1}" disabled />
											</div>
										</div>
									
										<div style="padding-left: 130px;" class="buttons-container cm-buy-together-submit" id="wrap_chain_button_{$chain.chain_id}">
												{include file="buttons/button.tpl" but_text=$lang.add_all_to_cart but_id="chain_button_`$chain.chain_id`" but_name="dispatch[checkout.add]" but_role="action" obj_id=$obj_id}
										</div>
									
									{else}
										<p>{$lang.bundle_unavailable}</p>
									{/if}
								{/if}
							{/if}
						</td>
						<td class="right">
							&nbsp;
						</td>
						</table>
					{else}
						<p class="price">{$lang.bb_item_purchased_through_bids}</p>
					{/if}
				
					<div>
						{if $chain.product_options}
							<div id="bundled_products_options_{$chain.chain_id}_{$key}" class="chain-product-options">
								<div class="cm-reload-{$obj_prefix}{$chain.product_id}_{$chain.chain_id}" id="bundled_products_options_update_{$chain.chain_id}_{$key}">
									<input type="hidden" name="appearance[show_product_options]" value="1" />
									<input type="hidden" name="appearance[bp_chain]" value="{$chain.chain_id}" />
									<input type="hidden" name="appearance[bp_id]" value="{$key}" />
									
									{include file="addons/bundled_products/components/product_options.tpl" id="`$chain.product_id`_`$chain.chain_id`" product_options=$chain.product_options name="product_data" no_script=true extra_id="`$chain.product_id`_`$chain.chain_id`"}
									
								</div>
								{*
								<div class="buttons-container">
									{include file="buttons/button.tpl" but_id="add_item_close" but_name="" but_text=$lang.save_and_close but_role="action" but_meta="cm-dialog-closer"}
								</div>
								*}
							</div>
						{*	
						<div>
							{include file="common_templates/popupbox.tpl" id="bundled_products_options_`$chain.chain_id`_`$key`" link_meta="text-button" text=$lang.specify_options content=$smarty.capture.bundled_products_product_options link_text=$lang.specify_options act="general"}
						</div>
						*}
						{/if}
					</div>
				{/if}
				<fieldset>
				
				<div style="padding-top: 20px;">
					&nbsp;
				</div>
				{foreach from=$chain.products key="_id" item="_product"}
					
					<div class="chain-product">
						{if !$_product.aoc}
							<input type="hidden" name="product_data[{$_product.product_id}][product_id]" value="{$_product.product_id}" />
						{/if}
						<table width="100%">
						<tr>
						<td>
						<a href="{"products.view?product_id=`$_product.product_id`"|fn_url}">{include file="common_templates/image.tpl" image_width="75" image_height="75" obj_id="`$chain.chain_id`_`$_product.product_id`" images=$_product.main_pair object_type="product" show_thumbnail="Y"}</a>
						</td>
						<td style="padding-left: 20px; vertical-align: middle;" align="left">
							<a href="{"products.view?product_id=`$_product.product_id`"|fn_url}">{$_product.product_name}</a>
											
							{if $_product.product_options}
								{foreach from=$_product.product_options item="option"}
									<div><strong>{$option.option_name}</strong>: {$option.variant_name}</div>
								{/foreach}
							{elseif $_product.aoc}
									<div id="bundled_products_options_{$chain.chain_id}_{$_product.product_id}" class="chain-product-options">
										<div class="cm-reload-{$obj_prefix}{$_product.product_id}" id="bundled_products_options_update_{$chain.chain_id}_{$_id}">
											<input type="hidden" name="appearance[show_product_options]" value="1" />
											<input type="hidden" name="appearance[bp_chain]" value="{$chain.chain_id}" />
											<input type="hidden" name="appearance[bp_id]" value="{$_id}" />
											
											{if $_product.amount > 0}
												{section name=foo loop=$_product.amount} 
													<input type="hidden" name="product_data[{$_product.product_id}_{$smarty.section.foo.iteration}][product_id]" value="{$_product.product_id}" />
													<input type="hidden" name="product_data[{$_product.product_id}_{$smarty.section.foo.iteration}][amount]" value="1" />
													{include file="addons/bundled_products/components/product_options.tpl" id="`$_product.product_id`_`$smarty.section.foo.iteration`" product_options=$_product.options name="product_data" no_script=true product=$_product extra_id="`$_product.product_id`_`$smarty.section.foo.iteration`"}
												{/section}
											{/if}
										</div>
										{*
										<div class="buttons-container">
											{include file="buttons/button.tpl" but_id="add_item_close" but_name="" but_text=$lang.save_and_close but_role="action" but_meta="cm-dialog-closer"}
										</div>
										*}
									</div>
					
							{/if}
						</td>
						</tr>
						</table>
					</div>
				{/foreach}
				
				</div>
				</fieldset>
				
			</div>
		
			</form>
		
		
			{/foreach}
		
			{if $show_product_tabs}
			{include file="views/tabs/components/product_popup_tabs.tpl"}
			{$smarty.capture.popupsbox_content}
			{/if}
		</div>
	{/if}
{elseif $quick_view}

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

{/if}