{if $smarty.const.PRODUCT_TYPE == "MULTIVENDOR" && !"COMPANY_ID"|defined}
{if $addons.vendor_data_premoderation.products_prior_approval == 'custom' || $addons.vendor_data_premoderation.products_updates_approval == 'custom' || $addons.vendor_data_premoderation.vendor_profile_updates_approval == 'custom'}
<fieldset>
	{include file="common_templates/subheader.tpl" title=$lang.vendor_data_premoderation}

	{if $addons.vendor_data_premoderation.products_prior_approval == 'custom'}
	<div class="form-field">
		<label for="company_pre_moderation">{$lang.pre_moderation}:</label>
		<input type="hidden" name="company_data[pre_moderation]" value="N" />
		<input type="checkbox" id="company_pre_moderation" class="checkbox" {if $company_data.pre_moderation == "Y"}checked="checked"{/if} name="company_data[pre_moderation]" value="Y" />
	</div>
	{/if}

	{if $addons.vendor_data_premoderation.products_updates_approval == 'custom'}
	<div class="form-field">
		<label for="company_pre_moderation_edit">{$lang.pre_moderation_edit}:</label>
		<input type="hidden" name="company_data[pre_moderation_edit]" value="N" />
		<input type="checkbox" id="company_pre_moderation_edit" class="checkbox" {if $company_data.pre_moderation_edit == "Y"}checked="checked"{/if} name="company_data[pre_moderation_edit]" value="Y" />
	</div>
	{/if}
	
	{if $addons.vendor_data_premoderation.vendor_profile_updates_approval == 'custom'}
	<div class="form-field">
		<label for="company_pre_moderation_edit_vendors">{$lang.pre_moderation_edit_vendors}:</label>
		<input type="hidden" name="company_data[pre_moderation_edit_vendors]" value="N" />
		<input type="checkbox" id="company_pre_moderation_edit_vendors" class="checkbox" {if $company_data.pre_moderation_edit_vendors == "Y"}checked="checked"{/if} name="company_data[pre_moderation_edit_vendors]" value="Y" />
	</div>
	{/if}
	
</fieldset>
{/if}
{/if}