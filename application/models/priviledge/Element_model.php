<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created for jiuqian-desk.
 * User: chuangchuangzhang
 * Date: 2018/2/13
 * Time: 09:58
 *
 * Desc:
 */
class Element_model extends Base_Model{
    private $_Module;
    private $_Model;
    private $_Item;
    private $_Cache;

    public function __construct(){
        log_message('debug', 'Model Priviledge/Element_model Start!');
        parent::__construct();

        $this->_Module = str_replace("\\", "/", dirname(__FILE__));
        $this->_Module = substr($this->_Module, strrpos($this->_Module, '/')+1);
        $this->_Model = strtolower(__CLASS__);
        $this->_Item = $this->_Module.'/'.$this->_Model.'/';
        $this->_Cache = str_replace('/', '_', $this->_Item);
    }

    public function select() {
        $Item = $this->_Item.__FUNCTION__;
        $Cache = $this->_Cache . __FUNCTION__;
        $Return = false;
        if (!($Return = $this->cache->get($Cache))) {
            $Sql = $this->_unformat_as($Item, $this->_Module);
            $Query = $this->HostDb->select($Sql)->from('element')
                ->join('card', 'c_id = e_card_id', 'left')
                ->join('menu', 'm_id = c_menu_id', 'left')
                ->order_by('m_displayorder')
                ->get();
            if ($Query->num_rows() > 0) {
                $Return = $Query->result_array();
                $this->cache->save($Cache, $Return, MONTHS);
            }
        }
        return $Return;
    }

    /**
     * 通过用户组id获取数据
     * @param $Uid
     * @return bool
     */
    public function select_by_cid($Cid){
        $Item = $this->_Item.__FUNCTION__;
        $Cache = $this->_Cache.__FUNCTION__;
        $Return = false;
        if(!($Return = $this->cache->get($Cache))){
            $Sql = $this->_unformat_as($Item, $this->_Module);
            $Query = $this->HostDb->select($Sql)->from('element')
                            ->where('e_card_id', $Cid)
                            ->get();
            if($Query->num_rows() > 0){
                $Return = $Query->result_array();
                $this->cache->save($Cache, $Return, MONTHS);
            }
        }
        return $Return;
    }

    public function insert($Data){
        $Item = $this->_Item.__FUNCTION__;
        $Data = $this->_format($Data, $Item, $this->_Module);
        if($this->HostDb->insert('element', $Data)){
            log_message('debug', "Model Element_model/insert Success!");
            $this->remove_cache($this->_Module);
            return $this->HostDb->insert_id();
        }else{
            log_message('debug', "Model Element_model/insert Error");
            return false;
        }
    }

    /**
     * 更新菜单
     * @param unknown $Data
     * @param unknown $Where
     */
    public function update($Data, $Where){
        $Item = $this->_Item.__FUNCTION__;
        $Data = $this->_format_re($Data, $Item, $this->_Module);

        $this->HostDb->where('e_id', $Where);
        $this->HostDb->update('element', $Data);
        $this->remove_cache($this->_Module);
        return TRUE;
    }

    /**
     * 在删除用户组时，删除冗余的用户组角色信息
     * 在设置用户组包含角色时，也需要删除冗余信息
     * @param $Where
     * @return bool
     */
    public function delete($Where) {
        if(is_array($Where)){
            $this->HostDb->where_in('e_id', $Where);
        }else{
            $this->HostDb->where('e_id', $Where);
        }

        $this->HostDb->delete('element');
        $this->remove_cache($this->_Module);
        return true;
    }

    /**
     * 删除菜单时，需要删除包含的功能
     * @param $Where
     */
    public function delete_by_cid($Where) {
        if (is_array($Where)) {
            $Query = $this->HostDb->select('e_id')->from('element')
                ->where_in('e_card_id', $Where)->get();
        }else {
            $Query = $this->HostDb->select('e_id')->from('card')
                ->where('e_card_id', $Where)->get();
        }
        if ($Query->num_rows() > 0) {
            $Eids = $Query->result_array();
            $Query->free_result();
        }else {
            $Eids = false;
        }
        if(is_array($Where)){
            $this->HostDb->where_in('e_card_id', $Where);
        }else{
            $this->HostDb->where('e_card_id', $Where);
        }

        $this->HostDb->delete('element');
        if ($Eids) {
            foreach ($Eids as $key => $value) {
                $Eids[$key] = $value['e_id'];
            }
            $this->load->model('priviledge/role_element_model');
            return $this->role_element_model->delete_by_eid($Eids);
        }else {
            return true;
        }
    }
}
