<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2016年1月18日
 * @author Zhangcc
 * @version
 * @des
 * 已发货
 */
class Deliveried_workflow extends Workflow_abstract {
    private $_Source_id;
    private $_CI;
    public function __construct($Source_id){
        $this->_Source_id = $Source_id;
        $this->_CI = &get_instance();
    }

    public function outted(){
        $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order']['outted']);
        $this->_Workflow->store_message('订单已出厂，结束!');
    }
    
    public function redelivery(){
        $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order']['delivery']);
        $this->_Workflow->store_message('订单重新发货');
    }
    
    /**
     * 物流代收的由于某种原因，重新代收
     */
    public function repay(){
        $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order']['money_logistics']);
        $this->_Workflow->store_message('订单重新物流代收');
    }
    
    public function __call($name, $arguments){
        ;
    }
}