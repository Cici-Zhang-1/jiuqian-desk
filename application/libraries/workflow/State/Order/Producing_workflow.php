<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2016年1月16日
 * @author Administrator
 * @version
 * @des
 * 正在生产
 */
class Producing_workflow extends Workflow_abstract {
    private $_Source_id;
    private $_CI;
    
    public function __construct($Source_id){
        $this->_Source_id = $Source_id;
        $this->_CI = &get_instance();
    }

    public function in(){
        if(!!($Pack = $this->_read_packed())){
            $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order']['ining'], $Pack);
            $this->_Workflow->store_message('订单正在入库!');
        }
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