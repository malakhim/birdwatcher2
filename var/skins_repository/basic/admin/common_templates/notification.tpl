{if !"AJAX_REQUEST"|defined}

{capture name="notification_content"}
{foreach from=""|fn_get_notifications item="message" key="key"}
<div class="notification-content{if $message.message_state == "I"} cm-auto-hide{/if}{if $message.message_state == "S"} cm-ajax-close-notification{/if}" id="notification_{$key}">
	<div class="notification-{$message.type|lower}">
		<img id="close_notification_{$key}" class="cm-notification-close hand" src="{$images_dir}/icons/icon_close.gif" width="13" height="13" border="0" alt="{$lang.close}" title="{$lang.close}" />
		<div class="notification-header-{$message.type|lower}">{$message.title}</div>
		<div>
			{$message.message}
		</div>
	</div>
	
</div>
{/foreach}
{/capture}

{if $auth.user_id && $view_mode != 'simple'}
	{$smarty.capture.notification_content}
{/if}

<div class="cm-notification-container {if !($auth.user_id && $view_mode != 'simple')}cm-notification-container-top{/if}">
	{if !($auth.user_id && $view_mode != 'simple')}
		{$smarty.capture.notification_content}
	{/if}
</div>

{/if}