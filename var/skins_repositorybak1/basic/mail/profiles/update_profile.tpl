{include file="letter_header.tpl"}

{$lang.dear} {if $user_data.firstname}{$user_data.firstname}{else}{$user_data.user_type|fn_get_user_type_description|lower|escape}{/if},<br><br>

{$lang.update_profile_notification_header}<br><br>

{hook name="profiles:update_profile"}
{/hook}

{include file="profiles/profiles_info.tpl"}

{include file="letter_footer.tpl"}