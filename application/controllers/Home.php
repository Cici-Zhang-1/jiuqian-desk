<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *  2014-11-18
 * @author ZhangCC
 * @version
 * @description  
 */
class Home extends CWDMS_Controller{
    private $_Module;
    private $_Controller;
    private $_Item ;
    private $_Cookie;
	public function __construct(){
		log_message('debug', 'Controller Home Start !');
		parent::__construct();
		
		$this->_Module = $this->router->directory;
		$this->_Controller = $this->router->class;
		$this->_Item = $this->_Module.$this->_Controller.'/';
		$this->_Cookie = str_replace('/', '_', $this->_Item);
	}

	public function index(){
	    $this->load->library('nav');
		$data['nav'] = $this->nav->read();
		$data['truename'] = $this->session->userdata('truename');
		$this->load->view('header1', $data);
		$this->load->view('home', $data);
		$this->load->view('footer1', $data);
	}
	
	public function page(){
		$this->load->view('page');
	}
	
	public function clear(){
	    $this->load->helper('file');
	    delete_cache_files('(.*)');
	    $this->Success = '清除成功!';
	    $this->_return();
	}
}