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

define('ITEMS_PER_PAGE', 30);
define('GENERAL_FONT_FAMILY', 'freeserif');
define('GENERAL_FONT_SIZE', 10);
define('GENERAL_MARGIN_TOP', 10);
define('GENERAL_MARGIN_LEFT', 10);
define('GENERAL_MARGIN_RIGHT', 10);
define('FIELDS_HEADER_FONT_SIZE', 11);
define('FIELDS_ODD_BG_COLOR', '#EEEEEE');
define('IMAGE_HEIGHT', 50);
define('CATEGORY_HEADER_FONT_SIZE', 12);
define('CATEGORY_HEADER_FONT_COLOR', '#FFFFFF');
define('CATEGORY_HEADER_BG_COLOR', '#888888');
define('TABLE_CELLPADDING', 4);
define('TABLE_CELLSPACING', 0);

// Min column width in percent
$min_width = array(
	'product' => 50,
	'product_code' => 13,
	'image' => 10,
);

error_reporting(E_ERROR);
ini_set('display_errors', '1');

set_time_limit(0);

fn_price_list_timer(); // Start timer;

$filename = DIR_CACHE_MISC . '/price_list/price_list_' . CART_LANGUAGE . '.pdf'; // Must be unique for each pdf mode.

if (file_exists($filename)) {
	if (headers_sent()) {
		exit;
	}
	
	header('Content-Description: File Transfer');
	header('Cache-Control: public, must-revalidate, max-age=0'); // HTTP/1.1
	header('Pragma: public');
	header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // Date in the past
	header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
	// force download dialog
	header('Content-Type: application/force-download');
	header('Content-Type: application/octet-stream', false);
	header('Content-Type: application/download', false);
	header('Content-Type: application/pdf', false);
	// use the Content-Disposition header to supply a recommended filename
	header('Content-Disposition: attachment; filename="' . fn_get_lang_var('price_list') . '.pdf";');
	header('Content-Transfer-Encoding: binary');
	
	echo file_get_contents($filename);
	
	exit;
	
} else {
	include_once DIR_ADDONS . '/price_list/lib/tcpdf/config/lang/eng.php';
	include_once DIR_ADDONS . '/price_list/lib/tcpdf/tcpdf.php';
	
	include_once DIR_ADDONS . '/price_list/core/class.counter.php';
	
	$counter = new Counter(100, '.');
	
	// create new PDF document
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', true);
	
	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor(Registry::get('settings.Company.company_name'));
	$pdf->SetTitle(fn_get_lang_var('price_list'));
	$pdf->SetSubject('');
	$pdf->SetKeywords('');
	
	// remove default header
	$pdf->setPrintHeader(false);
	
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	
	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
	
	//set margins
	$pdf->SetMargins(GENERAL_MARGIN_LEFT, GENERAL_MARGIN_TOP, GENERAL_MARGIN_RIGHT);
	
	//set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	
	//set image scale factor
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
	
	// set font
	$pdf->SetFont(GENERAL_FONT_FAMILY, '', GENERAL_FONT_SIZE);
	
	// add a page
	$pdf->AddPage();
	
	$selected_fields = Registry::get('addons.price_list.price_list_fields');
	$max_perc = 100;
	$field_count = count($selected_fields);
	
	// First step. Check for the min width.
	$perc = intval($max_perc / $field_count);
	
	foreach ($selected_fields as $field_name => $active) {
		if (isset($min_width[$field_name])) {
			if ($min_width[$field_name] > $perc) {
				$max_perc -= $min_width[$field_name];
				$field_count--;
			}
		}
	}
	
	// Second step. Set up the new width values.
	$perc = intval($max_perc / $field_count);
	
	foreach ($selected_fields as $field_name => $active) {
		if ($min_width[$field_name] < $perc) {
			$price_schema['fields'][$field_name]['min_width'] = $perc;
		} else {
			$price_schema['fields'][$field_name]['min_width'] = $min_width[$field_name];
		}
	}
	
	if (Registry::get('addons.price_list.group_by_category') != 'Y') {
		// Output full products list
		
		fn_echo(fn_get_lang_var('generating_pdf') . '<br />');
		
		$tbl = '';
		
		$tbl .= '<table border="0" cellpadding="' . TABLE_CELLPADDING . '" cellspacing="' . TABLE_CELLSPACING . '" width="100%">';
		$tbl .= '<tr>';
		
		foreach (Registry::get('addons.price_list.price_list_fields') as $field_name => $active) {
			$tbl .= '<td style="font-size: ' . FIELDS_HEADER_FONT_SIZE . '" width="' . $price_schema['fields'][$field_name]['min_width'] . '%"><strong>' . $price_schema['fields'][$field_name]['title'] . '</strong></td>';
		}
		
		$tbl .= '</tr>';
		$tbl .= '</table>';
		
		$pdf->writeHTML($tbl, true, false, false, false, '');
		$tbl = '';
		
		$fill = true;
		$counter->Clear();
		
		$page = 1;
		$total = ITEMS_PER_PAGE;
		$fill = true;
		
		$params = $_REQUEST;
		$params['sort_by'] = $price_schema['fields'][Registry::get('addons.price_list.price_list_sorting')]['sort_by'];
		$params['page'] = $page;
		$params['skip_view'] = 'Y';
		
		while (ITEMS_PER_PAGE * ($params['page'] - 1) <= $total) {
			list($products, , $total) = fn_get_products($params, ITEMS_PER_PAGE);

			$_params = array(
				'get_icon' => true,
				'get_detailed' => false,
				'get_options' => (Registry::get('addons.price_list.include_options') == 'Y')? true : false,
				'get_discounts' => false,
			);
			fn_gather_additional_products_data($products, $_params);

			$params['page']++;
			$tbl = '<table border="0" cellpadding="' . TABLE_CELLPADDING . '" cellspacing="' . TABLE_CELLSPACING . '" width="100%">';

			// Write products information
			foreach ($products as $product) {

				if ($fill) {
					$style = 'style="background-color: ' . FIELDS_ODD_BG_COLOR . '"';
				} else {
					$style = '';
				}
				
				if (Registry::get('addons.price_list.include_options') == 'Y' && $product['has_options']) {
					$product = fn_price_list_get_combination($product);
					
					foreach ($product['combinations'] as $c_id => $c_value) {

						$product['price'] = $product['combination_prices'][$c_id];
						$product['weight'] = $product['combination_weight'][$c_id];
						$product['amount'] = $product['combination_amount'][$c_id];
						$product['product_code'] = $product['combination_code'][$c_id];
						
						$tbl .= fn_price_list_print_product_data($product, $selected_fields, $style, $price_schema, $c_value);
						
						$fill = !$fill;
						if ($fill) {
							$style = 'style="background-color: ' . FIELDS_ODD_BG_COLOR . '"';
						} else {
							$style = '';
						}
						
						$counter->Out();
					}
					
				} else {
					$tbl .= fn_price_list_print_product_data($product, $selected_fields, $style, $price_schema);
					
					$fill = !$fill;
				}
				
				$counter->Out();
			}
			
			$tbl .= '</table>';
			
			$counter->Out();
			
			$pdf->writeHTML($tbl, true, false, false, false, '');
		}
	
	} else {
		fn_echo(fn_get_lang_var('generating_pdf') . '<br />');
		
		// Group the products by categories
		// Prepare PDF data
		$categories = fn_get_plain_categories_tree(0, false);
		
		foreach ($categories as $category) {
			
			if ($category['product_count'] == 0) {
				continue;
			}
			
			fn_echo('<br />' . $category['category']);
			$counter->Clear();
			// Write category name
			$tbl = '';
			$tbl .= '<table border="0" cellpadding="' . TABLE_CELLPADDING . '" cellspacing="' . TABLE_CELLSPACING . '" width="100%">';
			$tbl .= '<tr>';
			$tbl .= '<td align="left" style="background-color: ' . CATEGORY_HEADER_BG_COLOR . '; font-size: ' . CATEGORY_HEADER_FONT_SIZE . '; color: ' . CATEGORY_HEADER_FONT_COLOR . '" colspan="' . count(Registry::get('addons.price_list.price_list_fields')) . '"><strong>' . fn_price_list_build_category_name($category['id_path']) . '</strong></td>';
			$tbl .= '</tr>';
			$tbl .= '</table>';
			
			// Write product head fields
			$tbl .= '<table border="0" cellpadding="' . TABLE_CELLPADDING . '" cellspacing="' . TABLE_CELLSPACING . '" width="100%">';
			$tbl .= '<tr>';
			foreach (Registry::get('addons.price_list.price_list_fields') as $field_name => $active) {
				$tbl .= '<td style="font-size: ' . FIELDS_HEADER_FONT_SIZE . ';" width="' . $price_schema['fields'][$field_name]['min_width'] . '%"><strong>' . $price_schema['fields'][$field_name]['title'] . '</strong></td>';
			}
			$tbl .= '</tr>';
			$tbl .= '</table>';
			
			$pdf->writeHTML($tbl, true, false, false, false, '');
			
			$page = 1;
			$total = ITEMS_PER_PAGE;
			$fill = true;
			
			$params = $_REQUEST;
			$params['sort_by'] = $price_schema['fields'][Registry::get('addons.price_list.price_list_sorting')]['sort_by'];
			$params['page'] = $page;
			$params['skip_view'] = 'Y';

			$params['cid'] = $category['category_id'];
			$params['subcats'] = 'N';

			while (ITEMS_PER_PAGE * ($params['page'] - 1) <= $total) {
				list($products, , $total) = fn_get_products($params, ITEMS_PER_PAGE);

				$_params = array(
					'get_icon' => true,
					'get_detailed' => false,
					'get_options' => (Registry::get('addons.price_list.include_options') == 'Y')? true : false,
					'get_discounts' => false,
				);
				fn_gather_additional_products_data($products, $_params);

				$params['page']++;
				$tbl = '<table border="0" cellpadding="' . TABLE_CELLPADDING . '" cellspacing="' . TABLE_CELLSPACING . '" width="100%">';

				// Write products information
				foreach ($products as $product) {

					if ($fill) {
						$style = 'style="background-color: ' . FIELDS_ODD_BG_COLOR . '"';
					} else {
						$style = '';
					}
					
					if (Registry::get('addons.price_list.include_options') == 'Y' && $product['has_options']) {
						$product = fn_price_list_get_combination($product);
						
						foreach ($product['combinations'] as $c_id => $c_value) {
							
							$product['price'] = $product['combination_prices'][$c_id];
							$product['weight'] = $product['combination_weight'][$c_id];
							$product['amount'] = $product['combination_amount'][$c_id];
							$product['product_code'] = $product['combination_code'][$c_id];
							
							$tbl .= fn_price_list_print_product_data($product, $selected_fields, $style, $price_schema, $c_value);
							
							$fill = !$fill;
							if ($fill) {
								$style = 'style="background-color: ' . FIELDS_ODD_BG_COLOR . '"';
							} else {
								$style = '';
							}
							
							$counter->Out();
						}
						
					} else {
						$tbl .= fn_price_list_print_product_data($product, $selected_fields, $style, $price_schema);
						
						$fill = !$fill;
					}
					
					$counter->Out();
				}
				
				$tbl .= '</table>';
				
				$counter->Out();
				
				$pdf->writeHTML($tbl, true, false, false, false, '');
			}
		}
	}
	
	//Close and output PDF document
	fn_mkdir(dirname($filename));
	$pdf->Output($filename, 'F');
	
	fn_echo('<br />' . fn_get_lang_var('done'));
}

function fn_pricelist_find_valid_image_path($image_pair)
{
	return fn_find_valid_image_path($image_pair, 'product', false, false);
}

/**
 *
 * Adds product data in HTML format to price list table
 * @param array $product Product data
 * @param array $selected_fields Product fields that should be in price list
 * @param string $style Product row style (similar to the HTML style attribute, e.g.: style="background-color: #EEEEEE")
 * @param array $price_schema Price list columns scheme
 * @param array $options_variants Product options variants
 *
 * @return string Product data row in HTML format
 */
function fn_price_list_print_product_data($product, $selected_fields, $style, $price_schema, $options_variants = array())
{
	$tbl = '<tr>';
	foreach ($selected_fields as $field_name => $active) {
		$tbl .= '<td ' . $style . ' width="' . $price_schema['fields'][$field_name]['min_width'] . '%">';
		if ($field_name == 'image') {
			if ($image_path = fn_find_valid_image_path($product['main_pair'])) {
				$image_path = urlencode(str_replace(Registry::get('config.current_path'), Registry::get('config.current_location'), $image_path));
				$tbl .= '<img src="' . $image_path . '" height="' . IMAGE_HEIGHT . '" align="bottom" />';
			}
		} elseif ($field_name == 'product' && !empty($options_variants)) {
			$options = array();
									
			foreach ($options_variants as $option_id => $variant_id) {
				$options[] = $product['product_options'][$option_id]['option_name'] . ': ' . $product['product_options'][$option_id]['variants'][$variant_id]['variant_name'];
			}
									
			$options = implode('<br />', $options);
									
			$tbl .= $product[$field_name] . '<br />' . $options;
		} elseif ($field_name == 'price') {
			$tbl .= fn_format_price($product[$field_name], CART_PRIMARY_CURRENCY, null, false);
		} else {
			$tbl .= $product[$field_name];
		}
		$tbl .= '</td>';
	}
	$tbl .= '</tr>';

	return $tbl;
}

?>