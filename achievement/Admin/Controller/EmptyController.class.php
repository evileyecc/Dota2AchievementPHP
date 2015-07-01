<?php
namespace Admin\Controller;
use Think\Controller;
class EmptyController extends Controller{
    public function index(){
		$this->error('请勿访问不存在的页面',U('Admin/Login/index'),5);
    }
}
