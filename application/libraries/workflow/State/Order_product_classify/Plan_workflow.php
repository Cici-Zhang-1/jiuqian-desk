<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2016年3月16日
 * @author Administrator
 * @version
 * @des
 * 板块分类-计划
 */
class Plan_workflow extends Workflow_abstract {
    private $_Source_id;

    private $_CI;
    public function __construct($Source_id){
        $this->_Source_id = $Source_id;
        $this->_CI = &get_instance();
    }

    /**
     * 优化，优化的过程是由内到外，
     */
    public function optimize(){
        if(!!($Workflow = $this->_get_next_workflow())){
            $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order_product_classify'][$Workflow['name_en']]);
            $this->_Workflow->store_message($Workflow['classify'].'已安排计划(优化), 等待'.$Workflow['name']);
            if(!!($Opids = $this->_read_opids())){
                $this->_CI->load->model('order/order_product_model');
                foreach ($Opids as $key => $value){
                    $this->_Workflow->initialize('order_product', $value);
                    $this->_Workflow->optimize();
                }
            }
        }
    }

    /**
     * 打印清单，打印清单的过程是由中间到两侧
     */
    public function print_list(){
        if(!!($Workflow = $this->_get_next_workflow())){
            $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order_product_classify'][$Workflow['name_en']]);
            $this->_Workflow->store_message($Workflow['classify'].'已安排计划(打印清单), 等待'.$Workflow['name']);
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

    private function _read_opids(){
        $SourceIds = $this->_Workflow->get_source_ids();
        $Opids = $this->_CI->order_product_classify_model->select_opids_by_opcids($SourceIds);
        return $Opids;
    }

    public function __call($name, $arguments){
        ;
    }
}