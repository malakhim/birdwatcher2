<div id="container_{$container.container_id}" class="container container_{$container.width} {if $container.default != 1 && $container.position != 'CENTRAL' && 	!$dynamic_object}container-lock{/if}">
	{if $container.default != 1 && $container.position == 'TOP' &&	!$dynamic_object}<p>{$lang.top_container_not_used}</p>{/if}
    {if $container.default != 1 && $container.position == 'BOTTOM' &&  !$dynamic_object}<p>{$lang.bottom_container_not_used}</p>{/if}

    {if $container.default == 1 || $container.position == 'CENTRAL' || $dynamic_object}
        {$content|htmlspecialchars_decode|unescape}
    {/if}
    
    <div class="clear"></div>
    <div class="grid-control-menu bm-control-menu">
        {if $container.default == 1 || $container.position == 'CENTRAL' && !$dynamic_object}
            <div class="cm-tooltip cm-action action-control-menu  bm-action-control-menu" title="{$lang.insert_grid}"></div>
            <div class="bm-drop-menu cm-popup-box">
                <div class="bm-drop-menu-hint"></div>
                <a href="#" class="cm-action bm-action-add-grid">{$lang.insert_grid}</a>
            </div>
        
            <div class="cm-tooltip cm-action action-properties bm-action-properties" title="{$lang.container_options}"></div>
        {/if}

        <h4 class="grid-control-title">{$lang[$container.position]}</h4>
    </div>
<!--container_{$container.container_id}--></div>

<hr />