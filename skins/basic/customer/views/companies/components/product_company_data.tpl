{if $smarty.const.PRODUCT_TYPE == "MULTIVENDOR"}
{assign var="lang_vendor_supplier" value=$lang.vendor}
{else}
{assign var="lang_vendor_supplier" value=$lang.supplier}
{/if}

		{if ($company_name || $company_id) && $settings.Suppliers.display_supplier == "Y"}
			<div class="form-field{if !$capture_options_vs_qty} product-list-field{/if}">
				<label>{$lang_vendor_supplier}:</label>
				<span>{if $company_name}{$company_name}{else}{$company_id|fn_get_company_name}{/if}</span>
			</div>
		{/if}