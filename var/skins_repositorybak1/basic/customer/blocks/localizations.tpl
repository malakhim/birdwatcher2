<div id="localizations_{$block.block_id}">

{if $localizations && $localizations|count > 1}
	<div class="select-wrap">{include file="common_templates/select_object.tpl" style="graphic" suffix="localization" link_tpl=$config.current_url|fn_link_attach:"lc=" items=$localizations selected_id=$smarty.const.CART_LOCALIZATION display_icons=false key_name="localization" text=$lang.localization}</div>
{/if}

<!--localizations_{$block.block_id}--></div>