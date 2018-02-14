<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: chuangchuangzhang
 * Date: 2017/10/17
 * Time: 09:50
 *
 * Desc:
 */

$config['position/position_model/insert_position'] = array(
    'name' => 'p_name',
    'status' => 'p_status',
    'creator' => 'p_creator',
    'create_datetime' => 'p_create_datetime'
);

$config['position/position_model/update_position'] = array(
    'name' => 'p_name',
    'status' => 'p_status',
);

$config['position/position_order_product_model/insert'] = array(
    'selected' => 'pop_position_id',
    'opid' => 'pop_order_product_id',
    'status' => 'pop_status',
    'count' => 'pop_count',
    'creator' => 'pop_creator',
    'create_datetime' => 'pop_create_datetime'
);


$config['position/position_order_product_model/insert_batch'] = array(
    'selected' => 'pop_position_id',
    'opid' => 'pop_order_product_id',
    'status' => 'pop_status',
    'count' => 'pop_count',
    'creator' => 'pop_creator',
    'create_datetime' => 'pop_create_datetime'
);


$config['position/position_order_product_model/update'] = array(
    'status' => 'pop_status',
    'count' => 'pop_count',
    'destroy' => 'pop_destroy',
    'destroy_datetime' => 'pop_destroy_datetime'
);


$config['position/position_order_product_model/update_after_out'] = array(
    'status' => 'pop_status',
    'destroy' => 'pop_destroy',
    'destroy_datetime' => 'pop_destroy_datetime'
);

$config['position/position_order_product_model/delete'] = array(
    'status' => 'pop_status',
    'destroy' => 'pop_destroy',
    'destroy_datetime' => 'pop_destroy_datetime'
);
