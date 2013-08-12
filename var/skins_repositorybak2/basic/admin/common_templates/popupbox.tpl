{assign var="method" value=$method|default:"POST"}

{if ($action && $action|fn_check_view_permissions:$method) || (!$action && $content|fn_check_view_permissions:$method)}

{if $act == "edit"}
	{assign var="_href" value=$href|fn_url}
	{assign var="default_link_text" value=$lang.edit}
	{if !$_href|fn_check_view_permissions}
		{assign var="_link_text" value=$lang.view}
		{assign var="default_link_text" value=$lang.view}
	{/if}
	<a {if $edit_onclick}onclick="{$edit_onclick}"{/if} class="cm-dialog-opener text-button-edit{if $_href} {$opener_ajax_class|default:"cm-ajax-update"}{/if}{if $link_class} {$link_class}{/if}"{if $_href} href="{$_href}"{/if} id="opener_{$id}" rev="content_{$id}">{$link_text|default:$default_link_text|unescape}</a>

{elseif $act == "create"}
	{include file="buttons/button.tpl" but_onclick=$edit_onclick but_text=$but_text but_role="add" but_rev="content_`$id`" but_meta="text-button cm-dialog-opener"}
{elseif $act == "notes"}
	<p><a id="opener_{$id}" rev="content_{$id}" class="cm-dialog-opener">{$link_text}</a></p>
{elseif $act == "general"}
	<div class="tools-container">
		<span class="{$general_class|default:"action-add"}">
			<a id="opener_{$id}" class="cm-dialog-opener {$link_class}" rev="content_{$id}" {if $edit_onclick}onclick="{$edit_onclick}"{/if} {if $href}href="{$href|fn_url}"{/if}>{$link_text|default:$lang.add}</a>
		</span>
	</div>
{elseif $act == "button"}
	{include file="buttons/button.tpl" but_text=$link_text but_href=$but_href but_role=$but_role but_id="opener_`$id`" but_onclick="$edit_onclick" but_rev="content_`$id`" but_meta="cm-dialog-opener"}
{elseif $act == "link"}
	<a id="opener_{$id}" class="cm-dialog-opener {$link_class}" rev="content_{$id}" {if $edit_onclick}onclick="{$edit_onclick}"{/if} {if $href}href="{$href|fn_url}"{/if}>{$link_text|default:$lang.add}</a>
{elseif $act == "default"}
	<a{if $onclick} onclick="{$onclick}"{/if}{if $href} href="{$href|fn_url}"{/if} class="{$link_class|default:"text-button-edit"}">{$link_text}</a>
{/if}

{if $content || $href || $edit_picker}
<div class="hidden" title="{$text|escape}" id="content_{$id}">
	{$content}
<!--content_{$id}--></div>
{/if}

{else}{*
skipped {$text}
*}{/if}