<div class="tools-container inline ajax_select_object" {if $elements_switcher_id} id="{$elements_switcher_id}ajax_select_object"{/if}>
	{if $label}<label>{$label}:</label>{/if}

	{if $js_action}
	<script type="text/javascript">
	//<![CDATA[
		function fn_picker_js_action_{$id}(elm) {ldelim}
			{$js_action}
		{rdelim}
	//]]>
	</script>
	{/if} 

	<a id="sw_{$id}_wrap_" class="select-link {if !$elements_switcher_id} cm-combo-on cm-combination{/if}">{$text}</a>

	<div id="{$id}_wrap_" class="popup-tools cm-popup-box cm-smart-position hidden">
		<div class="select-object-search"><input type="text" value="{$lang.search}..." class="input-text cm-hint cm-ajax-content-input" rev="content_loader_{$id}" size="16" /></div>
		<div class="ajax-popup-tools" id="scroller_{$id}">
			<ul class="cm-select-list" id="{$id}">
				{foreach from=$objects key="object_id" item="item"}
					{if "TRANSLATION_MODE"|defined}
						{assign var="name" value=$item.name}
					{else}
						{assign var="name" value=$item.name|truncate:40:"...":true}
					{/if}

					<li class="{$item.extra_class}"><a action="{$item.value}" title="{$item.name}">{$name}</a></li>
				{/foreach}
			<!--{$id}--></ul>

			<ul>
				<li id="content_loader_{$id}" class="cm-ajax-content-more small-description" rel="{$data_url|fn_url}" rev="{$id}" result_elm="{$result_elm}">{$lang.loading}</li>
			</ul>
		</div>
	</div>
</div>