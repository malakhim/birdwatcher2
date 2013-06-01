{if $available_units}
<div class="posts-container">
	<div class="float-right">
		<a href="{"unit_tests.test"|fn_url}">{$lang.run_all_tests}</a> |
		<a href="{"unit_tests.generate_scheme"|fn_url}">{$lang.generate_test_scheme}</a>
	</div>
{* Core tests *}
	{capture name="mainbox"}
	<div class="items-container" id="addons_list">
		{foreach from=$available_units.core item=unit key=object_name}
			<div class="object-group clear cm-row-item ">
				<div class="object-name">
					<div class="object-group-link-wrap">
						{assign var="name" value=$unit|basename}
						<a class="lowercase" href="{"unit_tests.run?unit=`$name`&type=core"|fn_url}">{$name}</a>
					</div>
				</div>
			</div>
		{foreachelse}
			<p class="no-items">{$lang.no_items}</p>
		{/foreach}
	</div>

	{/capture}
	{include file="common_templates/mainbox.tpl" title=$lang.core content=$smarty.capture.mainbox}

{* Addons tests*}
	{capture name="mainbox"}

	<div class="items-container" id="addons_list">
		{foreach from=$available_units.addons item=addon key=addon_name}
			{include file="common_templates/subheader.tpl" title=$addon_name}
			{foreach from=$addon item=tests key=method_name}
				<div class="object-group clear cm-row-item ">
					<div class="object-name">
						<div class="object-group-link-wrap">
							<a class="lowercase" href="{"unit_tests.run?unit=`$name`&type=addon&addon_name=`$addon_name`"|fn_url}">{$tests}</a>
						</div>
					</div>
				</div>

			{/foreach}
		{foreachelse}
			<p class="no-items">{$lang.no_items}</p>
		{/foreach}
	</div>

	{/capture}
	{include file="common_templates/mainbox.tpl" title=$lang.addons content=$smarty.capture.mainbox}
</div>
{else}
<p class="no-items">{$lang.no_data}</p>
{/if}
