{include file="letter_header.tpl"}

{$lang.dear} {$user_data.firstname},<br /><br />

{$lang.email_approved_notification_header|replace:"[company]":$settings.Company.company_name}<br /><br />

{if $reason_approved}
<b>{$lang.reason}:</b><br />
{$reason_approved|nl2br}<br /><br />
{/if}

{include file="profiles/profiles_info.tpl"}

{include file="letter_footer.tpl"}