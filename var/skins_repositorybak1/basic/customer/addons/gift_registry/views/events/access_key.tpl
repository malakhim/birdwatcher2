<div class="events form-wrap">
	<div class="form-wrap-l"></div>
	<div class="form-wrap-r"></div>
	<div class="events-actions">
		<ul>
			<li>{include file="buttons/button.tpl" but_text=$lang.event_add but_href="events.add" but_role="text" but_meta="add"}</li>
			<li>{include file="buttons/button.tpl" but_text=$lang.view_events but_href="events.search" but_role="text"}</li>
		</ul>
	</div>
<form action="{""|fn_url}" method="get" name="event_access_form">
	<div class="events-private-wrap">
	<h4>{$lang.enter_private_event}</h4>
	<div class="form-field-body">
		<div class="form-field">
			<label for="access_key" class="cm-required">{$lang.access_key}</label>
			<input class="input-text" type="text" id="access_key" name="access_key" size="40" value="" />
		</div>
		<span>{$lang.text_enter_access_key}</span>
	</div>
	<div class="buttons-container">
		{include file="buttons/button.tpl" but_text=$lang.enter_private_event but_name="dispatch[events.update]}
	</div>
	</div>
</form>
{capture name="mainbox_title"}{$lang.access_key}{/capture}
</div>