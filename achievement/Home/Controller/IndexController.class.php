<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $data = array('status' => false,'errormsg'=>'Wrong Location');
        $this->ajaxReturn($data);
    }
    public function _empty(){
    	$data = array('status' => false,'errormsg'=>'Wrong Location');
        $this->ajaxReturn($data);
    }
}