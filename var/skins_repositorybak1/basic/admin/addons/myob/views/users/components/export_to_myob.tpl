{foreach from=$users item=user name=user}
"{$user.lastname}","{$user.firstname}",WEB-{$user.user_id|string_format:"%011d"},N,,"{$user.b_address}","{$user.b_address_2}",,,"{$user.b_city}","{$user.b_state_descr}","{$user.b_zipcode}","{$user.b_country_descr}",{$user.phone|default:''},,,{$user.b_fax|default:''},"{$user.email|default:''}",{$user.url|default:''},"{$user.b_firstname|default:''} {$user.b_lastname|default:''}","{$user.b_title_descr|default:''}","{$user.s_address}","{$user.s_address_2}",,,"{$user.s_city}","{$user.s_state_descr}","{$user.s_zipcode}","{$user.s_country_descr}",{$user.phone|default:''},,,{$user.fax|default:''},"{$user.email|default:''}",{$user.url|default:''},"{$user.s_firstname|default:''} {$user.s_lastname|default:''}","{$user.s_title_descr|default:''}",,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,1,0,7,00.00,00.00,GST,0.00,,00.00,I,0,ONLINE,,,,,,,,,,{$addons.myob.sales_account},,,"{$lang.customer_text_letter_footer}",,,GST,Y,,P,,
{/foreach}