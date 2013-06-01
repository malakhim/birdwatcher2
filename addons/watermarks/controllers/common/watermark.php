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


if ( !defined('AREA') ) { die('Access denied'); }

//
// Delete image
//
if ($mode == 'create') {

	$no_image_path = DIR_IMAGES . 'no_image.gif';
	$result_image = $no_image_path;
	if (!empty($_SERVER['REQUEST_URI'])) {
		$pattern = '!\/(\w+)\/([\/\d]+)\/(.+\.(:?jpg|jpeg|png|gif)).*$!';

		if (@preg_match($pattern, $_SERVER['REQUEST_URI'], $matches)) {
			$object_type = fn_basename($matches[1]);
			$image_place = $matches[2];
			$image_name = fn_basename($matches[3]);

			$image_file = DIR_IMAGES . $object_type . '/' . $image_place . '/' . $image_name;

			$watermarked_path = DIR_WATERMARKS . $object_type . '/' . $image_place;
			$watermarked_file = $watermarked_path . '/' . $image_name;

			if (is_file($watermarked_file)) {
				$result_image = $watermarked_file;

			} elseif (is_file($image_file)) {
				$image_id = db_get_field("SELECT image_id FROM ?:images WHERE image_path LIKE ?s", "%$image_name%");

				$image_link = db_get_row("SELECT * FROM ?:images_links WHERE image_id = ?i OR detailed_id = ?i", $image_id, $image_id);

				if (!empty($image_link)) {
					$is_detailed = ($image_link['detailed_id'] == $image_id);
					$image_type = $is_detailed ? 'detailed' : 'icons';
					if (fn_add_watermark_file($image_file, $watermarked_file, $image_link['object_type'], $is_detailed)) {
						$result_image = $watermarked_file;
					}
				}
			}
		}
	}

	$fd = @fopen($result_image, 'rb');
	if ($fd) {
		header('Content-type: ' . fn_get_mime_content_type($result_image));
		fpassthru($fd);
		fclose($fd);
	}
	exit;

}

?>