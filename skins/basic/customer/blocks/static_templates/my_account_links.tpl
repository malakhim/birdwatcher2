<p>
	<span>{$lang.my_account}</span>
</p>
<ul>
{if $auth.user_id}
	<li><a href="{"orders.search"|fn_url}">{$lang.orders}</a></li>
	<li><a href="{"profiles.update"|fn_url}">{$lang.profile_details}</a></li>
{else}
	<li><a href="{"auth.login_form"|fn_url}">{$lang.sign_in}</a></li>
	<li><a href="{"profiles.add"|fn_url}">{$lang.create_account}</a></li>
{/if}
</ul>