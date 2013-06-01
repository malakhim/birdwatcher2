{assign var="area" value=$smarty.const.AREA}
{assign var="area_name" value=$smarty.const.AREA_NAME}
{assign var="l" value="text_`$area_name`_skin"}
{assign var="c_url" value=$config.current_url|fn_query_remove:"demo_skin"|fn_url}
{if $c_url|strpos:"?" === false}
	{assign var="c_url" value="`$c_url`?"}
{/if}

<ul class="demo-site-panel clearfix">
	<li class="dp-title">DEMO SITE PANEL</li>
	<li class="dp-label">{$lang.$l}:</li>
	<li>
		<select name="demo_skin[{$area}]" onchange="$.redirect('{$c_url|fn_link_attach:"demo_skin[`$area`]="}' + this.value);">
		{foreach from=$demo_skin.available_skins item=s key=k}
			<option value="{$k}" {if $demo_skin.selected.$area == $k}selected="selected"{/if}>{$s.description}</option>
		{/foreach}
		</select>
	</li>
	<li class="dp-area">
		
		<select name="area" onchange="$.redirect(this.value);">
			<option value="{$config.admin_index}" {if $area == "A"}selected="selected"{/if}>Administration panel</option>
			<option value="{$config.customer_index}" {if $area == "C"}selected="selected"{/if}>Storefront</option>
		</select>
		
		

	</li>
	<li class="dp-area dp-label">Area:</li>
</ul>