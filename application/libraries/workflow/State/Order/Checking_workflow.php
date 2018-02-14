<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2016年1月6日
 * @author Zhangcc
 * @version
 * @des
 * 正在核价
 */
class Checking_workflow extends Workflow_abstract {
    private $_Source_id;
    private $_CI;
    public function __construct($Source_id){
        $this->_Source_id = $Source_id;
        $this->_CI = &get_instance();
    }

    public function check(){
        $this->_Workflow->store_message('正在核价');
    }

    public function checked(){
        if($this->_is_checked()){
            $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order']['checked'], array(
                'checked_datetime' => date('Y-m-d H:i:s')
            ));
            $this->_Workflow->store_message('核价完毕');
            $this->_Workflow->checked();
        }else{
            $this->_Workflow->set_failue('请先核价，然后再确认!');
        }
    }

    private function _is_checked(){
        if(!!($Query = $this->_CI->order_model->select_order_detail($this->_Source_id))){
            if($Query['sum'] > 0 || preg_match('/^B/', $Query['order_num'])){
                return true;
            }
        }
        return false;
    }
    
    /**
     * 重新拆单
     */
    public function redismantle(){
        $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order']['dismantling'],
                                                array('dismantled_datetime' => null,
                                                    'sum' => 0,
                                                    'sum_detail' => ''));
        $this->_Workflow->store_message('重新拆单');
    }
    public function __call($name, $arguments){
        ;
    }
}