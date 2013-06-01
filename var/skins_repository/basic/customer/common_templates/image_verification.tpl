{if ""|fn_needs_image_verification == true}	
	{assign var="is" value=$settings.Image_verification}
	
	{assign var="id_uniqid" value=$id|uniqid}
	<div class="captcha form-field">
	{if $sidebox}
		<p><img id="verification_image_{$id}" class="image-captcha valign" src="{"image.captcha?verification_id=`$SESS_ID`:`$id`&amp;`$id_uniqid`&amp;"|fn_url:'C':'rel':'&amp;'}" alt="" onclick="this.src += 'reload' ;" width="{$is.width}" height="{$is.height}" /></p>
	{/if}
		<label for="verification_answer_{$id}" class="cm-required">{$lang.image_verification_label}</label>
		<input class="captcha-input-text valign cm-autocomplete-off" type="text" id="verification_answer_{$id}" name="verification_answer" value= "" />
	{if !$sidebox}
		<img id="verification_image_{$id}" class="image-captcha valign" src="{"image.captcha?verification_id=`$SESS_ID`:`$id`&amp;`$id_uniqid`&amp;"|fn_url:'C':'rel':'&amp;'}" alt="" onclick="this.src += 'reload' ;"  width="{$is.width}" height="{$is.height}" />
	{/if}
	<p{if $align} class="{$align}"{/if}>{$lang.image_verification_body}</p>
	</div>
{/if}