{capture name="styles"}

<link href="{$config.skin_path}/css/ui/jqueryui.css" rel="stylesheet" type="text/css"/>

<link href="{$config.skin_path}/styles.css" rel="stylesheet" type="text/css" />
{if "TRANSLATION_MODE"|defined || "CUSTOMIZATION_MODE"|defined}
<link href="{$config.skin_path}/design_mode.css" rel="stylesheet" type="text/css" />
{/if}
<!--[if lte IE 7]>
<link href="{$config.skin_path}/styles_ie.css" rel="stylesheet" type="text/css" />
<![endif]-->

{hook name="index:styles"}{/hook}

{/capture}
{join_css content=$smarty.capture.styles}