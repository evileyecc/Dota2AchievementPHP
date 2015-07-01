<?php
namespace Achievement\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
		self::ajaxResponse("false",C('error_code.Wrong_Location'));
    }
    public function GetAchievement($AchievementID){
    		$av = M('Achievement','','DB_CONFIG');
    		$result = $av->where("id=".$AchievementID)->find();
    		if(empty($result))
    		{
				self::ajaxResponse("false",C('error_code.Wrong_AchievementID'));
    		}
    		self::ajaxResponse("true",$result);
    }

    public function UpdatePlayerAchievement($SteamID,$Action,$AchievementID,$token=''){
    	$User = M('User','','DB_CONFIG');
    	$result = $User->where("SteamID=".$SteamID)->find();
    	if(empty($result))
    	{
			self::ajaxResponse("false",C('error_code.Wrong_SteamID'));
    	}
    	switch ($Action) {
    		case 'add':
    			$AchievementList = explode(',', $result['achievement']);
    			if (in_array($AchievementID, $AchievementList)) {
    				self::ajaxResponse("false",C('error_code.Already_Have'));
    			}
    			else
    			{
    				$new_Achievement;
    				for ($i=0; $i < count($AchievementList); $i++) { 
    					$new_Achievement = $new_Achievement.$AchievementList[$i].',';
    				}
    				$new_Achievement = $new_Achievement.$AchievementID;
    				$result = $User->where("SteamID=".$SteamID)->setField('achievement',$new_Achievement);
    				if ($result != 1) {
    					self::ajaxResponse("false",C('error_code.Insert_to_sql_error'));
    				}
    				self::ajaxResponse("true","Success Add id ".$AchievementID);
    			}
    			break;
    		case 'remove':
    			$AchievementList = explode(',', $result['achievement']);
    			if (in_array($AchievementID, $AchievementList)) {
    				$key = array_search($AchievementID,$AchievementList);
    				unset($AchievementList[$key]);
    				//dump($AchievementList);
    				$new_Achievement=$AchievementList[0];
    				for ($i=1; $i < count($AchievementList); $i++) { 
    					$new_Achievement = $new_Achievement.','.$AchievementList[$i];
    				}
    				$result = $User->where("SteamID=".$SteamID)->setField('achievement',$new_Achievement);
    				if ($result == 1) {
    					self::ajaxResponse("true","Success Remove id ".$AchievementID);
    				}
    				self::ajaxResponse("false",C('error_code.Insert_to_sql_error'));
    			}
    			else
    			{
    				self::ajaxResponse("false",C('error_code.Not_Have'));
    			}
    			break;
    		default:
    			self::ajaxResponse("false",C('error_code.No_Action'));
    			break;
    	}
    }
    public function GetPlayerAchievement($SteamID){
    	$User = M('User','','DB_CONFIG');
    	$result = $User->where("SteamID=".$SteamID)->find();
    	if(empty($result))
    	{
    		self::ajaxResponse("false",C('error_code.Wrong_SteamID'));
    	}
    	$data = array();
    	$AchievementList = explode(',', $result['achievement']);
    	for ($i=0; $i < count($AchievementList); $i++) { 
    		//$data = array_fill($i, 1, self::GetAchievement($AchievementList[$i],"array"));
            $av = M('Achievement','','DB_CONFIG');
            $result = $av->where("id=".$AchievementList[$i])->find();
            if(empty($result))
            {
                continue;
            }
    		array_push($data, $result);
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
    			$data = array('status' => false,'error_code'=>$data);
    			$this->ajaxReturn($data);
    			break;
    		default:
    			# code...
    			break;
    	}
    }
}