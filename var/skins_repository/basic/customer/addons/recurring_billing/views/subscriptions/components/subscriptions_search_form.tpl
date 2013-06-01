{* $Id:	search_form.tpl	0 2006-07-28 19:49:30Z	seva $	*}

{capture name="section"}

<form action="{""|fn_url}" name="subscriptions_search_form" method="get">

<div class="form-field">
	<label>{$lang.price} ({$currencies.$primary_currency.symbol}):</label>
	<input type="text" name="price_from" value="{$search.price_from}" size="6" class="input-text-short" />&nbsp;-&nbsp;<input type="text" name="price_to" value="{$search.price_to}" size="6" class="input-text-short" />
</div>

<div class="form-field">
	<div class="period-type float-left">
	<label for="type_period">{$lang.rb_period_type}:</label>
	<select name="period_type" id="type_period">
		<option value="">--</option>
		<option value="D"{if $search.period_type == "D"} selected="selected"{/if}>{$lang.date}</option>
		<option value="L"{if $search.period_type == "L"} selected="selected"{/if}>{$lang.last_order}</option>
		<option value="E"{if $search.period_type == "E"} selected="selected"{/if}>{$lang.end_date}</option>
	</select>
	</div>
	{include file="common_templates/period_selector.tpl" period=$search.period form_name="subscriptions_search_form" tim_from=$search.time_from time_to=$search.time_to}
</div>


	
<div class="buttons-container">{include file="buttons/button.tpl" but_text=$lang.search but_name="dispatch[subscriptions.search]"}</div>
</form>

{/capture}
{include file="common_templates/section.tpl" section_title=$lang.search section_content=$smarty.capture.section}
