<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2016年1月15日
 * @author Administrator
 * @version
 * @des
 * 宽到生产
 */
class Money_produce_workflow extends Workflow_abstract {
    private $_Source_id;
    private $_CI;
    
    public function __construct($Source_id){
        $this->_Source_id = $Source_id;
        $this->_CI = &get_instance();
    }

    public function payed(){
        $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order']['wait_asure']);
        $this->_Workflow->store_message('款到, 等待确认!');
    }
    
    public function payterms(){
        $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order']['wait_asure']);
        $this->_Workflow->store_message('修改支付条款, 等待确认!');
    }
    
    /**
     * 重新拆单
     */
    public function redismantle(){
        $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order']['dismantling'],
            array('dismantled_datetime' => null,
                'checked_datetime' => null,
                'quoted_datetime' => null,
                'sum' => 0,
                'sum_detail' => ''));
        $this->_Workflow->store_message('重新拆单');
    }
    
    /**
     * 重新核价
     */
    public function recheck(){
        $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order']['checking'],
            array('checked_datetime' => null, 
                'quoted_datetime' => null));
        $this->_Workflow->store_message('重新核价');
    }
    
    public function __call($name, $arguments){
        ;
    }
}