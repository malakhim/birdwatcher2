{** block-description:tmpl_subscription **}
{if $addons.news_and_emails}
<div class="subscribe-block">
<form action="{""|fn_url}" method="post" name="subscribe_form">
<input type="hidden" name="redirect_url" value="{$config.current_url}" />
<input type="hidden" name="newsletter_format" value="2" />
<p><span>{$lang.stay_connected}</span></p>
<p class="subscribe-notice">{$lang.stay_connected_notice}</p>
<div class="form-field input-append subscribe">
<label class="cm-required cm-email hidden" for="subscr_email{$block.block_id}">{$lang.email}</label>
<input type="text" name="subscribe_email" id="subscr_email{$block.block_id}" size="20" value="{$lang.enter_email|escape:html}" class="cm-hint subscribe-email input-text input-text-menu" />
{include file="buttons/go.tpl" but_name="newsletters.add_subscriber" alt=$lang.go}
</div>
</form>
</div>
{/if}