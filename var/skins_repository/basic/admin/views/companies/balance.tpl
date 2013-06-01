{capture name="mainbox"}

{if PRODUCT_TYPE == "MULTIVENDOR" && "COMPANY_ID"|defined}
	{assign var="hide_controls" value=true}
{/if}

{assign var="c_url" value=$config.current_url|fn_query_remove:"sort_by":"sort_order"}
{include file="views/companies/components/balance_search_form.tpl" dispatch="companies.balance"}

{capture name="add_new_picker"}
	{include file="views/companies/components/balance_new_payment.tpl" c_url=$c_url}
{/capture}
{include file="common_templates/popupbox.tpl" id="add_payment" content=$smarty.capture.add_new_picker text=$lang.new_payout act="hidden"}

<form action="{""|fn_url}" method="post" name="manage_payouts_form">

{include file="common_templates/pagination.tpl" save_current_page=true save_current_url=true}

<input type="hidden" name="redirect_url" value="{$c_url}" />

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table sortable">
<tr>
	<th class="center"><input type="checkbox" name="check_all" value="Y" title="{$lang.check_uncheck_all}" class="checkbox cm-check-items" /></th>
	<th><a class="cm-ajax{if $search.sort_by == "sort_vendor"} sort-link-{$search.sort_order}{/if}" href="{"`$c_url`&amp;sort_by=sort_vendor&amp;sort_order=`$search.sort_order`"|fn_url}" rev="pagination_contents">{$lang.vendor}</a></th>
	<th><a class="cm-ajax{if $search.sort_by == "sort_period"} sort-link-{$search.sort_order}{/if}" href="{"`$c_url`&amp;sort_by=sort_period&amp;sort_order=`$search.sort_order`"|fn_url}" rev="pagination_contents">{$lang.sales_period}</a></th>
	<th><a class="cm-ajax{if $search.sort_by == "sort_amount"} sort-link-{$search.sort_order}{/if}" href="{"`$c_url`&amp;sort_by=sort_amount&amp;sort_order=`$search.sort_order`"|fn_url}" rev="pagination_contents">{$lang.payment_amount}</a></th>
	<th><a class="cm-ajax{if $search.sort_by == "sort_date"} sort-link-{$search.sort_order}{/if}" href="{"`$c_url`&amp;sort_by=sort_date&amp;sort_order=`$search.sort_order`"|fn_url}" rev="pagination_contents">{$lang.date}</a></th>
	<th>{$lang.vendor_commission}</th>
	<th>{$lang.payment}</th>
	<th class="center" width="5%">
		<img src="{$images_dir}/plus_minus.gif" width="13" height="12" border="0" name="plus_minus" id="on_st" alt="{$lang.expand_collapse_list}" title="{$lang.expand_collapse_list}" class="hand cm-combinations-visitors" /><img src="{$images_dir}/minus_plus.gif" width="13" height="12" border="0" name="minus_plus" id="off_st" alt="{$lang.expand_collapse_list}" title="{$lang.expand_collapse_list}" class="hand hidden cm-combinations-visitors" /></th>
</tr>
{foreach name="payouts" from=$payouts item=payout}
<tr {cycle values="class=\"table-row\", "}>
	<td class="center">
   		<input type="checkbox" name="payout_ids[]" value="{$payout.payout_id}" class="checkbox cm-item" /></td>
	<td>
		{if $payout.company_id}
			{$payout.company|default:$lang.deleted}
		{else}
			{$settings.Company.company_name}
		{/if}
	</td>
	<td>
		{if !$payout.date}
			{$payout.start_date|date_format:"`$settings.Appearance.date_format`"}&nbsp;-&nbsp;{$payout.end_date|date_format:"`$settings.Appearance.date_format`"}
		{else}
			-
		{/if}
	</td>
	<td>
		<span class="{if $payout.payout_amount < 0}negative-price{else}positive-price{/if}">{include file="common_templates/price.tpl" value=$payout.payout_amount}</span>
	</td>
	<td>
		{$payout.payout_date|date_format:"`$settings.Appearance.date_format`, `$settings.Appearance.time_format`"}
	</td>
	<td>
		{if $payout.commission_type == "A"}{include file="common_templates/price.tpl" value=$payout.commission}{else}{$payout.commission}%{/if}
	</td>
	<td>
		{if $payout.payment_method}{$payout.payment_method}{elseif $payout.order_id}{$lang.order}: <a href="{"orders.details?order_id=`$payout.order_id`"|fn_url}">#{$payout.order_id}</a>{else}-{/if}
	</td>
	<td class="center nowrap">
		<img src="{$images_dir}/plus.gif" width="14" height="9" border="0" name="plus_minus" id="on_payout_note_{$smarty.foreach.payouts.iteration}" alt="{$lang.expand_collapse_list}" title="{$lang.expand_collapse_list}" class="hand cm-combination-visitors" /><img src="{$images_dir}/minus.gif" width="14" height="9" border="0" name="minus_plus" id="off_payout_note_{$smarty.foreach.payouts.iteration}" alt="{$lang.expand_collapse_list}" title="{$lang.expand_collapse_list}" class="hand hidden cm-combination-visitors" /><a id="sw_payout_note_{$smarty.foreach.payouts.iteration}" class="cm-combination-visitors">{$lang.extra}</a>&nbsp;&nbsp;
		
		{if !$hide_controls}
		{capture name="table_tools_list"}
			<li><a class="cm-confirm" href="{"companies.payout_delete?payout_id=`$payout.payout_id`"|fn_url}&redirect_url={$c_url|rawurlencode}">{$lang.delete}</a></li>
		{/capture}
		{include file="common_templates/table_tools_list.tpl" tools_list=$smarty.capture.table_tools_list separate=true}
		{/if}
		
	</td>
</tr>
<tr id="payout_note_{$smarty.foreach.payouts.iteration}" {if $hide_extra_button != "Y"}class="hidden"{/if}>
	<td colspan="7">
	<div class="scroll-x">
		<div class="form-field">
			<label for="payout_comments_{$payout.payout_id}">{$lang.comment}:</label>
			{if "COMPANY_ID"|defined}
				{if $payout.comments}{$payout.comments}{else}-{/if}
			{else}
			<textarea class="input-textarea" rows="4" cols="25" name="payout_comments[{$payout.payout_id}]" id="payout_comments_{$payout.payout_id}">{strip}
				{$payout.comments}
			{/strip}</textarea>
			{/if}
		</div>
	</div>	
	</td>
</tr>
{foreachelse}
<tr class="no-items">
	<td colspan="7"><p>{$lang.no_data}</p></td>
</tr>
{/foreach}
</table>

{if $payouts}
	{include file="common_templates/table_tools.tpl" href="#products" visibility="Y"}
{/if}

{include file="common_templates/pagination.tpl"}

{include file="views/companies/components/balance_info.tpl"}

{if !$hide_controls}

	{if $payouts}
	<div class="buttons-container buttons-bg">
		<div class="float-left">
			{include file="buttons/button.tpl" but_text=$lang.save but_name="dispatch[companies.update_payout_comments]" but_role="button_main"}
			{include file="buttons/button.tpl" but_text=$lang.delete_selected but_name="dispatch[companies.payouts_m_delete]" but_meta="cm-confirm cm-process-items" but_role="button_main"}
		</div>
	</div>
	{/if}
	
	{capture name="tools"}
		{include file="common_templates/popupbox.tpl" id="add_payment" text=$lang.new_payout content="" link_text=$lang.add_payout act="general"}
	{/capture}	

{/if}

</form>

{/capture}
{include file="common_templates/mainbox.tpl" title=$lang.vendor_account_balance content=$smarty.capture.mainbox tools=$smarty.capture.tools title_extra=$smarty.capture.title_extra}