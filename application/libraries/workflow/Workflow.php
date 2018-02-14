<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2016年1月6日
 * @author Zhangcc
 * @version
 * @des
 * 工作流
 */
 
class Workflow{
    static $AllWorkflow = NULL;
    private $_Workflow;
    private $_No;
    private $_Type;
    private $_Model;
    private $_Source_id;
    private $_Source_ids;
    private $_Dir;
    private $_CI;
    private $_Failue;
    
    public function __construct(){
        $this->_CI = &get_instance();
        $this->_Dir = dirname(__FILE__);
        $this->_CI->load->model('data/workflow_model');
        $this->_CI->load->model('data/workflow_msg_model');
        log_message('debug', 'Library Workflow/Workflow __construct Start');
    }

    /**
     * 初始化，设置工作流节点类型(订单，订单产品，订单产品板材，订单产品板块...)，根据类型设置模型(Model)
     * 设置对应的源Id，获取所有的工作流节点
     * @param unknown $Type
     * @param unknown $Source_id
     * @param string $Model
     */
    public function initialize($Type, $Source_id, $Model = ''){
        $this->_Type = ucfirst($Type);
        if(empty($Model)){
            $this->_Model = strtolower($Type).'_model';
        }else{
            $this->_Model = $Model;
        }
        $this->_Source_ids = $Source_id;
        if(is_array($this->_Source_ids)){
            $this->_Source_id = $this->_Source_ids[array_rand($this->_Source_ids, 1)];
        }else{
            $this->_Source_id = $this->_Source_ids;
        }
        if(is_null(self::$AllWorkflow)){
            if(!!($Query = $this->_CI->workflow_model->select())){
                foreach ($Query as $key => $value){
                    self::$AllWorkflow[$value['type']][$value['name_en']] = $value;
                }
            }else{
                $this->_Failue = '获取全部工作流失败!';
                return false;
            }
        }
        return $this->read_current_workflow();
        log_message('debug', 'Library Workflow/Workflow initialize Success');
    }
    
    /**
     * 获取当前工作流类型的工作流，以及设置上下文环境
     */
    public function read_current_workflow(){
        log_message('debug', 'Library read_current_workflow Start On $Oid = '.$this->_Source_id.'$Type = '.$this->_Type);
        if(!!($Query = $this->_CI->{$this->_Model}->select_current_workflow($this->_Source_id, strtolower($this->_Type)))){
            return $this->_set_context($Query);
        }else{
            log_message('debug', 'Library Workflow/Workflow read_current_workflow Failue');
            $this->_Failue = '获取当前订单的工作流失败';
            return false;
        }
    }
    
    /**
     * 编辑当前订单的工作流
     * @param unknown $Workflow
     */
    public function edit_current_workflow($Workflow, $Other = array()){
        $Other['status'] = $Workflow['no'];
        if(!!($Query = $this->_CI->{$this->_Model}->update_workflow($Other,$this->_Source_ids))){
            return $this->_set_context($Workflow);
        }else{
            $this->_Failue = '设置当前订单的工作流失败';
            return false;
        }
    }
    
    /**
     * 设置当前环境，引入执行文件，设置执行文件的工作流
     * @param unknown $Workflow
     */
    private function _set_context($Workflow){
        $this->_No = $Workflow['no'];
        require_once $this->_Dir.'/Workflow_abstract.php';
        $File = $this->_Dir.'/State/'.$this->_Type.'/'.$Workflow['file'].'.php';
        if(file_exists($File)){
            require_once $File;
            log_message('debug', 'Library Workflow/workflow _set_content on File = '.$File.' And Source_id'.$this->_Source_id);
            $this->_Workflow = new $Workflow['file']($this->_Source_id);
            $this->_Workflow->set_workflow($this);
            return true;
        }else{
            $this->_Failue = '您要执行的工作流文件不存在!';
            return false;
        }
    }
    
    /**
     * 存储信息
     */
    public function store_message($Msg){
        if(is_array($this->_Source_ids)){
            $Set = array();
            foreach ($this->_Source_ids as $value){
                $Set[] = array('model' => $this->_Model, 
                                'source_id' => $value, 
                                'msg' => $Msg, 
                                'status' => $this->_No
                    );
            }
            $this->_CI->workflow_msg_model->insert_batch($Set);
        }else{
            $Set = array('model' => $this->_Model, 
                                'source_id' => $this->_Source_id, 
                                'msg' => $Msg, 
                                'status' => $this->_No
                    );
            $this->_CI->workflow_msg_model->insert($Set);
        }
        
    }
    
    /**
     * 创建
     */
    public function create(){
        $this->_Workflow->create();
    }
    
    /**
     * 拆单
     */
    public function dismantle(){
        $this->_Workflow->dismantle();
    }
    
    /**
     * 拆单完毕
     */
    public function dismantled(){
        $this->_Workflow->dismantled();
    }
    
    /**
     * 重新拆单
     */
    public function redismantle(){
        $this->_Workflow->redismantle();
    }
    
    /**
     * 核价
     */
    public function check(){
        $this->_Workflow->check();
    }
    
    /**
     * 已核价
     */
    public function checked(){
        $this->_Workflow->checked();
    }
    /**
     * 重新核价
     */
    public function recheck(){
        $this->_Workflow->recheck();
    }
    
    /**
     * 报价
     */
    public function quote($Type){
        $this->_Workflow->quote($Type);
    }
    
    /**
     * 已报价
     */
    public function quoted($Type){
        $this->_Workflow->quoted($Type);
    }
    
    /**
     * 支付
     */
    public function payed(){
        $this->_Workflow->payed();
    }
    
    public function produce(){
        $this->_Workflow->produce();
    }

    /**
     * 支付条款发货改变
     */
    public function payterms(){
        $this->_Workflow->payterms();
    }

    /**
     * 执行优化操作
     */
    public function optimize(){
        $this->_Workflow->optimize();
    }
    
    /**
     * 执行打印清单操作
     */
    public function print_list(){
        $this->_Workflow->print_list();
    }

    /**
     * 重新安排生产
     */
    public function re_produce(){
        $this->_Workflow->re_produce();
    }
    
    /**
     * 只有服务类的内容已经服务
     */
    public function servered(){
        $this->_Workflow->servered();
    }
    
    /**
     * 电子锯下料
     */
    public function electric_saw(){
        $this->_Workflow->electric_saw();
    }
    /**
     * 推台锯下料
     */
    public function table_saw(){
        $this->_Workflow->table_saw();
    }
    /**
     * 异形
     */
    public function abnormity(){
        $this->_Workflow->abnormity();
    }
    /**
     * CNC
     */
    public function cnc(){
        $this->_Workflow->cnc();
    }
    /**
     * 封边
     */
    public function edge(){
        $this->_Workflow->edge();
    }
    /**
     * 打孔
     */
    public function punch(){
        $this->_Workflow->punch();
    }
    /**
     * 正在包装
     */
    public function pack(){
        $this->_Workflow->pack();
    }
    
    /**
     * 包装完毕
     */
    public function packed(){
        $this->_Workflow->packed();
    }
    
    /**
     * 正在入库
     */
    public function in(){
        $this->_Workflow->in();
    }
    
    /**
     * 已经入库
     */
    public function ined(){
        $this->_Workflow->ined();
    }
    
    public function repay(){
        $this->_Workflow->repay();
    }
    /**
     * 已发货
     */
    public function deliveried(){
        $this->_Workflow->deliveried();
    }
    
    /**
     * 重新发货
     */
    public function redelivery(){
        $this->_Workflow->redelivery();
    }
    
    /**
     * 或已出厂，且已登记货号
     */
    public function outted(){
        $this->_Workflow->outted();
    }
    /**
     * 物流代收
     */
    public function money_logistics(){
        $this->_Workflow->money_logistics();
    }
    /**
     * 按月结款
     */
    public function money_month(){
        $this->_Workflow->money_month();
    }
    /**
     * 到厂付款
     */
    public function money_factory(){
        $this->_Workflow->money_factory();
    }
    
    /**
     * 作废
     */
    public function remove(){
        $this->_Workflow->remove();
    }
    public function remove_order_product(){
        $this->_Workflow->remove_order_product();
    }
    
    public function set_failue($Failue){
        $this->_Failue = $Failue;
    }
    public function get_failue(){
        return $this->_Failue;
    }
    
    public function get_source_ids(){
        return $this->_Source_ids;
    }
    
    public function get_type(){
        return $this->_Type;
    }
}