<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2015年10月24日
 * @author Zhangcc
 * @version
 * @des
 * 订单列表
 */

$config['order/order_model/is_asurable'] = array(
    'o_id' => 'oid'
);
$config['order/order_model/is_checkable'] = array(
    'o_id' => 'oid',
    'o_dealer_id' => 'did',
    'o_sum' => 'sum',
    'o_status' => 'status'
);

$config['order/order_model/is_deliveriable'] = array(
    'o_id' => 'oid',
    'o_num' => 'order_num',
    'o_pack' => 'pack',
    'o_pack_detail' => 'pack_detail',
    'o_dealer' => 'dealer',
    'o_owner' => 'owner',
    'o_remark' => 'remark',
    'o_delivery_area' => 'delivery_area',
    'o_delivery_address' => 'delivery_address',
    'o_delivery_linker' => 'delivery_linker',
    'o_delivery_phone' => 'delivery_phone'
);

$config['order/order_model/is_recheckable'] = array(
    'o_id' => 'oid',
    'o_dealer_id' => 'did',
    'o_sum' => 'sum',
    'o_status' => 'status'
);

$config['order/order_model/is_dismantlable'] = array(
    'o_id' => 'oid',
    'o_status' => 'status',
    'o_sum' => 'sum',
    'o_status' => 'status'
);

$config['order/order_model/is_quotable'] = array(
    'o_id' => 'oid',
    'o_num' => 'order_num',
    'o_dealer_id' => 'did',
    'o_sum' => 'sum',
    'o_payterms' => 'payterms',
    'o_payed_datetime' => 'payed_datetime',
    'd_debt1' => 'debt1',
    'd_debt2' => 'debt2',
    'd_balance' => 'balance'
);

$config['order/order_model/is_redismantlable'] = array(
    'o_id' => 'oid',
    'o_dealer_id' => 'did',
    'o_sum' => 'sum',
    'o_status' => 'status'
);

$config['stock/order_model/is_reoutted'] = array(
    'o_id' => 'oid',
    'o_sum' => 'sum',
    'o_dealer_id' => 'did'
);

$config['order/order_model/is_redeliveriable'] = array(
    'o_id' => 'oid',
    'o_sum' => 'sum',
    'o_dealer_id' => 'did'
);

$config['order/order_model/select_order_sorter'] = array(
    'o_sum' => 'sum',
    'o_sum_detail' => 'sum_detail',
    'o_dealer_id' => 'did',
    'o_dealer' => 'dealer'
);

$config['order/order_model/select_order_predict'] = array(
    'o_sum' => 'sum',
    'o_sum_detail' => 'sum_detail',
    'o_status' => 'status'
);

$config['order/order_model/select_order_asured'] = array(
    'o_sum' => 'sum',
    'o_sum_detail' => 'sum_detail',
    'o_status' => 'status'
);


$config['order/order_model/select_everyday_asured'] = array(
    'o_id' => 'oid',
    'o_num' => 'order_num',
    'o_dealer' => 'dealer',
    'o_owner' => 'owner',
    'u_truename' => 'creator',
    'o_create_datetime' => 'create_datetime',
    'o_asure_datetime' => 'asure_datetime',
    'o_sum' => 'sum',
    'eighteen' => 'eighteen',
    'twentyfive' => 'twentyfive',
    'thirtysix' => 'thirtysix',
    '(eighteen + twentyfive + thirtysix)' => 'total'
);

$config['order/order_model/select_current_workflow'] = array(
    'w_id' => 'wid',
    'w_no' => 'no',
    'w_type' => 'type',
    'w_name' => 'name',
    'w_name_en' => 'name_en',
    'w_file' => 'file'
);

$config['order/order_model/select_money_logistics'] = array(
    'o_id' => 'oid',
    'o_num' => 'order_num',
    'o_sum' => 'sum',
    'o_dealer' => 'dealer',
    'o_owner' => 'owner',
    'o_delivery_area' => 'delivery_area',
    'o_delivery_address' => 'delivery_address',
    'o_delivery_linker' => 'delivery_linker',
    'o_delivery_phone' => 'delivery_phone',
    'o_remark' => 'remark',
    'o_pack' => 'pack',
    'o_logistics' => 'logistics',
    'o_end_datetime' => 'end_datetime',
    'so_id' => 'soid',
    'so_truck' => 'truck',
    'so_train' => 'train',
    'u_truename' => 'creator'
);

$config['order/order_model/select_money_month'] = array(
    'o_id' => 'oid',
    'o_num' => 'order_num',
    'o_sum' => 'sum',
    'o_dealer' => 'dealer',
    'o_owner' => 'owner',
    'o_delivery_area' => 'delivery_area',
    'o_delivery_address' => 'delivery_address',
    'o_delivery_linker' => 'delivery_linker',
    'o_delivery_phone' => 'delivery_phone',
    'o_remark' => 'remark',
    'o_pack' => 'pack',
    'o_logistics' => 'logistics',
    'o_end_datetime' => 'end_datetime',
    'so_id' => 'soid',
    'so_truck' => 'truck',
    'so_train' => 'train',
    'u_truename' => 'creator'
);

$config['order/order_model/select_money_factory'] = array(
    'o_id' => 'oid',
    'o_num' => 'order_num',
    'o_sum' => 'sum',
    'o_dealer' => 'dealer',
    'o_owner' => 'owner',
    'o_delivery_area' => 'delivery_area',
    'o_delivery_address' => 'delivery_address',
    'o_delivery_linker' => 'delivery_linker',
    'o_delivery_phone' => 'delivery_phone',
    'o_remark' => 'remark',
    'o_pack' => 'pack',
    'o_logistics' => 'logistics',
    'o_end_datetime' => 'end_datetime',
    'so_id' => 'soid',
    'so_truck' => 'truck',
    'so_train' => 'train',
    'u_truename' => 'creator'
);

$config['order/order_model/select_deliveried'] = array(
    'o_id' => 'oid',
    'o_num' => 'order_num',
    'o_sum' => 'sum',
    'o_dealer' => 'dealer',
    'o_owner' => 'owner',
    'o_delivery_area' => 'delivery_area',
    'o_delivery_address' => 'delivery_address',
    'o_delivery_linker' => 'delivery_linker',
    'o_delivery_phone' => 'delivery_phone',
    'o_remark' => 'remark',
    'o_pack' => 'pack',
    'o_logistics' => 'logistics',
    'o_end_datetime' => 'end_datetime',
    'so_truck' => 'truck',
    'so_train' => 'train',
    'u_truename' => 'creator'
);

$config['order/order_model/select_for_debt'] = array(
    'o_id' => 'oid',
    'o_num' => 'order_num',
    'o_remark' => 'remark',
    'o_dealer' => 'dealer',
    'o_owner' => 'owner',
    'o_end_datetime' => 'end_datetime',
    'o_asure_datetime' => 'asure_datetime',
    'o_payed_datetime' => 'payed_datetime',
    'o_sum' => 'sum'
);

$config['order/order_model/select'] = array(
    'o_id' => 'oid',
    'o_num' => 'order_num',
    'o_remark' => 'remark',
    'o_dealer_remark' => 'dealer_remark',
    'o_dealer' => 'dealer',
    'o_owner' => 'owner',
    'o_request_outdate' => 'request_outdate',
    'u_truename' => 'creator',
    'o_create_datetime' => 'create_datetime',
    'o_end_datetime' => 'end_datetime',
    'o_asure_datetime' => 'asure_datetime',
    'o_sum' => 'sum',
    'w_name' => 'status',
    'd_id' => 'did',
    'd_balance' => 'balance',
    'o_checker' => 'checker',
    'o_checker_phone' => 'checker_phone',
    'o_payterms' => 'payterms',
    'o_payer' => 'payer',
    'o_payer_phone' => 'payer_phone',
    'o_logistics' => 'logistics',
    'o_out_method' => 'out_method',
    'o_delivery_area' => 'delivery_area',
    'o_delivery_address' => 'delivery_address',
    'o_delivery_linker' => 'delivery_linker',
    'o_delivery_phone' => 'delivery_phone',
    'o_flag' => 'flag',
    'tl_icon' => 'icon'
);

$config['order/order_model/select_order'] = array(
    'o_id' => 'oid',
    'o_num' => 'order_num',
    'o_remark' => 'remark',
    'o_dealer_remark' => 'dealer_remark',
    'o_dealer' => 'dealer',
    'o_owner' => 'owner',
    'o_request_outdate' => 'request_outdate',
    'u_truename' => 'creator',
    'o_create_datetime' => 'create_datetime',
    'o_end_datetime' => 'end_datetime',
    'o_asure_datetime' => 'asure_datetime',
    'o_sum' => 'sum',
    'w_name' => 'status',
    'd_id' => 'did',
    'd_balance' => 'balance',
    'o_checker' => 'checker',
    'o_checker_phone' => 'checker_phone',
    'o_payterms' => 'payterms',
    'o_payer' => 'payer',
    'o_payer_phone' => 'payer_phone',
    'o_logistics' => 'logistics',
    'o_out_method' => 'out_method',
    'o_delivery_area' => 'delivery_area',
    'o_delivery_address' => 'delivery_address',
    'o_delivery_linker' => 'delivery_linker',
    'o_delivery_phone' => 'delivery_phone',
    'o_flag' => 'flag',
    'tl_icon' => 'icon'
);

$config['order/order_model/select_order_warn'] = array(
    'o_id' => 'oid',
    'o_num' => 'order_num',
    'o_remark' => 'remark',
    'o_dealer_id' => 'did',
    'o_dealer' => 'dealer',
    'o_owner' => 'owner',
    'o_request_outdate' => 'request_outdate',
    'u_truename' => 'creator',
    'o_create_datetime' => 'create_datetime',
    'o_asure_datetime' => 'asure_datetime',
    'o_sum' => 'sum',
    'w_name' => 'status',
    'tl_icon' => 'icon'
);

$config['order/order_model/select_order_detail'] = array(
    'o_id' => 'oid',
    'o_num' => 'order_num',
    'o_dealer_id' => 'did',
    'o_dealer' => 'dealer',
    'o_checker' => 'checker',
    'o_checker_phone' => 'checker_phone',
    'o_payterms' => 'payterms',
    'o_payer' => 'payer',
    'o_payer_phone' => 'payer_phone',
    'o_logistics' => 'logistics',
    'o_out_method' => 'out_method',
    'o_delivery_area' => 'delivery_area',
    'o_delivery_address' => 'delivery_address',
    'o_delivery_linker' => 'delivery_linker',
    'o_delivery_phone' => 'delivery_phone',
    'o_owner' => 'owner',
    'o_remark' => 'remark',
    'o_dealer_remark' => 'dealer_remark',
    'o_request_outdate' => 'request_outdate',
    'o_payed_datetime' => 'payed_datetime',
    'o_cargo_no' => 'cargo_no',
    'u_truename' => 'creator',
    'o_create_datetime' => 'create_datetime',
    'o_end_datetime' => 'end_datetime',
    'o_asure_datetime' => 'asure_datetime',
    'o_sum' => 'sum',
    'o_sum_detail' => 'sum_detail',
    'o_status' => 'status',
    'w_name' => 'workflow'
);

$config['order/wait_check/read'] = array(
    'o_id' => 'oid',
    'o_num' => 'order_num',
    'o_dealer_id' => 'did',
    'o_dealer' => 'dealer',
    'o_owner' => 'owner',
    'o_remark' => 'remark',
    'o_request_outdate' => 'request_outdate',
    'o_dismantled_datetime' => 'dismantled_datetime',
    'o_sum' => 'sum',
    'o_sum_detail' => 'sum_detail',
    'tl_icon' => 'icon'
);

$config['order/wait_quote/read'] = array(
    'o_id' => 'oid',
    'o_num' => 'order_num',
    'o_dealer_id' => 'did',
    'o_dealer' => 'dealer',
    'o_payterms' => 'payterms',
    'o_payer' => 'payer',
    'o_payer_phone' => 'payer_phone',
    'o_owner' => 'owner',
    'o_remark' => 'remark',
    'o_request_outdate' => 'request_outdate',
    'o_checked_datetime' => 'checked_datetime',
    'o_sum' => 'sum',
    'd_debt1' => 'debt1',
    'd_debt2' => 'debt2',
    'd_balance' => 'balance',
    'tl_icon' => 'icon'
);

$config['order/wait_asure/read'] = array(
    'o_id' => 'oid',
    'o_num' => 'order_num',
    'o_dealer_id' => 'did',
    'o_dealer' => 'dealer',
    'o_owner' => 'owner',
    'o_remark' => 'remark',
    'o_request_outdate' => 'request_outdate',
    'o_quoted_datetime' => 'quoted_datetime',
    'o_payed_datetime' => 'payed_datetime',
    'o_asure_datetime' => 'asure_datetime',
    'tl_icon' => 'icon'
);

$config['order/money_produce/read'] = array(
    'o_id' => 'oid',
    'o_num' => 'order_num',
    'o_dealer_id' => 'did',
    'o_dealer' => 'dealer',
    'o_payterms' => 'payterms',
    'o_payer' => 'payer',
    'o_payer_phone' => 'payer_phone',
    'o_owner' => 'owner',
    'o_remark' => 'remark',
    'o_request_outdate' => 'request_outdate',
    'o_quoted_datetime' => 'quoted_datetime',
    'o_sum' => 'sum',
    'd_debt1' => 'debt1',
    'd_debt2' => 'debt2',
    'd_balance' => 'balance',
    'tl_icon' => 'icon'
);

$config['order/ining/read'] = array(
    'o_id' => 'oid',
    'o_num' => 'order_num',
    'o_dealer' => 'dealer',
    'o_owner' => 'owner',
    'o_remark' => 'remark',
    'o_request_outdate' => 'request_outdate',
    'o_asure_datetime' => 'asure_datetime',
    'o_pack' => 'pack'
);

$config['order/order_model/select_wait_delivery'] = array(
    'o_id' => 'oid',
    'o_num' => 'order_num',
    'o_sum' => 'sum',
    'o_owner' => 'owner',
    'o_delivery_area' => 'delivery_area',
    'o_delivery_address' => 'delivery_address',
    'o_delivery_linker' => 'delivery_linker',
    'o_delivery_phone' => 'delivery_phone',
    'o_remark' => 'remark',
    'o_request_outdate' => 'request_outdate',
    'o_pack' => 'pack',
    'o_pack_detail' => 'pack_detail',
    'o_logistics' => 'logistics',
    'if(o_payed_datetime > 0, "已付", o_payterms)' => 'payed',
    'd_id' => 'did',
    'd_balance - d_debt2' => 'balance',
    'tl_icon' => 'icon'
);

$config['order/order_model/select_wait_delivery_by_ids'] = array(
    'o_id' => 'oid',
    'o_num' => 'order_num',
    'o_sum' => 'sum',
    'o_dealer_id' => 'did',
    'o_dealer' => 'dealer',
    'o_owner' => 'owner',
    'o_delivery_area' => 'delivery_area',
    'o_delivery_address' => 'delivery_address',
    'o_delivery_linker' => 'delivery_linker',
    'o_delivery_phone' => 'delivery_phone',
    'o_remark' => 'remark',
    'o_pack' => 'pack',
    'o_pack_detail' => 'pack_detail',
    'o_logistics' => 'logistics',
    'if(o_payed_datetime > 0, "已付", o_payterms)' => 'payed',
    'd_balance' => 'balance'
);

$config['order/order_model/select_by_soid'] = array(
    'o_id' => 'oid',
    'o_num' => 'order_num',
    'o_sum' => 'sum',
    'o_dealer_id' => 'did',
    'o_dealer' => 'dealer',
    'o_owner' => 'owner',
    'o_delivery_area' => 'delivery_area',
    'o_delivery_address' => 'delivery_address',
    'o_delivery_linker' => 'delivery_linker',
    'o_delivery_phone' => 'delivery_phone',
    'o_remark' => 'remark',
    'o_pack' => 'pack',
    'o_pack_detail' => 'pack_detail',
    'o_logistics' => 'logistics',
    'if(o_payed_datetime > 0, "已付", o_payterms)' => 'payed',
    'd_balance' => 'balance',
    'o_stock_outted_id' => 'soid',
    'o_cargo_no' => 'cargo_no'
);
$config['order/money_delivery/read'] = array(
    'o_id' => 'oid',
    'o_num' => 'order_num',
    'o_dealer_id' => 'did',
    'o_dealer' => 'dealer',
    'o_payterms' => 'payterms',
    'o_payer' => 'payer',
    'o_payer_phone' => 'payer_phone',
    'o_logistics' => 'logistics',
    'o_delivery_area' => 'delivery_area',
    'o_delivery_address' => 'delivery_address',
    'o_delivery_linker' => 'delivery_linker',
    'o_delivery_phone' => 'delivery_phone',
    'o_owner' => 'owner',
    'o_remark' => 'remark',
    'o_request_outdate' => 'request_outdate',
    'o_asure_datetime' => 'asure_datetime',
    'o_sum' => 'sum',
    'd_debt1' => 'debt1',
    'd_debt2' => 'debt2',
    'd_balance' => 'balance',
    'tl_icon' => 'icon'
);

$config['order/order_model/select_order_stock_logistics'] = array(
    'o_id' => 'oid',
    'o_num' => 'order_num',
    'o_dealer_id' => 'did',
    'o_dealer' => 'dealer',
    'o_payterms' => 'payterms',
    'o_payer' => 'payer',
    'o_payer_phone' => 'payer_phone',
    'o_logistics' => 'logistics',
    'o_delivery_area' => 'delivery_area',
    'o_delivery_address' => 'delivery_address',
    'o_delivery_linker' => 'delivery_linker',
    'o_delivery_phone' => 'delivery_phone',
    'o_owner' => 'owner',
    'o_remark' => 'remark',
    'o_request_outdate' => 'request_outdate',
    'o_asure_datetime' => 'asure_datetime',
    'o_sum' => 'sum',
    'd_debt1' => 'debt1',
    'd_debt2' => 'debt2',
    'd_balance' => 'balance'
);

$config['order/order_model/select_order_dealer_by_id'] = array(
    'o_id' => 'oid',
    'o_sum' => 'sum',
    'o_dealer_id' => 'did'
);

$config['order/order_model/select_order_num'] = array(
    'o_num' => 'order_num',
    'o_sum' => 'sum',
    'ifnull(o_payed_datetime, "")' => 'payed_datetime'
);

$config['order/order_model/select_order_num_by_cargo_no'] = array(
    'o_id' => 'oid',
    'o_num' => 'order_num',
    'o_sum' => 'sum',
    'o_dealer_id' => 'did',
    'o_dealer' => 'dealer',
    'ifnull(o_payed_datetime, "")' => 'payed_datetime'
);

$config['order/order_model/select_status'] = array(
    'o_id' => 'id',
    'o_status' => 'status'
);


/**
 * order_product_model
 */

$config['order/order_product_model/is_dismantlable'] = array(
    'op_id' => 'opid',
    'o_id' => 'oid',
    'p_code' => 'code',
    'op_product' => 'product',
    'op_remark' => 'remark'
);

$config['order/order_product_model/is_post_salable'] = array(
    'op_id' => 'opid',
    'o_id' => 'oid',
    'p_code' => 'code',
    'op_product' => 'product',
    'op_remark' => 'remark'
);

$config['order/order_product_model/is_deliveriable'] = array(
    'op_id' => 'opid',
    'op_num' => 'order_product_num',
    'op_product' => 'product',
    'op_pack' => 'order_pack',
    'op_pack_detail' => 'order_pack_detail',
    'o_num' => 'order_num',
    'o_dealer' => 'dealer',
    'o_owner' => 'owner',
    'o_remark' => 'remark',
    'o_pack' => 'pack',
    'o_delivery_area' => 'delivery_area',
    'o_delivery_address' => 'delivery_address',
    'o_delivery_linker' => 'delivery_linker',
    'o_delivery_phone' => 'delivery_phone'
);

$config['order/order_product_model/is_packable'] = array(
    'op_id' => 'opid',
    'op_num' => 'order_product_num',
    'op_product' => 'product',
    'op_pack' => 'pack',
    'op_pack_detail' => 'pack_detail',
    'op_status' => 'status',
    'o_dealer' => 'dealer',
    'o_owner' => 'owner',
    'o_remark' => 'remark',
    'o_delivery_area' => 'delivery_area',
    'o_delivery_address' => 'delivery_address',
    'o_delivery_linker' => 'delivery_linker',
    'o_delivery_phone' => 'delivery_phone'
);
$config['order/order_product_model/is_redismantlable'] = array(
    'op_id' => 'opid',
    'op_status' => 'status',
    'o_id' => 'oid',
    'o_dealer_id' => 'did',
    'o_sum' => 'sum',
    'o_status' => 'ostatus'
);

$config['order/order_product_model/select_bd'] = array(
    'op_id' => 'opid',
    'op_num' => 'order_product_num',
    'op_product' => 'product',
    'op_remark' => 'order_product_remark',
    'u_truename' => 'dismantler',
    'o_dealer' => 'dealer',
    'o_owner' => 'owner',
    'o_request_outdate' => 'request_outdate',
    'o_asure_datetime' => 'asure_datetime',
    'o_remark' => 'remark'
);

$config['order/order_product_model/select_brothers'] = array(
    'op_id' => 'opid',
    'op_num' => 'order_product_num',
    'op_pack_detail' => 'pack_detail'
);

$config['order/order_product_model/select_current_workflow'] = array(
    'w_id' => 'wid',
    'w_no' => 'no',
    'w_type' => 'type',
    'w_name' => 'name',
    'w_name_en' => 'name_en',
    'w_file' => 'file'
);

$config['order/order_product_model/select_wait_dismantle'] = array(
    'op_id' => 'opid',
    'o_id' => 'oid',
    'op_product_id' => 'pid',
    'op_product' => 'product',
    'op_num' => 'num',
    'op_remark' => 'remark',
    'o_dealer' => 'dealer',
    'o_owner' => 'owner',
    'C.u_truename' => 'creator',
    'B.u_truename' => 'dismantler',
    'op_dismantled_datetime' => 'dismantled_datetime',
    'w_name' => 'status'
);

$config['order/order_product_model/select_pack_detail_by_opids'] = array(
    'op_id' => 'opid',
    'op_pack_detail' => 'pack_detail'
);

$config['order/order_product_model/select_producing'] = array(
    'op_id' => 'opid',
    'o_id' => 'oid',
    'op_product' => 'product',
    'op_num' => 'num',
    'op_remark' => 'remark',
    'o_dealer' => 'dealer',
    'o_owner' => 'owner',
    'o_asure_datetime' => 'asure_datetime',
    'B.u_truename' => 'dismantler'
);

$config['order/order_product_model/select_produce_prehandle'] = array(
    'op_id' => 'opid',
    'o_id' => 'oid',
    'op_product' => 'product',
    'op_num' => 'num',
    'op_remark' => 'remark',
    'o_dealer' => 'dealer',
    'o_owner' => 'owner',
    'o_asure_datetime' => 'asure_datetime',
    'B.u_truename' => 'dismantler'
);

$config['order/order_product_model/select_clear_fitting'] = array(
    'op_id' => 'opid',
    'op_num' => 'order_product_num',
    'op_remark' => 'remark',
    'o_flag' => 'icon',
    'o_dealer' => 'dealer',
    'o_owner' => 'owner',
    'o_asure_datetime' => 'asure_datetime',
    'o_request_outdate' => 'request_outdate'
);

$config['order/order_product_model/select_wait_delivery_by_ids'] = array(
    'op_id' => 'opid',
    'op_product_id' => 'pid',
    'op_num' => 'order_product_num',
    'op_pack' => 'order_product_pack',
    'op_pack_detail' => 'order_product_pack_detail',
    'o_id' => 'oid',
    'o_num' => 'order_num',
    'o_sum' => 'sum',
    'o_dealer_id' => 'did',
    'o_dealer' => 'dealer',
    'o_owner' => 'owner',
    'o_delivery_area' => 'delivery_area',
    'o_delivery_address' => 'delivery_address',
    'o_delivery_linker' => 'delivery_linker',
    'o_delivery_phone' => 'delivery_phone',
    'o_remark' => 'remark',
    'o_pack' => 'pack',
    'o_pack_detail' => 'pack_detail',
    'o_logistics' => 'logistics',
    'if(o_payed_datetime > 0, "已付", o_payterms)' => 'payed',
    'd_balance' => 'balance'
);

$config['order/order_product_model/select_by_soid'] = array(
    'op_id' => 'opid',
    'op_product_id' => 'pid',
    'op_num' => 'order_product_num',
    'op_pack' => 'order_product_pack',
    'o_id' => 'oid',
    'o_num' => 'order_num',
    'o_sum' => 'sum',
    'o_dealer_id' => 'did',
    'o_dealer' => 'dealer',
    'o_owner' => 'owner',
    'o_delivery_area' => 'delivery_area',
    'o_delivery_address' => 'delivery_address',
    'o_delivery_linker' => 'delivery_linker',
    'o_delivery_phone' => 'delivery_phone',
    'o_remark' => 'remark',
    'o_pack' => 'pack',
    'o_pack_detail' => 'pack_detail',
    'o_logistics' => 'logistics',
    'if(o_payed_datetime > 0, "已付", o_payterms)' => 'payed',
    'd_balance' => 'balance'
);
$config['order/order_product_model/select_status'] = array(
    'op_id' => 'id',
    'op_status' => 'status'
);


$config['order/order_product_model/_select_latest_insert_ids'] = array(
    'op_id' => 'opid',
    'op_num' => 'order_product_num'
);

$config['order/order_product_model/select_print_list'] = array(
    'op_id' => 'opid',
    'op_product' => 'product',
    'op_num' => 'order_product_num',
    'op_remark' => 'order_product_remark',
    'op_print_datetime' => 'print_datetime',
    'A.u_truename' => 'dismantler',
    'o_id' => 'oid',
    'o_dealer' => 'dealer',
    'o_owner' => 'owner',
    'o_remark' => 'remark',
    'o_asure_datetime' => 'asure_datetime',
    'o_request_outdate' => 'request_outdate'
);

$config['order/order_product_model/select_pack'] = array(
    'op_id' => 'opid',
    'op_num' => 'order_product_num',
    'op_product' => 'product',
    'op_scan_start' => 'start_date',
    'op_scan_end' => 'end_date',
    'o_dealer' => 'dealer',
    'o_owner' => 'owner',
    'o_remark' => 'remark',
    'if(op_scan_status=0,"未开始", if(op_scan_status = 1, "正在扫", "已扫完"))' => 'status'
);

$config['order/order_product_model/select_pack_statistics'] = array(
    'op_id' => 'opid',
    'op_num' => 'order_product_num',
    'op_product' => 'product',
    'op_pack' => 'pack',
    'A.u_truename' => 'packer',
    'op_pack_datetime' => 'pack_datetime',
    'o_dealer' => 'dealer',
    'o_owner' => 'owner',
    'o_remark' => 'remark',
    'o_asure_datetime' => 'asure_datetime',
    'o_request_outdate' => 'request_outdate'
);

$config['order/order_product_model/select_by_oid'] = array(
    'op_id' => 'opid',
    'p_id' => 'pid',
    'p_name' => 'name',
    'p_code' => 'code',
    'op_parent' => 'parent',
    'op_num' => 'order_product_num',
    'op_product' => 'product',
    'op_remark' => 'remark',
    'op_status' => 'status'
);

$config['order/order_product_model/select_wait_position'] = array(
    'op_id' => 'opid',
    'op_num' => 'order_product_num'
);

$config['order/order_detail/_read_detail'] = array(
    'op_id' => 'opid',
    'p_id' => 'pid',
    'p_name' => 'name',
    'p_code' => 'code',
    'op_parent' => 'parent',
    'op_num' => 'order_product_num',
    'op_product' => 'product',
    'op_remark' => 'remark',
    'w_name' => 'status',
    'op_pack' => 'pack'
);

$config['order/order_quote/_read_detail'] = array(
    'op_id' => 'opid',
    'p_id' => 'pid',
    'p_name' => 'name',
    'p_code' => 'code',
    'op_parent' => 'parent',
    'op_num' => 'order_product_num',
    'op_product' => 'product',
    'op_remark' => 'remark',
    'w_name' => 'status',
    'op_pack' => 'pack'
);

$config['order/ining_detail/_read'] = array(
    'op_id' => 'opid',
    'op_num' => 'order_product_num',
    'op_product' => 'product',
    'op_remark' => 'remark',
    'op_status' => 'status',
    'op_pack' => 'pack',
    'op_pack_datetime' => 'pack_datetime'
);

$config['order/order_product_model/select_order_detail_by_opid'] = array(
    'op_id' => 'opid',
    'p_code' => 'code',
    'op_product' => 'product',
    'op_num' => 'order_product_num',
    'op_sum' => 'order_product_sum',
    'A.u_truename' => 'dismantler',
    'op_parent' => 'parent',
    'op_remark' => 'order_product_remark',
    'o_id' => 'oid',
    'o_num' => 'order_num',
    'o_dealer_id' => 'did',
    'o_dealer' => 'dealer',
    'o_checker' => 'checker',
    'o_checker_phone' => 'checker_phone',
    'o_payterms' => 'payterms',
    'o_payer' => 'payer',
    'o_payer_phone' => 'payer_phone',
    'o_logistics' => 'logistics',
    'o_out_method' => 'out_method',
    'o_delivery_area' => 'delivery_area',
    'o_delivery_address' => 'delivery_address',
    'o_delivery_linker' => 'delivery_linker',
    'o_delivery_phone' => 'delivery_phone',
    'o_owner' => 'owner',
    'o_remark' => 'remark',
    'o_dealer_remark' => 'dealer_remark',
    'o_request_outdate' => 'request_outdate',
    'o_payed_datetime' => 'payed_datetime',
    'o_cargo_no' => 'cargo_no',
    'B.u_truename' => 'creator',
    'o_create_datetime' => 'create_datetime',
    'o_end_datetime' => 'end_datetime',
    'o_asure_datetime' => 'asure_datetime',
    'o_sum' => 'sum',
    'o_sum_detail' => 'sum_detail',
    'o_status' => 'status',
    'w_name' => 'workflow'
);

/**
 * order_product_board
 */
 
$config['order/order_product_board_model/is_exist'] = array(
    'opb_id' => 'opbid',
    'opb_area' => 'area',
    'opb_amount' => 'amount'
);
$config['order/order_product_board_model/select_optimize'] = array(
    'opb_id' => 'opbid',
    'opb_board' => 'board',
    'opb_area' => 'area',
    'opb_amount' => 'amount',
    'opb_optimize' => 'status',
    'opb_optimize_datetime' => 'optimize_datetime',
    'A.u_truename' => 'optimizer',
    'op_num' => 'order_product_num',
    'op_remark' => 'order_product_remark',
    'op_product' => 'product',
    'o_remark' => 'remark',
    'o_dealer' => 'dealer',
    'o_owner' => 'owner',
    'o_request_outdate' => 'request_outdate',
    'o_asure_datetime' => 'asure_datetime',
    'B.u_truename' => 'dismantler'
);

$config['order/order_product_board_model/select_produce'] = array(
    'opb_id' => 'opbid',
    'opb_board' => 'board',
    'opb_area' => 'area',
    'opb_open_hole' => 'open_hole',
    'opb_invisibility' => 'invisibility',
    'o_dealer' => 'dealer',
    'o_owner' => 'owner',
    'o_request_outdate' => 'request_outdate',
    'o_asure_datetime' => 'asure_datetime',
    'op_num' => 'order_product_num'
);

$config['order/order_product_board_model/select_status'] = array(
    'opb_id' => 'id',
    'opb_status' => 'status'
);
$config['order/order_product_board_model/select_check_by_opid'] = array(
    'opb_id' => 'opbid',
    'op_id' => 'opid',
    'opb_board' => 'board',
    'opb_amount' => 'amount',
    'opb_area' => 'area',
    'opb_area_diff' => 'area_diff',
    'if(opb_unit_price = 0, b_unit_price, opb_unit_price)' => 'unit_price',
    'opb_sum' => 'sum',
    'opb_sum_diff' => 'sum_diff',
    'opb_invisibility' => 'invisibility',
    'opb_open_hole' => 'open_hole',
    'opb_invisibility_unit_price' => 'invisibility_unit_price',
    'opb_open_hole_unit_price' => 'open_hole_unit_price',
    'op_num' => 'order_product_num',
    'op_remark' => 'remark'
);

$config['order/order_product_board_model/select_order_product_board_by_opid'] = array(
    'opb_id' => 'opbid',
    'opb_board' => 'board',
    'opb_amount' => 'amount',
    'opb_area' => 'area',
    'opb_unit_price' => 'unit_price',
    'opb_sum' => 'sum'
);

$config['order/order_product_board_model/select_board_predict'] = array(
    'opb_area' => 'area',
    'opb_board' => 'board',
    'op_num' => 'order_product_num',
    'op_product_id' => 'pid',
    'o_status' => 'status'
);

$config['order/order_product_board_model/select_dismantle_area'] = array(
    'sum(opb_area)' => 'area',
    'CONVERT(opb_board,SIGNED)' => 'board',
    'p_name' => 'name'
);


$config['order/order_product_board_model/select_dismantle_area_detail'] = array(
    'op_num' => 'num',
    'opb_area' => 'area',
    'opb_board' => 'board',
    'p_name' => 'name',
    'o_dismantled_datetime' => 'dismantled_datetime'
);

$config['order/order_product_board_model/select_by_oid'] = array(
    'opb_id' => 'opbid',
    'opb_board' => 'board',
    'p_code' => 'code',
    'op_id' => 'opid'
);

/**
 * order_product_classify
 */
$config['order/order_product_classify_model/select'] = array(
    'opc_id' => 'opcid',
    'opc_board' => 'board',
    'opc_area' => 'area',
    'opc_amount' => 'amount',
    'opc_optimize' => 'status',
    'opc_optimize_datetime' => 'optimize_datetime',
    'op_num' => 'order_product_num',
    'op_remark' => 'order_product_remark',
    'o_remark' => 'remark',
    'o_dealer' => 'dealer',
    'o_owner' => 'owner',
    'o_request_outdate' => 'request_outdate',
    'c_name' => 'classify'
);

$config['order/order_product_classify_model/select_optimize'] = array(
    'opc_id' => 'opcid',
    'opc_board' => 'board',
    'opc_area' => 'area',
    'opc_amount' => 'amount',
    'opc_optimize' => 'status',
    'opc_optimize_datetime' => 'optimize_datetime',
    'A.u_truename' => 'optimizer',
    'op_num' => 'order_product_num',
    'op_remark' => 'order_product_remark',
    'op_product' => 'product',
    'o_remark' => 'remark',
    'o_dealer' => 'dealer',
    'o_owner' => 'owner',
    'o_request_outdate' => 'request_outdate',
    'o_asure_datetime' => 'asure_datetime',
    'B.u_truename' => 'dismantler',
    'c_name' => 'classify'
);

$config['order/order_product_classify_model/select_current_workflow'] = array(
    'w_id' => 'wid',
    'w_no' => 'no',
    'w_type' => 'type',
    'w_name' => 'name',
    'w_name_en' => 'name_en',
    'w_file' => 'file'
);

$config['order/order_product_classify_model/select_electric_saw'] = array(
    'opc_id' => 'opcid',
    'opc_board' => 'board',
    'opc_area' => 'area',
    'opc_amount' => 'amount',
    'opc_optimize' => 'status',
    'opc_optimize_datetime' => 'optimize_datetime',
    'op_num' => 'order_product_num',
    'op_remark' => 'order_product_remark',
    'o_remark' => 'remark',
    'o_dealer' => 'dealer',
    'o_owner' => 'owner',
    'o_request_outdate' => 'request_outdate',
    'c_name' => 'classify'
);
/**
 * order_product_board_plate
 */

$config['order/order_product_board_plate_model/is_uploaded'] = array(
    'opbp_id' => 'opbpid',
    'opbp_order_product_board_id' => 'opbid',
    'opbp_area' => 'plate_area',
    'opb_area' => 'area'
);

$config['order/order_product_board_plate_model/select_optimize'] = array(
    'opbp_id' => 'opbpid',
    'opbp_qrcode' => 'qrcode',
    'opbp_cubicle_name' => 'cubicle_name',
    'opbp_cubicle_num' => 'cubicle_num',
    'opbp_plate_name' => 'plate_name',
    'opbp_plate_num' => 'plate_num',
    'opbp_width' => 'width',
    'opbp_length' => 'length',
    'opbp_thick' => 'thick',
    'opbp_slot' => 'slot',
    'opbp_punch' => 'punch',
    'opbp_edge' => 'edge',
    'opbp_remark' => 'remark',
    'opbp_decide_size' => 'decide_size',
    'if(opbp_abnormity = 0, "", "异")' => 'abnormity',
    'opbp_up_edge' => 'up_edge',
    'opbp_down_edge' => 'down_edge',
    'opbp_left_edge' => 'left_edge',
    'opbp_right_edge' => 'right_edge',
    'opc_board' => 'board',
    'opc_optimize' => 'status',
    'opc_sn' => 'sn',
    'op_num' => 'order_product_num',
    'op_product' => 'product',
    'o_dealer' => 'dealers',
    'd_shop' => 'shop',
    'o_owner' => 'owner'
);

$config['order/order_product_board_plate_model/select_optimize_produce_prehandle'] = array(
    'opbp_id' => 'opbpid',
    'opbp_qrcode' => 'qrcode',
    'opbp_cubicle_name' => 'cubicle_name',
    'opbp_cubicle_num' => 'cubicle_num',
    'opbp_plate_name' => 'plate_name',
    'opbp_plate_num' => 'plate_num',
    'opbp_width' => 'width',
    'opbp_length' => 'length',
    'opbp_thick' => 'thick',
    'opbp_slot' => 'slot',
    'opbp_punch' => 'punch',
    'opbp_edge' => 'edge',
    'opbp_remark' => 'remark',
    'opbp_decide_size' => 'decide_size',
    'if(opbp_abnormity = 0, "", "异")' => 'abnormity',
    'opbp_up_edge' => 'up_edge',
    'opbp_down_edge' => 'down_edge',
    'opbp_left_edge' => 'left_edge',
    'opbp_right_edge' => 'right_edge',
    'opc_board' => 'board',
    'opc_optimize' => 'status',
    'opc_sn' => 'sn',
    'op_num' => 'order_product_num',
    'o_dealer' => 'dealers',
    'o_owner' => 'owner'
);

$config['order/order_product_board_plate_model/select_optimize_produce_prehandled'] = array(
    'opbp_id' => 'opbpid',
    'opbp_qrcode' => 'qrcode',
    'opbp_cubicle_name' => 'cubicle_name',
    'opbp_cubicle_num' => 'cubicle_num',
    'opbp_plate_name' => 'plate_name',
    'opbp_plate_num' => 'plate_num',
    'opbp_width' => 'width',
    'opbp_length' => 'length',
    'opbp_thick' => 'thick',
    'opbp_slot' => 'slot',
    'opbp_punch' => 'punch',
    'opbp_edge' => 'edge',
    'opbp_remark' => 'remark',
    'opbp_decide_size' => 'decide_size',
    'if(opbp_abnormity = 0, "", "异")' => 'abnormity',
    'opbp_up_edge' => 'up_edge',
    'opbp_down_edge' => 'down_edge',
    'opbp_left_edge' => 'left_edge',
    'opbp_right_edge' => 'right_edge',
    'opc_board' => 'board',
    'opc_optimize' => 'status',
    'opc_sn' => 'sn',
    'op_num' => 'order_product_num',
    'o_dealer' => 'dealers',
    'o_owner' => 'owner'
);

$config['order/order_product_board_plate_model/select_label'] = array(
    'opbp_qrcode' => 'qrcode',
    'opbp_cubicle_name' => 'cubicle_name',
    'opbp_plate_name' => 'plate_name',
    'opbp_width' => 'width',
    'opbp_length' => 'length',
    'opbp_slot' => 'slot',
    'opbp_punch' => 'punch',
    'opbp_edge' => 'edge',
    'opbp_remark' => 'remark',
    'opbp_decide_size' => 'decide_size',
    'opbp_up_edge' => 'up_edge',
    'opbp_down_edge' => 'down_edge',
    'opbp_left_edge' => 'left_edge',
    'opbp_right_edge' => 'right_edge',
    'opc_board' => 'board',
    'opc_optimize' => 'status',
    'opc_sn' => 'sn',
    'op_num' => 'order_product_num',
    'o_dealer' => 'dealer',
    'o_owner' => 'owner'
);

$config['order/order_product_board_plate_model/select_classify_label'] = array(
    'opbp_qrcode' => 'qrcode',
    'opbp_cubicle_name' => 'cubicle_name',
    'opbp_plate_name' => 'plate_name',
    'opbp_width' => 'width',
    'opbp_length' => 'length',
    'opbp_slot' => 'slot',
    'opbp_punch' => 'punch',
    'opbp_edge' => 'edge',
    'opbp_remark' => 'remark',
    'opbp_decide_size' => 'decide_size',
    'opbp_up_edge' => 'up_edge',
    'opbp_down_edge' => 'down_edge',
    'opbp_left_edge' => 'left_edge',
    'opbp_right_edge' => 'right_edge',
    'opc_board' => 'board',
    'opc_optimize' => 'status',
    'op_num' => 'order_product_num',
    'o_dealer' => 'dealer',
    'o_owner' => 'owner'
);
$config['order/order_product_board_plate_model/select_order_product_board_plate_by_opid'] = array(
    'opbp_qrcode' => 'qrcode',
    'opbp_cubicle_name' => 'cubicle_name',
    'opbp_cubicle_num' => 'cubicle_num',
    'opbp_plate_name' => 'plate_name',
    'opbp_plate_num' => 'plate_num',
    'opbp_width' => 'width',
    'opbp_length' => 'length',
    'opbp_thick' => 'thick',
    'opbp_amount' => 'amount',
    'opbp_area' => 'area',
    'opbp_slot' => 'slot',
    'opbp_edge' => 'edge',
    'opbp_punch' => 'punch',
    'opbp_abnormity' => 'abnormity',
    'opbp_remark' => 'remark',
    'opbp_decide_size' => 'decide_size',
    'opb_board' => 'good',
    'opbp_amount' => 'num',
    'opbp_right_edge' => 'right_edge',
    'opbp_left_edge' => 'left_edge',
    'opbp_up_edge' => 'up_edge',
    'opbp_down_edge' => 'down_edge',
    'opbp_bd_file' => 'bd_file'
);

$config['order/order_product_board_plate_model/select_order_product_board_plate_abnormity_by_opid'] = array(
    'opbp_qrcode' => 'qrcode',
    'opbp_cubicle_name' => 'cubicle_name',
    'opbp_cubicle_num' => 'cubicle_num',
    'opbp_plate_name' => 'plate_name',
    'opbp_plate_num' => 'plate_num',
    'opbp_width' => 'width',
    'opbp_length' => 'length',
    'opbp_thick' => 'thick',
    'opbp_amount' => 'amount',
    'opbp_area' => 'area',
    'opbp_slot' => 'slot',
    'opbp_edge' => 'edge',
    'opbp_punch' => 'punch',
    'opbp_abnormity' => 'abnormity',
    'opbp_remark' => 'remark',
    'opbp_decide_size' => 'decide_size',
    'opb_board' => 'good',
    'opbp_amount' => 'num',
    'opbp_right_edge' => 'right_edge',
    'opbp_left_edge' => 'left_edge',
    'opbp_up_edge' => 'up_edge',
    'opbp_down_edge' => 'down_edge',
    'opbp_bd_file' => 'bd_file'
);


$config['order/order_product_board_plate_model/select_classify_print_list'] = array(
    'opbp_cubicle_name' => 'cubicle_name',
    'opbp_cubicle_num' => 'cubicle_num',
    'opbp_plate_name' => 'plate_name',
    'opbp_plate_num' => 'plate_num',
    'opbp_width' => 'width',
    'opbp_length' => 'length',
    'opbp_thick' => 'thick',
    'opbp_amount' => 'amount',
    'opbp_area' => 'area',
    'opbp_slot' => 'slot',
    'opbp_edge' => 'edge',
    'opbp_punch' => 'punch',
    'opbp_remark' => 'remark',
    'opbp_decide_size' => 'decide_size',
    'opc_board' => 'good',
    'opbp_amount' => 'num',
    'opbp_right_edge' => 'right_edge',
    'opbp_left_edge' => 'left_edge',
    'opbp_up_edge' => 'up_edge',
    'opbp_down_edge' => 'down_edge'
);

$config['order/order_product_board_plate_model/select_qrcode'] = array(
    'opbp_id' => 'opbpid',
    'opbp_cubicle_num' => 'cubicle_num',
    'opbp_plate_num' => 'plate_num',
    'opbp_plate_name' => 'plate_name',
    'opbp_width' => 'width',
    'opbp_length' => 'length',
    'opbp_thick' => 'thick',
    'opbp_slot' => 'slot',
    'opbp_edge' => 'edge',
    'opbp_remark' => 'remark',
    'opbp_decide_size' => 'decide_size',
    'opbp_amount' => 'amount',
    'opbp_area' => 'area',
    'opbp_bd_file' => 'bd_file',
    'opb_board' => 'board',
    'op_id' => 'opid',
    'op_num' => 'order_product_num',
    'op_bd' => 'bd',
    'opbp_qrcode' => 'qrcode'
);

$config['order/order_product_board_plate_model/select_qrcode_by_opid'] = array(
    'opbp_id' => 'opbpid',
    'opbp_cubicle_num' => 'cubicle_num',
    'opbp_plate_num' => 'plate_num',
    'opbp_plate_name' => 'plate_name',
    'opbp_width' => 'width',
    'opbp_length' => 'length',
    'opbp_thick' => 'thick',
    'opbp_slot' => 'slot',
    'opbp_edge' => 'edge',
    'opbp_remark' => 'remark',
    'opbp_decide_size' => 'decide_size',
    'opbp_amount' => 'amount',
    'opbp_area' => 'area',
    'opb_board' => 'board',
    'op_id' => 'opid',
    'op_num' => 'order_product_num',
    'op_bd' => 'bd',
    'opbp_qrcode' => 'qrcode'
);

$config['order/order_product_board_plate_model/select_scan'] = array(
    'op_id' => 'opid',
    'op_num' => 'order_product_num',
    'o_id' => 'oid',
    'o_dealer' => 'dealer',
    'o_owner' => 'owner',
	'o_num' => 'order_num',
    'op_scan_status' => 'scan_status'
);

$config['order/order_product_board_plate_model/select_scan_list'] = array(
    'opbp_id' => 'opbpid',
    'opbp_qrcode' => 'qrcode',
    'opbp_cubicle_name' => 'cubicle_name',
    'opbp_cubicle_num' => 'cubicle_num',
    'opbp_plate_name' => 'plate_name',
    'opbp_plate_num' => 'plate_num',
    'opbp_width' => 'width',
    'opbp_length' => 'length',
    'opbp_thick' => 'thick',
    'opbp_area' => 'area',
    'opbp_slot' => 'slot',
    'opbp_punch' => 'punch',
    'opbp_edge' => 'edge',
    'opbp_remark' => 'remark',
    'opbp_decide_size' => 'decide_size',
    'u_truename' => 'scanner',
    'if(opbp_scan_datetime = "0000-00-00 00:00:00", "", opbp_scan_datetime)' => 'scan_datetime',
    'opb_board' => 'board'
);

$config['order/order_product_board_plate_model/select_scan_lack'] = array(
    'op_id' => 'opid',
    'op_num' => 'order_product_num',
    'op_scan_start' => 'scan_start',
    'op_scan_end' => 'scan_end',
    'o_dealer' => 'dealer',
    'o_owner' => 'owner',
    'opb_board' => 'board',
    'count(opb_id)' => 'amount'
);

$config['order/order_product_board_plate_model/select_scan_lack_detail'] = array(
    'opbp_id' => 'opbpid',
    'opbp_qrcode' => 'qrcode',
    'opbp_cubicle_name' => 'cubicle_name',
    'opbp_plate_name' => 'plate_name',
    'opbp_width' => 'width',
    'opbp_length' => 'length',
    'opbp_thick' => 'thick',
    'opbp_area' => 'area',
    'opbp_slot' => 'slot',
    'opbp_punch' => 'punch',
    'opbp_edge' => 'edge',
    'opbp_remark' => 'remark',
    'opbp_decide_size' => 'decide_size',
    'opb_board' => 'board'
);


$config['order/order_product_board_plate_model/select_produce_prehandled'] = array(
    'opbp_id' => 'opbpid',
    'opbp_qrcode' => 'qrcode',
    'opbp_cubicle_name' => 'cubicle_name',
    'opbp_cubicle_num' => 'cubicle_num',
    'opbp_plate_name' => 'plate_name',
    'opbp_plate_num' => 'plate_num',
    'opbp_width' => 'width',
    'opbp_length' => 'length',
    'opbp_thick' => 'thick',
    'opbp_area' => 'area',
    'opbp_slot' => 'slot',
    'opbp_punch' => 'punch',
    'opbp_edge' => 'edge',
    'opbp_remark' => 'remark',
    'opbp_decide_size' => 'decide_size',
    'opc_board' => 'board',
    'c_name' => 'classify',
    'c_id' => 'classify_id'
);
/**
 * order_product_door_model
 */
$config['order/order_product_door_model/select_order_product_door_by_opid'] = array(
    'opd_id' => 'opdid',
    'b_id' => 'bid',
    'b_name' => 'board',
    'opd_edge' => 'edge'
);

/**
 * order_product_board_door_model
 */
$config['order/order_product_board_door_model/select_order_product_board_door_by_opid'] = array(
    'opbd_qrcode' => 'qrcode',
    'opbd_width' => 'width',
    'opbd_length' => 'length',
    'opbd_thick' => 'thick',
    'opbd_area' => 'area',
    'opbd_punch' => 'punch',
    'opbd_remark' => 'remark',
    'opb_board' => 'good',
    'opbd_amount' => 'num',
    'opbd_handle' => 'handle',
    'opbd_open_hole' => 'open_hole',
    'opbd_invisibility' => 'invisibility',
    'opbd_right_edge' => 'right_edge',
    'opbd_left_edge' => 'left_edge',
    'opbd_up_edge' => 'up_edge',
    'opbd_down_edge' => 'down_edge'
);

/**
 * order_product_door_plate
 */
$config['order/order_product_door_plate/read'] = array(
    'opdp_id' => 'opdpid',
    'opdp_num' => 'num',
    'opdp_cubicle_name' => 'cubicle_name',
    'opdp_cubicle_num' => 'cubicle_num',
    'opdp_plate_name' => 'plate_name',
    'opdp_plate_num' => 'plate_num',
    'opdp_width' => 'width',
    'opdp_length' => 'length',
    'opdp_thick' => 'thick',
    'opdp_handle' => 'handle',
    'opdp_punch' => 'punch',
    'opdp_open_hole' => 'open_hole',
    'opdp_invisibility' => 'invisibility',
    'opdp_remark' => 'remark',
    'opdp_color' => 'color',
    'opdp_amount' => 'amount',
    'opdp_spec' => 'spec'
);
/**
 * order_product_board_wood_model
 */
$config['order/order_product_board_wood_model/select_order_product_board_wood_by_opid'] = array(
    'opbw_qrcode' => 'qrcode',
    'opbw_wood_name' => 'wood_name',
    'opbw_width' => 'width',
    'opbw_length' => 'length',
    'opbw_thick' => 'thick',
    'opbw_area' => 'area',
    'opbw_punch' => 'punch',
    'opbw_remark' => 'remark',
    'opb_board' => 'good',
    'opbw_amount' => 'num',
    'opbw_center' => 'center',
    'opbw_core' => 'core'
);
/**
 * order_product_cabinet_model
 */
$config['order/order_product_cabinet_model/select_order_product_cabinet_by_opcsid'] = array(
    'opc_beiban' => 'bb',
    'opc_width' => 'width',
    'opc_depth' => 'depth',
    'opc_height' => 'height',
    'opc_cubicle_name' => 'name',
    'opc_cubicle_num' => 'no',
    'opc_amount' => 'num',
    'opc_right_depth' => 'yqjdepth',
    'opc_right_width' => 'yqjwidth',
    'opc_left_depth' => 'zqjdepth',
    'opc_left_width' => 'zqjwidth',
    'opc_ybilu' => 'ybl',
    'opc_zbilu' => 'zbl',
    'opc_diguiabnormity' => 'diguiabnormity',
    'opc_gebangu' => 'gbg',
    'opc_gebanhuo' => 'gbh',
    'opc_gebanjian' => 'gbj',
    'opc_size' => 'size',
    'opc_weibolu' => 'wbl'
);
/**
 * order_product_cabinet_struct_model
 */
$config['order/order_product_cabinet_struct_model/select_order_product_cabinet_struct_by_opid'] = array(
    'opcs_id' => 'opcsid',
    'b_id' => 'bid',
    'b_name' => 'board',
    'opcs_dgjg' => 'dgjg',
    'opcs_dghc' => 'dghc',
    'opcs_dgqc' => 'dgqc',
    'opcs_facefb' => 'facefb',
    'opcs_struct' => 'struct'
);
/**
 * order_product_wardrobe_struct_model
 */
$config['order/order_product_wardrobe_struct_model/select_order_product_wardrobe_struct_by_opid'] = array(
    'opws_id' => 'opwsid',
    'b_id' => 'bid',
    'b_name' => 'board',
    'opcs_struct' => 'struct'
);
/**
 * order_product_server_model
 */
$config['order/order_product_server_model/select_order_product_server_by_opid'] = array(
    'ops_server_id' => 'sid',
    'p_name' => 'type',
    'ops_server' => 'name',
    'ops_unit' => 'unit',
    'ops_amount' => 'amount',
    'ops_unit_price' => 'unit_price',
    'ops_sum' => 'sum',
    'ops_remark' => 'remark'
);

$config['order/order_product_server_model/select_check_by_opid'] = array(
    'ops_id' => 'opsid',
    'op_id' => 'opid',
    'p_name' => 'type',
    'ops_server' => 'server',
    'ops_amount' => 'amount',
    'ops_unit' => 'unit',
    'if(ops_unit_price = 0, s_unit_price, ops_unit_price)' => 'unit_price',
    'ops_sum' => 'sum',
    'ops_remark' => 'remark',
    'op_num' => 'order_product_num',
    'op_remark' => 'remarks'
);

/**
 * order_product_fitting_model
 */
$config['order/order_product_fitting_model/select_order_product_fitting_by_opid'] = array(
    'opf_id' => 'opfid',
    'opf_fitting_id' => 'fid',
    'p_name' => 'type',
    'opf_fitting' => 'name',
    'opf_unit' => 'unit',
    'opf_amount' => 'amount',
    'opf_unit_price' => 'unit_price',
    'opf_sum' => 'sum',
    'opf_remark' => 'remark',
    'op_num' => 'order_product_num',
    'o_dealer' => 'dealer'
);
$config['order/order_product_fitting_model/select_check_by_opid'] = array(
    'opf_id' => 'opfid',
    'op_id' => 'opid',
    'p_name' => 'type',
    'opf_fitting' => 'fitting',
    'opf_amount' => 'amount',
    'opf_unit' => 'unit',
    'if(opf_unit_price = 0, f_unit_price, opf_unit_price)' => 'unit_price',
    'opf_sum' => 'sum',
    'opf_remark' => 'remark',
    'op_num' => 'order_product_num',
    'op_remark' => 'remarks'
);
/**
 * order_product_other_model
 */
$config['order/order_product_other_model/select_order_product_other_by_opid'] = array(
    'opo_other_id' => 'oid',
    'p_name' => 'type',
    'opo_other' => 'name',
    'opo_spec' => 'spec',
    'opo_unit' => 'unit',
    'opo_amount' => 'amount',
    'opo_unit_price' => 'unit_price',
    'opo_sum' => 'sum',
    'opo_remark' => 'remark'
);
$config['order/order_product_other_model/select_check_by_opid'] = array(
    'opo_id' => 'opoid',
    'op_id' => 'opid',
    'p_name' => 'type',
    'opo_other' => 'other',
    'opo_spec' => 'spec',
    'opo_unit' => 'unit',
    'if(opo_unit_price = 0, o_unit_price, opo_unit_price)' => 'unit_price',
    'opo_amount' => 'amount',
    'opo_sum' => 'sum',
    'opo_remark' => 'remark',
    'op_num' => 'order_product_num',
    'op_remark' => 'remarks'
);

/**
 * order_product_detail
 */
$config['order/order_product_detail/_read_w'] = array(
    'opbp_id' => 'opbpid',
    'opbp_qrcode' => 'qrcode',
    'opbp_cubicle_name' => 'cubicle_name',
    'opbp_cubicle_num' => 'cubicle_num',
    'opbp_plate_name' => 'plate_name',
    'opbp_plate_num' => 'plate_num',
    'opbp_width' => 'width',
    'opbp_length' => 'length',
    'opbp_thick' => 'thick',
    'opbp_slot' => 'slot',
    'opbp_punch' => 'punch',
    'opbp_edge' => 'edge',
    'opbp_remark' => 'remark',
    'opb_board' => 'board'
);

$config['order/order_product_detail/_read_y'] = array(
    'opbp_id' => 'opbpid',
    'opbp_num' => 'num',
    'opbp_cubicle_name' => 'cubicle_name',
    'opbp_cubicle_num' => 'cubicle_num',
    'opbp_plate_name' => 'plate_name',
    'opbp_plate_num' => 'plate_num',
    'opbp_width' => 'width',
    'opbp_length' => 'length',
    'opbp_thick' => 'thick',
    'opbp_slot' => 'slot',
    'opbp_punch' => 'punch',
    'opbp_edge' => 'edge',
    'opbp_remark' => 'remark',
    'opbp_decide_size' => 'decide_size',
    'opb_board' => 'board'
);

$config['order/order_product_detail/_read_m'] = array(
    'opdp_id' => 'opdpid',
    'opdp_width' => 'width',
    'opdp_length' => 'length',
    'opdp_thick' => 'thick',
    'opdp_handle' => 'handle',
    'opdp_punch' => 'punch',
    'opdp_open_hole' => 'open_hole',
    'opdp_invisibility' => 'invisibility',
    'opdp_remark' => 'remark',
    'opdp_color' => 'color',
    'opdp_amount' => 'amount'
);

$config['order/order_product_detail/_read_k'] = array(
    'opdp_id' => 'opdpid',
    'opdp_plate_name' => 'plate_name',
    'opdp_width' => 'width',
    'opdp_length' => 'length',
    'opdp_thick' => 'thick',
    'opdp_punch' => 'punch',
    'opdp_remark' => 'remark',
    'opdp_color' => 'color',
    'opdp_amount' => 'amount',
    'opdp_spec' => 'spec'
);

$config['order/order_product_detail/_read_p'] = array(
    'opf_id' => 'opfid',
    'opf_type' => 'type',
    'opf_name' => 'name',
    'opf_amount' => 'amount',
    'opf_unit' => 'unit',
    'opf_remark' => 'remark'
);

$config['order/order_product_detail/_read_g'] = array(
    'opo_id' => 'opoid',
    'opo_name' => 'name',
    'opo_length' => 'length',
    'opo_width' => 'width',
    'opo_amount' => 'amount',
    'opo_remark' => 'remark',
    'op_order_id' => 'oid'
);