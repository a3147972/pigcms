<?php

class longlat
{
    public function gpsToBaidu($lat, $lng)
    {
        $x_pi = (3.1415926535898 * 3000) / 180;
        $x = $lng;
        $y = $lat;
        $z = sqrt(($x * $x) + ($y * $y)) + (2.0E-5 * sin($y * $x_pi));
        $theta = atan2($y, $x) + (3.0E-6 * cos($x * $x_pi));
        $lng = ($z * cos($theta)) + 0.0065;
        $lat = ($z * sin($theta)) + 0.006;
        return array("lng" => $lng, "lat" => $lat);
    }

    public function rad($d)
    {
        return ($d * 3.1415926535898) / 180;
    }

    public function GetDistance($lat1, $lng1, $lat2, $lng2)
    {
        $EARTH_RADIUS = 6378.137;
        $radLat1 = rad($lat1);
        $radLat2 = rad($lat2);
        $a = $radLat1 - $radLat2;
        $b = rad($lng1) - rad($lng2);
        $s = 2 * asin(sqrt(pow(sin($a / 2), 2) + (cos($radLat1) * cos($radLat2) * pow(sin($b / 2), 2))));
        $s = $s * $EARTH_RADIUS;
        $s = round($s * 10000) / 10000;
        $s = $s * 1000;
        return ceil($s);
    }

    public function mToKm($range)
    {
        $return = array();

        if ($range < 100) {
            $return["num"] = $range;
            $return["unit"] = "m";
            $return["cunit"] = "米";
        }
        else if ($range < 1000) {
            $return["num"] = round($range, 1);
            $return["unit"] = "km";
            $return["cunit"] = "千米";
        }
        else if (range < 5000) {
            $return["num"] = round($range, 2);
            $return["unit"] = "km";
            $return["cunit"] = "千米";
        }
        else if (range < 10000) {
            $return["num"] = round($range, 1);
            $return["unit"] = "km";
            $return["cunit"] = "千米";
        }
        else {
            $return["num"] = floor($range / 1000);
            $return["unit"] = "km";
            $return["cunit"] = "千米";
        }

        return $return;
    }
}


?>
