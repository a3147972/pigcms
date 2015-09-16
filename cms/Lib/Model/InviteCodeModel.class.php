<?php
class InviteCodeModel extends Model
{
    protected $tableName = 'invitcode';

    /**
     * 检测邀请码是否存在
     * @method checkCode
     * @param  [type]    $code [description]
     * @param  integer   $type [description]
     * @return [type]          [description]
     */
    public function checkCode($code, $type = 1)
    {
        $map['type'] = $type;
        $map['code'] = $code;
        $map['is_used'] = 0;

        $result = $this->where($map)->field('code')->find();

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * 使用邀请码
     * @method usedCode
     * @param  string   $code 邀请码
     * @return bool         成功返回true
     */
    public function usedCode($code)
    {

        $map['code'] = $code;

        $data['utime'] = date('Y-m-d H:i:s', time());
        $data['is_used'] = 1;

        $result = $this->where($map)->save($data);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}