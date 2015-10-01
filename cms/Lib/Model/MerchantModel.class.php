<?php
class MerchantModel extends Model
{
    public function get_qrcode($id)
    {
        $condition_merchant['mer_id'] = $id;
        $now_merchant = $this->field('`mer_id`,`qrcode_id`')->where($condition_merchant)->find();
        if (empty($now_merchant)) {
            return false;
        }
        return $now_merchant;
    }
    public function save_qrcode($id, $qrcode_id)
    {
        $condition_merchant['mer_id'] = $id;
        $data_merchant['qrcode_id'] = $qrcode_id;
        if ($this->where($condition_merchant)->data($data_merchant)->save()) {
            return (array('error_code' => false));
        } else {
            return (array('error_code' => true, 'msg' => '保存二维码至商家信息失败！请重试。'));
        }
    }
    public function del_qrcode($id)
    {
        $condition_merchant['mer_id'] = $id;
        $data_merchant['qrcode_id'] = '';
        if ($this->where($condition_merchant)->data($data_merchant)->save()) {
            return (array('error_code' => false));
        } else {
            return (array('error_code' => true, 'msg' => '保存二维码至商家信息失败！请重试。'));
        }
    }
    /*
     * 若用户扫描了商家二维码，则为商户储存首页排序值。 若商家设置了自动增长的团购ID，则自动增长某团购。
     *
     */
    public function update_group_indexsort($mer_id)
    {
        if (empty($mer_id)) {
            return false;
        }

        $condition_merchant['mer_id'] = $mer_id;
        $now_merchant = $this->field('`auto_indexsort_groupid`')->where($condition_merchant)->find();
        if (empty($now_merchant)) {
            return false;
        }
        $merchant_qrcode_indexsort = C('config.merchant_qrcode_indexsort');
        if ($now_merchant['auto_indexsort_groupid']) {
            $database_group = D('Group');
            $condition_group['group_id'] = $now_merchant['auto_indexsort_groupid'];
            if ($database_group->where($condition_group)->setInc('index_sort', $merchant_qrcode_indexsort)) {
                return true;
            }
        }
        $this->where($condition_merchant)->setInc('storage_indexsort', $merchant_qrcode_indexsort);
    }

    public function get_merchants_by_long_lat($lat, $long, $around_range = 2000)
    {
        import('@.ORG.longlat');
        $longlat_class = new longlat();
        $location2 = $longlat_class->gpsToBaidu($lat, $long); //转换腾讯坐标到百度坐标
        $lat = $location2['lat'];
        $long = $location2['lng'];

        $Model = new Model();
        $sql = "SELECT s.lat, s.long, s.mer_id, s.name as sname, s.store_id, m.name, m.phone, s.adress, m.pic_info, ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$lat}*PI()/180-`s`.`lat`*PI()/180)/2),2)+COS({$lat}*PI()/180)*COS(`s`.`lat`*PI()/180)*POW(SIN(({$long}*PI()/180-`s`.`long`*PI()/180)/2),2)))*1000) as juli FROM " . C('DB_PREFIX') . "merchant_store AS s INNER JOIN " . C('DB_PREFIX') . "merchant AS m ON s.mer_id=m.mer_id WHERE `s`.`status`=1 AND ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$lat}*PI()/180-`s`.`lat`*PI()/180)/2),2)+COS({$lat}*PI()/180)*COS(`s`.`lat`*PI()/180)*POW(SIN(({$long}*PI()/180-`s`.`long`*PI()/180)/2),2)))*1000) < '$around_range'";
        $result = $Model->query($sql);
        $merchant_image_class = new merchant_image();
        foreach ($result as &$r) {
            $images = explode(";", $r['pic_info']);
            $images = explode(";", $images[0]);
            $r['img'] = $merchant_image_class->get_image_by_path($images[0]);
            $r['url'] = C('config.site_url') . '/wap.php?c=Index&a=index&token=' . $r['mer_id'];
        }
        return $result;
    }

    /**
     * 根据用户名返回商户id
     * @method getInfo
     * @param  string  $account 商户用户名
     * @return bool|int         成功返回商户id,失败返回false
     */
    public function getInfo($account)
    {
        $map['account'] = $account;

        $mer_id = $this->where($map)->field('mer_id')->find();

        if ($mer_id['mer_id']) {
            return $mer_id['mer_id'];
        } else {
            return false;
        }
    }

    /**
     * 根据id返回商户信息
     * @method getInfoById
     * @param  int      $mer_id 商户id
     * @return bool|array       成功返回商户信息，失败返回false
     */
    public function getInfoById ($mer_id)
    {
        $map['mer_id'] = $mer_id;
        $info = $this->where($map)->find();

        if ($info) {
            return $info;
        } else {
            return false;
        }
    }
    /**
     * 增加商户金额
     * @method addBalance
     * @param  int     $mer_id  商户id
     * @param  integer    $balance 要增加的金额
     * @return  bool 是否加成功
     */
    public function addBalance($mer_id, $balance = 0, $order_id, $order_type)
    {
        if (empty($balance)) {
            return true;
        }
        $map['mer_id'] = $mer_id;

        $data['balance'] = array('exp', 'balance+' . $balance);

        $this->startTrans();
        $result = $this->where($map)->save($data);
        $insert_log = D('MerchantValanceLog')->insert($mer_id, 1, $order_id, $balance, $order_type);

        if ($result !== false && $insert_log !== false) {
            $this->commit();
            return true;
        } else {
            $this->rollback();
            return false;
        }
    }

    /**
     * 使用金额
     * @method useBalance
     * @param  int     $mer_id  商户id
     * @param  integer    $balance 要扣减金额
     * @return bool               成功返回true,失败返回false
     */
    public function useBalance($mer_id, $balance = 0)
    {
        if (empty($balance)) {
            return true;
        }
        $map['mer_id'] = $mer_id;

        $data['balance'] = array('exp', 'balance-'. $balance);

        $result = $this->where($map)->save($data);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
