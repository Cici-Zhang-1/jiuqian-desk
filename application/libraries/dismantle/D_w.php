<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2016年1月13日
 * @author Zhangcc
 * @version
 * @des
 * 橱柜拆单
 */
 

require_once dirname(__FILE__).'/D_abstract.php';

class D_w extends D_abstract{
    private $_CI;
    private $_Failue = '';
    private $_Code = 'w';
    private $_Save;
    
    public function __construct(){
        $this->_CI = &get_instance();
        parent::__construct($this->_CI);
    }
    
    public function edit($Save, $Code){
        $this->_Save = $Save;
        $this->_Code = $Code;
        $Order = array(
            'oid' => $this->_CI->input->post('oid', true)
        );
        $Order['oid'] = intval(trim($Order['oid']));
        
        $Set = $this->_CI->input->post('set', true); /*集*/
        $Set = intval(trim($Set));
        $Set = ($Set <= 0) ? 1: ($Set> 60?60:$Set);
        
        $OrderProduct = array(
            'opid' => $this->_CI->input->post('opid', true),
            'product' => $this->_CI->input->post('product', true)
        );
        $OrderProduct['opid'] = intval(trim($OrderProduct['opid']));
        
        $CabinetStruct = array(
            'opcsid' => $this->_CI->input->post('opcsid', true),
            'struct' => $this->_CI->input->post('struct', true)
        );
        $CabinetStruct['opcsid'] = intval(trim($CabinetStruct['opcsid']));
        
        $Cabinet = $this->_CI->input->post('cabinet', true);
        $BoardPlate = $this->_CI->input->post('board_plate', true);
        
        $Workflow = array(); /*记录工作流*/
        if('dismantled' == $this->_Save && empty($BoardPlate)){
            $this->_Failue = '没有板块, 不能确认橱柜拆单!';
        }else{
            if($OrderProduct['opid'] > 0){
                /**
                 * 订单产品已经建立
                 */
                if(empty($CabinetStruct['opcsid'])){
                    //添加橱柜贵体结构
                    !empty($CabinetStruct['struct'])
                    && $Opcsid = $this->_add_order_product_cabinet_struct($CabinetStruct['struct'], $OrderProduct['opid']);
                }else{
                    //修改橱柜柜体结构
                    !empty($CabinetStruct['struct'])
                    && $Opcsid = $this->_edit_order_product_cabinet_struct($CabinetStruct);
                }
                if($Opcsid){
                    !empty($Cabinet)
                    && $this->_add_order_product_cabinet($Cabinet, $Opcsid);
                }

                !empty($BoardPlate)
                && $this->_add_order_product_board_plate($BoardPlate, $OrderProduct['opid']);
                $this->_edit_order_product(array('product' => $OrderProduct['product']), $OrderProduct['opid']);
            
                $Workflow[] = $OrderProduct['opid'];
                if(--$Set >= 1){
                    if(!!($Opids = $this->_add_order_product($Order['oid'], $Set, $OrderProduct['product'], $this->_Code))){
                        foreach ($Opids as $value){
                            if(!empty($CabinetStruct['struct'])
                                && !!($Opcsid = $this->_add_order_product_cabinet_struct($CabinetStruct['struct'], $value))){
                                if(!empty($Cabinet)
                                    && !!($this->_add_order_product_cabinet($Cabinet, $Opcsid))){
                                    !empty($BoardPlate)
                                    && $this->_add_order_product_board_plate($BoardPlate, $value);
                                }else{
                                    break;
                                }
                            }else{
                                break;
                            }
                            $Workflow[] = $value;
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
                    if(!!($Opids = $this->_add_order_product($Order['oid'], $Set, $OrderProduct['product'], $this->_Code))){
                        foreach ($Opids as $value){
                            if(!empty($CabinetStruct['struct'])
                                && !!($Opcsid = $this->_add_order_product_cabinet_struct($CabinetStruct['struct'], $value))){
                                if(!empty($Cabinet)
                                    && !!($this->_add_order_product_cabinet($Cabinet, $Opcsid))){
                                    !empty($BoardPlate)
                                    && $this->_add_order_product_board_plate($BoardPlate, $value);
                                }else{
                                    break;
                                }
                            }else{
                                break;
                            }
                            $Workflow[] = $value;
                        }
                    }
                }else{
                    $this->_Failue .= '请创建订单之后再拆单';
                }
            }
            if(empty($this->_Failue) && !empty($Workflow)){
                $this->_CI->load->library('workflow/workflow');
                if(!!($this->_CI->workflow->initialize('order_product', $Workflow))){
                    $this->_CI->workflow->{$this->_Save}();
                }else{
                    $this->_Failue = $this->_CI->workflow->get_failue();
                }
            }
        }
    }
    
    /**
     * 新增橱柜柜体结构
     * @param unknown $Struct
     * @param unknown $Opid
     */
    private function _add_order_product_cabinet_struct($Struct, $Opid){
        $this->_CI->load->model('order/order_product_cabinet_struct_model');
        $Struct['opid'] = $Opid;
        if(!!($Opcsid = $this->_CI->order_product_cabinet_struct_model->insert($Struct))){
            return $Opcsid;
        }else{
            $this->_Failue .= isset($GLOBALS['error'])?is_array($GLOBALS['error'])?implode(',', $GLOBALS['error']):$GLOBALS['error']:'新建柜体结构失败!';
            return false;
        }
    }
    /**
     * 修改橱柜柜体结构
     * @param unknown $CabinetStruct
     * @param unknown $Opid
     */
    private function _edit_order_product_cabinet_struct($CabinetStruct){
        $this->_CI->load->model('order/order_product_cabinet_struct_model');
        $CabinetStruct = gh_escape($CabinetStruct);
        if(!!($this->_CI->order_product_cabinet_struct_model->update($CabinetStruct['struct'], $CabinetStruct['opcsid']))){
            $this->_CI->load->model('order/order_product_cabinet_model');
            $this->_CI->order_product_cabinet_model->delete_by_opcsid($CabinetStruct['opcsid']);
            return $CabinetStruct['opcsid'];
        }else{
            $this->_Failue .= isset($GLOBALS['error'])?is_array($GLOBALS['error'])?implode(',', $GLOBALS['error']):$GLOBALS['error']:'修改柜体结构失败!';
            return false;
        }
    }
    
    /**
     * 新增订单产品橱柜柜体
     * @param unknown $Cabinet
     * @param unknown $Opcsid
     */
    private function _add_order_product_cabinet($Cabinet, $Opcsid){
        foreach ($Cabinet as $key => $value){
            $Cabinet[$key]['opcsid'] = $Opcsid;
        }
        $this->_CI->load->model('order/order_product_cabinet_model');
        $Cabinet = gh_escape($Cabinet);
        if(!!($this->_CI->order_product_cabinet_model->insert_batch($Cabinet))){
            return true;
        }else{
            $this->_Failue .= isset($GLOBALS['error'])?is_array($GLOBALS['error'])?implode(',', $GLOBALS['error']):$GLOBALS['error']:'新建柜体失败!';
            return false;
        }
    }
    
    /**
     * 新增橱柜板块清单
     * @param unknown $BoardPlate
     * @param unknown $Opid
     */
    private function _add_order_product_board_plate($BoardPlate, $Opid){
        $this->_CI->load->model('order/order_product_board_model');
        $this->_CI->load->model('order/order_product_board_plate_model');
        $this->_CI->load->helper('dismantle_helper');
        $Opbids = array(); /*已经存在的订单产品板材统计Id号*/
        $Board = array(); /*板块中包含的板材*/
        if($this->_is_valid_board($BoardPlate)){
            foreach ($BoardPlate as $key => $value){
                if(!isset($Board[$value['good']])){
                    $Board[$value['good']] = array(
                        'opid' => $Opid,
                        'board' => $value['good'],
                        'amount' => 1,
                        'area' => $value['area']
                    );
                    if(!($Board[$value['good']]['opbid'] = $this->_CI->order_product_board_model->is_existed($Opid, gh_escape($value['good'])))){
                        /*如果不存在则插入订单产品板材*/
                        log_message('debug', $value['good']);
                        $Board[$value['good']] = gh_escape($Board[$value['good']]);
                        $Board[$value['good']]['opbid'] = $this->_CI->order_product_board_model->insert($Board[$value['good']]);
                    }
                    /* }else{ */
                    array_push($Opbids, $Board[$value['good']]['opbid']);
                    /* } */
                }else{
                    $Board[$value['good']]['amount']++;
                    $Board[$value['good']]['area'] += $value['area'];
                }
                $value['opbid'] = $Board[$value['good']]['opbid'];
                if('背板' != $value['plate_name']){
                    $value = array_merge($value, $this->_get_edge_thick($value));
                }else{
                    $value = array_merge($value, $this->_get_edge_thick(FALSE));
                }
                $value['thick'] = preg_replace('/^(\d+)(.*)/', '${1}', $value['good']);
                if(empty($value['qrcode'])){
                    $value['qrcode'] = null;
                }
                if(isset($value['remark']) && '' != $value['remark']){
                    $value['abnormity'] = $this->_is_abnormity($value['remark']);
                }else{
                    $value['abnormity'] = 0;
                }
                $BoardPlate[$key] = $value;
            }
            $this->_CI->order_product_board_plate_model->delete_by_opid($Opid);
            if(!empty($Opbids)){
                //$this->_CI->order_product_board_plate_model->delete_by_opbid($Opbids)&&
                $this->_CI->order_product_board_model->delete_not_in($Opid, $Opbids);
            }
            $BoardPlate = gh_escape($BoardPlate);
            if(!!($this->_CI->order_product_board_plate_model->insert_batch($BoardPlate))
                && !!($this->_CI->order_product_board_model->update_batch($Board))){
                return true;
            }else{
                $this->_Failue .= isset($GLOBALS['error'])?is_array($GLOBALS['error'])?implode(',', $GLOBALS['error']):$GLOBALS['error']:'保存拆单板块失败!';
                return false;
            }
        }else{
            return false;
        }
    }
    
    /**
     * 判断是否为异形
     * @param unknown $Name
     */
    private function _is_abnormity($Name){
        static $Abnormity = array();
        if(empty($Abnormity)){
            $this->_CI->load->model('data/abnormity_model');
            if(!($Abnormity = $this->_CI->abnormity_model->select_abnormity(1, FALSE))){
                return 0;
            }
        }
        $Flag = 0;
        foreach ($Abnormity as $key => $value){
            if(preg_match('/'.$value['name'].'/', $Name)){
                $Flag = 1;
                break;
            }
        }
        return $Flag;
    }

    private function _get_edge_thick($Value){
        /*if(false === $Value){
            $Return['left_edge'] = $Return['right_edge'] = $Return['up_edge'] = $Return['down_edge'] = 0;
        }else{
            $Return['left_edge'] = $Return['right_edge'] = $Return['up_edge'] = $Return['down_edge'] = 1;
        }
        return $Return;*/

        $this->_CI->load->model('data/wardrobe_edge_model');
        $Return = array();
        if (!!($Edges = $this->_CI->wardrobe_edge_model->select_wardrobe_edge_by_name(gh_escape($Value['edge'])))) {
            if (!empty($Edges['ups'])) {
                $Return['up_edge'] = $Edges['ups'];
            }else {
                $Return['up_edge'] = O_EDGE;
            }
            if (!empty($Edges['downs'])) {
                $Return['down_edge'] = $Edges['downs'];
            }else {
                $Return['down_edge'] = O_EDGE;
            }
            if (!empty($Edges['lefts'])) {
                $Return['left_edge'] = $Edges['lefts'];
            }else {
                $Return['left_edge'] = O_EDGE;
            }
            if (!empty($Edges['rights'])) {
                $Return['right_edge'] = $Edges['rights'];
            }else {
                $Return['right_edge'] = O_EDGE;
            }
        }else {
            $Return['up_edge'] = $Return['left_edge'] = $Return['right_edge'] = $Return['down_edge'] = O_EDGE;
        }
        return $Return;
    }
    
    private function _is_valid_board($BoardPlate){
        $this->_CI->load->model('product/board_model');
        $Board = array(); /*板块中包含的板材*/
        foreach ($BoardPlate as $key => $value){
            if(!in_array($value['good'], $Board)){
                if($this->_CI->board_model->select_board_id(gh_escape($value['good']))){
                    $Board[] = $value['good'];
                }else{
                    $this->_Failue = $value['good'].'不在系统中, 请先登记板材!';
                    break;
                }
            }
        }
        if(!empty($this->_Failue)){
            return false;
        }else{
            return true;
        }
    }
    
    public function get_failue(){
        return $this->_Failue;
    }
    public function read(){
        
    }
    
    public function remove($Id, $OrderProductNum = ''){
        $this->_CI->load->model('order/order_product_cabinet_model');
        $this->_CI->load->model('order/order_product_board_plate_model');
        $this->_CI->order_product_cabinet_model->delete_relate($Id);
        $this->_CI->order_product_board_plate_model->delete_relate($Id, $OrderProductNum);
    }
}