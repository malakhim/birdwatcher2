{assign var="r_url" value="<span>`$config.http_location`/payments/enets.php</span>"}
<p>{$lang.text_enets_notice|replace:"[r_url]":$r_url}</p>
<hr />

<div class="form-field">
	<label for="merchantid">{$lang.merchant_id}:</label>
	<input type="text" name="payment_data[processor_params][merchantid]" id="merchantid" value="{$processor_params.merchantid}" class="input-text" size="60" />
</div>