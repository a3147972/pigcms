<?php
class InviteCode extends BaseAction
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
}