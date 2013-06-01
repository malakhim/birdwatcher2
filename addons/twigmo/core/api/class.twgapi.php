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


/*
 * Twigmo api default version 
 * response doc includes 
 * array with the responsee data
 * or section with the errors
 * on action requests returns OK or errors list
 */
class TwgApi extends TwgApiBase
{
	private $type = 'response';

	function setData($data, $name = '')
	{
		$this->type = 'data';
		parent::setData($data, $name);
	}
	
	function setMeta($value, $name)
	{
		$this->setData($value, $name);
	}

	function getMeta($name)
	{
		if (empty($name)) {
			return $this->data;
		}

		return !empty($this->data[$name]) ? $this->data[$name] : '';
	}

	function getResponseData(&$xml_root_node = 'data')
	{
		$result = array();
		
		if (!empty($this->errors)) {
			$xml_root_node = 'errors';
			$result = array (
				'error' => $this->errors
			);
		} elseif(!empty($this->data)) {
			$result = $this->data;
		} else {
			if ($this->type == 'response') {
				$xml_root_node = 'response';
				$result = array('ok' => null);
			} else {
				$result = array('noData' => null);
			}
		}

		return $result;
	}
	
	function parseResponse($doc, $format = TWG_DEFAULT_DATA_FORMAT)
	{
		$data = ApiData::parseDocument($doc, $format);

		if (empty($data)) {
			return false;
		}

		if (!empty($data['error'])) {
			$this->errors = ApiData::getObjects($data['error']);
		}

		$this->data = $data;

		return true;
	}

	function setResponseList($list)
	{
		$this->setData($list);
	}

}

?>