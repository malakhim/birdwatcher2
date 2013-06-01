<div class="float-right nowrap right" id="post_{$post.post_id}">
	<span class="float-left">{$post.timestamp|date_format:"`$settings.Appearance.date_format`, `$settings.Appearance.time_format`"} &nbsp;-&nbsp;</span>
	<div class="float-left">{include file="common_templates/select_popup.tpl" id=$post.post_id status=$post.status hidden="" object_id_name="post_id" table="discussion_posts" items_status="discussion"|fn_get_predefined_statuses}</div>
<!--post_{$post.post_id}--></div>