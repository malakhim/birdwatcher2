{if $anchor}
<a name="{$anchor}"></a>
{/if}
<div>

{if $title_extra || $tools || ($navigation.dynamic && $navigation.dynamic.actions) || $select_languages || $extra_tools}
	<div class="clear mainbox-title-container">
{/if}

	{if $notes}
		{include file="common_templates/help.tpl" content=$notes id=$notes_id}
	{/if}

	{if $tools}{$tools}{/if}

	<h1 class="mainbox-title{if $title_extra} float-left{/if}">
		{$title|default:"&nbsp;"}
	</h1>

	{if $title_extra}<div class="title">-&nbsp;</div>
		{$title_extra}
	{/if}
{if $title_extra || $tools || $navigation.dynamic.actions || $select_languages || $extra_tools}
	</div>
{/if}

{if $navigation.dynamic.actions || $select_languages || $extra_tools}<div class="extra-tools">{/if}

{if $select_languages && $languages|sizeof > 1}
<div class="select-lang">

	{include file="common_templates/select_object.tpl" style="graphic" link_tpl=$config.current_url|fn_link_attach:"descr_sl=" items=$languages selected_id=$smarty.const.DESCR_SL key_name="name" suffix="content" display_icons=true}

</div>{if $navigation.dynamic.actions || $extra_tools}&nbsp;&nbsp;{/if}
{/if}

{if $extra_tools|trim}
	{$extra_tools}{if $navigation.dynamic.actions}{/if}
{/if}

{if $navigation.dynamic.actions}
	{foreach from=$navigation.dynamic.actions key=title item=m name="actions"}
		{include file="buttons/button.tpl" but_href=$m.href but_text=$lang.$title but_role="tool" but_target=$m.target but_meta=$m.meta method="GET"}
	{/foreach}
{/if}

{if $smarty.capture.preview|trim}
	<div class="float-right preview-link">
		{$smarty.capture.preview}
	</div>
{/if}

{if $navigation.dynamic.actions || $select_languages || $extra_tools}</div>{/if}

	<div class="mainbox-body" {if $box_id}id="{$box_id}"{/if}>
		{$content|default:"&nbsp;"}
	{if $box_id}<!--{$box_id}-->{/if}</div>
</div>