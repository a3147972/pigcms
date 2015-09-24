<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <title>微信版介绍页 | {pigcms{$config.site_name}</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <link rel="stylesheet" href="{pigcms{$config.site_url}/tpl/Static/default/weixin/weixin.css"/>
</head>
<body>
<div id="header">
    <a class="site-logo" href="{pigcms{$config.site_url}"><img src="{pigcms{$config.site_logo}" style="height:43px;"/></a>
    <div id="menu">
        <span><a href="javascript:void(0)" id="weixin">微信版</a></span>
        <span><a href="javascript:void(0)" id="web">手机网页版</a></span>
    </div>
    <div id="web-tip" class="hide">
        <div id="arrow"></div>
        手机浏览器访问{pigcms{$_SERVER.SERVER_NAME}，无需安装，立刻访问
    </div>
</div>
<div class="nav" id="primary">
    <ul>
        <li>
            <a class="active" href="#page-1" id="nav-1">Page-1</a>
        </li>
        <li>
            <a class="" href="#page-2" id="nav-2">Page-2</a>
        </li>
        <li>
            <a class="" href="#page-3" id="nav-3">Page-3</a>
        </li>
        <li>
            <a class="" href="#page-4" id="nav-4">Page-4</a>
        </li>
    </ul>
</div>
<div class="page page-1 fl"></div>
<div class="page page-2 fl"></div>
<div class="page page-3 fl"></div>
<div class="page page-4 fl"></div>
<div id="content">
    <div class="page" id="page-1">
        <div class="phone-wrapper position">
            <div class="top">
                <div class="phone"></div>
                <div class="circle"></div>
                <div id="wheel-1"></div>
                <div id="wheel-2"></div>
                <div id="wheel-3"></div>
                <div id="wheel-4"></div>
            </div>
        </div>
        <div class="fixed">
            <div class="top-1">
                <div id="description">
                </div>
                <div id="qrcode-wrapper">
                    <div class="qrcode" style="background-image:url({pigcms{$config.wechat_qrcode});background-size:100%;filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='{pigcms{$config.wechat_qrcode}',sizingMethod='scale');"></div>
                    <div id="btn">
                        <a href="javascript:void(0)">立即下载</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page" id="page-2">
        <div class="map-wrapper position">
            <div class="top-2">
                <div id="map"></div>
                <div id="cloud"></div>
                <div id="nail"></div>
            </div>
        </div>
    </div>
    <div class="page" id="page-3">
        <div class="shop-wrapper position">
            <div class="top-3">
                <div id="v-phone"></div>
                <div id="function"></div>
                <div id="shop"></div>
            </div>
        </div>
    </div>
    <div class="page" id="page-4">
        <div class="gift-wrapper position">
            <div class="top-4">
                <div id="gift_1"></div>
                <div id="gift_2"></div>
                <div id="ballon"></div>
                <div id="phone_1"></div>
                <div id="phone_2"></div>
            </div>
        </div>
    </div>
    <div class="footer" id="page-5">
        <div class="bg">
            <ul>
                <li class="bg1"></li>
                <li class="bg2"></li>
                <li class="bg3"></li>
                <li class="bg4"></li>
            </ul>
        </div>
    </div>
</div>

<div class="pop hide" id="pop">
    <div class="main">
        <div class="pop-wrapper">
            <div class="downloads" id="downloads">
                <!-- android panel start -->
                <div class="left-panel">
                    <div class="qrcode-bg">
                        <div class="qrcode" style="background-image:url({pigcms{$config.wechat_qrcode});background-size:100%;filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='{pigcms{$config.wechat_qrcode}',sizingMethod='scale');"></div>
                    </div>
                    <p style="font-size:14px;padding-left:6px;line-height: 1.5em;">微信扫描二维码快速访问</p>
                </div>
            </div>
        </div>
        <!-- android panel end -->
    </div>
    <div class="sprites close" id="close"></div>
</div>
</div>
<div id="shade" class="shade hide"></div>
<script src="{pigcms{$config.site_url}/tpl/Static/default/weixin/jquery.js"></script>
<script src="{pigcms{$config.site_url}/tpl/Static/default/weixin/rotate.js"></script>
<script src="{pigcms{$config.site_url}/tpl/Static/default/weixin/weixin.js"></script>
</body>
</html>
