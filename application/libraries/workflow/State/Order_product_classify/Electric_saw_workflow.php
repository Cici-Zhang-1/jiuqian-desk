<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2016年3月16日
 * @author Administrator
 * @version
 * @des
 */
class Electric_saw_workflow extends Workflow_abstract {
    private $_Source_id;

    private $_CI;
    public function __construct($Source_id){
        $this->_Source_id = $Source_id;
        $this->_CI = &get_instance();
    }

    public function electric_saw(){
        if(!!($Workflow = $this->_get_next_workflow())){
            $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order_product_classify'][$Workflow['name_en']]);
            $this->_Workflow->store_message($Workflow['classify'].'已电子锯下料, 等待'.$Workflow['name']);
        }
    }

    /**
     * 重新安排生产
     */
    public function re_produce(){
        $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order_product_classify']['plan'],
                                                array('sn' => null, 'optimizer' => null, 'optimize_datetime' => null));
        $this->_Workflow->store_message('电子锯下料, 重新安排生产');
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