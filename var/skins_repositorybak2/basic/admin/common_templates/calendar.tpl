{if $settings.Appearance.calendar_date_format == "month_first"}
	{assign var="date_format" value="%m/%d/%Y"}
{else}
	{assign var="date_format" value="%d/%m/%Y"}
{/if}

<input type="text" id="{$date_id}" name="{$date_name}" class="input-text{if $date_meta} {$date_meta}{/if} cm-calendar" value="{if $date_val}{$date_val|fn_parse_date|date_format:"`$date_format`"}{/if}" {$extra} size="10" />&nbsp;<img src="{$images_dir}/icons/calendar.png" class="cm-external-focus calendar-but" rev="{$date_id}" title="{$lang.calendar}" alt="{$lang.calendar}" />

<script type="text/javascript">
//<![CDATA[

var calendar_config = {$ldelim}{$rdelim};
calendar_config = {$ldelim}
			changeMonth: true,
			duration: 'fast',
			changeYear: true,
			numberOfMonths: 1,
			selectOtherMonths: true,
			showOtherMonths: true,
			firstDay: {if $settings.Appearance.calendar_week_format == "sunday_first"}0{else}1{/if},
			dayNamesMin: ['{$lang.weekday_abr_0}', '{$lang.weekday_abr_1}', '{$lang.weekday_abr_2}', '{$lang.weekday_abr_3}', '{$lang.weekday_abr_4}', '{$lang.weekday_abr_5}', '{$lang.weekday_abr_6}'],
			monthNamesShort: ['{$lang.month_name_abr_1}', '{$lang.month_name_abr_2}', '{$lang.month_name_abr_3}', '{$lang.month_name_abr_4}', '{$lang.month_name_abr_5}', '{$lang.month_name_abr_6}', '{$lang.month_name_abr_7}', '{$lang.month_name_abr_8}', '{$lang.month_name_abr_9}', '{$lang.month_name_abr_10}', '{$lang.month_name_abr_11}', '{$lang.month_name_abr_12}'],
			yearRange: '{$start_year|default:$settings.Company.company_start_year}:{math equation="x+y" x=$end_year|default:1 y=$smarty.const.TIME|date_format:"%Y"}',
			dateFormat: '{if $settings.Appearance.calendar_date_format == "month_first"}mm/dd/yy{else}dd/mm/yy{/if}'
		{$rdelim};

if ($.ua.browser == 'Internet Explorer') {$ldelim}
	$(window).load(function(){$ldelim}
		$('#{$date_id}').datepicker(calendar_config);
	{$rdelim});
{$rdelim} else {$ldelim}
	$(function() {$ldelim}
		$('#{$date_id}').datepicker(calendar_config);
	{$rdelim});
{$rdelim}


//]]>
</script>