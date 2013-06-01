{if $display == "select"}
<select name="{$input_name}" {if $input_id}id="{$input_id}"{/if}>
	<option value="A" {if $obj.status == "A"}selected="selected"{/if}>{$lang.active}</option>
	{if $hidden}
	<option value="H" {if $obj.status == "H"}selected="selected"{/if}>{$lang.hidden}</option>
	{/if}
	<option value="D" {if $obj.status == "D"}selected="selected"{/if}>{$lang.disabled}</option>
</select>
{elseif $display == "text"}
<div class="form-field">
	<label class="cm-required">{$lang.status}:</label>
	<span>
		{if $obj.status == "A"}
			{$lang.active}
		{elseif $obj.status == "H"}
			{$lang.hidden}
		{elseif $obj.status == "D"}
			{$lang.disabled}
		{/if}
	</span>
</div>
{else}
<div class="form-field">
	<label class="cm-required">{$lang.status}:</label>
	<div class="select-field">
		{if $items_status}
			{if !$items_status|is_array}
				{assign var="items_status" value=$items_status|fn_from_json}
			{/if}
			{foreach from=$items_status item="val" key="st" name="status_cycle"}
			<input type="radio" name="{$input_name}" id="{$id}_{$obj_id|default:0}_{$st|lower}" {if $obj.status == $st || (!$obj.status && $smarty.foreach.status_cycle.first)}checked="checked"{/if} value="{$st}" class="radio" /><label for="{$id}_{$obj_id|default:0}_{$st|lower}">{$val}</label>
			{/foreach}
		{else}
		<input type="radio" name="{$input_name}" id="{$id}_{$obj_id|default:0}_a" {if $obj.status == "A" || !$obj.status}checked="checked"{/if} value="A" class="radio" /><label for="{$id}_{$obj_id|default:0}_a">{$lang.active}</label>

		{if $hidden}
		<input type="radio" name="{$input_name}" id="{$id}_{$obj_id|default:0}_h" {if $obj.status == "H"}checked="checked"{/if} value="H" class="radio" /><label for="{$id}_{$obj_id|default:0}_h">{$lang.hidden}</label>
		{/if}

		{if $obj.status == "P"}
		<input type="radio" name="{$input_name}" id="{$id}_{$obj_id|default:0}_p" checked="checked" value="P" class="radio" /><label for="{$id}_{$obj_id|default:0}_p">{$lang.pending}</label>
		{/if}

		<input type="radio" name="{$input_name}" id="{$id}_{$obj_id|default:0}_d" {if $obj.status == "D"}checked="checked"{/if} value="D" class="radio" /><label for="{$id}_{$obj_id|default:0}_d">{$lang.disabled}</label>
		{/if}
	</div>
</div>
{/if}