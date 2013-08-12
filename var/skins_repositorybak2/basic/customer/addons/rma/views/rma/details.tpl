<div class="rma">
	<div class="rma-actions clearfix">
		{include file="buttons/button_popup.tpl" but_text=$lang.print_slip but_href="rma.print_slip?return_id=`$return_info.return_id`" width="800" height="600" but_role="text"}
		{include file="buttons/button.tpl" but_text=$lang.related_order but_href="orders.details?order_id=`$return_info.order_id`" but_role="text" but_meta="related"}
	</div>
<div class="clear"></div>
{if $return_info}
<form action="{""|fn_url}" method="post" name="return_info_form" />
<input type="hidden" name="return_id" value="{$smarty.request.return_id}" />
<input type="hidden" name="order_id" value="{$return_info.order_id}" />
<input type="hidden" name="total_amount" value="{$return_info.total_amount}" />
<input type="hidden" name="return_status" value="{$return_info.status}" />
{capture name="tabsbox"}
{** RETURN PRODUCTS SECTION **}
	<div id="content_return_products">
		<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table rma-return-table">
			<thead>
			<tr>
				<th class="products">{$lang.product}</th>
				<th class="price right">{$lang.price}</th>
				<th class="qty">{$lang.quantity}</th>
				<th class="reason left">{$lang.reason}</th>
			</tr>
		</thead>
		{foreach from=$return_info.items[$smarty.const.RETURN_PRODUCT_ACCEPTED] item="ri" key="key"}
		<tr {cycle values=",class=\"table-row\""}>
			<td>{if !$ri.deleted_product}<a href="{"products.view?product_id=`$ri.product_id`"|fn_url}">{/if}{$ri.product|unescape}{if !$ri.deleted_product}</a>{/if}
				{if $ri.product_options}
					{include file="common_templates/options_info.tpl" product_options=$ri.product_options}
				{/if}</td>
			<td class="right nowrap">
				{if !$ri.price}{$lang.free}{else}{include file="common_templates/price.tpl" value=$ri.price}{/if}</td>
			<td class="center">{$ri.amount}</td>
			<td class="nowrap">
				{assign var="reason_id" value=$ri.reason}
				{$reasons.$reason_id.property}</td>
		</tr>
		{foreachelse}
		<tr>
			<td colspan="6"><p class="no-items">{$lang.text_no_products_found}</p></td>
		</tr>
		{/foreach}
		</table>
	</div>
{** /RETURN PRODUCTS SECTION **}

{** DECLINED PRODUCTS SECTION **}
	<div id="content_declined_products" class="hidden">
		<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
		<thead>
		<tr>
				<th width="100%">{$lang.product}</th>
				<th>{$lang.price}</th>
				<th>{$lang.quantity}</th>
				<th>{$lang.reason}</th>
			</tr>
		</thead>
		{foreach from=$return_info.items[$smarty.const.RETURN_PRODUCT_DECLINED] item="ri" key="key"}
		<tr {cycle values=",class=\"table-row\""}>
			<td>
				{if !$ri.deleted_product}<a href="{"products.view?product_id=`$ri.product_id`"|fn_url}">{/if}{$ri.product|unescape}{if !$ri.deleted_product}</a>{/if}
				{if $ri.product_options}
					{include file="common_templates/options_info.tpl" product_options=$ri.product_options}
				{/if}</td>
			<td class="right nowrap">
				{if !$ri.price}{$lang.free}{else}{include file="common_templates/price.tpl" value=$ri.price}{/if}</td>
			<td class="center">{$ri.amount}</td>
			<td class="nowrap">
				{assign var="reason_id" value=$ri.reason}
				{$reasons.$reason_id.property}</td>
		</tr>
		{foreachelse}
		<tr>
			<td colspan="6"><p class="no-items">{$lang.text_no_products_found}</p></td>
		</tr>
		{/foreach}
		</table>
	</div>
{** /DECLINED PRODUCTS SECTION **}

{/capture}
{include file="common_templates/tabsbox.tpl" content=$smarty.capture.tabsbox active_tab=$smarty.request.selected_section}
{if $return_info.comment}
	<div class="rma-comments">
		{include file="common_templates/subheader.tpl" title=$lang.comments}
		<div class="rma-comments-body">
			<div class="rma-comments-arrow"></div>
			{$return_info.comment|nl2br}
		</div>
	</div>
{/if}
</form>
{/if}

{capture name="mainbox_title"}
	<div class="rma-status">
		<em>{$lang.status}: {include file="common_templates/status.tpl" status=$return_info.status display="view" name="update_return[status]" status_type=$smarty.const.STATUSES_RETURN}</em>
		<em>{$lang.action}: {assign var="action_id" value=$return_info.action}{$actions.$action_id.property}</em>
	</div>
		{$lang.return_info}&nbsp;#{$return_info.return_id}
	<em class="rma-date">
		({$return_info.timestamp|date_format:"`$settings.Appearance.date_format`, `$settings.Appearance.time_format`"})
	</em>
{/capture}
</div>