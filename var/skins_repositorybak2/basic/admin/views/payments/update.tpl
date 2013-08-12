{if "COMPANY_ID"|defined && $payment.payment_id && $payment.company_id != $smarty.const.COMPANY_ID}
	{assign var="hide_fields" value=true}
{/if}

{if $mode == "add"}
	{assign var="id" value="0"}
{else}
	{assign var="id" value=$payment.payment_id}
{/if}

<div id="content_group{$id}">

<form action="{""|fn_url}" method="post" name="payments_form_{$id}" enctype="multipart/form-data" class="cm-form-highlight {if $hide_fields} cm-hide-inputs{/if}">
<input type="hidden" name="payment_id" value="{$id}" />

<div class="tabs cm-j-tabs">
	<ul>
		<li id="tab_details_{$id}" class="cm-js cm-active"><a>{$lang.general}</a></li>
		<li id="tab_conf_{$id}" class="cm-js cm-ajax {if !$payment.processor_id}hidden{/if}"><a {if $payment.processor_id}href="{"payments.processor?payment_id=`$id`"|fn_url}"{/if}>{$lang.configure}</a></li>
	</ul>
</div>

<div class="cm-tabs-content" id="tabs_content_{$id}">
	<div id="content_tab_details_{$id}">
	<fieldset>
		<div class="form-field">
			<label for="elm_payment_name_{$id}" class="cm-required">{$lang.name}:</label>
			<input id="elm_payment_name_{$id}" type="text" name="payment_data[payment]" value="{$payment.payment}" class="input-text-large main-input" />
		</div>



		<div class="form-field">
			<label for="elm_payment_processor_{$id}">{$lang.processor}:</label>
			<select id="elm_payment_processor_{$id}" name="payment_data[processor_id]" onchange="fn_switch_processor({$id}, this.value);">
				<option value="">{$lang.offline}</option>
				<optgroup label="{$lang.checkout}">
					{foreach from=$payment_processors item="processor"}
						{if $processor.type != "P"}
							<option value="{$processor.processor_id}" {if $payment.processor_id == $processor.processor_id}selected="selected"{/if}>{$processor.processor}</option>
						{/if}
					{/foreach}
				</optgroup>
				<optgroup label="{$lang.gateways}">
					{foreach from=$payment_processors item="processor"}
						{if $processor.type == "P"}
							<option value="{$processor.processor_id}" {if $payment.processor_id == $processor.processor_id}selected="selected"{/if}>{$processor.processor}</option>
						{/if}
					{/foreach}
				</optgroup>
			</select>

			<p id="elm_processor_description_{$id}" class="description {if !$payment_processors[$payment.processor_id].description}hidden{/if}">
			{$payment_processors[$payment.processor_id].description|unescape}
			</p>
		</div>

		<div class="form-field">
			<label for="elm_payment_tpl_{$id}">{$lang.template}:</label>
			<select id="elm_payment_tpl_{$id}" name="payment_data[template]" {if $payment.processor_id}disabled="disabled"{/if}>
				{foreach from=$templates item="template"}
					<option value="{$template}" {if $payment.template == $template}selected="selected"{/if}>{$template}</option>
				{/foreach}
			</select>
		</div>

		<div class="form-field">
			<label for="elm_payment_category_{$id}">{$lang.payment_category}:</label>
			<select id="elm_payment_category_{$id}" name="payment_data[payment_category]">
				<option value="tab1" {if $payment.payment_category == "tab1"}selected="selected"{/if}>{$lang.payments_tab1}</option>
				<option value="tab2" {if $payment.payment_category == "tab2"}selected="selected"{/if}>{$lang.payments_tab2}</option>
				<option value="tab3" {if $payment.payment_category == "tab3"}selected="selected"{/if}>{$lang.payments_tab3}</option>
			</select>
			<p class="description">
				{$lang.payment_category_note}
			</p>
		</div>

		<div class="form-field">
			<label>{$lang.usergroups}:</label>
			<div class="select-field">
				{include file="common_templates/select_usergroups.tpl" id="elm_payment_usergroup_`$id`" name="payment_data[usergroup_ids]" usergroups=$usergroups usergroup_ids=$payment.usergroup_ids list_mode=false}
			</div>
		</div>

		<div class="form-field">
			<label for="elm_payment_description_{$id}">{$lang.description}:</label>
			<input id="elm_payment_description_{$id}" type="text" name="payment_data[description]" value="{$payment.description}" class="input-text-large" />
		</div>

		{hook name="payments:update"}
		{/hook}

		<div class="form-field">
			<label for="elm_payment_surcharge_{$id}">{$lang.surcharge}:</label>
			<input id="elm_payment_surcharge_{$id}" type="text" name="payment_data[p_surcharge]" value="{$payment.p_surcharge}" class="input-text-short" size="4" /> % + <input type="text" name="payment_data[a_surcharge]" value="{$payment.a_surcharge}" class="input-text-short" size="4" /> {$currencies.$primary_currency.symbol}
		</div>

		<div class="form-field">
			<label for="elm_payment_surcharge_title_{$id}">{$lang.surcharge_title}:</label>
			<input id="elm_payment_surcharge_title_{$id}" type="text" name="payment_data[surcharge_title]" value="{$payment.surcharge_title}" class="input-text-large" />
		</div>

		<div class="form-field">
		<label>{$lang.taxes}:</label>
			<div class="select-field">
				{foreach from=$taxes item="tax"}
					<input type="checkbox"	name="payment_data[tax_ids][{$tax.tax_id}]" id="elm_payment_taxes_{$tax.tax_id}" {if $tax.tax_id|in_array:$payment.tax_ids}checked="checked"{/if} class="checkbox" value="{$tax.tax_id}" />
					<label for="elm_payment_taxes_{$tax.tax_id}">{$tax.tax}</label>
				{foreachelse}
					&ndash;
				{/foreach}
			</div>
		</div>

		<div class="form-field">
			<label for="elm_payment_instructions_{$id}">{$lang.payment_instructions}:</label>
			<textarea id="elm_payment_instructions_{$id}" name="payment_data[instructions]" cols="55" rows="8" class="cm-wysiwyg input-textarea-long">{$payment.instructions}</textarea>
			
		</div>

		{if $mode == "add"}
			{include file="common_templates/select_status.tpl" input_name="payment_data[status]" id="elm_payment_status_`$id`" obj_id=$id obj=$payment}
		{/if}

		{include file="views/localizations/components/select.tpl" data_name="payment_data[localization]" id="elm_payment_localization_`$id`" data_from=$payment.localization}

		<div class="form-field">
			<label>{$lang.icon}:</label>
			{include file="common_templates/attach_images.tpl" image_name="payment_image" image_key=$id image_object_type="payment" image_pair=$payment.icon no_detailed="Y" hide_titles="Y" image_object_id=$id}
		</div>

		{hook name="payments:properties"}
		{/hook}
	</fieldset>
	<!--content_tab_details_{$id}--></div>
</div>

{if !$hide_for_vendor}
	<div class="buttons-container">
		{include file="buttons/save_cancel.tpl" but_name="dispatch[payments.update]" cancel_action="close"}
	</div>
{/if}

</form>
<!--content_group{$id}--></div>