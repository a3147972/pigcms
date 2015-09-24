<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<if condition="$is_wexin_browser">
		<title>{pigcms{$now_store.name}</title>
	<else/>
		<title>【{pigcms{$now_store.name}】图片|电话|地址_{pigcms{$config.site_name}</title>
	</if>
	<meta name="description" content="{pigcms{$config.seo_description}">
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
    <link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
	<link href="{pigcms{$static_path}css/idangerous.swiper.css" rel="stylesheet"/>
	<style>
		.albumContainer {
			position: fixed;
			width: 100%;
			height: 100%;
			left: 0;
			top: 0;
			background: #000;
			z-index: 1000;
			display: none;
			overflow: hidden;
			-webkit-transform-origin: 0px 0px;
			opacity: 1;
			-webkit-transform: scale(1,1);
		}
		.swiper-slide{
			display: -webkit-box;
			display: -ms-flexbox;
			overflow: hidden;
			-webkit-box-align: center;
			-webkit-box-pack: center;
			-ms-box-align: center;
			-ms-flex-pack: justify;
		}
		.swiper-slide img{
			width:auto;
			height:auto;
			max-width:100%;
			max-height:90%;
		}
		.swiper-pagination{
			left: 0;
			top: 10px;
			text-align: center;
			bottom:auto;
			right:auto;
			width:100%;
		}
		.swiper-close{
			right:10px;
			top:5px;
			text-align:right;
			position:absolute;
			z-index:21;
			color:white;
			font-size:.7rem;
		}
		.img-count {
	        position: absolute;
	        right: 0;
	        border: .1rem;
	        z-index: 2;
	        background: rgba(0,0,0,.6);
	        color: white;
	        bottom: .1rem;
	        padding: .1rem;
	    }
	    .comments {
	        color: #999;
	        margin-left: .1rem;
	        vertical-align: middle;
	    }
	    #poi .dealcard-block-right {
	        height: 1.68rem;
	    }
	    #poi .dealcard-brand {
	        height: .7rem;
	        margin-bottom: .2rem;
	    }
	    #poi .rating {
	        margin-bottom: .2rem;
	    }
	    #poi .kv-line-r h6 {
	        line-height: 1.41;
	        text-align: justify;
	        margin-top: -.2em;
	        margin-bottom: -.2em;
	    }
		.js-web-btn .web-text:after {
	        content: "进入商家微官网";
	    }
	    .js-fav-btn .fav-text {
	        vertical-align: top;
	    }
		
	    .js-fav-btn .fav-text:after {
	        content: "收藏";
	    }
	
	    .js-fav-btn .icon-star {
	        display: none
	    }
	
	    .js-fav-btn .icon-star-empty {
	        display: inline-block
	    }
	
	    .js-fav-btn.faved .fav-text:after {
	        content: "取消收藏";
	    }
	
	    .js-fav-btn.faved .icon-star {
	        display: inline-block
	    }
	
	    .js-fav-btn.faved .icon-star-empty {
	        display: none
	    }
	    .btn-line {
	        display: -webkit-box;
	    }
	    .btn-line .btn {
	        -webkit-box-flex: 1;
	        display: block;
	        padding: 0;
	    }
	    .btn-line .color-strong {
	        -webkit-box-flex: .8;
	    }
	    .btn-margin {
	        margin: 0 .2rem;
	    }
	    .btn-line .text-icon {
	        margin-right: .14rem;
	        vertical-align: top;
	        height: 100%;
	    }
	    .kv-line{
	        margin: 0;
	    }
	
	    .kv-line p {
	        color: #666;
	    }
	    .historydeal small {
	        margin-left: .2rem;
	        font-size: 100%;
	        color: #999;
	    }
	    .react>.kv-line-r {
	        margin: 0;
	        color: #666;
	    }
	    .react>.kv-line-r p{
	        border-left: 1px solid #ddd8ce;
	        padding-left: .2rem;
	    }
	    .react>.kv-line-r .text-icon {
	         margin-right: .1rem;
	     }
	    .react>.kv-line-r p {
	        color: #2bb2a3;
	        display: -webkit-box;
	        -webkit-box-align: center;
	        display: -ms-flex-box;
	        -ms-box-align: center;
	    }
	    .msg-option-btns{
			margin-top: .07rem;
		}
	</style>
	<style>.msg-bg{background:rgba(0,0,0,.4);position:absolute;top:0;left:0;width:100%;z-index:998}.msg-doc{position:fixed;left:.16rem;right:.16rem;bottom:15%;border-radius:.06rem;background:#fff;overflow:hidden;z-index:999}.msg-hd{background:#f0efed;color:#333;text-align:center;padding:.28rem 0;overflow:hidden;font-size:.4rem;border-bottom:1px solid #ddd8ce}.msg-bd{font-size:.34rem;padding:.28rem;border-bottom:1px solid #ddd8ce}.msg-toast{background:rgba(0,0,0,.8);font-size:.4rem;color:#fff;border:0;text-align:center;padding:.4rem;-webkit-animation-name:pop-hide;-webkit-animation-duration:5s;border-radius:.12rem;bottom:60%;opacity:0;pointer-events:none}.msg-confirm,.msg-alert{-webkit-animation-name:pop;-webkit-animation-duration:.3s}.msg-option{-webkit-animation-name:slideup;-webkit-animation-duration:.3s}@-webkit-keyframes pop-hide{0%{-webkit-transform:scale(0.8);opacity:0}2%{-webkit-transform:scale(1.1);opacity:1}6%{-webkit-transform:scale(1)}90%{-webkit-transform:scale(1);opacity:1}100%{-webkit-transform:scale(0.9);opacity:0}}@-webkit-keyframes pop{0%{-webkit-transform:scale(0.8);opacity:0}40%{-webkit-transform:scale(1.1);opacity:1}100%{-webkit-transform:scale(1)}}@-webkit-keyframes slideup{0%{-webkit-transform:translateY(100%)}40%{-webkit-transform:translateY(-10%)}100%{-webkit-transform:translateY(0)}}.msg-ft{display:-webkit-box;display:-ms-flexbox;font-size:.34rem}.msg-ft .msg-btn{display:block;-webkit-box-flex:1;-ms-flex:1;margin-right:-1px;border-right:1px solid #ddd8ce;height:.88rem;line-height:.88rem;text-align:center;color:#2bb2a3}.msg-btn:last-child{border-right:0}.msg-option{background:0;bottom:55px}.msg-option div:first-child,.msg-option .msg-option-btns:first-child .btn:first-child{border-radius:.06rem .06rem 0 0;border-top:0}.msg-option .btn{width:100%;background:#fff;border:0;color:#2bb2a3;border-radius:0}.msg-option .msg-bd{background:#fff;border-bottom:0}.msg-option .btn{height:.8rem;line-height:.8rem;border-top:1px solid #ccc}.msg-option-btns .btn:last-child{border-radius:0 0 .06rem .06rem;border-bottom:1px solid #ccc}.msg-option .msg-btn-cancel{padding:0;margin-top:.14rem;color:#2bb2a3;border-radius:.06rem}.msg-dialog .msg-hd{background-color:#fff}.msg-dialog .msg-bd{background-color:#f0efed}.msg-slide{background:0;bottom:0;left:0;right:0;border-radius:0;-webkit-animation-name:slideup;-webkit-animation-duration:.3s}</style>
</head>
<body id="index" data-com="pagecommon">
        <dl class="list list-in" id="poi">
		    <dd class="dd-padding">
			    <div class="dealcard">
			        <div class="album view_album" data-pics="<volist name="now_store['all_pic']" id="vo">{pigcms{$vo}<if condition="count($now_store['all_pic']) gt $i">,</if></volist>">
			            <div class="dealcard-img imgbox">
			                <span class="img-count">共{pigcms{:count($now_store['all_pic'])}张</span>
			            	<img src="{pigcms{$now_store.all_pic.0}" style="height:100%;"/>
			            </div>
			        </div>
			        <div class="dealcard-block-right">
			            <div class="dealcard-brand">{pigcms{$now_store.name}</div>
						<a class="js-web-btn btn btn-block color-strong btn-weak" style="width:3rem;" href="{pigcms{:U('Index/index',array('token'=>$now_store['mer_id']))}"><span class="web-text"></span></a>
			        </div>
			    </div>
		    </dd>
		    <dd>
		    	<a class="react phone" data-phone="{pigcms{$now_store.phone}">
		    		<div class="kv-line-r">
		        		<h6><i class="text-icon">✆</i> {pigcms{$now_store.phone}</h6>
		        		<p>拨打电话</p>
		    		</div>
		    	</a>
		    </dd>
		    <dd>
		    	<a class="react" href="{pigcms{:U('Group/addressinfo',array('store_id'=>$now_store['store_id']))}">
		    		<div class="kv-line-r">
		        		<h6><i class="text-icon">⦿</i> {pigcms{$now_store.area_name}{pigcms{$now_store.adress}</h6>
		        		<p>查看地图</p>
		    		</div>
		    	</a>
		    </dd>
		    <dd class="dd-padding btn-line">
		        <a class="js-fav-btn btn btn-block color-strong btn-weak <if condition="$now_store['is_collect']">faved</if>" fav-type="group_shop" fav-id="{pigcms{$now_store.store_id}"><i class="text-icon icon-star"></i><i class="text-icon icon-star-empty"></i><span class="fav-text"></span></a>
		        <a class="btn btn-block btn-weak btn-margin" data-com="share" data-share-text="这家店不错哦，一起去吧！{pigcms{$now_store.name}，{pigcms{$now_store.area_name}{pigcms{$now_store.adress}，{pigcms{$now_store.phone}。{pigcms{$config.site_url}/group/shop/{pigcms{$now_store.store_id}.html" data-share-pic="{pigcms{$now_store.all_pic.0}"><i class="text-icon icon-share"></i> 分享</a>
		    </dd>
		</dl>
		<dl class="list">
       		<dd>
       			<dl class="list">
        			<dt>本店{pigcms{$config.group_alias_name}</dt>
        			<volist name="store_group_list" id="vo">
       				<dd>
       					<a href="{pigcms{$vo.url}" class="react">
                			<div class="simpleCard">
                				<div class="dealcard">
                					<if condition="$vo['tuan_type'] eq 0">
            							<span class="dealtype-icon">团</span>
            						<elseif condition="$vo['tuan_type'] eq 1"/>
            							<span class="dealtype-icon dealcard-magiccard">券</span>
            						</if>
    								<div class="dealcard-block-right">
        								<div class="title text-block">[{pigcms{$vo.group_name}]{pigcms{$vo.merchant_name}：{pigcms{$vo.s_name}</div>
								        <div class="price">
								            <strong>{pigcms{$vo['price']}</strong>
								            <span class="strong-color">元</span>
								            <if condition="$vo['wx_cheap']">
								           		<span class="tag">微信立减{pigcms{$vo.wx_cheap}</span>
								            <else/>
								            	<del>{pigcms{$vo.old_price}元</del>
								            </if>
								            <if condition="$vo['sale_count']+$vo['virtual_num']"><span class="line-right"> 已售{pigcms{$vo['sale_count']+$vo['virtual_num']}</span></if>
								        </div>
    								</div>
								</div>
							</div>
        				</a>
        			</dd>
        			</volist>
				</dl>
			</dd>
    	</dl>
    	<dl class="list" id="poi-summary">
    		<dd>
    			<dl>
    				<dt>店家概述</dt>
		            <dd class="dd-padding kv-line">
		                <p style="text-indent:2em;">{pigcms{$now_store.txt_info}</p>
		            </dd>
				</dl>
			</dd>
		</dl>
    	<script src="{pigcms{:C('JQUERY_FILE')}"></script>
		<script src="{pigcms{$static_path}js/common_wap.js"></script>	
		<script src="{pigcms{$static_path}js/idangerous.swiper.min.js"></script>
		<script>var static_path="{pigcms{$static_path}";var collect_url="{pigcms{:U('Collect/collect')}";var group_id="{pigcms{$now_group.group_id}";</script>
		<script src="{pigcms{$static_path}js/group_detail.js"></script>
		<include file="Public:footer"/>

<script type="text/javascript">
window.shareData = {  
            "moduleName":"Group",
            "moduleID":"0",
            "imgUrl": "{pigcms{$now_store.all_pic.0}", 
            "sendFriendLink": "{pigcms{$config.site_url}{pigcms{:U('Group/shop', array('store_id' => $now_store['store_id']))}",
            "tTitle": "{pigcms{$now_store.name}",
            "tContent": ""
};
</script>
{pigcms{$shareScript}
</body>
</html>