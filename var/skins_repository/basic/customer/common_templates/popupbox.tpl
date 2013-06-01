{if $capture_link}
	{capture name="link"}
{/if}

{if $show_brackets}({/if}<a id="opener_{$id}" class="cm-dialog-opener {$link_meta}" {if $href}href="{$href|fn_url}"{/if} rev="content_{$id}" {if $edit_onclick}onclick="{$edit_onclick}"{/if}>{$link_text}</a>{if $show_brackets}){/if}

{if $capture_link}
	{/capture}
{/if}

{if $content || $href || $edit_picker}
<div class="hidden{if $wysiwyg} wysiwyg-content{/if}" id="content_{$id}" title="{$text|escape}">
	{$content}
</div>
{/if}