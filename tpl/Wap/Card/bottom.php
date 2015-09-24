<div class="footermenu">
	<ul>
		<li>
			<a href="javascript:history.go(-1);">
				<img src="{pigcms{$static_path}card/images/return.png">
				<p>返回</p>
			</a>
		</li>
		<li>
			<a <php>if($infoType=='memberCardHome'){</php>class="active"<php>}</php> href="/wap.php?g=Wap&c=Card&a=index&token={pigcms{$token}">
				<img src="{pigcms{$static_path}card/images/home.png">
				<p>会员卡首页</p>
			</a>
		</li>
		<li>
			<a <php>if($infoType=='companyDetail'){</php>class="active"<php>}</php> href="/wap.php?g=Wap&c=Card&a=companyDetail&token={pigcms{$token}">
				<img src="{pigcms{$static_path}card/images/detaila.png">
				<p>商家详情</p>
			</a>
		</li>
		<li>
			<a <php>if($infoType=='myCard'){</php>class="active"<php>}</php> href="/wap.php?g=Wap&c=Card&a=index&token={pigcms{$token}&mycard=1">
				<!--span class="num2" >{pigcms{$cardsCount}</span--><img src="{pigcms{$static_path}card/images/my.png">
				<p>我的会员卡</p>
			</a>
		</li>
	</ul>
</div>