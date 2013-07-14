{include file="letter_header.tpl"}

{$lang.hello},<br /><br />

{$lang.text_company_status_new_to_pending|replace:"[company]":$company_data.company}

<br /><br />

{if $reason}
{$lang.reason}: {$reason}
<br /><br />
{/if}

{assign var="vendor_area" value=""|fn_url:"V":"http"}
{if $account == 'updated'}
{$lang.text_company_status_new_to_active_administrator_updated|replace:"[link]":$vendor_area|replace:"[login]":$username}
{elseif $account == 'new'}
{$lang.text_company_status_new_to_active_administrator_created|replace:"[link]":$vendor_area|replace:"[login]":$username|replace:"[password]":$password}
{/if}

{include file="letter_footer.tpl"}