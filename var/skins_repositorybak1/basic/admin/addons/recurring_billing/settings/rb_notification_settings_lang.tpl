{if $languages|sizeof > 1}
<div class="select-lang">

	{include file="common_templates/select_object.tpl" style="graphic" link_tpl="`$config.current_url`&selected_section=recurring_billing_rb_notification"|fn_link_attach:"descr_sl=" items=$languages selected_id=$smarty.const.DESCR_SL key_name="name" suffix="notification" display_icons=true}

</div>
{/if}
