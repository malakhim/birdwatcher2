{if $oi.extra.recurring_plan_id}
	<p>{$lang.rb_recurring_plan}: {$oi.extra.recurring_plan.name}</p>
	<p>{$lang.rb_recurring_period}: <span class="lowercase">{$oi.extra.recurring_plan.period|fn_get_recurring_period_name|escape}</span>{if $oi.extra.recurring_plan.period == "P"} - {$oi.extra.recurring_plan.by_period} {$lang.days}{/if}</p>
	<p>{$lang.rb_duration}: {$oi.extra.recurring_duration}</p>
	{if $oi.extra.recurring_plan.start_duration}
	<p>{$lang.rb_start_duration}: {$oi.extra.recurring_plan.start_duration} {if $oi.extra.recurring_plan.start_duration_type == "D"}{$lang.days}{else}{$lang.months}{/if}</p>
	{/if}
{/if}