{if $capture}
{capture name="carrier_field"}
{/if}
<select {if $id}id="{$id}"{/if} name="{$name}">
	<option value="">--</option>
	<option value="USP" {if $carrier == "USP"}{assign var="carrier_name" value=$lang.usps}selected="selected"{/if}>{$lang.usps}</option>
	<option value="UPS" {if $carrier == "UPS"}{assign var="carrier_name" value=$lang.ups}selected="selected"{/if}>{$lang.ups}</option>
	<option value="FDX" {if $carrier == "FDX"}{assign var="carrier_name" value=$lang.fedex}selected="selected"{/if}>{$lang.fedex}</option>
	<option value="AUP" {if $carrier == "AUP"}{assign var="carrier_name" value=$lang.australia_post}selected="selected"{/if}>{$lang.australia_post}</option>
	<option value="DHL" {if $carrier == "DHL" || $user_data.carrier == "ARB"}{assign var="carrier_name" value=$lang.dhl}selected="selected"{/if}>{$lang.dhl}</option>
	<option value="CHP" {if $carrier == "CHP"}{assign var="carrier_name" value=$lang.chp}selected="selected"{/if}>{$lang.chp}</option>
</select>
{if $capture}
{/capture}

{capture name="carrier_name"}
{$carrier_name}
{/capture}
{/if}