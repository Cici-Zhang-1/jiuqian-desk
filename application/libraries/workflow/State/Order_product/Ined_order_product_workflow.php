<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2016年1月16日
 * @author Administrator
 * @version
 * @des
 * 订单产品已经入库
 */
class Ined_order_product_workflow extends Workflow_abstract {
    private $_Source_id;

    private $_CI;
    public function __construct($Source_id){
        $this->_Source_id = $Source_id;
        $this->_CI = &get_instance();
    }

    /**
     * 重新包装，有留包
     */
    public function pack(){
        $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order_product']['packing']);
        if (isset($GLOBALS['workflow_msg'])){
            $this->_Workflow->store_message('订单产品正在包装, 有留包!'.$GLOBALS['workflow_msg']);
            unset($GLOBALS['workflow_msg']);
        }else{
            $this->_Workflow->store_message('订单产品正在包装, 有留包!');
        }
    }
    
    /**
     * 重新包装，无留包
     */
    public function packed(){
        $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order_product']['packed']);

        $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order_product']['packed']);
        if (isset($GLOBALS['workflow_msg'])){
            $this->_Workflow->store_message('订单产品已经包装!'.$GLOBALS['workflow_msg']);
            unset($GLOBALS['workflow_msg']);
        }else{
            $this->_Workflow->store_message('订单产品已经包装!');
        }

        $this->_Workflow->packed();
    }
    
    public function ined(){
        if(!!($Oid = $this->_CI->order_product_model->select_ined_status($this->_Source_id))){
            $this->_CI->load->model('order/order_model');
            foreach ($Oid as $key => $value){
                $this->_Workflow->initialize('order', $value['oid']);
                $this->_Workflow->{$value['status']}();
            }
        }
    }

    public function print_list(){
        $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order_product']['ined'], array(
            'print_datetime' => date('Y-m-d H:i:s')
        ));
        $this->_Workflow->store_message('订单产品打印清单!');
    }
    
    public function __call($name, $arguments){
        ;
    }
}