<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: chuangchuangzhang
 * Date: 2017/10/15
 * Time: 09:00
 *
 * Desc:
 */


$config['position/position_model/select_position'] = array(
    'p_id' => 'pid',
    'p_name' => 'name',
    'op_num' => 'order_product_num',
    'p_status' => 'status',
    'if(p_status = 0, "<i class=\"fa fa-circle fa-2x fa-color-success\"></i>", if(p_status=1, "<i class=\"fa fa-circle fa-2x fa-color-warning\"></i>", "<i class=\"fa fa-circle fa-2x fa-color-danger\"></i>"))' => 'icon'
);

$config['position/position_order_product_model/select'] = array(
    'pop_id' => 'popid',
    'pop_status' => 'status',
    'pop_count' => 'count',
    'a.u_name' => 'creator',
    'b.u_name' => 'destroy',
    'pop_create_datetime' => 'create_datetime',
    'pop_destroy_datetime' => 'destroy_datetime',
    'p_name' => 'name',
    'op_num' => 'order_product_num'
);