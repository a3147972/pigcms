<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>等级升级</title>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
    <link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
    <style>
	    #pg-account .text-icon {
	        font-size: .44rem;
	        color: #666;
	        width: .44rem;
	        text-align: center;
	        margin-right: .1rem;
	    }
	#pg-account strong{
	   color: #f76120;
	}
	.react{margin-left: 20px;}
	.leveldesc p{line-height: 25px;}
	</style>
</head>
<body id="index" data-com="pagecommon">
        <if condition="$_GET['OkMsg']">
        	<div id="tips" class="tips tips-ok" style="display:block;">{pigcms{$_GET.OkMsg}</div>
        <else/>
        	<div id="tips" class="tips"></div>
        </if>
        <div id="pg-account">
		    <dl class="list">
		    	<dd>
		    		<dl>
				        <dd>
							<div class="react  more-weak" style="margin-left: 0px;">您当前积分： <strong>{pigcms{$now_user.score_count}</strong>&nbsp;&nbsp;&nbsp;当前等级：<span><strong><php>if(isset($levelarr[$now_user['level']])){ $nextlevel=$levelarr[$now_user['level']]['level']+1;echo $levelarr[$now_user['level']]['lname'];}else{ $nextlevel=1; echo '暂无等级';}</php></strong></span></div>
				        </dd>
						</dl>
						
						<dl>
						<dd>
							<div class="react  more-weak">下一等级详情：</div>
				        </dd>
						<if condition="isset($levelarr[$nextlevel])">
				        <dd>
				        	<div class="react  more-weak">等级名称：<span>{pigcms{$levelarr[$nextlevel]['lname']}</span></div>
				        </dd>
				        <dd>
				        	<div class="react  more-weak">消耗积分：<span>{pigcms{$levelarr[$nextlevel]['integral']}</span></div>
				        </dd>
						<dd>
				        	<div class="react  more-weak">等级优惠：<span><if condition="$levelarr[$nextlevel]['type'] eq 1">商品按原价{pigcms{$levelarr[$nextlevel]['boon']}%计算<elseif condition="$levelarr[$nextlevel]['type'] eq 2" />商品价格立减{pigcms{$levelarr[$nextlevel]['boon']}元<else />无</if></span></div>
				        </dd>
						<dd>
				        	<div class="react  more-weak"><a href="javascript:void(0);" class="btn" onclick="levelToupdate({pigcms{$now_user.score_count},{pigcms{$levelarr[$nextlevel]['integral']},$(this))" style="color:#FFF;">升 级</a></div>
				        </dd>
						<else />
						<dd>
						<div class="react  more-weak">没有更高的等级了！</div>
						</dd>
						</if>
			<if condition="isset($levelarr[$now_user['level']])">
			<dd style="margin:20px 0px 10px 15px;">
			<strong>{pigcms{$levelarr[$now_user['level']]['lname']} 详情描述：</strong>
			 <div style="line-height: 25px;margin: 15px 0px;" class="leveldesc">
			  {pigcms{$levelarr[$now_user['level']]['description']|htmlspecialchars_decode=ENT_QUOTES}
			 </div>
			</dd>
		   </if>
			<if condition="isset($levelarr[$nextlevel])">
			<dd style="margin:20px 0px 10px 15px;">
			<strong>{pigcms{$levelarr[$nextlevel]['lname']} 详情描述：</strong>
			 <div style="line-height: 25px;margin: 15px 0px;" class="leveldesc">
			  {pigcms{$levelarr[$nextlevel]['description']|htmlspecialchars_decode=ENT_QUOTES}
			 </div>
			</dd>
			</if>
		    </dl></dd></dl>
		</div>
    	<script src="{pigcms{:C('JQUERY_FILE')}"></script>
	<script type="text/javascript">
		/*****等级升级******/
		var levelToupdateUrl="{pigcms{$config['site_url']}/index.php?g=User&c=Level&a=levelUpdate"
		function levelToupdate(currentscore,needscore,obj){
		currentscore=parseInt(currentscore);
		needscore=parseInt(needscore);
		if(currentscore>0 && needscore>0){
		   if(currentscore<needscore){
			  alert('您当前的积分不够升级！');
			  return false;
		   }
		   if(confirm("升级会扣除您"+needscore+"积分\n您确认要升级吗？")){
			  obj.attr('onclick','return false');
			  $.post(levelToupdateUrl,{},function(ret){
				  alert(ret.msg);
				  window.location.reload();
			  },'JSON');
			  return false;
		   }
		}
		}
</script>
	<include file="Public:footer"/>
{pigcms{$hideScript}
</body>
</html>