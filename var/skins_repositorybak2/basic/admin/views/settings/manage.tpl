{* $Id: manage.tpl 12902 2011-07-11 07:13:14Z subkey $ *}

{script src="js/fileuploader_scripts.js"}

{include file="views/profiles/components/profiles_scripts.tpl" states=$smarty.const.CART_LANGUAGE|fn_get_all_states:false:true}

{if $smarty.request.highlight}
{assign var="highlight" value=","|explode:$smarty.request.highlight}
{/if}

<form action="{""|fn_url}" method="post" name="settings_form" class="cm-form-highlight">
<input name="section_id" type="hidden" value="{$section_id}" />
<input type="hidden" id="selected_section" name="selected_section" value="{$selected_section}" />

{capture name="mainbox"}

{capture name="tabsbox"}

{foreach from=$options item=subsection key="ukey"}
	<div id="content_{$ukey}" {if $subsections.$section.type == "SEPARATE_TAB"}class="cm-hide-save-button"{/if} class="settings">
		<fieldset>
			{foreach from=$subsection item=item name="section"}
				{include file="common_templates/settings_fields.tpl" item=$item section=$section_id html_id="field_`$section`_`$item.name`_`$item.object_id`" html_name="update[`$item.object_id`]"}
			{/foreach}
		</fieldset>
	</div>
{/foreach}

<div class="buttons-container buttons-bg">
	{include file="buttons/save.tpl" but_name="dispatch[settings.update]" but_role="button_main"}
</div>

{/capture}
{include file="common_templates/tabsbox.tpl" content=$smarty.capture.tabsbox track=true}

{/capture}

{include file="common_templates/mainbox.tpl" title="`$lang.settings`: `$settings_title`" content=$smarty.capture.mainbox}

</form>

