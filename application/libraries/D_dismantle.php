<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2015年12月5日
 * @author Zhangcc
 * @version
 * @des
 * 读取拆单的信息(板材、板块、结构)
 */
class D_dismantle{
    private $_Failue = '';
    private $_CI;
    public function __construct(){
        /** 获取CI句柄 */
        $this->_CI = & get_instance();
        
        log_message('debug', "Library D_dismantle Class Initialized");
    }
    
    public function set_failue($Failue = ''){
        $this->_Failue = $Failue;
    }
    public function get_failue(){
        return $this->_Failue;
    }
    public function read_detail($Type, $Id){
        $Method = '_read_'.$Type;
        $Return = array();
        if(method_exists(__CLASS__, $Method)){
            $Return = $this->$Method($Id);
        }
        return $Return;
    }
    
    /**
     * 读取板材信息
     * @param unknown $Id order_product_id
     */
    private function _read_board($Id){
        $Return = false;
        $this->_CI->load->model('order/order_product_board_model');
        if(!($Return = $this->_CI->order_product_board_model->select_order_product_board_by_opid($Id))){
            $this->_Failue .= isset($GLOBALS['error'])?is_array($GLOBALS['error'])?implode(',', $GLOBALS['error']):$GLOBALS['error']:'您要访问的订单板材不存在!';;
        }
        return $Return;
    }
    
    /**
     * 读取橱柜柜体结构信息
     * @param unknown $Id order_product_id
     */
    private function _read_cabinet_struct($Id){
        $Return = false;
        $this->_CI->load->model('order/order_product_cabinet_struct_model');
        if(!($Return = $this->_CI->order_product_cabinet_struct_model->select_order_product_cabinet_struct_by_opid($Id))){
            $this->_Failue .= isset($GLOBALS['error'])?is_array($GLOBALS['error'])?implode(',', $GLOBALS['error']):$GLOBALS['error']:'您要访问的橱柜结构不存在!';;
        }
        return $Return;
    }
    
    /**
     * 读取衣柜结构信息
     * @param unknown $Id order_product_id
     */
    private function _read_wardrobe_struct($Id){
        $Return = false;
        $this->_CI->load->model('order/order_product_wardrobe_struct_model');
        if(!($Return = $this->_CI->order_product_wardrobe_struct_model->select_order_product_wardrobe_struct_by_opid($Id))){
            $this->_Failue .= isset($GLOBALS['error'])?is_array($GLOBALS['error'])?implode(',', $GLOBALS['error']):$GLOBALS['error']:'您要访问的衣柜结构不存在!';;
        }
        return $Return;
    }
    
    /**
     * 读取橱柜柜体
     * @param unknown $Id order_product_cabinet_struct_id
     */
    private function _read_cabinet($Id){
        $Return = false;
        $this->_CI->load->model('order/order_product_cabinet_model');
        if(!($Return = $this->_CI->order_product_cabinet_model->select_order_product_cabinet_by_opcsid($Id))){
            $this->_Failue .= isset($GLOBALS['error'])?is_array($GLOBALS['error'])?implode(',', $GLOBALS['error']):$GLOBALS['error']:'您要访问的橱柜柜体不存在!';;
        }
        return $Return;
    }
    
    /**
     * 读取异形信息
     */
    private function _read_abnormity($Id){
        $Return = false;
        $this->_Failue = '';
        $this->_CI->load->model('order/order_product_board_plate_model');
        if(!($Return = $this->_CI->order_product_board_plate_model->select_order_product_board_plate_abnormity_by_opid($Id))){
            $this->_Failue .= isset($GLOBALS['error'])?is_array($GLOBALS['error'])?implode(',', $GLOBALS['error']):$GLOBALS['error']:'您要访问的板块不存在!';;
        }
        return $Return;
    }
    /**
     * 读取(橱柜、衣柜)板块信息
     * @param unknown $Id order_product_id
     */
    private function _read_board_plate($Id){
        $Return = false;
        $this->_CI->load->model('order/order_product_board_plate_model');
        if(!($Return = $this->_CI->order_product_board_plate_model->select_order_product_board_plate_by_opid($Id))){
            $this->_Failue .= isset($GLOBALS['error'])?is_array($GLOBALS['error'])?implode(',', $GLOBALS['error']):$GLOBALS['error']:'您要访问的板块不存在!';;
        }
        return $Return;
    }
    /**
     * 读取门板信息
     * @param unknown $Id order_product_id
     */
    private function _read_door($Id){
        $Return = false;
        $this->_CI->load->model('order/order_product_door_model');
        if(!($Return = $this->_CI->order_product_door_model->select_order_product_door_by_opid($Id))){
            $this->_Failue .= isset($GLOBALS['error'])?is_array($GLOBALS['error'])?implode(',', $GLOBALS['error']):$GLOBALS['error']:'您要访问的门板结构不存在!';;
        }
        return $Return;
    }
    
    /**
     * 读取门板板块信息
     * @param unknown $Id order_product_id
     */
    private function _read_board_door($Id){
        $Return = false;
        $this->_CI->load->model('order/order_product_board_door_model');
        if(!($Return = $this->_CI->order_product_board_door_model->select_order_product_board_door_by_opid($Id))){
            $this->_Failue .= isset($GLOBALS['error'])?is_array($GLOBALS['error'])?implode(',', $GLOBALS['error']):$GLOBALS['error']:'您要访问的门板产品不存在!';;
        }
        return $Return;
    }
    
    /**
     * 读取木框门信息
     * @param unknown $Id order_product_id
     */
    private function _read_board_wood($Id){
        $Return = false;
        $this->_CI->load->model('order/order_product_board_wood_model');
        if(!($Return = $this->_CI->order_product_board_wood_model->select_order_product_board_wood_by_opid($Id))){
            $this->_Failue .= isset($GLOBALS['error'])?is_array($GLOBALS['error'])?implode(',', $GLOBALS['error']):$GLOBALS['error']:'您要访问的木框门产品不存在!';;
        }
        return $Return;
    }
    
    /**
     * 读取配件信息
     * @param unknown $Id
     */
    private function _read_fitting($Id){
        $Return = false;
        $this->_CI->load->model('order/order_product_fitting_model');
        if(!($Return = $this->_CI->order_product_fitting_model->select_order_product_fitting_by_opid($Id))){
            $this->_Failue .= isset($GLOBALS['error'])?is_array($GLOBALS['error'])?implode(',', $GLOBALS['error']):$GLOBALS['error']:'您要访问的配件产品不存在!';;
        }
        return $Return;
    }
    
    /**
     * 读取外购信息
     * @param unknown $Id
     */
    private function _read_other($Id){
        $Return = false;
        $this->_CI->load->model('order/order_product_other_model');
        if(!($Return = $this->_CI->order_product_other_model->select_order_product_other_by_opid($Id))){
            $this->_Failue .= isset($GLOBALS['error'])?is_array($GLOBALS['error'])?implode(',', $GLOBALS['error']):$GLOBALS['error']:'您要访问的外购产品不存在!';;
        }
        return $Return;
    }
    
    /**
     * 读取服务信息
     * @param unknown $Id
     */
    private function _read_server($Id){
        $Return = false;
        $this->_CI->load->model('order/order_product_server_model');
        if(!($Return = $this->_CI->order_product_server_model->select_order_product_server_by_opid($Id))){
            $this->_Failue .= isset($GLOBALS['error'])?is_array($GLOBALS['error'])?implode(',', $GLOBALS['error']):$GLOBALS['error']:'您要访问的服务产品不存在!';;
        }
        return $Return;
    }
}