<?php
/*
 * 粉丝行为分析
 *
 */
class BehaviorAction extends BaseAction{
	public function ajax_behavior(){
		$this->behavior($_POST);
	}
}