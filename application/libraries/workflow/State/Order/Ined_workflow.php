<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2016年1月16日
 * @author Administrator
 * @version
 * @des
 * 完全入库
 */
class Ined_workflow extends Workflow_abstract {
    private $_Source_id;
    private $_CI;
    
    public function __construct($Source_id){
        $this->_Source_id = $Source_id;
        $this->_CI = &get_instance();
    }

    public function ined(){
        if(!!($Status = $this->_read_status())){
            $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order'][$Status]);
            $this->_Workflow->store_message(Workflow::$AllWorkflow['order'][$Status]['name']);
            
        }
    }

    /**
     * 计算下一workflow
     * 在入库的时候，已经入库的根据支付状态以及支付条款决定当前订单的下一流程
     */
    private function _read_status(){
        if(!!($Order = $this->_CI->order_model->select_order_detail($this->_Source_id))){
            if(!empty($Order['payed_datetime'])){
                $Status = 'delivery';
            }else{
                if('款到发货' == $Order['payterms']){
                    $Status = 'money_delivery';
                }else{
                    $Status = 'delivery';
                }
            }
            return $Status;
        }else{
            return false;
        }
    }

    public function __call($name, $arguments){
        ;
    }
}