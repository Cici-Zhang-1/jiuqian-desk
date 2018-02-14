<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2015年10月5日
 * @author Zhangcc
 * @version
 * @des
 */

$config['pack/scan/read/order'] = array(
    'op_id' => 'opid',
    'op_num' => 'order_product_num',
    'o_id' => 'oid',
    'o_dealer_name' => 'dealer',
    'o_dealer_linker' => 'dealer_linker',
    'o_dealer_address' => 'dealer_address',
    'o_dealer_phone' => 'dealer_phone',
    'o_owner' => 'owner',
		'o_num' => 'order_num'
);
$config['pack/scan/read/plate'] = array(
    'opbp_id' => 'opbpid',
    'opbp_num' => 'qrcode',
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
    'scanner' => 'scanner',
    'opbp_scan_datetime' => 'scan_datetime',
    'opb_board' => 'board'
);

$config['pack/pack/read'] = array(
    'op_id' => 'opid',
    'status' => 'status',
    'op_scan_start' => 'start_datetime',
    'op_scan_end' => 'end_datetime',
    'o_id' => 'oid',
	'o_num' => 'order_num',
    'o_dealer_name' => 'dealer',
    'o_dealer_linker' => 'dealer_linker',
    'o_dealer_address' => 'dealer_address',
    'o_dealer_phone' => 'dealer_phone',
    'o_owner' => 'owner',
	'p_name' => 'product'
);

$config['pack/pack_detail/read'] = array(
    'opbp_id' => 'opbpid',
    'opbp_num' => 'qrcode',
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
    'scanner' => 'scanner',
    'opbp_scan_datetime' => 'scan_datetime',
    'opb_board' => 'board'
);

$config['pack/lack/read'] = array(
        'op_id' => 'opid',
        'op_flag' => 'flag',
        'o_id' => 'oid',
		'o_num' => 'order_num',
        'o_dealer_name' => 'dealer',
        'o_dealer_linker' => 'dealer_linker',
        'o_dealer_address' => 'dealer_address',
        'o_dealer_phone' => 'dealer_phone',
        'o_owner' => 'owner',
		'op_scan_start' => 'start_datetime',
        'op_scan_end' => 'end_datetime'
);

$config['pack/lack_detail/read'] = array(
        'opbp_id' => 'opbpid',
        'opbp_num' => 'qrcode',
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
