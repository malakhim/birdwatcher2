{script src="js/picker.js"}

{capture name="mainbox"}

{if $installed_upgrades.has_conflicts == true}
<div class="notes">
<h5>{$lang.note}:</h5>
{$lang.text_uc_has_conflicts}: <a class="tool-link" href="{"upgrade_center.installed_upgrades"|fn_url}">{$lang.view}</a>
</div>
{/if}


{if $require_license_number == true}

<p>{$lang.text_uc_license_number_required}</p>
<form action="{""|fn_url}" method="post" name="uc_license_form">
<input type="hidden" name="redirect_url" value="{$config.current_url}" />

<div class="form-field">
	<label for="elm_license_number">{$lang.license_number}:</label>
	<input type="text" name="settings_data[license_number]" id="elm_license_number" size="20" value="{$uc_settings.license_number}" class="input-text-large" />
</div>

<div class="buttons-container buttons-bg">
	{include file="buttons/button.tpl" but_name="dispatch[upgrade_center.update_settings]" but_text=$lang.save but_role="button_main"}
</div>

</form>

{else}

{foreach from=$packages item="package" name="fep"}
	{include file="common_templates/subheader.tpl" title=$package.name}

	<div class="order-info">
	{$lang.version}:&nbsp;<span>{$package.to_version}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$lang.release_date}:&nbsp;<span>{$package.timestamp|date_format:"`$settings.Appearance.date_format` `$settings.Appearance.time_format`"}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$lang.filesize}:&nbsp;<span>{$package.size|formatfilesize}</span>
	<p>{$package.description|unescape}</p>
	</div>

	

	<div class="buttons-container">

		{if $package.from_version == $smarty.const.PRODUCT_VERSION && $package.from_edition == $smarty.const.PRODUCT_TYPE}
			{if $package.is_avail == 'Y'}
				<form action="{""|fn_url}" method="get" name="uc_form_{$package.name|md5}" >
					<input type="hidden" name="package_id" value="{$package.package_id}" />
					<input type="hidden" name="new_license_from" value="{$package.from_edition}" />
					<input type="hidden" name="new_license_to" value="{$package.to_edition}"  />

					{if $new_license_data.new_license && $package.from_edition == $new_license_data.new_license_from && $package.to_edition == $new_license_data.new_license_to}
						{$lang.text_uc_new_license_input|replace:"[input]":"<input type=\"text\" name=\"new_license\" value=\"`$new_license_data.new_license`\" />"}
						{if $new_license_data.new_license_package}
							{$lang.text_uc_you_may_start_installation}

							{include file="buttons/button.tpl" but_text=$lang.install but_name="dispatch[upgrade_center.check_edition_license]" but_role="button_main"}
						{else}
							{$lang.text_uc_edition_update_package_not_available}

							{include file="buttons/button.tpl" but_text=$lang.check but_name="dispatch[upgrade_center.check_edition_license]" but_role="button_main"}
						{/if}
					{else}
						<p>{$lang.text_uc_enter_new_edition_license}:
						<input type="text" name="new_license" />

						{include file="buttons/button.tpl" but_text=$lang.update but_name="dispatch[upgrade_center.check_edition_license]" but_role="button_main"}
						</p>

						<p>{$lang.text_uc_buy_new_edition_license}</p>
					{/if}
				</form>
			{elseif $package.purchase_time_limit == 'Y'}
				<span>{$lang.upgrade_is_not_avail}</span>
			{else}
				<span>{$lang.update_period_expired}</span>
			{/if}
		{/if}
	</div>

{foreachelse}
	{if $has_conflicts == true}
	<p>&nbsp;</p>
	{/if}
	<p class="no-items">{$lang.text_no_upgrades_available}</p>
{/foreach}


{capture name="extra_tools"}
	{include file="buttons/button.tpl" but_href="upgrade_center.refresh" but_text=$lang.refresh_packages_list but_role="tool"}
	{if $installed_upgrades.has_upgrades}
		{include file="buttons/button.tpl" but_href="upgrade_center.installed_upgrades" but_text=$lang.installed_upgrades but_role="tool"}
	{/if}
{/capture}


{/if}

{/capture}
{include file="common_templates/mainbox.tpl" title=$lang.upgrade_center content=$smarty.capture.mainbox extra_tools=$smarty.capture.extra_tools}