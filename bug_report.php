<?php

if(strpos($_SERVER['SERVER_NAME'],"localhost") === FALSE)
	header("location: http://brystore.com/mantis/bug_report_page.php");
else
	// fn_error_msg(tr('error_database_connect'), true, debug_backtrace());
	// debug_print_backtrace();
	var_dump(debug_backtrace());
	// fn_error(debug_backtrace(),"An error has occurred",false);die;
?>