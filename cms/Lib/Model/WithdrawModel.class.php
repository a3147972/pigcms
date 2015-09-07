<?php
class WithdrawModel extends Model
{
    /**
     * 新增提现记录
     * @method addWithdraw
     * @param  int      $uid    用户或商户id
     * @param  int      $type   用户类型 1-会员 2-商户
     * @param  int      $amount 提现金额
     * @return bool             成功返回true,失败返回false
     */
    public function addWithdraw($uid, $type, $amount)
    {
        $data['uid'] = $uid;
        $data['user_type'] = $type;
        $data['amount'] = $amount;
        $data['status'] = 0;
        $data['ctime'] = date('Y-m-d H:i:s', time());
        $data['mtime'] = date('Y-m-d H:i:s', time());

        $result = $this->add($data);

        if ($result) {
            return true;
        } else{
            return false;
        }
    }
}