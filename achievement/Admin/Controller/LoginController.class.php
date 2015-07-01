<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function before_index(){

    }
    public function index(){
		if(is_null(cookie('user')) == false)
		{
			if(cookie('user_token') == S(cookie('user')))
			{
				$this->success("欢迎回来",U('Admin/Index/index'));
			}
			else{
				$this->display();
			}
		}
		else
		{
			$this->display();
		}
    }
    public function _empty(){
    	$this->error("请用正确的方法打开本页面",U('Admin/Login/index'),3);
    }
    public function PostLogin()
    {
    	$user = I('post.user');
    	$verify = new \Think\Verify();
    	if ($verify->check(I('post.Captcha'), $id) == true) {
			$Admin = M('Admin','','DB_CONFIG');
			if (I('post.user') == "") {
				$data['status'] = false;
				$data['ErrorMsg'] = "用户名不能为空";
				$this->ajaxReturn($data);
			}
			$result = $Admin->where("username='".$user."'")->find();
			if($result == null){
				$data['status'] = false;
				$data['ErrorMsg'] = "用户不存在";
				$this->ajaxReturn($data);
			}
			else
			{
				$checkPwd = sha1(I('post.pwd').$result['salt']);
				//dump($checkPwd);
				if($checkPwd == $result['password'])
				{
					$data['status'] = true;
					$data['ErrorMsg'] = "";
					cookie('user',$result['username'],600);
					S($result['username'],self::getRandChar(16),600);
					cookie('user_token',S($result['username']),600);
					$this->ajaxReturn($data);
				}
				else
				{
					$data['status'] = false;
					$data['ErrorMsg'] = "密码错误";
					$this->ajaxReturn($data);
				}
			}
    	}
    	else{
			$data['status'] = false;
			$data['ErrorMsg']="验证码错误";
			$this->ajaxReturn($data);
    	}
	}
    public function getVerify()
    {
    	$Verify = new \Think\Verify();
		$Verify->fontSize = 30;
		$Verify->length   = 4;
		$Verify->useNoise = false;
		$Verify->imageW = 300;
		$Verify->entry();
    }
    function getRandChar($length){
  		$str = null;
   		$strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
   		$max = strlen($strPol)-1;
   		for($i=0;$i<$length;$i++){
    		$str.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
   		}
   		return $str;
  	}
}