{if $create || $mode == "add"}
	{assign var="but_label" value=$lang.create}
	{assign var="but_label2" value=$lang.create_and_close}
{else}
	{assign var="but_label" value=$lang.save}
	{assign var="but_label2" value=$lang.save_and_close}
{/if}

{if $but_name}{assign var="r" value=$but_name}{else}{assign var="r" value=$but_href}{/if}
{if $r|fn_check_view_permissions}
{if !$hide_first_button}
	{include file="buttons/button.tpl" but_text=$but_text|default:$but_label but_onclick=$but_onclick but_role="button_main" but_name=$but_name but_meta=$but_meta}
{else}
	{assign var="skip_or" value=true}
{/if}
	{if !$hide_second_button && $cancel_action != "close"}
	&nbsp;{include file="buttons/button.tpl" but_text=$but_label2 but_role="button_main" but_name=$but_name but_meta="cm-save-and-close `$but_meta`" but_onclick=$but_onclick allow_href=true}
	{/if}
{else}
	{assign var="skip_or" value=true}
{/if}

{if $extra}
	{$extra}
{/if}

{if ($cancel_action || $breadcrumbs) && !$skip_or}&nbsp;{$lang.or}&nbsp;&nbsp;{/if}

{if $cancel_action == "close"}
	<a class="cm-dialog-closer cm-cancel tool-link">{$lang.cancel}</a>
{elseif $breadcrumbs}
	{foreach from=$breadcrumbs item="b" name="fe_b"}
	{if ($b.link|strpos:'last_view' || $smarty.foreach.fe_b.last) && !$c_link_is_showed}
	{assign var="c_link_is_showed" value=true}
	<a href="{$b.link|fn_url}" class="underlined tool-link">{$lang.cancel}</a>
	{/if}
	{/foreach}
{/if}