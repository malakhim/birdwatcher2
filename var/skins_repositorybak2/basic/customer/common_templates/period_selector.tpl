<div class="period">
<div class="form-field period-select">
	<label>{$lang.period}</label>
	<select name="period" id="period_selects">
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
		</optgroup>
		<optgroup label="=============">
			<option value="C" {if $period == "C"}selected="selected"{/if}>{$lang.custom}</option>
		</optgroup>
	</select>
</div>


<div class="form-field period-select-date calendar" >
	<label>{$lang.select_dates}</label>
	{include file="common_templates/calendar.tpl" date_id="f_date" date_name="time_from" date_val=$search.time_from start_year=$settings.Company.company_start_year extra="onchange=\"$('#period_selects').val('C');\""}
	<span class="period-dash">&#8211;</span>
	{include file="common_templates/calendar.tpl" date_id="t_date" date_name="time_to" date_val=$search.time_to  start_year=$settings.Company.company_start_year extra="onchange=\"$('#period_selects').val('C');\""}
</div>

{script src="js/period_selector.js"}
<script type="text/javascript">
//<![CDATA[
$(function(){$ldelim}
	$('#{$prefix}period_selects').cePeriodSelector({$ldelim}
		from: '{$prefix}f_date',
		to: '{$prefix}t_date'
	{$rdelim});
{$rdelim});
//]]>
</script>
</div>