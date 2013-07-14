{include file="letter_header.tpl"}

{$lang.dear} {$user_data.firstname},<br /><br />

{$lang.email_declined_notification_header}<br /><br />

{if $reason_declined}
<b>{$lang.reason}:</b><br />
{$reason_declined|nl2br}<br /><br />
{/if}

{include file="letter_footer.tpl"}