<?php

$to      = 'order@domain.com';
$subject = 'the subject';
$message = 'hello';
$headers = 'From: your_email@domain.com' . "\r\n" .
 'X-Mailer: PHP/' . phpversion();

$result = mail($to, $subject, $message, $headers);
print $result;

?>