<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2016年1月13日
 * @author Zhangcc
 * @version
 * @des
 * 工作流
 */
class Workflow_model extends Base_Model{
    private $_Module = 'data';
    private $_Model = 'workflow_model';
    private $_Item;
    private $_Cache;
    public function __construct(){
        parent::__construct();
        $this->_Item = $this->_Module.'/'.$this->_Model.'/';
        $this->_Cache = $this->_Module.'_'.$this->_Model.'_';

        log_message('debug', 'Model Data/Workflow_model Start!');
    }

    public function select() {
        $Item = $this->_Item.__FUNCTION__;
        $Cache = $this->_Cache.__FUNCTION__;
        if(!($Return = $this->cache->get($Cache))){
            $Sql = $this->_unformat_as($Item, $this->_Module);
            $this->HostDb->select($Sql, FALSE);
            $this->HostDb->from('workflow');
            
            $this->HostDb->order_by('type');
            $this->HostDb->order_by('no');
            $Query = $this->HostDb->get();
            if($Query->num_rows() > 0){
                $Return = $Query->result_array();
                $this->cache->save($Cache, $Return, MONTHS);
            }else{
                $GLOBALS['error'] = '无任何衣柜板块名称!';
            }
        }
        return $Return;
    }
    
    /**
     * 通过no和类型获得w_name_en
     * @param unknown $Id
     * @param unknown $Type
     */
    public function select_by_no($Id, $Type){
        $Query = $this->HostDb->select('w_name_en as name_en, w_name as name')
                                ->from('workflow')
                                ->where('w_no', $Id)
                                ->where('w_type', $Type)
                                ->limit(1)
                                ->get();
        if($Query->num_rows() > 0){
            $Return = $Query->row_array();
            $Query->free_result();
        }else{
            $Return = false;
        }
        return $Return;
    }

    public function insert($Set) {
        $Item = $this->_Item.__FUNCTION__;
        $Set = $this->_format($Set, $Item, $this->_Module);
        if($this->HostDb->insert('workflow', $Set)){
            log_message('debug', "Model $Item Success!");
            $this->remove_cache($this->_Cache);
            return $this->HostDb->insert_id();
        }else{
            log_message('debug', "Model $Item Error");
            return false;
        }
    }

    public function update($Set, $Where) {
        $Item = $this->_Item.__FUNCTION__;
        $Set = $this->_format($Set, $Item, $this->_Module);
        $this->HostDb->where('w_id',$Where);
        if($this->HostDb->update('workflow', $Set)){
            $this->remove_cache($this->_Cache);
            return true;
        }else{
            return false;
        }
    }
    /**
     * 删除异形
     * @param unknown $Where
     */
    public function delete($Where){
        if(is_array($Where)){
            $this->HostDb->where_in('w_id', $Where);
        }else{
            $this->HostDb->where('w_id', $Where);
        }
        if($this->HostDb->delete('workflow')){
            $this->remove_cache($this->_Cache);
            return true;
        }else{
            return false;
        }
    }
}