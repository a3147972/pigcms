<?php

class InvitationModel extends Model
{
    public function get_list($lat, $long, $page, $pagesize, $activity_type)
    {
        $where = array(
            "status"      => 0,
            "invite_time" => array("gt", time())
            );

        if ($activity_type !== false) {
            $sql = "SELECT i.*, u.* FROM " . C("DB_PREFIX") . "user as u INNER JOIN " . C("DB_PREFIX") . "invitation as i ON i.uid=u.uid WHERE i.status=0 AND i.activity_type=" . $activity_type . " AND i.invite_time>" . time() . " ORDER BY i.pigcms_id DESC, u.sex DESC";
            $where["activity_type"] = intval($activity_type);
        }
        else {
            $sql = "SELECT i.*, u.* FROM " . C("DB_PREFIX") . "user as u INNER JOIN " . C("DB_PREFIX") . "invitation as i ON i.uid=u.uid WHERE i.status=0 AND i.invite_time>" . time() . " ORDER BY i.pigcms_id DESC, u.sex DESC";
        }

        $start = ($page - 1) * $pagesize;
        $count = $this->where($where)->count();
        $sql .= " limit $start, $pagesize";
        $mode = new Model();
        $res = $mode->query($sql);
        $today = strtotime(date("Y-m-d")) + 86400;
        $tomorrow = $today + 86400;
        $lastday = $tomorrow + 86400;

        foreach ($res as &$v ) {
            $v["_time"] = date("Y-m-d H:i", $v["invite_time"]);
            $v["juli"] = ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(((($lat * PI()) / 180) - (($v["lat"] * PI()) / 180)) / 2), 2) + (COS(($lat * PI()) / 180) * COS(($v["lat"] * PI()) / 180) * POW(SIN(((($long * PI()) / 180) - (($v["long"] * PI()) / 180)) / 2), 2)))) * 1000);
            $v["juli"] = (1000 < $v["juli"] ? number_format($v["juli"] / 1000, 1) . "km" : ($v["juli"] < 100 ? "<100m" : $v["juli"] . "m"));
            $v["invite_time"] = ($v["invite_time"] < $today ? "今天 " . date("H:i", $v["invite_time"]) : ($v["invite_time"] < $tomorrow ? "明天  " . date("H:i", $v["invite_time"]) : ($v["invite_time"] < $lastday ? "后天  " . date("H:i", $v["invite_time"]) : date("m-d H:i", $v["invite_time"]))));
            $v["birthday"] && ($v["age"] = date("Y") - date("Y", strtotime($v["birthday"])));
            $v["age"] = ((100 < $v["age"]) || ($v["age"] < 0) ? "保密" : $v["age"] . "岁");
        }

        return array("data" => $res, "total" => $count);
    }
}


?>
