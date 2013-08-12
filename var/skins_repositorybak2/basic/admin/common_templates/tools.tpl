{if $skip_check_permissions || $tools_list|fn_check_view_permissions}

{if $tools_list && $prefix == "main" && !$only_popup} {$lang.or} {/if}

{if $tools_list|substr_count:"<li" == 1}
	{$tools_list|replace:"<ul>":"<ul class=\"cm-tools-list tools-list\">"}
{else}
	<div class="tools-container{if $display} {$display}{/if}">
		{if !$hide_tools && $tools_list}
		<div class="tools-content{if $display} {$display}{/if}">
			<a class="cm-combo-on cm-combination {if $override_meta}{$override_meta}{else}select-button{/if}{if $link_meta} {$link_meta}{/if}" id="sw_tools_list_{$prefix}">{$link_text|default:$lang.tools}</a>
			<div id="tools_list_{$prefix}" class="cm-tools-list popup-tools hidden cm-popup-box cm-smart-position">
					{$tools_list}
			</div>
		</div>
		{/if}
		{if !$hide_actions}
			{if !("COMPANY_ID"|defined && !$tool_href|fn_check_view_permissions)}
				<span class="action-add">
					<a{if $tool_id} id="{$tool_id}"{/if}{if $tool_href} href="{$tool_href|fn_url}"{/if}{if $tool_onclick} onclick="{$tool_onclick}; return false;"{/if}>{$link_text|default:$lang.add}</a>
				</span>
			{/if}
		{/if}
	</div>
{/if}

{/if}