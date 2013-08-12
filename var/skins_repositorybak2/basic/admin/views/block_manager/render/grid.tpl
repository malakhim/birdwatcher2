<div id="grid_{$grid.grid_id}" class="{$default_class|default:"grid"} grid_{$grid.width}{if $grid.prefix} prefix_{$grid.prefix}{/if}{if $grid.suffix} suffix_{$grid.suffix}{/if}{if $grid.alpha} {$grid.alpha}{/if}{if $grid.omega} {$grid.omega}{/if} {if $grid.content_align == "RIGHT"}bm-right-align{elseif $grid.content_align == "LEFT"}bm-left-align{else}bm-full-width{/if}" >
	{$content|htmlspecialchars_decode|unescape}
		<div class="bm-full-menu grid-control-menu bm-control-menu {if $grid.width <= 2}hidden{/if}">
			{if $container.default == 1 || $container.position == 'CENTRAL' && !$dynamic_object || $show_menu}
				{* We need extra "hidden" div's for tooltips *}
				<div class="cm-tooltip cm-action action-control-menu bm-action-control-menu" title="{$lang.add_grid_block}"></div>
				<div class="hidden"></div>
				
				<div class="bm-drop-menu cm-popup-box">
					<div class="bm-drop-menu-hint"></div>
					<a class="cm-action bm-action-add-grid">{$lang.insert_grid}</a>
					<a class="cm-action bm-action-add-block">{$lang.insert_block}</a>
				</div>

				<div class="cm-tooltip cm-action action-properties bm-action-properties" title="{$lang.grid_options}"></div>
				<div class="hidden"></div>

				<div class="cm-tooltip cm-action action-delete bm-action-delete extra" title="{$lang.delete_grid}"></div>
				<div class="hidden"></div>
			{/if}
			<h4 class="grid-control-title {if $grid.width <= 2}hidden{/if}">{$lang.grid}&nbsp;{$grid.width|default:"0"}</h4>
		</div>
		{if $container.default == 1 || $container.position == 'CENTRAL' && !$dynamic_object || $show_menu}
		<div class="bm-compact-menu {if $grid.width > 2}hidden{/if} grid-control-menu bm-control-menu">
			<div class="action-showmenu cm-action action-control-menu bm-action-control-menu">
				<div class="bm-drop-menu cm-popup-box" >
					<div class="bm-drop-menu-hint"></div>
					<a class="cm-action bm-action-add-grid">{$lang.insert_grid}</a>
					<a class="cm-action bm-action-add-block">{$lang.insert_block}</a>
					<a class="cm-action bm-action-properties">{$lang.grid_options}</a>
					<a class="cm-action bm-action-delete">{$lang.delete_grid}</a>
				</div>
			</div>
		</div>
		{/if}
<!--grid_{$grid.grid_id}--></div>

{if $grid.clear}
	<div class="clear"></div>
{/if}
