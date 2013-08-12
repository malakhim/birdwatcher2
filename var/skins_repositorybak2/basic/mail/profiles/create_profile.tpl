{include file="letter_header.tpl"}

{$lang.dear} {if $user_data.firstname}{$user_data.firstname}{else}{$user_data.user_type|fn_get_user_type_description|lower|escape}{/if},<br><br>

{$lang.create_profile_notification_header} {if $user_data.company_name}{$user_data.company_name|unescape}{else}{$settings.Company.company_name|unescape}{/if}.<br><br>

{hook name="profiles:create_profile"}
{/hook}

{include file="profiles/profiles_info.tpl" created=true}

{include file="letter_footer.tpl"}