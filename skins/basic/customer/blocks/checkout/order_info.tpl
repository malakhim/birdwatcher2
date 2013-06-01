
{if $completed_steps.step_two}
	{if $profile_fields.B}
		<h4>{$lang.billing_address}:</h4>

		{assign var="profile_fields" value="I"|fn_get_profile_fields}
		<ul class="shipping-adress clearfix">
			{foreach from=$profile_fields.B item="field"}
				{assign var="value" value=$cart.user_data|fn_get_profile_field_value:$field}
				{if $value}
					<li class="{$field.field_name|replace:"_":"-"}">{$value}</li>
				{/if}
			{/foreach}
		</ul>

		<hr />
	{/if}

	{if $profile_fields.S}
		<h4>{$lang.shipping_address}:</h4>
		<ul class="shipping-adress clearfix">
			{foreach from=$profile_fields.S item="field"}
				{assign var="value" value=$cart.user_data|fn_get_profile_field_value:$field}
				{if $value}
					<li class="{$field.field_name|replace:"_":"-"}">{$value}</li>
				{/if}
			{/foreach}
		</ul>
		<hr />
	{/if}

	{if $cart.shipping}
		<h4>{$lang.shipping_method}:</h4>
		<ul>
			{foreach from=$cart.shipping item="shipping"}
				<li>{$shipping.shipping}</li>
			{/foreach}
		</ul>
	{/if}
{/if}

{assign var="block_wrap" value="checkout_order_info_`$block.snapping_id`_wrap"}
