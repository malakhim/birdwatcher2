<table cellpadding="0" cellspacing="0" border="0">
<tr>
	<td valign="top">
		<table cellpadding="1" cellspacing="1" border="0" width="100%">
		<tr>
			<td colspan="2" class="form-title">{$lang.user_account_info}<hr size="1" noshade></td>
		</tr>
		{if $settings.General.use_email_as_login != 'Y' && $user_data.user_type != 'S'}
		<tr>
			<td class="form-field-caption" nowrap>{$lang.username}:&nbsp;</td>
			<td >{$user_data.user_login}</td>
		</tr>
		{else}
		<tr>
			<td class="form-field-caption" nowrap>{$lang.email}:&nbsp;</td>
			<td>{$user_data.email}</td>
		</tr>
		{/if}
		{if $send_password || $settings.General.quick_registration == "Y"}
			{if $password}
			<tr>
				<td class="form-field-caption" nowrap>{$lang.password}:&nbsp;</td>
				<td>{$password}</td>
			</tr>
			{/if}
			<tr>
				<td class="form-field-caption" nowrap>{$lang.login} {$lang.url}:&nbsp;</td>
				<td>{$login_url}</td>
			</tr>
		{/if}
		
		{if $user_data.usergroups}
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2" class="form-title">{$lang.usergroups}<hr size="1" noshade></td>
		</tr>
		{foreach from=$user_data.usergroups item="user_usergroup"}
		<tr>
			<td class="form-field-caption" nowrap>{$user_usergroup.usergroup}:&nbsp;</td>
			<td>{if $user_usergroup.status == 'P'}{$lang.pending}{else}{$lang.active}{/if}</td>
		</tr>
		{/foreach}
		{/if}
		
		{if $settings.General.user_multiple_profiles == 'Y'}
		<tr>
			<td class="form-title">{$lang.profile_name}:&nbsp;</td>
			<td>{$user_data.profile_name}</td>
		</tr>
		{/if}
		{if $user_data.tax_exempt == 'Y'}
		<tr>
			<td class="form-title">{$lang.tax_exempt}:&nbsp;</td>
			<td>{$lang.yes}</td>
		</tr>
		{/if}
		</table>
	</td>	
	<td colspan="2">&nbsp;</td>
</tr>
<tr>
	<td colspan="3">&nbsp;</td>
</tr>
</table>

{if !$send_password}
	{assign var="profile_fields" value=$user_data.user_type|fn_get_profile_fields}
	{split data=$profile_fields.C size=2 assign="contact_fields" simple=true}
	<table cellpadding="4" cellspacing="0" border="0" width="100%">
	{if $profile_fields.C}
		<tr>
			<td valign="top" width="50%">
				<table>
					{include file="profiles/profile_fields_info.tpl" fields=$contact_fields.0 title=$lang.contact_information}
				</table>
			</td>
			<td width="1%">&nbsp;</td>
			<td valign="top" width="49%">
				{if $contact_fields.1}
				<table>
					{include file="profiles/profile_fields_info.tpl" fields=$contact_fields.1}
				</table>
				{/if}
			</td>
		</tr>
	{/if}
	{if ($profile_fields.B || $profile_fields.S) && $user_data.register_at_checkout != "Y" && !($created && $settings.General.quick_registration == "Y")}
	<tr>
		<td valign="top">
		{if $profile_fields.B}
			<p></p>
			<table>
				{include file="profiles/profile_fields_info.tpl" fields=$profile_fields.B title=$lang.billing_address}
			</table>
		{else}
			&nbsp;
		{/if}
		</td>
		<td>&nbsp;</td>
		<td valign="top">
		{if $profile_fields.S}
			<p></p>
			<table>
				{include file="profiles/profile_fields_info.tpl" fields=$profile_fields.S title=$lang.shipping_address}
			</table>
		{else}
			&nbsp;
		{/if}
		</td>
	</tr>
	{/if}
	</table>
{/if}