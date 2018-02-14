<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 2016年1月6日
 * @author Zhangcc
 * @version
 * @des
 */
class Created_order_product_workflow extends Workflow_abstract {
    private $_Source_id;
    private $_CI;
    public function __construct($Source_id){
        $this->_Source_id = $Source_id;
        $this->_CI = &get_instance();
    }
    
    public function create(){
        $this->_Workflow->store_message('新建订单产品');
    }
    
    public function dismantle(){
        $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order_product']['dismantling'], 
                array('dismantler' => $this->_CI->session->userdata('uid')));
        $this->_Workflow->store_message('正在拆订单产品');
        
        /**
         * 订单产品开始拆单时同时更改订单的状态
         */
        $this->_CI->load->model('order/order_model');
        $this->_Workflow->initialize('order', $this->_get_order_id());
        $this->_Workflow->dismantle();
    }
    
    public function dismantled(){
        $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order_product']['dismantled'],
                array('dismantler' => $this->_CI->session->userdata('uid'), 'dismantled_datetime' => date('Y-m-d H:i:s')));
        $this->_Workflow->store_message('已拆订单产品');

        if(!!($Oid = $this->_is_all_dismantled())){
            $this->_CI->load->model('order/order_model');
            $this->_Workflow->initialize('order', $Oid);
            $this->_Workflow->dismantled();
        }
        
    }
    
    private function _get_order_id(){
        $this->_CI->load->model('order/order_product_model');
        if(!!($Query = $this->_CI->order_product_model->select_order_detail_by_opid($this->_Source_id))){
            return $Query['oid'];
        }else{
            return false;
        }
    }
    
    /**
     * 判断该是不是该订单的所有订单产品都已经拆单完毕
     */
    private function _is_all_dismantled(){
        if(!!($Ids = $this->_CI->order_product_model->select_dismantled_by_opids($this->_Source_id))){
            $Workflow = array();
            foreach ($Ids as $key => $value){
                if(1 == $value['dismantled']){
                    $Workflow[] = $value['oid'];
                }
            }
            if(!empty($Workflow)){
                return $Workflow;
            }
        }
        return false;
    }

    public function __call($name, $arguments){
        ;
    }
}