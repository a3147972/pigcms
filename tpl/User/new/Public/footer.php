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