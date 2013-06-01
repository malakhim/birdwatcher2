{if $cart.points_info.reward}
	<span class="">{$lang.points}</span>
	<span class="float-right">{$cart.points_info.reward}</span>
{/if}

{if $mode == "checkout" && $cart_products && $cart.points_info.total_price && $user_info.points > 0}
	<form class="cm-ajax cm-ajax-full-render" name="point_payment_form" action="{""|fn_url}" method="post">
		<input type="hidden" name="redirect_mode" value="{$location}" />
		<input type="hidden" name="result_ids" value="checkout*,cart_status*" />

		<div class="form-field input-append reward-points">
			<input type="text" class="input-text valign cm-hint" name="points_to_use" size="40" value="{$lang.points_to_use}" />
			{include file="buttons/go.tpl" but_name="checkout.point_payment" alt=$lang.apply}
			<input type="submit" class="hidden" name="dispatch[checkout.point_payment]" value="" />
		</div>
	</form>

	{if $user_info.points}
		<div class="discount-info">
			<span class="light-block-arrow-alt"></span>
			<span class="block">{$lang.text_point_in_account}&nbsp;{$user_info.points}&nbsp;{$lang.points_lower}.</span>
			
			{if $cart.points_info.in_use.points}
				{assign var="_redirect_url" value=$config.current_url|escape:url}
				{if $use_ajax}{assign var="_class" value="cm-ajax"}{/if}
				<span class="points-in-use">
					<span class="points-in-use-delete-button">
						{include file="buttons/button.tpl" but_href="checkout.delete_points_in_use?redirect_url=`$_redirect_url`" but_meta="delete-
						icon" but_role="delete" but_rev="checkout*,cart_status*,subtotal_price_in_points"}
					</span>
					<span class="points-in-use-summary">
						{$cart.points_info.in_use.points}
						{$lang.points_in_use_lower}.
						({include file="common_templates/price.tpl" value=$cart.points_info.in_use.cost})
					</span>
				</span>
			{/if}
		</div>
	{/if}
{/if}