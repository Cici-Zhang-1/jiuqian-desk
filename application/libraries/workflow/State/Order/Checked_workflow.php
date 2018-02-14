<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2016年1月6日
 * @author Zhangcc
 * @version
 * @des
 * 已经核价
 */
class Checked_workflow extends Workflow_abstract {
    private $_Source_id;
    public function __construct($Source_id){
        $this->_Source_id = $Source_id;
    }

    public function checked(){
        $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order']['quote']);
        $this->_Workflow->store_message('等待报价');
    }

    public function __call($name, $arguments){
        ;
    }
}