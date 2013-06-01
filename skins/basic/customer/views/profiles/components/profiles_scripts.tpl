<script type="text/javascript">
//<![CDATA[

var default_country = '{$settings.General.default_country|escape:javascript}';

{literal}
var zip_validators = {
	US: {
		regex: /^(\d{5})(-\d{4})?$/,
		format: '01342 (01342-5678)'
	},
	CA: {
		regex: /^(\w{3} ?\w{3})$/,
		format: 'K1A OB1 (K1AOB1)'
	},
	RU: {
		regex: /^(\d{6})?$/,
		format: '123456'
	}
}
{/literal}

var states = new Array();
{if $states}
{foreach from=$states item=country_states key=country_code}
states['{$country_code}'] = new Array();
{foreach from=$country_states item=state name="fs"}
states['{$country_code}']['__{$state.code|escape:quotes}'] = '{$state.state|escape:javascript}';
{/foreach}
{/foreach}
{/if}

//]]>
</script>
{script src="js/profiles_scripts.js"}