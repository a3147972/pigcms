<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>商家中心 - {pigcms{$config.site_name}</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}login/new_login.css"/>
        <script type="text/javascript">if(self!=top){window.top.location.href = "{pigcms{:U('Login/index')}";}</script>
    </head>
    <body>
        <div class="W_header_line"></div>
        <div id="hdw">
            <div id="hd" style="background-image:url({pigcms{$config.site_logo});">商家中心 - {pigcms{$config.site_name}</div>
        </div>
        <div id="login">
            <div id="switch_btn">
                <a class="login_p on" types="login">商户登录</a>
                <span class="vline">|</span>
                <a class="reg_p" types="reg">商户注册</a>
                <div class="clear"></div>
            </div>
            <div id="box">
                <div style="float:left;">
                    <form method="post" id="login_form">
                        <p>
                            <label>帐 号：</label>
                            <input class="text-input" type="text" name="account" id="login_account"/>
                            <span class="check">* 长度为6~16位字符</span>
                        </p>
                        <p>
                            <label>密码：</label>
                            <input class="text-input" type="password" name="pwd" id="login_pwd"/>
                            <span class="check">* 长度为大于6位字符</span>
                        </p>
                        <p>
                            <label>验证码：</label>
                            <input class="text-input" type="text" id="login_verify" style="width:60px;" maxlength="4" name="verify"/>&nbsp;&nbsp;
                            <span class="verify_box">
                                <img src="{pigcms{:U('Login/verify',array('type'=>'login'))}" id="login_verifyImg" onclick="login_fleshVerify('{pigcms{:U('Login/verify',array('type'=>'login'))}')" title="刷新验证码" alt="刷新验证码"/>&nbsp;
                                <a href="javascript:login_fleshVerify('{pigcms{:U('Login/verify',array('type'=>'login'))}')">刷新验证码</a>
                            </span>
                        </p>
                        <p class="btn_login"><input type="submit" value="登 录" class="login_btn"/></p>
                    </form>
                    <form method="post" id="reg_form">
                        <p>
                            <label>帐 号：</label>
                            <input class="text-input" type="text" name="account" id="reg_account"/>
                            <span class="check">* 长度为6~16位字符</span>
                        </p>
                        <p>
                            <label>密 码：</label>
                            <input class="text-input" type="password" name="pwd" id="reg_pwd"/>
                            <span class="check">* 长度为大于6位字符</span>
                        </p>
                        <p>
                            <label>推荐人：</label>
                            <input class="text-input" type="test" name="recomment" id="reg_recomment"/>
                            <span class="check">* 请输入推荐人ID</span>
                        </p>
                        <p>
                            <label>商家名称：</label>
                            <input class="text-input" type="text" name="name" id="reg_name"/>
                        </p>
                        <p>
                            <label>所在区域：</label>
                            <span id="choose_cityarea"></span>
                        </p>
                        <p>
                            <label>邮 箱：</label>
                            <input class="text-input" type="text" name="email" id="reg_email"/>
                        </p>
                        <p>
                            <label>手机号：</label>
                            <input class="text-input" type="text" name="phone" id="reg_phone"/>
                            <span class="check">* 必填</span>
                        </p>
                        <p>
                            <label>身份证号：</label>
                            <input class="text-input" type="text" name="id_number" id="reg_id_number"/>
                            <span class="check">* 必填</span>
                        </p>
                        <p>
                            <label>身份证照：</label>
                            <input class="text-input" type="text" name="id_number_img" id="reg_id_number_img" style="display:none"/>
                            <img src="" alt="" class="review_img" style="display:none;width:170px">
                            <input type="file" name="upIdNumberImg" id="upIdNumberImg" style="display:none" class="file_upload">
                            <a href="" id="AupIdNumberImg" class="reg_upload">点击上传身份证照片</a>
                            <span class="check">* 必填</span>
                        </p>
                        <p>
                            <label>手持证照：</label>
                            <input class="text-input" type="text" name="with_id_card" id="reg_with_id_card" style="display:none"/>
                            <img src="" alt="" class="review_img" style="display:none;width:170px">
                            <input type="file" name="upWithIdCard" id="upWithIdCard" style="display:none" class="file_upload">
                            <a href="" class="reg_upload">点击上传身份证照片</a>
                            <span class="check">* 必填</span>
                        </p>
                        <p>
                            <label>营业执照：</label>
                            <input class="text-input" type="text" name="business" id="reg_business"/>
                            <span class="check">* 必填</span>
                        </p>
                        <p>
                            <label>执照照片：</label>
                            <input class="text-input" type="text" name="business_img" id="reg_business_img" style="display:none"/>
                            <img src="" alt="" class="review_img" style="display:none;width:170px">
                            <input type="file" name="upbusiness_img" id="business_img" style="display:none" class="file_upload">
                            <a href="" class="reg_upload">点击上传身份证照片</a>
                            <span class="check">* 必填</span>
                        </p>
                        <p>
                            <label>验证码：</label>
                            <input class="text-input" type="text" id="reg_verify" style="width:60px;" maxlength="4" name="verify"/>&nbsp;&nbsp;
                            <span class="verify_box">
                                <img src="{pigcms{:U('Login/verify',array('type'=>'reg'))}" id="reg_verifyImg" onclick="reg_fleshVerify('{pigcms{:U('Login/verify',array('type'=>'reg'))}')" title="刷新验证码" alt="刷新验证码"/>&nbsp;
                                <a href="javascript:reg_fleshVerify('{pigcms{:U('Login/verify',array('type'=>'reg'))}')">刷新验证码</a>
                            </span>
                        </p>
                        <p class="btn_login"><input type="submit" value="注 册" class="login_btn"></p>
                    </form>
                </div>
                <div style="float:right;font-size:12px;">
                    <if condition="$config['site_phone']"><p>客服电话 ：{pigcms{$config.site_phone}</p></if>
                    <if condition="$config['site_qq']"><p>客服 Q Q ：{pigcms{$config.site_qq}</p></if>
                    <if condition="$config['site_email']"><p>联系邮箱 ：{pigcms{$config.site_email}</p></if>
                </div>
            </div>
        </div>
        <div class="copyright">
            <p style="float:left;"><a href="{pigcms{$config.site_url}">{pigcms{$config.site_name}</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<if condition="!empty($config['site_icp'])"><a href="http://www.miibeian.gov.cn/" target="_blank">{pigcms{$config.site_icp}</a></if></p>
            <p style="float:right;">Copyright &copy; <span>2015</span>&nbsp;{pigcms{$config.top_domain}</p>
        </div>
        <script type="text/javascript" src="{pigcms{:C('JQUERY_FILE')}"></script>
        <script type="text/javascript">
            var static_public="{pigcms{$static_public}",static_path="{pigcms{$static_path}",login_check="{pigcms{:U('Login/check')}",reg_check="{pigcms{:U('Login/reg_check')}",merchant_index="{pigcms{:U('Index/index')}",choose_province="{pigcms{:U('Area/ajax_province')}",choose_city="{pigcms{:U('Area/ajax_city')}",choose_area="{pigcms{:U('Area/ajax_area')}",choose_circle="{pigcms{:U('Area/ajax_circle')}", show_circle = 1;
        </script>
        <script type="text/javascript" src="{pigcms{$static_path}login/login.js"></script>
        <script type="text/javascript" src="{pigcms{$static_path}js/area.js"></script>
        <script type="text/javascript" src="{pigcms{$static_public}js/ajaxfileupload.js"></script>
        <script>
            $('.reg_upload').click(function(){
                $(this).siblings('[type=file]').trigger('click');
                return false;
            })
            $('.file_upload').change(function(){
                var id = $(this).attr('id');
                var text_element = $(this).siblings('[type=text]');
                var review_img = $(this).siblings('img.review_img');

                $.ajaxFileUpload({
                    url:"{pigcms{:U('Upload/upload')}",
                    secureuri:false,
                    fileElementId: id,
                    dataType : 'json',
                    success : function(data) {
                        if (data.status == 1) {
                            text_element.val(data.info);
                            text_element.css({'display':'none'});
                            review_img.attr('src', data.info);
                            review_img.css({'display' : 'block'});
                            $('#box').css({
                                'height' : parseInt($('#reg_form').height()) + 70 + 'px'
                            })
                        } else {
                            alert(data.info);
                        }
                    }
                })
                return false;
            })
        </script>
        <style>
        .col-sm-1 {
          border: 1px solid #ccc;
          color: #333;
          -moz-border-radius: 2px;
          -webkit-border-radius: 2px;
          border-radius: 6px;
          padding: 6px;
          outline: 0;
          box-shadow: 0px 1px 1px 0px #eaeaea inset;
        }
        </style>
    </body>
</html>