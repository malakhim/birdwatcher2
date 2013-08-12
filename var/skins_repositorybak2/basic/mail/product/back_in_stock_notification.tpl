{include file="letter_header.tpl"}

{$lang.dear} {$lang.customer},<br /><br />

{$lang.back_in_stock_notification_header|unescape}<br /><br />
{assign var="suffix" value=""}


<b><a href="{"products.view?product_id=`$product_id``$suffix`"|fn_url:'C':'http':'&amp;'}">{$product.name|unescape}</a></b><br /><br />

{$lang.back_in_stock_notification_footer|unescape}<br />

{include file="letter_footer.tpl"}