{include file="letter_header.tpl"}

{$lang.dear} {$order_info.firstname},<br /><br />

{$return_status.email_header|unescape}<br /><br />

<b>{$lang.packing_slip}:</b><br />

{include file="addons/rma/slip.tpl"}

{include file="letter_footer.tpl"}