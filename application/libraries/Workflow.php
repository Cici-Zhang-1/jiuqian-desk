<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2015年11月26日
 * @author Zhangcc
 * @version
 * @des
 */
class Workflow{
    private $_CI;   /*CI句柄*/
    private $_Workflow;
    private $_Models = array(
        'order' => 'order/order_model',
        'order_product' => 'order/order_product_model',
        'order_product_board' => 'order/order_product_board_model'
    );
    private $_CurrentStatus;
    private $_Next = array();
    private $_Ids;
    private $_Model;
    private $_Status = array(
        
    );
    private $_Action;
    private $_Msg = array();
    public function __construct()
    {
        /** 获取CI句柄 */
        $this->_CI = & get_instance();
    
        $this->_CI->load->model('workflow/workflow_msg_model');
    
        $this->_CI->config->load('status');
        log_message('debug', "Workflow library Class Initialized");
    }
    
    /**
     * 增加工作流备注
     * @param unknown $Msg
     * @param string $Batch
     */
    public function add_workflow($Msg = array(), $Batch = false){
        if(!empty($Msg)){
            $this->_Msg = $Msg;
        }
        if(empty($this->_Msg)){
            return false;
        }else{
            $this->_Msg = gh_mysql_string($this->_Msg);
            if($Batch){
                return $this->_CI->workflow_msg_model->insert_batch_workflow_msg($this->_Msg);
            }else{
                return $this->_CI->workflow_msg_model->insert_workflow_msg($this->_Msg);
            }
        }
    }
    
    /**
     * 执行动作
     * @param unknown $Ids
     * @param unknown $Model
     * @param unknown $Action
     */
    public function action($Ids, $Model, $Action = 0){
        if(is_array($Ids)){
            $this->_Ids = $Ids;
        }else{
            $this->_Ids = explode(',', $Ids);
        }
        $this->_Model = $Model;
        $this->_Workflow= $this->_CI->config->item('library/workflow/'.$Model);
        $this->_Action = $Action;
        log_message('debug','Library Workflow Action on Action = '.$Action);
        $this->_CI->load->model($this->_Models[$this->_Model], $this->_Model);
        if(!!($this->_get_current_status())){
            $this->_generate_next_status();
            if(empty($this->_Next)){
                return false;
            }else{
                $this->_CI->$Model->update_status($this->_Next);
                $this->add_workflow(array(), true);
                $this->_trigger();
                return true;
            }
        }
    }
    /**
     * 获取当前状态
     */
    private function _get_current_status(){
        $Model = $this->_Model;
        if(!!($this->_CurrentStatus = $this->_CI->$Model->select_status($this->_Ids))){
            return true;
        }
        return false;
    }
    /**
     * 根据动作生成下已状态
     */
    private function _generate_next_status(){
        $this->_Next = array();
        $this->_Msg = array();
        foreach ($this->_CurrentStatus as $key => $value){
            if(isset($this->_Workflow[$value['status']])){
                if(isset($this->_Workflow[$value['status']]['next'])){
                    if(isset($this->_Workflow[$value['status']]['act']) && !!($Act = $this->_Workflow[$value['status']]['act'])){
                        $Status = $this->$Act($this->_Workflow[$value['status']]['next']);
                    }else{
                        $Status = $this->_Workflow[$value['status']]['next'];
                    }
                    if(false !== $Status){
                        $this->_Next[] = array(
                            'id' => $value['id'],
                            'status' => $Status
                        );
                        $this->_Msg[] = array(
                            'model' => $this->_Model,
                            'source_id' => $value['id'],
                            'msg' => $this->_Workflow[$Status]['text'],
                            'status' => $Status
                        );
                    }
                }
            }
        }
    }
    
    /**
     * 判断下一状态有没有需要执行的
     */
    private function _trigger(){
        $Ids = array();
        foreach ($this->_Next as $key => $value){
            if(isset($this->_Workflow[$value['status']])){
                if(isset($this->_Workflow[$value['status']]['trigger']) && !!($Trigger = $this->_Workflow[$value['status']]['trigger'])){
                    $Ids[] = $value['id'];
                }
            } 
        }
        if(!empty($Ids)){
            $this->$Trigger($Ids);
        }
       
    }
    
    private function _trigger_dismantling($Ids){
        $this->_CI->load->model('order/order_product_model');
        if(!!($Ids = $this->_CI->order_product_model->select_oids_by_opids($Ids))){
            $Workflow = array();
            foreach ($Ids as $key => $value){
                $Workflow[] = $value['oid'];
            }
            $this->_CI->workflow->action($Workflow, 'order', 'dismantling');
        }
    }
    private function _trigger_dismantled($Ids){
        $this->_CI->load->model('order/order_product_model');
        if(!!($Ids = $this->_CI->order_product_model->select_dismantled_by_oids($Ids))){
            $Workflow = array();
            foreach ($Ids as $key => $value){
                if(1 == $value['dismantled']){
                    $Workflow[] = $value['oid'];
                }
            }
            if(!empty($Workflow)){
                $this->_CI->workflow->action($Workflow, 'order', 1);
            }
        }
    }
    /**
     * 正在生产
     * @param unknown $Ids order_product_id
     */
    private function _trigger_producing($Ids){
        $this->_CI->load->model('order/order_product_model');
        if(!!($Ids = $this->_CI->order_product_model->select_oids_by_opids($Ids))){
            $Workflow = array();
            $Order = array();
            foreach ($Ids as $key => $value){
                $Workflow[] = $value['oid'];
                if(6 == $value['status']){
                    $Order[] = $value['oid'];
                }
            }
            if(!empty($Order)){
                $this->_edit_producing_dealer($Order);
            }
            if(!empty($Workflow)){
                $this->_CI->workflow->action($Workflow, 'order', 'producing');
            }
        }
    }
    
    /**
     * 如果订单刚转未正在生产状态，需要更新经销商的财务状况
     * @param unknown $Order
     */
    private function _edit_producing_dealer($Order){
        $this->_CI->load->model('order/order_model');
        if(!!($Query = $this->_CI->order_model->select_order_dealer_by_id($Order))){
            $Dealer = array();
            foreach ($Query as $key => $value){
                if(empty($Dealer[$value['did']])){
                    $Dealer[$value['did']] = $value['sum'];
                }else{
                    $Dealer[$value['did']] += $value['sum'];
                }
            }
            unset($Query);
            if(!empty($Dealer)){
                $this->_CI->load->model('dealer/dealer_model');
                $this->_CI->dealer_model->update_dealer_debt2($Dealer);
            }
        }
    }
    /**
     * 订单产品正在入库
     * @param unknown $Ids order_product_id
     */
    private function _trigger_ining($Ids){
        $this->_CI->load->model('order/order_product_model');
        if(!!($Ids = $this->_CI->order_product_model->select_oids_by_opids($Ids))){
            $Workflow = array();
            foreach ($Ids as $key => $value){
                $Workflow[] = $value['oid'];
            }
            
            if(!empty($Workflow)){
                if(!!($Packed = $this->_CI->order_product_model->select_order_product_pack_sum($Workflow))){
                    $Set = array();
                    foreach ($Packed as $key=>$value){
                        if(empty($Set[$value['oid']])){
                            $Set[$value['oid']] = array(
                                'oid' => $value['oid'],
                                'pack' => $value['pack'],
                                'pack_detail' => array(
                                    $value['code'] =>$value['pack']
                                )
                            );
                        }else{
                            $Set[$value['oid']]['pack'] += $value['pack'];
                            if(!isset($Set[$value['oid']]['pack_detail'][$value['code']])){
                                $Set[$value['oid']]['pack_detail'][$value['code']] = $value['pack'];
                            }else{
                                $Set[$value['oid']]['pack_detail'][$value['code']] += $value['pack'];
                            }
                        }
                    }
                    foreach ($Set as $key => $value){
                        $Set[$key]['pack_detail'] = json_encode($value['pack_detail']);
                    }
                    unset($Packed);
                    $this->_CI->load->model('order/order_model');
                    $this->_CI->order_model->update_batch($Set);
                }
                $this->_CI->workflow->action($Workflow, 'order', 'ining');
            }
        }
    }
    
    /**
     * 检查哪些是已经全部入库了
     * 1. 所有订单产品都已入库
     * 下一状态
     * 1. 款到发货，未支付
     * 2. 款到发货，已经支付
     * 3. 物流代收
     * @param unknown $Ids
     */
    private function _trigger_ined($Ids){
        $this->_CI->load->model('order/order_product_model');
        if(!!($Ids = $this->_CI->order_product_model->select_ined_by_oids($Ids))){
            $WorkflowOutting = array();
            $WorkflowMoney = array();
            foreach ($Ids as $key => $value){
                if(1 == $value['packed']){
                    if(!empty($value['payed_datetime'])){
                        $WorkflowOutting = $value['oid'];
                    }else{
                        if(preg_match('/发货/', $value['payterms'])){
                            $WorkflowMoney = $value['oid'];
                        }else{
                            $WorkflowOutting = $value['oid'];
                        }
                    }
                }
            }
            if(!empty($WorkflowMoney)){
                $this->_CI->workflow->action($WorkflowMoney, 'order', 'money');
            }
            if(!empty($WorkflowOutting)){
                $this->_CI->workflow->action($WorkflowOutting, 'order', 'outting');
            }
        }
    }
    /**
     * 根据动作判断下一状态
     * @param unknown $Next
     */
    private function _act($Next){
        if(!is_array($Next)){
            $Next = explode(',', $Next);
        }
        if(isset($Next[$this->_Action])){
            return $Next[$this->_Action];
        }else{
            return false;
        }
    }
}