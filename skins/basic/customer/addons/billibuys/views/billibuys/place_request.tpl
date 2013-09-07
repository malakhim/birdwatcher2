
<form name="bb_request_form" action="{""|fn_url}" method="post">
	<div class="form-field">
		<label for="bb_request_title" class="cm-required cm-trim">{$lang.title}</label>
		<input id="bb_request_title" type="text" name="request[title]" size="50" maxlength="50" value="{$request.title}" class="input-text" />
	</div>

	<div class="form-field">
		<label for="bb_request_desc" class="cm-required cm-trim">{$lang.description}</label>
		<textarea id="bb_request_desc" name="request[description]" size="255" maxlength="255" value="{$request.desc}" class="input-textarea-long">{$request.desc}</textarea>
	</div>

	<div class="form-field">
		<label for="bb_max_price" class="cm-trim">{$lang.max_price}</label>
		<input id="bb_max_price" type="text" name="request[max_price]" size="32" maxlength="32" value="{$request.max_price}" class="input-text" />
	</div>

	<div class="form-field">
		<label for="bb_over_max_price" class="cm-trim"><input type="checkbox" id="bb_over_max_price" name="allow_over_max_price" value="N" title="{$lang.bb_allow_over_max_price}" class="checkbox cm-check-items" />{$lang.bb_allow_over_max_price}</label>
	</div>	

	<div class="buttons-container">
		{include file="buttons/button.tpl" but_text=$lang.submit but_name="dispatch[billibuys.view]" but_id="but_submit_request"}
	</div>
</form>