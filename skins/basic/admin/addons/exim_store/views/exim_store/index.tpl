{capture name="mainbox"}

<div id="import_store">
	{if $step == 1}
	<div id="import_step_1">
		{include file="common_templates/subheader.tpl" title=$lang.es_select_store_to_import}
		<form action="{""|fn_url}" method="GET" name="import_step_1" enctype="multipart/form-data" class="scm-ajax">
			<fieldset>
				<div class="form-field ">
					<label>{$lang.es_local_store} (<a class="cm-tooltip" title="{$lang.es_local_store_tooltip}">?</a>):</label>
					<input type="text" name="store_data[path]" id="store_data_path" size="44" value="{$store_data.path}" class="input-text " {if $step != 1}disabled{/if}/>&nbsp;&nbsp;
					<span class="submit-button cm-button-main">
						<input type="submit" class="float-left" name="dispatch[exim_store.index.step_1]" value="{$lang.es_local_store_validate_path}" />
					</span>
				</div>
				<br>
			</fieldset>
		</form>
	</div>
	{/if}
	{if $step == 2}
	<div id="import_step_2">
		{include file="common_templates/subheader.tpl" title=$lang.es_enter_settings}
		<form action="{""|fn_url}" method="POST" name="import_step_2" class="cm-form-highlight cm-comet cm-ajax" enctype="multipart/form-data">
			<fieldset>


				<div class="form-field cm-required">
					<label for="store_data_db_host" class="cm-required">{$lang.es_db_host}:</label>
					<input type="text" name="store_data[db_host]" id="store_data_db_host" size="44" value="{$store_data.db_host}" class="input-text " />
				</div>
				<div class="form-field cm-required">
					<label for="store_data_db_name" class="cm-required">{$lang.es_db_name}:</label>
					<input type="text" name="store_data[db_name]" id="store_data_db_name" size="44" value="{$store_data.db_name}" class="input-text "/>
				</div>
				<div class="form-field cm-required">
					<label for="store_data_db_user" class="cm-required">{$lang.es_db_user}:</label>
					<input type="text" name="store_data[db_user]" id="store_data_db_user" size="44" value="{$store_data.db_user}" class="input-text "/>
				</div>
				<div class="form-field cm-required">
					<label for="store_data_db_password" class="cm-required">{$lang.es_db_password}:</label>
					<input type="text" name="store_data[db_password]" id="store_data_db_password" size="44" value="{$store_data.db_password}" class="input-text " />
				</div>
				<div class="form-field cm-required">
					<label for="store_data_table_prefix" class="cm-required">{$lang.es_table_prefix}:</label>
					<input type="text" name="store_data[table_prefix]" id="store_data_table_prefix" size="44" value="{$store_data.table_prefix}" class="input-text "/>
				</div>
			</fieldset>
			<div class="buttons-container  cm-toggle-button buttons-bg">
				<span class="submit-button cm-button-main">
					<input type="submit" name="dispatch[exim_store.index.step_2]" value="{$lang.import}" />
				</span>
				&nbsp;{$lang.or}&nbsp;&nbsp;
				<span class="submit-button cm-button-main">
					<a href="{"exim_store.index"|fn_url}">{$lang.cancel}</a>
				</span>
			</div>
		</form>
	</div>
	{/if}
<!--import_store--></div>

{/capture}
{include file="common_templates/mainbox.tpl" title=$lang.es_exim_store content=$smarty.capture.mainbox title_extra=$smarty.capture.title_extra}