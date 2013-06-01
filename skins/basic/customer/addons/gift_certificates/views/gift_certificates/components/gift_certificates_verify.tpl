<div class="gift-validate code-input discount-coupon">
<form name="gift_certificate_verification_form" class="cm-ajax cm-ajax-force" action="{""|fn_url}">
	<input type="hidden" name="result_ids" value="gift_cert_verify" />
	<h4>{$lang.certificate_verification}</h4>
	<div class="form-field input-append">
		<label for="id_verify_code" class="cm-required hidden">{$lang.enter_code}</label>
		{strip}
			<input type="text" name="verify_code" id="id_verify_code" value="{$lang.enter_code|escape:html}" class="input-text cm-hint" />
			{include file="buttons/go.tpl" but_name="gift_certificates.verify" alt=$lang.go}
		{/strip}
	</div>
</form>
</div>
<div id="gift_cert_verify">
<!--gift_cert_verify--></div>
{script src="js/tabs.js"}
{literal}
<script type="text/javascript">
//<![CDATA[
function fn_form_pre_gift_certificate_verification_form() {
	if ($('#gift_cert_data').length) {
		$('#gift_cert_data').remove();
	}
	return true;
}
function fn_form_post_gift_certificate_verification_form() {
	if ($('#gift_cert_data').length) {
		$('#gift_cert_data').ceDialog('open', {'width': 'auto', 'resizable': false});
	}
	return true;
}
//]]>
</script>
{/literal}