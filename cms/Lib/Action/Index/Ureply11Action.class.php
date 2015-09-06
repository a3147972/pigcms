<?php

class Ureply11Action extends BaseAction
{
	public function index()
	{
		echo '';
	}

	public function lhsrrx()
	{
		set_time_limit('60');
		$Db = new Model();
		$DB_PREFIX = c('DB_PREFIX');
		$sql1 = 'update ' . $DB_PREFIX . 'reply,' . $DB_PREFIX . 'group_order set ' . $DB_PREFIX . 'reply.mer_id=' . $DB_PREFIX . 'group_order.mer_id , ' . $DB_PREFIX . 'reply.store_id=' . $DB_PREFIX . 'group_order.store_id' . "\r\n\t\t" . 'where ' . $DB_PREFIX . 'reply.order_id  = ' . $DB_PREFIX . 'group_order.order_id AND ' . $DB_PREFIX . 'reply.order_type=\'0\'';
		echo '开始执行评论表团够部分数据订正<br/>';
		echo '===================================================================<br/>';
		$Db->query($sql1);
		echo '程序睡两秒=============<br/>';
		sleep(2);
		echo '程序醒来继续执行============<br/>';
		$sql2 = 'update ' . $DB_PREFIX . 'reply, ' . $DB_PREFIX . 'meal_order set ' . $DB_PREFIX . 'reply.mer_id= ' . $DB_PREFIX . 'meal_order.mer_id ,  ' . $DB_PREFIX . 'reply.store_id= ' . $DB_PREFIX . 'meal_order.store_id' . "\r\n\t\t" . 'where ' . $DB_PREFIX . 'reply.order_id  =  ' . $DB_PREFIX . 'meal_order.order_id AND ' . $DB_PREFIX . 'reply.order_type=\'1\'';
		echo '开始执行评论表订餐部分数据订正<br/>';
		echo '===================================================================<br/>';
		$Db->query($sql2);
		echo '<br/>';
		echo '数据订正完成，谢谢您的执行。再见！<br/>';
	}

	public function merscore()
	{
		set_time_limit('60');
		$Db = new Model();
		$DB_PREFIX = c('DB_PREFIX');
		$sql1 = 'SELECT `mer_id` , `store_id` , sum( score ) AS ts, count( pigcms_id ) AS tt FROM ' . $DB_PREFIX . 'reply GROUP BY `store_id`';
		$ret = $Db->query($sql1);
		$inser_Db = d('Merchant_score');

		if (!(true == empty($ret))) {
			foreach ($ret as $vv) {
				$tmp = array('parent_id' => $vv['store_id'], 'type' => 2, 'score_all' => $vv['ts'], 'reply_count' => $vv['tt']);
				$inser_Db->add($tmp);
			}
		}

		$sql2 = 'SELECT `mer_id` , `store_id` , sum( score ) AS ts, count( pigcms_id ) AS tt FROM ' . $DB_PREFIX . 'reply GROUP BY `mer_id`';
		$rets = $Db->query($sql2);

		if (!(true == empty($rets))) {
			foreach ($rets as $vm) {
				$tmpe = array('parent_id' => $vm['mer_id'], 'type' => 1, 'score_all' => $vm['ts'], 'reply_count' => $vm['tt']);
				$inser_Db->add($tmpe);
			}
		}

		echo '数据订正完成，谢谢您的执行。再见！<br/>';
	}

	public function merstoreismain()
	{
		set_time_limit('60');
		$Db = new Model();
		$DB_PREFIX = c('DB_PREFIX');
		$sql2 = 'SELECT mer_id FROM ' . $DB_PREFIX . 'merchant_store where ismain=1 group by `mer_id`';
		$tmpret = $Db->query($sql2);
		$mer_tmp = array();

		if (!(true == empty($tmpret))) {
			foreach ($tmpret as $mvv) {
				$mer_tmp[] = $mvv['mer_id'];
			}
		}

		$sql1 = 'SELECT * FROM ' . $DB_PREFIX . 'merchant_store  group by `mer_id` order by mer_id ASC ,`store_id` ASC';
		$ret = $Db->query($sql1);
		$m = $e = 0;

		if (!(true == empty($ret))) {
			$store_tmpDb = m('Merchant_store');

			foreach ($ret as $vv) {
				if ((false == 1 == $vv['ismain']) && (false == in_array($vv['mer_id'], $mer_tmp))) {
					$updatearr = array('ismain' => 1, 'weixin' => 'hefei_live', 'qq' => '800022936', 'permoney' => rand(30, 50), 'feature' => '以满足客户需求为主');
					$flage = $store_tmpDb->where(array('store_id' => $vv['store_id'], 'mer_id' => $vv['mer_id']))->save($updatearr);

					if ($flage) {
						echo '成功 store_id => ' . $vv['store_id'] . '<br/>';
						$m++;
					}
					else {
						echo '失败 store_id => ' . $vv['store_id'] . '<br/>';
						$e++;
					}
				}
			}

			echo '成功 ' . $m . ' 条<br/>';
			echo '失败 ' . $e . ' 条<br/>';
		}
	}
}


?>
