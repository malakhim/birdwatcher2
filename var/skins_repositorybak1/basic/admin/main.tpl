{if $auth.user_id && $view_mode != 'simple' && !"COMPANY_ID"|defined}
	{include file="common_templates/quick_menu.tpl"}
{/if}

{capture name="content"}
	{if $auth.user_id && $view_mode != 'simple'}
		{include file="common_templates/notification.tpl"}
	{/if}
	{include file=$content_tpl}
{/capture}
{notes assign="notes"}{/notes}

<table cellpadding="0" cellspacing="0" border="0" class="content-table">
<tr valign="top">
	<td width="1px" class="side-menu">
	<div id="right_column">
		{if $smarty.request.rev && $smarty.request.rev|is_array}
			{assign var="rev_id" value=$smarty.request.rev_id|reset}
			{assign var="rev" value=$smarty.request.rev|reset}
			<div class="notes">
				<h5>{$lang.note}:</h5>
				{$lang.you_are_editing_revision} <span class="strong">#{$rev}</span> {if $rev_id && $rev_id|fn_revisions_is_active:$rev}({$lang.active}) {/if}{$lang.if_press_save}
			</div>
		{/if}

		{if $navigation && $navigation.dynamic.sections}
			<div id="navigation" class="cm-j-tabs">
				<ul>
					{foreach from=$navigation.dynamic.sections item=m key="s_id" name="first_level"}
						{hook name="index:dynamic_menu_item"}
						<li class="{if $m.js == true}cm-js{/if}{if $smarty.foreach.first_level.last} cm-last-item{/if}{if $navigation.dynamic.active_section == $s_id} cm-active{/if}"><span><a href="{$m.href|fn_url}">{$m.title}</a></span></li>
						{/hook}
					{/foreach}
				</ul>
			</div>
		{/if}

		{if $notes}
			{foreach from=$notes item="note" key="title"}
			<div class="notes">
				<h5>{if $title == "_note_"}{$lang.note}{else}{$title}{/if}:</h5>
				{$note}
			</div>
			{/foreach}
		{/if}
	</div>
	</td>
	<td class="{if !$auth.user_id || $view_mode == 'simple'}login-page{else}content{/if}">
		{if $auth.user_id && $view_mode != 'simple'}
			<div class="mainbox-breadcrumbs">
				{if $breadcrumbs}
					{foreach from=$breadcrumbs item="b" name="f_b"}<a class="back-link" href="{$b.link|fn_url}">{if $smarty.foreach.f_b.first}&laquo; {$lang.back_to}:&nbsp;{/if}{$b.title|unescape|strip_tags}</a>{if !$smarty.foreach.f_b.last}&nbsp;|&nbsp;{/if}{/foreach}
				{/if}
			</div>
		{/if}
		{hook name="index:main_content"}{/hook}

		<div id="main_column{if !$auth.user_id || $view_mode == 'simple'}_login{/if}" class="clear">
			{$smarty.capture.content}
		<!--main_column{if !$auth.user_id || $view_mode == 'simple'}_login{/if}--></div>
	</td>
{if ($navigation && $navigation.dynamic.sections) || $notes}
{/if}
</tr>
</table>