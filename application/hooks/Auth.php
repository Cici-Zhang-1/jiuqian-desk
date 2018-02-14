<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/*
 */
class Auth
{
	/**
     * 用户
     *
     * @access private
     * @var array
     */
	private static $_sign_in = NULL;
    private $_user = array();
    
    private $_Uid;
	
	/**
    * CI句柄
    * 
    * @access private
    * @var object
    */
	private $_CI;

	private $UserView = array();
	 /**
     * 构造函数
     * 
     * @access public
     * @return void
     */
    public function __construct()
    {
        /** 获取CI句柄 */
		$this->_CI = & get_instance();
		$this->_CI->load->model('manage/user_model');
		
		log_message('debug', "Auth Hook Start");
    }
	
    /**
     * 判断用户是否已经登录
     * 判断session和cookie
     * @access public
     * @return void
     */

	public function is_login(){
	    if(!$this->_is_sign_page()){
	        if(is_null(self::$_sign_in)){
	            $this->_Uid = $this->_CI->input->cookie('uid');
		    $Uid = $this->_CI->input->post('access2008_cookie_uid');
		    if($Uid){
			$this->_Uid = $Uid;
		    }
	            if(empty($this->_Uid)){
	                $this->_Uid = $this->_CI->session->userdata('uid');
	                if(empty($this->_Uid)){
	                    self::$_sign_in = false;
	                }else {
	                    $this->_is_valid_user();
	                }
	            }else{
	                $this->_is_valid_user();
	            }
	        }
	        if(!self::$_sign_in){
	            gh_location('',site_url('sign/index/in'));
	        }
	    }
	}
	
	/**
	 * 判断是否是执行登录/登出操作
	 */
	private function _is_sign_page(){
	    return preg_match('/^sign\//', uri_string());
	}
	
	/**
	 * 判断是否为有效用户
	 */
	private function _is_valid_user(){
	    $this->_Uid = intval(trim($this->_Uid));
	    if(!!($User = $this->_CI->user_model->is_user($this->_Uid))){
	        $this->_user_session($User);
	        $this->_user_cookie($User);
	        self::$_sign_in = true;
	    }else{
	        self::$_sign_in = false;
	    }
	}
	
	/**
	 * 缓存(cookie/session)用户基本信息
	 * @param unknown $User
	 */
	public function cache_user($User){
	    $this->_user_session($User);
	    $this->_user_cookie($User);
	}
	
	/**
	 * 更新用户session信息
	 * @param unknown $User
	 */
	private function _user_session($User){
	    $SessionKeys = explode(' ', $this->_CI->config->item('session_keys'));
	    foreach ($SessionKeys as $value){
	        $Session[$value] = $User[$value];
	    }
	    $this->_CI->session->set_userdata($Session);
	}
	
	/**
	 * 更新客户cookie信息
	 * @param unknown $User
	 */
	private function _user_cookie($User){
	    $CookieKeys = explode(' ', $this->_CI->config->item('cookie_keys'));
	    foreach ($CookieKeys as $value){
	        $Cookie = array(
	            'name' => $value,
	            'value' => $User[$value],
	            'expire' => 0
	        );
	        $this->_CI->input->set_cookie($Cookie);
	    }
	}
}

/* End of file Auth.php */
/* Location: ./application/libraries/Auth.php */