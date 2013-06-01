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


if (!defined('AREA') ) { die('Access denied'); }

class Ajax
{
	private $_result = array();
	private $_progress_coefficient = 0;
	private $_progress_parts = 2;
	public $result_ids = array();
	public $skip_result_ids_check = false;
	public $content_type = "application/json";
	public $request_type = NULL;
	public $redirect_type = NULL;
	const REQUEST_XML = 1;
	const REQUEST_IFRAME = 2;
	const REQUEST_COMET = 3;

	/**
	 * Create new Ajax backend object and start output buffer (buffer will be catched in destructor)
	 */
	function __construct()
	{
		$this->result_ids = !empty($_REQUEST['result_ids']) ? explode(',', str_replace(' ', '', $_REQUEST['result_ids'])) : array();
		$this->skip_result_ids_check = !empty($_REQUEST['skip_result_ids_check']);

		$this->_result = !empty($_REQUEST['_ajax_data']) ? $_REQUEST['_ajax_data'] : array();

		$this->request_type = (!empty($_REQUEST['is_ajax'])) ? $_REQUEST['is_ajax'] : self::REQUEST_XML;
		$this->redirect_type = $this->request_type;

		// Start OB handling early.
		if ($this->request_type != self::REQUEST_COMET) {
			ob_start();
		} else {
			$this->redirect_type = Ajax::REQUEST_IFRAME;
			Registry::set('runtime.comet', true);
		}

		// Check if headers are already sent (see Content-Type library usage).
		// If true - generate debug message and exit.
		$file = $line = null;
		if (headers_sent($file, $line)) {
			trigger_error(
				"HTTP headers are already sent" . ($line !== null? " in $file on line $line" : "") . ". "
				. "Possibly you have extra spaces (or newlines) before first line of the script or any library. "
				. "Please note that Subsys_Ajax uses its own Content-Type header and fails if "
				. "this header cannot be set. See header() function documentation for details",
				E_USER_ERROR
			);
			exit();
		}
	}

	/**
	 * Destructor: cache output and display valid javascript code
	 */
	function __destruct()
	{
		static $called = false;

		if ($called == false && !defined('AJAX_REDIRECT')) {
			$called = true;

			$text = ($this->request_type != self::REQUEST_COMET) ? ob_get_clean() : '';
			
			if (!empty($this->result_ids)) {
				$result_ids = array();
				// get the matching ids
				foreach ($this->result_ids as $r_id) {
					if (strpos($r_id, '*')) {
						$clear_id = str_replace('*', '\w+?', $r_id);
						preg_match_all('/<[^>]*?id=(?:\'|")(' . $clear_id . '\w*?)(?:\'|")[^>]*?>/isS', $text, $ids);
						if (!empty($ids[1])) {
							foreach ($ids[1] as $r_id2) {
								$result_ids[] = $r_id2;
							}
						}
					} else {
						$result_ids[] = $r_id;
					}
				}

				foreach ($result_ids as $r_id) {
					if (strpos($text, ' id="' . $r_id . '">') !== false) {
						$start = strpos($text, ' id="'.$r_id.'">') + strlen(' id="' . $r_id . '">');
						$end = strpos($text, '<!--' . $r_id . '--></');
						$this->assign_html($r_id, substr($text, $start, $end - $start));
					// Assume that all data should be put to div with this ID
					} elseif ($this->skip_result_ids_check == true) {
						$this->assign_html($r_id, $text);
					}
				}

				$text = '';
			}
			
			if (empty($this->_result['non_ajax_notifications'])) {
				$this->assign('notifications', fn_get_notifications());
			}

			// we call session saving directly
			session_write_close();

			// Prepare response
			$response = $this->_result;
			if (fn_string_not_empty($text)) {
				$response['text'] = trim($text);
			}
			$response = fn_to_json($response);

			if ($this->request_type == self::REQUEST_XML) {
				// Return json object
				header('Content-type: ' . $this->content_type);
			} else {
				// Return html textarea object
				$response = '<textarea>' . fn_html_escape($response) . '</textarea>';
			}

			fn_echo($response);
		}
	}

	/**
	 * Assign php variable to pass it to javascript
	 *
	 * @param string $var variable name
	 * @param mixed $value variable value
	 * @return nothing
	 */
	function assign($var, $value)
	{
		if($var == 'force_redirection') {
			//convert short urls
			$value = fn_url($value, AREA, 'rel', '&');
		}
		
		$this->_result[$var] = $value;
	}

	/**
	 * Assign html code for javascript backend
	 *
	 * @param string $id html element ID
	 * @param mixed $code html code
	 * @return nothing
	 */
	function assign_html($id, $code)
	{
		$this->_result['html'][$id] = $code;
	}

	function get_assigned_vars()
	{
		return $this->_result;
	}

	function set_progress_coefficient($elms) 
	{
		$this->_progress_parts--;
		if ($this->_progress_parts != 0 && $elms != 0) {
			$this->_progress_coefficient = (100 / $this->_progress_parts) / $elms;
		}
	}

	function set_progress_parts($parts)
	{
		$this->_progress_parts = $parts + 1;
	}

	function progress_echo($text = '', $advance = true)
	{
		static $it = 0;
		static $prev_progress = 0;

		if ($advance == true) {
			$it++;
			$progress = $it * $this->_progress_coefficient;

			// Don't advance progressbar if step is less that 1 (speeds up the process)
			// It skips some messages, but I think it's suitable in such situation
			if ($progress - $prev_progress < 1) {
				return fn_echo('.');
			}

			$prev_progress = $progress;
		} else {
			$progress = 0;
		}

		return fn_echo("<script type=\"text/javascript\">parent.jQuery('#comet_container').ceProgress('setValue', " . fn_to_json(array('text' => $text, 'progress' => $progress)) . ');</script>');
	}
}
?>