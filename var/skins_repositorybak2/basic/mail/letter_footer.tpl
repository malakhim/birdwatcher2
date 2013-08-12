<p>
{if $user_type|fn_check_user_type_admin_area || $user_data|fn_check_user_type_admin_area}
	{$lang.admin_text_letter_footer|replace:'[company_name]':$settings.Company.company_name}
{elseif $user_type == 'P' || $user_data.user_type == 'P'}
	{$lang.affiliate_text_letter_footer}
{else}
	{$lang.customer_text_letter_footer}
{/if}
</p>
</body>
</html>