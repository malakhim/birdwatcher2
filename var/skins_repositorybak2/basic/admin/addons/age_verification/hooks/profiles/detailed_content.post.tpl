{if $user_type == "C"}
<fieldset>
	{include file="common_templates/subheader.tpl" title=$lang.age_verification}
	<div class="form-field">
		<label for="birthday">{$lang.birthday}</label>
		{include file="common_templates/calendar.tpl" date_id="birthday" date_name="user_data[birthday]" date_val=$user_data.birthday start_year="1902" end_year="0"}
	</div>
</fieldset>
{/if}