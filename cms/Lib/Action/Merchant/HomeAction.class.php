<?php

class HomeAction extends BaseAction
{
    public function set()
    {
        $home = D("Home")->where(array("token" => $this->merchant_session["mer_id"]))->find();

        if (IS_POST) {
            $data = array();
            $data["token"] = $this->merchant_session["mer_id"];
            $data["picurl"] = (!empty($_POST["picurl"]) ? htmlspecialchars($_POST["picurl"]) : "");
            $data["title"] = (!empty($_POST["title"]) ? htmlspecialchars($_POST["title"]) : "");
            $data["info"] = (!empty($_POST["info"]) ? htmlspecialchars($_POST["info"]) : "");

            if ($home == false) {
                D("Home")->add($data);
            }
            else {
                D("Home")->where(array("token" => $this->merchant_session["mer_id"]))->save($data);
            }

            $this->success("设置成功");
        }
        else {
            $merchant_image_class = new merchant_image();
            if(empty($home['picurl'])){
                $home['picurl'] = array('url' => '', 'title' => '');
            }else{
                $home['picurl'] = array(
                    'title' => $home['picurl'],
                    'url' => $merchant_image_class->get_image_by_path($home['picurl']),
                );
            }
            $this->assign("info", $home);
            $this->display();
        }
    }
}


?>
