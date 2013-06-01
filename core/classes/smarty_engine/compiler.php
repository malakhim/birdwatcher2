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

/**
* Template compiling class
* @package Smarty
*/
class SmartyEngine_Compiler extends Smarty_Compiler {
	//	
	// Overload base method to output script tags directly (in capture)
	//
	function _compile_include_tag($tag_args)
	{
		$attrs = $this->_parse_attrs($tag_args);
		$arg_list = array();

		if (empty($attrs['file'])) {
			$this->_syntax_error("missing 'file' attribute in include tag", E_USER_ERROR, __FILE__, __LINE__);
		}

		foreach ($attrs as $arg_name => $arg_value) {
			if ($arg_name == 'file') {
				$include_file = $arg_value;
				continue;
			} else if ($arg_name == 'assign') {
				$assign_var = $arg_value;
				continue;
			}
			if (is_bool($arg_value))
				$arg_value = $arg_value ? 'true' : 'false';
			$arg_list[] = "'$arg_name' => $arg_value";
		}

		$output = '<?php ';

		if (isset($assign_var)) {
			$buffer = "'" . md5($attrs['file']) . "'";
			$output .= "ob_start(); \$this->_in_capture[] = $buffer;\n"; // zeke: get capture info to output script tags directly. FIXME
		}

		$output .= "\$_smarty_tpl_vars = \$this->_tpl_vars;";


		$_params = "array('smarty_include_tpl_file' => " . $include_file . ", 'smarty_include_vars' => array(".implode(',', (array)$arg_list)."))";
		$output .= "\$this->_smarty_include($_params);\n"
			. "\$this->_tpl_vars = \$_smarty_tpl_vars;\n"
			. "unset(\$_smarty_tpl_vars);\n";

		if (isset($assign_var)) {
			$output .= "\$this->_tpl_vars[" . $assign_var . "] = ob_get_contents(); ob_end_clean(); array_pop(\$this->_in_capture); if (!empty(\$this->_scripts[$buffer])) { echo implode(\"\\n\", \$this->_scripts[$buffer]); unset(\$this->_scripts[$buffer]); }\n"; //zeke
		}

		$output .= ' ?>';

		return $output;
	}

	//
	// Overload base method to parse $lang variables
	//
    function _parse_var($var_expr)
    {
		$_output = parent::_parse_var($var_expr);

		if (strpos($_output, "\$this->_tpl_vars['lang']") !== false) {
			$__tmp = str_replace("\$this->_tpl_vars['lang'][", 'fn_get_lang_var(', $_output);
			$__tmp{strlen($__tmp)-1} = ',';
			$__tmp .= ' $this->getLanguage())';
			$_output = $__tmp;
			unset($__tmp);
		}

		return $_output;
	}

	//
	// Overload base method to get rid of @ sign to process arrays at once
	//
	function _parse_modifiers(&$output, $modifier_string)
	{
		return parent::_parse_modifiers($output, preg_replace('/\|(?!@)/', '|@', $modifier_string));
	}

	//
	// Overload base method in order to prevent using deprecated variables.
	//
	function _compile_smarty_ref(&$indexes)
	{
		$_ref = substr($indexes[0], 1);

		// post, get and env variables are disabled
		if (in_array($_ref, array ('post', 'get', 'env'))) {
			$this->_syntax_error("access for \$smarty.$_ref variables is disabled, please use \$smarty.request", E_USER_WARNING, __FILE__, __LINE__);
		}

		// Access to request variable is provided via escaped one
		if ($_ref == 'request') {
			array_shift($indexes);
			return '$this->_tpl_vars[\'_REQUEST\']';
		}

		return parent::_compile_smarty_ref($indexes);
	}

	// -------- Custom methods ----------------
	function _prefilter_inline_callback($match)
	{
		$ld = $this->left_delimiter;
		$rd = $this->right_delimiter;
		$source_content = '';

		$_attrs = $this->_parse_attrs($match[1]);

		if (isset($_attrs['assign'])) { // Do not inline template if it has "assign" parameter
			return $match[0];
		}

		if (!isset($_attrs['file'])) {
			$this->syntax_error('[inline] missing file-parameter');
			return false;
		}


		$resource_name = $this->_dequote($_attrs['file']);
		unset($_attrs['file']);

		if (strpos($resource_name, '$') !== false) {
			return $match[0];
		}

		if (isset($_attrs['assign'])) {
			$assign = $_attrs['assign'];
			unset($_attrs['assign']);
		} else {
			$assign = null;
		}

		$source_content .= $ld.'php'.$rd;
		$source_content .= "\$__parent_tpl_vars = \$this->_tpl_vars;";

		if (!empty($_attrs)) {

			$source_content .= "\$this->_tpl_vars = array_merge(\$this->_tpl_vars, array(";
			foreach ($_attrs as $_name => $_value) {
				$source_content .= "'$_name' => $_value, ";
			}
			$source_content .= '));';
		}

		$source_content .= $ld.'/php'.$rd;

		$params = array(
			'resource_name' => $resource_name,
			'quiet' => true,
		);

		if ($this->_fetch_resource_info($params)) {
			// remove comments
			$params['source_content'] = preg_replace('~\{\*(.*?)\*}~', '', $params['source_content']);

			// if we do not have includes from this template, inline it
			if (strpos($params['source_content'], '{include ') === false) {

				// run template source through prefilter functions
				if (count($this->_plugins['prefilter']) > 0) {
					$current_file = $this->_current_file;
					$this->_current_file = $params['resource_name'];
					$stop_on_next = false;
					foreach ($this->_plugins['prefilter'] as $filter_name => $prefilter) {
						if ($prefilter === false || $stop_on_next == true) {
							continue;
						}
						if ($filter_name == 'prefilter_inline') { // run prefilters up to current one
							$stop_on_next = true;
						}
						if ($prefilter[3] || is_callable($prefilter[0])) {
							$params['source_content'] = call_user_func_array($prefilter[0], array($params['source_content'], &$this));
							$this->_plugins['prefilter'][$filter_name][3] = true;
						} else {
							$this->_trigger_fatal_error("[plugin] prefilter '$filter_name' is not implemented");
						}
					}
					$this->_current_file = $current_file;
				}

				$source_content .= $params['source_content'];
				$this->_inline_cache[$resource_name] = $params['resource_timestamp'];

				// handle assign
				if (isset($assign)) {
					$source_content = $ld.'php'.$rd . 'ob_start();' . $ld.'/php' . $rd . $source_content . $ld.'php'.$rd . "\$this->_tpl_vars[$assign] = ob_get_contents(); ob_end_clean();";
				}
				$source_content .= $ld.'php'.$rd . "if (isset(\$__parent_tpl_vars)) { \$this->_tpl_vars = \$__parent_tpl_vars; unset(\$__parent_tpl_vars);}" . $ld.'/php'.$rd;
			} else {
				return $match[0];
			}

		}

		return $source_content;
	}

}