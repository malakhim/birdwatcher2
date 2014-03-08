<?php /* Smarty version 2.6.18, created on 2014-03-08 23:37:39
         compiled from views/shippings/components/test.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'format_price', 'views/shippings/components/test.tpl', 125, false),array('modifier', 'unescape', 'views/shippings/components/test.tpl', 125, false),array('modifier', 'default', 'views/shippings/components/test.tpl', 134, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('shipping','origination','destination','address','city','country','state','zip_postal_code','shipping_service','weight','cost','error','close_window'));
?>
<?php  ob_start();  ?><?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/price.tpl' => 1367063753,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><html>
<head>
<title><?php echo fn_get_lang_var('shipping', $this->getLanguage()); ?>
</title>
<meta http-equiv="content-type" content="text/html; charset=<?php echo @CHARSET; ?>
" />
</head>
<?php echo '
<style>
body,th,td,tt,p,div,span {
	color: #000000;
	font-family: tahoma, verdana, arial, sans-serif;
	font-size: 11px;
}
body,form,div {
	margin-top:	0px;
	margin-bottom: 0px;
	margin-left: 0px;
	margin-right: 0px;
}
body {
	background-color: #fbfbfb;
}
p {
	margin: 6px 0px;
}
a:link, a:visited, a:active {
	color: #296dc1;
	text-decoration: none;
}
a:hover	{
	color: #f27a00;
	text-decoration: underline;
}
.table {
	margin: 0px;
	border: 1px solid #a5afb8/*#D0DBE3*/;
}

.table th {
	color: #151515;
	font-weight: bold;
	text-transform: uppercase;
}
.table th {
	background-color: #c6d5e8/*#d1d9e4/*#b3e3fc*/;
	white-space: nowrap;
	padding: 7px 8px 6px 8px;
	text-align: left;
	border-bottom: 1px solid #a3aabe;
}
.table .table-row {
	background-color: #f1f8ff;
}
</style>
'; ?>

<body onLoad="self.focus()">

<?php if ($this->_tpl_vars['service']): ?>
<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
<tr>
	<th>&nbsp;</th>
	<th><?php echo fn_get_lang_var('origination', $this->getLanguage()); ?>
 </th>
	<th>&nbsp;&nbsp;&nbsp;</th>
	<th><?php echo fn_get_lang_var('destination', $this->getLanguage()); ?>
 </th>
</tr>
<tr class="table-row">
	<td><span><?php echo fn_get_lang_var('address', $this->getLanguage()); ?>
:</span>&nbsp;</td>
	<td><?php echo $this->_tpl_vars['settings']['Company']['company_address']; ?>
 </td>
	<td>&nbsp;&nbsp;&nbsp;</td>
	<td><?php echo $this->_tpl_vars['settings']['General']['default_address']; ?>
 </td>
</tr>
<tr>
	<td><span><?php echo fn_get_lang_var('city', $this->getLanguage()); ?>
:</span>&nbsp;</td>
	<td><?php echo $this->_tpl_vars['settings']['Company']['company_city']; ?>
</td>
	<td>&nbsp;&nbsp;&nbsp;</td>
	<td><?php echo $this->_tpl_vars['settings']['General']['default_city']; ?>
 </td>
</tr>
<tr class="table-row">
	<td><span><?php echo fn_get_lang_var('country', $this->getLanguage()); ?>
:</span>&nbsp;</td>
	<td><?php echo $this->_tpl_vars['settings']['Company']['company_country']; ?>
</td>
	<td>&nbsp;&nbsp;&nbsp;</td>
	<td><?php echo $this->_tpl_vars['settings']['General']['default_country']; ?>
 </td>
</tr>
<tr>
	<td><span><?php echo fn_get_lang_var('state', $this->getLanguage()); ?>
:</span>&nbsp;</td>
	<td><?php echo $this->_tpl_vars['settings']['Company']['company_state']; ?>
</td>
	<td>&nbsp;&nbsp;&nbsp;</td>
	<td><?php echo $this->_tpl_vars['settings']['General']['default_state']; ?>
 </td>
</tr>
<tr class="table-row">
	<td><span><?php echo fn_get_lang_var('zip_postal_code', $this->getLanguage()); ?>
:</span>&nbsp;</td>
	<td><?php echo $this->_tpl_vars['settings']['Company']['company_zipcode']; ?>
</td>
	<td>&nbsp;&nbsp;&nbsp;</td>
	<td><?php echo $this->_tpl_vars['settings']['General']['default_zipcode']; ?>
 </td>
</tr>
</table>

<table cellpadding="2" cellspacing="1" border="0">
<tr>
	<td><span><?php echo fn_get_lang_var('shipping_service', $this->getLanguage()); ?>
:</span>&nbsp;</td>
	<td><?php echo $this->_tpl_vars['service']; ?>
</td>
</tr>
<tr>
	<td><span><?php echo fn_get_lang_var('weight', $this->getLanguage()); ?>
:</span>&nbsp;</td>
	<td><?php echo $this->_tpl_vars['weight']; ?>
&nbsp;<?php echo $this->_tpl_vars['settings']['General']['weight_symbol']; ?>
</td>
</tr>
<?php if ($this->_tpl_vars['data']['cost']): ?>
<tr>
	<td><span><?php echo fn_get_lang_var('cost', $this->getLanguage()); ?>
:</span>&nbsp;</td>
	<td><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['data']['cost'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false)); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true)); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
</tr>
<?php else: ?>
<tr>
	<td><span><?php echo fn_get_lang_var('error', $this->getLanguage()); ?>
:</span>&nbsp;</td>
	<td><?php echo smarty_modifier_default(@$this->_tpl_vars['data']['error'], "n/a"); ?>
</td>
</tr>
<?php endif; ?>
</table>

<?php endif; ?>

<p class="center"><a href="javascript: window.close();" class="underlined"><?php echo fn_get_lang_var('close_window', $this->getLanguage()); ?>
</a></p>
</body>
</html><?php  ob_end_flush();  ?>