<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2015年12月14日
 * @author Zhangcc
 * @version
 * @des
 * 图纸看
 */
$config['drawing/drawing_model/select_drawing'] = array(
    'd_id' => 'did',
    'd_name' => 'name',
    'op_id' => 'opid',
    'op_num' => 'order_product_num',
    'op_product' => 'product',
    'd_path' => 'path'
);

$config['drawing/drawing_model/select_by_opid'] = array(
    'd_path' => 'path'
);