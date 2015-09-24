<?php
class UserinfoModel extends Model
{
	/*增加用户的积分*/
	public function add_score($uid, $mer_id, $money, $desc = '')
	{
		$condition_user = array();
		$condition_user['wecha_id'] = $uid;
		$condition_user['token'] = $mer_id;
			
		if ($mycard = D('Member_card_create')->where($condition_user)->find()) {
			$exchange = D('Member_card_exchange')->where(array('cardid' => $mycard['cardid'], 'token' => $mer_id))->find();
			$score = $exchange['reward'] * $money;
			D('Member_card_use_record')->add(array('token' => $mer_id, 'wecha_id' => $uid, 'cat' => 1, 'expense' => $money, 'score' => $score, 'time' => time()));
			if($this->where($condition_user)->setInc('total_score', $score)){
				//D('Userinfo_score_list')->add_row($uid, 1, $score, $desc);
				return array('error_code' =>false,'msg' =>'OK');
			}else{
				return array('error_code' => true, 'msg' => '添加积分失败！请联系管理员协助解决。');
			}
		} else return false;
	}
	
	/*使用用户的积分*/
	public function user_score($uid, $mer_id, $score, $desc = '')
	{
		$condition_user = array();
		$condition_user['wecha_id'] = $uid;
		$condition_user['token'] = $mer_id;
			
// 		if ($mycard = D('Member_card_create')->where($condition_user)->find()) {
// 			$exchange = D('Member_card_exchange')->where(array('cardid' => $mycard['cardid'], 'token' => $mer_id))->find();
// 			$score = $exchange['reward'] * $money;
			D('Member_card_use_record')->add(array('token' => $mer_id, 'wecha_id' => $uid, 'cat' => 2, 'expense' => 0, 'score' => '-' . $score, 'time' => time()));
			if($this->where($condition_user)->setDec('total_score', $score)){
				//D('Userinfo_score_list')->add_row($uid, 2, $score, $desc);
				return array('error_code' =>false,'msg' =>'OK');
			}else{
				return array('error_code' => true, 'msg' => '减少积分失败！请联系管理员协助解决。');
			}
// 		} else return false;
	}
	
	/*获取积分*/
	public function get_score($uid, $mer_id)
	{
		$condition_user = array();
		$condition_user['wecha_id'] = $uid;
		$condition_user['token'] = $mer_id;
		$user = $this->where($condition_user)->find();
		return isset($user['total_score']) ? intval($user['total_score']) : 0;
	}
}
?>