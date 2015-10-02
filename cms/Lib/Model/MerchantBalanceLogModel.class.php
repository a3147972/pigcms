<?php
class MerchantBalanceLogModel extends Model
{
    protected $tableName = 'merchant_balance_log';

    /**
     * 写入商户金额记录
     * @method insert
     * @param  int $mer_id     商户id
     * @param  int $type          类型 1-收入 2-支出
     * @param  int $order_id      订单id
     * @param  string $order_type    订单类型
     * @return bool                成功返回true，失败返回false
     */
    public function insert($mer_id, $type, $order_id, $balance, $order_type)
    {
        $data['mer_id'] = $mer_id;
        $data['type'] = $type;
        $data['order_id'] = $order_id;
        $data['balance'] = $balance;
        $data['order_type'] = $order_type;
        $data['ctime'] = date('Y-m-d H:i:s', time());

        $result = $this->add($data);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}