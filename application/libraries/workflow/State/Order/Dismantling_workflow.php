<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2016年1月6日
 * @author Zhangcc
 * @version
 * @des
 * 正在拆单
 */
class Dismantling_workflow extends Workflow_abstract {
    private $_Source_id;
    public function __construct($Source_id){
        $this->_Source_id = $Source_id;
    }
    
    public function dismantled(){
        $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order']['dismantled'], array('dismantled_datetime' => date('Y-m-d H:i:s')));
        $this->_Workflow->store_message('拆单完毕');
        $this->_Workflow->dismantled();
    }

    public function __call($name, $arguments){
        ;
    }
    
}