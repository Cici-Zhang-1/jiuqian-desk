<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2015年9月22日
 * @author Zhangcc
 * @version
 * @des
 */
$config['dealer/dealer_model/insert'] = array(
    'des' => 'd_des',
    'shop' => 'd_shop',
    'aid' => 'd_area_id',
    'address' => 'd_address',
    'dcid' => 'd_company_type_id',
    'pid' => 'd_payterms_id',
    'name' => 'd_name',
    'password' => 'd_password',
    'remark' => 'd_remark',
    'creator' => 'd_creator_id',
    'create_datetime' => 'd_create_datetime'
);
$config['dealer/dealer_model/update'] = array(
    'des' => 'd_des',
    'shop' => 'd_shop',
    'aid' => 'd_area_id',
    'address' => 'd_address',
    'dcid' => 'd_company_type_id',
    'pid' => 'd_payterms_id',
    'remark' => 'd_remark',
    'password' => 'd_password'
);


$config['dealer/dealer_model/update_batch'] = array(
    'did' => 'd_id',
    'debt1' => 'd_debt1',
    'debt2' => 'd_debt2',
    'balance' => 'd_balance'
);

$config['dealer/dealer_model/update_batch_dealer_debt'] = array(
    'did' => 'd_id',
    'debt1' => 'd_debt1',
    'debt2' => 'd_debt2',
    'balance' => 'd_balance'
);

$config['dealer/dealer_model/update_batch_dealer_debt2'] = array(
    'did' => 'd_id',
    'debt2' => 'd_debt2'
);

$config['dealer/dealer_model/update_batch_dealer_balance'] = array(
    'did' => 'd_id',
    'balance' => 'd_balance'
);

$config['dealer/dealer_category_model/insert'] = array(
    'name' => 'dc_name',
    'creator' => 'dc_creator',
    'create_datetime' => 'dc_create_datetime'
);

$config['dealer/dealer_category_model/update'] = array(
    'name' => 'dc_name'
);

$config['dealer/dealer_delivery_model/insert'] = array(
    'dealer_id' => 'dd_dealer_id',
    'daid' => 'dd_area_id',
    'delivery_address' => 'dd_address',
    'lid' => 'dd_logistics_id',
    'omid' => 'dd_out_method_id',
    'delivery_linker' => 'dd_name',
    'delivery_phone' => 'dd_phone',
    'creator' => 'dd_creator_id',
    'create_datetime' => 'dd_create_datetime',
    'default' => 'dd_default'
);

$config['dealer/dealer_delivery_model/update'] = array(
    'dealer_id' => 'dd_dealer_id',
    'daid' => 'dd_area_id',
    'delivery_address' => 'dd_address',
    'lid' => 'dd_logistics_id',
    'omid' => 'dd_out_method_id',
    'delivery_linker' => 'dd_name',
    'delivery_phone' => 'dd_phone',
    'default' => 'dd_default'
);

$config['dealer/dealer_linker_model/insert'] = array(
    'name' => 'dl_name',
    'dealer_id' => 'dl_dealer_id',
    'mobilephone' => 'dl_mobilephone',
    'telephone' => 'dl_telephone',
    'email' => 'dl_email',
    'qq' => 'dl_qq',
    'fax' => 'dl_fax',
    'doid' => 'dl_type',
    'creator' => 'dl_creator_id',
    'create_datetime' => 'dl_create_datetime'
);

$config['dealer/dealer_linker_model/update'] = array(
    'name' => 'dl_name',
    'dealer_id' => 'dl_dealer_id',
    'mobilephone' => 'dl_mobilephone',
    'telephone' => 'dl_telephone',
    'email' => 'dl_email',
    'qq' => 'dl_qq',
    'fax' => 'dl_fax',
    'doid' => 'dl_type',
    'primary' => 'dl_primary'
);

$config['dealer/dealer_organization_model/insert'] = array(
    'name' => 'do_name'
);

$config['dealer/dealer_organization_model/update'] = array(
    'name' => 'do_name'
);

$config['dealer/dealer_owner_model/insert'] = array(
    'uid' => 'do_owner_id',
    'did' => 'do_dealer_id',
    'primary' => 'do_primary'
);

$config['dealer/dealer_owner_model/insert_batch'] = array(
    'uid' => 'do_owner_id',
    'did' => 'do_dealer_id',
    'primary' => 'do_primary'
);

$config['dealer/dealer_owner_model/replace_batch'] = array(
    'uid' => 'do_owner_id',
    'did' => 'do_dealer_id',
    'primary' => 'do_primary'
);

$config['dealer/dealer_trace_model/insert'] = array(
    'dealer_id' => 'dt_dealer_id',
    'trace' => 'dt_trace',
    'creator' => 'dt_creator',
    'create_datetime' => 'dt_create_datetime'
);

$config['dealer/my_dealer'] = array(
    'des' => 'd_des',
    'shop' => 'd_shop',
    'aid' => 'd_area_id',
    'address' => 'd_address',
    'dcid' => 'd_company_type_id',
    'pid' => 'd_payterms_id',
    'credit' => 'd_credit',
    'remark' => 'd_remark',
    'owner' => 'd_owner',
    'creator' => 'd_creator_id',
    'create_datetime' => 'd_create_datetime'
);

$config['dealer/payterms_model/insert'] = array(
    'name' => 'p_name'
);

$config['dealer/payterms_model/update'] = array(
    'name' => 'p_name'
);

