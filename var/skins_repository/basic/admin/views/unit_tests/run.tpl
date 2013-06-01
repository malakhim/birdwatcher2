{if $test_log}
<a href="{"unit_tests.manage"|fn_url}" class="lowercase">« {$lang.back}</a>
<div class="posts-container">
	{capture name="mainbox"}

	<div class="items-container" id="addons_list" style="float: left; width:100%;">
		{foreach from=$test_log item=object key=object_name}
			{include file="common_templates/subheader.tpl" title=$object_name}
			{foreach from=$object item=tests key=method_name name=methods}
				<div style="float: left; width:29%; margin: 1%; padding: 1%; border: 1px solid #efefef;">
					<h3>
						{if $tests.static}<span style="font-weight:normal">static </span>{/if}
						{$method_name}
					</h3>
					<table style="width:100%;">
						{foreach from=$tests.tests item=test key=test_count}
							<tr style='background: {include file="views/unit_tests/components/status.tpl" status=$test.status.general false="#ffeeee" true="#eeffee"};'>
								<td style='color:#aaa; width:10px; background: {include file="views/unit_tests/components/status.tpl" status=$test.status.in false="#ffaaaa" true="#aaffaa"};'>
									I
								</td>
								<td style='color:#aaa; width:10px; background: {include file="views/unit_tests/components/status.tpl" status=$test.status.out false="#ffaaaa" true="#aaffaa"};'>
									O
								</td>
								<td style='color:#aaa; width:10px; background: {include file="views/unit_tests/components/status.tpl" status=$test.status.user false="#ffaaaa" true="#aaffaa"};'>
									U
								</td>
								<td><a href="#" id="sw_case_{$object_name}_{$method_name}_{$test_count}" class="cm-combo-on|off cm-combination" onclick="return false">Test #{$test_count+1}
									</a>
									<div id="case_{$object_name}_{$method_name}_{$test_count}" class="hidden" style="position: absolute; z-index: 100500; text-align: left;">
										<code><pre>{$test.case|fn_array2code_string}</pre></code>
									</div>
								</td>
								<td>
									{if $test.result|fn_test_has_return}
										<a href="#" id="sw_result_{$object_name}_{$method_name}_{$test_count}" class="cm-combo-on|off cm-combination" onclick="return false">Result</a>

										<div id="result_{$object_name}_{$method_name}_{$test_count}" class="hidden"  style="position: absolute; z-index: 100500"	>
											<code><pre>{$test.result|fn_array2code_string}</pre></code>
										</div>
									{/if}
								</td>
								<td>
									{if $test.post_in}
										<a href="#" id="sw_post_in_{$object_name}_{$method_name}_{$test_count}" class="cm-combo-on|off cm-combination" onclick="return false">Post in</a>

										<div id="post_in_{$object_name}_{$method_name}_{$test_count}" class="hidden"  style="position: absolute; z-index: 100500; "	>
											<code><pre>{$test.post_in|fn_array2code_string}</pre></code>
										</div>
									{/if}
								</td>
								<td>
									{if $test.case.comment}{include file="common_templates/tooltip.tpl" tooltip=$test.case.comment}{/if}
								</td>
							</tr>
						{/foreach}
					</table>
				</div>
				{if $smarty.foreach.methods.iteration %3 == 0} <div class="clear">&nbsp</div>{/if}
			{/foreach}
		{foreachelse}
			<p class="no-items">{$lang.no_items}</p>
		{/foreach}
	</div>

	{/capture}
	{include file="common_templates/mainbox.tpl" title="`$lang.test_unit`: `$smarty.request.unit`" content=$smarty.capture.mainbox}
</div>
{else}
<p class="no-items">{$lang.no_data}</p>
{/if}
