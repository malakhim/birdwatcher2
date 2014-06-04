{** block-description:frontpage_top_links **}

<link href="{$config.skin_path}/css/960/960_old.css" rel="stylesheet" type="text/css" />

{literal}
<script src="addons/billibuys/js/home.js" type="text/javascript"></script>
{/literal}

<div id="background_img"><img src="images/billibuys_header.jpg"></div>

<a href="{'pages.view&page_id=2'|fn_url}"><span class="alpha grid_2 text_link">
	{$lang.about}
</span></a>

<!-- <div class="grid_3 text_link">
	{$lang.testimonials}
</div> -->

<a href="{'pages.view&page_id=30'|fn_url}"><span class="grid_3 flat_link red contact-link">
	{$lang.contact_us}
</span></a>

<a href="{'auth.login_form'|fn_url}"><span class="omega grid_4 flat_link grey login-link">
	{$lang.log_in}/{$lang.register}
</span></a>