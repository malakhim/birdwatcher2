
{assign var="id" value=$container.container_id|default:0}

<div id="container_properties_{$id}">
<form action="{""|fn_url}" method="post" class="cm-form-highlight" name="container_update_form">

{if $container.container_id}
	<input type="hidden" name="container_data[container_id]" value="{$container.container_id}" />
{/if}

<div class="tabs cm-j-tabs">
	<ul>
		<li class="cm-js cm-active"><a>{$lang.general}</a></li>
	</ul>
</div>

<div class="cm-tabs-content">
<fieldset>
	<div class="form-field cm-no-hide-input">
		<label for="container_width_{$id}">{$lang.width}:</label>
		<select id="container_width_{$id}" name="container_data[width]">
			<option value="12" {if $container.width == 12}selected="selected"{/if}>12</option>
			<option value="16" {if $container.width == 16}selected="selected"{/if}>16</option>
		</select>
	</div>

	<div class="form-field cm-no-hide-input">
		<label for="container_user_class_{$id}">{$lang.user_class}:</label>
		<input id="container_user_class_{$id}" class="input-text" name="container_data[user_class]" value="{$container.user_class}" />
	</div>

</fieldset>
</div>

<div class="buttons-container">
	{include file="buttons/save_cancel.tpl" but_name="dispatch[block_manager.update_location]" cancel_action="close" but_meta="cm-dialog-closer"}
</div>
</form>
<!--container_properties_{$id}--></div>
