<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2016年1月16日
 * @author Administrator
 * @version
 * @des
 * 订单产品已经包装完
 */
class Packed_order_product_workflow extends Workflow_abstract {
    private $_Source_id;

    public function __construct($Source_id){
        $this->_Source_id = $Source_id;
    }

    public function packed(){
        $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order_product']['ined']);
        $this->_Workflow->store_message('订单产品已经入库!');
        
        $this->_Workflow->ined();
    }

    public function print_list(){
        $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order_product']['packed'], array(
            'print_datetime' => date('Y-m-d H:i:s')
        ));
        $this->_Workflow->store_message('订单产品打印清单!');
    }

    public function __call($name, $arguments){
        ;
    }
}