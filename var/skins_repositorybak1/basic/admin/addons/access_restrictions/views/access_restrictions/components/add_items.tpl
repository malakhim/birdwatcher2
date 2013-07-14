<form action="{""|fn_url}" method="post" name="update_rule_form" class="cm-form-highlight">
<input type="hidden" name="selected_section" value="{$selected_section}" />
<input type="hidden" name="rule_data[section]" value="{$selected_section}" />

<div class="add-new-object-group">
	<div class="tabs cm-j-tabs">
		<ul>
			<li id="tab_add_rule_new" class="cm-js cm-active"><a>{$lang.general}</a></li>
		</ul>
	</div>

	<div class="cm-tabs-content" id="content_tab_add_rule_new">
	<fieldset>
		{if $object_name == "ip"}
			<div class="form-field">
				<label class="cm-required" for="elm_ip_from">{$lang.ip_from}:</label>
				<input type="text" id="elm_ip_from" name="rule_data[range_from]" size="15" class="input-text" />
			</div>

			<div class="form-field">
				<label class="cm-required" for="elm_ip_to">{$lang.ip_to}:</label>
				<input type="text" id="elm_ip_to" name="rule_data[range_to]" size="15" class="input-text" />
			</div>
		{else}
			<div class="form-field">
				<label class="cm-required" for="elm_value">{$object_name}:</label>
				<input type="text" id="elm_value" name="rule_data[value]" size="15" value="" onfocus="this.value = ''" class="input-text-large main-input" />
			</div>
		{/if}

		<div class="form-field">
			<label for="elm_reason">{$lang.reason}:</label>
			<input type="text" id="elm_reason" name="rule_data[reason]" class="input-text-large" />
		</div>

		{include file="common_templates/select_status.tpl" input_name="rule_data[status]" id="elm_status"}
	</fieldset>
	</div>
</div>

<div class="buttons-container">
	{include file="buttons/save_cancel.tpl" but_name="dispatch[access_restrictions.update]" create=true cancel_action="close"}
</div>

</form>