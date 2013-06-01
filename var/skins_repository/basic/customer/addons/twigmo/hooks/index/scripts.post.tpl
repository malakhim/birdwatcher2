{assign var="but_role" value="general"}

{capture name="mobile_store_link"}
	{if $config.current_url|strpos:"?"}
		{assign var="but_href" value="`$config.current_url`&auto"|fn_query_remove:"desktop"|fn_url}
	{else}
		{assign var="but_href" value="`$config.current_url`?auto"|fn_query_remove:"desktop"|fn_url}
	{/if}
	<a href="{$but_href}">{$lang.twg_visit_our_mobile_store}</a>
{/capture}

{capture name="android"}
	{assign var="but_href" value=$tw_settings.url_on_googleplay|default:"https://play.google.com/store"}
	<a href="{$but_href}">{$lang.twg_app_for_android}</a>
{/capture}

{capture name="ios"}
	{assign var="but_href" value=$tw_settings.url_on_appstore|default:"https://itunes.apple.com/en/genre/ios/id36?mt=8"}
	{if $smarty.session.device == "iphone"}
		{assign var="but_text" value=$lang.twg_app_for_iphone}
	{elseif $smarty.session.device == "ipad"}
	    {assign var="but_text" value=$lang.twg_app_for_ipad}
	{/if}
	<a href="{$but_href}">{$but_text}</a>
{/capture}

{capture name="notice_block"}
<div class="mobile-avail-notice{if $smarty.session.twigmo_mobile_avail_notice_off} hidden{/if}">
	<div class="buttons-container">
		{$smarty.capture.mobile_store_link}
		{if $smarty.session.device == "android" and $tw_settings.url_on_googleplay}
			{$smarty.capture.android}
		{elseif ($smarty.session.device == "iphone" or $smarty.session.device == "ipad") and $tw_settings.url_on_appstore}
			{$smarty.capture.ios}
		{/if}
		<img id="close_notification_mobile_avail_notice" class="cm-notification-close hand" src="{$config.skin_path}/addons/twigmo/images/icons/icon_close.png" border="0" alt="Close" title="Close" />
	</div>
</div>
{/capture}

{if ($smarty.session.twg_user_agent and $smarty.session.twg_user_agent == 'tablet' and $tw_settings.use_mobile_frontend == 'tablet')
		or ($smarty.session.twg_user_agent and $smarty.session.twg_user_agent == 'phone' and $tw_settings.use_mobile_frontend == 'phone')
		or ($smarty.session.twg_user_agent and ($smarty.session.twg_user_agent == 'tablet' or $smarty.session.twg_user_agent == 'phone') and $tw_settings.use_mobile_frontend == 'both_tablet_and_phone')}
	{assign var="show_avail_notice" value="Y"}
{else}
	{assign var="show_avail_notice" value="N"}
{/if}

{if $tw_settings.use_mobile_frontend != 'never' and $show_avail_notice == "Y"}
	{if $smarty.session.device == "iphone" or $smarty.session.device == "ipad" or $smarty.session.device == "android" or $smarty.session.device == "winphone"}
		{$smarty.capture.notice_block}
	{/if}

	<script>
	//<![CDATA[
	{literal}
	$(function () {
		$('.mobile-avail-notice').insertBefore('a[name="top"]');
		$('#close_notification_mobile_avail_notice').live('click', function () {
			$(this).parents('div.mobile-avail-notice').hide();
			$.ajax({
				url: '{/literal}{"twigmo.post&close_notice=1"|fn_url:"C":"rel":"&"}{literal}',
				dataType: 'json'
			});
		});
		if(window.devicePixelRatio){
			if(window.devicePixelRatio > 1){
				changeSizes();
			}
		}
		function changeSizes(){
			var scale = 1,
					buttonsHeight = {/literal}{if $smarty.session.device == "ipad"}54{else}80{/if}{literal},
					noticeHeight = {/literal}{if $smarty.session.device == "ipad"}80{else}120{/if}{literal},
					fontSize = {/literal}{if $smarty.session.device == "ipad"}30{else}34{/if}{literal},
					fontTop = {/literal}{if $smarty.session.device == "ipad"}15{else}18{/if}{literal},
					buttonsTop = (noticeHeight - buttonsHeight) / 2 || 13,
					crossTopMargin = (noticeHeight - $('#close_notification_mobile_avail_notice').height()) / 2 - buttonsTop - 2,
					crossWidth = 30,
					textPadding = {/literal}{if $smarty.session.device == "ipad"}'0 1% 0 1%'{else}'0 2% 0 2%'{/if}{literal};

			if (typeof orientation !== 'undefined' && Math.abs(orientation) === 90) {
					scale = 0.7;
					textPadding = '0 1% 0 1%';
			}
			$('.mobile-avail-notice a').css({'height': buttonsHeight * scale + 'px', 'line-height': buttonsHeight * scale + 'px', 'font-size': fontSize * scale + 'px', 'padding': textPadding});
			$('.mobile-avail-notice img').css({'width': crossWidth * scale + 'px !important', 'height': crossWidth * scale + 'px !important', 'margin-top': -1 * (crossWidth * scale/2) + 'px'});

		}
		window.onorientationchange = function () {
				changeSizes();
		};
		changeSizes();
	});
	{/literal}
	//]]>
	</script>
{/if}