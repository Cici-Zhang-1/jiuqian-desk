<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2016年1月6日
 * @author Zhangcc
 * @version
 * @des
 * 拆单完成
 */
class Dismantled_workflow extends Workflow_abstract {
    private $_Source_id;
    public function __construct($Source_id){
        $this->_Source_id = $Source_id;
    }

    /**
     * 拆单完成后直接过度到等待核价状态
     */
    public function dismantled(){
        $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order']['check'], array('dismantled_datetime' => date('Y-m-d H:i:s')));
        $this->_Workflow->store_message('等待核价');
    }
    
    /**
     * 重新拆单
     */
    public function redismantle(){
        $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order_product']['dismantling'], 
                                array('dismantled_datetime' => null));
        $this->_Workflow->store_message('重新拆单');
    }

    public function __call($name, $arguments){
        ;
    }
}