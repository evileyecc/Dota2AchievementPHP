<?php
namespace Home\Controller;
use Think\Controller;
class EmptyController extends Controller{
    public function index(){
        //根据当前控制器名来判断要执行那个城市的操作
        $data = array('status' => false,'error_code'=>C('error_code.Wrong_Location'));
        $this->ajaxReturn($data);
    }
}
