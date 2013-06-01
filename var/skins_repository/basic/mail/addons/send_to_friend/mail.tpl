{include file="letter_header.tpl"}

{$lang.hello} {$send_data.to_name},<br /><br />

{$lang.text_recommendation_notes}<br />
<a href="{$link|fn_url:'C'}">{$link|fn_url:'C'}</a><br /><br />
<b>{$lang.notes}:</b><br />
{$send_data.notes|replace:"\n":"<br />"}

{include file="letter_footer.tpl"}