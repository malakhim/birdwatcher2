{* $Id: update.tpl 12544 2011-05-27 10:34:19Z bimib $ *}

{include file="views/profiles/components/profiles_scripts.tpl"}

{if $mode == "add" && $settings.General.quick_registration == "Y"}
	<div class="account form-wrap">
	<div class="form-wrap-l"></div>
	<div class="form-wrap-r"></div>
	
		<form name="profiles_register_form" action="{""|fn_url}" method="post">
			{include file="views/profiles/components/profile_fields.tpl" section="C" nothing_extra="Y"}
			{include file="views/profiles/components/profiles_account.tpl" nothing_extra="Y" location="checkout"}
		
			{hook name="checkout:checkout_steps"}{/hook}

			{if $settings.Image_verification.use_for_register == "Y"}
				<div class="form-field">
				{include file="common_templates/image_verification.tpl" id="register" align="left"}
				</div>
			{/if}

			<div class="buttons-container left">
				{include file="buttons/register_profile.tpl" but_name="dispatch[profiles.update]"}
			</div>
		</form>
	</div>
	{capture name="mainbox_title"}{$lang.register_new_account}{/capture}
{else}

	{capture name="tabsbox"}
		<div class="account form-wrap" id="content_general">
			<div class="form-wrap-l"></div>
			<div class="form-wrap-r"></div>
			<form name="profile_form" action="{""|fn_url}" method="post">
				<input id="selected_section" type="hidden" value="general" name="selected_section"/>
				<input id="default_card_id" type="hidden" value="" name="default_cc"/>
				<input type="hidden" name="profile_id" value="{$user_data.profile_id}" />
				{capture name="group"}
					{include file="views/profiles/components/profiles_account.tpl"}
					{include file="views/profiles/components/profile_fields.tpl" section="C" title=$lang.contact_information}

					{if $profile_fields.B || $profile_fields.S}
						{if $settings.General.user_multiple_profiles == "Y" && $mode == "update"}
							<p>{$lang.text_multiprofile_notice}</p>
							{include file="views/profiles/components/multiple_profiles.tpl" profile_id=$user_data.profile_id}	
						{/if}

						{if $settings.General.address_position == "billing_first"}
							{assign var="first_section" value="B"}
							{assign var="first_section_text" value=$lang.billing_address}
							{assign var="sec_section" value="S"}
							{assign var="sec_section_text" value=$lang.shipping_address}
							{assign var="body_id" value="sa"}
						{else}
							{assign var="first_section" value="S"}
							{assign var="first_section_text" value=$lang.shipping_address}
							{assign var="sec_section" value="B"}
							{assign var="sec_section_text" value=$lang.billing_address}
							{assign var="body_id" value="ba"}
						{/if}
						
						{include file="views/profiles/components/profile_fields.tpl" section=$first_section body_id="" ship_to_another="Y" title=$first_section_text}
						
						{include file="views/profiles/components/profile_fields.tpl" section=$sec_section body_id=$body_id ship_to_another="Y" title=$sec_section_text address_flag=$profile_fields|fn_compare_shipping_billing ship_to_another=$ship_to_another}
					{/if}

					{hook name="profiles:account_update"}
					{/hook}

					{if (!$user_id.user_id || $settings.Image_verification.hide_if_logged != 'Y') && $settings.Image_verification.use_for_register == "Y"}
						{include file="common_templates/image_verification.tpl" id="register" align="center"}
					{/if}

				{/capture}
				{$smarty.capture.group}

				<div class="buttons-container left">
					{if $mode == "add"}
						{include file="buttons/register_profile.tpl" but_name="dispatch[profiles.update]" but_id="save_profile_but"}
					{else}
						{include file="buttons/save.tpl" but_name="dispatch[profiles.update]" but_id="save_profile_but"}
						<input class="account-cancel" type="reset" name="reset" value="{$lang.revert}" id="reset"/>
					{/if}
				</div>
			</form>
		</div>
		
		{capture name="additional_tabs"}
			{if $mode == "update"}
				
					{if $usergroups && !$user_data|fn_check_user_type_admin_area}
					<div id="content_usergroups">
						<table border="0" cellpadding="0" cellspacing="0" width="100%" class="table">
						<tr>
							<th width="30%">{$lang.usergroup}</th>
							<th width="30%">{$lang.status}</th>
							{if $settings.General.allow_usergroup_signup == "Y"}
								<th width="40%">{$lang.action}</th>
							{/if}
						</tr>
						{foreach from=$usergroups item=usergroup}
							{if $user_data.usergroups[$usergroup.usergroup_id]}
								{assign var="ug_status" value=$user_data.usergroups[$usergroup.usergroup_id].status}
							{else}
								{assign var="ug_status" value="F"}
							{/if}
							{if $settings.General.allow_usergroup_signup == "Y" || $settings.General.allow_usergroup_signup != "Y" && $ug_status == "A"}
								<tr {cycle values=",class=\"table-row\""}>
									<td>{$usergroup.usergroup}</td>
									<td class="center">
										{if $ug_status == "A"}
											{$lang.active}
											{assign var="_link_text" value=$lang.remove}
										{elseif $ug_status == "F"}
											{$lang.available}
											{assign var="_link_text" value=$lang.join}
										{elseif $ug_status == "D"}
											{$lang.declined}
											{assign var="_link_text" value=$lang.join}
										{elseif $ug_status == "P"}
											{$lang.pending}
											{assign var="_link_text" value=$lang.cancel}
										{/if}
									</td>
									{if $settings.General.allow_usergroup_signup == "Y"}
										<td>
											<a class="cm-ajax" rev="content_usergroups" href="{"profiles.request_usergroup?usergroup_id=`$usergroup.usergroup_id`&amp;status=`$ug_status`"|fn_url}">{$_link_text}</a>
										</td>
									{/if}
								</tr>
							{/if}
						{/foreach}
						<tr class="table-footer">
							<td colspan="{if $settings.General.allow_usergroup_signup == "Y"}3{else}2{/if}">&nbsp;</td>
						</tr>
						</table>
					<!--content_usergroups--></div>
					{/if}
				

				{hook name="profiles:tabs"}
				{/hook}
			{/if}
		{/capture}

		{$smarty.capture.additional_tabs}

	{/capture}

	{if $smarty.capture.additional_tabs|trim != ""}
		{include file="common_templates/tabsbox.tpl" content=$smarty.capture.tabsbox active_tab=$smarty.request.selected_section track=true}
	{else}
		{$smarty.capture.tabsbox}
	{/if}

	{capture name="mainbox_title"}{$lang.profile_details}{/capture}
{/if}