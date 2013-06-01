<div class="tools-container">
	{if $label}<label>{$label}</label>{/if}

	<a id="sw_{$id}_wrap_" class="select-link cm-combo-on cm-combination">{$text}</a>

	<div id="{$id}_wrap_" class="popup-tools cm-popup-box cm-smart-position hidden">	
		<input type="text" value="{$lang.search}..." class="input-text cm-hint cm-ajax-content-input" rev="content_loader_{$id}" size="16" />
		<div class="ajax-popup-tools" id="scroller_{$id}">
			<ul class="cm-select-list" id="{$id}">
				<li class="hidden">&nbsp;</li><!-- hidden li element for successfully html validation -->
				{foreach from=$objects key="object_id" item="item"}
					<li><a action="{$item.value}">{$item.name}</a></li>
				{/foreach}
			<!--{$id}--></ul>
			<ul>
				<li id="content_loader_{$id}" class="cm-ajax-content-more small-description" rel="{$data_url|fn_url}" rev="{$id}" result_elm="{$result_elm}">{$lang.loading}</li>
			</ul>
		</div>
	</div>
</div>