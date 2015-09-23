<?php
class UploadAction extends BaseAction
{
    public function upload()
    {
        $base64 = I('post.base64', '');

        if (empty($base64)) {
            $info['status'] = 0;
            $info['info'] = '请选择上传文件';
            die(json_encode($info));
        }
        $base64 = str_replace('data:', '', $base64); //去掉data:
        $base64_arr = explode(';', $base64);

        $allow_ext = array('.gif' => 'image/gif', '.jpeg' => 'image/jpeg', '.png' => 'image/png', '.jpg'=>'image/jpg');
        //上传格式判断
        if (!in_array($base64_arr[0], $allow_ext)) {
            $info['status'] = 0;
            $info['info'] = '只能上传gif,jpg,png格式文件';
            die(json_encode($info));
        }

        $ext = array_search($base64_arr[0], $allow_ext);

        $filepath = './upload/' . date('Ymd') . '/';

        if (!file_exists($filepath)) {
            mkdir($filepath, 0777, true);
        }
        $filename = $filepath . uniqid() . $ext;
        $content = str_replace('base64,', '', $base64_arr[1]);
        $result = file_put_contents($filename, base64_decode($content));

        if ($result) {
            $info['status'] = 1;
            $info['path'] = $filename;
        } else {
            $info['status'] = 0;
            $info['info'] = '上传失败';
        }
        die(json_encode($info));
    }
}
