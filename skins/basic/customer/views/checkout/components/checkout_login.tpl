<script type="text/javascript">
//<![CDATA[

function fn_switch_checkout_type(status)
{$ldelim}
	{if $checkout_type == 'classic'}
		{literal}
		$('#profiles_auth').switchAvailability(true);
		$('#profiles_box').switchAvailability(false);
		$('#account_box').switchAvailability(!status);
		$('#sa').switchAvailability(!$('elm_ship_to_another').attr('checked'));
		{/literal}
	{else}
		{literal}
		if (status == true) {
			$('#step_one_register').show();
		} else {
			$('#step_one_anonymous_checkout').show();
		}
		$('#step_one_login').hide();
		{/literal}
	{/if}
{$rdelim}

{literal}
function fn_show_checkout_buttons(type)
{
	if (type == 'register') {
		$('#register_checkout').show();
		$('#anonymous_checkout').hide();
	} else {
		$('#register_checkout').hide();
		$('#anonymous_checkout').show();
	}
}
{/literal}
//]]>
</script>
	{hook name="checkout:login_form"}
	<div class="login-form">
		{include file="views/auth/login_form.tpl" form_name="step_one_login_form" result_ids="checkout*,account*" id="checkout"}		
	</div>
	{/hook}
	
	{hook name="checkout:register_customer"}
	<div class="checkout-register">
		{capture name="register"}
			{if $settings.General.approve_user_profiles != "Y"}
				<div id="register_checkout" class="checkout-buttons">{include file="buttons/button.tpl" but_href="$curl&amp;login_type=register" but_onclick="$.processNotifications(); fn_switch_checkout_type(true);" but_text=$lang.register}</div>
			{/if}
		{/capture}
		
		{capture name="anonymous"}
			{if $settings.General.disable_anonymous_checkout != "Y"}
				<div id="anonymous_checkout" class="cm-noscript">
					<form name="step_one_anonymous_checkout_form" class="{$ajax_form}" action="{""|fn_url}" method="post">
						<input type="hidden" name="result_ids" value="checkout*,account*" />

						{if !$contact_fields_filled}
							<div class="form-field">
								<label for="guest_email" class="cm-required">{$lang.email}</label>
								<input type="text" id="guest_email" name="user_data[email]" size="32" value="" class="input-text " />
							</div>
						{/if}

						<div class="checkout-buttons">
							{include file="buttons/button.tpl" but_name="dispatch[checkout.customer_info.guest_checkout]" but_text=$lang.checkout_as_guest}
						</div>
					</form>
				</div>
			{/if}
		{/capture}

		<div class="register-content">
			{if $settings.General.approve_user_profiles != "Y" || $settings.General.disable_anonymous_checkout != "Y"}
				{include file="common_templates/subheader.tpl" title=$lang.new_customer}
				{assign var="curl" value=$config.current_url|fn_query_remove:"login_type"}
			{/if}

			<ul class="register-methods">
				<li class="one"><input class="radio valign" type="radio" id="checkout_type_register" name="checkout_type" value="" checked="checked" onclick="fn_show_checkout_buttons('register')" /><div class="radio1"><label for="checkout_type_register"><span class="method-title">{$lang.register}</span><span class="method-hint">{$lang.create_new_account}</span></label></div></li>

				{if $settings.General.disable_anonymous_checkout != "Y"}
					<li><input class="radio valign" type="radio" id="checkout_type_guest" name="checkout_type" value="" onclick="fn_show_checkout_buttons('guest')" /><div class="radio1"><label for="checkout_type_guest"><span class="method-title">{$lang.checkout_as_guest}</span><span class="method-hint">{$lang.create_guest_account}</span></label></div></li>
				{/if}
			</ul>
		</div>

		{$smarty.capture.register}
		{$smarty.capture.anonymous}
	</div>
	{/hook}