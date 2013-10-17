{** block-description:billibuys_home_page **}

<p class="txt_1">{$lang.bb_looking_for_an_item}?</p>

<p class="txt_1">{$lang.bb_let_sellers_come_to_you}!</p>

<form action="{"auth.login_form&return_url=billibuys.place_request"|@fn_url}" method="GET">
{if !$auth.user_id}
	<input type="hidden" name="dispatch" value="auth.login_form"/>
	<input type="hidden" name="return_url" value="billibuys.place_request" />
{else}
	<input type="hidden" name="dispatch" value="billibuys.place_request" />
{/if}
	<input type="text" name="request_title" id="i_want" value="{$lang.bb_i_want}..." id="request_title_home" onclick="{literal}$(this).val(''){/literal}"/>
<input type="submit" value="{$lang.submit}" />
</form>
<p class="txt_2">{$lang.or}</p>

<p class="txt_1">{$lang.bb_looking_for_buyer}?</p>

<p class="txt_1">{$lang.bb_select_a_category}:</p>