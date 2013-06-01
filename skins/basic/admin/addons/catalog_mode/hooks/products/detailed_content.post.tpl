<fieldset>
	{include file="common_templates/subheader.tpl" title=$lang.catalog_mode}

	<div class="form-field">
		<label for="buy_now_url">{$lang.buy_now_url}:</label>
		<input type="text" id="buy_now_url" name="product_data[buy_now_url]" value="{$product_data.buy_now_url|default:""}" class="input-text" size="40"/>
	</div>
</fieldset>