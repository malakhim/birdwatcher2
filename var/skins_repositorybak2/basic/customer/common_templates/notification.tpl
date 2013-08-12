{* $Id: notification.tpl 11477 2010-12-24 12:17:02Z subkey $ *}

{if !"AJAX_REQUEST"|defined}
{foreach from=""|fn_get_notifications item="message" key="key"}
{if $message.type != "P" && $message.type != "L" && $message.type != "C"}
	{if $message.type == "O"}
		{capture name="checkout_error_content"}
		{$smarty.capture.checkout_error_content}
		<div class="notification-content" id="notification_{$key}">
			<div class="notification-e">
				<img id="close_notification_{$key}" class="cm-notification-close hand" src="{$images_dir}/icons/icon_close.gif" width="13" height="13" border="0" alt="{$lang.close}" title="{$lang.close}" />
				<div>{$message.message}</div>
			</div>
		</div>
		{/capture}
	{else}
		{capture name="notification_content"}
		{$smarty.capture.notification_content}
		<div class="notification-content{if $message.message_state == "I"} cm-auto-hide{/if}{if $message.message_state == "S"} cm-ajax-close-notification{/if}" id="notification_{$key}">
			<div class="notification-{$message.type|lower}">
				<img id="close_notification_{$key}" class="cm-notification-close hand" src="{$images_dir}/icons/icon_close.gif" width="13" height="13" border="0" alt="{$lang.close}" title="{$lang.close}" />
				<div class="notification-header-{$message.type|lower}">{$message.title}</div>
				<div>
					{$message.message}
				</div>
			</div>
		</div>
		{/capture}
	{/if}
{else}
	<div class="product-notification-container{if $message.message_state == "I"} cm-auto-hide{/if}{if $message.message_state == "S"} cm-ajax-close-notification{/if}" id="notification_{$key}">
		<div class="product-notification">
			<div class="icon-closer cm-notification-close" title="{$lang.close}"></div>
			<h1>{$message.title}</h1>
			{$message.message}
		</div>
	</div>
{/if}
{/foreach}

{$smarty.capture.notification_content}
<div class="cm-notification-container"></div>
{/if}