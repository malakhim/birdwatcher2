{if $popup}
	{if $skip_check_permissions || $href|fn_check_view_permissions}
		{include file="common_templates/popupbox.tpl" id=$id text=$text link_text=$link_text act=$act href=$href link_class=$link_class}
	{/if}
{elseif $href}
{assign var="_href" value=$href|fn_url}
{if !$_href|fn_check_view_permissions}
	{assign var="link_text" value=$lang.view}
{/if}
	<a class="tool-link {$extra_class}" href="{$_href}" {$link_extra}>{$link_text|default:$lang.edit}</a>
{/if}
{if $skip_check_permissions || $tools_list|fn_check_view_permissions}
	{if $tools_list|strpos:"<li"}{if $href}&nbsp;&nbsp;|{elseif $separate}|{/if}
		{include file="common_templates/tools.tpl" prefix=$prefix hide_actions=true tools_list="<ul>`$tools_list`</ul>" display="inline" link_text=$lang.more link_meta="lowercase" skip_check_permissions=$skip_check_permissions}
	{/if}
{/if}