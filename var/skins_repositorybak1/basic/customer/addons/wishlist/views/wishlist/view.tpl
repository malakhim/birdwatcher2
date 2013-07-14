{assign var="columns" value=4}
{if !$wishlist|fn_cart_is_empty}

	{script src="js/exceptions.js"}

	{assign var="show_hr" value=false}
	{assign var="location" value="cart"}
{/if}
{if $products}
	{include file="blocks/list_templates/grid_list.tpl" 
		columns=$columns
		show_empty=true
		show_trunc_name=true 
		show_old_price=true 
		show_price=true 
		show_clean_price=true 
		show_list_discount=true
		no_pagination=true
		no_sorting=true
		show_add_to_cart=false
		is_wishlist=true}
{else}
{math equation="100 / x" x=$columns|default:"2" assign="cell_width"}
<table cellspacing="0" cellpadding="0" width="100%" border="0" class="fixed-layout multicolumns-list">
	<tr class="row-border">
	{assign var="iteration" value=0}
	{capture name="iteration"}{$iteration}{/capture}
	{hook name="wishlist:view"}
	{/hook}
	{assign var="iteration" value=$smarty.capture.iteration}
	{if $iteration == 0 || $iteration % $columns != 0} 
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

	</tr>
</table>
{/if}
{if !$wishlist|fn_cart_is_empty}
	<div class="buttons-container wish-list-btn">
		{include file="buttons/button.tpl" but_text=$lang.clear_wishlist but_href="wishlist.clear"}
		{include file="buttons/continue_shopping.tpl" but_href=$continue_url|default:$index_script but_role="text"}
	</div>
{else}
	<div class="buttons-container wish-list-btn wish-list-continue">
		{include file="buttons/continue_shopping.tpl" but_href=$continue_url|default:$index_script but_role="text"}
	</div>

{/if}

{capture name="mainbox_title"}{$lang.wishlist_content}{/capture}
