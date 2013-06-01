{include file="letter_header.tpl"}

{$lang.dear} {$subscription_info.firstname},<br /><br />

{$header}<br /><br />

{$lang.rb_subscription} <a href="{"subscriptions.view?subscription_id=`$subscription_info.subscription_id`"|fn_url:'C':'http':'&'}">#{$subscription_info.subscription_id}</a>

{include file="letter_footer.tpl"}