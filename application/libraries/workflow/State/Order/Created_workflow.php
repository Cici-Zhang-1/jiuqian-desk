<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2016年1月6日
 * @author Zhangcc
 * @version
 * @des
 */
class Created_workflow extends Workflow_abstract {
    private $_Source_id;
    public function __construct($Source_id){
        $this->_Source_id = $Source_id;
    }
    
    public function create(){
        $this->_Workflow->store_message('新建订单');
    }
    
    public function dismantle(){
        $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order']['dismantling']);
        $this->_Workflow->store_message('正在拆单');
    }
    
    public function dismantled(){
        $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order']['dismantled'], array('dismantled_datetime' => date('Y-m-d H:i:s')));
        $this->_Workflow->store_message('全部拆单完毕');
        $this->_Workflow->dismantled();
    }

    public function __call($name, $arguments){
        ;
    }
}