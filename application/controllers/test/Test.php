<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created for jiuqian-desk.
 * User: chuangchuangzhang
 * Date: 2018/2/13
 * Time: 19:49
 *
 * Desc:
 */
class Test extends CWDMS_Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->view('test/index');
    }
}
