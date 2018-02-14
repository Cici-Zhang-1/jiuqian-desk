<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2016年1月13日
 * @author Zhangcc
 * @version
 * @des
 * 订单详情
 */
 
require_once dirname(__FILE__).'/D/D_abstracts.php';

class D_order extends D_abstracts{
    private $_Failue = '';
    private $_CI;
    private $_Id;
    public function __construct(){
        /** 获取CI句柄 */
        $this->_CI = & get_instance();

        log_message('debug', "Library D_order Class Initialized");
    }

    public function get_failue(){
        return $this->_Failue;
    }
    
    public function read($Type, $Id){
        $this->_Id = $Id;
        switch ($Type){
            case 'detail':
                $Return = $this->_read_detail();
                break;
            case 'w':
            case 'y':
            case 'm':
            case 'k':
                $Return = $this->_read_board();
                break;
            case 'p':
                $Return = $this->_read_fitting();
                break;
            case 'g':
                $Return = $this->_read_other();
                break;
            case 'f':
                $Return = $this->_read_server();
                break;
            default:
                $this->_Failue .= '您要访问的核价不存在!';
                $Return = false;
        }
        return $Return;
    }

    protected function _read_detail(){
        $Return = array();
        $this->_CI->load->model('order/order_model');
        if(!($Return = $this->_CI->order_model->select_order_detail($this->_Id))){
            $this->Failue .= isset($GLOBALS['error'])?is_array($GLOBALS['error'])?implode(',', $GLOBALS['error']):$GLOBALS['error']:'您要访问的订单不存在!';
            return false;
        }
        return $Return;
    }
    
    protected function _read_board(){
        $Return = false;
        $this->_CI->load->model('order/order_product_board_model');
        if(!($Return = $this->_CI->order_product_board_model->select_order_product_board_by_opid($this->_Id))){
            $this->_Failue .= isset($GLOBALS['error'])?is_array($GLOBALS['error'])?implode(',', $GLOBALS['error']):$GLOBALS['error']:'您要访问的订单板材不存在!';;
        }
        return $Return;
    }

    protected function _read_fitting(){
        $Return = false;
        $this->_CI->load->model('order/order_product_fitting_model');
        if(!($Return = $this->_CI->order_product_fitting_model->select_order_product_fitting_by_opid($this->_Id))){
            $this->_Failue .= isset($GLOBALS['error'])?is_array($GLOBALS['error'])?implode(',', $GLOBALS['error']):$GLOBALS['error']:'您要访问的配件产品不存在!';;
        }
        return $Return;
    }

    protected function _read_other(){
        $Return = false;
        $this->_CI->load->model('order/order_product_other_model');
        if(!($Return = $this->_CI->order_product_other_model->select_order_product_other_by_opid($this->_Id))){
            $this->_Failue .= isset($GLOBALS['error'])?is_array($GLOBALS['error'])?implode(',', $GLOBALS['error']):$GLOBALS['error']:'您要访问的外购产品不存在!';;
        }
        return $Return;
    }

    protected function _read_server(){
        $Return = false;
        $this->_CI->load->model('order/order_product_server_model');
        if(!($Return = $this->_CI->order_product_server_model->select_order_product_server_by_opid($this->_Id))){
            $this->_Failue .= isset($GLOBALS['error'])?is_array($GLOBALS['error'])?implode(',', $GLOBALS['error']):$GLOBALS['error']:'您要访问的服务产品不存在!';;
        }
        return $Return;
    }
}