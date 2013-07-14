{include file="letter_header.tpl"}

{$lang.hello},<br /><br />

<strong>{$lang.payment_details}</strong>:<br />
{$lang.sales_period}: {$payment.start_date} - {$payment.end_date}<br />
{$lang.amount}: {include file="common_templates/price.tpl" value=$payment.amount}<br />
{$lang.payment_method}: {$payment.payment_method}<br />
{$lang.comments}: {$payment.comments}<br />

{include file="letter_footer.tpl"}