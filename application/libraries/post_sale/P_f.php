<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2016年1月14日
 * @author Zhangcc
 * @version
 * @des
 */
require_once dirname(__FILE__).'/P_abstract.php';

class P_f extends P_abstract{
    private $_CI;
    private $_Failue = '';
    private $_Code = 'w';
    private $_Save;

    public function __construct(){
        $this->_CI = &get_instance();
        parent::__construct($this->_CI);
    }

    public function edit(){
        $Order = array(
            'oid' => $this->_CI->input->post('oid', true)
        );
        $Order['oid'] = intval(trim($Order['oid']));

        $Set = $this->_CI->input->post('set', true); /*集*/
        $Set = intval(trim($Set));
        $Set = ($Set <= 0) ? 1: ($Set> 60?60:$Set);

        $OrderProduct = array(
            'opid' => $this->_CI->input->post('opid', true),
            'product' => $this->_CI->input->post('product', true),
            'parent' => $this->_CI->input->post('parent', true),
            'remark' => $this->_CI->input->post('remarks', true)
        );
        $OrderProduct['opid'] = intval(trim($OrderProduct['opid']));
        $OrderProduct['parent'] = intval(trim($OrderProduct['parent']));

        $Server = $this->_CI->input->post('server', true);

        if($OrderProduct['opid'] > 0){
            /**
             * 订单产品已经建立
             */
            !empty($Server)
            && $this->_add_order_product_server($Server, $OrderProduct['opid']);
            $Opid = $OrderProduct['opid'];
            unset($OrderProduct['opid']);
            $this->_edit_order_product($OrderProduct, $Opid);

            unset($Opid);
            if(--$Set >= 1){
                if(!!($Opids = $this->_add_order_product($Order['oid'], $Set, $OrderProduct['product'], $this->_Code, $OrderProduct['parent']))){
                    foreach ($Opids as $value){
                        !empty($Server)
                        && $this->_add_order_product_server($Server, $value);
                    }
                }else{
                    $this->_Failue = '新增订单产品失败!';
                }
            }
        }else{
            /**
             * 订单产品需要新建
             */
            if($Order['oid'] > 0){
                if(!!($Opids = $this->_add_order_product($Order['oid'], $Set, $OrderProduct['product'], $this->_Code, $OrderProduct['parent']))){
                    foreach ($Opids as $value){
                        !empty($Server)
                        && $this->_add_order_product_server($Server, $value);
                    }
                }
            }else{
                $this->_Failue .= '请创建订单之后再拆单';
            }
        }
    }

    /**
     * 新增订单产品板材板块
     * @param unknown $BoardPlate
     * @param unknown $Opid
     */
    private function _add_order_product_server($Server, $Opid){
        $this->_CI->load->model('order/order_product_server_model');
        foreach ($Server as $key => $value){
            $value['opid'] = $Opid;
            $Server[$key] = $value;
        }
        $this->_CI->order_product_server_model->delete_by_opid($Opid);
        $Server = gh_escape($Server);
        if(!!($this->_CI->order_product_server_model->insert_batch($Server))){
            return true;
        }else{
            $this->Failue .= isset($GLOBALS['error'])?is_array($GLOBALS['error'])?implode(',', $GLOBALS['error']):$GLOBALS['error']:'保存拆单配件失败!';
            return false;
        }
    }

    public function get_failue(){
        return $this->_Failue;
    }
    public function read(){

    }
    
    public function remove($Id) {
        $this->_CI->load->model('order/order_product_server_model');
        $this->_CI->order_product_server_model->delete_by_opid($Id);
    }
}