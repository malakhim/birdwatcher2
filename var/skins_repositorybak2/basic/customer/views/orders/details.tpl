<div class="orders">

{if $order_info}

{capture name="order_actions"}

	{if $view_only != "Y"}
		<div class="orders-print clearfix">
			{hook name="orders:details_tools"}
			{assign var="print_order" value=$lang.print_invoice}
			{assign var="print_pdf_order" value=$lang.print_pdf_invoice}
			{if $status_settings.appearance_type == "C" && $order_info.doc_ids[$status_settings.appearance_type]}
				{assign var="print_order" value=$lang.print_credit_memo}
				{assign var="print_pdf_order" value=$lang.print_pdf_credit_memo}
			{elseif $status_settings.appearance_type == "O"}
				{assign var="print_order" value=$lang.print_order_details}
				{assign var="print_pdf_order" value=$lang.print_pdf_order_details}
			{/if}
			
			{include file="buttons/button_popup.tpl" but_role="text" but_text=$print_order but_href="orders.print_invoice?order_id=`$order_info.order_id`" width="900" height="600"}
			{include file="buttons/button.tpl" but_role="text" but_meta="pdf" but_text=$print_pdf_order but_href="orders.print_invoice?order_id=`$order_info.order_id`&amp;format=pdf"}
			{/hook}
			<ul class="orders-actions">
			{if $view_only != "Y"}
				{hook name="orders:details_bullets"}
				{/hook}
			{/if}
			<li>{include  file="buttons/button.tpl" but_role="text" but_text=$lang.re_order but_href="orders.reorder?order_id=`$order_info.order_id`"}</li>
			</ul>
		</div>
	{/if}
{/capture}

{capture name="tabsbox"}

<div id="content_general" class="{if $selected_section && $selected_section != "general"}hidden{/if}">
	{if $without_customer != "Y"}
	{* Customer info *}
		<div class="orders-customer">
		{include file="views/profiles/components/profiles_info.tpl" user_data=$order_info location="I"}
		</div>
	{* /Customer info *}
	{/if}


{capture name="group"}

{include file="common_templates/subheader.tpl" title=$lang.products_information}

<table cellpadding="0" cellspacing="0" border="0" class="table" width="100%">
{hook name="orders:items_list_header"}
<thead>
<tr>
	<th class="product">{$lang.product}</th>
	<th class="price" align="right">{$lang.price}</th>
	<th class="quantity">{$lang.quantity}</th>
	{if $order_info.use_discount}
		<th>{$lang.discount}</th>
	{/if}
	{if $order_info.taxes && $settings.General.tax_calculation != "subtotal"}
		<th>{$lang.tax}</th>
	{/if}
	<th class="subtotal">{$lang.subtotal}</th>
</tr>
</thead>
{/hook}
{foreach from=$order_info.items item="product" key="key"}
{hook name="orders:items_list_row"}
{if !$product.extra.parent}
{cycle values=",class=\"table-row\"" name="class_cycle" assign="_class"}
<tr {$_class} valign="top">
	<td>{if $product.is_accessible}<a href="{"products.view?product_id=`$product.product_id`"|fn_url}" class="product-title">{/if}{$product.product|unescape}{if $product.is_accessible}</a>{/if}
		{if $product.extra.is_edp == "Y"}
		<div class="right"><a href="{"orders.order_downloads?order_id=`$order_info.order_id`"|fn_url}"><strong>[{$lang.download}]</strong></a></div>
		{/if}
		{if $product.product_code}
		<p class="code">{$lang.code}:&nbsp;{$product.product_code}</p>
		{/if}
		{hook name="orders:product_info"}
		{if $product.product_options}{include file="common_templates/options_info.tpl" product_options=$product.product_options}{/if}
		{/hook}
	</td>
	<td class="right nowrap">
		{if $product.extra.exclude_from_calculate}{$lang.free}{else}{include file="common_templates/price.tpl" value=$product.original_price}{/if}</td>
	<td class="center">&nbsp;{$product.amount}</td>
	{if $order_info.use_discount}
		<td class="right nowrap">
			{if $product.extra.discount|floatval}{include file="common_templates/price.tpl" value=$product.extra.discount}{else}-{/if}
		</td>
	{/if}
	{if $order_info.taxes && $settings.General.tax_calculation != "subtotal"}
		<td class="center nowrap">
			{if $product.tax_value|floatval}{include file="common_templates/price.tpl" value=$product.tax_value}{else}-{/if}
		</td>
	{/if}
	<td class="right">
         &nbsp;<strong>{if $product.extra.exclude_from_calculate}{$lang.free}{else}{include file="common_templates/price.tpl" value=$product.display_subtotal}{/if}</strong></td>
</tr>
{/if}
{/hook}
{/foreach}

{hook name="orders:extra_list"}
	{assign var="colsp" value=5}
	{if $order_info.use_discount}{assign var="colsp" value=$colsp+1}{/if}
	{if $order_info.taxes && $settings.General.tax_calculation != "subtotal"}{assign var="colsp" value=$colsp+1}{/if}
{/hook}

</table>

{*Customer notes*}
	{ if $order_info.notes}
	<div class="orders-notes">
		{include file="common_templates/subheader.tpl" title=$lang.customer_notes}
		<div class="orders-notes-body">
			<div class="orders-notes-arrow"></div>
			{$order_info.notes}
		</div>
	</div>
	{/if}
{*/Customer notes*}

<div class="orders-summary">
{include file="common_templates/subheader.tpl" title=$lang.summary}

<div class="float-right">
	{hook name="orders:info"}{/hook}
</div>

<div class="orders-summary-wrap">
<table>
{hook name="orders:totals"}
	{if $order_info.payment_id}
	<tr>
		<td>{$lang.payment_method}:&nbsp;</td>
		<td width="57%">{$order_info.payment_method.payment}&nbsp;{if $order_info.payment_method.description}({$order_info.payment_method.description}){/if}</td>
	</tr>
	{/if}
	{if $order_info.shipping && $settings.General.use_shipments != "Y"}
	<tr valign="top">
		<td>{$lang.shipping}:&nbsp;</td>
		<td>
			{foreach from=$order_info.shipping item="shipping" key="shipping_id" name="f_shipp"}
				{if $shipping.carrier && $shipping.tracking_number}
					{include file="common_templates/carriers.tpl" carrier=$shipping.carrier tracking_number=$shipping.tracking_number}

					{$shipping.shipping}&nbsp;({$lang.tracking_num}<a {if $smarty.capture.carrier_url|strpos:"://"}target="_blank"{/if} href="{$smarty.capture.carrier_url}">{$shipping.tracking_number}</a>)
				{else}
					{$shipping.shipping}
				{/if}
				{if !$smarty.foreach.f_shipp.last}<br>{/if}
			{/foreach}
		</td>
	</tr>
	{/if}
	<tr>
		<td>{$lang.subtotal}:&nbsp;</td>
		<td>{include file="common_templates/price.tpl" value=$order_info.display_subtotal}</td>
	</tr>
	{if $order_info.display_shipping_cost|floatval}
	<tr>
		<td>{$lang.shipping_cost}:&nbsp;</td>
		<td>{include file="common_templates/price.tpl" value=$order_info.display_shipping_cost}</td>
	</tr>
	{/if}
	{if $order_info.discount|floatval}
	<tr>
		<td class="nowrap strong">{$lang.including_discount}:</td>
		<td class="nowrap">
			{include file="common_templates/price.tpl" value=$order_info.discount}</td>
	</tr>
	{/if}

	{if $order_info.subtotal_discount|floatval}
	<tr>
		<td class="nowrap strong">{$lang.order_discount}:</td>
		<td class="nowrap">
			{include file="common_templates/price.tpl" value=$order_info.subtotal_discount}</td>
	</tr>
	{/if}

	{if $order_info.coupons}
	{foreach from=$order_info.coupons item="coupon" key="key"}
	<tr>
		<td class="nowrap">{$lang.coupon}:</td>
		<td>{$key}</td>
	</tr>
	{/foreach}
	{/if}

	{if $order_info.taxes}
	<tr class="taxes">
		<td><strong>{$lang.taxes}:</strong></td>
		<td>&nbsp;</td>
	</tr>
	{foreach from=$order_info.taxes item=tax_data}
	<tr class="taxes-desc">
		<td>{$tax_data.description}&nbsp;{include file="common_templates/modifier.tpl" mod_value=$tax_data.rate_value mod_type=$tax_data.rate_type}{if $tax_data.price_includes_tax == "Y" && ($settings.Appearance.cart_prices_w_taxes != "Y" || $settings.General.tax_calculation == "subtotal")}&nbsp;{$lang.included}{/if}{if $tax_data.regnumber}&nbsp;({$tax_data.regnumber}){/if}&nbsp;</td>
		<td>{include file="common_templates/price.tpl" value=$tax_data.tax_subtotal}</td>
	</tr>
	{/foreach}
	{/if}
	{if $order_info.tax_exempt == "Y"}
	<tr>
		<td>{$lang.tax_exempt}</td>
		<td>&nbsp;</td>
	<tr>
	{/if}

	{if $order_info.payment_surcharge|floatval && !$take_surcharge_from_vendor}
	<tr>
		<td>{$order_info.payment_method.surcharge_title|default:$lang.payment_surcharge}:&nbsp;</td>
		<td>{include file="common_templates/price.tpl" value=$order_info.payment_surcharge}</td>
	</tr>
	{/if}
	<tr class="total">
		<td>{$lang.total}:&nbsp;</td>
		<td>{include file="common_templates/price.tpl" value=$order_info.total}</td>
	</tr>
{/hook}
</table>
	</div>
	<div class="clear"></div>
</div>

{if $order_info.promotions}
	{include file="views/orders/components/promotions.tpl" promotions=$order_info.promotions}
{/if}

{if $view_only != "Y"}
<div class="orders-repay">
	{hook name="orders:repay"}
	{if $settings.General.repay == "Y" && $payment_methods}
		{include file="views/orders/components/order_repay.tpl"}
	{/if}
	{/hook}
	</div>
{/if}


{/capture}
<div class="orders-product">
{include file="common_templates/group.tpl"  content=$smarty.capture.group}
</div>
</div><!-- main order info -->


{if $settings.General.use_shipments == "Y"}
	<div id="content_shipment_info" class="orders-shipment {if $selected_section != "shipment_info"}hidden{/if}">
		{foreach from=$shipments key="id" item="shipment"}
			{math equation="id + 1" id=$id assign="shipment_display_id"}
			{include file="common_templates/subheader.tpl" title="`$lang.shipment`&nbsp;#`$shipment_display_id`"}

			<table cellpadding="0" cellspacing="0" border="0" class="table" width="100%">
			<thead>
			<tr>
				<th width="90%">{$lang.product}</th>
				<th>{$lang.quantity}</th>
			</tr>
			</thead>
			{foreach from=$shipment.items item="shipped_product" key="key"}
			{assign var="product_hash" value=$shipped_product.item_id}
			{if $order_info.items.$product_hash}
				{assign var="product" value=$order_info.items.$product_hash}
				{cycle values=",class=\"table-row\"" name="class_cycle" assign="_class"}
				<tr {$_class} valign="top">
					<td>{if $product.is_accessible}<a href="{"products.view?product_id=`$product.product_id`"|fn_url}" class="product-title">{/if}{$product.product|unescape}{if $product.is_accessible}</a>{/if}
						{if $product.extra.is_edp == "Y"}
						<div class="right"><a href="{"orders.order_downloads?order_id=`$order_info.order_id`"|fn_url}"><strong>[{$lang.download}]</strong></a></div>
						{/if}
						{if $product.product_code}
						<p>{$lang.code}:&nbsp;{$product.product_code}</p>
						{/if}
						{if $product.product_options}{include file="common_templates/options_info.tpl" product_options=$product.product_options}{/if}
					</td>
					<td class="center">&nbsp;{$shipped_product.amount}</td>
				</tr>
			{/if}
			{/foreach}
			</table>
			
			<div class="orders-shipment-info"><h2>{$lang.shipping_information}</h2>
			{if $shipment.carrier && $shipment.tracking_number}
				{include file="common_templates/carriers.tpl" carrier=$shipment.carrier tracking_number=$shipment.tracking_number shipment_id=$shipment.shipment_id}
				
				{$shipment.shipping}&nbsp;({$lang.tracking_num}<a {if $smarty.capture.carrier_url|strpos:"://"}target="_blank"{/if} href="{$smarty.capture.carrier_url}">{$shipment.tracking_number}</a>)
			{else}
				{$shipment.shipping}
			{/if}
			</div>
			{if $shipment.comments}
				<div class="orders-shipment-comments"><h2>{$lang.comments}</h2><br />
					<div class="orders-notes-body">
						<div class="orders-notes-arrow"></div>
						{$shipment.comments}
					</div>
				</div>
			{/if}
			
		{foreachelse}
			<p class="no-items">{$lang.text_no_shipments_found}</p>
		{/foreach}
	</div>
{/if}


{hook name="orders:tabs"}
{/hook}

{/capture}
{include file="common_templates/tabsbox.tpl" top_order_actions=$smarty.capture.order_actions content=$smarty.capture.tabsbox active_tab=$smarty.request.selected_section}

{/if}
</div>

{hook name="orders:details"}
{/hook}

{capture name="mainbox_title"}
	<em class="status">{$lang.status}: {include file="common_templates/status.tpl" status=$order_info.status display="view" name="update_order[status]"}</em>
	{$lang.order}&nbsp;#{$order_info.order_id}
	<em class="date">({$order_info.timestamp|date_format:"`$settings.Appearance.date_format`, `$settings.Appearance.time_format`"})</em>
{/capture}
