{capture name="mainbox"}

{include file="addons/vendor_data_premoderation/views/premoderation/components/products_search_form.tpl" dispatch="premoderation.products_approval"}

<form action="{""|fn_url}" method="post" name="manage_products_form">
<input type="hidden" name="category_id" value="{$search.cid}" />

{include file="common_templates/pagination.tpl" save_current_page=true save_current_url=true}

{assign var="c_url" value=$config.current_url|fn_query_remove:"sort_by":"sort_order"}

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table sortable">
<tr>
	<th class="center"><input type="checkbox" name="check_all" value="Y" title="{$lang.check_uncheck_all}" class="checkbox cm-check-items" /></th>
	<th width="50%"><a class="cm-ajax{if $search.sort_by == "product"} sort-link-{$search.sort_order}{/if}" href="{"`$c_url`&amp;sort_by=product&amp;sort_order=`$search.sort_order`"|fn_url}" rev="pagination_contents">{$lang.name}</a></th>
	<th width="20%"><a class="cm-ajax{if $search.sort_by == "company"} sort-link-{$search.sort_order}{/if}" href="{"`$c_url`&amp;sort_by=company&amp;sort_order=`$search.sort_order`"|fn_url}" rev="pagination_contents">{$lang.vendor}</a></th>
	<th width="15%"><a class="cm-ajax{if $search.sort_by == "approval"} sort-link-{$search.sort_order}{/if}" href="{"`$c_url`&amp;sort_by=approval&amp;sort_order=`$search.sort_order`"|fn_url}" rev="pagination_contents">{$lang.status}</a></th>
	<th>&nbsp;</th>
</tr>
{foreach from=$products item=product}
<tr {cycle values="class=\"table-row\", "}>
	<td class="center">
   		<input type="checkbox" name="product_ids[]" value="{$product.product_id}" class="checkbox cm-item" /></td>
	<td>
		<div class="float-left">
			<input type="hidden" name="products_data[{$product.product_id}][product]" value="{$product.product}" />
			<a href="{"products.update?product_id=`$product.product_id`"|fn_url}" {if $product.status == "N"}class="manage-root-item-disabled"{/if}>{$product.product|unescape} {include file="views/companies/components/company_name.tpl" company_name=$product.company_name company_id=$product.company_id}</a></div>
		<div class="float-right">
		</div>
	</td>
	<td>
		<input type="hidden" name="products_data[{$product.product_id}][company_id]" value="{$product.company_id}" />
		{$product.company_name}
	<td>
		{if $product.approved == "Y"}{$lang.approved}{elseif $product.approved == "P"}{$lang.pending}{else}{$lang.disapproved}{/if}
		<input type="hidden" name="products_data[{$product.product_id}][current_status]" value="{$product.approved}" />
	<td class="nowrap">
		{capture name="approve"}
			{include file="addons/vendor_data_premoderation/views/premoderation/components/approval_popup.tpl" name="approval_data[`$product.product_id`]" status="Y" product_id=$product.product_id company_id=$product.company_id}
			<div class="buttons-container">
				{include file="buttons/save_cancel.tpl" but_text=$lang.approve but_name="dispatch[premoderation.products_approval.approve.`$product.product_id`]" cancel_action="close"}
			</div>
		{/capture}
		
		{capture name="disapprove"}
			{include file="addons/vendor_data_premoderation/views/premoderation/components/approval_popup.tpl" name="approval_data[`$product.product_id`]" status="N" product_id=$product.product_id company_id=$product.company_id}
			<div class="buttons-container">
				{include file="buttons/save_cancel.tpl" but_text=$lang.disapprove but_name="dispatch[premoderation.products_approval.disapprove.`$product.product_id`]" cancel_action="close"}
			</div>
		{/capture}
		
		{if $product.approved == "Y" || $product.approved == "P"}
			{include file="common_templates/popupbox.tpl" id="disapprove_`$product.product_id`" text="`$lang.disapprove` \"`$product.product`\"" text=$lang.disapprove content=$smarty.capture.disapprove link_text=$lang.disapprove act="edit"}
		{/if}
		
		{if $product.approved == "P" || $product.approved == "N"}
			{include file="common_templates/popupbox.tpl" id="approve_`$product.product_id`" text="`$lang.approve` \"`$product.product`\"" text=$lang.approve content=$smarty.capture.approve link_text=$lang.approve act="edit"}
		{/if}
		
	</td>
</tr>
{foreachelse}
<tr class="no-items">
	<td colspan="5"><p>{$lang.no_data}</p></td>
</tr>
{/foreach}
</table>

{include file="common_templates/pagination.tpl"}

{if $products}
	{capture name="approve_selected"}
		{include file="addons/vendor_data_premoderation/views/premoderation/components/reason_container.tpl" type="approved"}
		<div class="buttons-container">
			{include file="buttons/save_cancel.tpl" but_text=$lang.proceed but_name="dispatch[premoderation.m_approve]" cancel_action="close" but_meta="cm-process-items"}
		</div>
	{/capture}
	{include file="common_templates/popupbox.tpl" id="approve_selected" text=$lang.approve_selected content=$smarty.capture.approve_selected link_text=$lang.approve_selected}	

	{capture name="disapprove_selected"}
		{include file="addons/vendor_data_premoderation/views/premoderation/components/reason_container.tpl" type="declined"}
		<div class="buttons-container">
			{include file="buttons/save_cancel.tpl" but_text=$lang.proceed but_name="dispatch[premoderation.m_decline]" cancel_action="close" but_meta="cm-process-items"}
		</div>
	{/capture}
	{include file="common_templates/popupbox.tpl" id="disapprove_selected" text=$lang.disapprove_selected content=$smarty.capture.disapprove_selected link_text=$lang.disapprove_selected}

	<div class="buttons-container buttons-bg">
		{include file="buttons/button.tpl" but_role="button_main" but_rev="content_approve_selected" but_text=$lang.approve_selected but_meta="cm-process-items cm-dialog-opener"}
		{include file="buttons/button.tpl" but_role="button_main" but_rev="content_disapprove_selected" but_text=$lang.disapprove_selected but_meta="cm-process-items cm-dialog-opener"}
	</div>
{/if}

</form>

{/capture}
{include file="common_templates/mainbox.tpl" title=$lang.product_approval content=$smarty.capture.mainbox select_languages=true}
