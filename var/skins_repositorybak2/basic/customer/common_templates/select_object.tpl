{assign var="language_text" value=$text|default:$lang.select_descr_lang}

{if $style == "graphic"}
	{if $text}{$text}:{/if}
	
	{if $display_icons == true}
	<i class="flag flag-{$selected_id|lower} cm-external-click" rev="sw_select_{$selected_id}_wrap_{$suffix}" ></i>
	{/if}
	
	<a class="select-link cm-combo-on cm-combination" id="sw_select_{$selected_id}_wrap_{$suffix}"><span>{$items.$selected_id.$key_name}{if $items.$selected_id.symbol} ({$items.$selected_id.symbol|unescape}){/if}</span></a>

	<div id="select_{$selected_id}_wrap_{$suffix}" class="select-popup cm-popup-box cm-smart-position hidden">
		<ul class="cm-select-list flags">
			{foreach from=$items item=item key=id}
				<li><a rel="nofollow" name="{$id}" href="{"`$link_tpl``$id`"|fn_url}" class="{if $display_icons == true}item-link{/if} {if $selected_id == $id}active{/if}">
					{if $display_icons == true}
						<i class="flag flag-{$id|lower}"></i>
					{/if}
					{$item.$key_name|unescape}{if $item.symbol} ({$item.symbol|unescape}){/if}</a></li>
			{/foreach}
		</ul>
	</div>
{else}
	{if $text}<label for="id_{$var_name}">{$text}:</label>{/if}
	<select id="id_{$var_name}" name="{$var_name}" onchange="$.redirect(this.value);" class="valign">
		{foreach from=$items item=item key=id}
			<option value="{"`$link_tpl``$id`"|fn_url}" {if $id == $selected_id}selected="selected"{/if}>{$item.$key_name|unescape}</option>
		{/foreach}
	</select>
{/if}