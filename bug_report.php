<?php

if(strpos($_SERVER['SERVER_NAME'],"localhost") === FALSE)
	header("location: http://brystore.com/mantis/bug_report_page.php");
else{
	var_dump(debug_backtrace());
}
?>