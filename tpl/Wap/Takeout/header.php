<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">

<script type="text/javascript" src="{pigcms{$static_path}takeout/js/jquery1.8.3.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}takeout/js/dialog.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}takeout/js/main.js"></script>

<title>{pigcms{$store['name']}</title>
<meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
<meta name="Keywords" content="">
<meta name="Description" content="">
<meta content="telephone=no, address=no" name="format-detection">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<style  type="text/css">
.search input, .ico_takeout, .ico_order, .ico_addres, .ico_tel, .ico_arrow, .ico_addres1, .ico_menu i, .menu_list .btn, .cart_num, .ico_close, .pay_type li input:checked::after, .dialog_close, .ico_status i, .shopping_cart .cart_bg, .ico_rest{display: inline-block; background: url({pigcms{$static_path}takeout/image/s.png) no-repeat; background-size: 150px auto;}
.fixed, .store_list li, .box, .box li, .side_nav, .side_nav a, .menu_tt h2, .menu_list li, .menu_list .btn, .menu_list .num, .pay_type, .timeBox div, .timeBox a, .txt, .my_order li, .detail_tools, .my_menu_list, .my_menu_list th, .my_menu_list td, .store_info, .ico_menu_wrap, .menu_wrap.skin1 .menu_nav{-webkit-border-image: url({pigcms{$static_path}takeout/image/border.gif) 2 stretch;}
.store_list .img_tt > div{display: block; width: 62px; height: 62px; padding: 6px; background: url({pigcms{$static_path}takeout/image/img_bg.png) no-repeat; background-size: cover;}
.nopic{background: #e4e4e4 url({pigcms{$static_path}takeout/image/nopic.png) center center no-repeat; background-size: 61px auto; border-radius: 3px;}
.sales{display: inline-block; width: 66px; height: 10px; background: url({pigcms{$static_path}takeout/image/star.png) 0 0 repeat-x; background-size: 14px auto; margin-left: 4px; vertical-align: -1px;}
.sales strong{display: inline-block; width: 0; height: 10px; background: url({pigcms{$static_path}takeout/image/star.png) 0 -12px repeat-x; background-size: 14px auto; vertical-align: top;}
.menu_wrap.skin1 .menu_nav{right: auto; left: 0; width: 84px; padding-left: 10px; background: url({pigcms{$static_path}takeout/image/nav_bg.jpg) no-repeat; background-size: 100% 100%; border-width: 0 1px 0 0;}
.ico_success, .ico_failure{display: inline-block; width: 88px; height: 88px; border: 2px solid #ff5f32; border-radius: 88px; background: url({pigcms{$static_path}takeout/image/success.png) -2px -2px no-repeat; background-size: 92px auto;}
.ico_score, .ico_score strong{background: url({pigcms{$static_path}takeout/image/star1.png) repeat-x; background-size: 33px auto;}
.ico_scored, .ico_scored strong{background: url({pigcms{$static_path}takeout/image/star2.png) repeat-x; background-size: 15px auto;}

#dingcai_adress_info{
border-top: 1px solid #ddd8ce;
border-bottom: 1px solid #ddd8ce;
position: relative;
}
#dingcai_adress_info:after{
position: absolute;
right: 8px;
top: 50%;
display: block;
content: '';
width: 13px;
height: 13px;
border-left: 3px solid #999;
border-bottom: 3px solid #999;
-webkit-transform: translateY(-50%) scaleY(0.7) rotateZ(-135deg);
-moz-transform: translateY(-50%) scaleY(0.7) rotateZ(-135deg);
-ms-transform: translateY(-50%) scaleY(0.7) rotateZ(-135deg);
}


#enter_im_div {
  bottom: 121px;
  z-index: 11;
  display: none;
  position: fixed;
  width: 100%;
  max-width: 640px;
  height: 1px;
}
#enter_im {
  width: 94px;
  margin-left: 110px;
  position: relative;
  left: -100px;
  display: block;
}
a {
  color: #323232;
  outline-style: none;
  text-decoration: none;
}
#to_user_list {
  height: 16px;
  padding: 7px 6px 8px 8px;
  background-color: #00bc06;
  border-radius: 25px;
  /* box-shadow: 0 0 2px 0 rgba(0,0,0,.4); */
}
#to_user_list_icon_div {
  width: 20px;
  height: 16px;
  background-color: #fff;
  border-radius: 10px;
}

.rel {
  position: relative;
}
.left {
  float: left;
}
.to_user_list_icon_em_a {
  left: 4px;
}
#to_user_list_icon_em_num {
  background-color: #f00;
}
#to_user_list_icon_em_num {
  width: 14px;
  height: 14px;
  border-radius: 7px;
  text-align: center;
  font-size: 12px;
  line-height: 14px;
  color: #fff;
  top: -14px;
  left: 68px;
}
.hide {
  display: none;
}
.abs {
  position: absolute;
}
.to_user_list_icon_em_a, .to_user_list_icon_em_b, .to_user_list_icon_em_c {
  width: 2px;
  height: 2px;
  border-radius: 1px;
  top: 7px;
  background-color: #00ba0a;
}
.to_user_list_icon_em_a {
  left: 4px;
}
.to_user_list_icon_em_b {
  left: 9px;
}
.to_user_list_icon_em_c {
  right: 4px;
}
.to_user_list_icon_em_d {
  width: 0;
  height: 0;
  border-style: solid;
  border-width: 4px;
  top: 14px;
  left: 6px;
  border-color: #fff transparent transparent transparent;
}
#to_user_list_txt {
  color: #fff;
  font-size: 13px;
  line-height: 16px;
  padding: 1px 3px 0 5px;
}
</style>
<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}takeout/css/main.css" media="all">
</head>