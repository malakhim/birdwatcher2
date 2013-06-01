{* $Id: grid_list.tpl 10220 2010-07-27 09:09:00Z alexions $ *}

{if $products}

{script src="js/exceptions.js"}

{if !$no_pagination}
	{include file="common_templates/pagination.tpl"}
{/if}

{if !$no_sorting}
	{include file="views/products/components/sorting.tpl"}
{/if}

{if !$show_empty}
{if $products|sizeof < $columns}
	{assign var="columns" value=$products|@sizeof}
{/if}
{split data=$products size=$columns|default:"2" assign="splitted_products"}
{else}
{split data=$products size=$columns|default:"2" assign="splitted_products" skip_complete=true}
{/if}

{math equation="100 / x" x=$columns|default:"2" assign="cell_width"}
{if $item_number == "Y"}
	{assign var="cur_number" value=1}
{/if}
<table cellspacing="0" cellpadding="0" width="100%" border="0" class="fixed-layout multicolumns-list">
{foreach from=$splitted_products item="sproducts" name="sprod"}
<tr{if !$smarty.foreach.sprod.last} class="row-border"{/if}>
{foreach from=$sproducts item="product" name="sproducts"}
	{assign var="obj_id" value=$product.product_id}
	{assign var="obj_id_prefix" value="`$obj_prefix``$product.product_id`"}
	{include file="common_templates/product_data.tpl" product=$product}
	<td class="product-spacer">&nbsp;</td>
	<td valign="top" class="product-cell" width="{$cell_width}%">
	{if $product}
		{assign var="form_open" value="form_open_`$obj_id`"}
		{$smarty.capture.$form_open}
		{hook name="products:product_multicolumns_list"}
		<table border="0" cellpadding="0" cellspacing="0" class="center-block">
		<tr valign="top">
			<td class="product-image">
			<a href="{"products.view?product_id=`$product.product_id`"|fn_url}">{include file="common_templates/image.tpl" obj_id=$obj_id_prefix images=$product.main_pair object_type="product" show_thumbnail="Y" image_width=$settings.Thumbnails.product_lists_thumbnail_width image_height=$settings.Thumbnails.product_lists_thumbnail_height}</a>
			{if $settings.Appearance.disable_quick_view != 'Y'}
			{include file="views/products/components/quick_view_link.tpl"}
			{/if}
			</td>
		</tr>
		<tr>
			<td class="product-title-wrap">
			{if $item_number == "Y"}{$cur_number}.&nbsp;{math equation="num + 1" num=$cur_number assign="cur_number"}{/if}
			{assign var="name" value="name_$obj_id"}{$smarty.capture.$name}
			</td>
		</tr>
		<tr>
			<td class="product-description">
				
				<p>
					{assign var="old_price" value="old_price_`$obj_id`"}
					{if $smarty.capture.$old_price|trim}{$smarty.capture.$old_price}&nbsp;{/if}
					
					{assign var="price" value="price_`$obj_id`"}
					{$smarty.capture.$price}
					
					{assign var="clean_price" value="clean_price_`$obj_id`"}
					{$smarty.capture.$clean_price}
					
					{assign var="list_discount" value="list_discount_`$obj_id`"}
					{$smarty.capture.$list_discount}
				</p>

				{if $show_add_to_cart}
				<div class="buttons-container">
					{assign var="add_to_cart" value="add_to_cart_`$obj_id`"}
					{$smarty.capture.$add_to_cart}
				</div>
				{/if}
			</td>
		</tr>
		</table>
		{/hook}
		{assign var="form_close" value="form_close_`$obj_id`"}
		{$smarty.capture.$form_close}
	{/if}
	</td>
	<td class="product-spacer">&nbsp;</td>
{/foreach}
{if $show_empty && $smarty.foreach.sprod.last}
	{assign var="iteration" value=$smarty.foreach.sproducts.iteration}
	{capture name="iteration"}{$iteration}{/capture}
	{hook name="products:products_multicolumns_extra"}
	{/hook}
	{assign var="iteration" value=$smarty.capture.iteration}
	{if $iteration % $columns != 0} 
		{math assign="empty_count" equation="c - it%c" it=$iteration c=$columns}
		{section loop=$empty_count name="empty_rows"}
			<td class="product-spacer">&nbsp;</td>
			<td valign="top" class="product-cell product-cell-empty" width="{$cell_width}%">
				<div>
					<p>{$lang.empty}</p>
				</div>
			</td>
			<td class="product-spacer">&nbsp;</td>
		{/section}
	{/if}
{/if}
</tr>
{/foreach}
</table>

{if !$no_pagination}
	{include file="common_templates/pagination.tpl"}
{/if}

{/if}

{capture name="mainbox_title"}{$title}{/capture}
