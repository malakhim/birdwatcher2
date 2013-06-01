{if $test_log}
<a href="{"unit_tests.manage"|fn_url}" class="lowercase">« {$lang.back}</a>
<div class="posts-container">
	<table class="table"width="100%" border="0px">
			<tr class="table-row">				
				<th>{$lang.function}</th>												
				<th width="25px">{$lang.in}</th>
				<th width="25px">{$lang.out}</th>
				<th width="25px">{$lang.user}</th>				
				<th>{$lang.unit}</th>
				<th>{$lang.addon}</th>
			</tr>
	{foreach from=$test_log item=tests key=status}	
		{foreach from=$tests item=test key=object_name}			
			<tr class="table-row">				
				<td style='background: {include file="views/unit_tests/components/status.tpl" status=$test.status.general false="#ffeeee" true="#eeffee"};'>
					<a class="lowercase" href="{"unit_tests.run?unit=`$test.unit`&addon=`$test.addon`"|fn_url}"><monospace>{if $test.class != 'functions'}{$test.class}::{/if}{$test.function}</monospace></a>
				</td>
				<td style='background: {include file="views/unit_tests/components/status.tpl" status=$test.status.in false="#ffaaaa" true="#aaffaa"};'>&nbsp;
					{include file="views/unit_tests/components/status.tpl" status=$test.status.in false="-" true="+"}
				</td>
				<td style='background: {include file="views/unit_tests/components/status.tpl" status=$test.status.out false="#ffaaaa" true="#aaffaa"};'>&nbsp;
					{include file="views/unit_tests/components/status.tpl" status=$test.status.out false="-" true="+"}
				</td>
				<td style='background: {include file="views/unit_tests/components/status.tpl" status=$test.status.user false="#ffaaaa" true="#aaffaa"};'>&nbsp;
					{include file="views/unit_tests/components/status.tpl" status=$test.status.user false="-" true="+"}
				</td>				
				<td>{$test.unit}</td>
				<td>{$test.addon}</td>
			</tr>
		{/foreach}		
	{/foreach}	
			</table>
</div>
{else}
<p class="no-items">{$lang.no_data}</p>
{/if}
