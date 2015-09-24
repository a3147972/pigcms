<footer>
	<div class="footer1">
		<div class="footer_txt cf">
			<div class="footer_list cf">
				<ul class="cf">
					<pigcms:footer_link var_name="footer_link_list">
						<li><a href="{pigcms{$vo.url}" target="_blank">{pigcms{$vo.name}</a><if condition="$i neq count($footer_link_list)"><span>|</span></if></li>
					</pigcms:footer_link>
				</ul>
			</div>
			<div class="footer_txt">{pigcms{:nl2br(strip_tags($config['site_show_footer'],'<a>'))}</div>
		</div>
	</div>
</footer>
<div style="display:none;">{pigcms{$config.site_footer}</div>
<!--悬浮框-->
<div class="rightsead">
	<ul>
		<li>
			<a href="javascript:void(0)" class="wechat">
				<img src="{pigcms{$static_path}images/l02.png" width="47" height="49" class="shows"/>
				<img src="{pigcms{$static_path}images/a.png" width="57" height="49" class="hides"/>
				<img src="{pigcms{$config.wechat_qrcode}" width="145" class="qrcode"/>
			</a>
		</li>
		<if condition="$config['site_qq']">
			<li>
				<a href="http://wpa.qq.com/msgrd?v=3&uin={pigcms{$config.site_qq}&site=qq&menu=yes" target="_blank" class="qq">
					<div class="hides qq_div">
						<div class="hides p1"><img src="{pigcms{$static_path}images/ll04.png"/></div>
						<div class="hides p2"><span style="color:#FFF;font-size:13px">{pigcms{$config.site_qq}</span></div>
					</div>
					<img src="{pigcms{$static_path}images/l04.png" width="47" height="49" class="shows"/>
				</a>
			</li>
		</if>
		<if condition="$config['site_phone']">
			<li>
				<a href="javascript:void(0)" class="tel">
					<div class="hides tel_div">
						<div class="hides p1"><img src="{pigcms{$static_path}images/ll05.png"/></div>
						<div class="hides p3"><span style="color:#FFF;font-size:12px">{pigcms{$config.site_phone}</span></div>
					</div>
					<img src="{pigcms{$static_path}images/l05.png" width="47" height="49" class="shows"/>
				</a>
			</li>
		</if>
		<li>
			<a class="top_btn">
				<div class="hides btn_div">
					<img src="{pigcms{$static_path}images/ll06.png" width="161" height="49"/>
				</div>
				<img src="{pigcms{$static_path}images/l06.png" width="47" height="49" class="shows"/>
			</a>
		</li>
	</ul>
</div>
<!--leftsead end-->