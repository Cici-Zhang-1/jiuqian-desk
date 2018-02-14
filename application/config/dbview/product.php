<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2015年10月26日
 * @author Zhangcc
 * @version
 * @des
 */

$config['product/board_model/select'] = array(
    'b_id' => 'bid',
    'b_name' => 'name',
    'b_length' => 'length',
    'b_width' => 'width',
    'concat(bt_id,"-",bt_name)' => 'thick_id',
    'bt_name' => 'thick',
    'concat(A.bc_id, "-", A.bc_name)' => 'color_id',
    'A.bc_name' => 'color',
    'concat(bn_id, "-", bn_name)' => 'nature_id',
    'bn_name' => 'nature',
    'concat(B.bc_id, "-", B.bc_name)' => 'class_id',
    'B.bc_name' => 'class',
    'concat(s_id, "-", s_name)' => 'supplier_id',
    's_name' => 'supplier',
    'b_remark' => 'remark',
    'b_unit_price' => 'unit_price',
    'b_amount' => 'amount'
);

$config['product/board_model/select_stock'] = array(
    'b_id' => 'bid',
    'b_name' => 'name',
    'bt_name' => 'thick',
    'b_remark' => 'remark',
    'b_amount' => 'amount'
);
$config['product/fitting_model/select_fitting'] = array(
    'f_id' => 'fid',
    'f_type_id' => 'type',
    'f_name' => 'name',
    'f_unit' => 'unit',
    'f_unit_price' => 'unit_price',
    'f_amount' => 'amount',
    'f_speci' => 'speci',
    'f_together' => 'together',
    's_id' => 'sid',
    's_name' => 'supplier',
    'p_name' => 'product'
);

$config['product/product_model/select'] = array(
    'p_id' => 'pid',
    'p_name' => 'name',
    'p_parent' => 'parent',
    'p_class' => 'class',
    'p_code' => 'code',
    'p_remark' => 'remark'
);

$config['product/product_model/select_product_code_by_id'] = array(
    'p_id' => 'pid',
    'p_code' => 'code',
    'p_name' => 'name'
);

$config['product/other_model/select_other'] = array(
    'o_id' => 'oid',
    'o_type_id' => 'type',
    'o_name' => 'name',
    'o_spec' => 'spec',
    'o_unit' => 'unit',
    'o_unit_price' => 'unit_price',
    's_id' => 'sid',
    's_name' => 'supplier',
    'p_name' => 'product'
);

$config['product/product_model/select_post_salable'] = array(
    'p_id' => 'pid',
    'p_name' => 'name',
    'p_parent' => 'parent',
    'p_class' => 'class',
    'p_code' => 'code',
    'p_remark' => 'remark'
);

$config['product/product_model/select_undelete'] = array(
    'p_id' => 'pid',
    'p_name' => 'name',
    'p_parent' => 'parent',
    'p_class' => 'class',
    'p_code' => 'code',
    'p_remark' => 'remark'
);

$config['product/server_model/select_server'] = array(
    's_id' => 'sid',
    's_type_id' => 'type',
    's_name' => 'name',
    's_unit' => 'unit',
    's_unit_price' => 'unit_price',
    'p_name' => 'product'
);
