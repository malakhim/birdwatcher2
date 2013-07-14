{*<a href="{$index_script|fn_url}" class="top-quick-links">{$lang.home}</a>&nbsp;&nbsp;|&nbsp;
<a href="{"orders.search"|fn_url}" class="top-quick-links">{$lang.orders}</a>&nbsp;&nbsp;|&nbsp;
<a href="{"categories.manage"|fn_url}" class="top-quick-links">{$lang.categories}</a>&nbsp;&nbsp;|&nbsp;
<a href="{"products.manage"|fn_url}" class="top-quick-links">{$lang.products}</a>&nbsp;&nbsp;|&nbsp;
<a href="{"settings.manage"|fn_url}" class="top-quick-links">{$lang.settings}</a>&nbsp;&nbsp;|&nbsp;*}
<a href="{"profiles.update?user_id=`$auth.user_id`"|fn_url}"><span>{if $settings.General.use_email_as_login == "Y"}{$user_info.email}{else}{$user_info.user_login}{/if}</span></a><span class="top-signout" title="{$lang.sign_out}">
{include file="buttons/sign_out.tpl" but_href="auth.logout" but_role="text"}</span>