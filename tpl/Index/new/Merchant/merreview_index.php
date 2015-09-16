<div class="zzsc">
	<div class="tab">
		<div class="tab_title">
			<a href="/merreviews/{pigcms{$merid}.html" class="on" target="_blank">全部</a>
			<a href="/merreviews/{pigcms{$merid}.html?st=1" target="_blank">好评</a>
			<a href="/merreviews/{pigcms{$merid}.html?st=2" target="_blank">中评</a>
			<a href="/merreviews/{pigcms{$merid}.html?st=3" target="_blank">差评</a>
			<a href="/merreviews/{pigcms{$merid}.html?st=4" target="_blank">有图</a>
		</div>
	</div>
	<div class="content">
		<div class="appraise_li-list">
	        <dl>
				<if condition="!empty($reviews['list'])">
					<volist name="reviews['list']" id="rv">
                        <dd>
							<div class="appraise_li-list_img">
                                <div class="appraise_li-list_icon"><img src="{pigcms{$rv['avatar']}"></div>
								<p>{pigcms{$rv['nickname']}</p>
                            </div>
							<div class="appraise_li-list_right cf">
                                <div class="appraise_li-list_top cf">
                                    <div class="appraise_li-list_top_icon">
										<div><span style="width:{pigcms{$rv['score']/5*100}%;"></span></div>
									</div>
                                    <div class="appraise_li-list_data">{pigcms{$rv['add_time']}</div>
                                </div>
                                <div class="appraise_li-list_txt">{pigcms{$rv['comment']}</div>
								<if condition="!empty($rv['pics'])">
									<div class="pic-list J-piclist-wrapper">
									<div class="J-pic-thumbnails pic-thumbnails">
									<ul class="pic-thumbnail-list widget-carousel-indicator-list">
									<volist name="rv['pics']" id="imgs">
									 <li big-src="{pigcms{$imgs['image']}" m-src="{pigcms{$imgs['m_image']}">
									  <a hidefocus="true" href="#" class="pic-thumbnail"><img src="{pigcms{$imgs['s_image']}"></a>
									  </li>
									  </volist>
									</ul>
									 </div>
									 </div>
								</if>
                            </div>
                        </dd>
					</volist>
				<else />
					<dd>暂无评论</dd>
				</if>
            </dl>
		</div>
	</div>
  </div>
<script src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
  <script type="text/javascript">
		$('.J-piclist-wrapper li a').live('click',function(){
		var m_src = $(this).closest('li').attr('m-src');
		var big_src = $(this).closest('li').attr('big-src');
		window.art.dialog({
			title: '查看图片',
			lock: true,
			fixed: true,
			opacity: '0.4',
			resize: false,
			left: '50%',
			top: '38.2%',
			content:'<a href="'+big_src+'" target="_blank" title="新窗口打开查看原图"><img src="'+m_src+'" alt="大图"/></a>',
			close: null
		});
		return false;
	});
</script>