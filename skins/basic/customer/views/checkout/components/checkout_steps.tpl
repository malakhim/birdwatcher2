{if $settings.General.checkout_style != "multi_page"}
	{assign var="ajax_form" value="cm-ajax"}
	{assign var="ajax_form_force" value="cm-ajax-force"}
{else}
	{assign var="ajax_form" value=""}
	{assign var="ajax_form_force" value=""}
{/if}

{include file="views/profiles/components/profiles_scripts.tpl"}

{if $settings.General.checkout_style != "multi_page"}
	<div class="checkout-steps cm-save-fields clearfix" id="checkout_steps">
		{if $completed_steps.step_one == true}{assign var="complete" value=true}{assign var="_text" value=$lang.continue}{else}{assign var="complete" value=false}{assign var="_text" value=$lang.continue}{/if}
		{if $edit_step == "step_one"}{assign var="edit" value=true}{else}{assign var="edit" value=false}{/if}
		{include file="views/checkout/components/steps/step_one.tpl" step="one" complete=$complete edit=$edit but_text=$_text}

		{if $profile_fields.B || $profile_fields.S}
			{if $completed_steps.step_two == true}{assign var="complete" value=true}{assign var="_text" value=$lang.continue}{else}{assign var="complete" value=false}{assign var="_text" value=$lang.continue}{/if}
			{if $edit_step == "step_two"}{assign var="edit" value=true}{else}{assign var="edit" value=false}{/if}
			{include file="views/checkout/components/steps/step_two.tpl" step="two" complete=$complete edit=$edit but_text=$_text}
		{/if}

		{if $completed_steps.step_three == true}{assign var="complete" value=true}{assign var="_text" value=$lang.continue}{else}{assign var="complete" value=false}{assign var="_text" value=$lang.continue}{/if}
		{if $edit_step == "step_three"}{assign var="edit" value=true}{else}{assign var="edit" value=false}{/if}
		{include file="views/checkout/components/steps/step_three.tpl" step="three" complete=$complete edit=$edit but_text=$_text}

		{if $completed_steps.step_four == true}{assign var="complete" value=true}{else}{assign var="complete" value=false}{/if}
		{if $edit_step == "step_four"}{assign var="edit" value=true}{else}{assign var="edit" value=false}{/if}
		{include file="views/checkout/components/steps/step_four.tpl" step="four" edit=$edit complete=$complete but_text=$_text}

		{literal}
		<script type="text/javascript" language="javascript">
		//<![CDATA[
		$(function(){
			var container = {};
			container = $('.error-box-container');
			
			if (!container.length) {
				container = $('.notification-content');
			}
			if (container.length) {
				$.scrollToElm(container);
			} else {
				$.scrollToElm($('.step-container-active'));
			}
		});
		//]]>
		</script>
		{/literal}
	<!--checkout_steps--></div>
{else}
	{$smarty.capture.checkout_error_content}
	
	{if $edit_step == "step_one"}
		{if $completed_steps.step_one == true}{assign var="complete" value=true}{assign var="_text" value=$lang.continue}{else}{assign var="complete" value=false}{assign var="_text" value=$lang.continue}{/if}
		{if $edit_step == "step_one"}{assign var="edit" value=true}{else}{assign var="edit" value=false}{/if}
		{include file="views/checkout/components/steps/step_one.tpl" complete=$complete edit=$edit but_text=$_text}
		
	{elseif $edit_step == "step_two"}
		{if $completed_steps.step_two == true}{assign var="complete" value=true}{assign var="_text" value=$lang.continue}{else}{assign var="complete" value=false}{assign var="_text" value=$lang.continue}{/if}
		{if $edit_step == "step_two"}{assign var="edit" value=true}{else}{assign var="edit" value=false}{/if}
		{include file="views/checkout/components/steps/step_two.tpl" complete=$complete edit=$edit but_text=$_text}
			
	{elseif $edit_step == "step_three"}
		{if $completed_steps.step_three == true}{assign var="complete" value=true}{assign var="_text" value=$lang.continue}{else}{assign var="complete" value=false}{assign var="_text" value=$lang.continue}{/if}
		{if $edit_step == "step_three"}{assign var="edit" value=true}{else}{assign var="edit" value=false}{/if}
		{include file="views/checkout/components/steps/step_three.tpl" complete=$complete edit=$edit but_text=$_text}
		
	{elseif $edit_step == "step_four"}
		{if $completed_steps.step_four == true}{assign var="complete" value=true}{else}{assign var="complete" value=false}{/if}
		{if $edit_step == "step_four"}{assign var="edit" value=true}{else}{assign var="edit" value=false}{/if}
		{include file="views/checkout/components/steps/step_four.tpl" edit=$edit complete=$complete but_text=$_text}
	{/if}
{/if}