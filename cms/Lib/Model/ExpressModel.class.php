<?php
class ExpressModel extends Model{
	/* 得到快递公司列表 */
	public function get_express_list(){
		$condition_express['status'] = 1;
		$express_list = $this->field(true)->where($condition_express)->order('`sort` DESC,`id` ASC')->select();
		return $express_list;
	}
	/* 得到单个快递公司 */
	public function get_express($express_id){
		$condition_express['express_id'] = $express_id;
		$condition_express['status'] = 1;
		$express_list = $this->field(true)->where($condition_express)->find();
		return $express_list;
	}
}

?>