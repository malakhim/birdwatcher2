<a href="{"unit_tests.manage"|fn_url}" class="lowercase">« {$lang.back}</a>
<div class="posts-container">
{capture name="mainbox"}
	{foreach from=$classes item=class}
		{strip}
			{if $class != $action}<a href="{"unit_tests.generate_scheme.`$class`"|fn_url}" >{/if}
				{$class}
			{if $class != $action}</a>{/if}
		{/strip}&nbsp;
	{/foreach}
	<pre>
	{$test_content}
	</pre>
{/capture}
{include file="common_templates/mainbox.tpl" title="`$lang.scheme_generator`: `$smarty.request.unit`" content=$smarty.capture.mainbox}
</div>
