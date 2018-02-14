<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2015年10月26日
 * @author Zhangcc
 * @version
 * @des
 */
 
$config['product/board_model/insert'] = array(
    'name' => 'b_name',
    'length' => 'b_length',
    'width' => 'b_width',
    'thick_id' => 'b_thick',
    'color_id' => 'b_color',
    'nature_id' => 'b_nature',
    'class_id' => 'b_class',
    'supplier_id' => 'b_supplier_id',
    'remark' => 'b_remark'
);

$config['product/board_model/insert_ignore_batch'] = array(
    'name' => 'b_name',
    'length' => 'b_length',
    'width' => 'b_width',
    'thick_id' => 'b_thick',
    'color_id' => 'b_color',
    'nature_id' => 'b_nature',
    'class_id' => 'b_class',
    'supplier_id' => 'b_supplier_id',
    'remark' => 'b_remark'
);

$config['product/board_model/update'] = array(
    'name' => 'b_name',
    'length' => 'b_length',
    'width' => 'b_width',
    'thick_id' => 'b_thick',
    'color_id' => 'b_color',
    'nature_id' => 'b_nature',
    'class_id' => 'b_class',
    'supplier_id' => 'b_supplier_id',
    'remark' => 'b_remark',
    'unit_price' => 'b_unit_price',
    'amount' => 'b_amount'
);

$config['product/board_model/update_batch'] = array(
    'bid' => 'b_id',
    'name' => 'b_name',
    'length' => 'b_length',
    'width' => 'b_width',
    'thick_id' => 'b_thick',
    'color_id' => 'b_color',
    'nature_id' => 'b_nature',
    'class_id' => 'b_class',
    'supplier_id' => 'b_supplier_id',
    'remark' => 'b_remark',
    'unit_price' => 'b_unit_price',
    'amount' => 'b_amount'
);

$config['product/fitting_model/insert_fitting'] = array(
    'type' => 'f_type_id',
    'name' => 'f_name',
    'unit' => 'f_unit',
    'unit_price' => 'f_unit_price',
    'speci' => 'f_speci',
    'together' => 'f_together',
    'supplier' => 'f_supplier_id',
    'creator' => 'f_creator',
    'create_datetime' => 'f_create_datetime'
);

$config['product/fitting_model/update_fitting'] = array(
    'type' => 'f_type_id',
    'name' => 'f_name',
    'unit' => 'f_unit',
    'unit_price' => 'f_unit_price',
    'speci' => 'f_speci',
    'together' => 'f_together',
    'supplier' => 'f_supplier_id',
    'amount' => 'f_amount'
);

$config['product/fitting_model/update_batch'] = array(
    'fid' => 'f_id',
    'type' => 'f_type_id',
    'name' => 'f_name',
    'unit' => 'f_unit',
    'unit_price' => 'f_unit_price',
    'speci' => 'f_speci',
    'together' => 'f_together',
    'supplier' => 'f_supplier_id',
    'amount' => 'f_amount'
);

$config['product/other_model/insert_other'] = array(
    'type' => 'o_type_id',
    'name' => 'o_name',
    'spec' => 'o_spec',
    'unit' => 'o_unit',
    'unit_price' => 'o_unit_price',
    'supplier' => 'o_supplier_id',
    'creator' => 'o_creator',
    'create_datetime' => 'o_create_datetime'
);

$config['product/other_model/update_other'] = array(
    'type' => 'o_type_id',
    'name' => 'o_name',
    'spec' => 'o_spec',
    'unit' => 'o_unit',
    'supplier' => 'o_supplier_id'
);

$config['product/other_model/update_batch'] = array(
    'oid' => 'o_id',
    'unit_price' => 'o_unit_price'
);

$config['product/product_model/insert'] = array(
    'name' => 'p_name',
    'parent' => 'p_parent',
    'class' => 'p_class',
    'code' => 'p_code',
    'remark' => 'p_remark'
);
$config['product/product_model/update'] = array(
    'name' => 'p_name',
    'parent' => 'p_parent',
    'class' => 'p_class',
    'code' => 'p_code',
    'remark' => 'p_remark'
);

$config['product/server_model/insert_server'] = array(
    'type' => 's_type_id',
    'name' => 's_name',
    'unit' => 's_unit',
    'unit_price' => 's_unit_price',
    'creator' => 's_creator',
    'create_datetime' => 's_create_datetime'
);
$config['product/server_model/update_server'] = array(
    'type' => 's_type_id',
    'name' => 's_name',
    'unit' => 's_unit',
    'unit_price' => 's_unit_price'
);
$config['product/server_model/update_batch'] = array(
    'sid' => 's_id',
    'unit_price' => 's_unit_price'
);