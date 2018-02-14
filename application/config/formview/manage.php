<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2015年9月22日
 * @author Zhangcc
 * @version
 * @des
 */
 
$config['manage/myself/save'] = array(
		'username' => 'u_name',
		'truename' => 'u_truename',
		'mobilephone' => 'u_mobilephone',
		'password' => 'u_password'
);
$config['manage/organization'] = array(
    'name' => 'o_name',
    'class' => 'o_class',
    'parent' => 'o_parent'
);

$config['manage/menu_model/insert'] = array(
    'name' => 'm_name',
    'class' => 'm_class',
    'parent' => 'm_parent',
    'url' => 'm_url',
    'displayorder' => 'm_displayorder',
    'img' => 'm_img'
);

$config['manage/menu_model/update'] = array(
    'name' => 'm_name',
    'class' => 'm_class',
    'parent' => 'm_parent',
    'url' => 'm_url',
    'displayorder' => 'm_displayorder',
    'img' => 'm_img'
);

$config['manage/operation_model/insert'] = array(
    'name' => 'o_name',
    'class' => 'o_class',
    'parent' => 'o_parent',
    'url' => 'o_url'
);

$config['manage/operation_model/update'] = array(
    'name' => 'o_name',
    'class' => 'o_class',
    'parent' => 'o_parent',
    'url' => 'o_url'
);

$config['manage/priviledge_model/insert'] = array(
    'type' => 'p_type',
    'source_id' => 'p_source_id',
);


$config['manage/signin_model/insert'] = array(
	'user_id'=>'s_user_id',
	'ip'=>'s_ip',
	'host'=>'s_host',
	'create_datetime' => 's_create_datetime'
);

$config['manage/user'] = array(
    'name'=>'u_name',
    'truename'=>'u_truename',
    'mobilephone'=>'u_mobilephone',
    'password' => 'u_password',
    'rid' => 'u_role_id',
    'creator' => 'u_creator',
    'create_datetime' => 'u_create_datetime'
);

$config['manage/user_model/insert'] = array(
    'name'=>'u_name',
    'truename'=>'u_truename',
    'mobilephone'=>'u_mobilephone',
    'password' => 'u_password',
    'ugid' => 'u_usergroup_id',
    'creator' => 'u_creator',
    'create_datetime' => 'u_create_datetime'
);

$config['manage/user_model/update'] = array(
    'name'=>'u_name',
    'truename'=>'u_truename',
    'mobilephone'=>'u_mobilephone',
    'password' => 'u_password',
    'ugid' => 'u_usergroup_id'
);

$config['manage/usergroup_priviledge_model/insert'] = array(
    'ugid' => 'up_usergroup_id',
    'pid' => 'up_priviledge_id'
);

$config['manage/usergroup_priviledge_model/insert_batch'] = array(
    'ugid' => 'up_usergroup_id',
    'pid' => 'up_priviledge_id'
);

$config['manage/myself/save'] = array(
    'name'=>'u_name',
    'truename'=>'u_truename',
    'mobilephone'=>'u_mobilephone',
    'password' => 'u_password'
);

$config['manage/workflow'] = array(
        'name' => 'w_name',
        'code' => 'w_code',
        'parent' => 'w_parent',
        'class' => 'w_class',
        'remark' => 'w_remark'
);
