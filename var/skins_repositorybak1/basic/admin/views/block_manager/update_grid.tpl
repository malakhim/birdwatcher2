
{assign var="id" value=$grid.grid_id|default:0}

<div id="grid_properties_{$id}">
<form action="{""|fn_url}" method="post" class="cm-form-highlight" name="grid_update_form">

{if $grid.grid_id}
	<input type="hidden" name="grid_id" value="{$grid.grid_id}" />
{/if}

<input type="hidden" name="container_id" value="{$params.container_id}" />
<input type="hidden" name="parent_id" value="{$params.parent_id|default:$grid.parent_id|default:0}" />

<div class="tabs cm-j-tabs">
	<ul>
		<li class="cm-js cm-active"><a>{$lang.general}</a></li>
	</ul>
</div>

<div class="cm-tabs-content">
<fieldset>
	<div class="form-field cm-no-hide-input">
		<label for="grid_width_{$id}">{$lang.width}:</label>
		<select id="grid_width_{$id}" name="width">
			{section name="width" start=0 loop=$params.max_width|default:24}
				{assign var="index" value=$smarty.section.width.index+1}
				<option value="{$index}" {if $index == $grid.width}selected="selected"{/if}>{$index}</option>
			{/section}
		</select>
	</div>

	<div class="form-field cm-no-hide-input">
		<label for="grid_content_align_{$id}">{$lang.content_alignment}:</label>
		<select id="grid_content_align_{$id}" name="content_align">
			<option value="FULL_WIDTH" {if $grid.content_align == "FULL_WIDTH"}selected="selected"{/if}>{$lang.full_width}</option>			
			<option value="LEFT" {if $grid.content_align == "LEFT"}selected="selected"{/if}>{$lang.left}</option>
			<option value="RIGHT" {if $grid.content_align == "RIGHT"}selected="selected"{/if}>{$lang.right}</option>
		</select>
	</div>

	<div class="form-field cm-no-hide-input">
		<label for="grid_prefix_{$id}">{$lang.prefix}:</label>
		<select id="grid_prefix_{$id}" name="prefix">
			{section name="prefix" start=0 loop=$params.max_width|default:24}
				{assign var="index" value=$smarty.section.prefix.index}
				<option value="{$index}" {if $index == $grid.prefix}selected="selected"{/if}>{$index}</option>
			{/section}
		</select>
	</div>

	<div class="form-field cm-no-hide-input">
		<label for="grid_suffix_{$id}">{$lang.suffix}:</label>
		<select id="grid_suffix_{$id}" name="suffix">
			{section name="suffix" start=0 loop=$params.max_width|default:24}
				{assign var="index" value=$smarty.section.suffix.index}
				<option value="{$index}" {if $index == $grid.suffix}selected="selected"{/if}>{$index}</option>
			{/section}
		</select>
	</div>

	<div class="form-field cm-no-hide-input">
		<label for="grid_user_class_{$id}">{$lang.user_class}:</label>
		<input id="grid_user_class_{$id}" class="input-text" name="user_class" value="{$grid.user_class}" />
	</div>

</fieldset>
</div>

<div class="buttons-container">
	{include file="buttons/save_cancel.tpl" but_name="dispatch[block_manager.update_location]" cancel_action="close" but_meta="cm-dialog-closer"}
</div>
</form>
<!--grid_properties_{$id}--></div>
