<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2016年3月16日
 * @author Administrator
 * @version
 * @des
 * 扫描工作流节点
 */
class Scan_workflow extends Workflow_abstract {
    private $_Source_id;

    private $_CI;
    public function __construct($Source_id){
        $this->_Source_id = $Source_id;
        $this->_CI = &get_instance();
    }

    public function __call($name, $arguments){
        ;
    }
}