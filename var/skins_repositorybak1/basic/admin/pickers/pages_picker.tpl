{assign var="data_id" value=$data_id|default:"pages_list"}
{math equation="rand()" assign="rnd"}
{assign var="data_id" value="`$data_id`_`$rnd`"}
{assign var="view_mode" value=$view_mode|default:"mixed"}
{assign var="miltiple" value=$multiple|default:true}
{assign var="start_pos" value=$start_pos|default:0}

{script src="js/picker.js"}

{if ($item_ids) && !$item_ids|is_array}
	{assign var="item_ids" value=","|explode:$item_ids}
{/if}

{if $view_mode != "button"}
	{if $multiple}
		<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
		<tr>
			{if $positions}<th>{$lang.position_short}</th>{/if}
			<th width="100%">{$lang.name}</th>
			<th>&nbsp;</th>
		</tr>
		<tbody id="{$data_id}"{if !$item_ids} class="hidden"{/if}>
	{else}
		<div id="{$data_id}" class="{if $multiple && !$item_ids}hidden{elseif !$multiple}cm-display-radio float-left{/if}">
	{/if}

	{if $multiple}
		<tr class="hidden">
			<td colspan="{if $positions}3{else}2{/if}">
	{/if}
	<input id="a{$data_id}_ids" type="hidden" class="cm-picker-value" name="{$input_name}" value="{if $item_ids}{","|implode:$item_ids}{/if}" />
	{if $multiple}
			</td>
		</tr>
	{/if}

	{if $item_ids}
	{foreach name="items" from=$item_ids item="p_id"}
		{include file="pickers/js_page.tpl" page_id=$p_id holder=$data_id input_name=$input_name hide_link=$hide_link hide_delete_button=$hide_delete_button hide_input=true first_item=$smarty.foreach.items.first position_field=$positions position=$smarty.foreach.items.iteration+$start_pos}
	{/foreach}
	{elseif !$multiple}
		{include file="pickers/js_page.tpl" page_id="" holder=$data_id input_name=$input_name hide_link=$hide_link hide_delete_button=$hide_delete_button}
	{/if}

	{if $multiple}
		{include file="pickers/js_page.tpl" page_id="`$ldelim`page_id`$rdelim`" holder=$data_id input_name=$input_name clone=true hide_link=$hide_link hide_delete_button=$hide_delete_button hide_input=true position_field=$positions position="0"}
	{/if}

	{if $multiple}
	</tbody>
	<tbody id="{$data_id}_no_item"{if $item_ids} class="hidden"{/if}>
	<tr class="no-items">
		<td colspan="{if $positions}3{else}2{/if}"><p>{$no_item_text|default:$lang.no_items}</p></td>
	</tr>
	</tbody>
	</table>
	{else}
	</div>
	{/if}
{/if}

{if $view_mode != "list"}

	
	{if $multiple == true}
		{assign var="display" value="checkbox"}
	{else}
		{assign var="display" value="radio"}
	{/if}

	{if !$extra_url}
		{assign var="extra_url" value="&amp;get_tree=multi_level"}
	{/if}

	{if $extra_var}
		{assign var="extra_var" value=$extra_var|escape:url}
	{/if}

	{if !$no_container}<div class="{if !$multiple}choose-icon{else}buttons-container{/if}">{/if}
		{if $multiple}
			{assign var="_but_text" value=$but_text|default:$lang.add_pages}
			{assign var="_but_role" value="add"}
		{else}
			{assign var="_but_text" value="<img src=\"`$images_dir`/icons/icon_choose_object.png\" width=\"16\" height=\"16\" border=\"0\" class=\"hand icon-choose\" alt=\"`$lang.choose`\" title=\"`$lang.choose`\" />"}
			{assign var="_but_role" value="icon"}
		{/if}

		{include file="buttons/button.tpl" but_id="opener_picker_`$data_id`" but_href="pages.picker?display=`$display`&amp;picker_for=`$picker_for`&amp;extra=`$extra_var`&amp;checkbox_name=`$checkbox_name`&amp;root=`$default_name`&amp;except_id=`$except_id`&amp;data_id=`$data_id``$extra_url`&amp;company_id=`$company_id`"|fn_url but_text=$_but_text but_role=$_but_role but_rev="content_`$data_id`" but_meta="cm-dialog-opener"}

	{if !$no_container}</div>{/if}

	<div class="hidden" id="content_{$data_id}" title="{$but_text|default:$lang.add_pages}">
	</div>

{/if}