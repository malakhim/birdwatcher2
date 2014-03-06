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
{elseif $user_data.firstname || $user_data.lastname}
	<li class="user-name">{$user_data.firstname} {$user_data.lastname}</li>
{elseif $settings.General.use_email_as_login == 'Y' && $user_data.email}
	<li class="user-name">{$user_data.email}</li>
{elseif $settings.General.use_email_as_login != 'Y' && $user_data.user_login}
	<li class="user-name">{$user_data.user_login}</li>
{/if}