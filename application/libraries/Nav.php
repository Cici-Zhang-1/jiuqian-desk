<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2016年1月5日
 * @author Zhangcc
 * @version
 * @des
 * 获取导航信息
 */
class Nav{
    private $_CI;
    
    public function __construct(){
        $this->_CI = &get_instance();
        log_message('debug', "Library Nav/__construct Start");
    }
    
    public function read(){
        $Uid = $this->_CI->session->userdata('uid');
        $Uid = intval(trim($Uid));
        if($Uid){
            $this->_CI->load->model('priviledge/menu_model');
            if(!!($Menu = $this->_CI->menu_model->select_by_uid($Uid))){
                return $this->_nav_format($Menu);
            }else{
                return false;
            }
        }else{
            gh_location('', site_url('sign/out'));
        }
    }
    
    private function _nav_format($param1){
        $Return = array();
        $Panel = '';
        $first_navigation = array();
        $second_navigation = array();
        $third_navigation = array();
        if(!empty($param1)){
            foreach ($param1 as $index => $row){
                switch ($row['class']){
                    case '0':
                        if($row['url'] == 'javascript:void(0);'){
                            if(empty($row['img'])){
                                $tmp = '<li><a href="'.$row['url'].'" name="'.$row['name'].'" title="'.$row['name'].'"><div class="common-font-24"><i class="fa fa-file"></i></div><span class="sider-text">'.$row['name'].'</span></a><ul class="sub-sidebar-form">';
                            }else{
                                $tmp = '<li><a href="'.$row['url'].'" name="'.$row['name'].'" title="'.$row['name'].'"><div class="common-font-24">'.$row['img'].'</div><span class="sider-text">'.$row['name'].'</span></a><ul class="sub-sidebar-form">';
                            }
                        }else{
                            if(empty($row['img'])){
                                $tmp = '<li ><a href="'.site_url($row['url']).'" name="'.$row['name'].'" title="'.$row['name'].'"><div class="common-font-24"><i class="fa fa-file"></i></div><span class="sider-text">'.$row['name'].'</span></a></li>';
                            }else{
                                $tmp = '<li ><a href="'.site_url($row['url']).'" name="'.$row['name'].'" title="'.$row['name'].'"><div class="common-font-24">'.$row['img'].'</div><span class="sider-text">'.$row['name'].'</span></a></li>';
                            }
                        }
                        $first_navigation[$row['id']] = $tmp;
                        break;
                    case '1':
                        if(empty($row['img'])){
                            $tmp = '<li><a href="'.site_url($row['url']).'" name="'.$row['name'].'" title="'.$row['name'].'" class="corner-all"><i class="fa fa-file"></i>&nbsp;&nbsp;<span class="sidebar-text">'.$row['name'].'</span></a></li><li class="divider"></li>';
                        }else{
                            $tmp = '<li><a href="'.site_url($row['url']).'" name="'.$row['name'].'" title="'.$row['name'].'" class="corner-all">'.$row['img'].'&nbsp;&nbsp;<span class="sidebar-text">'.$row['name'].'</span></a></li><li class="divider"></li>';
                        }
                        $second_navigation[$row['parent']][$row['id']] = $tmp;
                        break;
                }
            }
            foreach ($second_navigation as $index1 => $row1){
                $sn_tmp = implode('', $row1);
                foreach ($first_navigation as $index0 => $row0){
                    if ($index1 == $index0){
                        $first_navigation[$index0] .= $sn_tmp;
                        $first_navigation[$index0] .= '</ul></li>';
                    }
                }
            }
            $return = implode('', $first_navigation);
        }
        return $return ;
    }
}
