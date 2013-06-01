<div id="gift_cert_verify">
{if $verify_data}

<div id="gift_cert_data" title="{$lang.gift_certificate_verification}">
<div class="gift-verify">
{** /Gift certificates section **}
{capture name="tabsbox"}
<div id="content_detailed" class="hidden">
	<h5 class="subheader">{$lang.gift_certificate_info}</h5>
	<div class="info-field-body">
	<table cellpadding="0" cellspacing="4" border="0" class="gift-verify-table">
	<tr>
		<td width="30%"><strong>{$lang.gift_cert_code}:</strong></td>
		<td><strong>{$verify_data.gift_cert_code}</strong></td>
	</tr>
	<tr>
		<td><strong>{$lang.status}:</strong></td>
		<td>{include file="common_templates/status.tpl" status=$verify_data.status display="view" status_type=$smarty.const.STATUSES_GIFT_CERTIFICATE}</td>
	</tr>
	<tr>
		<td><strong>{$lang.gift_cert_to}:</strong></td>
		<td>{$verify_data.recipient}</td>
	</tr>
	<tr>
		<td><strong>{$lang.gift_cert_from}:</strong></td>
		<td>{$verify_data.sender}</td>
	</tr>
	<tr>
		<td><strong>{$lang.amount}:</strong></td>
		<td width="250">{include file="common_templates/price.tpl" value=$verify_data.amount}</td>
	</tr>
	</table>
	</div>
	{if $addons.gift_certificates.free_products_allow == "Y" && $verify_data.products}
	<h5 class="subheader">{$lang.free_products}</h5>
	<div class="info-field-body product-options">
	<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
		<thead>
			<tr>
				<th width="90%">{$lang.product}</th>
				<th>{$lang.quantity}</th>
			</tr>
		</thead>
		{foreach from=$verify_data.products item="product_item"}
		<tr {cycle values=",class=\"table-row\""}>
			<td>
			<a href="{"products.view?product_id=`$product_item.product_id`"|fn_url}">{$product_item.product|default:$lang.deleted_product}</a>
			{include file="common_templates/options_info.tpl" product_options=$product_item.product_options_value}
			</td>
			<td class="center">{$product_item.amount}</td>
		</tr>
		{foreachelse}
		<tr>
			<td colspan="2"><p class="no-items">{$lang.no_items}</p></td>
		</tr>
		{/foreach}
		</table>
	</div>
	{/if}

</div>
<div id="content_log" class="hidden">
	{include file="common_templates/pagination.tpl"}

	{assign var="c_url" value=$config.current_url|fn_query_remove:"sort_by":"sort_order"}
	{if $sort_order == "asc"}
		{assign var="sort_sign" value="table-asc"}
	{else}
		{assign var="sort_sign" value="table-desc"}
	{/if}

	<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table gift-history">
		<thead>
			<tr>
				<th><a class="cm-ajax {if $sort_by == "timestamp"}{$sort_sign}{/if}" href="{"`$c_url`&amp;sort_by=timestamp&amp;sort_order=`$sort_order`"|fn_url}" rev="pagination_contents">{$lang.date}</a></th>
				<th ><a class="cm-ajax {if $sort_by == "name"}{$sort_sign}{/if}" href="{"`$c_url`&amp;sort_by=name&amp;sort_order=`$sort_order`"|fn_url}" rev="pagination_contents">{$lang.customer}</a></th>
				<th ><a class="cm-ajax {if $sort_by == "amount"}{$sort_sign}{/if}" href="{"`$c_url`&amp;sort_by=amount&amp;sort_order=`$sort_order`"|fn_url}" rev="pagination_contents">{$lang.balance}</a></th>
				<th ><a class="cm-ajax {if $sort_by == "debit"}{$sort_sign}{/if}" href="{"`$c_url`&amp;sort_by=debit&amp;sort_order=`$sort_order`"|fn_url}" rev="pagination_contents">{$lang.gift_cert_debit}</a></th>
			</tr>
		</thead>
	{foreach from=$log item="l"}
	<tr>
		<td width="30px">{$l.timestamp|date_format:"`$settings.Appearance.date_format`, `$settings.Appearance.time_format`"}</td>
		<td>
			<p>
			{if $l.user_id}
				{$l.firstname} {$l.lastname}
			{elseif $l.order_id}
				{$l.order_firstname} {$l.order_lastname}
			{/if}
			</p>
			<p>
			{if $l.user_id}
				<a href="mailto:{$l.email|escape:url}">{$l.email}</a>
			{else}
				<a href="mailto:{$l.order_email|escape:url}">{$l.order_email}</a>
			{/if}
			</p>
		</td>
		<td>
			{if $addons.gift_certificates.free_products_allow == "Y"}{$lang.amount}:&nbsp;{/if}{include file="common_templates/price.tpl" value=$l.amount}
			{if $l.products && $addons.gift_certificates.free_products_allow == "Y"}
				<p>{$lang.free_products}:</p>
				<ol>
				{foreach from=$l.products item="product_item"}
				<li>{if $product_item.product}<a href="{"products.view?product_id=`$product_item.product_id`"|fn_url}">{$product_item.product|truncate:30:"...":true}</a>{else}{$lang.deleted_product}{/if}<span>({$product_item.amount})</span></li>
				{/foreach}
				</ol>
			{/if}
		</td>
		<td>
			{if $addons.gift_certificates.free_products_allow == "Y"}{$lang.amount}:&nbsp;{/if}{include file="common_templates/price.tpl" value=$l.debit}
			{if $l.debit_products && $addons.gift_certificates.free_products_allow == "Y"}
				<p>{$lang.free_products}:</p>
				<ol>
				{foreach from=$l.debit_products item="product_item"}
				<li>{$product_item.amount} - {if $product_item.product}<a href="{"products.view?product_id=`$product_item.product_id`"|fn_url}">{$product_item.product|truncate:30:"...":true}</a>{else}{$lang.deleted_product}{/if}</li>
				{/foreach}
				</ol>
			{/if}
		</td>
		</tr>
		{foreachelse}
		<tr>
			<td colspan="5"><p class="no-items">{$lang.no_items}</p></td>
		</tr>
		{/foreach}
		</table>
		{include file="common_templates/pagination.tpl"}
	</div>
	{/capture}
	{include file="common_templates/tabsbox.tpl" content=$smarty.capture.tabsbox active_tab=$smarty.request.selected_section}

</div>

{else}
	<div class="gift-validate-error center strong">{$lang.error_gift_cert_code}</div>
{/if}
</div>
{** /Gift certificates section **}
<!--gift_cert_verify--></div>
{capture name="mainbox_title"}{$lang.gift_certificate_verification}{/capture}