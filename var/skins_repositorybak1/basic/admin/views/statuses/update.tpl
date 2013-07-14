{assign var="st" value=$smarty.request.status|lower}

<div id="content_group{$st}">

<form action="{""|fn_url}" method="post" name="update_status_{$st}_form" class="cm-form-highlight{if ""|fn_check_form_permissions} cm-hide-inputs{/if}">
<input type="hidden" name="type" value="{$type|default:"O"}" />
<input type="hidden" name="status" value="{$smarty.request.status}" />

<div class="tabs cm-j-tabs">
	<ul>
		<li class="cm-js cm-active"><a>{$lang.general}</a></li>
	</ul>
</div>

<div class="cm-tabs-content">
<fieldset>
	<div class="form-field">
		<label for="description_{$st}" class="cm-required">{$lang.name}:</label>
		<input type="text" size="70" id="description_{$st}" name="status_data[description]" value="{$status_data.description}" class="input-text-large main-input" />
	</div>

	{if $mode != "add"}
		<div class="form-field">
			<label for="status_{$st}" class="cm-required">{$lang.status}:</label>			
				<input type="hidden" name="status_data[status]" value="{$status_data.status}" />
				<span>{$status_data.status}</span>
		</div>
	{/if}

	<div class="form-field">
		<label for="email_subj_{$st}">{$lang.email_subject}:</label>
		<input type="text" size="40" name="status_data[email_subj]" id="email_subj_{$st}" value="{$status_data.email_subj}" class="input-text-large" />
	</div>

	<div class="form-field">
		<label for="email_header_{$st}">{$lang.email_header}:</label>
		<textarea id="email_header_{$st}" name="status_data[email_header]" class="cm-wysiwyg input-textarea-long">{$status_data.email_header}</textarea>
		
	</div>

	{foreach from=$status_params key="name" item="data"}
		<div class="form-field">
			<label for="status_param_{$st}_{$name}">{$lang[$data.label]}:</label>
			{if $data.not_default == true && $status_data.is_default === "Y"}
				{assign var="var" value=$status_data.params.$name}
				{assign var="lbl" value=$data.variants.$var}
				<span>{$lang.$lbl}</span>
			
			{elseif $data.type == "select"}
				<select id="status_param_{$st}_{$name}" name="status_data[params][{$name}]">
					{foreach from=$data.variants key="v_name" item="v_data"}
					<option value="{$v_name}" {if $status_data.params.$name == $v_name}selected="selected"{/if}>{$lang.$v_data}</option>
					{/foreach}
				</select>
			
			{elseif $data.type == "checkbox"}
				<input type="hidden" name="status_data[params][{$name}]" value="N" />
				<input type="checkbox" name="status_data[params][{$name}]" id="status_param_{$st}_{$name}" value="Y" {if $status_data.params.$name == "Y" || (!$status_data && $data.default_value == "Y")} checked="checked"{/if} class="checkbox" />

			{elseif $data.type == "status"}
				{include file="common_templates/status.tpl" status=$status_data.params.$name display="select" name="status_data[params][`$name`]" status_type=$data.status_type select_id="status_param_`$st`_`$name`"}

			{elseif $data.type == "color"}
				{include file="common_templates/colorpicker.tpl"}
				<div class="cm-colorpicker" id="select_status_param_{$st}_{$name}" style="background-color: #{$status_data.params.$name}"></div><input type="text" size="10" name="status_data[params][{$name}]" id="status_param_{$st}_{$name}" value="{$status_data.params.$name}" class="input-text" />

			{/if}
		</div>
	{/foreach}
</fieldset>
</div>


<div class="buttons-container">
	{include file="buttons/save_cancel.tpl" but_name="dispatch[statuses.update]" cancel_action="close"}
</div>

</form>
<!--content_group{$st}--></div>