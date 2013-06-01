{if $status == "Y"}
	{assign var="text_status" value=$lang.approved}
{else}
	{assign var="text_status" value=$lang.disapproved}
{/if}

{$settings.Company.company_name}: {$lang.products_approval_status_changed|replace:"[status]":$text_status}