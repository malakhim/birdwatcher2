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

class Stores_Import_225Pro304Pro extends Stores_Import_EditionToEdition
{
	public function getSqlPatchName ()
	{
		return '224pro302pro';
	}

	protected function _applayPatches()
	{
		parent::_applayPatches();
		db_import_sql_file(DIR_ADDONS . 'exim_store/database/302_303.sql', 16384, true, true, false, false, false, false);
		db_import_sql_file(DIR_ADDONS . 'exim_store/database/303_304.sql', 16384, true, true, false, false, false, false);
	}
}
