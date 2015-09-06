<?php
class BaseModel extends Model
{
    protected $config = array();
    public function _initialize()
    {
        $config = D('Config')->get_config();
        $this->config = array_merge(C(), $config);
    }
}