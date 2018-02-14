<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2015年9月17日
 * @author Administrator
 * @version
 * @des
 */
$config['dealer/dealer_model/is_valid'] = array(
    'd_id' => 'did',
    'd_des' => 'des',
    'd_shop' => 'shop',
    'd_debt1' => 'debt1',
    'd_debt2' => 'debt2',
    'd_balance' => 'balance',
    'concat(ifnull(d.a_province, ""), ifnull(d.a_city, ""), ifnull(d.a_county, ""), "-", ifnull(d_address,""))' => 'area',
    'A.dl_name' => 'linker',
    'if(strcmp(A.dl_mobilephone, ""),A.dl_mobilephone, A.dl_telephone)' => 'way'
);
$config['dealer/dealer_model/select_dealer'] = array(
    'd_id' => 'did', 
    'd_des' => 'des', 
    'd_shop' => 'shop', 
    'd_debt1' => 'debt1', 
    'd_debt2' => 'debt2', 
    'd_deliveried' => 'deliveried', 
    'd_received' => 'received', 
    'd_balance' => 'balance', 
    'd.a_id' => 'aid', 
    'concat(d.a_province, d.a_city, ifnull(d.a_county, ""), "-", ifnull(d_address,""))' => 'area', 
    'dc_id' => 'dcid', 
    'dc_name' => 'category', 
    'd_remark' => 'remark', 
    'c.u_truename' => 'creator', 
    'dl_name' => 'linker', 
    'if(strcmp(dl_mobilephone, ""),dl_mobilephone, dl_telephone)' => 'way', 
    'p_id' => 'pid', 
    'p_name' => 'payterms',
    'o.u_truename' => 'owner'
);
$config['dealer/dealer_model/select_dealer_money'] = array(
    'd_id' => 'did',
    'd_des' => 'des',
    'd_shop' => 'shop',
    'd_debt1' => 'debt1',
    'd_debt2' => 'debt2',
    'd_deliveried' => 'deliveried',
    'd_received' => 'received',
    'd_balance' => 'balance',
    'd.a_id' => 'aid',
    'concat(d.a_province, d.a_city, ifnull(d.a_county, ""), "-", ifnull(d_address,""))' => 'area',
    'dc_id' => 'dcid',
    'dc_name' => 'category',
    'd_remark' => 'remark',
    'u_truename' => 'owner',
    'dl_name' => 'linker',
    'if(strcmp(dl_mobilephone, ""),dl_mobilephone, dl_telephone)' => 'way',
    'p_id' => 'pid',
    'p_name' => 'payterms'
);

$config['dealer/dealer_model/select_all'] = array(
    'd_id' => 'did',
    'd_des' => 'dealer',
    'p_name' => 'payterms',
    'concat(ifnull(d.a_province,""), ifnull(d.a_city, ""), ifnull(d.a_county, ""), ifnull(d_address,""))' => 'dealer_address',
    'A.dl_name' => 'dealer_linker',
    'if(A.dl_mobilephone = "", A.dl_telephone, A.dl_mobilephone)' => 'dealer_phone',
    'B.dl_name' => 'checker',
    'if(B.dl_mobilephone = "", B.dl_telephone, B.dl_mobilephone)' => 'checker_phone',
    'C.dl_name' => 'payer',
    'if(C.dl_mobilephone = "", C.dl_telephone, C.dl_mobilephone)' => 'payer_phone',
    'concat(ifnull(d.a_province,""), ifnull(d.a_city, ""), ifnull(dd.a_county, ""))' => 'delivery_area',
    'dd_address' => 'delivery_address',
    'dd_name' => 'delivery_linker',
    'dd_phone' => 'delivery_phone',
    'l_name' => 'logistics',
    'om_name' => 'out_method'
);

$config['dealer/dealer_category_model/select'] = array(
    'dc_id' => 'dcid',
    'dc_name' => 'name'
);

$config['dealer/dealer_delivery_model/select'] = array(
    'dd_id' => 'ddid',
    'a_id' => 'daid',
    'concat(ifnull(a_province,""), ifnull(a_city, ""), ifnull(a_county, ""))' => 'area',
    'dd_address' => 'delivery_address',
    'l_id' => 'lid',
    'l_name' => 'logistics',
    'om_id' => 'omid',
    'om_name' => 'out_method',
    'dd_name' => 'delivery_linker',
    'dd_phone' => 'delivery_phone',
    'dd_default' => 'defaults',
    'if(dd_default,\'<i class="fa fa-check"></i>\', "")' => 'icon'
);

$config['dealer/dealer_linker_model/select'] = array(
    'dl_id' => 'dlid',
    'dl_name' => 'name',
    'dl_mobilephone' => 'mobilephone',
    'dl_telephone' => 'telephone',
    'dl_email' => 'email',
    'dl_qq' => 'qq',
    'dl_fax' => 'fax',
    'do_id' => 'doid',
    'do_name' => 'organization',
    'dl_primary' => 'primarys',
    'if(dl_primary,\'<i class="fa fa-check"></i>\', "")' => 'icon'
);

$config['dealer/dealer_organization_model/select'] = array(
    'do_id' => 'doid',
    'do_name' => 'name'
);

$config['dealer/dealer_owner_model/select'] = array(
    'd_id' => 'did',
    'd_des' => 'dealer',
    'p_name' => 'payterms',
    'concat(ifnull(d.a_province,""), ifnull(d.a_city, ""), ifnull(d.a_county, ""), ifnull(d_address,""))' => 'dealer_address',
    'A.dl_name' => 'dealer_linker',
    'if(A.dl_mobilephone = "", A.dl_telephone, A.dl_mobilephone)' => 'dealer_phone',
    'B.dl_name' => 'checker',
    'if(B.dl_mobilephone = "", B.dl_telephone, B.dl_mobilephone)' => 'checker_phone',
    'C.dl_name' => 'payer',
    'if(C.dl_mobilephone = "", C.dl_telephone, C.dl_mobilephone)' => 'payer_phone',
    'concat(ifnull(d.a_province,""), ifnull(d.a_city, ""), ifnull(dd.a_county, ""))' => 'delivery_area',
    'dd_address' => 'delivery_address',
    'dd_name' => 'delivery_linker',
    'dd_phone' => 'delivery_phone',
    'l_name' => 'logistics',
    'om_name' => 'out_method'
);

$config['dealer/dealer_owner_model/select_owner'] = array(
    'do_id' => 'doid',
    'u_truename' => 'truename',
    'do_primary' => 'primarys',
    'if(do_primary = 1, "<i class=\"fa fa-check\"></i>", "<i class=\"fa fa-times\"></i>")' => 'icon'
);

$config['dealer/dealer_trace_model/select'] = array(
    'dt_id' => 'dtid',
    'u_truename' => 'creator',
    'dt_trace' => 'trace',
    'dt_create_datetime' => 'create_datetime'
);

$config['dealer/payterms_model/select'] = array(
    'p_id' => 'pid',
    'p_name' => 'name'
);

$config['dealer/my_dealer/read'] = array(
    'd_id' => 'did',
    'd_des' => 'des',
    'd_shop' => 'shop',
    'a_id' => 'aid',
    'area' => 'area',
    'dc_id' => 'dcid',
    'dc_name' => 'category',
    'd_remark' => 'remark',
    'u_truename' => 'creator',
    'd_create_datetime' => 'create_datetime',
    'dl_name' => 'linker',
    'way' => 'way',
    'p_id' => 'pid',
    'p_name' => 'payterms',
    'd_debt1' => 'debt1',
    'd_debt2' => 'debt2',
    'd_deliveried' => 'deliveried',
    'd_received' => 'received',
    'd_balance' => 'balance'
);
$config['dealer/dealer/read_json'] = array(
    'd_id' => 'did',
    'dealer' => 'dealer'
);

$config['dealer/dealer_model/select_dealer_all'] = array(
    'd_id' => 'did',
    'd_des' => 'dealer',
    'dealer_address' => 'dealer_address',
    'p_name' => 'payterms',
    'dealer_linker' => 'dealer_linker',
    'dealer_phone' => 'dealer_phone',
    'checker' => 'checker',
    'checker_phone' => 'checker_phone',
    'payer' => 'payer',
    'payer_phone' => 'payer_phone',
    'delivery_area' => 'delivery_area',
    'dd_address' => 'delivery_address',
    'l_name' => 'logistics',
    'om_name' => 'out_method',
    'dd_name' => 'delivery_linker',
    'dd_phone' => 'delivery_phone'
);
