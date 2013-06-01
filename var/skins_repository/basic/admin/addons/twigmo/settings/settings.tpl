<div id="storefront_settings">

{include file="addons/twigmo/settings/contact_twigmo_support.tpl"}

{include file="common_templates/subheader.tpl" title=$lang.twgadmin_manage_storefront_settings}

{if !$addons.twigmo.access_id}
	{if $smarty.const.PRODUCT_TYPE != 'ULTIMATE' || !"COMPANY_ID"|defined}
		{$lang.twgadmin_connect_to_first}
	{else}
		{$lang.twgadmin_connect_to_first_ult}
	{/if}
{elseif $smarty.const.PRODUCT_TYPE == 'ULTIMATE' && !"COMPANY_ID"|defined}
	{$lang.text_select_vendor} - {include file="common_templates/ajax_select_object.tpl" data_url="companies.get_companies_list?show_all=Y&action=href" text=$lang.select id="top_company_id"}
{else}

<fieldset>
	{* Use mobile frontend for ... *}
	<div class="form-field">
		<label for="elm_tw_use_mobile_frontend">{$lang.twgadmin_use_mobile_frontend}:</label>
		<select id="elm_tw_use_mobile_frontend" name="tw_settings[use_mobile_frontend]">
			<option	value="never" {if $addons.twigmo.use_mobile_frontend == "never"}selected="selected"{/if}>{$lang.twgadmin_never}</option>
			<option	value="phone" {if $addons.twigmo.use_mobile_frontend == "phone"}selected="selected"{/if}>{$lang.twgadmin_phone}</option>
			<option	value="tablet" {if $addons.twigmo.use_mobile_frontend == "tablet"}selected="selected"{/if}>{$lang.twgadmin_tablet}</option>
			<option	value="both_tablet_and_phone" {if $addons.twigmo.use_mobile_frontend == "both_tablet_and_phone"  || !$addons.twigmo.use_mobile_frontend}selected="selected"{/if}>{$lang.twgadmin_both_tablet_and_phone}</option>
		</select>
	</div>
		
	{* Home page content *}
	<div class="form-field">
		<label for="elm_tw_home_page_content">{$lang.twgadmin_home_page_content}:</label>
		<select id="elm_tw_home_page_content" name="tw_settings[home_page_content]">
			<option	value="home_page_blocks" {if $addons.twigmo.home_page_content == "home_page_blocks"}selected="selected"{/if}>- {$lang.twgadmin_home_page_blocks} -</option>
			<option	value="tw_home_page_blocks" {if $addons.twigmo.home_page_content == "tw_home_page_blocks"}selected="selected"{/if}>- {$lang.twgadmin_tw_home_page_blocks} -</option>
			{foreach from=0|fn_get_plain_categories_tree:false item="cat"}
				{if $cat.status == "A"}
					<option	value="{$cat.category_id}" {if $addons.twigmo.home_page_content == $cat.category_id}selected="selected"{/if}>{$cat.category|escape|indent:$cat.level:"&#166;&nbsp;&nbsp;&nbsp;&nbsp;":"&#166;--&nbsp;"}</option>
				{/if}
			{/foreach}
		</select>
		{include file="buttons/button.tpl" but_text=$lang.twgadmin_edit_these_blocks but_href="block_manager.manage&selected_location=`$locations_info.index`" but_id="elm_edit_home_page_blocks" but_role="link" but_meta="hidden"  but_target="_blank"}
		{include file="buttons/button.tpl" but_text=$lang.twgadmin_edit_these_blocks but_href="block_manager.manage&selected_location=`$locations_info.twigmo`" but_id="elm_edit_tw_home_page_blocks" but_role="link" but_meta="hidden"  but_target="_blank"}
	</div>

	{* Geolocation *}
	<div class="form-field">
		<label for="elm_tw_geolocation">{$lang.twgadmin_enable_geolocation}:</label>
		<input type="hidden" name="tw_settings[geolocation]" value="N" />
		<input type="checkbox" class="checkbox" id="elm_tw_geolocation" name="tw_settings[geolocation]" value="Y" {if $addons.twigmo.geolocation != "N"}checked="checked"{/if} />
	</div>

	{* Logo *}
	<div class="form-field">
		<label>{$lang.twgadmin_mobile_logo}:</label>
		<div class="float-left">
			{include file="common_templates/fileuploader.tpl" var_name="tw_settings[logo]" image=true}
		</div>
		<div class="float-left attach-images-alt logo-image">
			<img class="solid-border" src="{$addons.twigmo.logoURL|default:$default_logo}" />
		</div>
	</div>

	{* Favicon *}
	<div class="form-field">
		<label>{$lang.twgadmin_mobile_favicon}:</label>
		<div class="float-left">
			{include file="common_templates/fileuploader.tpl" var_name="tw_settings[favicon]" image=true}
		</div>
		<div class="float-left attach-images-alt logo-image">
			<img class="solid-border" src="{$favicon}" />
		</div>
	</div>

	{* Select skin *}
	<div class="form-field">
		<label for="elm_tw_select_skin">{$lang.twgadmin_select_skin}:</label>
		<select id="elm_tw_select_skin" name="tw_settings[selected_skin]">
			<option	value="default" {if $addons.twigmo.selected_skin == "default"}selected="selected"{/if}>- {$lang.default} -</option>
		</select>
        <div id="skinPrevSwitcher" style="background: url('skins/basic/admin/addons/twigmo/images/icons/plus.gif') no-repeat;">&nbsp;</div>
		<div id="skinPrevWrapper" style="margin: 15px 0 0 0" class=""></div>
	</div>
	{assign var="prevImgHeight" value="200px"}
	<div id="skinsPrevContainer" class="hidden">
		<img height="{$prevImgHeight}" id="skinPrev_default" src="skins/basic/admin/addons/twigmo/images/skins/default.jpg">
	</div>
	
	{* Show only required profile fields *}
	<div class="form-field">
		<label for="elm_tw_only_req_profile_fields">{$lang.twgadmin_only_req_profile_fields}:</label>
		<input type="hidden" name="tw_settings[only_req_profile_fields]" value="N" />
		<input type="checkbox" class="checkbox" id="elm_tw_only_req_profile_fields" name="tw_settings[only_req_profile_fields]" value="Y" {if $addons.twigmo.only_req_profile_fields == "Y"}checked="checked"{/if} />
	</div>

	{* Url for facebook *}
	<div class="form-field">
		<label for="elm_tw_url_for_facebook">{$lang.twgadmin_url_for_facebook}:</label>
		<input id="elm_tw_url_for_facebook" type="text" name="tw_settings[url_for_facebook]" size="30" value="{$addons.twigmo.url_for_facebook}" class="input-text" />
	</div>
	
	{* Url for twitter *}
	<div class="form-field">
		<label for="elm_tw_url_for_twitter">{$lang.twgadmin_url_for_twitter}:</label>
		<input id="elm_tw_url_for_twitter" type="text" name="tw_settings[url_for_twitter]" size="30" value="{$addons.twigmo.url_for_twitter}" class="input-text" />
	</div>
	
	{* Url on appstore *}
	<div class="form-field">
		<label for="elm_tw_url_for_appstore">{$lang.twgadmin_url_on_appstore}:</label>
		<input id="elm_tw_url_on_appstore" type="text" name="tw_settings[url_on_appstore]" size="30" value="{$addons.twigmo.url_on_appstore}" class="input-text" />
	</div>
       
	{* Url on googleplay *}
	<div class="form-field">
		<label for="elm_tw_url_on_googleplay">{$lang.twgadmin_url_on_googleplay}:</label>
		<input id="elm_tw_url_on_googleplay" type="text" name="tw_settings[url_on_googleplay]" size="30" value="{$addons.twigmo.url_on_googleplay}" class="input-text" />
	</div>
	
	<script type="text/javascript">
	//<![CDATA[
	{literal}
	$(function(){
		var imgHeight = '{/literal}{$prevImgHeight}{literal}';
		
		$('.form-field a.text-button-link').css({'margin': '0 0 0 10px'});
        $('#skinPrevSwitcher').hide(); // (temporary) disabled
            
        $("#elm_tw_home_page_content").bind('change', function(){fn_tw_show_block_link();}).change();

		$('#elm_tw_select_skin').bind('change', function(){fn_tw_show_skin_preview();}).change();
            
        $('#skinPrevSwitcher').toggle(
            function(e){
                e.preventDefault();
                $(this).css('background-image', 'url("skins/basic/admin/addons/twigmo/images/icons/minus.gif")');
                $('#skinPrevWrapper').toggle();
            }, 
            function(e){
                e.preventDefault();
                $(this).css('background-image', 'url("skins/basic/admin/addons/twigmo/images/icons/plus.gif")');
                $('#skinPrevWrapper').toggle();
            });
             
        jQuery.getScript("{/literal}{$smarty.const.TWIGMO_SKINS_CONFIG_URL}{$smarty.const.TWIGMO_VERSION}/skins.js{literal}", function() {
            var selectedSkin = '{/literal}{$addons.twigmo.selected_skin}{literal}',
				i;
            $('#elm_tw_select_skin, #skinsPrevContainer').empty();
            if ('TWGGlobal' in window){
                for (i in TWGGlobal.skins){
                    $('#elm_tw_select_skin').append('<option value="' + i + '">- ' + TWGGlobal.skins[i].name + ' -</option>');
                    $('#skinsPrevContainer').append('<img height="' + imgHeight + '" id="skinPrev_' + i + '" src="{/literal}{$smarty.const.TWIGMO_SKINS_CONFIG_URL}{$smarty.const.TWIGMO_VERSION}{literal}/' + i + '.jpg">');
                }
            } else {
                $('#elm_tw_select_skin').append('<option value="default">- Default -</option>');
                $('#skinsPrevContainer').append('<img height="' + imgHeight + '" id="skinPrev_default" src="skins/basic/admin/addons/twigmo/images/skins/default.jpg">');
            }
            $('#elm_tw_select_skin').val(selectedSkin).change();
        });
            
		function fn_tw_show_block_link(){
			var value = $('#elm_tw_home_page_content option:selected').val();
			if ((value == 'home_page_blocks') || (value == 'tw_home_page_blocks')) {			
				if (value == 'home_page_blocks') {
					$('#elm_edit_home_page_blocks').show();
					$('#elm_edit_tw_home_page_blocks').hide();
				} else {
					$('#elm_edit_tw_home_page_blocks').show();
					$('#elm_edit_home_page_blocks').hide();
				}
			} else {
				$('#elm_edit_home_page_blocks').hide();
				$('#elm_edit_tw_home_page_blocks').hide();
			}
			
			return true;
		}

		function fn_tw_show_skin_preview() {
			var value = $('#elm_tw_select_skin option:selected').val();
			$('#skinsPrevContainer').append($('#skinPrevWrapper').html());
			$('#skinPrevWrapper').empty().append($('#skinPrev_' + value));
			return false;
		}
	});
	{/literal}
	//]]>
	</script>

</fieldset>

{/if}

<!--storefront_settings--></div>
