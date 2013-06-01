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

class Pdf_DestinationDownload extends DestinationHTTP {
	function DestinationDownload($filename)
	{
		$this->DestinationHTTP($filename);
	}

	function headers($content_type)
	{
		return array(
		'Content-Disposition: attachment; filename="' . $this->filename_escape($this->get_filename()) . '.' . $content_type->default_extension . '"',
		'Content-Transfer-Encoding: binary',
		'Cache-Control: must-revalidate, post-check=0, pre-check=0',
		'Pragma: public'
		);
	}

	function filename_escape($filename)
	{
		return USER_AGENT == 'ie' ? rawurlencode($filename) : $filename;
	}

}


?>