{capture name="mainbox"}

<pre class="diff-container">{$diff|unescape}</pre>

{/capture}
{include file="common_templates/mainbox.tpl" title="`$lang.diff`: `$smarty.request.file`" content=$smarty.capture.mainbox}