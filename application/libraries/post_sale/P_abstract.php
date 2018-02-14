<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2016年1月13日
 * @author Administrator
 * @version
 * @des
 */
abstract class  P_abstract {
    private $_CI;
    public function __construct($CI){
        $this->_CI = $CI;
    }
    
    /**
     * 新建订单产品
     * @param unknown $Oid 订单id号
     * @param unknown $Set 集
     * @param string $Product 产品名称
     * @param string $Code 产品代号
     * @param number $Parent 父类
     */
    protected function _add_order_product($Oid, $Set, $Product = '', $Code = '', $Parent = 0){
        $this->_CI->load->model('order/order_product_model');
        if(!!($Query = $this->_CI->order_product_model->insert_procedure_order_product($Oid, $Code, $Set, $Product, $Parent))){
            $Workflow = array();
            foreach ($Query as $key => $value){
                $Workflow[] = $value['opid'];
            }
            $this->_CI->load->library('workflow/workflow');
            $this->_CI->workflow->initialize('order_product', $Workflow);
            $this->_CI->workflow->create();
        }else{
            $Workflow = false;
        }
        return $Workflow;
    }
    
    /**
     * 编辑订单产品
     * @param unknown $OrderProduct
     * @param unknown $Opid
     */
    protected function _edit_order_product($OrderProduct,$Opid){
        $OrderProduct = gh_escape($OrderProduct);
        $this->_CI->load->model('order/order_product_model');
        $this->_CI->order_product_model->update($OrderProduct, $Opid);
    }
    
    abstract public function read();

    abstract public function edit();
    
    /**
     * 清除已经拆单保存的内容
     */
    abstract public function remove($Id);
}