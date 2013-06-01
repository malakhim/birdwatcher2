{capture name="mainbox"}

{include file="views/products/components/products_search_form.tpl" dispatch="products.manage"}

<div id="content_manage_products">
<form action="{""|fn_url}" method="post" name="manage_products_form">
<input type="hidden" name="category_id" value="{$search.cid}" />

{include file="common_templates/pagination.tpl" save_current_page=true save_current_url=true div_id=$smarty.request.content_id}

{assign var="c_url" value=$config.current_url|fn_query_remove:"sort_by":"sort_order"}

{assign var="rev" value=$smarty.request.content_id|default:"pagination_contents"}

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table sortable hidden-inputs">
<tr>
	<th class="center">
		<input type="checkbox" name="check_all" value="Y" title="{$lang.check_uncheck_all}" class="checkbox cm-check-items" /></th>
	{if $search.cid && $search.subcats != "Y"}
	<th><a class="cm-ajax{if $search.sort_by == "position"} sort-link-{$search.sort_order}{/if}" href="{"`$c_url`&amp;sort_by=position&amp;sort_order=`$search.sort_order`"|fn_url}" rev={$rev}>{$lang.position_short}</a></th>
	{/if}
	<th width="5%"><span>{$lang.image}</span></th>
	<th width="60%"><a class="{$ajax_class}{if $search.sort_by == "product"} sort-link-{$search.sort_order}{/if}" href="{"`$c_url`&amp;sort_by=product&amp;sort_order=`$search.sort_order`"|fn_url}" rev={$rev}>{$lang.name}</a> / <a class="{$ajax_class}{if $search.sort_by == "code"} sort-link-{$search.sort_order}{/if}" href="{"`$c_url`&amp;sort_by=code&amp;sort_order=`$search.sort_order`"|fn_url}" rev={$rev}>{$lang.product_code}</a></th>
	<th width="15%"><a class="cm-ajax{if $search.sort_by == "price"} sort-link-{$search.sort_order}{/if}" href="{"`$c_url`&amp;sort_by=price&amp;sort_order=`$search.sort_order`"|fn_url}" rev={$rev}>{$lang.price} ({$currencies.$primary_currency.symbol})</a></th>
	<th width="5%"><a class="cm-ajax{if $search.sort_by == "list_price"} sort-link-{$search.sort_order}{/if}" href="{"`$c_url`&amp;sort_by=list_price&amp;sort_order=`$search.sort_order`"|fn_url}" rev={$rev}>{$lang.list_price} ({$currencies.$primary_currency.symbol})</a></th>
	{if $search.order_ids}
	<th width="5%"><a class="cm-ajax{if $search.sort_by == "p_qty"} sort-link-{$search.sort_order}{/if}" href="{"`$c_url`&amp;sort_by=p_qty&amp;sort_order=`$search.sort_order`"|fn_url}" rev={$rev}>{$lang.purchased_qty}</a></th>
	<th width="5%"><a class="cm-ajax{if $search.sort_by == "p_subtotal"} sort-link-{$search.sort_order}{/if}" href="{"`$c_url`&amp;sort_by=p_subtotal&amp;sort_order=`$search.sort_order`"|fn_url}" rev={$rev}>{$lang.subtotal_sum} ({$currencies.$primary_currency.symbol})</a></th>
	{/if}
	<th width="5%"><a class="cm-ajax{if $search.sort_by == "amount"} sort-link-{$search.sort_order}{/if}" href="{"`$c_url`&amp;sort_by=amount&amp;sort_order=`$search.sort_order`"|fn_url}" rev={$rev}>{$lang.quantity}</a></th>
	<th>{hook name="products:manage_head"}{/hook}</th>
	<th width="15%"><a class="cm-ajax{if $search.sort_by == "status"} sort-link-{$search.sort_order}{/if}" href="{"`$c_url`&amp;sort_by=status&amp;sort_order=`$search.sort_order`"|fn_url}" rev={$rev}>{$lang.status}</a></th>
	<th>&nbsp;</th>
</tr>
{foreach from=$products item=product}



<tr class="{cycle values="table-row,"} {$hide_inputs_if_shared_product}">
	<td class="center">
   		<input type="checkbox" name="product_ids[]" value="{$product.product_id}" class="checkbox cm-item" /></td>
	{if $search.cid && $search.subcats != "Y"}
	<td>
		<input type="text" name="products_data[{$product.product_id}][position]" size="3" value="{$product.position}" class="input-text-short" /></td>
	{/if}
	<td class="product-image-table">
	{include file="common_templates/image.tpl" image=$product.main_pair.icon|default:$product.main_pair.detailed image_id=$product.main_pair.image_id image_width=50 object_type=$object_type href="products.update?product_id=`$product.product_id`"|fn_url}
		</td>
	<td>
		<div class="float-left">
				<input type="hidden" name="products_data[{$product.product_id}][product]" value="{$product.product}" {if $no_hide_input_if_shared_product} class="{$no_hide_input_if_shared_product}"{/if} />
				<a href="{"products.update?product_id=`$product.product_id`"|fn_url}" class="strong{if $product.status == "N"} manage-root-item-disabled{/if}">{$product.product|unescape} {include file="views/companies/components/company_name.tpl" company_name=$product.company_name company_id=$product.company_id}</a><div><span class="product-code-label">{$lang.product_code}: </span><input type="text" name="products_data[{$product.product_id}][product_code]" size="15" maxlength="32" value="{$product.product_code}" class="input-text product-code" /></div></div>
		<div class="float-right">
		</div>
	</td>
	<td{if $no_hide_input_if_shared_product} class="{$no_hide_input_if_shared_product}"{/if}>
		<div class="product-price">
			<input type="text" name="products_data[{$product.product_id}][price]" size="6" value="{$product.price|fn_format_price:$primary_currency:null:false}" class="input-text" />
			{include file="buttons/update_for_all.tpl" display=$show_update_for_all object_id='price' name="update_all_vendors[price]"}
		</div>
	</td>
	<td>
		<input type="text" name="products_data[{$product.product_id}][list_price]" size="6" value="{$product.list_price}" class="input-text" /></td>
	{if $search.order_ids}
	<td>{$product.purchased_qty}</td>
	<td>{$product.purchased_subtotal}</td>
	{/if}
	<td>
		{if $product.tracking == "O"}
		{include file="buttons/button.tpl" but_text=$lang.edit but_href="product_options.inventory?product_id=`$product.product_id`" but_role="edit"}
		{else}
		<input type="text" name="products_data[{$product.product_id}][amount]" size="6" value="{$product.amount}" class="input-text-short" />
		{/if}
	</td>
	<td>{hook name="products:manage_body"}{/hook}</td>
	<td>
		{include file="common_templates/select_popup.tpl" id=$product.product_id status=$product.status hidden=true object_id_name="product_id" table="products"}
	</td>
	<td class="nowrap">
		{capture name="tools_items"}
		{hook name="products:list_extra_links"}
		{if !$hide_inputs_if_shared_product}
			<li><a class="cm-confirm" href="{"products.delete?product_id=`$product.product_id`"|fn_url}">{$lang.delete}</a></li>
		{/if}
		{/hook}
		{/capture}
		{include file="common_templates/table_tools_list.tpl" prefix=$product.product_id tools_list=$smarty.capture.tools_items href="products.update?product_id=`$product.product_id`"}
	</td>
</tr>
{foreachelse}
<tr class="no-items">
	<td colspan="{if $search.cid && $search.subcats != "Y"}12{else}11{/if}"><p>{$lang.no_data}</p></td>
</tr>
{/foreach}
</table>

{if $products}
	{include file="common_templates/table_tools.tpl" href="#products" visibility="Y"}
{/if}

{include file="common_templates/pagination.tpl" div_id=$smarty.request.content_id}

{if $products}
<div class="buttons-container buttons-bg">
	<div class="float-left">
		{capture name="tools_list"}
		<ul>
			<li><a class="cm-process-items" name="dispatch[products.m_clone]" rev="manage_products_form">{$lang.clone_selected}</a></li>
			<li><a class="cm-process-items" name="dispatch[products.export_range]" rev="manage_products_form">{$lang.export_selected}</a></li>
			<li><a class="cm-confirm cm-process-items" name="dispatch[products.m_delete]" rev="manage_products_form">{$lang.delete_selected}</a></li>
			<li><a class="cm-process-items cm-dialog-opener" rev="content_select_fields_to_edit" >{$lang.edit_selected}</a></li>
			{** Hook for the actions menu on the products manage page *}
			{hook name="products:list_tools"}
			{/hook}
		</ul>
		{/capture}

		{include file="buttons/save.tpl" but_name="dispatch[products.m_update]" but_role="button_main"}
		{include file="common_templates/tools.tpl" prefix="main`$smarty.request.content_id`" hide_actions=true tools_list=$smarty.capture.tools_list display="inline" link_text=$lang.choose_action}
	</div>
</div>
{/if}


{capture name="select_fields_to_edit"}

<p>{$lang.text_select_fields2edit_note}</p>
{include file="views/products/components/products_select_fields.tpl"}

<div class="buttons-container">
	{include file="buttons/save_cancel.tpl" but_text=$lang.modify_selected but_name="dispatch[products.store_selection]" cancel_action="close"}
</div>
{/capture}
{include file="common_templates/popupbox.tpl" id="select_fields_to_edit" text=$lang.select_fields_to_edit content=$smarty.capture.select_fields_to_edit}

{capture name="tools"}
	{include file="common_templates/tools.tpl" tool_href="products.add" prefix="top" link_text=$lang.add_product hide_tools=true}
{/capture}

</form>
<!--content_manage_products--></div>

{/capture}
{include file="common_templates/mainbox.tpl" title=$lang.products content=$smarty.capture.mainbox title_extra=$smarty.capture.title_extra tools=$smarty.capture.tools select_languages=true}
