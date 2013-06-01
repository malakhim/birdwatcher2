{include file="letter_header.tpl"}

{$lang.text_success_subscription}<br />
<br />
<br />
{$lang.text_unsubscribe_instructions}<br />
<a href="{"news.unsubscribe?key=`$unsubscribe_key`"|fn_url:'C':'http':'&'}">{"news.unsubscribe?key=`$unsubscribe_key`"|fn_url:'C':'http':'&'}</a>

{include file="letter_footer.tpl"}