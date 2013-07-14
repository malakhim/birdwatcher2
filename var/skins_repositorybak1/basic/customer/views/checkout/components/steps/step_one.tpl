<div class="step-container{if $edit}-active{/if}" id="step_one">
	{if $settings.General.checkout_style != "multi_page"}
		<h2 class="step-title{if $edit}-active{/if}{if $complete && !$edit}-complete{/if} clearfix">
			<span class="float-left">{if !$complete || $edit}1{/if}</span>

			{if $complete && !$edit}
				{hook name="checkout:edit_link"}
				<span class="float-right">
					{include file="buttons/button.tpl" but_meta="cm-ajax cm-ajax-force" but_href="checkout.checkout?edit_step=step_one&amp;from_step=$edit_step" but_rev="checkout_*" but_text=$lang.change but_role="tool"}
				</span>
				{/hook}
			{/if}

			{if ($settings.General.disable_anonymous_checkout == "Y" && !$auth.user_id) || ($settings.General.disable_anonymous_checkout != "Y" && !$auth.user_id && !$contact_info_population) || $smarty.session.failed_registration == true}
				{assign var="title" value=$lang.please_sign_in}
			{else}
				{if $auth.user_id != 0}
					{if $user_data.firstname || $user_data.lastname}
						{assign var="login_info" value="`$user_data.firstname`&nbsp;`$user_data.lastname`"}
					{else}
						{if $settings.General.use_email_as_login == "Y"}
							{assign var="login_info" value="`$user_data.email`"}
						{else}
							{assign var="login_info" value="`$user_data.user_login`"}
						{/if}
					{/if}
				{else}
					{assign var="login_info" value=$lang.guest}
				{/if}
				
				{assign var="title" value="`$lang.signed_in_as`&nbsp;`$login_info`"}
			{/if}
			
			{hook name="checkout:edit_link_title"}
			<a class="title{if $contact_info_population && !$edit} cm-ajax cm-ajax-force{/if}" {if $contact_info_population && !$edit}href="{"checkout.checkout?edit_step=step_one&amp;from_step=`$edit_step`"|fn_url}" rev="checkout_*"{/if}>{$title}</a>
			{/hook}
		</h2>
	{/if}

	{assign var="curl" value=$config.current_url|fn_query_remove:"login_type"}
	<div id="step_one_body" class="step-body{if $edit}-active{/if}{if !$edit} hidden{/if}">
		{if ($settings.General.disable_anonymous_checkout == "Y" && !$auth.user_id) || ($settings.General.disable_anonymous_checkout != "Y" && !$auth.user_id && !$contact_info_population) || $smarty.session.failed_registration == true}
			<div id="step_one_login" {if $login_type != "login"}class="hidden"{/if}>
				<div class="clearfix">
					{include file="views/checkout/components/checkout_login.tpl" checkout_type="one_page"}
				</div>
			</div>
			<div id="step_one_register" class="clearfix {if $login_type != "register"} hidden{/if}">
					<form name="step_one_register_form" class="{$ajax_form} cm-ajax-full-render" action="{""|fn_url}" method="post">
						<input type="hidden" name="result_ids" value="checkout*,account*" />
						<input type="hidden" name="return_to" value="checkout" />
						<input type="hidden" name="user_data[register_at_checkout]" value="Y" />
						<div class="checkout-inside-block">
							{include file="common_templates/subheader.tpl" title=$lang.register_new_account}
							{include file="views/profiles/components/profiles_account.tpl" nothing_extra="Y" location="checkout"}
							{include file="views/profiles/components/profile_fields.tpl" section="C" nothing_extra="Y"}
				
							{hook name="checkout:checkout_steps"}{/hook}
							
							{if $settings.Image_verification.use_for_register == "Y"}
								{include file="common_templates/image_verification.tpl" id="register"}
							{/if}
							
							<div class="clear"></div>
						</div>
						<div class="checkout-buttons clearfix">
							{include file="buttons/button.tpl" but_name="dispatch[checkout.add_profile]" but_text=$lang.register}
							{include file="buttons/button.tpl" but_href=$curl but_onclick="$('#step_one_register').hide(); $('#step_one_login').show();" but_text=$lang.cancel but_role="text"} 
						</div>
					</form>
			</div>
		{else}
			<form name="step_one_contact_information_form" class="{$ajax_form} {$ajax_form_force}" action="{""|fn_url}" method="{if !$edit}get{else}post{/if}">
			<input type="hidden" name="update_step" value="step_one" />
			<input type="hidden" name="next_step" value="{if $smarty.request.from_step && $smarty.request.from_step != "step_one"}{$smarty.request.from_step}{else}step_two{/if}" />
			<input type="hidden" name="result_ids" value="checkout*" />
				{if $edit}
				<div class="clearfix">
					<div>
						{include file="views/profiles/components/profile_fields.tpl" section="C" nothing_extra="Y" email_extra=$smarty.capture.email_extra}
						<a href="{"auth.change_login"|fn_url}" class="relogin">{$lang.sign_in_as_different}</a>
					</div>
				</div>
					{hook name="checkout:checkout_steps"}
						<div class="checkout-buttons">
							{include file="buttons/button.tpl" but_name="dispatch[checkout.update_steps]" but_text=$but_text}
						</div>
					{/hook}
				{/if}
			</form>
		{/if}
		
		{*if !$edit}
			{hook name="checkout:edit_link"}
			<div class="right">
				{include file="buttons/button.tpl" but_href="checkout.checkout?edit_step=step_one&amp;from_step=`$edit_step`" but_rev="checkout_*" but_meta="cm-ajax" but_text=$lang.change but_role="tool"}
			</div>
			{/hook}
		{/if*}
	</div>
<!--step_one--></div>