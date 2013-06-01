{capture name="mainbox"}

<div id="skin_selector_container">
{if 'DEVELOPMENT'|defined}
	<p class="no-items">Cart is in development mode now and skin selector is unavailable</div>
{else}
<form action="{""|fn_url}" method="post" class="cm-ajax cm-comet" name="skin_selector_form">
<input type="hidden" name="result_ids" value="skin_selector_container">

<table cellspacing="0" cellpadding="0" border="0" width="100%">
<tr>
	<td valign="top" width="50%">
	<div class="form-field">
		<label for="customer_skin">{$lang.text_customer_skin}:</label>
		<select id="customer_skin" name="skin_data[customer]" onchange="$('#c_screenshot').attr('src', '{$config.current_path}/var/skins_repository/'+this.value+'/customer_screenshot.png');">
			{foreach from=$available_skins item=s key=k}
				{if $s.customer == "Y"}
					<option value="{$k}" {if $settings.skin_name_customer == $k}selected="selected"{/if}>{$s.description}</option>
				{/if}
			{/foreach}
		</select>
	</div>
	

	<div class="form-field">
		<label>{$lang.templates_dir}:</label>
		{$customer_path}
		<div class="break">
			<img class="solid-border" width="300" id="c_screenshot" src="{$config.current_path}/var/skins_repository/{$settings.skin_name_customer|default:"basic"}/customer_screenshot.png" />
		</div>
	</div>

	</td>
	<td width="50%">
	
	<div class="form-field">
		<label for="admin_skin">{$lang.text_admin_skin}:</label>
		<select id="admin_skin" name="skin_data[admin]" onchange="$('#a_screenshot').attr('src', '{$config.current_path}/var/skins_repository/' + this.value + '/admin_screenshot.png');">
			{foreach from=$available_skins item=s key=k}
				{if $s.admin == "Y"}
					<option value="{$k}" {if $settings.skin_name_admin == $k}selected="selected"{/if}>{$s.description}</option>
				{/if}
			{/foreach}
		</select>
	</div>

	<div class="form-field">
		<label>{$lang.templates_dir}:</label>
		{$admin_path}
		<div class="break">
			<img class="solid-border" width="300" id="a_screenshot" src="{$config.current_path}/var/skins_repository/{$settings.skin_name_admin|default:"basic"}/admin_screenshot.png" />
		</div>
	</div>
	
	</td>
</tr>
</table>


<div class="buttons-container buttons-bg">
	{include file="buttons/save.tpl" but_name="dispatch[skin_selector.update]" but_role="button_main"}
</div>

</form>
{/if}

<!--skin_selector_container--></div>
{/capture}
{include file="common_templates/mainbox.tpl" title=$lang.skin_selector content=$smarty.capture.mainbox}
