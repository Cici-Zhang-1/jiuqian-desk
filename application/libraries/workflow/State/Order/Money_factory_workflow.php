<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2016年3月24日
 * @author Administrator
 * @version
 * @des
 */
class Money_factory_workflow extends Workflow_abstract {
    private $_Source_id;
    private $_CI;
    public function __construct($Source_id){
        $this->_Source_id = $Source_id;
        $this->_CI = &get_instance();
    }

    public function payed(){
        if(!!($this->_CI->order_model->only_server($this->_Source_id))){
            $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order']['outted']);
            $this->_Workflow->store_message('订单已到厂付款, 服务已完成!');
        }else{
            $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order']['deliveried']);
            $this->_Workflow->store_message('订单已到厂付款, 订单已发货!');
        }
    }

    public function redelivery(){
        $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order']['delivery']);
        $this->_Workflow->store_message('订单重新发货!');
    }

    public function __call($name, $arguments){
        ;
    }
}