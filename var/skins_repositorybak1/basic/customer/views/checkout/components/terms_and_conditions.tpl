{if $cart_agreements || $settings.General.agree_terms_conditions == "Y"}
	<script type="text/javascript">
	//<![CDATA[
	lang.checkout_terms_n_conditions_alert = '{$lang.checkout_terms_n_conditions_alert|escape:javascript}';
	{literal}
	function fn_check_agreement(id)
	{
		if (!$('#' + id).attr('checked')) {
			return lang.checkout_terms_n_conditions_alert;
		}

		return true;
	}
	{/literal}
	
	{if $iframe_mode}
		{literal}
		function fn_check_agreements(suffix)
		{
			if ($('form[name=payments_form_' + suffix + '] input:checkbox.cm-agreement:checked').length > 0 && $('form[name=payments_form_' + suffix + '] input:checkbox.cm-agreement:checked').length == $('form[name=payments_form_' + suffix + '] input.cm-agreement:checkbox').length) {
				$('#payment_method_iframe' + suffix).addClass('hidden');
			} else {
				$('#payment_method_iframe' + suffix).removeClass('hidden');
			}
		}
		{/literal}
	{/if}
	//]]>
	</script>
		{if $settings.General.agree_terms_conditions == "Y"}
		<div class="form-field margin-top terms">
			{hook name="checkout:terms_and_conditions"}
			
			<label for="id_accept_terms{$suffix}" class="valign cm-custom (check_agreement)"><input type="checkbox" id="id_accept_terms{$suffix}" name="accept_terms" value="Y" class="cm-agreement checkbox valign" {if $iframe_mode}onclick="fn_check_agreements('{$suffix}');"{/if} />{$lang.checkout_terms_n_conditions}</label>
			{/hook}
		</div>
		{/if}
		{if $cart_agreements}
		<div class="form-field">
			{hook name="checkout:terms_and_conditions_downloadable"}
			
			<label for="product_agreements_{$suffix}" class="valign cm-custom (check_agreement)"><input type="checkbox" id="product_agreements_{$suffix}" name="agreements[]" value="Y" class="cm-agreement valign checkbox"  {if $iframe_mode}onclick="fn_check_agreements('{$suffix}');"{/if}/>{$lang.checkout_edp_terms_n_conditions}</label>{include file="buttons/button.tpl" but_text=$lang.license_agreement but_role="text" but_id="sw_elm_agreements" but_meta="cm-combination"}
			{/hook}
			<div class="hidden" id="elm_agreements">
			{foreach from=$cart_agreements item="product_agreements"}
				{foreach from=$product_agreements item="agreement"}
				<p>{$agreement.license|unescape}</p>
				{/foreach}
			{/foreach}
			</div>
		</div>
		{/if}
{/if}