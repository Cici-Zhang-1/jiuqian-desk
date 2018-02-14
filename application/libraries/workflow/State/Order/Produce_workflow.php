<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2016年1月15日
 * @author Administrator
 * @version
 * @des
 */
class Produce_workflow extends Workflow_abstract {
    private $_Source_id;
    private $_CI;
    public function __construct($Source_id){
        $this->_Source_id = $Source_id;
        $this->_CI = &get_instance();
    }

    public function optimize(){
        $this->_edit_dealer_debt();
        $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order']['producing']);
        $this->_Workflow->store_message('优化订单, 开始生产!');
    }
    
    public function print_list(){
        $this->_edit_dealer_debt();
        $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order']['producing']);
        $this->_Workflow->store_message('打印订单清单, 开始生产!');
    }
    
    public function in(){
        if(!!($Pack = $this->_read_packed())){
            $this->_edit_dealer_debt();
            if(!!($this->_is_other_and_fitting())){
                $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order']['ining'], $Pack);
                $this->_Workflow->store_message('订单正在入库!');
            }else{
                $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order']['producing'], $Pack);
                $this->_Workflow->store_message('订单中配件或外购产品正在入库!');
            }
        }
    }
    
    /**
     * 重新拆单
     */
    public function redismantle(){
        $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order']['dismantling'],
            array('dismantled_datetime' => null,
                'checked_datetime' => null,
                'quoted_datetime' => null,
                'asure_datetime' => null,
                'sum' => 0,
                'sum_detail' => ''));
        $this->_clear_qrcode();
        $this->_Workflow->store_message('重新拆单');
    }
    
    /**
     * 重新核价
     */
    public function recheck(){
        $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order']['checking'],
            array('checked_datetime' => null,
                'quoted_datetime' => null,
                'asure_datetime' => null));
        $this->_clear_qrcode();
        $this->_Workflow->store_message('重新核价');
    }
    
    public function ined(){
        if(!!($Pack = $this->_read_packed())){
            $this->_edit_dealer_debt();
            if(!!($this->_only_other_and_fitting())){
                $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order']['ined'], $Pack);
                $this->_Workflow->store_message('订单已经入库!');
                $this->_Workflow->ined();
            }else{
                $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order']['producing'], $Pack);
                $this->_Workflow->store_message('订单配件或外购产品已经入库!');
            }
        }
    }
    
    /**
     * 订单只有服务了产品
     */
    public function servered(){
        if(!!($Status = $this->_read_status())){
            $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order'][$Status]);
            $this->_Workflow->store_message('订单服务类产品入库!');
        }
    }
    
    private function _only_other_and_fitting(){
        if(!!($this->_CI->order_product_model->only_other_and_fitting($this->_Source_id))){
            return true;
        }else{
            return false;
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
    
    /**
     * 更新经销上的账目信息
     */
    private function _edit_dealer_debt($Debt = 'debt2'){
        $SourceIds = $this->_Workflow->get_source_ids();
        if(!!($Query = $this->_CI->order_model->select_order_dealer_by_id($SourceIds))){
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
                if('deliveried' == $Debt){
                    $this->_CI->dealer_model->update_dealer_deliveried($Dealer);
                }else{
                    $this->_CI->dealer_model->update_dealer_debt2($Dealer);
                }
            }
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
                $Debt = 'debt2';
            }else{
                if('款到发货' == $Order['payterms']){
                    $Status = 'money_delivery';
                    $Debt = 'debt2';
                }elseif ('物流代收' == $Order['payterms']){
                    $Status = 'money_logistics';
                    $Debt = 'deliveried';
                }elseif ('按月结款' == $Order['payterms']){
                    $Status = 'money_month';
                    $Debt = 'deliveried';
                }elseif ('到厂付款' == $Order['payterms']){
                    $Status = 'money_factory';
                    $Debt = 'deliveried';
                }else{
                    $Status = 'delivery';
                    $Debt = 'debt2';
                }
            }
            $this->_edit_dealer_debt($Debt);
            return $Status;
        }else{
            return false;
        }
    }

    /**
     * 如果重新拆单需要清除橱柜的订单编号
     */
    private function _clear_qrcode() {
        $SourceIds = $this->_Workflow->get_source_ids();
        $this->_CI->load->model('order/order_product_board_plate_model');
        if(!!($this->_CI->order_product_board_plate_model->update_clear_qrcode($SourceIds))){
            return true;
        }else{
            return false;
        }
    }

    public function __call($name, $arguments){
        ;
    }
}