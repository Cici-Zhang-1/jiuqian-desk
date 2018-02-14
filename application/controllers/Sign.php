<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *  2014-11-18
 * @author ZhangCC
 * @version
 * @description  
 */
class Sign extends CWDMS_Controller{
	private static $Refer = '';
	/* private $_Module; */
	private $_Controller;
	private $_Item ;
	private $_Cookie;
	
	private $_Uri;
	public function __construct(){
		parent::__construct();
		log_message('debug','Controller Sign __construct');
		/* $this->_Module = str_replace("\\", "/", dirname(__FILE__));
		$this->_Module = substr($this->_Module, strrpos($this->_Module, '/')+1); */
		$this->_Controller = strtolower(__CLASS__);
		$this->_Item = $this->_Controller.'/';
	}
	public function index(){
	    $Item = $this->_Item.__FUNCTION__.'/';
	    $this->_Uri = explode('/', str_replace($Item, '', uri_string()));
	    if(count($this->_Uri) > 0){
	        $View = array_shift($this->_Uri);
	        $View = '_'.$View;
	        if(method_exists(__CLASS__, $View)){
	            $this->$View();
	        }else{
	            $this->load->view($View, $this->data);
	        }
	    }else{
	        show_404();
	    }
	}
	
	private function _in(){
	    if(isset($_SERVER['HTTP_REFERER'])){
	        $this->session->set_userdata('http_referer', $_SERVER['HTTP_REFERER']);
	        //$_SESSION['http_referer'] = $_SERVER['HTTP_REFERER'];
	    }else{
	        $this->session->set_userdata('http_referer', site_url());
	        //$_SESSION['http_referer'] = site_url();
	    }
	    $Data['action'] = site_url('sign/in');
	    $this->load->view($this->_Item.__FUNCTION__,$Data);
	}
	
	public function in(){
	    $Item = $this->_Item.__FUNCTION__;
	    if($this->form_validation->run($Item)){
	        $username = $this->input->post('username',true);
	        $password = $this->input->post('password',true);
	        $this->load->model('manage/user_model');
	        $user = $this->user_model->check_login($username,$password);
	        if($user){
				$this->load->model('manage/signin_model');
				$Set = array(
					'user_id' => $user['uid'],
					'ip' => $_SERVER['REMOTE_ADDR'],
					'host' => ''
				);
				$this->signin_model->insert($Set);
	            $this->_user_session($user);
	            $this->_user_cookie($user);
	            $this->Location = base_url('index.php');
	        }else{
	            $this->Failue = '用户名或密码错误!';
	        }
	    }else{
	        $this->Failue = validation_errors();
	    }
	    $Data['uid'] = $this->session->userdata('uid');
	    $this->_return();
	}
	public function out(){
		$this->load->helper('cookie');
		$this->session->sess_destroy();
		$this->load->helper('global_func');
		$CookieKeys = explode(' ', $this->config->item('cookie_keys'));
		foreach ($CookieKeys as $value){
			delete_cookie($value);
		}
		Header("Location: ".base_url('/index.php/sign'));
		exit();
	}
	
	/**
	 * 更新用户session信息
	 * @param unknown $User
	 */
	private function _user_session($User){
	    $SessionKeys = explode(' ', $this->config->item('session_keys'));
	    foreach ($SessionKeys as $value){
	        $Session[$value] = $User[$value];
	    }
	    $this->session->set_userdata($Session);
	}
	
	/**
	 * 更新客户cookie信息
	 * @param unknown $User
	 */
	private function _user_cookie($User){
	    $CookieKeys = explode(' ', $this->config->item('cookie_keys'));
	    foreach ($CookieKeys as $value){
	        $Cookie = array(
	            'name' => $value,
	            'value' => $User[$value],
	            'expire' => 0
	        );
	        $this->input->set_cookie($Cookie);
	    }
	}
}