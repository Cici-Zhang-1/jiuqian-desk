<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*Program: JIUQIAN
*============================
* 
*============================
*Author: Zhangcc
*Date:2015-4-26
**/
class Dealer_linker extends CWDMS_Controller{
	private $_Module;
	private $_Controller;
	private $_Item;
	
	private $_Search = array(
	    'id' => '',
	    'pagesize' => '',
	    'keyword' => '',
	    'pn' => ''
	);
	public function __construct(){
		parent::__construct();
		$this->load->model('dealer/dealer_linker_model');
		$this->_Module = $this->router->directory;
		$this->_Controller = $this->router->class;
		$this->_Item = $this->_Module.$this->_Controller.'/';
		
		log_message('debug', 'Controller Dealer/dealer_linker Start!');
	}

	public function index(){
		$View = $this->uri->segment(4, 'read');
		if(method_exists(__CLASS__, '_'.$View)){
		    $View = '_'.$View;
			$this->$View();
		}else{
			$Item = $this->_Item.$View;
			$Data['action'] = site_url($Item);
			$this->load->view($Item, $Data);
		}
	}
	
	private function _read(){
	    $Id = $this->input->get('id');
	    $Id = intval(trim($Id));
	    $Data = array('Id' => $Id);
	    if($Id > 0){
	        if(!($Data['DealerLinker'] = $this->dealer_linker_model->select($Id))){
	            $Data['Error'] = '您要访问的经销商联系人不存在';
	        }
	    }else{
	        $Data['Error'] = '您要访问的经销商联系人不存在';
	    }
	    $this->load->view('dealer/dealer_linker/_read', $Data);
	}
	
	public function add(){
		$Item = $this->_Item.__FUNCTION__;
		if($this->form_validation->run($Item)){
		    $Post = gh_escape($_POST);
		    $Mobilephone = $this->input->post('mobilephone');
		    if($this->dealer_linker_model->is_registed($Mobilephone)){
		        $this->Failue = '手机号码已经注册';
		    }else{
        		if(!!($Id = $this->dealer_linker_model->insert($Post))){
        			$this->Success .= '经销商联系人新增成功, 刷新后生效!';
        		}else{
        			$this->Failue .= isset($GLOBALS['error'])?is_array($GLOBALS['error'])?implode(',', $GLOBALS['error']):$GLOBALS['error']:'经销商联系人新增失败';
        		}
		    }
		}else{
			$this->Failue .= validation_errors();
		}
		$this->_return();
	}

	public function edit(){
	    $Item = $this->_Item.__FUNCTION__;
	    if($this->form_validation->run($Item)){
	        $Post = gh_escape($_POST);
	        $Where = $Post['selected'];
	        unset($Post['selected']);
	        if(!!($this->dealer_linker_model->update($Post, $Where))){
	            $this->Success .= '经销商联系人信息修改成功, 刷新后生效!';
	        }else{
	            $this->Failue .= isset($GLOBALS['error'])?is_array($GLOBALS['error'])?implode(',', $GLOBALS['error']):$GLOBALS['error']:'经销商联系人信息修改失败!';
	        }
	    }else{
	        $this->Failue .= validation_errors();
	    }
	    $this->_return();
	}

	public function remove(){
		$Item = $this->_Item.__FUNCTION__;
		if($this->form_validation->run($Item)){
			$Where = $this->input->post('selected', true);
			if($Where !== false && is_array($Where) && count($Where) > 0){
				if($this->dealer_linker_model->delete($Where)){
					$this->Success .= '经销商联系人信息删除成功, 刷新后生效!';
				}else {
					$this->Failue .= isset($GLOBALS['error'])?is_array($GLOBALS['error'])?implode(',', $GLOBALS['error']):$GLOBALS['error']:'经销商联系人信息删除失败';
				}
			}else{
				$this->Failue .= '没有可删除项!';
			}
		}else{
			$this->Failue .= validation_errors();
		}
		$this->_return();
	}
}