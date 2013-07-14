<{if $no_link}span{else}a{/if} class="select-link cm-combo-on cm-combination {$class}" id="sw_select_wrap_{$suffix}">{$link_text|default:"tools"}</{if $no_link}span{else}a{/if}>

<div id="select_wrap_{$suffix}" class="select-popup cm-popup-box cm-smart-position hidden left">
	{$tools_list|replace:"<ul>":"<ul class=\"cm-select-list\">"}
</div>