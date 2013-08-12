{script src="js/tabs.js"}

{if $loc.store_location_id}
	{assign var="id" value=$loc.store_location_id}
{else}
	{assign var="id" value="0"}
{/if}

<div id="content_group{$id}">
<form action="{""|fn_url}" method="post" class="cm-form-highlight" name="store_locations_form{$suffix}">
<input type="hidden" name="store_location_id" value="{$id}" />

<div class="tabs cm-j-tabs">
	<ul>
		<li id="tab_general_{$id}" class="cm-js cm-active"><a>{$lang.general}</a></li>
	</ul>
</div>

<div class="cm-tabs-content">
<fieldset>
	<div class="form-field">
		<label for="name_{$id}" class="cm-required">{$lang.name}:</label>
		<input type="text" id="name_{$id}" name="store_location_data[name]" value="{$loc.name}" class="input-text-large" />
	</div>


	<div class="form-field">
		<label for="position_{$id}">{$lang.position}:</label>
		<input type="text" name="store_location_data[position]" id="position_{$id}" value="{$loc.position}" size="3" class="input-text-short" />
	</div>

	<div class="form-field">
		<label for="description_{$id}">{$lang.description}:</label>
		<textarea id="description_{$id}" name="store_location_data[description]" cols="55" rows="2" class="cm-wysiwyg input-textarea-long">{$loc.description}</textarea>
		
	</div>

	<div class="form-field">
		<label for="country_{$id}">{$lang.country}:</label>
		{assign var="countries" value=$smarty.const.CART_LANGUAGE|fn_get_countries:true}
		<select id="country_{$id}" name="store_location_data[country]" class="select">
			<option value="">- {$lang.select_country} -</option>
			{foreach from=$countries item=country}
			<option {if $loc.country == $country.code}selected="selected"{/if} value="{$country.code}">{$country.country}</option>
			{/foreach}
		</select>
	</div>

	<div class="form-field">
		<label for="city_{$id}">{$lang.city}:</label>
		<input type="text" name="store_location_data[city]" id="city_{$id}" value="{$loc.city}" class="input-text" />
	</div>

	<div class="form-field">
		<label for="latitude_{$id}">{$lang.coordinates} ({$lang.latitude_short} x {$lang.longitude_short}):</label>
		<input type="text" name="store_location_data[latitude]" id="latitude_{$id}" value="{$loc.latitude}" class="input-text-medium input-fill" /> x <input type="text" name="store_location_data[longitude]" id="longitude_{$id}" value="{$loc.longitude}" class="input-text-medium input-fill" />
		
		{include file="buttons/button.tpl" but_text=$lang.select but_onclick="fn_init_map('country_`$id`', 'city_`$id`', 'latitude_`$id`', 'longitude_`$id`');" but_type="button"}
	</div>

	{include file="views/localizations/components/select.tpl" data_from=$loc.localization data_name="store_location_data[localization]"}
</fieldset>
</div>

<div class="buttons-container" style="position: absolute !important;">
	{include file="buttons/save_cancel.tpl" but_name="dispatch[store_locator.update]" cancel_action="close"}
</div>
	
</form>

<!--content_group{$id}--></div>