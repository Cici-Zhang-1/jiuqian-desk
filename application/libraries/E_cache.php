<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *  2014-9-26
 * @author ZhangCC
 * @version
 * @description  
 */
class E_cache{
	private $_CI;
	
	public function __construct(){
		$this->_CI = & get_instance();
	}
	public function open_cache(){
		$this->_CI->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
		if($this->_CI->cache->apc->is_supported()){
			$this->_CI->load->driver('cache', array('adapter' => 'apc'));
		}else{
			$this->_CI->load->driver('cache', array('adapter' => 'file'));
		}
	}
	
	//public function cache
}