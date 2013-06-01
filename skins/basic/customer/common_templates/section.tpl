{assign var="id" value=$section_title|md5|string_format:"s_%s"}
{math equation="rand()" assign="rnd"}
{if $smarty.cookies.$id || $collapse}
	{assign var="collapse" value=true}
{else}
	{assign var="collapse" value=false}
{/if}

<div class="section-border{if $class} {$class}{/if}" id="ds_{$rnd}">
	<div  class="section-title cm-combo-{if !$collapse}off{else}on{/if} cm-combination cm-save-state cm-ss-reverse" id="sw_{$id}">
		<span>{$section_title}</span>
		<span class="section-switch section-switch-on">{$lang.open_action}</span>
		<span class="section-switch section-switch-off">{$lang.hide}</span>
	</div>
	<div id="{$id}" class="{$section_body_class|default:"section-body"} {if $collapse}hidden{/if}">{$section_content}</div>
</div>