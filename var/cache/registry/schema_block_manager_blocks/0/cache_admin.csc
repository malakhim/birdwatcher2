a:2:{s:4:"data";a:19:{s:4:"menu";a:3:{s:9:"templates";s:11:"blocks/menu";s:7:"content";a:2:{s:5:"items";a:2:{s:4:"type";s:8:"function";s:8:"function";a:1:{i:0;s:17:"fn_get_menu_items";}}s:4:"menu";a:4:{s:4:"type";s:8:"template";s:8:"template";s:41:"views/menus/components/block_settings.tpl";s:10:"hide_label";b:1;s:13:"data_function";a:1:{i:0;s:12:"fn_get_menus";}}}s:8:"wrappers";s:15:"blocks/wrappers";}s:10:"my_account";a:3:{s:9:"templates";a:1:{s:21:"blocks/my_account.tpl";a:0:{}}s:8:"wrappers";s:15:"blocks/wrappers";s:7:"content";a:1:{s:12:"header_class";a:2:{s:4:"type";s:8:"function";s:8:"function";a:1:{i:0;s:29:"fn_get_my_account_title_class";}}}}s:12:"cart_content";a:3:{s:9:"templates";a:1:{s:23:"blocks/cart_content.tpl";a:0:{}}s:8:"settings";a:3:{s:22:"display_bottom_buttons";a:2:{s:4:"type";s:8:"checkbox";s:13:"default_value";s:1:"Y";}s:20:"display_delete_icons";a:2:{s:4:"type";s:8:"checkbox";s:13:"default_value";s:1:"Y";}s:19:"products_links_type";a:3:{s:4:"type";s:9:"selectbox";s:6:"values";a:2:{s:5:"thumb";s:5:"thumb";s:4:"text";s:4:"text";}s:13:"default_value";s:5:"thumb";}}s:8:"wrappers";s:15:"blocks/wrappers";}s:11:"breadcrumbs";a:2:{s:9:"templates";a:1:{s:32:"common_templates/breadcrumbs.tpl";a:0:{}}s:8:"wrappers";s:15:"blocks/wrappers";}s:8:"template";a:2:{s:9:"templates";s:23:"blocks/static_templates";s:8:"wrappers";s:15:"blocks/wrappers";}s:4:"main";a:3:{s:17:"hide_on_locations";a:1:{i:0;s:12:"product_tabs";}s:19:"single_for_location";i:1;s:8:"wrappers";s:15:"blocks/wrappers";}s:10:"html_block";a:4:{s:7:"content";a:1:{s:7:"content";a:2:{s:4:"type";s:4:"text";s:8:"required";b:1;}}s:9:"templates";s:21:"blocks/html_block.tpl";s:8:"wrappers";s:15:"blocks/wrappers";s:5:"cache";a:1:{s:15:"update_handlers";a:1:{i:0;s:17:"bm_blocks_content";}}}s:8:"checkout";a:2:{s:9:"templates";s:15:"blocks/checkout";s:8:"wrappers";s:15:"blocks/wrappers";}s:8:"products";a:5:{s:7:"content";a:1:{s:5:"items";a:6:{s:4:"type";s:4:"enum";s:6:"object";s:8:"products";s:14:"items_function";s:15:"fn_get_products";s:13:"remove_indent";b:1;s:10:"hide_label";b:1;s:8:"fillings";a:4:{s:8:"manually";a:2:{s:6:"picker";s:27:"pickers/products_picker.tpl";s:13:"picker_params";a:1:{s:4:"type";s:5:"links";}}s:6:"newest";a:1:{s:6:"params";a:3:{s:7:"sort_by";s:9:"timestamp";s:10:"sort_order";s:4:"desc";s:7:"request";a:1:{s:3:"cid";s:13:"%CATEGORY_ID%";}}}s:15:"recent_products";a:2:{s:6:"params";a:4:{s:11:"apply_limit";b:1;s:7:"session";a:1:{s:3:"pid";s:26:"%RECENTLY_VIEWED_PRODUCTS%";}s:7:"request";a:1:{s:11:"exclude_pid";s:12:"%PRODUCT_ID%";}s:16:"force_get_by_ids";b:1;}s:13:"disable_cache";b:1;}s:12:"most_popular";a:1:{s:6:"params";a:4:{s:15:"popularity_from";i:1;s:7:"sort_by";s:10:"popularity";s:10:"sort_order";s:4:"desc";s:7:"request";a:1:{s:3:"cid";s:12:"%CATEGORY_ID";}}}}}}s:9:"templates";s:15:"blocks/products";s:8:"settings";a:1:{s:23:"hide_add_to_cart_button";a:2:{s:4:"type";s:8:"checkbox";s:13:"default_value";s:1:"Y";}}s:8:"wrappers";s:15:"blocks/wrappers";s:5:"cache";a:3:{s:15:"update_handlers";a:5:{i:0;s:8:"products";i:1;s:20:"product_descriptions";i:2;s:14:"product_prices";i:3;s:19:"products_categories";i:4;s:18:"product_popularity";}s:16:"request_handlers";a:1:{s:19:"current_category_id";s:13:"%CATEGORY_ID%";}s:16:"session_handlers";a:1:{s:8:"settings";s:10:"%SETTINGS%";}}}s:10:"categories";a:4:{s:7:"content";a:1:{s:5:"items";a:6:{s:4:"type";s:4:"enum";s:6:"object";s:10:"categories";s:14:"items_function";s:17:"fn_get_categories";s:13:"remove_indent";b:1;s:10:"hide_label";b:1;s:8:"fillings";a:4:{s:8:"manually";a:3:{s:6:"params";a:3:{s:5:"plain";b:1;s:6:"simple";b:0;s:14:"group_by_level";b:0;}s:6:"picker";s:29:"pickers/categories_picker.tpl";s:13:"picker_params";a:3:{s:8:"multiple";b:1;s:8:"use_keys";s:1:"N";s:6:"status";s:1:"A";}}s:6:"newest";a:4:{s:6:"params";a:3:{s:7:"sort_by";s:9:"timestamp";s:5:"plain";b:1;s:7:"visible";b:1;}s:6:"period";a:3:{s:4:"type";s:9:"selectbox";s:6:"values";a:3:{s:1:"A";s:8:"any_date";s:1:"D";s:5:"today";s:2:"HC";s:9:"last_days";}s:13:"default_value";s:8:"any_date";}s:9:"last_days";a:2:{s:4:"type";s:5:"input";s:13:"default_value";i:1;}s:5:"limit";a:2:{s:4:"type";s:5:"input";s:13:"default_value";i:3;}}s:16:"dynamic_tree_cat";a:2:{s:6:"params";a:4:{s:7:"visible";b:1;s:5:"plain";b:1;s:7:"request";a:1:{s:19:"current_category_id";s:13:"%CATEGORY_ID%";}s:7:"session";a:1:{s:19:"product_category_id";s:21:"%CURRENT_CATEGORY_ID%";}}s:8:"settings";a:1:{s:18:"parent_category_id";a:4:{s:4:"type";s:6:"picker";s:13:"default_value";s:1:"0";s:6:"picker";s:29:"pickers/categories_picker.tpl";s:13:"picker_params";a:3:{s:8:"multiple";b:0;s:8:"use_keys";s:1:"N";s:12:"default_name";s:10:"Root level";}}}}s:13:"full_tree_cat";a:3:{s:6:"params";a:1:{s:5:"plain";b:1;}s:13:"update_params";a:1:{s:7:"request";a:1:{i:0;s:12:"%CATEGORY_ID";}}s:8:"settings";a:1:{s:18:"parent_category_id";a:4:{s:4:"type";s:6:"picker";s:13:"default_value";s:1:"0";s:6:"picker";s:29:"pickers/categories_picker.tpl";s:13:"picker_params";a:3:{s:8:"multiple";b:0;s:8:"use_keys";s:1:"N";s:12:"default_name";s:10:"Root level";}}}}}}}s:9:"templates";s:17:"blocks/categories";s:8:"wrappers";s:15:"blocks/wrappers";s:5:"cache";a:3:{s:15:"update_handlers";a:2:{i:0;s:10:"categories";i:1;s:21:"category_descriptions";}s:16:"session_handlers";a:1:{i:0;s:21:"%CURRENT_CATEGORY_ID%";}s:16:"request_handlers";a:1:{i:0;s:13:"%CATEGORY_ID%";}}}s:15:"product_filters";a:3:{s:7:"content";a:1:{s:5:"items";a:6:{s:4:"type";s:4:"enum";s:6:"object";s:7:"filters";s:14:"items_function";s:29:"fn_get_filters_products_count";s:13:"remove_indent";b:1;s:10:"hide_label";b:1;s:8:"fillings";a:2:{s:7:"dynamic";a:1:{s:6:"params";a:3:{s:14:"check_location";b:1;s:7:"request";a:6:{s:8:"dispatch";s:10:"%DISPATCH%";s:11:"category_id";s:13:"%CATEGORY_ID%";s:13:"features_hash";s:15:"%FEATURES_HASH%";s:10:"variant_id";s:12:"%VARIANT_ID%";s:15:"advanced_filter";s:17:"%advanced_filter%";s:10:"company_id";s:12:"%COMPANY_ID%";}s:16:"skip_if_advanced";b:1;}}s:7:"filters";a:1:{s:6:"params";a:4:{s:7:"get_all";b:1;s:7:"request";a:2:{s:13:"features_hash";s:15:"%FEATURES_HASH%";s:10:"variant_id";s:12:"%VARIANT_ID%";}s:10:"get_custom";b:1;s:19:"skip_other_variants";b:1;}}}}}s:9:"templates";a:2:{s:35:"blocks/product_filters/original.tpl";a:1:{s:8:"fillings";a:1:{i:0;s:7:"dynamic";}}s:33:"blocks/product_filters/custom.tpl";a:1:{s:8:"fillings";a:1:{i:0;s:7:"filters";}}}s:8:"wrappers";s:15:"blocks/wrappers";}s:5:"pages";a:4:{s:7:"content";a:1:{s:5:"items";a:6:{s:4:"type";s:4:"enum";s:6:"object";s:5:"pages";s:14:"items_function";s:12:"fn_get_pages";s:13:"remove_indent";b:1;s:10:"hide_label";b:1;s:8:"fillings";a:6:{s:8:"manually";a:2:{s:6:"picker";s:24:"pickers/pages_picker.tpl";s:13:"picker_params";a:2:{s:8:"multiple";b:1;s:6:"status";s:1:"A";}}s:6:"newest";a:1:{s:6:"params";a:3:{s:7:"sort_by";s:9:"timestamp";s:7:"visible";b:1;s:6:"status";s:1:"A";}}s:18:"dynamic_tree_pages";a:2:{s:6:"params";a:5:{s:7:"visible";b:1;s:8:"get_tree";s:5:"plain";s:6:"status";s:1:"A";s:7:"request";a:1:{s:15:"current_page_id";s:9:"%PAGE_ID%";}s:18:"get_children_count";b:1;}s:8:"settings";a:1:{s:14:"parent_page_id";a:4:{s:4:"type";s:6:"picker";s:13:"default_value";s:1:"0";s:6:"picker";s:24:"pickers/pages_picker.tpl";s:13:"picker_params";a:3:{s:8:"multiple";b:0;s:6:"status";s:1:"A";s:12:"default_name";s:9:"All pages";}}}}s:15:"full_tree_pages";a:2:{s:6:"params";a:3:{s:8:"get_tree";s:5:"plain";s:6:"status";s:1:"A";s:18:"get_children_count";b:1;}s:8:"settings";a:1:{s:14:"parent_page_id";a:4:{s:4:"type";s:6:"picker";s:13:"default_value";s:1:"0";s:6:"picker";s:24:"pickers/pages_picker.tpl";s:13:"picker_params";a:3:{s:8:"multiple";b:0;s:6:"status";s:1:"A";s:12:"default_name";s:9:"All pages";}}}}s:10:"neighbours";a:1:{s:6:"params";a:5:{s:8:"get_tree";s:5:"plain";s:6:"status";s:1:"A";s:18:"get_children_count";b:1;s:10:"neighbours";b:1;s:7:"request";a:1:{s:18:"neighbours_page_id";s:9:"%PAGE_ID%";}}}s:12:"vendor_pages";a:1:{s:6:"params";a:3:{s:6:"status";s:1:"A";s:12:"vendor_pages";b:1;s:7:"request";a:1:{s:10:"company_id";s:12:"%COMPANY_ID%";}}}}}}s:9:"templates";s:12:"blocks/pages";s:8:"wrappers";s:15:"blocks/wrappers";s:5:"cache";a:3:{s:15:"update_handlers";a:2:{i:0;s:5:"pages";i:1;s:17:"page_descriptions";}s:16:"session_handlers";a:1:{i:0;s:21:"%CURRENT_CATEGORY_ID%";}s:16:"request_handlers";a:2:{i:0;s:9:"%PAGE_ID%";i:1;s:12:"%COMPANY_ID%";}}}s:7:"vendors";a:5:{s:7:"content";a:1:{s:5:"items";a:6:{s:4:"type";s:4:"enum";s:6:"object";s:7:"vendors";s:13:"remove_indent";b:1;s:10:"hide_label";b:1;s:14:"items_function";s:22:"fn_get_short_companies";s:8:"fillings";a:2:{s:3:"all";a:0:{}s:8:"manually";a:2:{s:6:"picker";s:28:"pickers/companies_picker.tpl";s:13:"picker_params";a:1:{s:8:"multiple";b:1;}}}}}s:8:"settings";a:1:{s:17:"displayed_vendors";a:2:{s:4:"type";s:5:"input";s:13:"default_value";s:2:"10";}}s:9:"templates";s:25:"blocks/companies_list.tpl";s:8:"wrappers";s:15:"blocks/wrappers";s:5:"cache";a:1:{s:15:"update_handlers";a:2:{i:0;s:9:"companies";i:1;s:20:"company_descriptions";}}}s:15:"payment_methods";a:4:{s:7:"content";a:1:{s:5:"items";a:2:{s:4:"type";s:8:"function";s:8:"function";a:1:{i:0;s:29:"fn_get_payment_methods_images";}}}s:9:"templates";s:19:"blocks/payments.tpl";s:8:"wrappers";s:15:"blocks/wrappers";s:5:"cache";a:1:{s:15:"update_handlers";a:2:{i:0;s:8:"payments";i:1;s:20:"payment_descriptions";}}}s:16:"shipping_methods";a:4:{s:7:"content";a:1:{s:5:"items";a:2:{s:4:"type";s:8:"function";s:8:"function";a:1:{i:0;s:22:"fn_get_shipping_images";}}}s:9:"templates";s:20:"blocks/shippings.tpl";s:8:"wrappers";s:15:"blocks/wrappers";s:5:"cache";a:1:{s:15:"update_handlers";a:2:{i:0;s:9:"shippings";i:1;s:21:"shipping_descriptions";}}}s:10:"currencies";a:4:{s:7:"content";a:1:{s:10:"currencies";a:2:{s:4:"type";s:8:"function";s:8:"function";a:1:{i:0;s:17:"fn_get_currencies";}}}s:8:"settings";a:3:{s:4:"text";a:2:{s:4:"type";s:5:"input";s:13:"default_value";s:0:"";}s:6:"format";a:3:{s:4:"type";s:9:"selectbox";s:6:"values";a:2:{s:4:"name";s:17:"opt_currency_name";s:6:"symbol";s:19:"opt_currency_symbol";}s:13:"default_value";s:4:"name";}s:14:"dropdown_limit";a:2:{s:4:"type";s:5:"input";s:13:"default_value";s:1:"0";}}s:9:"templates";s:21:"blocks/currencies.tpl";s:8:"wrappers";s:15:"blocks/wrappers";}s:9:"languages";a:4:{s:7:"content";a:1:{s:9:"languages";a:2:{s:4:"type";s:8:"function";s:8:"function";a:1:{i:0;s:16:"fn_get_languages";}}}s:8:"settings";a:3:{s:4:"text";a:2:{s:4:"type";s:5:"input";s:13:"default_value";s:0:"";}s:6:"format";a:3:{s:4:"type";s:9:"selectbox";s:6:"values";a:2:{s:4:"name";s:17:"opt_language_name";s:4:"icon";s:17:"opt_language_icon";}s:13:"default_value";s:4:"name";}s:14:"dropdown_limit";a:2:{s:4:"type";s:5:"input";s:13:"default_value";s:1:"0";}}s:9:"templates";s:20:"blocks/languages.tpl";s:8:"wrappers";s:15:"blocks/wrappers";}s:13:"gift_registry";a:3:{s:9:"templates";a:1:{s:44:"addons/gift_registry/blocks/giftregistry.tpl";a:0:{}}s:8:"wrappers";s:15:"blocks/wrappers";s:5:"cache";a:1:{s:15:"update_handlers";s:14:"giftreg_events";}}s:17:"gift_registry_key";a:2:{s:9:"templates";a:1:{s:48:"addons/gift_registry/blocks/giftregistry_key.tpl";a:0:{}}s:8:"wrappers";s:15:"blocks/wrappers";}}s:6:"expiry";i:0;}