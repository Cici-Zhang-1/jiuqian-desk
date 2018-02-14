<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2016年1月16日
 * @author Zhangcc
 * @version
 * @des
 * 订单产品正在生产
 */
class Producing_order_product_workflow extends Workflow_abstract {
    private $_Source_id;

    private $_CI;
    public function __construct($Source_id){
        $this->_Source_id = $Source_id;
        $this->_CI = &get_instance();
    }

    /* public function optimize(){
        $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order_product']['producing']);
        $this->_Workflow->store_message('优化订单产品!');
    }

    public function print_list(){
        $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order_product']['producing'], array(
            'print_datetime' => date('Y-m-d H:i:s')
        ));
        $this->_Workflow->store_message('打印订单产品清单!');
    } */
    public function optimize(){
    	$this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order_product']['producing']);
        $this->_Workflow->store_message('优化订单产品!');
        
		$this->_Source_ids = $this->_Workflow->get_source_ids(); 
        if(!!($Oids = $this->_read_oid())){
            $this->_CI->load->model('order/order_model');
		    foreach($Oids as $key => $value){
	            $this->_Workflow->initialize('order', $value['oid']);
	            $this->_Workflow->optimize();
		    }
        }
    }
    
    public function print_list(){
    	$this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order_product']['producing'], array(
            'print_datetime' => date('Y-m-d H:i:s')
        ));
        $this->_Workflow->store_message('打印订单产品清单!');
        $this->_Source_ids = $this->_Workflow->get_source_ids();
        $this->_CI->load->model('order/order_product_classify_model');
        /*订单产品板块分类处理*/
        if(!!($Opcids = $this->_read_opcids())){
            foreach ($Opcids as $key => $value){
                $this->_Workflow->initialize('order_product_classify', $value);
                $this->_Workflow->print_list();
            }
        }
        /*订单处理*/
        if(!!($Oids = $this->_read_oid())){
            $this->_CI->load->model('order/order_model');
		    foreach($Oids as $key => $value){
	            $this->_Workflow->initialize('order', $value['oid']);
	            $this->_Workflow->print_list();
		    }
        }
    }
    
    public function pack(){
        $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order_product']['packing']);
        if (isset($GLOBALS['workflow_msg'])){
            $this->_Workflow->store_message('订单产品正在包装, 有留包!'.$GLOBALS['workflow_msg']);
            unset($GLOBALS['workflow_msg']);
        }else{
            $this->_Workflow->store_message('订单产品正在包装, 有留包!');
        }
    }
    
    public function packed(){
        $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order_product']['packed']);
        if (isset($GLOBALS['workflow_msg'])){
            $this->_Workflow->store_message('订单产品已经包装!'.$GLOBALS['workflow_msg']);
            unset($GLOBALS['workflow_msg']);
        }else{
            $this->_Workflow->store_message('订单产品已经包装!');
        }
        
        $this->_Workflow->packed();
    }

    public function re_produce(){
        $this->_Workflow->edit_current_workflow(Workflow::$AllWorkflow['order_product']['dismantled'],
                    array('print_datetime' => null, 'scan_start' => 0, 'scan_start' => null, 'scan_end' => null));
        $this->_Workflow->store_message('订单产品重新安排生产!');

        $this->_Source_ids = $this->_Workflow->get_source_ids();
        $this->_CI->load->model('order/order_product_classify_model');
        /*订单产品板块分类处理*/
        if(!!($Opcids = $this->_read_opcids())){
            foreach ($Opcids as $key => $value){
                $this->_Workflow->initialize('order_product_classify', $value);
                $this->_Workflow->re_produce();
            }
        }
    }
    
    private function _read_oid(){
    	if(!!($Oids = $this->_CI->order_product_model->select_oids_by_opids($this->_Source_ids))){
    		/*foreach ($Oids as $key => $value){
    		 $Oids[$key] = $value['oid'];
    		}*/
    	}
    	return $Oids;
    }
    
    /**
     * 获取订单产品板块分类编号
     */
    private function _read_opcids(){
    	$Opcids = $this->_CI->order_product_classify_model->select_opcids_by_opids($this->_Source_ids);
    	return $Opcids;
    }
    
    public function __call($name, $arguments){
        ;
    }
}