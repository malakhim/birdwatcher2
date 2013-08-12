<div class="nowrap">

{if $display == "form"}
<table cellpadding="0" cellspacing="0" border="0" class="search-header">
<tr>
	<td class="search-field">
	<label>{$lang.period}:</label>
	<div class="break">
{/if}
	<select name="{$prefix}period" id="{$prefix}period_selects">
		<option value="A" {if $period == "A" || !$period}selected="selected"{/if}>{$lang.all}</option>
		<optgroup label="=============">
			<option value="D" {if $period == "D"}selected="selected"{/if}>{$lang.this_day}</option>
			<option value="W" {if $period == "W"}selected="selected"{/if}>{$lang.this_week}</option>
			<option value="M" {if $period == "M"}selected="selected"{/if}>{$lang.this_month}</option>
			<option value="Y" {if $period == "Y"}selected="selected"{/if}>{$lang.this_year}</option>
		</optgroup>
		<optgroup label="=============">
			<option value="LD" {if $period == "LD"}selected="selected"{/if}>{$lang.yesterday}</option>
			<option value="LW" {if $period == "LW"}selected="selected"{/if}>{$lang.previous_week}</option>
			<option value="LM" {if $period == "LM"}selected="selected"{/if}>{$lang.previous_month}</option>
			<option value="LY" {if $period == "LY"}selected="selected"{/if}>{$lang.previous_year}</option>
		</optgroup>
		<optgroup label="=============">
			<option value="HH" {if $period == "HH"}selected="selected"{/if}>{$lang.last_24hours}</option>
			<option value="HW" {if $period == "HW"}selected="selected"{/if}>{$lang.last_n_days|replace:"[N]":7}</option>
			<option value="HM" {if $period == "HM"}selected="selected"{/if}>{$lang.last_n_days|replace:"[N]":30}</option>
			{*<option value="HC" {if $period == "HC"}selected="selected"{/if}>{$lang.last_n_days|replace:"[N]":$var}</option>  implemented programatically only *}
		</optgroup>
		<optgroup label="=============">
			<option value="C" {if $period == "C"}selected="selected"{/if}>{$lang.custom}</option>
		</optgroup>
	</select>

{if $display == "form"}
	</div>
	</td>
	<td class="search-field">
{/if}

	{if $display != "form"}&nbsp;&nbsp;{/if}
	<label{if $display != "form"} class="label-html"{/if}>{$lang.select_dates}:</label>

{if $display == "form"}
	<div class="break nowrap">
{/if}

	{assign var="time_from" value="`$prefix`time_from"}
	{assign var="time_to" value="`$prefix`time_to"}
	
	{include file="common_templates/calendar.tpl" date_id="`$prefix`f_date" date_name="`$prefix`time_from" date_val=$search.$time_from  start_year=$settings.Company.company_start_year extra="onchange=\"$('#`$prefix`period_selects').val('C');\""}
	&nbsp;&nbsp;-&nbsp;&nbsp;
	{include file="common_templates/calendar.tpl" date_id="`$prefix`t_date" date_name="`$prefix`time_to" date_val=$search.$time_to  start_year=$settings.Company.company_start_year extra="onchange=\"$('#`$prefix`period_selects').val('C');\""}

{if $display == "form"}
	</div>
	</td>
	<td class="buttons-container">
		{include file="buttons/button.tpl" but_text=$lang.search but_name=$but_name but_role="submit"}
	</td>
</tr>
</table>
{/if}

</div>

{script src="js/period_selector.js"}
<script type="text/javascript">
//<![CDATA[
$(function() {$ldelim}
	$('#{$prefix}period_selects').cePeriodSelector({$ldelim}
		from: '{$prefix}f_date',
		to: '{$prefix}t_date'
	{$rdelim});
{$rdelim});
//]]>
</script>