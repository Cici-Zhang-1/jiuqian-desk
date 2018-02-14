<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2016年1月15日
 * @author Administrator
 * @version
 * @des
 */
class Quote_workflow extends Workflow_abstract {
    private $_Source_id;
    private $_CI;

    public function __construct($Source_id){
        $this->_Source_id = $Source_id;
        $this->_CI = &get_instance();
    }

    public function quote($Type){
        $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order']['quoted'], array(
            'quoted_datetime' => date('Y-m-d H:i:s')
        ));
        $this->_Workflow->store_message('已经报价');
        $this->_Workflow->quoted($Type);
    }
    
    /**
     * 重新拆单
     */
    public function redismantle(){
        $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order']['dismantling'], 
                                                    array('dismantled_datetime' => null,
                                                        'checked_datetime' => null,
                                                        'sum' => 0,
                                                        'sum_detail' => ''));
        $this->_Workflow->store_message('重新拆单');
    }
    
    /**
     * 重新核价
     */
    public function recheck(){
        $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order']['checking'],
                                                array('checked_datetime' => null));
        $this->_Workflow->store_message('重新核价');
    }
    
    public function __call($name, $arguments){
        ;
    }
}