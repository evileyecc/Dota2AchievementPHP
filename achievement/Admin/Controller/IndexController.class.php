<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function before_index(){

    }
    public function index(){
		if(is_null(cookie('user')) == false)
		{
			if(cookie('user_token') == S(cookie('user')))
			{
				$this->show('FUCK?');
			}
			else{
				$this->error("请先登录",U('Admin/Login/index'),3);
			}
			
		}
		else
		{
			$this->error("请先登录",U('Admin/Login/index'),3);
		}
    }
    public function _empty(){
    	$this->error("请用正确的方法打开本页面",U('Admin/Login/index'),3);
    }
}