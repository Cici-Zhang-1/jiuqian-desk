<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2016年1月15日
 * @author Administrator
 * @version
 * @des
 */
class Wait_asure_workflow extends Workflow_abstract {
    private $_Source_id;
    public function __construct($Source_id){
        $this->_Source_id = $Source_id;
    }

    /**
     * 确认生产
     * @param unknown $Type
     */
    public function produce(){
        $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order']['produce'], array(
            'asure_datetime' => date('Y-m-d H:i:s')
        ));
        $this->_Workflow->store_message(Workflow::$AllWorkflow['order']['produce']['name']);
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