<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2016年1月18日
 * @author Zhangcc
 * @version
 * @des
 * 款到发货
 */
class Money_delivery_workflow extends Workflow_abstract {
    private $_Source_id;
    private $_CI;
    public function __construct($Source_id){
        $this->_Source_id = $Source_id;
        $this->_CI = &get_instance();
    }
    
    public function payed(){
        if(!!($this->_CI->order_model->only_server($this->_Source_id))){
            $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order']['outted']);
            $this->_Workflow->store_message('款到, 服务已完成!');
        }else{
            $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order']['delivery']);
            $this->_Workflow->store_message('款到, 等待发货!');
        }
    }
    
    public function payterms(){
        $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order']['delivery']);
        $this->_Workflow->store_message('修改支付条款, 等待发货!');
    }
    
    public function ined(){
        if(!!($Pack = $this->_read_packed())){
            $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order']['ined'], $Pack);
            $this->_Workflow->store_message('订单已经入库!');
    
            $this->_Workflow->ined();
        }
    }
    
    /**
     * 已包装入库的数量
     */
    public function _read_packed(){
        if(!!($Pack = $this->_CI->order_product_model->select_ined_pack($this->_Source_id))){
            $Set = array('pack' => 0, 'pack_detail' => array() );
            foreach ($Pack as $key=>$value){
                $Set['pack'] += $value['pack'];
                if(!isset($Set['pack_detail'][$value['code']])){
                    $Set['pack_detail'][$value['code']] = $value['pack'];
                }else{
                    $Set['pack_detail'][$value['code']] += $value['pack'];
                }
            }
            $Set['pack_detail'] = json_encode($Set['pack_detail']);
            unset($Pack);
            return $Set;
        }else{
            return false;
        }
    }

    public function __call($name, $arguments){
        ;
    }
}