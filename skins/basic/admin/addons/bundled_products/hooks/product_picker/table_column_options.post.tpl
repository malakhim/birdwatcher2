{if ($controller == "bundled_products" || $extra_mode == "bundled_products") && $product_info}
	<td>
		<input type="hidden" id="item_price_bp_{$item.chain_id}_{$delete_id}" value="{$product_info.price|default:0}" />
		{include file="common_templates/price.tpl" value=$product_info.price}
	</td>
	<td>
		<select name="{$input_name}[modifier_type]" id="item_modifier_type_bp_{$item.chain_id}_{$delete_id}">
			<option value="by_fixed" {if $product_info.modifier_type == "by_fixed"}selected="selected"{/if}>{$lang.by_fixed}</option>
			<option value="to_fixed" {if $product_info.modifier_type == "to_fixed"}selected="selected"{/if}>{$lang.to_fixed}</option>
			<option value="by_percentage" {if $product_info.modifier_type == "by_percentage"}selected="selected"{/if}>{$lang.by_percentage}</option>
			<option value="to_percentage" {if $product_info.modifier_type == "to_percentage"}selected="selected"{/if}>{$lang.to_percentage}</option>
		</select>
	</td>
	<td>
		<input type="hidden" class="cm-chain-{$item.chain_id}" value="{$delete_id}" />
		<input type="text" name="{$input_name}[modifier]" id="item_modifier_bp_{$item.chain_id}_{$delete_id}" size="4" value="{$product_info.modifier|default:0}" class="input-text" />
	</td>
	<td>
		{include file="common_templates/price.tpl" value=$product_info.discounted_price span_id="item_discounted_price_bp_`$item.chain_id`_`$delete_id`_"}
	</td>
	
{elseif ($controller == "bundled_products" || $extra_mode == "bundled_products") && $clone}
	<td>
		<input type="text" class="hidden" id="item_price_bp_{$item.chain_id}_{$ldelim}bp_id{$rdelim}" value="{$ldelim}price{$rdelim}" />
		{include file="common_templates/price.tpl" span_id="item_display_price_bp_`$item.chain_id`_`$ldelim`bp_id`$rdelim`_"}
	</td>
	<td>
		<select name="{$input_name}[modifier_type]" id="item_modifier_type_bp_{$item.chain_id}_{$ldelim}bp_id{$rdelim}">
			<option value="by_fixed">{$lang.by_fixed}</option>
			<option value="to_fixed">{$lang.to_fixed}</option>
			<option value="by_percentage">{$lang.by_percentage}</option>
			<option value="to_percentage">{$lang.to_percentage}</option>
		</select>
	</td>
	<td>
		<input type="text" class="cm-chain-{$item.chain_id} hidden" value="{$ldelim}bp_id{$rdelim}" />
		<input type="text" class="hidden" id="{$ldelim}bp_id{$rdelim}" value="{$item.chain_id}" />
		<input type="text" name="{$input_name}[modifier]" id="item_modifier_bp_{$item.chain_id}_{$ldelim}bp_id{$rdelim}" size="4" value="0" class="input-text" />
	</td>
	<td>
		{include file="common_templates/price.tpl" span_id="item_discounted_price_bp_`$item.chain_id`_`$ldelim`bp_id`$rdelim`_"}
	</td>
{/if}