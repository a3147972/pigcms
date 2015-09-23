<?php
/*
 * 图片上传
 *
 */

class UploadAction extends CommonAction
{
    public function editor_ajax_upload()
    {
        if (!in_array($_GET['upload_dir'], array('group/content', 'merchant/news', 'activity/content', 'system/image', 'activity/index_pic'))) {
            $this->editor_alert('非法的目录！');
        }

        if ($_FILES['imgFile']['error'] != 4) {
            $uid = $_SESSION['merchant']['mer_id'] ? $_SESSION['merchant']['mer_id'] : ($_SESSION['system']['mer_id'] ? $_SESSION['system']['mer_id'] : mt_rand(10000, 99999));
            $img_mer_id = sprintf("%09d", $uid);
            $rand_num = mt_rand(10, 99) . '/' . substr($img_mer_id, 0, 3) . '/' . substr($img_mer_id, 3, 3) . '/' . substr($img_mer_id, 6, 3);

            $upload_dir = './upload/' . $_GET['upload_dir'] . '/' . $rand_num . '/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            import('ORG.Net.UploadFile');
            $upload = new UploadFile();
            // $upload->maxSize = $this->config['group_pic_size']*1024*1024;
            $upload->allowExts = array('jpg', 'jpeg', 'png', 'gif');
            $upload->allowTypes = array('image/png', 'image/jpg', 'image/jpeg', 'image/gif');
            $upload->savePath = $upload_dir;
            $upload->thumb = false;
            $upload->saveRule = 'uniqid';
            if ($upload->upload()) {
                $uploadList = $upload->getUploadFileInfo();
                $url = $upload_dir . $uploadList[0]['savename'];
                exit(json_encode(array('error' => 0, 'url' => $url)));
            } else {
                $this->editor_alert($upload->getErrorMsg());
            }
        } else {
            $this->editor_alert('没有选择图片！');
        }
    }


}
