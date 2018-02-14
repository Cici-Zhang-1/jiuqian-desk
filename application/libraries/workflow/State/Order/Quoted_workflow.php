<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2016年1月15日
 * @author Administrator
 * @version
 * @des
 */
class Quoted_workflow extends Workflow_abstract {
    private $_Source_id;
    public function __construct($Source_id){
        $this->_Source_id = $Source_id;
    }

    public function quoted($Type){
        $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order'][$Type], array(
            'quoted_datetime' => date('Y-m-d H:i:s')
        ));
        $this->_Workflow->store_message(Workflow::$AllWorkflow['order'][$Type]['name']);
    }
    
    public function __call($name, $arguments){
        ;
    }
}