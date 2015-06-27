<?php
namespace Achievement\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
		self::ajaxResponse("false","Wrong Location");
    }
    public function GetAchievement($AchievementID,$action=''){
    	if($action==''){
    		$av = M('Achievement','','DB_CONFIG');
    		$result = $av->where("id=".$AchievementID)->find();
    		if(empty($result))
    		{
				self::ajaxResponse("false","Wrong Achievement");
    		}
    		self::ajaxResponse("true",$result);
    	}
    	elseif($action=="array")
    	{
    		$av = M('Achievement','','DB_CONFIG');
    		$result = $av->where("id=".$AchievementID)->find();
    		return $result;
    	}
    }

    public function UpdatePlayerAchievement($SteamID,$Action,$AchievementID,$token){
    	$User = M('User','','DB_CONFIG');
    	$result = $User->where("SteamID=".$SteamID)->find();
    	if(empty($result))
    	{
			self::ajaxResponse("false","Wrong SteamID");
    	}
    	switch ($Action) {
    		case 'add':
    			# code...
    			break;
    		case 'remove':
    			# code...
    			break;
    		default:
    			self::ajaxResponse("false","Wrong SteamID");
    			break;
    	}
    }
    public function GetPlayerAchievement($SteamID){
    	$User = M('User','','DB_CONFIG');
    	$result = $User->where("SteamID=".$SteamID)->find();
    	if(empty($result))
    	{
    		self::ajaxResponse("false","Wrong SteamID");
    	}
    	$data = array();
    	$AchievementList = explode(',', $result['achievement']);
    	for ($i=0; $i < count($AchievementList); $i++) { 
    		//$data = array_fill($i, 1, self::GetAchievement($AchievementList[$i],"array"));
    		array_push($data, self::GetAchievement($AchievementList[$i],"array"));
    	}
		self::ajaxResponse("true",$data);
    }
    protected function ajaxResponse($bool,$data)
    {
    	switch ($bool) {
    		case 'true':
    			$return = array('status' => true,'data'=>$data);
    			$this->ajaxReturn($return);
    			break;
    		case 'false':
    			$data = array('status' => false,'errormsg'=>$data);
    			$this->ajaxReturn($data);
    			break;
    		default:
    			# code...
    			break;
    	}
    }
}