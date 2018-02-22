<?php
/**
 *  2014-9-22
 * @author ZhangCC
 * @version
 * @description  
 */
class MY_Model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
}

class Base_Model extends MY_Model
{
	public $HostDb;
	public $CompanyDb;

    protected $Module;
    protected $Model;
    protected $Item;
    protected $Cache;

    protected $_Element;

	// public function __construct($Second = false, $Module = '', $Model = '')
	public function __construct($Module = '', $Model = '')
	{
		parent::__construct();
        log_message('debug', 'Model Base_Model Start');
		$this->Module = $Module;
		$this->Model = $Model;
		$this->_init();

		$this->HostDb = $this->load->database('default', TRUE);
		$this->e_cache->open_cache();   // 开启缓存
	}
	private function _init() {
        $this->Module = str_replace("\\", "/", $this->Module);
        $this->Module = substr($this->Module, strrpos($this->Module, '/')+1);
        $this->Model = strtolower($this->Model);
        $this->Item = $this->Module.'/'.$this->Model.'/';
        $this->Cache = str_replace('/', '_', $this->Item);
    }
	
	public function remove_cache($File, $Reg = true){
	    $this->load->helper('file');
	    if($Reg){
	        delete_cache_files('(.*'.$File.'.*)');
	    }else{
	        delete_cache_files($File);
	    }
	}

	public function set_element($E) {
	    $this->_Element = $E;
    }
	
	protected function _unformat_as($Item, $File){
	    $this->config->load('dbview/'.$File);
	    $Dbview = $this->config->item($Item);
	    $Return = array();
	    if (isset($this->_Element)) {
	        $Dbview = array_filter($Dbview, function($val) {
	           return in_array($val, $this->_Element);
            });
        }
        foreach ($Dbview as $key => $value){
            $Return[] = $key.' as '.$value;
        }
	    return implode(',', $Return);
	}

	protected function _unformat($Data, $Item, $File){
	    $this->config->load('dbview/'.$File);
	    $Dbview = $this->config->item($Item);
	    $Return = array();
	    foreach ($Data as $key => $value){
	        foreach ($Dbview as $ikey=>$ivalue){
	            $Return[$key][$ivalue] = isset($value[$ikey])?$value[$ikey]:'';
	        }
	    }
	    return $Return;
	}

    /**
     * 数据表
     * @param $Data
     * @param $File
     * @return array
     */
	protected function _untable_as($Data, $File) {
	    $this->config->load('tables/' . $File);
	    $Table = $this->config->item('tables/' . $File);
	    $Table = array_flip($Table);
	    $Return = array();
	    foreach ($Data as $key => $value) {
	        $Return[$Table[$key]] = $value;
        }
        return $Return;
    }

    protected function _string_untable_as($Data, $File) {
        $this->config->load('tables/' . $File);
        $Table = $this->config->item('tables/' . $File);
        $Table = array_flip($Table);
        $Return = array();
        foreach ($Data as $key => $value) {
            $Return[$key] = $Table[$value] . ' as ' . $value;
        }
        return implode(',', $Return);
    }
	
	protected function _format($Data, $Item, $File){
	    $this->config->load('formview/'. $File);
	    $FormView = $this->config->item($Item);
	    foreach ($FormView as $key=>$value){
	        if(isset($Data[$key])){
	            if(is_array($Data[$key])){
	                $Set[$value] = implode(',', $Data[$key]);
	            }else{
	                $Set[$value] = $Data[$key];
	            }
	        }elseif(array_key_exists($key, $Data) && is_null($Data[$key])){
	            $Set[$value] = $this->_default($key, null);
	        }else{
	            $Set[$value] = $this->_default($key);
	        }
	    }
	    return $Set;
	}
	
	/**
	 * 通过Data来格式化数据
	 * @param unknown $Data
	 * @param unknown $Item
	 * @param unknown $File
	 */
	protected function _format_re($Data, $Item, $File){
	    $this->config->load('formview/'. $File);
	    $FormView = $this->config->item($Item);
	    foreach ($Data as $key => $value){
	        if(is_array($value)){
	            $value = implode(',', $value);
	        }
	        if(isset($FormView[$key])){
	            $Set[$FormView[$key]] = $value;
	        }
	    }
	    return $Set;
	}
	
	protected function _default($name, $tmp=''){
	    switch ($name){
	        case 'creator':
	            $Return = $this->session->userdata('uid');
	            break;
	        case 'create_datetime':
	            $Return = date('Y-m-d H:i:s');
	            break;
	        default:
	            $Return = $tmp;
	    }
	    return $Return;
	}
}//end Base_Model
