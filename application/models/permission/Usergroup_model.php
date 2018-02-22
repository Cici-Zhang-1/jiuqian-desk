<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2016年1月5日
 * @author Zhangcc
 * @version
 * @des
 * 用户组
 */
class Usergroup_model extends Base_Model{
    private $_Module;
    private $_Model;
    private $_Item;
    private $_Cache;
    
    public function __construct(){
        log_message('debug', 'Model permission/Usergroup_model Start!');
        parent::__construct();
        
        $this->_Module = str_replace("\\", "/", dirname(__FILE__));
        $this->_Module = substr($this->_Module, strrpos($this->_Module, '/')+1);
        $this->_Model = strtolower(__CLASS__);
        $this->_Item = $this->_Module.'/'.$this->_Model.'/';
        $this->_Cache = str_replace('/', '_', $this->_Item);
    }

    public function select(){
        $Item = $this->_Item.__FUNCTION__;
	    $Cache = $this->_Cache.__FUNCTION__;
	    $Return = false;
	    if(!($Return = $this->cache->get($Cache))){
	        $Sql = $this->_unformat_as($Item, $this->_Module);
	        $Query = $this->HostDb->select($Sql)->from('usergroup')->get();
	        if($Query->num_rows() > 0){
	            $Return = $Query->result_array();
	            $this->cache->save($Cache, $Return, MONTHS);
	        }
	    }
	    return $Return;
    }

    public function select_usergroup_id($Name){
        $Query = $this->HostDb->select('u_id')->from('usergroup')->where('u_name', $Name)->limit(1)->get();
        if($Query->num_rows()  > 0){
            $Row = $Query->row_array();
            return $Row['u_id'];
        }else{
            return false;
        }
    }

    public function insert($Data){
        $Item = $this->_Item.__FUNCTION__;
        $Data = $this->_format($Data, $Item, $this->_Module);
        if($this->HostDb->insert('usergroup', $Data)){
            log_message('debug', "Model Usergroup_model/insert Success!");
            $this->remove_cache($this->_Cache);
            return $this->HostDb->insert_id();
        }else{
            log_message('debug', "Model Usergroup_model/insert Error");
            return false;
        }
    }

    public function update($Data, $Where){
        $Item = $this->_Item.__FUNCTION__;
	    $Data = $this->_format_re($Data, $Item, $this->_Module);
		$this->HostDb->where('u_id', $Where);
		$this->HostDb->update('usergroup', $Data);
		$this->remove_cache($this->_Cache);
		return TRUE;
    }

    /**
     * 删除用户组
     * @param unknown $Where
     */
    public function delete($Where){
        if (is_array($Where)) {
            $this->HostDb->where_in('u_id', $Where);
        }else {
            $this->HostDb->where('u_id', $Where);
        }
        $this->HostDb->delete('usergroup');
        $this->remove_cache($this->_Module);
        return TRUE;
    }

    private function _get_role_tree(){
        $Rid = $this->session->userdata('rid');
        $Child = array();
        if(!!($Query = $this->select_role())){
            foreach ($Query as $key => $value){
                $Child[$value['r_parent']][] = $value['r_id'];
            }
            ksort($Child);
            $Child = gh_infinity_category($Child, $Rid);
        }
        return $Child;
    }
}
