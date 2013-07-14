{math equation="rand()" assign="rnd"}
{assign var="data_id" value="`$data_id`_`$rnd`"}
{assign var="view_mode" value=$view_mode|default:"mixed"}
{assign var="start_pos" value=$start_pos|default:0}
{script src="js/picker.js"}

{if $item_ids && !$item_ids|is_array && $type != "table"}
		{assign var="item_ids" value=","|explode:$item_ids}
{/if}

{if $view_mode != "list"}
	<div class="button-container">
		<a rev="opener_picker_{$data_id}" class="cm-external-click text-button text-button-add">{$lang.add_product}</a>
	</div>
{/if}

{if $view_mode != "button"}
{if $type == "links"}
	<input type="hidden" id="p{$data_id}_ids" name="{$input_name}" value="{if $item_ids}{","|implode:$item_ids}{/if}" />
	{capture name="products_list"}
	<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
	<tr>
		{if $positions}<th>{$lang.position_short}</th>{/if}
		<th width="100%">{$lang.name}</th>
		<th>&nbsp;</th>
		<th>&nbsp;</th>
	</tr>
	<tbody id="{$data_id}"{if !$item_ids} class="hidden"{/if}>
	{include file="pickers/js_product.tpl" clone=true product="`$ldelim`product`$rdelim`" root_id=$data_id delete_id="`$ldelim`delete_id`$rdelim`" type="product" position_field=$positions position="0"}
	{if $item_ids}
	{foreach from=$item_ids item="product" name="items"}
		{include file="pickers/js_product.tpl" product_id=$product product=$product|fn_get_product_name|default:$lang.deleted_product root_id=$data_id delete_id=$product type="product" first_item=$smarty.foreach.items.first position_field=$positions position=$smarty.foreach.items.iteration+$start_pos}
	{/foreach}
	{/if}
	</tbody>
	<tbody id="{$data_id}_no_item"{if $item_ids} class="hidden"{/if}>
	<tr class="no-items">
		<td colspan="{if $positions}4{else}3{/if}"><p>{$no_item_text|default:$lang.no_items}</p></td>
	</tr>
	</tbody>
	</table>
	{/capture}
	{if $picker_view}
		<div class="defined-items">
		{include file="common_templates/popupbox.tpl" id="inner_`$data_id`" link_text=$item_ids|count act="edit" content=$smarty.capture.products_list text="`$lang.editing_defined_products`:" link_class="text-button-edit" picker_meta="cm-bg-close" method="GET"}{$lang.defined_items}
		</div>
	{else}
		{$smarty.capture.products_list}
	{/if}
{elseif $type == "table"}
	<table class="table" width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<th width="80%">{$lang.name}</th>
		<th>{$lang.quantity}</th>
		{hook name="product_picker:table_header"}
		{/hook}
		<th>&nbsp;</th>
	</tr>
	<tbody id="{$data_id}" class="{if !$item_ids}hidden{/if} cm-picker-options">
	{hook name="product_picker:table_rows"}
	{if $item_ids}
	{foreach from=$item_ids item="product" key="product_id"}
		{capture name="product_options"}
			{assign var="prod_opts" value=$product.product_id|fn_get_product_options}
			{if $prod_opts && !$product.product_options}
				<span>{$lang.options}: </span>&nbsp;{$lang.any_option_combinations}
			{elseif $product.product_options}
				{if $product.product_options_value}
					{include file="common_templates/options_info.tpl" product_options=$product.product_options_value}
				{else}
					{include file="common_templates/options_info.tpl" product_options=$product.product_options|fn_get_selected_product_options_info}
				{/if}
			{/if}
		{/capture}
		{if $product.product}
			{assign var="product_name" value=$product.product}
		{else}
			{assign var="product_name" value=$product.product_id|fn_get_product_name|default:$lang.deleted_product}
		{/if}
		{include file="pickers/js_product.tpl" product=$product_name root_id=$data_id delete_id=$product_id input_name="`$input_name`[`$product_id`]" amount=$product.amount amount_input="text" type="options" options=$smarty.capture.product_options options_array=$product.product_options product_id=$product.product_id product_info=$product}
	{/foreach}
	{/if}
	{/hook}
	{include file="pickers/js_product.tpl" clone=true product="`$ldelim`product`$rdelim`" root_id=$data_id delete_id="`$ldelim`delete_id`$rdelim`" input_name="`$input_name`[`$ldelim`product_id`$rdelim`]" amount="1" amount_input="text" type="options" options="`$ldelim`options`$rdelim`" product_id=""}
	</tbody>
	<tbody id="{$data_id}_no_item"{if $item_ids} class="hidden"{/if}>
	<tr class="no-items">
		<td colspan="{$colspan|default:"3"}"><p>{$no_item_text|default:$lang.no_items}</p></td>
	</tr>
	</tbody>
	</table>
	{if !$display}
		{assign var="display" value="options"}
	{/if}
{/if}
{/if}
{if $view_mode != "list"}
	<div class="hidden">
		{if $extra_var}
			{assign var="extra_var" value=$extra_var|escape:url}
		{/if}
		{if !$no_container}<div class="buttons-container">{/if}{if $picker_view}[{/if}
			{include file="buttons/button.tpl" but_id="opener_picker_`$data_id`" but_href="products.picker?display=`$display`&amp;company_id=`$company_id`&amp;company_ids=`$company_ids`&amp;picker_for=`$picker_for`&amp;extra=`$extra_var`&amp;checkbox_name=`$checkbox_name`&amp;aoc=`$aoc`&amp;data_id=`$data_id`"|fn_url but_text=$but_text|default:$lang.add_products but_role="add" but_rev="content_`$data_id`" but_meta="cm-dialog-opener"}
		{if $picker_view}]{/if}{if !$no_container}</div>{/if}
		<div class="hidden" id="content_{$data_id}" title="{$but_text|default:$lang.add_products}">
		</div>
	</div>
{/if}