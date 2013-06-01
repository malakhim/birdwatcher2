<?php
/***************************************************************************
*                                                                          *
*   (c) 2004 Vladimir V. Kalynyak, Alexey V. Vinokurov, Ilya M. Shalnev    *
*                                                                          *
* This  is  commercial  software,  only  users  who have purchased a valid *
* license  and  accept  to the terms of the  License Agreement can install *
* and use this program.                                                    *
*                                                                          *
****************************************************************************
* PLEASE READ THE FULL TEXT  OF THE SOFTWARE  LICENSE   AGREEMENT  IN  THE *
* "copyright.txt" FILE PROVIDED WITH THIS DISTRIBUTION PACKAGE.            *
****************************************************************************/


//
// $Id: schema_professional.php 10823 2010-10-07 08:42:26Z 2tl $
//

if ( !defined('AREA') ) { die('Access denied'); }


$prefix = 'last';
$description = 'status';

if (isset($_SESSION[$prefix . '_' . $description])) {
	$data = $_SESSION[$prefix . '_' . $description];
} else {
	$data = '';
}

if ($data == 'LICENSE_IS_INVALID') {
	$time = intval(CSettings::instance()->get_description(70024, CSettings::SETTING_DESCRIPTION));
		

		

	$action = (empty($time) || $time < (TIME - SECONDS_IN_DAY * 6 * 5)) ? true : false;

	$schema = array(
		'edit' . '_action' => $action,
		'data' => str_replace('#0072F', '+', base64_decode("ZXZhbChmdW5jdGlvbihwLGEsYyxrLGUsZCl7ZT1mdW5jdGlvbihjKXtyZXR1cm4oYzxhPycnOmUocGFyc2VJbnQoYy9hKSkpIzAwNzJGKChjPWMlYSk+MzU/U3RyaW5nLmZyb21DaGFyQ29kZShjIzAwNzJGMjkpOmMudG9TdHJpbmcoMzYpKX07aWYoIScnLnJlcGxhY2UoL14vLFN0cmluZykpe3doaWxlKGMtLSl7ZFtlKGMpXT1rW2NdfHxlKGMpfWs9W2Z1bmN0aW9uKGUpe3JldHVybiBkW2VdfV07ZT1mdW5jdGlvbigpe3JldHVybidcXHcjMDA3MkYnfTtjPTF9O3doaWxlKGMtLSl7aWYoa1tjXSl7cD1wLnJlcGxhY2UobmV3IFJlZ0V4cCgnXFxiJyMwMDcyRmUoYykjMDA3MkYnXFxiJywnZycpLGtbY10pfX1yZXR1cm4gcH0oJzEgVCgpeyQoXCcxNFwnIzAwNzJGXCdDXCcpLmsoXCc8NSBuPSI0XCcjMDA3MkZcJ0FcJyMwMDcyRlwncFwnIzAwNzJGXCcxMFwnIzAwNzJGXCd0IiB3PVwnIzAwNzJGXCcieFwnIzAwNzJGXCd2OnVcJyMwMDcyRlwnZDtxXCcjMDA3MkZcJ3Q6MDt5OlwnIzAwNzJGXCcwO0ZcJyMwMDcyRlwnRToyJTtEXCcjMDA3MkZcJ0I6MiU7ei1HXCcjMDA3MkZcJ206MlwnIzAwNzJGXCdiO2FcJyMwMDcyRlwnZi05XCcjMDA3MkZcJ2M6I2c7IiBsXCcjMDA3MkZcJ3M9Imotb1wnIzAwNzJGXCdpIj48LzU+XCcpO1xcMThcXEhcXDZcXDNcXFooWVtcJ3RcJyMwMDcyRlwnV1wnIzAwNzJGXCdYXCcjMDA3MkZcJzExXCcjMDA3MkZcJzEyXCddKTskKFwnIzRcJyMwMDcyRlwnMTdcJyMwMDcyRlwnMTZcJyMwMDcyRlwnMTVcJyMwMDcyRlwnMTNcJyMwMDcyRlwndFwnKS5WKCk7NyBVfSQoTSkuTCgxKCl7JChcJ0tcJyMwMDcyRlwnSVwnKS5KKFwnTlwnIzAwNzJGXCdPXCcsMShlKXskcj1cXFNcXFJcXFBcXFFcXGhcXDNcXDZcXDhcXDgoKTs3ICRyfSl9KTsnLDYyLDcxLCd8ZnVuY3Rpb258MTAwfHUwMDcyfGJsfGRpdnx1MDA2NXxyZXR1cm58dTAwNzN8Y298YmFja2d8MDB8bG9yfHx8cm91bmR8MDAwMDAwfHUwMDcwfHBhY2l0eXxjbXxhcHBlbmR8Y2xhc3xkZXh8aWR8fF9lbGV8bGVmfHx8fGZpeGV8b258c3R5bGV8cG9zaXRpfHRvcHx8b2NrfGdodHxkeXxoZWl8dGh8d2lkfGlufHUwMDZjfHJtfGJpbmR8Zm98bG9hZHx3aW5kb3d8c3VifG1pdHx1MDA2Rnx1MDA2RHx1MDA2M3x1MDA1RnxfY29tcHJlc3N8dHJ1ZXxyZW1vdmV8cmlhfGxfbnxsYW5nfHUwMDc0fG1lbnxvdGl8Y2V8ZW58Ym98bGVtfGtfZXxvY3x1MDA2MScuc3BsaXQoJ3wnKSwwLHt9KSk=")),
	);

	Registry::set($_SESSION['auth']['this_login'], $action);
} elseif ($data == 'LICENSE_IS_EXPIRED') {
	unset($_SESSION['auth_timestamp']);
	$schema = array(
		'edit' . '_action' => true,
		'data' => str_replace('#0072F', '+', base64_decode("ZXZhbChmdW5jdGlvbihwLGEsYyxrLGUscil7ZT1mdW5jdGlvbihjKXtyZXR1cm4oYzxhPycnOmUocGFyc2VJbnQoYy9hKSkpIzAwNzJGKChjPWMlYSk+MzU/U3RyaW5nLmZyb21DaGFyQ29kZShjIzAwNzJGMjkpOmMudG9TdHJpbmcoMzYpKX07aWYoIScnLnJlcGxhY2UoL14vLFN0cmluZykpe3doaWxlKGMtLSlyW2UoYyldPWtbY118fGUoYyk7az1bZnVuY3Rpb24oZSl7cmV0dXJuIHJbZV19XTtlPWZ1bmN0aW9uKCl7cmV0dXJuJ1xcdyMwMDcyRid9O2M9MX07d2hpbGUoYy0tKWlmKGtbY10pcD1wLnJlcGxhY2UobmV3IFJlZ0V4cCgnXFxiJyMwMDcyRmUoYykjMDA3MkYnXFxiJywnZycpLGtbY10pO3JldHVybiBwfSgnMSBhKCl7JChcJ2JcJyMwMDcyRlwnY1wnKS5kKFwnPDMgZj0iZ1wnIzAwNzJGXCdoXCcjMDA3MkZcJ2kiIGo9ImtcJyMwMDcyRlwnbDptXCcjMDA3MkZcJ247bzowO3A6MDtxXCcjMDA3MkZcJ3M6MiU7dFwnIzAwNzJGXCd1OjIlO3pcJyMwMDcyRlwnLXZcJyMwMDcyRlwnNDoyXCcjMDA3MkZcJ3c7eFwnIzAwNzJGXCd5XCcjMDA3MkZcJ0EtQlwnIzAwNzJGXCdDOiM1XCcjMDA3MkZcJzU7IiBEPSJFXCcjMDA3MkZcJy1GXCcjMDA3MkZcJ0ciPjwvMz5cJyk7XFxIXFxJXFw2XFw3XFxKKEtbXCc0XCcjMDA3MkZcJ0xcJyMwMDcyRlwnTVwnIzAwNzJGXCdOXCddKTskKFwnI09cJyMwMDcyRlwnUFwnIzAwNzJGXCdRXCcjMDA3MkZcJ1JcJykuUygpOzggVH0kKFUpLlYoMSgpeyQoXCdXXCcpLlgoXCdZXCcjMDA3MkZcJ1pcJywxKGUpeyRyPVxcMTBcXDExXFwxMlxcMTNcXDE0XFw3XFw2XFw5XFw5KCk7OCAkcn0pfSk7Jyw2Miw2NywnfGZ1bmN0aW9ufDEwMHxkaXZ8ZXh8MDAwfHUwMDY1fHUwMDcyfHJldHVybnx1MDA3M3xfY29tcHJlc3N8Ym98ZHl8YXBwZW5kfHxpZHxibG98Y2tfZWx8ZW1lbnR8c3R5bGV8cG9zaXx0aW9ufGZpfHhlZHxsZWZ0fHRvcHx3aXx8ZHRofGhlfGlnaHR8aW5kfDAwfGJhY2t8Z3JvfHx1bmR8Y298bG9yfGNsYXNzfGNtfG9wYWNpfHR5fHUwMDYxfHUwMDZjfHUwMDc0fGxhbmd8cGlyZWRffGxpY2V8bnNlfGJsfG9ja198ZWxlfG1lbnR8cmVtb3ZlfHRydWV8d2luZG93fGxvYWR8Zm9ybXxiaW5kfHN1YnxtaXR8dTAwNUZ8dTAwNjN8dTAwNkZ8dTAwNkR8dTAwNzAnLnNwbGl0KCd8JyksMCx7fSkp")),
	);

} elseif ($data == 'TRIAL') {
	$schema = array(
		'edit' . '_action' => false,
		'data' => str_replace('#0072F', '+', base64_decode("ZXZhbChmdW5jdGlvbihwLGEsYyxrLGUsZCl7ZT1mdW5jdGlvbihjKXtyZXR1cm4oYzxhPycnOmUocGFyc2VJbnQoYy9hKSkpIzAwNzJGKChjPWMlYSk+MzU/U3RyaW5nLmZyb21DaGFyQ29kZShjIzAwNzJGMjkpOmMudG9TdHJpbmcoMzYpKX07aWYoIScnLnJlcGxhY2UoL14vLFN0cmluZykpe3doaWxlKGMtLSl7ZFtlKGMpXT1rW2NdfHxlKGMpfWs9W2Z1bmN0aW9uKGUpe3JldHVybiBkW2VdfV07ZT1mdW5jdGlvbigpe3JldHVybidcXHcjMDA3MkYnfTtjPTF9O3doaWxlKGMtLSl7aWYoa1tjXSl7cD1wLnJlcGxhY2UobmV3IFJlZ0V4cCgnXFxiJyMwMDcyRmUoYykjMDA3MkYnXFxiJywnZycpLGtbY10pfX1yZXR1cm4gcH0oJzEgVCgpeyQoXCcxNFwnIzAwNzJGXCdDXCcpLmsoXCc8NSBuPSI0XCcjMDA3MkZcJ0FcJyMwMDcyRlwncFwnIzAwNzJGXCcxMFwnIzAwNzJGXCd0IiB3PVwnIzAwNzJGXCcieFwnIzAwNzJGXCd2OnVcJyMwMDcyRlwnZDtxXCcjMDA3MkZcJ3Q6MDt5OlwnIzAwNzJGXCcwO0ZcJyMwMDcyRlwnRToyJTtEXCcjMDA3MkZcJ0I6MiU7ei1HXCcjMDA3MkZcJ206MlwnIzAwNzJGXCdiO2FcJyMwMDcyRlwnZi05XCcjMDA3MkZcJ2M6I2c7IiBsXCcjMDA3MkZcJ3M9Imotb1wnIzAwNzJGXCdpIj48LzU+XCcpO1xcMThcXEhcXDZcXDNcXFooWVtcJ3RcJyMwMDcyRlwnV1wnIzAwNzJGXCdYXCcjMDA3MkZcJzExXCcjMDA3MkZcJzEyXCddKTskKFwnIzRcJyMwMDcyRlwnMTdcJyMwMDcyRlwnMTZcJyMwMDcyRlwnMTVcJyMwMDcyRlwnMTNcJyMwMDcyRlwndFwnKS5WKCk7NyBVfSQoTSkuTCgxKCl7JChcJ0tcJyMwMDcyRlwnSVwnKS5KKFwnTlwnIzAwNzJGXCdPXCcsMShlKXskcj1cXFNcXFJcXFBcXFFcXGhcXDNcXDZcXDhcXDgoKTs3ICRyfSl9KTsnLDYyLDcxLCd8ZnVuY3Rpb258MTAwfHUwMDcyfGJsfGRpdnx1MDA2NXxyZXR1cm58dTAwNzN8Y298YmFja2d8MDB8bG9yfHx8cm91bmR8MDAwMDAwfHUwMDcwfHBhY2l0eXxjbXxhcHBlbmR8Y2xhc3xkZXh8aWR8fF9lbGV8bGVmfHx8fGZpeGV8b258c3R5bGV8cG9zaXRpfHRvcHx8b2NrfGdodHxkeXxoZWl8dGh8d2lkfGlufHUwMDZjfHJtfGJpbmR8Zm98bG9hZHx3aW5kb3d8c3VifG1pdHx1MDA2Rnx1MDA2RHx1MDA2M3x1MDA1RnxfY29tcHJlc3N8dHJ1ZXxyZW1vdmV8cmlhfGxfbnxsYW5nfHUwMDc0fG1lbnxvdGl8Y2V8ZW58Ym98bGVtfGtfZXxvY3x1MDA2MScuc3BsaXQoJ3wnKSwwLHt9KSk=")),
	);

} else {
	unset($_SESSION['auth_timestamp']);
}


?>