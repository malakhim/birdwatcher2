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

DEFINE ('AREA', 'C');
DEFINE ('AREA_NAME' ,'customer');

date_default_timezone_set('Europe/Moscow');
include('./../prepare.php');
define('DIR_INSTALL_SKINS', is_dir(DIR_ROOT . '/var/skins_repository') ? DIR_ROOT . '/var/skins_repository' : DIR_ROOT . '/skins');
if (!defined('CONSOLE')) {
	define('WEB_DIR_INSTALL_SKINS', is_dir('../var/skins_repository') ? '../var/skins_repository' : '../skins');
}
include(DIR_ROOT . '/install/core/install.php');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title><?php echo tr('installation_wizard'); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script type="text/javascript" src="../lib/js/jquery/jquery.min.js"></script>
<script type="text/javascript" src="../js/core.js"></script>
<script type="text/javascript" src="../js/ajax.js"></script>
<script type="text/javascript" language="javascript 1.2">

var translate_mode = false;
var images_dir = '<?php echo WEB_DIR_INSTALL_SKINS ?>/<?php echo BASE_SKIN ?>/customer/images';
var changes_warning = 'N';

// FIXME: Langs hardcode!
var lang = [];
lang.loading = "<?php echo tr('loading') ?>";
lang.error = "<?php echo tr('error') ?>";
lang.error_ajax = "<?php echo tr('error_ajax') ?>";
lang.error_validator_required = "<?php echo tr('error_validator_required') ?>";

$(function(){
	jQuery.runCart('C');
});

function fn_check_agreement()
{
	if (document.getElementById('accept') && document.getElementById('accept').checked == false) {
		alert("<?php echo tr('text_accept_license') ?>");
		return false;
	} else if (document.getElementById('cert_text'))  {
		if (document.getElementById('cert_text').value == '' && document.getElementById('cert_file').value == '') {
			alert("<?php echo tr('text_install_certificate') ?>");
			return false;
		}
	}
}

function fn_select_all()
{
	checked = document.getElementById('select_all').checked;

	cb = document.getElementsByTagName('input');
	for (var i = 0; i < cb.length; i++) {
		var type = cb[i].getAttribute("type");
		if ( type == "checkbox" &&  cb[i].getAttribute("name") != null &&  cb[i].getAttribute("value") != null ) {
			// grab the data
			cb[i].checked = checked;
		}
	}
}

function fn_check_license(elm_id)
{
	if (!$('#' + elm_id).attr('disabled')) {
		var license = $('#' + elm_id).val();
		url = 'index.php?mode=check_license&license=' + license;
		
		jQuery.processNotifications();
		
		jQuery.ajaxRequest(url, {callback: fn_check_license_response_pre});
	}
}

function fn_check_license_response_pre(data, params)
{
	if (typeof(data.response_data) != 'undefined') {
		if (data.response_data.is_ok == true) {
			$('#license_status').attr('class','ok');
		} else {
			$('#license_status').attr('class','false');
		}
	}
}

function fn_register_license_switch_callback()
{
	block = $('#register_license');
	if (block.is(':visible')) {
		block.switchAvailability(false, false);
	} else {
		block.switchAvailability(true, false);
	}
}

function fn_change_button_text(button, text)
{
	// Button: [next,prev]
	// Text: new button text
	
	$('#' + button + 'but').val(text);
}

	lang.close = "<?php tr('close'); ?>";
</script>

<link rel="stylesheet" href="../var/skins_repository/<?php echo BASE_SKIN ?>/customer/css/960/reset.css" type="text/css"/>
<link rel="stylesheet" href="../var/skins_repository/<?php echo BASE_SKIN ?>/customer/css/960/960.css" type="text/css"/>
<link rel="stylesheet" href="./css/style.css" type="text/css" />

</head>
	<body>
		<form name="installform" action="index.php" method="post" onsubmit="return fn_check_agreement();" <?php if($mode == 'certificate'): ?>enctype="multipart/form-data"<?php endif; ?> >
		<input type="hidden" name="mode" value="<?php echo !empty($next_mode) ? $next_mode : ''; ?>" />
			<div class="container_16">
				<!--Header-->
				<div class="header grid_16">
					<div class="header-logo grid_3 alpha">
						<a href="#"><img src="./img/logo.png" alt="" /></a>
					</div>
					<div class="header-version grid_4 prefix_9 omega">
						<h3><?php echo tr('installation_wizard_title'); ?></h3>
						<span><?php echo tr('version') . PRODUCT_VERSION . ' ' .PRODUCT_TYPE . ' ' . (PRODUCT_STATUS != '' ? (' (' . PRODUCT_STATUS . ')') : '') . (PRODUCT_BUILD != '' ? (' ' . PRODUCT_BUILD) : ''); ?></span>

						<?php 

						?>
					</div>
					<div class="header-menu grid_16 alpha">
						<div class="header-menu-wrapper">
						<ul>
							<?php 
								$steps = array(
									'license_agreement' => tr('license_agreement'),
									'requirements' => tr('checking_requirements'),
									'settings' => tr('host_db_settings'),
									'database' => tr('installing_database'),
									'outlook' => tr('outlook_settings'),
									'skins' => tr('installing_skins'),
									//'certificate' => tr('certificate'),

									'license' => tr('license'),
									'summary' => tr('summary')
								);
								$steps_order = array_keys($steps);
								
								$active_element = array_search($mode, $steps_order);
								for ($i = 0; $i < count($steps_order); $i++) {
									$classes = '';
									$prev = $i - 1;
									if ($steps_order[$i] == 'certificate' && !defined('LICENSE_USED')) {
										continue;
									}

									if ($active_element == $i) {
										$classes .= ' active';
									} elseif (($active_element - 1) == $i) {
										$classes .= ' prev';
									} elseif ($i < $active_element) {
										$classes .= ' past';
									}
									?>
									<li class="<?php echo $classes?>">
										<span><?php echo $steps[$steps_order[$i]];?></span><div></div>
									</li>
									<?php /*echo '<div style="line-height:15px">'.(($mode == $k)?'<b>':'') . $v . (($mode == $k)?'</b>':'').'</div>';*/
								}
							?>
						</ul>
						</div>
					</div>
				</div>
				<!--#Header-->
				<!--content-->
				  <div class="content grid_11 push_2">
					<h1><?php echo $steps[$mode];?></h1>
					<div class="cm-notification-container">
						<!--[error_msg]-->
						<?php if (!empty($error_msg)): ?>
							<div class="notification-e">
								<div class="notification-header-e">
									<?php echo tr('error') ?>
								</div>
								<div class="notification-body">
								  	<?php echo $error_msg ?>
								</div>
							</div>
						<?php endif; ?>
					<!--[/error_msg]-->

					<!--[warning_msg]-->
						<?php if (!empty($warning_msg)): ?>
							<div class="notification-w">
								<div class="notification-header-w">
									<?php echo tr('warning') ?>
								</div>
								<div class="notification-body">
									<?php echo $warning_msg ?>
								</div>
							</div>          
						<?php endif; ?>
					<!--[/warning_msg]-->
					</div>

					<!--[License agreement]-->
					<?php if ($mode == 'license_agreement'): ?>
						<textarea class="license" readonly="readonly">
							<?php readfile('../copyright.txt') ?>
						</textarea>
						<div class="license-form">
								<div class="row">
									<input id="accept" type="checkbox" name="agree" value="Y" />
									<label for="accept" class="f-middle f-bold"><?php echo tr('text_agree_with_terms') ?></label>
								</div>
								<?php if (AUTH_CODE != ''): ?>
								<div class="row">
									<label for="code" class="label-top"><?php echo tr('text_enter_auth_code') ?>:</strong></label>
									<input type="text" size="10" name="auth_code" id="code"  />
									<p class="f-gray f-small pt-5"><?php echo tr('text_auth_code_notice') ?></p>
								</div>
								<div class="row">
									<input type="radio" checked="checked" name="reinstall_mode" id="newinstallation" value="requirements">
									<label for="newinstallation"><?php echo tr('new_installation') ?></label>
									<div class="space"></div>
									<input type="radio" name="reinstall_mode" id="reinstall" value="outlook">
									<label for="reinstall"><?php echo tr('reinstall_skins') ?></label>
								</div>
								<?php endif; ?>
						</div>
					<!--[Requirements]-->
					<?php elseif ($mode == 'requirements'): ?>
						<div class="requirements">
							<div class="row">
								<h5><?php echo tr('php_information') ?></h5>
								<span class="f-gray"><?php echo tr('text_php_information_notice') ?></span>
								<div class="right-column">
									<a href="index.php?mode=phpinfo" target="_blank"><?php echo tr('display') ?></a>
								</div>
							</div>
							<div class="row">
								<h5><?php echo tr('mysql_support') ?></h5>
								<span class="f-gray"><?php echo tr('text_mysql_support_notice') ?></span>
								<div class="right-column">
									<span class="status <?php if ($mysql_status == FAIL_MSG){ ?>off<?php } ?>"><?php echo $mysql_status; ?></span>
									<span class="value"><?php echo $mysql_value; ?></span>
								</div>
							</div>
							<div class="row">
								<h5><?php echo tr('safe_mode') ?></h5>
								<span class="description f-gray"><?php echo tr('text_safe_mode_notice') ?></span>
								<div class="right-column">
									<span class="status <?php if ($safemode_status == FAIL_MSG){ ?>off<?php } ?>"><?php echo $safemode_status; ?></span>
									<span class="value"><?php echo $safemode_value; ?></span>
								</div>
							</div>
							<div class="row">
								<h5><?php echo tr('file_uploads') ?></h5>
								<span class="description f-gray"><?php echo tr('text_file_uploads_notice') ?></span>
								<div class="right-column">
									<span class="status <?php if ($fileuploads_status == FAIL_MSG){ ?>off<?php } ?>"><?php echo $fileuploads_status; ?></span>
									<span class="value"><?php echo $fileuploads_value; ?></span>
								</div>
							</div>
							<div class="row">
								<h5><?php echo tr('curl_support') ?></h5>
								<span class="description f-gray"><?php echo tr('text_curl_support_notice') ?></span>
								<div class="right-column">
									<span class="status <?php if ($curl_status == FAIL_MSG){ ?>off<?php } ?>"><?php echo $curl_status; ?></span>
									<span class="value"><?php echo $curl_value; ?></span>
								</div>
							</div>
							<blockquote>
								<?php echo tr('text_permissions') ?>
							</blockquote>
						</div>
					<!--[Settings]-->
					<?php elseif ($mode == 'settings'): ?>
						<?php 
						fn_check_db_support();
						if (IS_MYSQLI == true) {?>
						<input type="hidden" name="new_db_type" value="mysqli" />
						<?php } elseif (IS_MYSQL == true) {?>
						<input type="hidden" name="new_db_type" value="mysql" />
						<?php }?>

						<div class="db">
							<div class="row">
								<h5><?php echo tr('server_host_name') ?></h5>
								<div class="right-column">
									<input type="text" size="27" name="new_http_host" value="<?php echo @$config['http_host'] ?>">
								</div>
							</div>
							<div class="row">
								<h5><?php echo tr('server_host_directory') ?></h5>
								<div class="right-column">
									<input type="text" size="27" name="new_http_dir" value="<?php echo @$config['http_path'] ?>">
								</div>
							</div>
							<div class="row">
								<h5><?php echo tr('secure_server_host_name') ?></h5>
								<div class="right-column">
									<input type="text" size="27" name="new_https_host" value="<?php echo @$config['https_host'] ?>">
								</div>
							</div>
							<div class="row">
								<h5><?php echo tr('secure_server_host_directory') ?></h5>
								<div class="right-column">
									<input type="text" size="27" name="new_https_dir" value="<?php echo @$config['https_path'] ?>">
								</div>
							</div>
							<hr />
							<div class="row">
								<h5><?php echo tr('db_server') ?></h5>
								<div class="right-column">
									<input type="text" size="27" name="new_db_host" value="<?php echo @$config['db_host'] ?>">
								</div>
							</div>
							<div class="row">
								<h5><?php echo tr('db_name') ?></h5>
								<div class="right-column">
									<input type="text" size="27" name="new_db_name" value="<?php echo @$config['db_name'] ?>">
								</div>
							</div>
							<div class="row">
								<h5><?php echo tr('db_user') ?></h5>
								<div class="right-column">
									<input type="text" size="27" name="new_db_user" value="<?php echo @$config['db_user'] ?>">
								</div>
							</div>
							<div class="row">
								<h5><?php echo tr('db_password') ?></h5>
								<div class="right-column">
									<input type="text" size="27" name="new_db_password" value="<?php echo @$config['db_password'] ?>">
								</div>
							</div>
							<hr/>
							<div class="row">
								<h5><?php echo tr('secret_key') ?></h5>
								<span class="description f-gray"><?php echo tr('text_secret_key_notice') ?></span>
								<div class="right-column">
									<input type="text" size="27" name="new_crypt_key" value="<?php echo @$config['crypt_key'] ?>">
								</div>
							</div>
							<div class="row">
								<h5><?php echo tr('admin_email') ?></h5>
								<span class="description f-gray"><?php echo tr('text_admin_email_notice') ?></span>
								<div class="right-column">
									<input type="text" size="27" name="new_admin_email" value="<?php echo @$admin_email ?>">
								</div>
							</div>
							
							<div class="row">
								<h5><?php echo tr('feedback_auto') ?></h5>
								<span class="description f-gray"><?php echo tr('text_send_feedback_automatically') ?></span>
								<div class="right-column totop">
									<input type="checkbox" name="feedback_auto" checked="checked" value="Y" />
								</div>
							</div>
							
							<hr/>
							
							<div class="row">
								<div class="checkbox-group">
								<?php if ($languages): ?>
									<div class="box">
									<?php
									$i = 0;
									foreach ($languages as $k => $v):
										$i++;
									?>
										<?php if (($i - 1) == (int) (count($languages) / 2)): ?></div><div class="box"><?php endif; ?>
										<div class="item">
											<input type="checkbox" name="additional_languages[]" id="id_<?php echo $k; ?>" value="<?php echo $k; ?>">
											<label for="id_<?php echo $k; ?>"><?php echo $v; ?></label>
										</div>                                      
									<?php endforeach; ?>
									</div>
								<?php endif; ?>
								</div>
								<h5><?php echo tr('additional_languages') ?></h5>
								<div class="clear"></div>
							</div>

							

							<div class="row">
								<h5><?php echo tr('install_demo_data') ?></h5>
								<span class="description f-gray"><?php echo tr('text_install_demo_data_notice') ?></span>
								<div class="right-column totop">
									<input type="checkbox" name="demo_catalog" value="Y" checked="checked" />
								</div>
							</div>
						</div>
					<!--[Database]-->
					<?php elseif ($mode == 'database'): ?>
						<div class="db">
							<?php if ($can_continue == true): ?>
							<iframe id="install_db_frame" src='index.php?mode=install_db<?php echo $adds?>' frameborder="0" width="100%" height="350"></iframe>
							<?php $can_continue = false; ?>
							<?php endif; ?>
						</div>
					<!--[Outlook]-->
					<?php elseif ($mode == 'outlook'): ?>
						<div class="outlook">
							<script type="text/javascript" language="javascript 1.2">
								$(function(){
									$(".skin-image").click(function () {
										$("#skin_name").attr('value', $(this).attr('rel'));
										$(".skin-image.active").removeClass('active');
										$(this).addClass('active');
									})
								});
							</script>
							<span><?php echo tr('select_skin_to_install') ?></span>
							<input id="skin_name" type="hidden" name="new_skin_name" value="<?php echo BASE_SKIN;?>">
							<ul>
								<?php foreach($skinset as $skindir => $skinname): ?>
									<li class="skin-image<?php if ($skindir == BASE_SKIN):?> active<?php endif;?>" rel="<?php echo $skindir ?>">
										<div>
											<img src="<?php echo WEB_DIR_INSTALL_SKINS . "/" . $skindir . "/customer_screenshot.png"; ?>" width="285px" alt="<?php echo $skinname['description'] ?>" />
										</div>
										<span class="text-selected"><?php echo tr('selected') ?></span>
									</li>
								<?php endforeach; ?>
							</ul>
						</div>
						<div class="clear"></div>
					<!--[Skins]-->
					<?php elseif ($mode == 'skins'): ?>
						<div class="outlook">
							<?php if ($can_continue == true): ?>
							<iframe id="install_skin_frame" src="index.php?mode=install_skin&new_skin_name=<?php echo $new_skin_name; ?>" frameborder="0" width="100%" height="350"></iframe>
							<?php $can_continue = false; ?>
							<?php endif; ?>
						</div>


					<!--[Certificate]-->
					<?php elseif ($mode == 'certificate'): ?>
						<div style="width:420px;" align="left">
						<?php echo tr('text_certificate_notice') ?>
						<p align="left">
						<p align="left"><?php echo tr('text_paste_content') ?></p>
						<p align="left"><textarea class="input-text" cols="80" rows="10" id="cert_text" name="certificate_text"></textarea></p>
						</div>
						
					<!--[License]-->
					<?php elseif ($mode == 'license'): ?>
						<div class="license-check">
							<div class="select-field">
								<label>
									<input type="radio" id="sw_license_number_suffix_on" class="radio cm-switch-availability" checked="checked" value="L" name="license_type">
									<?php echo tr('licensed_version_of_store') ?>
								</label>
							</div>

							<div class="license-check-form desc" id="license_number">
								<div class="row f-gray">
									<?php echo tr('have_a_license') ?>
								</div>

								<div class="row form-field">
									<p><?php echo tr('enter_license_number') ?></p>
									<label class="cm-required hidden" for="cart_license"><?php echo tr('license') ?></label>

									<input type="text" class="input-text" size="27" id="cart_license" name="cart_license" value="<?php echo $license_number; ?>">
									<div class="right-column">
									<span class="btn btn-simple btn-wrap-left">
									   <span class="btn btn-simple btn-wrap-right">
										   <a onclick="fn_check_license('cart_license'); return false;"><?php echo tr('check') ?></a>
									   </span>
									</span>
									</div>
									<div id="license_status"></div>
								</div>
							</div>

							<hr />

							<div class="select-field">
								<label for="sw_license_number_suffix_off">
									<input type="radio" id="sw_license_number_suffix_off" class="radio cm-switch-availability cm-switch-inverse" value="T" name="license_type">
									<?php echo tr('trial_version_of_store') ?>
								</label>
							</div>
							<div class="row f-gray desc">
								<?php echo tr('trial_version_description') ?>
							</div>
						</div>
					
					<!--[Summary]-->
					<?php elseif ($mode == 'summary'): ?>
						<div class="summary">
						
						<?php 
				
							echo tr(
									'text_summary_notice',
									$acode,

									"http://$config[http_host]$config[http_path]/$config[customer_index]",
									"http://$config[http_host]$config[http_path]/$config[customer_index]",

			
									"http://$config[http_host]$config[http_path]/$config[vendor_index]",
									"http://$config[http_host]$config[http_path]/$config[vendor_index]",
			
									"http://$config[http_host]$config[http_path]/$config[admin_index]",
									"http://$config[http_host]$config[http_path]/$config[admin_index]",
									$admin_email
								);
								echo tr('text_summary_thanks');
							?>

						</div>

					<?php endif; ?>

					<div class="transitions">
						<?php ?>

						<?php if ($mode != 'summary'): ?>
						<span id="next-button-wrap" class="btn btn-next btn-wrap-left f-right<?php if (!$can_continue): ?> btn-disabled<?php endif; ?>"> <span class="btn btn-next btn-wrap-right"><input id="nextbut" type="submit" name="mode[<?php echo $next_mode; ?>]" value="<?php echo tr('next') ?>" <?php if (!$can_continue): ?>disabled="disabled"<?php endif; ?>  class="install-button" /></span> </span>
						<?php endif; ?>
						<div class="clear"></div>
					</div>
				<!--#content-->
				<!--footer-->
				<div class="footer grid_16">
					<p><?php echo tr('text_copyright', date('Y', TIME)) ?></p>
				</div>
				<!--#footer-->
			</div>
		</form>
	</body>
</html>
