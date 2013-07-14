{include file="letter_header.tpl"}

{$lang.hello},<br /><br />

{$lang.text_company_status_active_to_pending|replace:"[company]":$company_data.company}

<br /><br />

{if $reason}
{$lang.reason}: {$reason}
<br /><br />
{/if}

{include file="letter_footer.tpl"}