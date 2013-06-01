<form action="{""|fn_url}" method="post" name="shipments_form">
<input type="hidden" name="redirect_url" value="{$c_url}" />

<div class="form-field">
	<input type="hidden" name="payment[vendor]" id="p_vendor" value="0" />
	{include file="common_templates/ajax_select_object.tpl" label=$lang.vendor data_url="companies.get_companies_list" text=$s_companies.0.company result_elm="p_vendor" id="reg_new_payout"}
</div>

{if $settings.Appearance.calendar_date_format == "month_first"}
	{assign var="date_format" value="%m/%d/%Y"}
{else}
	{assign var="date_format" value="%d/%m/%Y"}
{/if}

<div class="form-field">
	<label>{$lang.sales_period}:</label>
	{include file="common_templates/calendar.tpl" date_name="payment[start_date]" date_val=$total.new_period_date date_id="start_date"}
	{include file="common_templates/calendar.tpl" date_name="payment[end_date]" date_val=$smarty.const.TIME date_id="end_date"}
</div>

<div class="form-field">
	<label class="cm-required" for="payment_amount">{$lang.payment_amount}:</label>
	<input type="text" name="payment[amount]" class="input-text" id="payment_amount" />
</div>

<div class="form-field">
	<label for="payment_method">{$lang.payment_method}:</label>
	<input type="text" name="payment[payment_method]" class="input-text" id="payment_method" />
</div>

<div class="form-field">
	<label for="payment_comments">{$lang.comments}:</label>
	<textarea class="input-textarea-long" rows="8" cols="55" name="payment[comments]" id="payment_comments"></textarea>
</div>


<div class="cm-toggle-button">
	<div class="select-field notify-customer">
		<input type="checkbox" name="payment[notify_user]" id="notify_user" value="Y" class="checkbox" />
		<label for="notify_user">{$lang.notify_vendor}</label>
	</div>
</div>

{include file="views/companies/components/balance_info.tpl"}


<div class="buttons-container">
	{include file="buttons/save_cancel.tpl" create=true but_name="dispatch[companies.payouts_add]" cancel_action="close"}
</div>

</form>