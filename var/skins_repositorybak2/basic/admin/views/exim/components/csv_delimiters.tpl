<select name="{$name}" {if $id}id="{$id}"{/if}>
<option value="S" {if $value == "S"}selected="selected"{/if}>{$lang.semicolon}</option>
<option value="C" {if $value == "C"}selected="selected"{/if}>{$lang.comma}</option>
<option value="T" {if $value == "T"}selected="selected"{/if}>{$lang.tab}</option>
</select>