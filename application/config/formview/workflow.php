<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2015年11月27日
 * @author Zhangcc
 * @version
 * @des
 */
$config['workflow/workflow_msg_model/insert_workflow_msg'] = array(
    'model' => 'wm_model',
    'source_id' => 'wm_source_id',
    'creator' => 'wm_creator',
    'create_datetime' => 'wm_create_datetime',
    'msg' => 'wm_msg',
    'status' => 'wm_status'
);