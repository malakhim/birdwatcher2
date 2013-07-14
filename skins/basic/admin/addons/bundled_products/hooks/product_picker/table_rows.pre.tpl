{if $controller == "bundled_products" || $extra_mode == "bundled_products"}

{if $product_data.min_qty == 0 || $item.min_qty == 0}
	{assign var="min_qty" value="1"}
{else}
	{assign var="min_qty" value=$product_data.min_qty|default:$item.min_qty}
{/if}

<tr>
	<td>{$item.product_name|default:$product_data.product}</td>
	<td>{$min_qty}</td>
	<td>
		<input type="hidden" id="item_price_bp_{$item.chain_id}_{$item.chain_id}" value="{$item.price|default:$product_data.price|default:"0"}" />
		<input type="hidden" name="item_data_bp_[amount]" id="item_amount_bp_{$item.chain_id}" value="{$min_qty}" />
	</td>
	<td>
		<select id="item_modifier_type_bp_{$item.chain_id}_{$item.chain_id}" name="item_data[modifier_type]" class="hidden">
			<option value="to_fixed" {if $item.modifier_type == "to_fixed"}selected="selected"{/if}>{$lang.to_fixed}</option>
		</select>
	</td>
	<td>
		<input type="hidden" class="cm-chain-{$item.chain_id}" value="{$item.chain_id}" />
		<input type="hidden" name="item_data[modifier]" id="item_modifier_bp_{$item.chain_id}_{$item.chain_id}" size="4" value="0" class="input-text" />
	</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
{/if}