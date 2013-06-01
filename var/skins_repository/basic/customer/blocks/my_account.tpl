{** block-description:my_account **}

{capture name="title"}
	<a href="{"profiles.update"|fn_url}">{$title}</a>
{/capture}

<div id="account_info_{$block.snapping_id}">
	{assign var="return_current_url" value=$config.current_url|escape:url}
	<ul class="account-info">
	{hook name="profiles:my_account_menu"}
		{if $auth.user_id}
			{if $user_info.firstname || $user_info.lastname}
				<li class="user-name">{$user_info.firstname} {$user_info.lastname}</li>
			{else}
				{if $settings.General.use_email_as_login == 'Y'}
					<li class="user-name">{$user_info.email}</li>
				{else}
					<li class="user-name">{$user_info.user_login}</li>
				{/if}
			{/if}
			<li><a href="{"profiles.update"|fn_url}" rel="nofollow" class="underlined">{$lang.profile_details}</a></li>
			<li><a href="{"orders.downloads"|fn_url}" rel="nofollow" class="underlined">{$lang.downloads}</a></li>
		{elseif $user_data.firstname || $user_data.lastname}
			<li class="user-name">{$user_data.firstname} {$user_data.lastname}</li>
		{elseif $settings.General.use_email_as_login == 'Y' && $user_data.email}
			<li class="user-name">{$user_data.email}</li>
		{elseif $settings.General.use_email_as_login != 'Y' && $user_data.user_login}
			<li class="user-name">{$user_data.user_login}</li>
		{/if}
		<li><a href="{"orders.search"|fn_url}" rel="nofollow" class="underlined">{$lang.orders}</a></li>
		{assign var="compared_products" value=""|fn_get_comparison_products}
		<li><a href="{"product_features.compare"|fn_url}" rel="nofollow" class="underlined">{$lang.view_compare_list}{if $compared_products} ({$compared_products|count}){/if}</a></li>
	{/hook}

	
	{if $settings.Suppliers.apply_for_vendor == "Y" && !($controller == 'companies' && $mode == 'apply_for_vendor' || $user_info.company_id)}
		<li><a href="{"companies.apply_for_vendor?return_previous_url=`$return_current_url`"|fn_url}" rel="nofollow" class="underlined">{$lang.apply_for_vendor_account}</a></li>{/if}
	
	</ul>

	{if $settings.Appearance.display_track_orders == 'Y'}
	<div class="updates-wrapper track-orders" id="track_orders_block_{$block.snapping_id}">

	<form action="{""|fn_url}" method="get" class="cm-ajax" name="track_order_quick">
	<input type="hidden" name="full_render" value="Y" />
	<input type="hidden" name="result_ids" value="track_orders_block_*" />
	<input type="hidden" name="return_url" value="{$smarty.request.return_url|default:$config.current_url}" />

	<p class="text-track">{$lang.track_my_order}</p>

	<div class="form-field input-append">
	<label for="track_order_item{$block.snapping_id}" class="cm-required hidden">{$lang.track_my_order}</label>
			<input type="text" size="20" class="input-text cm-hint" id="track_order_item{$block.snapping_id}" name="track_data" value="{$lang.order_id|escape:html}{if !$auth.user_id}/{$lang.email|escape:html}{/if}" />{include file="buttons/go.tpl" but_name="orders.track_request" alt=$lang.go}
		{if $settings.Image_verification.use_for_track_orders == "Y"}
			<input type="hidden" name="field_id" value="{$block.snapping_id}" />
			{include file="common_templates/image_verification.tpl" id="track_orders_`$block.snapping_id`" align="left" sidebox=true}
		{/if}
	</div>

	</form>

	<!--track_orders_block_{$block.snapping_id}--></div>
	{/if}

	<div class="buttons-container">
		{if $auth.user_id}
			<a href="{"auth.logout?redirect_url=`$return_current_url`"|fn_url}" rel="nofollow" class="account">{$lang.sign_out}</a>
		{else}
			<a href="{if $controller == "auth" && $mode == "login_form"}{$config.current_url|fn_url}{else}{"auth.login_form?return_url=`$return_current_url`"|fn_url}{/if}" {if $settings.General.secure_auth != "Y"} rev="login_block{$block.snapping_id}" class="cm-dialog-opener cm-dialog-auto-size account"{else}rel="nofollow" class="account"{/if}>{$lang.sign_in}</a> | <a href="{"profiles.add"|fn_url}" rel="nofollow" class="account">{$lang.register}</a>
			{if $settings.General.secure_auth != "Y"}
				<div  id="login_block{$block.snapping_id}" class="hidden" title="{$lang.sign_in}">
					<div class="login-popup">
						{include file="views/auth/login_form.tpl" style="popup" form_name="login_popup_form`$block.snapping_id`" id="popup`$block.snapping_id`"}
					</div>
				</div>
			{/if}
		{/if}
	</div>
<!--account_info_{$block.snapping_id}--></div>