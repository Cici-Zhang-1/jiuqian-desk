<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2016年3月16日
 * @author Administrator
 * @version
 * @des
 */
class Abnormity_workflow extends Workflow_abstract {
    private $_Source_id;

    private $_CI;
    public function __construct($Source_id){
        $this->_Source_id = $Source_id;
        $this->_CI = &get_instance();
    }

    public function abnormity(){
        if(!!($Workflow = $this->_get_next_workflow())){
            $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order_product_classify'][$Workflow['name_en']]);
            $this->_Workflow->store_message($Workflow['classify'].'已做异形, 等待'.$Workflow['name']);
        }
    }
    /**
     * 获取当前流程的下一流程
     */
    private function _get_next_workflow(){
        $Workflow = false;
        if(!!($NextStatus = $this->_CI->order_product_classify_model->select_next_status($this->_Source_id))){
            $Workflow = $this->_CI->workflow_model->select_by_no($NextStatus['status'], $this->_Workflow->get_type());
            $Workflow['classify'] = $NextStatus['classify'];
        }
        return $Workflow;
    }

    public function __call($name, $arguments){
        ;
    }
}