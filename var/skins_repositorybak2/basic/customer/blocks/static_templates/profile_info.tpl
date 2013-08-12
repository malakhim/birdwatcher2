{if $controller == 'profiles' && $mode == 'add'}
	<div class="account-benefits">
		{$lang.text_profile_benefits}
	</div>

{elseif $controller == 'profiles' && $mode == 'update'}
	<div class="account-detail ">
		{$lang.text_profile_details}
	</div>
{/if}