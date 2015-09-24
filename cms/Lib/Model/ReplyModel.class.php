<?php
class ReplyModel extends Model{
	/*得到带分页的评论列表*/
	public function get_page_reply_list($parent_id,$order_type,$tab,$order,$store_count){
		switch($tab){
			case 'high':
				$condition_reply = '`score`>3 AND ';
				break;
			case 'mid':
				$condition_reply = '`score`=3 AND ';
				break;
			case 'low':
				$condition_reply = '`score`<3 AND ';
				break;
			case 'withpic':
				$condition_reply = "`pic`<>'' AND ";
				break;
		}
		if ($order == 'time') {
			$condition_order = '`r`.`add_time` DESC';
		} elseif($order == 'score') {
			$condition_order = '`r`.`score` DESC';
		} else {
			$condition_order = '`r`.`pigcms_id` ASC';
		}
		import('@.ORG.new_reply_ajax_page');
		
		$condition_reply_page = $condition_reply."`parent_id`='$parent_id'";
		$reply_count = $this->where($condition_reply_page)->count();
		$p = new Page($reply_count,10);
		
		if($order_type == 0 && $store_count > 1){
			$reply_list = D('')->field('`s`.`name` `store_name`,`u`.`nickname`,`u`.`avatar`,`r`.*')->table(array(C('DB_PREFIX').'reply'=>'r',C('DB_PREFIX').'group_order'=>'o',C('DB_PREFIX').'merchant_store'=>'s',C('DB_PREFIX').'user'=>'u'))->where((!empty($condition_reply) ? '`r`.'.$condition_reply : '')."`r`.`parent_id`='$parent_id' AND `r`.`order_id`=`o`.`order_id` AND `o`.`store_id`=`s`.`store_id` AND `r`.`uid`=`u`.`uid`")->order($condition_order)->limit($p->firstRow.',10')->select();
		}else{		
			$reply_list = D('')->field('`u`.`nickname`,`u`.`avatar`,`r`.*')->table(array(C('DB_PREFIX').'reply'=>'r',C('DB_PREFIX').'user'=>'u'))->where((!empty($condition_reply) ? '`r`.'.$condition_reply : '')."`r`.`parent_id`='$parent_id' AND `r`.`uid`=`u`.`uid`")->order($condition_order)->limit($p->firstRow.',10')->select();
		}
		
		if($reply_list){
			$pic_arr = array();
			$new_pic_arr = array();
			foreach($reply_list as $key=>$value){
				$reply_list[$key]['add_time'] = date('Y-m-d',$value['add_time']);
				if($value['anonymous']){
					if(msubstr($value['nickname'],0,2,false) == $value['nickname']){
						$reply_list[$key]['nickname'] = msubstr($value['nickname'],0,1,false).'**';
					}else{
						$reply_list[$key]['nickname'] = msubstr($value['nickname'],0,1,false).'**'.msubstr($value['nickname'],-1,1,false);
					}
				}
				if(!empty($value['pic'])){
					$tmp_arr = explode(',',$value['pic']);
					foreach($tmp_arr as $v){
						$new_pic_arr[$v] = $key;
					}
					$pic_arr = array_merge($pic_arr,$tmp_arr);
				}
			}
			if($order_type == 0){
				$pic_filepath = 'group';
			}else{
				$pic_filepath = 'meal';
			}
			if($pic_arr){
				$condition_reply_pic['pigcms_id'] = array('in',implode(',',$pic_arr));
				$reply_pic_list = D('Reply_pic')->field('`pigcms_id`,`pic`')->where($condition_reply_pic)->select();
				$reply_image_class = new reply_image();
				foreach($reply_pic_list as $key=>$value){
					$tmp_value = $reply_image_class->get_image_by_path($value['pic'],$pic_filepath);
					$reply_list[$new_pic_arr[$value['pigcms_id']]]['pics'][] = $tmp_value;
				}
			}
		}
		$reply_page = $p->show();
		$return['count'] = $reply_count;
		$return['list']  = $reply_list;
		$return['page']  = $reply_page;
		$return['now']  = $p->nowPage;
		$return['total']  = $p->totalPage;
		return $return;
	}
	/*得到规定条数的评论列表,不带评论*/
	public function get_reply_list($parent_id,$order_type,$store_count,$limit){
		
		$condition_order = '`r`.`add_time` DESC';

		if($order_type == 0 && $store_count > 1){
			$reply_list = D('')->field('`s`.`name` `store_name`,`u`.`nickname`,`r`.*')->table(array(C('DB_PREFIX').'reply'=>'r',C('DB_PREFIX').'group_order'=>'o',C('DB_PREFIX').'merchant_store'=>'s',C('DB_PREFIX').'user'=>'u'))->where("`r`.`parent_id`='$parent_id' AND `r`.`order_id`=`o`.`order_id` AND `o`.`store_id`=`s`.`store_id` AND `r`.`uid`=`u`.`uid`")->order($condition_order)->limit($limit)->select();
		}else{		
			$reply_list = D('')->field('`u`.`nickname`,`r`.*')->table(array(C('DB_PREFIX').'reply'=>'r',C('DB_PREFIX').'user'=>'u'))->where("`r`.`parent_id`='$parent_id' AND `r`.`uid`=`u`.`uid`")->order($condition_order)->limit($limit)->select();
		}
		
		if($reply_list){
			$pic_arr = array();
			$new_pic_arr = array();
			foreach($reply_list as $key=>$value){
				$reply_list[$key]['add_time'] = date('Y-m-d',$value['add_time']);
				
				if(!empty($value['pic'])){
					$tmp_arr = explode(',',$value['pic']);
					foreach($tmp_arr as $v){
						$new_pic_arr[$v] = $key;
					}
					$pic_arr = array_merge($pic_arr,$tmp_arr);
				}
			}
			if($order_type == 0){
				$pic_filepath = 'group';
			}else{
				$pic_filepath = 'meal';
			}
			if($pic_arr){
				$condition_reply_pic['pigcms_id'] = array('in',implode(',',$pic_arr));
				$reply_pic_list = D('Reply_pic')->field('`pigcms_id`,`pic`')->where($condition_reply_pic)->select();
				$reply_image_class = new reply_image();
				foreach($reply_pic_list as $key=>$value){
					$tmp_value = $reply_image_class->get_image_by_path($value['pic'],$pic_filepath);
					$reply_list[$new_pic_arr[$value['pigcms_id']]]['pics'][] = $tmp_value;
				}
			}
		}
		return $reply_list;
	}
	
	
	/*得到规定条数的评论列表*/
	public function ajax_reply_list($parent_id, $order_type, $store_count, $limit, $start)
	{
		$condition_order = '`r`.`add_time` DESC';
		if($order_type == 0 && $store_count > 1){
			$reply_list = D('')->field('`s`.`name` `store_name`,`u`.`nickname`,`r`.*')->table(array(C('DB_PREFIX').'reply'=>'r',C('DB_PREFIX').'group_order'=>'o',C('DB_PREFIX').'merchant_store'=>'s',C('DB_PREFIX').'user'=>'u'))->where("`r`.`parent_id`='$parent_id' AND `r`.`order_id`=`o`.`order_id` AND `o`.`store_id`=`s`.`store_id` AND `r`.`uid`=`u`.`uid`")->order($condition_order)->limit($start, $limit)->select();
		}else{		
			$reply_list = D('')->field('`u`.`nickname`,`r`.*')->table(array(C('DB_PREFIX').'reply'=>'r',C('DB_PREFIX').'user'=>'u'))->where("`r`.`parent_id`='$parent_id' AND `r`.`uid`=`u`.`uid`")->order($condition_order)->limit($start, $limit)->select();
// 			echo D('')->_sql();die;
		}
		
		if($reply_list){
			$pic_arr = array();
			$new_pic_arr = array();
			foreach($reply_list as $key=>$value){
				$reply_list[$key]['add_time'] = date('Y-m-d',$value['add_time']);
				
				if(!empty($value['pic'])){
					$tmp_arr = explode(',',$value['pic']);
					foreach($tmp_arr as $v){
						$new_pic_arr[$v] = $key;
					}
					$pic_arr = array_merge($pic_arr,$tmp_arr);
				}
			}
			if($order_type == 0){
				$pic_filepath = 'group';
			}else{
				$pic_filepath = 'meal';
			}
			if($pic_arr){
				$condition_reply_pic['pigcms_id'] = array('in',implode(',',$pic_arr));
				$reply_pic_list = D('Reply_pic')->field('`pigcms_id`,`pic`')->where($condition_reply_pic)->select();
				$reply_image_class = new reply_image();
				foreach($reply_pic_list as $key=>$value){
					$tmp_value = $reply_image_class->get_image_by_path($value['pic'],$pic_filepath);
					$reply_list[$new_pic_arr[$value['pigcms_id']]]['pics'][] = $tmp_value;
				}
			}
		}
		return $reply_list;
	}


		/*得到带分页的评论列表*/
	public function get_reply_listByid($mer_id,$store_id=0,$tab='all',$order,$pagesize=0){
		$condition_reply_page=$condition_reply='';
		switch($tab){
			case 'high':
				$condition_reply = '`score`>3 AND ';
				break;
			case 'mid':
				$condition_reply = '`score`=3 AND ';
				break;
			case 'low':
				$condition_reply = '`score`<3 AND ';
				break;
			case 'withpic':
				$condition_reply = "`pic`<>'' AND ";
				break;
		}
		if ($order == 'time') {
			$condition_order = '`r`.`add_time` DESC';
		} elseif($order == 'score') {
			$condition_order = '`r`.`score` DESC';
		} else {
			$condition_order = '`r`.`pigcms_id` ASC';
		}
		import('@.ORG.common_page');
		
		$condition_reply_page =!empty($condition_reply) ? " `r`." .$condition_reply. " `r`.`mer_id`='$mer_id'" : " `r`.`mer_id`='$mer_id'";
		$condition_reply_count=$condition_reply." `mer_id`='$mer_id'";
		if($store_id>0){
		 $condition_reply_page = $condition_reply_page." AND `r`.`store_id`='$store_id'";
		 $condition_reply_count=$condition_reply_count." AND `store_id`='$store_id'";
		}
		$reply_count = $this->where($condition_reply_count)->count();

		$p = new Page($reply_count,$pagesize);
			$reply_list = D('')->field('`s`.`name` as 	store_name,`u`.`nickname`,`u`.`avatar`,`r`.*')->table(array(C('DB_PREFIX').'reply'=>'r',C('DB_PREFIX').'merchant_store'=>'s',C('DB_PREFIX').'user'=>'u'))->where($condition_reply_page." AND `r`.`store_id`=`s`.`store_id` AND `r`.`uid`=`u`.`uid`")->order($condition_order)->limit($p->firstRow.','.$pagesize)->select();
		if($reply_list){
			$pic_arr = array();
			$new_pic_arr = array();
			foreach($reply_list as $key=>$value){
				$reply_list[$key]['add_time'] = date('Y-m-d',$value['add_time']);
				if($value['anonymous']){
					if(msubstr($value['nickname'],0,2,false) == $value['nickname']){
						$reply_list[$key]['nickname'] = msubstr($value['nickname'],0,1,false).'**';
					}else{
						$reply_list[$key]['nickname'] = msubstr($value['nickname'],0,1,false).'**'.msubstr($value['nickname'],-1,1,false);
					}
				}
				if(!empty($value['pic'])){
					$tmp_arr = explode(',',$value['pic']);
					foreach($tmp_arr as $v){
						$new_pic_arr[$v] = $key;
					}
					$pic_arr = array_merge($pic_arr,$tmp_arr);
				}
			}
			if($pic_arr){
				$condition_reply_pic['pigcms_id'] = array('in',implode(',',$pic_arr));
				$reply_pic_list = D('Reply_pic')->field('`pigcms_id`,`pic`,order_type')->where($condition_reply_pic)->select();
				$reply_image_class = new reply_image();
				foreach($reply_pic_list as $key=>$value){
				$order_type=intval($value['order_type']);
				if($order_type == 0){
						$pic_filepath = 'group';
					}else{
						$pic_filepath = 'meal';
					}
					$tmp_value = $reply_image_class->get_image_by_path($value['pic'],$pic_filepath);
					$reply_list[$new_pic_arr[$value['pigcms_id']]]['pics'][] = $tmp_value;
				}
			}
		}
		$reply_page = $p->show();
		$return['count'] = $reply_count;
		$return['list']  = $reply_list;
		$return['page']  = $reply_page;
		$return['now']  = $p->nowPage;
		$return['total']  = $p->totalPage;
		return $return;
	}
}

?>