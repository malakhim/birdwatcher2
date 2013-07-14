{include file="letter_header.tpl"}

{$lang.hello},<br /><br />

{$lang.text_company_status_changed|replace:"[company]":$company_data.company|replace:"[status]":$status}

<br /><br />

{if $reason}
{$lang.reason}: {$reason}
<br /><br />
{/if}

{include file="letter_footer.tpl"}