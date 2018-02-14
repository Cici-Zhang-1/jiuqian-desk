<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2016年1月15日
 * @author Administrator
 * @version
 * @des
 */
abstract class  D_abstracts {

    abstract protected function _read_detail();
    abstract protected function _read_board();
    abstract protected function _read_fitting();
    abstract protected function _read_other();
    abstract protected function _read_server();

}