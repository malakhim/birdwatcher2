{if "COMPANY_ID"|defined && $smarty.const.PRODUCT_TYPE == 'ULTIMATE' || $smarty.const.PRODUCT_TYPE != 'ULTIMATE'}
	<li class="select-field">
		<input type="checkbox" value="seo_name" id="seo_name" name="selected_fields[extra][]" checked="checked" class="checkbox cm-item-s" />
		<label for="seo_name">{$lang.seo_name}</label>
	</li>
{/if}