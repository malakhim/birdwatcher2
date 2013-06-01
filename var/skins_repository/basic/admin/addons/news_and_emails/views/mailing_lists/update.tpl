{script src="js/tabs.js"}

{if $mailing_list.list_id}
	{assign var="id" value=$mailing_list.list_id}
{else}
	{assign var="id" value=0}
{/if}

<div id="content_group{$id}">
<form action="{""|fn_url}" method="post" name="newsletters_form_{$id}" class="cm-form-highlight">
<input type="hidden" name="list_id" value="{$id}" />

<div class="tabs cm-j-tabs">
	<ul>
		<li id="tab_campaign_details_{$id}" class="cm-js cm-active"><a>{$lang.general}</a></li>
	</ul>
</div>

<div class="cm-tabs-content">
<fieldset>
	<div class="form-field">
		<label for="elm_name_{$id}" class="cm-required">{$lang.name}:</label>
		<input type="text" name="mailing_list_data[name]" id="elm_name_{$id}" value="{$mailing_list.object}" class="input-text-large main-input" />
	</div>

	<div class="form-field">
		<label for="elm_from_name_{$id}">{$lang.from_name}:</label>
		<input type="text" name="mailing_list_data[from_name]" id="elm_from_name_{$id}" value="{$mailing_list.from_name}" class="input-text" />
	</div>

	<div class="form-field">
		<label for="elm_from_email_{$id}" class="cm-email cm-required">{$lang.from_email}:</label>
		<input type="text" name="mailing_list_data[from_email]" id="elm_from_email_{$id}" value="{$mailing_list.from_email|default:$settings.Company.company_newsletter_email}" class="input-text" />
	</div>

	<div class="form-field">
		<label for="elm_reply_to_{$id}" class="cm-email cm-required">{$lang.reply_to}:</label>
		<input type="text" name="mailing_list_data[reply_to]" id="elm_reply_to_{$id}" value="{$mailing_list.reply_to|default:$settings.Company.company_newsletter_email}" class="input-text" />
	</div>

	<div class="form-field">
		<label for="elm_register_autoresponder_{$id}">{$lang.register_autoresponder}:</label>
		<select name="mailing_list_data[register_autoresponder]" id="elm_register_autoresponder_{$id}">
			<option value="0">{$lang.no_autoresponder}</option>
			{foreach from=$autoresponders item=a}
				<option {if $mailing_list.register_autoresponder == $a.newsletter_id}selected="selected"{/if} value="{$a.newsletter_id}">{$a.newsletter}</option>
			{/foreach}
		</select>
	</div>

	<div class="form-field">
		<label for="elm_show_on_checkout_{$id}">{$lang.show_on_checkout}:</label>
		<input type="hidden" name="mailing_list_data[show_on_checkout]" value="0" />
		<input type="checkbox" name="mailing_list_data[show_on_checkout]" id="elm_show_on_checkout_{$id}" value="1" {if $mailing_list.show_on_checkout}checked="checked"{/if} class="checkbox" />
	</div>

	<div class="form-field">
		<label for="elm_show_on_registration_{$id}">{$lang.show_on_registration}:</label>
		<input type="hidden" name="mailing_list_data[show_on_registration]" value="0" />
		<input type="checkbox" name="mailing_list_data[show_on_registration]" id="elm_show_on_registration_{$id}" value="1" {if $mailing_list.show_on_registration}checked="checked"{/if} class="checkbox" />
	</div>

	{if $id}
	<div class="form-field">
		<label>{$lang.subscribers}:</label>
		{$mailing_list.subscribers_num}
		{include file="buttons/button.tpl" but_text=$lang.add_subscribers but_href="subscribers.manage?list_id=`$id`" but_role="text"}
	</div>
	{/if}

	{include file="common_templates/select_status.tpl" input_name="mailing_list_data[status]" obj_id=$id obj=$mailing_list hidden=true}
</fieldset>
</div>

<div class="buttons-container">
	{include file="buttons/save_cancel.tpl" but_name="dispatch[mailing_lists.update]" cancel_action="close"}
</div>
	
</form>

<!--content_group{$id}--></div>