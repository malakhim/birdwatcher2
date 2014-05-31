<?php /* Smarty version 2.6.18, created on 2014-03-10 11:22:08
         compiled from orders/print_invoice.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo '
<style type="text/css" media="print">
.main-table {
	background-color: #ffffff !important;
}
</style>
<style type="text/css" media="screen,print">
body,p,div,td {
	color: #000000;
	font: 12px Arial;
}
body {
	padding: 0;
	margin: 0;
}
a, a:link, a:visited, a:hover, a:active {
	color: #000000;
	text-decoration: underline;
}
a:hover {
	text-decoration: none;
}
</style>
'; ?>

</head>

<body>
<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/scripts.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "orders/invoice.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</body>
</html>