{include file="addons/twigmo/settings/contact_twigmo_support.tpl"}

{if $addons.twigmo.access_id}
	{include file="common_templates/subheader.tpl" title=$lang.twgadmin_manage_settings}
{else}
	{include file="common_templates/subheader.tpl" title=$lang.twgadmin_connect_your_store}
{/if}

<fieldset>

<div id="connect_settings">

{if $user_info.email != $smarty.const.DEFAULT_ADMIN_EMAIL}
	{assign var="tw_email" value=$addons.twigmo.email|default:$user_info.email}
{else}
	{assign var="tw_email" value=$addons.twigmo.email|default:""}
{/if}


<div class="form-field">
	<label class="{if !$addons.twigmo.access_id}cm-required cm-email{/if}" for="elm_tw_email">{$lang.email}:</label>
	<input type="text" id="elm_tw_email" name="tw_register[email]"  value="{$tw_email}" onkeyup="fn_tw_copy_email();" class="input-text-large" size="60" {if $addons.twigmo.access_id}disabled="disabled"{/if} />
	{if !$addons.twigmo.access_id}
		{include file="buttons/button.tpl" but_text=$lang.reset_password but_href="http://twigmo.com/svc/reset_password.php?email=$tw_email" but_id="elm_reset_tw_password" but_role="link"}

		<script type="text/javascript">
		//<![CDATA[
		{literal}
		function fn_tw_copy_email() {
			var tw_email = $('#elm_tw_email').val();
			$('#elm_reset_tw_password').attr('href', 'http://twigmo.com/svc/reset_password.php?email=' + tw_email);
		}
		{/literal}
		//]]>
		</script>
	{/if}
</div>

{if $addons.twigmo.access_id}
<div class="form-field">
	<label for="access_id">{$lang.twgadmin_access_id}:</label>
	<div style="padding: 4px 18px 0 0;" id="access_id">{$addons.twigmo.access_id}</div>
</div>
{/if}

<input type="hidden" id="elm_tw_store_name" name="tw_register[store_name]"  value="{if $addons.twigmo.store_name}{$addons.twigmo.store_name}{else}{$config.http_host}{$config.http_path}{/if}"/>

<input type="hidden" name="tw_register[use_password]" value="N" />

{if !$addons.twigmo.access_id}
	<div id='twg_passwords'>
		<div class="form-field">
			<label for="elm_tw_password1" {if !$addons.twigmo.access_id}class="cm-required"{/if}>{$lang.password}:</label>
			<input type="password" id="elm_tw_password1" name="tw_register[password1]" class="input-text" size="32" maxlength="32" value="" autocomplete="off" />
		</div>
		<div class="form-field">
			<label for="elm_tw_password2" {if !$addons.twigmo.access_id}class="cm-required"{/if}>{$lang.confirm_password}:</label>
			<input type="password" id="elm_tw_password2" name="tw_register[password2]" class="input-text" size="32" maxlength="32" value="" autocomplete="off" />
		</div>
	</div>
{/if}        

<div class="form-field">
	<label for="version">{$lang.version}:</label>
	<div style="padding: 4px 18px 0 0;" id="version">{$addons.twigmo.version|default:$tw_register.version}</div>
</div>
	
{* Social buttons *}
{if $addons.twigmo.access_id}
	<div class="form-field">
		<label for="social_links">{$lang.twgadmin_on_social}:</label>
		<div id="social_links">
			{* Facebook *}
				<a target="_blank" href="http{if 'HTTPS'|defined}s{/if}://facebook.com/twigmo">
					<span class="facebook-btn float-left"></span>
				</a>
			{* /Facebook *}
			{* Twitter *}
				<a target="_blank" href="http{if 'HTTPS'|defined}s{/if}://twitter.com/twigmo">
					<span class="twitter-btn float-left"></span>
				</a>
			{* /Twitter *}
		</div>
	</div>
{/if}
{* /Social buttons *}
	
{if !$addons.twigmo.access_id}
	<input type="hidden" name="result_ids" value="connect_settings,storefront_settings"/>
	<input type="hidden" name="tw_register[checked_email]" value="{$addons.twigmo.checked_email}"/>
	
	{if $stores}
	<div>{$lang.tw_select_connect_description}</div>
	
	<div class="form-field">
		<div class="select-field">
		{foreach from=$stores item=v key=k}
		<input type="radio" name="tw_register[store_id]" value="{$v.store_id}" {if $v.selected}checked="checked"{/if} class="radio" id="variant_tw_store_id_{$v.store_id}" /><label for="variant_tw_store_id_{$v.store_id}">{$v.title}</label><br />
		{/foreach}
		</div>
	</div>

	{/if}

	<script type="text/javascript">
	//<![CDATA[
	lang.checkout_terms_n_conditions_alert = '{$lang.checkout_terms_n_conditions_alert|escape:javascript}';
	{literal}
	function fn_tw_check_agreement() {
		if (!$('#id_accept_terms').attr('checked')) {
			return lang.checkout_terms_n_conditions_alert;
		}

		return true;
	}
	{/literal}
	//]]>
	</script>

	<div class="form-field">
		<textarea id="twigmo_license" class="float-left" name="tw_register[twigmo_license]" cols="83" rows="24" readonly="readonly" disabled="disabled">{if $twigmo_license}{$twigmo_license}{else}{$tw_register.twigmo_license}{/if}</textarea>
		<label for="id_accept_terms" style="margin-left: 0px; width: auto;" class="cm-custom (tw_check_agreement)"><input type="checkbox" id="id_accept_terms" name="accept_terms" value="Y" class="checkbox" />{$lang.checkout_terms_n_conditions}</label>
	</div>
	
	<script type="text/javascript">
	//<![CDATA[
	{literal}
	$(document).ready(function () {
		if (twigmo_license_text) {
           $("#twigmo_license").text(twigmo_license_text);
        }
		$('.form-field a.text-button-link').css({'margin': '0 0 0 10px'});
	});
	{/literal}
	//]]>
	</script>

	<div class="form-field">
		{include file="buttons/button.tpl" but_role="button" but_meta="cm-ajax cm-skip-avail-switch" but_name="dispatch[addons.tw_connect]" but_text=$lang.twgadmin_connect}
	</div>
{/if}

<!--connect_settings--></div>

</fieldset>
