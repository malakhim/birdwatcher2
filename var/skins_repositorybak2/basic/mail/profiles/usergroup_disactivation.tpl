{include file="letter_header.tpl"}

{$lang.text_usergroup_disactivated}<br>
<p>
<table>
<tr>
	<td>{if $usergroup_ids|sizeof > 1}{$lang.usergroups}{else}{$lang.usergroup}{/if}:</td>
	<td>
		{foreach from=$usergroup_ids item=u_id name=ugroups}
			<b>{$usergroups.$u_id.usergroup}</b>{if !$smarty.foreach.ugroups.last}, {/if}
		{/foreach}
	</td>
</tr>
<tr>
	<td>{$lang.username}:</td>
	<td>{if $settings.General.use_email_as_login == 'Y'}{$user_data.email}{else}{$user_data.user_login}{/if}</td>
</tr>
<tr>
	<td>{$lang.name}:</td>
	<td>{$user_data.firstname}&nbsp;{$user_data.lastname}</td>
</tr>
</table>
</p>
{include file="letter_footer.tpl"}