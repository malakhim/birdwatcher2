{capture name="mainbox"}



<div class="section-border design-mode">
	<div class="clear">
		<form action="{""|fn_url}" method="post" name="translation_mode_form">
		<input type="hidden" name="design_mode" value="translation_mode" />
		<input type="hidden" name="redirect_url" value="site_layout.translation_mode" />
		{if "TRANSLATION_MODE"|defined}
			{assign var="mode_val" value=$lang.disable_translation_mode}
			{assign var="dispatch_val" value="dispatch[site_layout.update_design_mode]"}

				<a href="{"profiles.act_as_user?user_id=`$auth.user_id`&amp;area=C`$extra_url`"|fn_url}" target="_blank">{$lang.view_storefront_translation_mode}</a>

			<input type="hidden" name="translation_mode" value="Y" />
		{else}
			{assign var="mode_val" value=$lang.enable_translation_mode}
			{assign var="dispatch_val" value="dispatch[site_layout.update_design_mode.translation_mode]"}
			<input type="hidden" name="disable_mode" value="{if "CUSTOMIZATION_MODE"|defined}customization_mode{/if}" />
		{/if}
		<p>{include file="buttons/button.tpl" but_name=$dispatch_val but_role="button_main" but_text=$mode_val}</p>
		</form>
	</div>
</div>
{/capture}
{include file="common_templates/mainbox.tpl" title=$lang.translation_mode content=$smarty.capture.mainbox}