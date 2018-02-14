<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *  2014-8-15
 * @author ZhangCC
 * @version
 * @description  
 */
class CWDMS_Controller extends CI_Controller
{
    protected $isJson;
	protected $isAjax;
	protected $isApp;
	protected $Success = '';
	protected $Failue = '';
	protected $Location = '';
	public function __construct()
	{
		parent::__construct();
		log_message('debug','Controller CWDMS_Controller/__construct Start');
		/* 
		if(!$this->auth->is_login() && !preg_match('/sign/', $_SERVER['REQUEST_URI'])){
			gh_location('',base_url('/index.php/sign/index/in'));
		} */
		$this->_is_ajax();
		$this->_is_app();
		//$this->form_validation->set_error_delimiters('', '');
	}
	
	private function _is_ajax(){
	    $this->isAjax = isAjax();
	}
	
	private function _is_app(){
	    $this->load->library('user_agent');
	    $this->isApp = strpos($this->agent->agent_string(), 'APICloud')===0?true:false;
	    if($this->isApp){
	        gh_json_decode();
	    }
	}
	
	public function _return($data = array()){
		if(empty($this->Failue)){
			if($this->isApp){
				exit(json_encode(array('error'=>0, 'message'=> $this->Success, 'data' => $data, 'location' => $this->Location)));
			}elseif($this->isAjax){
				if(preg_match('/json/', $_SERVER['HTTP_ACCEPT']) || $this->isJson){
					exit(json_encode(array('error'=>0, 'message'=> $this->Success, 'data'=>$data, 'location' => $this->Location)));
				}else{
					exit();
				}
			}else{
			    if(empty($this->Location)){
			        exit($this->Success);
			    }else{
			        gh_location($this->Success, $this->Location);
			    }
			}
		}else{
			if($this->isApp){
				exit(json_encode(array('error'=>1, 'message'=> $this->Failue, 'location' => $this->Location)));
			}if($this->isAjax){
				if(preg_match('/json/', $_SERVER['HTTP_ACCEPT'])){
					exit(json_encode(array('error'=>1, 'message'=> $this->Failue, 'location' => $this->Location)));
				}else{
					exit($this->Failue);
				}
			}else{
				gh_alert_back($this->Failue);
			}
		}
	}
	
	/**
	 * 关闭Tab页面
	 * @param string $Msg
	 */
	public function close_tab($Msg = ''){
	    $this->load->view('close_tab', array('msg' =>$Msg));
	}
	
	/**
	 * 重新载入另一个页面
	 * @param unknown $Url
	 */
	public function redirect_tab($Url, $Msg = ''){
	    $this->load->view('redirect_tab', array('url' =>$Url, 'msg' => $Msg));
	}
	
	/**
	 * 获得收索分页条件
	 * @param unknown $Cookie
	 * @param unknown $Con
	 */
	protected function get_page_conditions($Cookie, $Con){
	    $Return = array();
	    $Flag = false;
	    foreach ($Con as $key=>$value){
	        $Return[$key] = $this->input->get($key, true);
	        $Return[$key] = trim($Return[$key]);
	        if(false === $Return[$key] || '' == $Return[$key]){
	            $Return[$key] = $value;
	        }else{
	            $Flag = true;
	        }
	    }
	    if(!$Flag){
	        $P = $this->input->get('p', true);
	        $Page = $this->input->get('page', true);  //缓存页面
	        $Table = $this->input->get('table', true);  //缓存表格
	        $P = intval(trim($P));
	        if($P){
	            if((!!($Cookies = $this->input->cookie($Cookie, true))
	                   && !!($Condition = json_decode($Cookies, true)))
	                   || ($Page != false && !!($Cookies = $this->input->cookie($Page, true))
	                    && !!($Cookies = json_decode($Cookies, true))
	                    && isset($Cookies[$Table])
	                    && !!($Condition = $Cookies[$Table]))){
	                unset($Cookies);
	                $Return = array_merge($Return, $Condition);
	            }else{
	                $Return = $Con;
	            }
	            $Return['p'] = $P;
	            $Flag = true;
	        }
	    }
	    if(empty($Return['pn'])){
	        $Return['pn'] = 0;
	    }
	    if(empty($Return['pagesize']) || $Return['pagesize'] < MIN_PAGESIZE || $Return['pagesize'] > MAX_PAGESIZE){
	        $Return['pagesize'] = MIN_PAGESIZE;
	    }
	    if(empty($Return['p']) || $Return['p'] < 1){
	        $Return['p'] = 1;
	    }elseif (!empty($Return['pn']) && $Return['p'] > $Return['pn']){
	        $Return['p'] = $Return['pn'];
	    }
	    return $Return;
	}
	
}//end Base_Controller